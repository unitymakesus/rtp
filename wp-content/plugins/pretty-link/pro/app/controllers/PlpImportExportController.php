<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpImportExportController extends PrliBaseController {
  public function load_hooks() {
    add_action('wp_ajax_plp-export-links', array($this, 'export'));
    add_action('plp_admin_menu', array($this, 'admin_menu'), 10, 1);
  }

  public function admin_menu($role) {
    add_submenu_page(
      'pretty-link',
      __('Pretty Links Pro | Import/Export', 'pretty-link'),
      __('Pro Import/Export', 'pretty-link'),
      $role, 'plp-import-export',
      array($this, 'route')
    );
  }

  public function route() {
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'import') {
      $this->import();
    }
    else {
      require_once(PLP_VIEWS_PATH.'/import-export/form.php');
    }
  }

  public function import() {
    global $prli_link, $prli_link_meta, $plp_keyword, $plp_options, $prli_error_messages;

    $filename = $_FILES['importedfile']['tmp_name'];
    $contents = file_get_contents($filename);
    $headers = array();
    $csvdata = array();
    $row = -1;
    $handle = fopen($filename, 'r');

    while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
      $num = count($data);
      for ($c=0; $c < $num; $c++) {
        if($row < 0) {
          $headers[] = $data[$c];
        }
        else if($row >= 0) {
          $csvdata[$row][$headers[$c]] = $data[$c];
        }
      }

      $row++;
    }

    fclose($handle);

    $total_row_count = count($csvdata);

    $successful_update_count = 0;
    $successful_create_count = 0;
    $no_action_taken_count   = 0;

    $creation_errors = array();
    $update_errors = array();

    foreach($csvdata as $csvrow) {
      if(!empty($csvrow['id'])) {
        $record = $prli_link->get_link_min($csvrow['id'], ARRAY_A);

        if($record) {
          $update_record   = false; // assume there aren't any changes
          $update_keywords = false; // assume there aren't any changes
          foreach($csvrow as $csvkey => $csvval) {
            // We'll get to the keywords in a sec for now ignore them
            if($csvkey == 'keywords') { continue; }

            // If there's a change, flag for update
            if(isset($record[$csvkey]) && $csvval != $record[$csvkey]) {
              $update_record = true;
              break;
            }
          }

          // Add Keywords
          if( $plp_options->keyword_replacement_is_on ) {
            $keyword_str = $plp_keyword->getTextByLinkId( $csvrow['id'] );
            $keywords = explode( ",", $keyword_str );
            $new_keywords = explode(",",$csvrow['keywords']);

            if(count($keywords) == count($new_keywords)) {
              for($i=0;$i < count($keywords);$i++) {
                $keywords[$i] = trim($keywords[$i]);
              }

              sort($keywords);

              for($i=0;$i < count($new_keywords);$i++) {
                $new_keywords[$i] = trim($new_keywords[$i]);
              }

              sort($new_keywords);

              for($i=0; $i < count($new_keywords); $i++) {
                if($keywords[$i] != $new_keywords[$i]) {
                  $update_keywords = true;
                  break;
                }
              }
            }
            else {
              $update_keywords = true;
            }
          }

          $record_updated = false;

          if($update_record) {
            if( $record_updated =
                  prli_update_pretty_link(
                    $csvrow['id'],
                    trim($csvrow['url']),
                    $csvrow['slug'],
                    $csvrow['name'],
                    (isset($csvrow['description']))?$csvrow['description']:'',
                    $csvrow['group_id'],
                    $csvrow['track_me'],
                    $csvrow['nofollow'],
                    $csvrow['redirect_type'],
                    $csvrow['param_forwarding'],
                    '' /*param_struct*/ ) ) {
              $successful_update_count++;
              $prli_link_meta->update_link_meta($csvrow['id'], 'delay', (isset($csvrow['delay']))?(int)$csvrow['delay']:0);
              $prli_link_meta->update_link_meta($csvrow['id'], 'google_tracking', (isset($csvrow['google_tracking']))?(bool)$csvrow['google_tracking']:false);
            }
            else {
              $update_errors[] = array('id' => $csvrow['id'], 'errors' => $prli_error_messages);
            }
          }

          if($update_keywords) {
            // We don't want to update the keywords if there was an error
            // in the record's update that is, if the record was updated
            if($record_updated || !$update_record) {
              $plp_keyword->updateLinkKeywords($csvrow['id'], stripslashes($csvrow['keywords']));

              // If the record was never updated then increment the count
              if(!$update_record) {
                $successful_update_count++;
              }
            }
          }

          if(!$update_record && !$update_keywords) {
            $no_action_taken_count++;
          }
        }
      }
      else {
        if( $newid =
              prli_create_pretty_link(
                trim($csvrow['url']),
                $csvrow['slug'],
                $csvrow['name'],
                (isset($csvrow['description']))?$csvrow['description']:'',
                $csvrow['group_id'],
                $csvrow['track_me'],
                $csvrow['nofollow'],
                $csvrow['redirect_type'],
                $csvrow['param_forwarding'],
                '' /*param_struct*/ ) ) {
          $successful_create_count++;
          $prli_link_meta->update_link_meta($newid, 'delay', (isset($csvrow['delay']))?(int)$csvrow['delay']:0);
          $prli_link_meta->update_link_meta($newid, 'google_tracking', (isset($csvrow['google_tracking']))?(bool)$csvrow['google_tracking']:false);

          if( $plp_options->keyword_replacement_is_on && !empty($csvrow['keywords']) ) {
            $plp_keyword->updateLinkKeywords($newid, stripslashes($csvrow['keywords']));
          }
        }
        else {
          $creation_errors[] = array('slug' => $csvrow['slug'], 'errors' => $prli_error_messages);
        }
      }

      $prli_error_messages = array();
    }

    require_once(PLP_VIEWS_PATH.'/import-export/import.php');
  }

  public function export() {
    global $wpdb, $prli_link, $prli_link_meta, $plp_options, $plp_keyword;

    if(!PrliUtils::is_authorized()) {
      echo "Why you creepin?";
      die();
    }

    $q = "SELECT l.id, l.url, l.slug, l.name, l.group_id, l.redirect_type, l.track_me, l.nofollow, l.param_forwarding, gt.meta_value AS google_tracking, d.meta_value AS delay, l.created_at AS created_at, l.updated_at AS last_updated_at
            FROM {$prli_link->table_name} AS l
              LEFT JOIN {$prli_link_meta->table_name} AS gt
                ON l.id = gt.link_id AND gt.meta_key = 'google_tracking'
              LEFT JOIN {$prli_link_meta->table_name} AS d
                ON l.id = d.link_id AND d.meta_key = 'delay'";

    $links = $wpdb->get_results($q, ARRAY_A);

    // Add Keywords
    if( $plp_options->keyword_replacement_is_on ) {
      for($i=0; $i < count($links); $i++) {
        $links[$i]['keywords'] = $plp_keyword->getTextByLinkId( $links[$i]['id'] );
      }
    }

    $filename = date('ymdHis',time()) . '_pretty_link_links.csv';
    header('Content-Type: text/x-csv');
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
    header('Expires: '.gmdate('D, d M Y H:i:s', mktime(date('H')+2, date('i'), date('s'), date('m'), date('d'), date('Y'))).' GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');

    if($links[0]) {
      // print the header
      echo '"'.implode('","',array_keys($links[0]))."\"\n";
    }

    foreach($links as $link) {
      $first = true;
      foreach($link as $value) {
        if($first) {
          echo '"';
          $first = false;
        }
        else {
          echo '","';
        }

        echo preg_replace('/\"/', '""', stripslashes($value));
      }

      echo "\"\n";
    }

    exit;
  }
}

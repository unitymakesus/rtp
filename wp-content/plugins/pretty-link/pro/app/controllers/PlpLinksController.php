<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpLinksController extends PrliBaseController {
  public function load_hooks() {
    add_action('prli_bulk_action_right_col', array($this, 'bulk_actions'));
    add_action('prli-bulk-action-update',    array($this, 'update_bulk_actions'), 10, 2);
    add_action('prli_link_fields',   array($this,'display_link_options'));
    add_action('prli_record_click',  array($this,'record_rotation_click'));
    add_action('prli_update_link',   array($this,'update_link_options'));
    add_filter('prli_validate_link', array($this,'validate_link_options'));
    add_filter('prli_target_url',    array($this,'customize_target_url'), 99);
    add_action('wp_head', array($this,'shorturl_autodiscover'));

    add_action('prli_redirection_types', array($this,'redirection_types'), 10, 2);
    add_action('prli_issue_cloaked_redirect', array($this,'issue_cloaked_redirect'), 10, 4);
    add_action('prli_default_redirection_types',array($this,'default_redirection_options'));
    add_action('prli_delete_link', array($this,'delete_link'));
    add_action('prli_custom_link_options', array($this,'custom_link_options'));
    add_action('prli-store-options', array($this,'store_link_options'));
    add_action('prli-create-link', array($this,'create_link'), 10, 2);
    add_action('prli-special-link-action', array($this,'qr_code_icon'),10,1);
    add_filter('prli-check-if-slug', array($this,'generate_qr_code'),10,2);

    add_action('prli_list_end_icon', array($this,'link_list_end_icons'));

    add_action('prli-redirect-header', array($this, 'maybe_add_scripts_to_head'));

    add_action('wp_ajax_prli_search_countries', array($this, 'ajax_search_countries'));
  }

  public function maybe_add_scripts_to_head() {
    global $wpdb, $plp_options, $prli_link, $prli_link_meta;

    //Global scripts
    if(!empty($plp_options->global_head_scripts)) {
      echo stripslashes($plp_options->global_head_scripts) . "\n";
    }

    //Per link scripts
    $request_uri = preg_replace('#/(\?.*)?$#', '$1', rawurldecode($_SERVER['REQUEST_URI']));

    if($link_info = $prli_link->is_pretty_link($request_uri, false)) {
      $link_id = $link_info['pretty_link_found']->id;
      $head_scripts = stripslashes($prli_link_meta->get_link_meta($link_id, 'head_scripts', true));

      if(!empty($head_scripts)) {
        echo stripslashes($head_scripts);
      }
    }
  }

  public function bulk_actions() {
    require( PLP_VIEWS_PATH . '/links/bulk-edit.php' );
  }

  public function update_bulk_actions($ids,$params) {
    global $prli_link_meta, $plp_keyword;

    $ids_array = explode(',', $ids);

    foreach($ids_array as $id) {
      if(isset($params['google_tracking'])) {
        $prli_link_meta->update_link_meta( $id, 'google_tracking', (strtolower($params['google_tracking'])=='on') );
      }
    }
  }

  /************ DISPLAY & UPDATE PRO LINK OPTIONS ************/
  public function display_link_options($link_id) {
    global $prli_link, $prli_link_meta, $plp_keyword, $plp_link_rotation, $plp_options;

    if( $plp_options->keyword_replacement_is_on ) {
      if(empty($_POST['keywords']) && $link_id) {
        $keywords = $plp_keyword->getTextByLinkId( $link_id );
      }
      else {
        $keywords = isset($_POST['keywords'])?$_POST['keywords']:'';
      }

      if(empty($_POST['url_replacements']) && $link_id) {
        $url_replacements = $prli_link_meta->get_link_meta( $link_id, 'prli-url-replacements' );

        if(is_array($url_replacements)) {
          $url_replacements = implode(', ', $url_replacements);
        }
        else {
          $url_replacements = '';
        }
      }
      else {
        $url_replacements = isset($_POST['url_replacements'])?$_POST['url_replacements']:'';
      }
    }

    if(empty($_POST['head-scripts']) && $link_id) {
      $head_scripts = stripslashes($prli_link_meta->get_link_meta($link_id, 'head_scripts', true));
    }
    else {
      $head_scripts = isset($_POST['head-scripts'])?stripslashes($_POST['head-scripts']):'';
    }

    if(empty($_POST['dynamic_redirection']) && $link_id) {
      $dynamic_redirection = $prli_link_meta->get_link_meta($link_id, 'prli_dynamic_redirection', true);

      // Ensure reverse compatibility
      if(empty($dynamic_redirection) &&
         $plp_link_rotation->there_are_rotations_for_this_link($link_id)) {
        $dynamic_redirection = 'rotate';
      }
    }
    else {
      $dynamic_redirection = isset($_POST['dynamic_redirection'])?$_POST['dynamic_redirection']:'none';
    }

    if(empty($_POST['url_rotations']) && $link_id) {
      $url_rotations = $plp_link_rotation->get_rotations( $link_id );
      $url_rotation_weights   = $plp_link_rotation->get_weights( $link_id );

      if(!is_array($url_rotations)) {
        $url_rotations = array('','','','');
      }

      if(!is_array($url_rotation_weights)) {
        $url_rotation_weights = array('','','','');
      }
    }
    else {
      $url_rotations = isset($_POST['url_rotations'])?$_POST['url_rotations']:array();
      $url_rotation_weights = isset($_POST['url_rotation_weights'])?$_POST['url_rotation_weights']:'';
    }

    if(empty($_POST['url']) && $link_id) {
      $link = $prli_link->getOne($link_id);
      $target_url = $link->url;
    }
    else {
      $target_url = isset($_POST['url'])?$_POST['url']:'';
    }

    if(!$link_id || !($target_url_weight = $prli_link_meta->get_link_meta($link_id, 'prli-target-url-weight', true))) {
      $target_url_weight = 0;
    }

    if(!empty($_POST) && !isset($_POST['enable_split_test']) || (empty($link_id) || !$link_id)) {
      $enable_split_test = isset($_POST['enable_split_test']);
    }
    else {
      $enable_split_test = $prli_link_meta->get_link_meta($link_id, 'prli-enable-split-test', true);
    }

    if(isset($_POST['split_test_goal_link']) || (empty($link_id) || !$link_id)) {
      $split_test_goal_link = isset($_POST['split_test_goal_link'])?$_POST['split_test_goal_link']:'';
    }
    else {
      $split_test_goal_link = $prli_link_meta->get_link_meta($link_id, 'prli-split-test-goal-link', true);
    }

    $links = $prli_link->getAll('',' ORDER BY gr.name,li.name');

    if(isset($_POST['enable_expire']) || (empty($link_id) || !$link_id)) {
      $enable_expire = isset($_POST['enable_expire']);
    }
    else {
      $enable_expire = $prli_link_meta->get_link_meta($link_id, 'enable_expire', true);
    }

    if(isset($_POST['expire_type']) || (empty($link_id) || !$link_id)) {
      $expire_type = isset($_POST['expire_type'])?$_POST['expire_type']:'date';
    }
    else {
      $expire_type = $prli_link_meta->get_link_meta($link_id, 'expire_type', true);
    }

    if(isset($_POST['expire_date']) || (empty($link_id) || !$link_id)) {
      $expire_date = isset($_POST['expire_date'])?$_POST['expire_date']:'';
    }
    else {
      $expire_date = $prli_link_meta->get_link_meta($link_id, 'expire_date', true);
    }

    if(isset($_POST['expire_clicks']) || (empty($link_id) || !$link_id)) {
      $expire_clicks = isset($_POST['expire_clicks'])?$_POST['expire_clicks']:0;
    }
    else {
      $expire_clicks = $prli_link_meta->get_link_meta($link_id, 'expire_clicks', true);
    }

    if(isset($_POST['enable_expired_url']) || (empty($link_id) || !$link_id)) {
      $enable_expired_url = isset($_POST['enable_expired_url']);
    }
    else {
      $enable_expired_url = $prli_link_meta->get_link_meta($link_id, 'enable_expired_url', true);
    }

    if(isset($_POST['expired_url']) || (empty($link_id) || !$link_id)) {
      $expired_url = isset($_POST['expired_url'])?$_POST['expired_url']:'';
    }
    else {
      $expired_url = $prli_link_meta->get_link_meta($link_id, 'expired_url', true);
    }

    require_once(PLP_VIEWS_PATH.'/links/form.php');
  }

  public function validate_link_options($errors) {
    global $prli_link_meta, $plp_options;

    if( $plp_options->keyword_replacement_is_on ) {
      if( !empty($_POST[ 'url_replacements' ]) ) {
        $replacements = explode(',', $_POST['url_replacements']);
        foreach($replacements as $replacement) {
          if(!PrliUtils::is_url(trim($replacement))) {
            $errors[] = __('Your URL Replacements must be formatted as a comma separated list of properly formatted URLs (http[s]://example.com/whatever)', 'pretty-link');
            break;
          }
        }
      }
    }

    if(isset($_POST['enable_expire'])) {
      if(isset($_POST['expire_type']) && $_POST['expire_type']=='date') {
        $_POST['expire_date'] = trim($_POST['expire_date']);
        if(!PrliUtils::is_date($_POST['expire_date'])) {
          $errors[] = __('Date must be valid and formatted YYYY-MM-DD.', 'pretty-link');
        }
      }
      else if(isset($_POST['expire_type']) && $_POST['expire_type']=='clicks') {
        $_POST['expire_clicks'] = trim($_POST['expire_clicks']);

        // If they have clicks set here then we force tracking on for the link
        // TODO: Is this the best way to do this?
        $_POST['track_me'] = 'on';

        if( !is_numeric($_POST['expire_clicks']) ||
            (int)$_POST['expire_clicks'] <= 0 ) {
          $errors[] = __('Expire Clicks must be a number greater than zero.', 'pretty-link');
        }
      }

      if(isset($_POST['enable_expired_url'])) {
        $_POST['expired_url'] = trim($_POST['expired_url']);
        if(!PrliUtils::is_url($_POST['expired_url'])) {
          $errors[] = __('Expired URL must be a valid URL.', 'pretty-link');
        }
      }
    }

    if( !empty($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='rotate' ) {
      if( !empty($_POST[ 'url_rotations' ]) ) {
        $num_active_links = 0;
        $weight_sum = (int)$_POST['target_url_weight'];
        foreach($_POST['url_rotations'] as $i => $rotation) {
          if(!empty($rotation)) {
            if(!PrliUtils::is_url($rotation)) {
              $errors[] = __('Your URL Rotations must all be properly formatted URLs.', 'pretty-link');
            }

            $num_active_links++;
            $weight_sum += (int)$_POST['url_rotation_weights'][$i];
          }
        }

        if($num_active_links > 0 && $weight_sum != 100) {
          $errors[] = __('Your Link Rotation Weights must add up to 100%.', 'pretty-link');
        }
      }
    }

    if( !empty($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='geo' ) {
      if( !empty($_POST['prli_geo_url']) ) {
        foreach($_POST['prli_geo_url'] as $i => $geo_url) {
          if(!empty($geo_url)) {
            if(!PrliUtils::is_url($geo_url)) {
              $errors[] = __('Your Geographic Redirect URLs must all be properly formatted.', 'pretty-link');
            }
          }
          else {
            $errors[] = __('Your Geographic Redirects URLs must not be empty.', 'pretty-link');
          }

          if(empty($_POST['prli_geo_countries']) || empty($_POST['prli_geo_countries'][$i])) {
            $errors[] = __('Your Geographic Redirect Countries must not be empty.', 'pretty-link');
          }
        }
      }
    }

    if( !empty($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='tech' ) {
      if( !empty($_POST['prli_tech_url']) ) {
        foreach($_POST['prli_tech_url'] as $i => $tech_url) {
          if(!empty($tech_url)) {
            if(!PrliUtils::is_url($tech_url)) {
              $errors[] = __('Your Technology Redirect URLs must all be properly formatted.', 'pretty-link');
            }
          }
          else {
            $errors[] = __('Your Technology Redirects URLs must not be empty.', 'pretty-link');
          }
        }
      }
    }

    if( !empty($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='time' ) {
      if( !empty($_POST['prli_time_url']) ) {
        foreach($_POST['prli_time_url'] as $i => $time_url) {
          if(!empty($time_url)) {
            if(!PrliUtils::is_url($time_url)) {
              $errors[] = __('Your Time Period Redirect URLs must all be properly formatted.', 'pretty-link');
            }
          }
          else {
            $errors[] = __('Your Time Period Redirects URLs must not be empty.', 'pretty-link');
          }

          if(!empty($_POST['prli_time_start'])) {
            if(empty($_POST['prli_time_start'][$i])) {
              $errors[] = __('Your Time Period Redirect start time must not be empty.', 'pretty-link');
            }
            else if(!PrliUtils::is_date($_POST['prli_time_start'][$i])) {
              $errors[] = __('Your Time Period Redirect start time must be a properly formatted date.', 'pretty-link');
            }
          }

          if(!empty($_POST['prli_time_end'])) {
            if(empty($_POST['prli_time_end'][$i])) {
              $errors[] = __('Your Time Period Redirect end time must not be empty.', 'pretty-link');
            }
            else if(!PrliUtils::is_date($_POST['prli_time_end'][$i])) {
              $errors[] = __('Your Time Period Redirect end time must be a properly formatted date.', 'pretty-link');
            }
          }

          if(!empty($_POST['prli_time_start']) && !empty($_POST['prli_time_end']) &&
             PrliUtils::is_date($_POST['prli_time_start'][$i]) && PrliUtils::is_date($_POST['prli_time_end'][$i]) &&
             ($time_start = strtotime($_POST['prli_time_start'][$i])) && ($time_end = strtotime($_POST['prli_time_end'][$i])) &&
             $time_start > $time_end ) {
            $errors[] = __('Your Time Period Redirect start time must come before the end time.', 'pretty-link');
          }
        }
      }
    }

    if(isset($_POST['delay']) && !empty($_POST['delay'])) {
      if(!is_numeric($_POST['delay'])) {
        $errors[] = __('Delay Redirect must be a number', 'pretty-link');
      }
    }

    return $errors;
  }

  public function update_link_options($link_id) {
    global $prli_link_meta, $plp_link_rotation, $plp_keyword, $plp_options;

    if($plp_options->keyword_replacement_is_on) {
      //Keywords first
      $plp_keyword->updateLinkKeywords($link_id, stripslashes($_POST['keywords']));

      //Now URL replacements
      $replacements = explode(',',$_POST['url_replacements']);

      for($i=0; $i < count($replacements); $i++) {
        $replacements[$i] = trim(stripslashes($replacements[$i]));
      }

      //No point filling the meta table with a bunch of empty crap
      if(count($replacements) == 1 && empty($replacements[0])) {
        $prli_link_meta->delete_link_meta($link_id, 'prli-url-replacements');
      }
      else {
        $prli_link_meta->update_link_meta($link_id, 'prli-url-replacements', $replacements);
      }
    }

    $prli_link_meta->update_link_meta($link_id, 'prli_dynamic_redirection', (isset($_POST['dynamic_redirection'])?$_POST['dynamic_redirection']:'none'));

    if(isset($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='rotate' &&
       isset($_POST['url_rotations'])) {
      $prli_link_meta->update_link_meta($link_id, 'prli-target-url-weight', $_POST['target_url_weight']);
      $plp_link_rotation->updateLinkRotations($link_id,$_POST['url_rotations'],$_POST['url_rotation_weights']);
      $prli_link_meta->update_link_meta($link_id, 'prli-enable-split-test', isset($_POST['enable_split_test']));
      $prli_link_meta->update_link_meta($link_id, 'prli-split-test-goal-link', isset($_POST['split_test_goal_link'])?$_POST['split_test_goal_link']:'');
    }
    else {
      $prli_link_meta->update_link_meta($link_id, 'prli-target-url-weight', 100);
      $plp_link_rotation->updateLinkRotations($link_id,array(),array());
      $prli_link_meta->update_link_meta($link_id, 'prli-enable-split-test', false);
      $prli_link_meta->update_link_meta($link_id, 'prli-split-test-goal-link', '');
    }

    if(isset($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='geo' &&
       !empty($_POST['prli_geo_url']) && !empty($_POST['prli_geo_countries'])) {
      $prli_link_meta->update_link_meta($link_id, 'geo_url', $_POST['prli_geo_url']);
      $prli_link_meta->update_link_meta($link_id, 'geo_countries', $_POST['prli_geo_countries']);
    }
    else {
      $prli_link_meta->update_link_meta($link_id, 'geo_url', array());
      $prli_link_meta->update_link_meta($link_id, 'geo_countries', array());
    }

    if(isset($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='tech' &&
       !empty($_POST['prli_tech_url']) && !empty($_POST['prli_tech_device']) &&
       !empty($_POST['prli_tech_os']) && !empty($_POST['prli_tech_browser'])) {
      $prli_link_meta->update_link_meta($link_id, 'tech_url', $_POST['prli_tech_url']);
      $prli_link_meta->update_link_meta($link_id, 'tech_device', $_POST['prli_tech_device']);
      $prli_link_meta->update_link_meta($link_id, 'tech_os', $_POST['prli_tech_os']);
      $prli_link_meta->update_link_meta($link_id, 'tech_browser', $_POST['prli_tech_browser']);
    }
    else {
      $prli_link_meta->update_link_meta($link_id, 'tech_url', array());
      $prli_link_meta->update_link_meta($link_id, 'tech_device', array());
      $prli_link_meta->update_link_meta($link_id, 'tech_os', array());
      $prli_link_meta->update_link_meta($link_id, 'tech_browser', array());
    }

    if(isset($_POST['dynamic_redirection']) && $_POST['dynamic_redirection']=='time' &&
       !empty($_POST['prli_time_url']) && !empty($_POST['prli_time_start']) && !empty($_POST['prli_time_end'])) {
      $prli_link_meta->update_link_meta($link_id, 'time_url', $_POST['prli_time_url']);
      $prli_link_meta->update_link_meta($link_id, 'time_start', $_POST['prli_time_start']);
      $prli_link_meta->update_link_meta($link_id, 'time_end', $_POST['prli_time_end']);
    }
    else {
      $prli_link_meta->update_link_meta($link_id, 'time_url', array());
      $prli_link_meta->update_link_meta($link_id, 'time_start', array());
      $prli_link_meta->update_link_meta($link_id, 'time_end', array());
    }

    $prli_link_meta->update_link_meta($link_id, 'google_tracking', isset($_POST['google_tracking']));
    $prli_link_meta->update_link_meta($link_id, 'delay', empty($_POST['delay'])?0:$_POST['delay']);
    $prli_link_meta->update_link_meta($link_id, 'head_scripts', isset($_POST['head-scripts'])?stripslashes($_POST['head-scripts']):'');

    $prli_link_meta->update_link_meta($link_id, 'enable_expire', isset($_POST['enable_expire']));
    $prli_link_meta->update_link_meta($link_id, 'expire_type', esc_html($_POST['expire_type']));
    $prli_link_meta->update_link_meta($link_id, 'expire_date', esc_html($_POST['expire_date']));
    $prli_link_meta->update_link_meta($link_id, 'expire_clicks', esc_html($_POST['expire_clicks']));
    $prli_link_meta->update_link_meta($link_id, 'enable_expired_url', isset($_POST['enable_expired_url']));
    $prli_link_meta->update_link_meta($link_id, 'expired_url', esc_html($_POST['expired_url']));
  }

  /** This is where we do link rotation or geolocated redirects */
  public function customize_target_url($target) {
    global $plp_link_rotation, $prli_link_meta, $prli_utils, $prli_link;

    if(($expired_url = PlpUtils::is_link_expired($target['link_id']))) {
      if($expired_url==404) {
        // TODO: Not totally sure how to ensure this will use the WordPress 404 mechanism...figure it out
        // For now just throw a 404 and render our page here
        status_header(404);
        require(PLP_VIEWS_PATH.'/links/link-has-expired.php');
        exit;
      }
      else {
        return array('url' => $expired_url, 'link_id' => $target['link_id']);
      }
    }

    $dynamic_redirection = $prli_link_meta->get_link_meta($target['link_id'], 'prli_dynamic_redirection', true);

    if((empty($dynamic_redirection) || $dynamic_redirection=='rotate') &&
       $plp_link_rotation->there_are_rotations_for_this_link($target['link_id'])) {
      return array('url' => $plp_link_rotation->get_target_url($target['link_id']), 'link_id' => $target['link_id']);
    }
    else if(!empty($dynamic_redirection) && $dynamic_redirection=='geo') {
      $lookup = $this->get_country_lookup($target['link_id']);
      $country = PlpUtils::country_by_ip($prli_utils->get_current_client_ip());

      if(!empty($country) && isset($lookup[$country]) && !empty($lookup[$country])) {
        return array('url' => $lookup[$country], 'link_id' => $target['link_id']);
      }
    }
    else if(!empty($dynamic_redirection) && $dynamic_redirection=='tech') {
      $binfo = $prli_utils->php_get_browser();

      $tech_urls = $prli_link_meta->get_link_meta($target['link_id'], 'tech_url');
      $tech_devices = $prli_link_meta->get_link_meta($target['link_id'], 'tech_device');
      $tech_oses = $prli_link_meta->get_link_meta($target['link_id'], 'tech_os');
      $tech_browsers = $prli_link_meta->get_link_meta($target['link_id'], 'tech_browser');

      if(is_array($tech_urls) && !empty($tech_urls)) {
        $ti = $this->get_tech_info($binfo);
        foreach($tech_urls as $i => $tech_url) {
          if(in_array($tech_devices[$i],$ti['devices']) &&
             in_array($tech_oses[$i],$ti['oses']) &&
             in_array($tech_browsers[$i],$ti['browsers'])) {
            return array('url' => $tech_url, 'link_id' => $target['link_id']);
          }
        }
      }
    }
    else if(!empty($dynamic_redirection) && $dynamic_redirection=='time') {
      if(($time_url = PlpUtils::is_link_time_redirect_active($target['link_id']))) {
        return array('url' => $time_url, 'link_id' => $target['link_id']);
      }
    }

    return $target;
  }

  /** Return a single array able to lookup a target url from a country code based
    * on the values entered with the geo-location specific redirects.
    */
  private function get_country_lookup($link_id) {
    global $prli_link_meta;

    $dynamic_redirection = $prli_link_meta->get_link_meta($link_id, 'prli_dynamic_redirection', true);
    if(!empty($dynamic_redirection) && $dynamic_redirection=='geo') {
      $geo_url = $prli_link_meta->get_link_meta($link_id, 'geo_url');
      $geo_countries = $prli_link_meta->get_link_meta($link_id, 'geo_countries');

      $lookup = array();
      foreach($geo_countries as $i => $cstr) {
        $cs = explode(',', $cstr);
        foreach($cs as $ci => $country) {
          if(!empty($country) &&
             preg_match('/\[([a-zA-Z]+)\]/i', $country, $m) &&
             !empty($m[1]) &&
             !isset($lookup[$m[1]])) { // First country set wins
            $lookup[strtoupper($m[1])] = $geo_url[$i];
          }
        }
      }

      return $lookup;
    }

    return false;
  }

  private function get_tech_info($info) {
    // Devices
    $devices=array('any');

    if($info['ismobiledevice']===true ||
       $info['ismobiledevice']==='true') {
      $devices[]='mobile';
    }

    if($info['istablet']===true ||
       $info['istablet']==='true') {
      $devices[]='tablet';
    }
    if(($info['istablet']===false ||
        $info['istablet']==='false') &&
       ($info['ismobiledevice']===true ||
        $info['ismobiledevice']==='true')) {
      $devices[]='phone';
    }

    if(($info['istablet']===false ||
        $info['istablet']==='false') &&
       ($info['ismobiledevice']===false ||
        $info['ismobiledevice']==='false')) {
      $devices[]='desktop';
    }

    // Operating Systems
    $oses = array('any');
    $info_os = strtolower($info['platform']);
    $windows_oses = array( 'win10', 'win32', 'win7', 'win8', 'win8.1', 'winnt', 'winvista' );
    $other_oses = array('android', 'linux', 'ios', 'macosx');

    // map macos to macosx for now
    $info_os = (($info_os=='macos') ? 'macosx' : $info_os);

    if(in_array($info_os, $other_oses)) {
      $oses[] = $info_os;
    }
    else if(in_array($info_os, $windows_oses)) {
      $oses[] = 'win';
    }

    $browsers = array('any');
    $info_browser = strtolower($info['browser']);
    $android_browsers = array('android', 'android webview');
    $ie_browsers = array('fake ie', 'ie');
    $other_browsers = array('chrome', 'chromium', 'coast', 'edge', 'firefox', 'opera', 'safari', 'silk', 'kindle');

    if(in_array($info_browser, $other_browsers)) {
      $browsers[] = $info_browser;
    }
    else if(in_array($info_browser, $ie_browsers)) {
      $browsers[] = 'ie';
    }
    else if(in_array($info_browser, $android_browsers)) {
      $browsers[] = 'android';
    }

    return compact('devices','oses','browsers');
  }

  public function record_rotation_click($args) {
    $link_id    = $args['link_id'];
    $click_id   = $args['click_id'];
    $target_url = $args['url'];

    global $plp_link_rotation;
    if($plp_link_rotation->there_are_rotations_for_this_link($link_id)) {
      $plp_link_rotation->record_click($click_id,$link_id,$target_url);
    }
  }

  /***** ADD SHORTLINK AUTO-DISCOVERY *****/
  public function shorturl_autodiscover() {
    global $post;

    if(!is_object($post)) { return; }

    $pretty_link_id = PrliUtils::get_prli_post_meta($post->ID,"_pretty-link",true);

    if($pretty_link_id && (is_single() || is_page())) {
      $shorturl = prli_get_pretty_link_url($pretty_link_id);

      if($shorturl && !empty($shorturl)) {
        ?><link rel="shorturl" href="<?php echo $shorturl; ?>" /><?php
      }
    }
  }

  /***************** ADD PRETTY BAR, PIXEL and CLOAKED REDIRECTION *********************/
  public function redirection_types($v, $selected = false) {
    $prettybar   = isset($v['redirect_type']['prettybar'])   ? $v['redirect_type']['prettybar']   : '';
    $cloak       = isset($v['redirect_type']['cloak'])       ? $v['redirect_type']['cloak']       : '';
    $pixel       = isset($v['redirect_type']['pixel'])       ? $v['redirect_type']['pixel']       : '';
    $metarefresh = isset($v['redirect_type']['metarefresh']) ? $v['redirect_type']['metarefresh'] : '';
    $javascript  = isset($v['redirect_type']['javascript'])  ? $v['redirect_type']['javascript']  : '';

    ?>
      <option value="prettybar"<?php echo $prettybar; ?> <?php if($selected) { selected('prettybar', $selected); } ?>><?php _e('Pretty Bar', 'pretty-link'); ?>&nbsp;</option>
      <option value="cloak"<?php echo $cloak; ?> <?php if($selected) { selected('cloak', $selected); } ?>><?php _e('Cloaked', 'pretty-link'); ?>&nbsp;</option>
      <option value="pixel"<?php echo $pixel; ?> <?php if($selected) { selected('pixel', $selected); } ?>><?php _e('Pixel', 'pretty-link'); ?>&nbsp;</option>
      <option value="metarefresh"<?php echo $metarefresh; ?> <?php if($selected) { selected('metarefresh', $selected); } ?>><?php _e('Meta Refresh', 'pretty-link'); ?>&nbsp;</option>
      <option value="javascript"<?php echo $javascript; ?> <?php if($selected) { selected('javascript', $selected); } ?>><?php _e('Javascript', 'pretty-link'); ?>&nbsp;</option>
    <?php
  }

  public function issue_cloaked_redirect($redirect_type, $pretty_link, $pretty_link_url, $param_string) {
    global $prli_blogurl, $prli_link_meta, $prli_blogname;

    $delay = $prli_link_meta->get_link_meta($pretty_link->id, 'delay', true);

    header("Content-Type: text/html", true);
    header("HTTP/1.1 200 OK", true);

    switch($redirect_type) {
      case 'pixel':
        break;
      case 'prettybar':
        require_once(PLP_VIEWS_PATH . '/links/prettybar-redirect.php');
        break;
      case 'cloak':
        require_once(PLP_VIEWS_PATH . '/links/cloaked-redirect.php');
        break;
      case 'metarefresh':
        require_once(PLP_VIEWS_PATH . '/links/metarefresh-redirect.php');
        break;
      case 'javascript':
        require_once(PLP_VIEWS_PATH . '/links/javascript-redirect.php');
        break;
      default:
        wp_redirect("{$pretty_link_url}{$param_string}", 302);
        exit;
    }
  }

  public function default_redirection_options($link_redirect_type) {
  ?>
    <option value="prettybar" <?php echo (($link_redirect_type == 'prettybar')?' selected="selected"':''); ?>/><?php _e('Pretty Bar', 'pretty-link'); ?></option>
    <option value="cloak" <?php echo (($link_redirect_type == 'cloak')?' selected="selected"':''); ?>/><?php _e('Cloak', 'pretty-link'); ?></option>
    <option value="pixel" <?php echo (($link_redirect_type == 'pixel')?' selected="selected"':''); ?>/><?php _e('Pixel', 'pretty-link'); ?></option>
    <option value="metarefresh" <?php echo (($link_redirect_type == 'metarefresh')?' selected="selected"':''); ?>/><?php _e('Meta Refresh', 'pretty-link'); ?></option>
    <option value="javascript" <?php echo (($link_redirect_type == 'javascript')?' selected="selected"':''); ?>/><?php _e('Javascript', 'pretty-link'); ?></option>
  <?php
  }

  /** Deletes all the pro-specific meta about a link right before the link is deleted.
    * TODO: Relocate most of this to a model asap
    */
  public function delete_link($id) {
    global $wpdb, $plp_keyword, $plp_report, $plp_link_rotation;
    $query = $wpdb->prepare("DELETE FROM {$plp_keyword->table_name} WHERE link_id=%d", $id);
    $wpdb->query($query);

    $query = $wpdb->prepare("UPDATE {$plp_report->table_name} SET goal_link_id=NULL WHERE goal_link_id=%d", $id);
    $wpdb->query($query);

    $query = $wpdb->prepare("DELETE FROM {$plp_report->links_table_name} WHERE link_id=%d", $id);
    $wpdb->query($query);

    $query = $wpdb->prepare("DELETE FROM {$plp_link_rotation->table_name} WHERE link_id=%d", $id);
    $wpdb->query($query);

    $query = $wpdb->prepare("DELETE FROM {$plp_link_rotation->cr_table_name} WHERE link_id=%d", $id);
    $wpdb->query($query);

    $query = $wpdb->prepare("DELETE FROM {$wpdb->postmeta} WHERE meta_key=%s AND meta_value=%s", '_pretty-link', $id);
    $wpdb->query($query);
  }

  public function custom_link_options() {
    global $plp_options;
    require( PLP_VIEWS_PATH . '/links/link-options.php');
  }

  public function store_link_options() {
    global $plp_options;

    $plp_options->google_tracking = (int)isset($_REQUEST[ $plp_options->google_tracking_str ]);
    $plp_options->generate_qr_codes = (int)isset($_REQUEST[ $plp_options->generate_qr_codes_str ]);
    $plp_options->qr_code_links = (int)isset($_REQUEST[ $plp_options->qr_code_links_str ]);
    $plp_options->global_head_scripts = stripslashes($_REQUEST[$plp_options->global_head_scripts_str]);
    $plp_options->base_slug_prefix = sanitize_title(stripslashes($_REQUEST[$plp_options->base_slug_prefix_str]), '');
    $plp_options->num_slug_chars = stripslashes((int)$_REQUEST[$plp_options->num_slug_chars_str]);

    //Force a minimum of two characters?
    if($plp_options->num_slug_chars < 2) {
      $plp_options->num_slug_chars = 2;
    }

    // Save the posted value in the database
    $plp_options->store();
  }

  public function create_link($link_id, $values) {
    global $plp_options, $prli_link_meta;

    if(!isset($values['google_tracking'])) {
      $prli_link_meta->update_link_meta($link_id, 'google_tracking', $plp_options->google_tracking);
    }
  }

  public function qr_code_icon($pretty_link_id) {
    global $plp_options;
    $pretty_link_url = prli_get_pretty_link_url($pretty_link_id);

    if($plp_options->qr_code_links):
      ?><a href="<?php echo $pretty_link_url; ?>/qr.png" title="<?php printf(__('View QR Code for this link: %s', 'pretty-link'), $pretty_link_url); ?>" target="_blank"><i class="pl-list-icon pl-icon-qrcode"></i></a><?php
    endif;

    if($plp_options->generate_qr_codes):
      ?><a href="<?php echo $pretty_link_url; ?>/qr.png?download=<?php echo wp_create_nonce('prli-generate-qr-code'); ?>" title="<?php printf(__('Download QR Code for this link: %s', 'pretty-link'), $pretty_link_url); ?>"><i class="pl-list-icon pl-icon-qrcode"></i></a><?php
    endif;
  }

  public function generate_qr_code($pretty_link_id, $slug) {
    global $prli_link, $plp_options;

    if( $plp_options->qr_code_links or
      ( $plp_options->generate_qr_codes and
      isset($_REQUEST['download']) and
      wp_verify_nonce($_REQUEST['download'], 'prli-generate-qr-code') ) ) {

      $qr_regexp = '#/qr\.png$#';

      if(!$pretty_link_id and preg_match($qr_regexp, $slug)) {
        $slug_sans_qr = preg_replace($qr_regexp, '', $slug);

        if($pretty_link = $prli_link->getOneFromSlug( $slug_sans_qr )) {
          $pretty_link_url = prli_get_pretty_link_url($pretty_link->id);

          header("Content-Type: image/png");

          if(isset($_REQUEST['download']) and wp_verify_nonce($_REQUEST['download'], 'prli-generate-qr-code')) {
            header("HTTP/1.1 200 OK"); // Have to hard code this for some reason?
            header("Content-Disposition: attachment;filename=\"" . $slug_sans_qr . "_qr.png\"");
            header("Content-Transfer-Encoding: binary");
            //header("Pragma: public");
          }

          @include PLP_VENDOR_PATH."/phpqrcode/qrlib.php";

          QRcode::png($pretty_link_url, false, QR_ECLEVEL_L, 20, 2);

          exit;
        }
      }
    }

    return $pretty_link_id;
  }

  public function link_list_end_icons($link) {
    global $prli_link_meta, $plp_link_rotation;

    $dynamic_redirection = $prli_link_meta->get_link_meta($link->id, 'prli_dynamic_redirection', true);
    $enable_expire = $prli_link_meta->get_link_meta($link->id, 'enable_expire', true);
    $expire_type = $prli_link_meta->get_link_meta($link->id, 'expire_type', true);

    // Ensure reverse compatibility
    if(empty($dynamic_redirection)) {
      $dynamic_redirection = 'none';

      if($plp_link_rotation->there_are_rotations_for_this_link($link->id)) {
        $dynamic_redirection = 'rotate';
      }
    }

    if(empty($enable_expire) || empty($expire_type)) {
      $enable_expire = false;
      $expire_type = 'none';
    }

    if($enable_expire) {
      if($expire_type=='date') {
        $expire_date = $prli_link_meta->get_link_meta($link->id, 'expire_date', true);
        $expire_icon = 'history';
        $expire_class = '';

        if(($expired_url = PlpUtils::is_link_expired($link->id))) {
          $expire_class = 'prli-red';
          if($expired_url==404) {
            $expire_message = sprintf(__('This link expired on %1$s and will now cause a 404 error when visited', 'pretty-link'), $expire_date);
          }
          else {
            $expire_message = sprintf(__('This link expired on %1$s and now redirects to %2$s', 'pretty-link'), $expire_date, $expired_url);
          }
        }
        else {
          $expire_message = sprintf(__('This link is set to expire after the date %s', 'pretty-link'), $expire_date);
        }
      }
      else if($expire_type=='clicks') {
        $expire_clicks = $prli_link_meta->get_link_meta($link->id, 'expire_clicks', true);
        $expire_icon = 'ccw';
        $expire_class = '';

        if(($expired_url = PlpUtils::is_link_expired($link->id))) {
          $expire_class = 'prli-red';
          if($expired_url==404) {
            $expire_message = sprintf(__('This link expired after %d clicks and will now cause a 404 error when visited', 'pretty-link'), $expire_clicks);
          }
          else {
            $expire_message = sprintf(__('This link expired after %1$d clicks and now redirects to %2$s', 'pretty-link'), $expire_clicks, $expired_url);
          }
        }
        else {
          $expire_message = sprintf(__('This link is set to expire after %d clicks', 'pretty-link'), $expire_clicks);
        }
      }

      ?><i class="pl-list-icon pl-icon-<?php echo $expire_icon; ?> <?php echo $expire_class; ?>" title="<?php echo $expire_message; ?>"></i><?php
    }

    if($dynamic_redirection=='rotate') {
      ?><i class="pl-list-icon pl-icon-shuffle" title="<?php _e('This link has additional Target URL rotations', 'pretty-link'); ?>"></i><?php
    }
    else if($dynamic_redirection=='geo') {
      ?><i class="pl-list-icon pl-icon-globe" title="<?php _e('This link has additional Geographic Target URLs', 'pretty-link'); ?>"></i><?php
    }
    else if($dynamic_redirection=='tech') {
      ?><i class="pl-list-icon pl-icon-mobile" title="<?php _e('This link has additional Technology Dependent Conditional Target URLs', 'pretty-link'); ?>"></i><?php
    }
    else if($dynamic_redirection=='time') {
      $time_class = '';
      if(($time_url = PlpUtils::is_link_time_redirect_active($link->id))) {
        $time_message = sprintf(__('A Time Period Redirect is currently active for this link. When visited it will currently redirect to %s rather than the Target URL unless the link is expired.', 'pretty-link'), $time_url);
        $time_class = 'prli-green';
      }
      else {
        $time_message = __('Time Period Redirects have been setup for this link but the current time is not within any of them currently.', 'pretty-link');
      }

      ?><i class="pl-list-icon pl-icon-clock <?php echo $time_class; ?>" title="<?php echo $time_message; ?>"></i><?php
    }
  }

  public function ajax_search_countries() {
    if(!PrliUtils::is_authorized()) {
      echo "Why you creepin?";
      die();
    }

    if(isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
      $res = '';
      $countries = require(PLP_I18N_PATH.'/countries.php');

      foreach($countries as $code => $name) {
        if(preg_match('/'.preg_quote($_REQUEST['q']).'/i', $code) ||
           preg_match('/'.preg_quote($_REQUEST['q']).'/i', $name)) {
          $res .= "{$name} [{$code}]\n";
        }
      }

      echo $res;
    }

    exit;
  }
}


<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpReportsController extends PrliBaseController {
  public function load_hooks() {
    add_action('prli-link-action', array($this, 'split_test_link'), 10, 1);
    add_action('plp_admin_menu', array($this, 'admin_menu'), 10, 1);
  }

  public function admin_menu($role) {
    add_submenu_page(
      'pretty-link',
      __('Pretty Links Pro | Reports', 'pretty-link'),
      __('Pro Reports', 'pretty-link'),
      $role, 'plp-reports',
      array( $this, 'route' )
    );
  }

  public function route() {
    global $plp_report;
    $params = $plp_report->get_params_array();

    $action = isset($params['action']) ? $params['action'] : null;

    switch($action) {
      case 'new':
        $this->new_report($params);
        break;
      case 'create':
        $this->create($params);
        break;
      case 'edit':
        $this->edit($params);
        break;
      case 'update':
        $this->update($params);
        break;
      case 'destroy':
        $this->destroy($params);
        break;
      case 'display-custom-report':
        $this->display_custom_report($params);
        break;
      case 'display-split-test-report':
        $this->display_split_test_report($params);
        break;
      case 'list':
      default:
        $prli_message = __('Create a custom link report and analyze your data.', 'pretty-link');
        $this->display_reports_list($params, $prli_message);
    }
  }

  public function split_test_link($link_id) {
    global $prli_link, $prli_link_meta;

    $link = $prli_link->getOne($link_id);

    if( $prli_link_meta->get_link_meta($link_id, 'prli-enable-split-test', true) ) {
      ?><a href="<?php echo admin_url("admin.php?page=plp-reports&action=display-split-test-report&id={$link->id}"); ?>" title="<?php printf( __('View the Split Test Report for %s'), stripslashes(htmlspecialchars($link->name)) ); ?>"><i class="pl-list-icon pl-icon-chart-pie"></i></a><?php
    }
  }

  private function new_report($params) {
    global $prli_link;

    $links = $prli_link->getAll('',' ORDER BY group_name, li.name');
    $report_links = array();

    require_once(PLP_VIEWS_PATH.'/reports/new.php');
  }

  private function create($params) {
    global $prli_link, $plp_report;

    $errors = $plp_report->validate($_POST);

    if( count($errors) > 0 ) {
      $links = $prli_link->getAll('',' ORDER BY group_name, li.name');
      $report_links = array();
      require_once(PLP_VIEWS_PATH.'/reports/new.php');
    }
    else {
      $insert_id = $plp_report->create( $_POST );
      $plp_report->update_report_links($insert_id, array_keys($_POST['link']));
      $prli_message = __("Your Pretty Link Report was Successfully Created", 'pretty-link');
      $this->display_reports_list($params, $prli_message, '', 1);
    }
  }

  private function edit($params) {
    global $prli_link, $plp_report;

    $record = $plp_report->getOne( $params['id'] );
    $id = $params['id'];
    $links = $prli_link->getAll('',' ORDER BY group_name, li.name');
    $report_links = $plp_report->get_report_links_array($id);

    require_once(PLP_VIEWS_PATH.'/reports/edit.php');
  }

  private function update($params) {
    global $prli_link, $plp_report;

    $errors = $plp_report->validate($_POST);
    $id = $_POST['id'];

    if( count($errors) > 0 ) {
      $links = $prli_link->getAll('',' ORDER BY group_name, li.name');
      $report_links = $plp_report->get_report_links_array($id);
      require_once(PLP_VIEWS_PATH.'/reports/edit.php');
    }
    else {
      $record = $plp_report->update( $id, $_POST );
      $plp_report->update_report_links($id, array_keys($_POST['link']));
      $prli_message = __("Your Pretty Link Report was Successfully Updated", 'pretty-link');
      $this->display_reports_list($params, $prli_message, '', 1);
    }
  }

  private function destroy($params) {
    global $plp_report;

    $plp_report->destroy( $params['id'] );
    $prli_message = __('Your Pretty Link Report was Successfully Deleted', 'pretty-link');

    $this->display_reports_list($params, $prli_message, '', 1);
  }

  private function display_custom_report($params) {
    global $prli_utils, $plp_report, $prli_link;

    $id = $params['id'];

    $start_timestamp = $prli_utils->get_start_date($params);
    $end_timestamp   = $prli_utils->get_end_date($params);

    $start_timestamp = mktime(0, 0, 0, date('n', $start_timestamp), date('j', $start_timestamp), date('Y', $start_timestamp));
    $end_timestamp   = mktime(0, 0, 0, date('n', $end_timestamp),   date('j', $end_timestamp),   date('Y', $end_timestamp)  );

    $report = $plp_report->getOne($id);

    $links   = $plp_report->get_report_links_array($id);
    $labels  = $plp_report->get_labels_by_links($start_timestamp,$end_timestamp,$links);
    $hits    = $plp_report->get_clicks_by_links($start_timestamp,$end_timestamp,$links);
    $uniques = $plp_report->get_clicks_by_links($start_timestamp,$end_timestamp,$links,true);

    $top_hits    = $prli_utils->getTopValue($hits);
    $top_uniques = $prli_utils->getTopValue($uniques);

    if( !empty($report->goal_link_id) ) {
      $goal_link = $prli_link->getOne($report->goal_link_id);
      $conversions = $plp_report->get_conversions_by_links($start_timestamp,$end_timestamp,$links,$report->goal_link_id);

      $conv_rates = array();
      for($i=0; $i<count($links); $i++) {
        $conv_rates[] = (($hits[$i] > 0)?sprintf( "%0.2f", (float)($conversions[$i] / $hits[$i] * 100.0) ):'0.00');
      }

      $top_conversions = $prli_utils->getTopValue(array_values($conversions));
      $top_conv_rate   = $prli_utils->getTopValue(array_values($conv_rates));
    }
    else {
      $goal_link = false;
      $conversions = $conv_rates = array();
      $top_conversions = $top_conv_rate = 0;
    }

    require_once(PLP_VIEWS_PATH.'/reports/custom-report.php');
  }

  private function display_split_test_report($params) {
    global $prli_utils, $plp_report, $prli_link, $prli_link_meta;

    $link_id = $params['id'];

    $goal_link_id = $prli_link_meta->get_link_meta($link_id, 'prli-split-test-goal-link', true);

    $link = $prli_link->getOne($link_id);

    $start_timestamp = $prli_utils->get_start_date($params);
    $end_timestamp   = $prli_utils->get_end_date($params);

    $start_timestamp = mktime(0, 0, 0, date('n', $start_timestamp), date('j', $start_timestamp), date('Y', $start_timestamp));
    $end_timestamp   = mktime(0, 0, 0, date('n', $end_timestamp),   date('j', $end_timestamp),   date('Y', $end_timestamp)  );

    $links   = $plp_report->get_split_report_links_array($link_id);
    $labels  = $links;
    $hits_array    = $plp_report->get_split_clicks($start_timestamp,$end_timestamp,$link_id);
    $uniques_array = $plp_report->get_split_clicks($start_timestamp,$end_timestamp,$link_id,true);

    $hits = array();
    $uniques = array();

    for($i=0;$i<count($links);$i++) {
      $hits[$i]    = ((is_array($hits_array) && isset($hits_array[$links[$i]]) && !empty($hits_array[$links[$i]]))?$hits_array[$links[$i]]:0);
      $uniques[$i] = ((is_array($uniques_array) && isset($uniques_array[$links[$i]]) && !empty($uniques_array[$links[$i]]))?$uniques_array[$links[$i]]:0);
    }

    $top_hits    = (($hits && is_array($hits))?$prli_utils->getTopValue($hits):0);
    $top_uniques = (($uniques && is_array($uniques))?$prli_utils->getTopValue($uniques):0);

    if( !empty($goal_link_id) && $goal_link_id ) {
      $goal_link   = $prli_link->getOne($goal_link_id);
      $conversions_array = $plp_report->get_split_conversions($start_timestamp,$end_timestamp,$link_id,$goal_link_id);

      $conversions = array();
      for($i=0;$i<count($links);$i++) {
        $conversions[$i] = ((is_array($conversions_array) && isset($conversions_array[$links[$i]]) && !empty($conversions_array[$links[$i]]))?$conversions_array[$links[$i]]:0);
      }

      $conv_rates = array();
      for($i=0; $i<count($links); $i++) {
        $conv_rates[] = (($uniques[$i] > 0)?sprintf( "%0.2f", (float)($conversions[$i] / $uniques[$i] * 100.0) ):'0.00');
      }

      $top_conversions = $prli_utils->getTopValue(array_values($conversions));
      $top_conv_rate   = $prli_utils->getTopValue(array_values($conv_rates));
    }

    require_once(PLP_VIEWS_PATH . '/reports/split-test-report.php');
  }

  private function display_reports_list( $params,
                                         $prli_message,
                                         $page_params_ov=false,
                                         $current_page_ov=false ) {
    global $wpdb, $prli_utils, $plp_report, $page_size;

    $report_vars = $this->get_report_sort_vars($params);

    if($current_page_ov) {
      $current_page = $current_page_ov;
    }
    else {
      $current_page = $params['paged'];
    }

    $page_params = '&action=list';

    if($page_params_ov) {
      $page_params .= $page_params_ov;
    }
    else {
      $page_params .= $report_vars['page_params'];
    }

    $sort_str = $report_vars['sort_str'];
    $sdir_str = $report_vars['sdir_str'];
    $search_str = $report_vars['search_str'];

    $record_count = $plp_report->getRecordCount($report_vars['where_clause']);
    $page_count = $plp_report->getPageCount($page_size,$report_vars['where_clause']);
    $reports = $plp_report->getPage($current_page,$page_size,$report_vars['where_clause'],$report_vars['order_by']);
    $page_last_record = $prli_utils->getLastRecordNum($record_count,$current_page,$page_size);
    $page_first_record = $prli_utils->getFirstRecordNum($record_count,$current_page,$page_size);

    require_once(PLP_VIEWS_PATH . '/reports/list.php');
  }

  private function get_report_sort_vars($params,$where_clause = '') {
    $order_by = '';
    $page_params = '';

    // These will have to work with both get and post
    $sort_str = $params['sort'];
    $sdir_str = $params['sdir'];
    $search_str = $params['search'];

    // Insert search string
    if(!empty($search_str)) {
      $search_params = explode(" ", $search_str);

      foreach($search_params as $search_param) {
        if(!empty($where_clause)) {
          $where_clause .= " AND";
        }

        //goal_link_name doesn't exist any longer
        $where_clause .= " (rp.name like '%$search_param%' OR rp.created_at like '%$search_param%')";
      }

      $page_params .="&search=$search_str";
    }

    // make sure page params stay correct
    if(!empty($sort_str)) {
      $page_params .="&sort=$sort_str";
    }

    if(!empty($sdir_str)) {
      $page_params .= "&sdir=$sdir_str";
    }

    // Add order by clause
    switch($sort_str) {
      case 'name':
      case 'goal_link_name':
      case 'link_count':
        $order_by .= " ORDER BY {$sort_str}";
        break;
      default:
        $order_by .= ' ORDER BY created_at';
    }

    // Toggle ascending / descending
    if((empty($sort_str) and empty($sdir_str)) or $sdir_str == 'desc') {
      $order_by .= ' DESC';
      $sdir_str = 'desc';
    }
    else {
      $sdir_str = 'asc';
    }

    return array( 'order_by' => $order_by,
                  'sort_str' => $sort_str,
                  'sdir_str' => $sdir_str,
                  'search_str' => $search_str,
                  'where_clause' => $where_clause,
                  'page_params' => $page_params );
  }
}


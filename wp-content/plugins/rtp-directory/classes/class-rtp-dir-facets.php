<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * RTP_Dir_Facets Class
 *
 * @class RTP_Dir_Facets
 * @version	1.0.0
 * @since 1.0.0
 * @package	RTP_Dir
 * @author Unity
 */
class RTP_Dir_Facets {
	private static $_instance = null;

 	public function __construct () {
	}

	/**
	 * Create a new query to index custom facet source
	 *
	 * @param 		  $facet    array
	 * @return		  array
	 * @package 	  RTP_Dir
	 * @category 	  facetwp
	 */
	public function index_row_data( $rows , $params ){
    global $wpdb;
    switch($params['facet']['source']){
      case 'mq/{name}':
        $new_rows = array();
        //Test if this learner has council
        $query = "YOUR SQL QUERY";
        $results = $wpdb->get_results($query);
        if(!empty($results)) {
          foreach($results as $result){
            $temp_row = $params['defaults'];
            $temp_row['facet_value'] = $temp_row['facet_display_value'] = $result->{column_name};
            $new_rows[] = $temp_row;
          }
          if(!empty($new_rows)) {
            $rows = $new_rows;
          }
        }
        $rows = $new_rows;
      break;
    }
    return $rows;
	}

	/**
	 * Create a custom facet source
	 *
	 * @param 		  $facet    array
	 * @return		  array
	 * @package 	  RTP_Dir
	 * @category 	  facetwp
	 */
	function custom_data_sources( $sources ) {
    $sources['meta_query'] = array(
      'label' => 'Meta Query',
      'choices' => array(
        'mq/{name}' => '{Name}',
      )
    );
    return $sources;
	}
}

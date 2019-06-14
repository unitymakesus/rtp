<?php
/**
 *  UABB Google Map Module file
 *
 *  @package UABB Google Map Module
 */

/**
 * Function that initializes Google Map Module
 *
 * @class GoogleMapModule
 */
class GoogleMapModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Google Map Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Google Map', 'uabb' ),
				'description'     => __( 'Google Map', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/google-map/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/google-map/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'location.svg',
			)
		);

		add_filter( 'fl_builder_render_settings_field', array( $this, 'uabb_google_map_settings_field' ), 10, 3 );

		$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

		$google_api_key = '';

		if ( isset( $uabb_setting_options['uabb-google-map-api'] ) && ! empty( $uabb_setting_options['uabb-google-map-api'] ) ) {

			$google_api_key = $uabb_setting_options['uabb-google-map-api'];
		}

		$url          = 'https://maps.googleapis.com/maps/api/js';
		$this->notice = __( 'Notice', 'uabb' );
		if ( false != $google_api_key ) {
			$arr_params   = array(
				'key' => $google_api_key,
			);
			$url          = esc_url( add_query_arg( $arr_params, $url ) );
			$this->notice = '';
			$this->add_js( 'google-map', $url, array(), '', true );
		}
	}
	/**
	 * Function that renders the Maps Settings field
	 *
	 * @param string $field gets the string for the maps settings field.
	 * @param array  $name an array to get the names of the settings field.
	 * @param object $settings an object to get various settings.
	 */
	function uabb_google_map_settings_field( $field, $name, $settings ) {

		if ( isset( $settings->map_lattitude ) && isset( $settings->map_longitude ) ) {

			if ( isset( $settings->uabb_gmap_addresses ) && empty( $settings->uabb_gmap_addresses ) ) {
				$settings->uabb_gmap_addresses = array();
			}

			if ( empty( $settings->uabb_gmap_addresses[0] ) ) {
				$settings->uabb_gmap_addresses[0] = (object) array(
					'map_lattitude'    => '',
					'map_longitude'    => '',
					'marker_img_src'   => '',
					'marker_point'     => '',
					'open_marker'      => '',
					'info_window_text' => '',
				);
			}

			if ( '' == $settings->uabb_gmap_addresses[0]->map_lattitude && '' == $settings->uabb_gmap_addresses[0]->map_longitude ) {
				if ( isset( $settings->marker_point ) ) {
					$settings->uabb_gmap_addresses[0]->marker_point = ( '' != $settings->marker_point ) ? $settings->marker_point : 'default';
				}

				if ( isset( $settings->open_marker ) ) {
					$settings->uabb_gmap_addresses[0]->open_marker = ( '' != $settings->open_marker ) ? $settings->open_marker : 'no';
				}

				if ( isset( $settings->marker_img_src ) ) {
					$settings->uabb_gmap_addresses[0]->marker_img     = ( '' != $settings->marker_img ) ? $settings->marker_img : '';
					$settings->uabb_gmap_addresses[0]->marker_img_src = ( '' != $settings->marker_img_src ) ? $settings->marker_img_src : '';
				}
			}
			if ( '' == $settings->uabb_gmap_addresses[0]->map_lattitude ) {
				$settings->uabb_gmap_addresses[0]->map_lattitude = ( '' != $settings->map_lattitude ) ? $settings->map_lattitude : 40.76142;
			}

			if ( '' == $settings->uabb_gmap_addresses[0]->map_longitude ) {
				$settings->uabb_gmap_addresses[0]->map_longitude = ( '' != $settings->map_longitude ) ? $settings->map_longitude : -73.97712;
			}

			if ( isset( $settings->info_window_text ) ) {
				if ( '' == $settings->uabb_gmap_addresses[0]->info_window_text ) {
					$settings->uabb_gmap_addresses[0]->info_window_text = ( '' != $settings->info_window_text ) ? $settings->info_window_text : '';
				}
			}
		}

		return $field;
	}
}

$google_api_key = '';

$style1 = 'line-height: 1.45em; color: #a94442;';
$style2 = 'font-weight:bold;color: #a94442;';
$notice = sprintf( /* translators: %1$s: search term, %2$s: search term, %3$s: search term */
	__( '<span style="%1$s">To display customized Google Map without an issue, you need to configure Google Map API key in <span style="%2$s">General Settings</span>. Please configure API key from <a href="%3$s" class="uabb-google-map-notice" target="_blank" rel="noopener">here</a></span>.', 'uabb' ),
	$style1, $style2, admin_url( 'options-general.php?page=uabb-builder-settings#uabb' )
);


$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];

if ( isset( $uabb_setting_options['uabb-google-map-api'] ) && ! empty( $uabb_setting_options['uabb-google-map-api'] ) ) {
	$google_api_key = $uabb_setting_options['uabb-google-map-api'];
}
if ( '' != $google_api_key ) {
	$notice = sprintf( /* translators: %1$s: search term */
		__( '<span style="%1$s">Facing issues while using Google Map module. Please refer your browser for any console error related to Google Map and the following article for <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/error-messages"> troubleshooting steps </a></span>', 'uabb' ), $style1
	);
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/google-map/google-map-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/google-map/google-map-bb-less-than-2-2-compatibility.php';
}

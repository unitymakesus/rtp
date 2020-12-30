<?php
/**
 *  UABB Hotspot Module file
 *
 *  @package UABB Hotspot Module
 */

/**
 * Function that initializes UABB Hotspot Module
 *
 * @class UABBHotspot
 */
class UABBHotspot extends FLBuilderModule {

	/**
	 * Data instance
	 *
	 * @access public
	 * @var $data
	 */
	public $data = null;

	/**
	 * Constructor function that constructs default values for the Hotspot module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Hotspot', 'uabb' ),
				'description'     => __( 'Hotspot', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$extra_additions ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-hotspot/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-hotspot/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'uabb-hotspot.svg',
			)
		);
		$this->add_js( 'jquery-waypoints' );
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
		$version_bb_check        = UABB_Compatibility::$version_bb_check;
		$page_migrated           = UABB_Compatibility::$uabb_migration;
		$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {

			$count_marker = count( $settings->hotspot_marker );

			for ( $i = 0; $i < $count_marker; $i++ ) {

				if ( ! isset( $settings->hotspot_marker[ $i ]->text_font_typo ) || ! is_object( $settings->hotspot_marker[ $i ]->text_font_typo ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo            = new stdClass();
					$settings->hotspot_marker[ $i ]->text_font_typo_medium     = new stdClass();
					$settings->hotspot_marker[ $i ]->text_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo_medium->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->text_font_typo_responsive->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size_unit_responsive );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family ) ) {

					if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family->family ) ) {

						$settings->hotspot_marker[ $i ]->text_font_typo->font_family = $settings->hotspot_marker[ $i ]->text_typography_font_family->family;
						unset( $settings->hotspot_marker[ $i ]->text_typography_font_family->family );
					}
					if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family->weight ) ) {

						if ( 'regular' === $settings->hotspot_marker[ $i ]->text_typography_font_family->weight ) {
							$settings->hotspot_marker[ $i ]->text_font_typo->font_weight = 'normal';
						} else {
							$settings->hotspot_marker[ $i ]->text_font_typo->font_weight = $settings->hotspot_marker[ $i ]->text_typography_font_family->weight;
						}
						unset( $settings->hotspot_marker[ $i ]->text_typography_font_family->weight );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo_medium->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->text_font_typo_responsive->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height_unit_responsive );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_transform ) ) {
					$settings->hotspot_marker[ $i ]->text_font_typo->text_transform = $settings->hotspot_marker[ $i ]->text_typography_transform;
					unset( $settings->hotspot_marker[ $i ]->text_typography_transform );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_letter_spacing ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo->letter_spacing = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->text_typography_letter_spacing );
				}
				if ( ! isset( $settings->hotspot_marker[ $i ]->tooltip_font_typo ) || ! is_object( $settings->hotspot_marker[ $i ]->tooltip_font_typo ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo            = new stdClass();
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium     = new stdClass();
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size_unit,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size_unit_responsive );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family ) ) {

					if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family->family ) ) {

						$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_family = $settings->hotspot_marker[ $i ]->tooltip_font_family->family;
						unset( $settings->hotspot_marker[ $i ]->tooltip_font_family->family );
					}
					if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family->weight ) ) {

						if ( 'regular' === $settings->hotspot_marker[ $i ]->tooltip_font_family->weight ) {
							$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_weight = 'normal';
						} else {
							$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_weight = $settings->hotspot_marker[ $i ]->tooltip_font_family->weight;
						}
						unset( $settings->hotspot_marker[ $i ]->tooltip_font_family->weight );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_line_height_unit,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive->line_height = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive,
						'unit'   => 'em',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height_unit_responsive );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_transform ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo->text_transform = $settings->hotspot_marker[ $i ]->tooltip_transform;
					unset( $settings->hotspot_marker[ $i ]->tooltip_transform );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_letter_spacing ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo->letter_spacing = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->hotspot_marker[ $i ]->tooltip_letter_spacing );
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			$count_marker = count( $settings->hotspot_marker );

			for ( $i = 0; $i < $count_marker; $i++ ) {
				if ( ! isset( $settings->hotspot_marker[ $i ]->text_font_typo ) || ! is_object( $settings->hotspot_marker[ $i ]->text_font_typo ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo            = new stdClass();
					$settings->hotspot_marker[ $i ]->text_font_typo_medium     = new stdClass();
					$settings->hotspot_marker[ $i ]->text_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family ) ) {

					if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family->family ) ) {

						$settings->hotspot_marker[ $i ]->text_font_typo->font_family = $settings->hotspot_marker[ $i ]->text_typography_font_family->family;
						unset( $settings->hotspot_marker[ $i ]->text_typography_font_family->family );
					}
					if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_family->weight ) ) {

						if ( 'regular' === $settings->hotspot_marker[ $i ]->text_typography_font_family->weight ) {
							$settings->hotspot_marker[ $i ]->text_font_typo->font_weight = 'normal';
						} else {
							$settings->hotspot_marker[ $i ]->text_font_typo->font_weight = $settings->hotspot_marker[ $i ]->text_typography_font_family->weight;
						}
						unset( $settings->hotspot_marker[ $i ]->text_typography_font_family->weight );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) ) {

					$settings->hotspot_marker[ $i ]->text_font_typo->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) ) {
					$settings->hotspot_marker[ $i ]->text_font_typo_medium->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) ) {
					$settings->hotspot_marker[ $i ]->text_font_typo_responsive->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->text_typography_font_size->small,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) && 0 !== $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) ) {
						$settings->hotspot_marker[ $i ]->text_font_typo->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop / $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) && 0 !== $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) ) {
						$settings->hotspot_marker[ $i ]->text_font_typo_medium->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium / $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->small ) && isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) && 0 !== $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->text_typography_line_height->small ) && is_numeric( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) ) {
						$settings->hotspot_marker[ $i ]->text_font_typo_responsive->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->text_typography_line_height->small / $settings->hotspot_marker[ $i ]->text_typography_font_size->small ),
							'unit'   => 'em',
						);
					}
				}
				if ( ! isset( $settings->hotspot_marker[ $i ]->tooltip_font_typo ) || ! is_object( $settings->hotspot_marker[ $i ]->tooltip_font_typo ) ) {

					$settings->hotspot_marker[ $i ]->tooltip_font_typo            = new stdClass();
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium     = new stdClass();
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive = new stdClass();
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family ) ) {

					if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family->family ) ) {

						$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_family = $settings->hotspot_marker[ $i ]->tooltip_font_family->family;
						unset( $settings->hotspot_marker[ $i ]->tooltip_font_family->family );
					}
					if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_family->weight ) ) {

						if ( 'regular' === $settings->hotspot_marker[ $i ]->tooltip_font_family->weight ) {
							$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_weight = 'normal';
						} else {
							$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_weight = $settings->hotspot_marker[ $i ]->tooltip_font_family->weight;
						}
						unset( $settings->hotspot_marker[ $i ]->tooltip_font_family->weight );
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size->medium,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) ) {
					$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive->font_size = (object) array(
						'length' => $settings->hotspot_marker[ $i ]->tooltip_font_size->small,
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) && 0 !== $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_font_typo->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop / $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) && 0 !== $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_font_typo_medium->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium / $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->small ) && isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) && 0 !== $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) {
					if ( is_numeric( $settings->hotspot_marker[ $i ]->tooltip_line_height->small ) && is_numeric( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) ) {
						$settings->hotspot_marker[ $i ]->tooltip_font_typo_responsive->line_height = (object) array(
							'length' => round( $settings->hotspot_marker[ $i ]->tooltip_line_height->small / $settings->hotspot_marker[ $i ]->tooltip_font_size->small ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_padding ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->hotspot_marker[ $i ]->tooltip_padding );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}

					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top    = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left   = '';
					$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right  = '';

					$count = count( $output );
					for ( $j = 0; $j < $count; $j++ ) {

						switch ( $output[ $j ][0] ) {
							case 'padding-top':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-bottom':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-right':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-left':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding':
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_top    = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_left   = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->tooltip_padding_dimension_right  = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
						}
					}
					unset( $settings->hotspot_marker[ $i ]->tooltip_padding );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_padding ) ) {

					$value = '';
					$value = str_replace( 'px', '', $settings->hotspot_marker[ $i ]->text_typography_padding );

					$output       = array();
					$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

					foreach ( $uabb_default as $val ) {
						$new      = explode( ':', $val );
						$output[] = $new;
					}

					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top    = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left   = '';
					$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right  = '';

					$count = count( $output );
					for ( $j = 0; $j < $count; $j++ ) {

						switch ( $output[ $j ][0] ) {
							case 'padding-top':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-bottom':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-right':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding-left':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
							case 'padding':
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_top    = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_bottom = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_left   = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								$settings->hotspot_marker[ $i ]->text_typography_padding_dimension_right  = ( ! empty( $output[ $j ][1] ) ) ? (int) $output[ $j ][1] : '0';
								break;
						}
					}
					unset( $settings->hotspot_marker[ $i ]->text_typography_padding );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size->desktop );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size->medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_font_size->small );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height->desktop );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height->medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->text_typography_line_height->small ) ) {
					unset( $settings->hotspot_marker[ $i ]->text_typography_line_height->small );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size->desktop );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size->medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_font_size->small );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height->desktop );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height->medium );
				}
				if ( isset( $settings->hotspot_marker[ $i ]->tooltip_line_height->small ) ) {
					unset( $settings->hotspot_marker[ $i ]->tooltip_line_height->small );
				}
			}
		}
		return $settings;
	}
	/**
	 * Function that gets icons for the module
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the mddule.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-hotspot/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-hotspot/icon/' . $icon );
		}
		return '';
	}
	/**
	 * Function that renders the button for the button
	 *
	 * @method render_button
	 */
	public function render_button() {
		if ( '' !== $this->settings->button ) {
			FLBuilder::render_module_html( 'uabb-button', $this->settings->button );
		}
	}

	/**
	 * Function that renders animation
	 *
	 * @method render_animation
	 * @param object $obj {object}.
	 */
	public function render_animation( $obj ) {

		$color = UABB_Helper::uabb_colorpicker( $obj, 'animation_color' );
		$color = uabb_theme_base_color( $color );
		?>
		<div class="uabb-hspot-sonar">
			<svg class="uabb-sonar" viewBox="-25 -25 50 50">
				<g>
					<circle cx="0" cy="0" r="8px" fill="none" stroke="<?php echo esc_attr( $color ); ?>" stroke-opacity="0.5" stroke-width="1" vector-effect="non-scaling-stroke"></circle>
				</g>
				<g>
					<circle cx="0" cy="0" r="8px" fill="none" stroke="<?php echo esc_attr( $color ); ?>" stroke-opacity="0.5" stroke-width="1" vector-effect="non-scaling-stroke"></circle>
				</g>
				<g>
					<circle cx="0" cy="0" r="8px" fill="none" stroke="<?php echo esc_attr( $color ); ?>" stroke-opacity="0.5" stroke-width="1" vector-effect="non-scaling-stroke"></circle>
				</g>
				<g>
					<circle cx="0" cy="0" r="8px" fill="none" stroke="<?php echo esc_attr( $color ); ?>" stroke-opacity="0.5" stroke-width="1" vector-effect="non-scaling-stroke"></circle>
				</g>
			</svg>
		</div>
		<?php
	}


	/**
	 * Function that renders Image icon
	 *
	 * @method render_image_icon
	 * @param var $i variable to get the icon.
	 */
	public function render_image_icon( $i ) {

		if ( 'text' !== $this->settings->hotspot_marker[ $i ]->hotspot_marker_type ) {
			$img_icon_array = array(
				/* General Section */
				'image_type'            => $this->settings->hotspot_marker[ $i ]->hotspot_marker_type,

				/* Icon Basics */
				'icon'                  => $this->settings->hotspot_marker[ $i ]->icon,
				'icon_size'             => $this->settings->hotspot_marker[ $i ]->icon_size,
				'icon_align'            => '',

				/* Image Basics */
				'photo_source'          => $this->settings->hotspot_marker[ $i ]->photo_source,
				'photo'                 => $this->settings->hotspot_marker[ $i ]->photo,
				'photo_url'             => $this->settings->hotspot_marker[ $i ]->photo_url,
				'img_size'              => $this->settings->hotspot_marker[ $i ]->img_size,
				'img_align'             => '',
				'photo_src'             => ( isset( $this->settings->hotspot_marker[ $i ]->photo_src ) ) ? $this->settings->hotspot_marker[ $i ]->photo_src : '',

				/* Icon Style */
				'icon_style'            => $this->settings->hotspot_marker[ $i ]->icon_style,
				'icon_bg_size'          => $this->settings->hotspot_marker[ $i ]->icon_bg_size,
				'icon_border_style'     => $this->settings->hotspot_marker[ $i ]->icon_border_style,
				'icon_border_width'     => $this->settings->hotspot_marker[ $i ]->icon_border_width,
				'icon_bg_border_radius' => $this->settings->hotspot_marker[ $i ]->icon_bg_border_radius,

				/* Image Style */
				'image_style'           => $this->settings->hotspot_marker[ $i ]->image_style,
				'img_bg_size'           => $this->settings->hotspot_marker[ $i ]->img_bg_size,
				'img_border_style'      => $this->settings->hotspot_marker[ $i ]->img_border_style,
				'img_border_width'      => $this->settings->hotspot_marker[ $i ]->img_border_width,
				'img_bg_border_radius'  => $this->settings->hotspot_marker[ $i ]->img_bg_border_radius,
			);
			echo '<div class="uabb-hotspot-wrap">';
			FLBuilder::render_module_html( 'image-icon', $img_icon_array );
			echo ( 'yes' === $this->settings->hotspot_marker[ $i ]->show_animation ) ? wp_kses_post( $this->render_animation( $this->settings->hotspot_marker[ $i ] ) ) : '';
			echo ( 'always' === $this->settings->hotspot_marker[ $i ]->show_animation ) ? wp_kses_post( $this->render_animation( $this->settings->hotspot_marker[ $i ] ) ) : '';
			echo '</div>';
		} else {
			echo '<div class="uabb-hotspot-text uabb-hotspot-wrap uabb-text-editor">' . $this->settings->hotspot_marker[ $i ]->marker_text . '</div>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

	}

	/**
	 * Get image data
	 *
	 * @since 1.13.0
	 * @return array image data.
	 */
	public function get_image_data() {

		if ( empty( $this->data ) ) {

			// Photo source is set to "url".
			if ( 'url' === $this->settings->photo_source ) {
				$this->data = new stdClass();
			} elseif ( is_object( $this->settings->photo ) ) {
				$this->data = $this->settings->photo;
			} else {
				$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->photo );
			}

			// Data object is empty, use the settings cache.
			if ( ! $this->data && isset( $this->settings->data ) ) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * Get image alt
	 *
	 * @since 1.13.0
	 * @return array image data.
	 */
	public function get_image_details() {

		$photo = $this->get_image_data();
		if ( ! empty( $photo->alt ) ) {
			return esc_html( $photo->alt );
		} elseif ( ! empty( $photo->description ) ) {
			return esc_html( $photo->description );
		} elseif ( ! empty( $photo->caption ) ) {
			return esc_html( $photo->caption );
		} elseif ( ! empty( $photo->title ) ) {
			return esc_html( $photo->title );
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-hotspot/uabb-hotspot-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-hotspot/uabb-hotspot-bb-less-than-2-2-compatibility.php';
}

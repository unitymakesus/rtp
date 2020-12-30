<?php
/**
 *  UABB Before After Slider  Module file
 *
 *  @package UABB Before After Slider Module
 */

/**
 * Function that initializes UABB Countdown Module
 *
 * @class UABBCountdownModule
 */
class UABBBeforeaftersliderModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Countdown Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Before After Slider', 'uabb' ),
				'description'     => __( 'An animated before after slider area.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$extra_additions ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-beforeafterslider/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-beforeafterslider/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'slides.svg',
			)
		);
		$this->add_css( 'baslider-twentytwenty', $this->url . 'css/twentytwenty.css' );
		$this->add_js( 'baslider-move', $this->url . 'js/jquery.event.move.js', array(), '', true );
		$this->add_js( 'baslider-plug', $this->url . 'js/jquery.twentytwenty.js', array(), '', true );
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

			// Handle opacity color field.
			$helper->handle_opacity_inputs( $settings, 'handle_back_overlay_opc', 'handle_back_overlay' );

			if ( ! isset( $settings->slider_typo ) || ! is_array( $settings->slider_typo ) ) {

				$settings->slider_typo            = array();
				$settings->slider_typo_medium     = array();
				$settings->slider_typo_responsive = array();
			}
			if ( isset( $settings->slider_font_family ) ) {

				if ( isset( $settings->slider_font_family['family'] ) ) {

					$settings->slider_typo['font_family'] = $settings->slider_font_family['family'];
					unset( $settings->slider_font_family['family'] );
				}
				if ( isset( $settings->slider_font_family['weight'] ) ) {

					if ( 'regular' === $settings->slider_font_family['weight'] ) {
						$settings->slider_typo['font_weight'] = 'normal';
					} else {
						$settings->slider_typo['font_weight'] = $settings->slider_font_family['weight'];
					}
					unset( $settings->slider_font_family['weight'] );
				}
			}
			if ( isset( $settings->slider_font_size_unit ) ) {
				$settings->slider_typo['font_size'] = array(
					'length' => $settings->slider_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->slider_font_size_unit );
			}
			if ( isset( $settings->slider_font_size_unit_medium ) ) {
				$settings->slider_typo_medium['font_size'] = array(
					'length' => $settings->slider_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->slider_font_size_unit_medium );
			}
			if ( isset( $settings->slider_font_size_unit_responsive ) ) {
				$settings->slider_typo_responsive['font_size'] = array(
					'length' => $settings->slider_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->slider_font_size_unit_responsive );
			}
			if ( isset( $settings->slider_line_height_unit ) ) {

				$settings->slider_typo['line_height'] = array(
					'length' => $settings->slider_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->slider_line_height_unit );
			}
			if ( isset( $settings->slider_line_height_unit_medium ) ) {
				$settings->slider_typo_medium['line_height'] = array(
					'length' => $settings->slider_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->slider_line_height_unit_medium );
			}
			if ( isset( $settings->slider_line_height_unit_responsive ) ) {
				$settings->slider_typo_responsive['line_height'] = array(
					'length' => $settings->slider_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->slider_line_height_unit_responsive );
			}
			if ( isset( $settings->slider_transform ) ) {
				$settings->slider_typo['text_transform'] = $settings->slider_transform;
				unset( $settings->slider_transform );
			}
			if ( isset( $settings->slider_label_letter_spacing ) ) {
				$settings->slider_typo['letter_spacing'] = array(
					'length' => $settings->slider_label_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->slider_label_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Handle opacity color field.
			$helper->handle_opacity_inputs( $settings, 'handle_back_overlay_opc', 'handle_back_overlay' );

			// For Before After Text and Styling fields.
			if ( ! isset( $settings->slider_typo ) || ! is_array( $settings->slider_typo ) ) {

				$settings->slider_typo            = array();
				$settings->slider_typo_medium     = array();
				$settings->slider_typo_responsive = array();
			}
			if ( isset( $settings->slider_font_family ) ) {

				if ( isset( $settings->slider_font_family['family'] ) ) {

					$settings->slider_typo['font_family'] = $settings->slider_font_family['family'];
					unset( $settings->slider_font_family['family'] );
				}
				if ( isset( $settings->slider_font_family['weight'] ) ) {

					if ( 'regular' === $settings->slider_font_family['weight'] ) {
						$settings->slider_typo['font_weight'] = 'normal';
					} else {
						$settings->slider_typo['font_weight'] = $settings->slider_font_family['weight'];
					}
					unset( $settings->slider_font_family['weight'] );
				}
			}
			if ( isset( $settings->slider_font_size_unit ) ) {
				if ( isset( $settings->slider_font_size['small'] ) ) {
					$settings->slider_typo_responsive['font_size'] = array(
						'length' => $settings->slider_font_size['small'],
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->slider_font_size['medium'] ) ) {
					$settings->slider_typo_medium['font_size'] = array(
						'length' => $settings->slider_font_size['medium'],
						'unit'   => 'px',
					);
				}
				if ( isset( $settings->slider_font_size['desktop'] ) ) {
					$settings->slider_typo['font_size'] = array(
						'length' => $settings->slider_font_size['desktop'],
						'unit'   => 'px',
					);
				}
			}
			if ( isset( $settings->slider_line_height_unit ) ) {
				if ( isset( $settings->slider_line_height['small'] ) && isset( $settings->slider_font_size['small'] ) && 0 !== $settings->slider_font_size['small'] ) {
					if ( is_numeric( $settings->slider_line_height['small'] ) && is_numeric( $settings->slider_font_size['small'] ) ) {
						$settings->slider_typo['line_height'] = array(
							'length' => round( $settings->slider_line_height['small'] / $settings->slider_font_size['small'], 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->slider_line_height['medium'] ) && isset( $settings->slider_font_size['medium'] ) && 0 !== $settings->slider_font_size['medium'] ) {
					if ( is_numeric( $settings->slider_line_height['medium'] ) && is_numeric( $settings->slider_font_size['medium'] ) ) {
						$settings->slider_typo_medium['line_height'] = array(
							'length' => round( $settings->slider_line_height['medium'] / $settings->slider_font_size['medium'], 2 ),
							'unit'   => 'em',
						);
					}
				}
				if ( isset( $settings->slider_line_height['desktop'] ) && isset( $settings->slider_font_size['desktop'] ) && 0 !== $settings->slider_font_size['desktop'] ) {
					if ( is_numeric( $settings->slider_line_height['desktop'] ) && is_numeric( $settings->slider_font_size['desktop'] ) ) {
						$settings->slider_typo['line_height'] = array(
							'length' => round( $settings->slider_line_height['desktop'] / $settings->slider_font_size['desktop'], 2 ),
							'unit'   => 'em',
						);
					}
				}
			}
			// Unset the old values.
			if ( isset( $settings->slider_font_size['desktop'] ) ) {
				unset( $settings->slider_font_size['desktop'] );
			}
			if ( isset( $settings->slider_font_size['medium'] ) ) {
				unset( $settings->slider_font_size['medium'] );
			}
			if ( isset( $settings->slider_font_size['small'] ) ) {
				unset( $settings->slider_font_size['small'] );
			}
			if ( isset( $settings->slider_line_height['desktop'] ) ) {
				unset( $settings->slider_line_height['desktop'] );
			}
			if ( isset( $settings->slider_line_height['medium'] ) ) {
				unset( $settings->slider_line_height['medium'] );
			}
			if ( isset( $settings->slider_line_height['small'] ) ) {
				unset( $settings->slider_line_height['small'] );
			}
		}
		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-beforeafterslider/uabb-beforeafterslider-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-beforeafterslider/uabb-beforeafterslider-bb-less-than-2-2-compatibility.php';
}

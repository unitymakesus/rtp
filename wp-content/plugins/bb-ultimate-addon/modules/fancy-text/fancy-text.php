<?php
/**
 *  UABB Fancy Text Module file
 *
 *  @package UABB Fancy Text Module
 */

/**
 * Function that initializes UABB Fancy Text Module
 *
 * @class UABBFancyTextModule
 */
class UABBFancyTextModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Fancy Text Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Fancy Text', 'uabb' ),
				'description'     => __( 'Awesome Animation Text.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/fancy-text/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/fancy-text/',
				'partial_refresh' => true,
				'icon'            => 'text.svg',

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
			/* Backward for Static Text */
			if ( ! isset( $settings->static_text_typo ) || ! is_array( $settings->static_text_typo ) ) {

				$settings->static_text_typo            = array();
				$settings->static_text_typo_medium     = array();
				$settings->static_text_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->static_text_typo['font_weight'] = 'normal';
					} else {
						$settings->static_text_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->static_text_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->static_text_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->static_text_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {
				$settings->static_text_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->static_text_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->static_text_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->static_text_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->static_text_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->static_text_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			/* Fancy Text */
			if ( ! isset( $settings->fancy_text_typo ) || ! is_array( $settings->fancy_text_typo ) ) {
				$settings->fancy_text_typo            = array();
				$settings->fancy_text_typo_medium     = array();
				$settings->fancy_text_typo_responsive = array();
			}
			if ( isset( $settings->fancy_font_family ) ) {
				if ( isset( $settings->fancy_font_family['weight'] ) ) {
					if ( 'regular' === $settings->fancy_font_family['weight'] ) {
						$settings->fancy_text_typo['font_weight'] = 'normal';
					} else {
						$settings->fancy_text_typo['font_weight'] = $settings->fancy_font_family['weight'];
					}
					unset( $settings->fancy_font_family['weight'] );
				}
				if ( isset( $settings->fancy_font_family['family'] ) ) {
					$settings->fancy_text_typo['font_family'] = $settings->fancy_font_family['family'];
					unset( $settings->fancy_font_family['family'] );
				}
			}
			if ( isset( $settings->fancy_font_size_unit ) ) {

				$settings->fancy_text_typo['font_size'] = array(
					'length' => $settings->fancy_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->fancy_font_size_unit );
			}
			if ( isset( $settings->fancy_font_size_unit_medium ) ) {
				$settings->fancy_text_typo_medium['font_size'] = array(
					'length' => $settings->fancy_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->fancy_font_size_unit_medium );
			}
			if ( isset( $settings->fancy_font_size_unit_responsive ) ) {

				$settings->fancy_text_typo_responsive['font_size'] = array(
					'length' => $settings->fancy_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->fancy_font_size_unit_responsive );
			}
			if ( isset( $settings->fancy_line_height_unit ) ) {

				$settings->fancy_text_typo['line_height'] = array(
					'length' => $settings->fancy_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->fancy_line_height_unit );
			}
			if ( isset( $settings->fancy_line_height_unit_medium ) ) {

				$settings->fancy_text_typo_medium['line_height'] = array(
					'length' => $settings->fancy_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->fancy_line_height_unit_medium );
			}
			if ( isset( $settings->fancy_line_height_unit_responsive ) ) {
				$settings->fancy_text_typo_responsive['line_height'] = array(
					'length' => $settings->fancy_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->fancy_line_height_unit_responsive );
			}
			if ( isset( $settings->fancy_transform ) ) {
				$settings->fancy_text_typo['text_transform'] = $settings->fancy_transform;
				unset( $settings->fancy_transform );
			}
			if ( isset( $settings->fancy_letter_spacing ) ) {
				$settings->fancy_text_typo['letter_spacing'] = array(
					'length' => $settings->fancy_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->fancy_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {
			/* Backward for Static Text */
			if ( ! isset( $settings->static_text_typo ) || ! is_array( $settings->static_text_typo ) ) {

				$settings->static_text_typo            = array();
				$settings->static_text_typo_medium     = array();
				$settings->static_text_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->static_text_typo['font_weight'] = 'normal';
					} else {
						$settings->static_text_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->static_text_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				$settings->static_text_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				$settings->static_text_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) ) {
				$settings->static_text_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 !== $settings->font_size['desktop'] ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->static_text_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 !== $settings->font_size['medium'] ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->static_text_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 !== $settings->font_size['small'] ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->static_text_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			/* Fancy Text */
			if ( ! isset( $settings->fancy_text_typo ) || ! is_array( $settings->fancy_text_typo ) ) {
				$settings->fancy_text_typo            = array();
				$settings->fancy_text_typo_medium     = array();
				$settings->fancy_text_typo_responsive = array();
			}
			if ( isset( $settings->fancy_font_family ) ) {
				if ( isset( $settings->fancy_font_family['weight'] ) ) {
					if ( 'regular' === $settings->fancy_font_family['weight'] ) {
						$settings->fancy_text_typo['font_weight'] = 'normal';
					} else {
						$settings->fancy_text_typo['font_weight'] = $settings->fancy_font_family['weight'];
					}
					unset( $settings->fancy_font_family['weight'] );
				}
				if ( isset( $settings->fancy_font_family['family'] ) ) {
					$settings->fancy_text_typo['font_family'] = $settings->fancy_font_family['family'];
					unset( $settings->fancy_font_family['family'] );
				}
			}
			if ( isset( $settings->fancy_font_size['desktop'] ) ) {
				$settings->fancy_text_typo['font_size'] = array(
					'length' => $settings->fancy_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->fancy_font_size['medium'] ) ) {
				$settings->fancy_text_typo_medium['font_size'] = array(
					'length' => $settings->fancy_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->fancy_font_size['small'] ) ) {
				$settings->fancy_text_typo_responsive['font_size'] = array(
					'length' => $settings->fancy_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->fancy_line_height['desktop'] ) && isset( $settings->fancy_font_size['small'] ) && 0 !== $settings->fancy_font_size['desktop'] ) {
				if ( is_numeric( $settings->fancy_line_height['desktop'] ) && is_numeric( $settings->fancy_font_size['desktop'] ) ) {
					$settings->fancy_text_typo['line_height'] = array(
						'length' => round( $settings->fancy_line_height['desktop'] / $settings->fancy_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->fancy_line_height['medium'] ) && isset( $settings->fancy_font_size['medium'] ) && 0 !== $settings->fancy_font_size['medium'] ) {
				if ( is_numeric( $settings->fancy_line_height['medium'] ) && is_numeric( $settings->fancy_font_size['medium'] ) ) {
					$settings->fancy_text_typo_medium['line_height'] = array(
						'length' => round( $settings->fancy_line_height['medium'] / $settings->fancy_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->fancy_line_height['small'] ) && isset( $settings->fancy_font_size['small'] ) && 0 !== $settings->fancy_font_size['small'] ) {
				if ( is_numeric( $settings->fancy_line_height['small'] ) && is_numeric( $settings->fancy_font_size['small'] ) ) {
					$settings->fancy_text_typo_responsive['line_height'] = array(
						'length' => round( $settings->fancy_line_height['small'] / $settings->fancy_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				unset( $settings->font_size['desktop'] );
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				unset( $settings->font_size['medium'] );
			}
			if ( isset( $settings->font_size['small'] ) ) {
				unset( $settings->font_size['small'] );
			}
			if ( isset( $settings->line_height['desktop'] ) ) {
				unset( $settings->line_height['desktop'] );
			}
			if ( isset( $settings->line_height['medium'] ) ) {
				unset( $settings->line_height['medium'] );
			}
			if ( isset( $settings->line_height['small'] ) ) {
				unset( $settings->line_height['small'] );
			}
			if ( isset( $settings->fancy_font_size['desktop'] ) ) {
				unset( $settings->fancy_font_size['desktop'] );
			}
			if ( isset( $settings->fancy_font_size['medium'] ) ) {
				unset( $settings->fancy_font_size['medium'] );
			}
			if ( isset( $settings->fancy_font_size['small'] ) ) {
				unset( $settings->fancy_font_size['small'] );
			}
			if ( isset( $settings->fancy_line_height['desktop'] ) ) {
				unset( $settings->fancy_line_height['desktop'] );
			}
			if ( isset( $settings->fancy_line_height['medium'] ) ) {
				unset( $settings->fancy_line_height['medium'] );
			}
			if ( isset( $settings->fancy_line_height['small'] ) ) {
				unset( $settings->fancy_line_height['small'] );
			}
		}
		return $settings;
	}
	/**
	 * Function that enqueue's scripts
	 */
	public function enqueue_scripts() {
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
			$this->add_js( 'typed', $this->url . 'js/typed.js', array(), '', true );
			$this->add_js( 'vticker', $this->url . 'js/rvticker.js', array(), '', true );
		} else {
			if ( $this->settings && 'type' === $this->settings->effect_type ) {
				$this->add_js( 'typed', $this->url . 'js/typed.js', array(), '', true );
			}
			if ( $this->settings && 'slide_up' === $this->settings->effect_type ) {
				$this->add_js( 'vticker', $this->url . 'js/rvticker.js', array(), '', true );
			}
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/fancy-text/fancy-text-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/fancy-text/fancy-text-bb-less-than-2-2-compatibility.php';
}

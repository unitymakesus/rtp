<?php
/**
 *  UABB Advanced Testimonials file
 *
 *  @package Advanced Testimonials
 */

/**
 * Class for UABB Advanced Testimonials Module
 *
 * @class UABBAdvancedTestimonialsModule
 */
class UABBAdvancedTestimonialsModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Testimonials module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Testimonials', 'uabb' ),
				'description'     => __( 'An animated tesimonials area.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/adv-testimonials/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/adv-testimonials/',
				'partial_refresh' => true,
				'icon'            => 'format-quote.svg',
			)
		);

		$this->add_css( 'jquery-bxslider' );
		$this->add_css( 'font-awesome-5' );
		$this->add_js( 'jquery-bxslider' );
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

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			if ( ! isset( $settings->testimonial_heading_font_typo ) || ! is_array( $settings->testimonial_heading_font_typo ) ) {

				$settings->testimonial_heading_font_typo            = array();
				$settings->testimonial_heading_font_typo_medium     = array();
				$settings->testimonial_heading_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_heading_font_family ) ) {
				if ( isset( $settings->testimonial_heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_heading_font_family['weight'] ) {
						$settings->testimonial_heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_heading_font_typo['font_weight'] = $settings->testimonial_heading_font_family['weight'];
					}
					unset( $settings->testimonial_heading_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_heading_font_family['family'] ) ) {
					$settings->testimonial_heading_font_typo['font_family'] = $settings->testimonial_heading_font_family['family'];
					unset( $settings->testimonial_heading_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_heading_font_size_unit ) ) {

				$settings->testimonial_heading_font_typo['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_heading_font_size_unit );
			}
			if ( isset( $settings->testimonial_heading_font_size_unit_medium ) ) {

				$settings->testimonial_heading_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_heading_font_size_unit_medium );
			}
			if ( isset( $settings->testimonial_heading_font_size_unit_responsive ) ) {
				$settings->testimonial_heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_heading_font_size_unit_responsive );
			}
			if ( isset( $settings->testimonial_heading_line_height_unit ) ) {

				$settings->testimonial_heading_font_typo['line_height'] = array(
					'length' => $settings->testimonial_heading_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_heading_line_height_unit );
			}
			if ( isset( $settings->testimonial_heading_line_height_unit_medium ) ) {

				$settings->testimonial_heading_font_typo_medium['line_height'] = array(
					'length' => $settings->testimonial_heading_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_heading_line_height_unit_medium );
			}
			if ( isset( $settings->testimonial_heading_line_height_unit_responsive ) ) {
				$settings->testimonial_heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->testimonial_heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_heading_line_height_unit_responsive );
			}
			if ( isset( $settings->testimonial_transform ) ) {
				$settings->testimonial_heading_font_typo['text_transform'] = $settings->testimonial_transform;
				unset( $settings->testimonial_transform );
			}
			if ( isset( $settings->testimonial_letter_spacing ) ) {
				$settings->testimonial_heading_font_typo['letter_spacing'] = array(
					'length' => $settings->testimonial_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_letter_spacing );
			}
			if ( ! isset( $settings->testimonial_designation_font_typo ) || ! is_array( $settings->testimonial_designation_font_typo ) ) {

				$settings->testimonial_designation_font_typo            = array();
				$settings->testimonial_designation_font_typo_medium     = array();
				$settings->testimonial_designation_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_designation_font_family ) ) {
				if ( isset( $settings->testimonial_designation_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_designation_font_family['weight'] ) {
						$settings->testimonial_designation_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_designation_font_typo['font_weight'] = $settings->testimonial_designation_font_family['weight'];
					}
					unset( $settings->testimonial_designation_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_designation_font_family['family'] ) ) {
					$settings->testimonial_designation_font_typo['font_family'] = $settings->testimonial_designation_font_family['family'];
					unset( $settings->testimonial_designation_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_designation_font_size_unit ) ) {

				$settings->testimonial_designation_font_typo['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_designation_font_size_unit );

			}
			if ( isset( $settings->testimonial_designation_font_size_unit_medium ) ) {
				$settings->testimonial_designation_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_designation_font_size_unit_medium );
			}
			if ( isset( $settings->testimonial_designation_font_size_unit_responsive ) ) {
				$settings->testimonial_designation_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_designation_font_size_unit_responsive );
			}
			if ( isset( $settings->testimonial_designation_line_height_unit ) ) {

				$settings->testimonial_designation_font_typo['line_height'] = array(
					'length' => $settings->testimonial_designation_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_designation_line_height_unit );
			}
			if ( isset( $settings->testimonial_designation_line_height_unit_medium ) ) {

				$settings->testimonial_designation_font_typo_medium['line_height'] = array(
					'length' => $settings->testimonial_designation_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_designation_line_height_unit_medium );
			}
			if ( isset( $settings->testimonial_designation_line_height_unit_responsive ) ) {
				$settings->testimonial_designation_font_typo_responsive['line_height'] = array(
					'length' => $settings->testimonial_designation_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_designation_line_height_unit_responsive );
			}
			if ( isset( $settings->testimonial_designation_transform ) ) {
				$settings->testimonial_designation_font_typo['text_transform'] = $settings->testimonial_designation_transform;
				unset( $settings->testimonial_designation_transform );
			}
			if ( isset( $settings->testimonial_designation_letter_spacing ) ) {

				$settings->testimonial_designation_font_typo['letter_spacing'] = array(
					'length' => $settings->testimonial_designation_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_designation_letter_spacing );
			}
			if ( ! isset( $settings->testimonial_description_font_typo ) || ! is_array( $settings->testimonial_description_font_typo ) ) {

				$settings->testimonial_description_font_typo            = array();
				$settings->testimonial_description_font_typo_medium     = array();
				$settings->testimonial_description_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_description_opt_font_family ) ) {
				if ( isset( $settings->testimonial_description_opt_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_description_opt_font_family['weight'] ) {
						$settings->testimonial_description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_description_font_typo['font_weight'] = $settings->testimonial_description_opt_font_family['weight'];
					}
					unset( $settings->testimonial_description_opt_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_description_opt_font_family['family'] ) ) {
					$settings->testimonial_description_font_typo['font_family'] = $settings->testimonial_description_opt_font_family['family'];
					unset( $settings->testimonial_description_opt_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_description_opt_font_size_unit ) ) {

				$settings->testimonial_description_font_typo['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_description_opt_font_size_unit );
			}
			if ( isset( $settings->testimonial_description_opt_font_size_unit_medium ) ) {

				$settings->testimonial_description_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_description_opt_font_size_unit_medium );
			}
			if ( isset( $settings->testimonial_description_opt_font_size_unit_responsive ) ) {

				$settings->testimonial_description_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_description_opt_font_size_unit_responsive );
			}
			if ( isset( $settings->testimonial_description_opt_line_height_unit ) ) {

				$settings->testimonial_description_font_typo['line_height'] = array(
					'length' => $settings->testimonial_description_opt_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_description_opt_line_height_unit );
			}
			if ( isset( $settings->testimonial_description_opt_line_height_unit_medium ) ) {
				$settings->testimonial_description_font_typo_medium['line_height'] = array(
					'length' => $settings->testimonial_description_opt_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_description_opt_line_height_unit_medium );
			}
			if ( isset( $settings->testimonial_description_opt_line_height_unit_responsive ) ) {
				$settings->testimonial_description_font_typo_responsive['line_height'] = array(
					'length' => $settings->testimonial_description_opt_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->testimonial_description_opt_line_height_unit_responsive );
			}
			if ( isset( $settings->testimonial_description_transform ) ) {
				$settings->testimonial_description_font_typo['text_transform'] = $settings->testimonial_description_transform;
				unset( $settings->testimonial_description_transform );
			}
			if ( isset( $settings->testimonial_description_letter_spacing ) ) {
				$settings->testimonial_description_font_typo['letter_spacing'] = array(
					'length' => $settings->testimonial_description_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->testimonial_description_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {
			if ( ! isset( $settings->testimonial_heading_font_typo ) || ! is_array( $settings->testimonial_heading_font_typo ) ) {

				$settings->testimonial_heading_font_typo            = array();
				$settings->testimonial_heading_font_typo_medium     = array();
				$settings->testimonial_heading_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_heading_font_family ) ) {
				if ( isset( $settings->testimonial_heading_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_heading_font_family['weight'] ) {
						$settings->testimonial_heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_heading_font_typo['font_weight'] = $settings->testimonial_heading_font_family['weight'];
					}
					unset( $settings->testimonial_heading_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_heading_font_family['family'] ) ) {
					$settings->testimonial_heading_font_typo['font_family'] = $settings->testimonial_heading_font_family['family'];
					unset( $settings->testimonial_heading_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_heading_font_size['desktop'] ) ) {

				$settings->testimonial_heading_font_typo['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_heading_font_size['medium'] ) ) {
				$settings->testimonial_heading_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_heading_font_size['small'] ) ) {
				$settings->testimonial_heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_heading_line_height['desktop'] ) && isset( $settings->testimonial_heading_font_size['desktop'] ) && 0 != $settings->testimonial_heading_font_size['desktop'] ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['desktop'] ) && is_numeric( $settings->testimonial_heading_font_size['desktop'] ) ) {
					$settings->testimonial_heading_font_typo['line_height'] = array(
						'length' => round( $settings->testimonial_heading_line_height['desktop'] / $settings->testimonial_heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_heading_line_height['medium'] ) && isset( $settings->testimonial_heading_font_size['medium'] ) && 0 != $settings->testimonial_heading_font_size['medium'] ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['medium'] ) && is_numeric( $settings->testimonial_heading_font_size['medium'] ) ) {
					$settings->testimonial_heading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->testimonial_heading_line_height['medium'] / $settings->testimonial_heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_heading_line_height['small'] ) && isset( $settings->testimonial_heading_font_size['small'] ) && 0 != $settings->testimonial_heading_font_size['small'] ) {
				if ( is_numeric( $settings->testimonial_heading_line_height['small'] ) && is_numeric( $settings->testimonial_heading_font_size['small'] ) ) {
					$settings->testimonial_heading_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->testimonial_heading_line_height['small'] / $settings->testimonial_heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->testimonial_designation_font_typo ) || ! is_array( $settings->testimonial_designation_font_typo ) ) {

				$settings->testimonial_designation_font_typo            = array();
				$settings->testimonial_designation_font_typo_medium     = array();
				$settings->testimonial_designation_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_designation_font_family ) ) {
				if ( isset( $settings->testimonial_designation_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_designation_font_family['weight'] ) {
						$settings->testimonial_designation_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_designation_font_typo['font_weight'] = $settings->testimonial_designation_font_family['weight'];
					}
					unset( $settings->testimonial_designation_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_designation_font_family['family'] ) ) {
					$settings->testimonial_designation_font_typo['font_family'] = $settings->testimonial_designation_font_family['family'];
					unset( $settings->testimonial_designation_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_designation_font_size['desktop'] ) ) {

				$settings->testimonial_designation_font_typo['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_designation_font_size['medium'] ) ) {
				$settings->testimonial_designation_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_designation_font_size['small'] ) ) {
				$settings->testimonial_designation_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_designation_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_designation_line_height['desktop'] ) && isset( $settings->testimonial_designation_font_size['desktop'] ) && 0 != $settings->testimonial_designation_font_size['desktop'] ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['desktop'] ) && is_numeric( $settings->testimonial_designation_font_size['desktop'] ) ) {
					$settings->testimonial_designation_font_typo['line_height'] = array(
						'length' => round( $settings->testimonial_designation_line_height['desktop'] / $settings->testimonial_designation_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_designation_line_height['medium'] ) && isset( $settings->testimonial_designation_font_size['medium'] ) && 0 != $settings->testimonial_designation_font_size['medium'] ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['medium'] ) && is_numeric( $settings->testimonial_designation_font_size['medium'] ) ) {
					$settings->testimonial_designation_font_typo_medium['line_height'] = array(
						'length' => round( $settings->testimonial_designation_line_height['medium'] / $settings->testimonial_designation_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_designation_line_height['small'] ) && isset( $settings->testimonial_designation_font_size['small'] ) && 0 != $settings->testimonial_designation_font_size['small'] ) {
				if ( is_numeric( $settings->testimonial_designation_line_height['small'] ) && is_numeric( $settings->testimonial_designation_font_size['small'] ) ) {
					$settings->testimonial_designation_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->testimonial_designation_line_height['small'] / $settings->testimonial_designation_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->testimonial_description_font_typo ) || ! is_array( $settings->testimonial_description_font_typo ) ) {

				$settings->testimonial_description_font_typo            = array();
				$settings->testimonial_description_font_typo_medium     = array();
				$settings->testimonial_description_font_typo_responsive = array();
			}
			if ( isset( $settings->testimonial_description_opt_font_family ) ) {
				if ( isset( $settings->testimonial_description_opt_font_family['weight'] ) ) {
					if ( 'regular' == $settings->testimonial_description_opt_font_family['weight'] ) {
						$settings->testimonial_description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->testimonial_description_font_typo['font_weight'] = $settings->testimonial_description_opt_font_family['weight'];
					}
					unset( $settings->testimonial_description_opt_font_family['weight'] );
				}
				if ( isset( $settings->testimonial_description_opt_font_family['family'] ) ) {

					$settings->testimonial_description_font_typo['font_family'] = $settings->testimonial_description_opt_font_family['family'];
					unset( $settings->testimonial_description_opt_font_family['family'] );
				}
			}
			if ( isset( $settings->testimonial_description_opt_font_size['desktop'] ) ) {

				$settings->testimonial_description_font_typo['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_description_opt_font_size['medium'] ) ) {
				$settings->testimonial_description_font_typo_medium['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_description_opt_font_size['small'] ) ) {

				$settings->testimonial_description_font_typo_responsive['font_size'] = array(
					'length' => $settings->testimonial_description_opt_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->testimonial_description_opt_line_height['desktop'] ) && isset( $settings->testimonial_description_opt_font_size['desktop'] ) && 0 != $settings->testimonial_description_opt_font_size['desktop'] ) {
				if ( is_numeric( $settings->testimonial_description_opt_line_height['desktop'] ) && is_numeric( $settings->testimonial_description_opt_font_size['desktop'] ) ) {
					$settings->testimonial_description_font_typo['line_height'] = array(
						'length' => round( $settings->testimonial_description_opt_line_height['desktop'] / $settings->testimonial_description_opt_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_description_opt_line_height['medium'] ) && isset( $settings->testimonial_description_opt_font_size['medium'] ) && 0 != $settings->testimonial_description_opt_font_size['medium'] ) {

				if ( is_numeric( $settings->testimonial_description_opt_line_height['medium'] ) && is_numeric( $settings->testimonial_description_opt_font_size['medium'] ) ) {
					$settings->testimonial_description_font_typo_medium['line_height'] = array(
						'length' => round( $settings->testimonial_description_opt_line_height['medium'] / $settings->testimonial_description_opt_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->testimonial_description_opt_line_height['small'] ) && isset( $settings->testimonial_description_opt_font_size['small'] ) && 0 != $settings->testimonial_description_opt_font_size['small'] ) {
				if ( is_numeric( $settings->testimonial_description_opt_line_height['small'] ) && is_numeric( $settings->testimonial_description_opt_font_size['small'] ) ) {
					$settings->testimonial_description_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->testimonial_description_opt_line_height['small'] / $settings->testimonial_description_opt_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->rating_font_size['small'] ) ) {
				$settings->rating_font_size_unit_responsive = $settings->rating_font_size['small'];
			}
			if ( isset( $settings->rating_font_size['medium'] ) ) {
				$settings->rating_font_size_unit_medium = $settings->rating_font_size['medium'];
			}
			if ( isset( $settings->rating_font_size['desktop'] ) ) {
				$settings->rating_font_size_unit = $settings->rating_font_size['desktop'];
			}
			// unset condition.
			if ( isset( $settings->testimonial_heading_font_size['desktop'] ) ) {
				unset( $settings->testimonial_heading_font_size['desktop'] );
			}
			if ( isset( $settings->testimonial_heading_font_size['medium'] ) ) {
				unset( $settings->testimonial_heading_font_size['medium'] );
			}
			if ( isset( $settings->testimonial_heading_font_size['small'] ) ) {
				unset( $settings->testimonial_heading_font_size['small'] );
			}
			if ( isset( $settings->testimonial_heading_line_height['desktop'] ) ) {
				unset( $settings->testimonial_heading_line_height['desktop'] );
			}
			if ( isset( $settings->testimonial_heading_line_height['medium'] ) ) {
				unset( $settings->testimonial_heading_line_height['medium'] );
			}
			if ( isset( $settings->testimonial_heading_line_height['small'] ) ) {
				unset( $settings->testimonial_heading_line_height['small'] );
			}
			if ( isset( $settings->testimonial_designation_font_size['desktop'] ) ) {
				unset( $settings->testimonial_designation_font_size['desktop'] );
			}
			if ( isset( $settings->testimonial_designation_font_size['medium'] ) ) {
				unset( $settings->testimonial_designation_font_size['medium'] );
			}
			if ( isset( $settings->testimonial_designation_font_size['small'] ) ) {
				unset( $settings->testimonial_designation_font_size['small'] );
			}
			if ( isset( $settings->testimonial_designation_line_height['desktop'] ) ) {
				unset( $settings->testimonial_designation_line_height['desktop'] );
			}
			if ( isset( $settings->testimonial_designation_line_height['medium'] ) ) {
				unset( $settings->testimonial_designation_line_height['medium'] );
			}
			if ( isset( $settings->testimonial_designation_line_height['small'] ) ) {
				unset( $settings->testimonial_designation_line_height['small'] );
			}
			if ( isset( $settings->testimonial_description_opt_font_size['desktop'] ) ) {
				unset( $settings->testimonial_description_opt_font_size['desktop'] );
			}
			if ( isset( $settings->testimonial_description_opt_font_size['medium'] ) ) {
				unset( $settings->testimonial_description_opt_font_size['medium'] );
			}
			if ( isset( $settings->testimonial_description_opt_font_size['small'] ) ) {
				unset( $settings->testimonial_description_opt_font_size['small'] );
			}
			if ( isset( $settings->testimonial_description_opt_line_height['desktop'] ) ) {
				unset( $settings->testimonial_description_opt_line_height['desktop'] );
			}
			if ( isset( $settings->testimonial_description_opt_line_height['medium'] ) ) {
				unset( $settings->testimonial_description_opt_line_height['medium'] );
			}
			if ( isset( $settings->testimonial_description_opt_line_height['small'] ) ) {
				unset( $settings->testimonial_description_opt_line_height['small'] );
			}
			if ( isset( $settings->rating_font_size['desktop'] ) ) {
				unset( $settings->rating_font_size['desktop'] );
			}
			if ( isset( $settings->rating_font_size['medium'] ) ) {
				unset( $settings->rating_font_size['medium'] );
			}
			if ( isset( $settings->rating_font_size['small'] ) ) {
				unset( $settings->rating_font_size['small'] );
			}
		}
		return $settings;
	}
	/**
	 * Function that renders extensions for the UABB
	 *
	 * @since x.x.x
	 * @param string $rating an string to get the ratings.
	 */
	public function render_ratings( $rating ) {

		$rating_icon = apply_filters( 'uabb_testimonial_rating_icon', 'fa-star' );

		if ( 'none' != $rating ) {
			$output  = '<div class="uabb-rating">
                            <div class="uabb-rating__wrap">
                              <input class="uabb-rating__input';
			$output .= ( 5 == $rating ) ? ' uabb-checked ' : '';
			$output .= '" type="radio" value="5">
                  <label class="uabb-rating__ico far ' . $rating_icon . '" title="5 out of 5 stars"></label>
                  <input class="uabb-rating__input';
			$output .= ( 4 == $rating ) ? ' uabb-checked ' : '';
			$output .= '" type="radio" value="4">
                  <label class="uabb-rating__ico far ' . $rating_icon . '" title="4 out of 5 stars"></label>
                  <input class="uabb-rating__input';
			$output .= ( 3 == $rating ) ? ' uabb-checked ' : '';
			$output .= '" type="radio" value="3">
                  <label class="uabb-rating__ico far ' . $rating_icon . '" title="3 out of 5 stars"></label>
                  <input class="uabb-rating__input';
			$output .= ( 2 == $rating ) ? ' uabb-checked ' : '';
			$output .= '" type="radio" value="2">
                  <label class="uabb-rating__ico far ' . $rating_icon . '" title="2 out of 5 stars"></label>
                  <input class="uabb-rating__input';
			$output .= ( 1 == $rating ) ? ' uabb-checked ' : '';
			$output .= '" type="radio" value="1">
                  <label class="uabb-rating__ico far ' . $rating_icon . '" title="1 out of 5 stars"></label>
                </div>
              </div>';

			echo $output;
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/adv-testimonials/adv-testimonials-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/adv-testimonials/adv-testimonials-bb-less-than-2-2-compatibility.php';
}

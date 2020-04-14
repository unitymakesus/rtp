<?php
/**
 *  UABB Interactive Banner 2 Module file
 *
 *  @package UABB Interactive Banner 2 Module
 */

/**
 * Function that initializes Interactive Banner 2 Module
 *
 * @class InteractiveBanner2Module
 */
class InteractiveBanner2Module extends FLBuilderModule {

	/**
	 * Variable for Interactive Banner 2 module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = null;

	/**
	 * Constructor function that constructs default values for the Interactive Banner 2 Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Interactive Banner 2', 'uabb' ),
				'description'     => __( 'Interactive Banner 2', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/interactive-banner-2/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'ib-2.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the Interactive Banner 2
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/icon/' . $icon );
		}
		return '';
	}


	/**
	 * Function that gets the data for the Interactive Banner 2 module
	 *
	 * @method get_data
	 */
	public function get_data() {
		// Make sure we have a banner_image_src property.
		if ( ! isset( $this->settings->banner_image_src ) ) {
			$this->settings->banner_image_src = '';
		}

		// Cache the attachment data.
		$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->banner_image );
		if ( ! $this->data ) {

			// Photo source is set to "library".
			if ( is_object( $this->settings->banner_image_src ) ) {
				$this->data = $this->settings->banner_image_src;
			} else {
				$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->banner_image_src );
			}

			// Data object is empty, use the settings cache.
			if ( ! $this->data && isset( $this->settings->data ) ) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * Function that gets the alt for the Interactive Banner 2 module
	 *
	 * @method get_alt
	 */
	public function get_alt() {
		$photo = $this->get_data();
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

			// Link hadling.
			if ( isset( $settings->link_target ) ) {
				$settings->link_url_target = $settings->link_target;
				unset( $settings->link_target );
			}

			// Handle opacity settings.
			$helper->handle_opacity_inputs( $settings, 'img_background_color_opc', 'img_background_color' );
			$helper->handle_opacity_inputs( $settings, 'img_overlay_color_opc', 'img_overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'title_background_color_opc', 'title_background_color' );

			// Compatibility for title typography settings.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {
				if ( isset( $settings->title_typography_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_typography_font_size_unit ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit );
			}
			if ( isset( $settings->title_typography_font_size_unit_medium ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_medium );
			}
			if ( isset( $settings->title_typography_font_size_unit_responsive ) ) {

				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->title_typography_line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit );
			}
			if ( isset( $settings->title_typography_line_height_unit_medium ) ) {

				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_medium );
			}
			if ( isset( $settings->title_typography_line_height_unit_responsive ) ) {

				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->title_typography_transform ) ) {
				$settings->title_font_typo['text_transform'] = $settings->title_typography_transform;
				unset( $settings->title_typography_transform );
			}
			if ( isset( $settings->title_typography_letter_spacing ) ) {
				$settings->title_font_typo['letter_spacing'] = array(
					'length' => $settings->title_typography_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->title_typography_letter_spacing );
			}
			// Compatibility for description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) ) {
				if ( isset( $settings->desc_typography_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
				}
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_typography_font_size_unit ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit );
			}
			if ( isset( $settings->desc_typography_font_size_unit_medium ) ) {

				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit_medium );
			}
			if ( isset( $settings->desc_typography_font_size_unit_responsive ) ) {

				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_typography_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit );
			}
			if ( isset( $settings->desc_typography_line_height_unit_medium ) ) {

				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit_medium );
			}
			if ( isset( $settings->desc_typography_line_height_unit_responsive ) ) {

				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->desc_typography_transform ) ) {
				$settings->desc_font_typo['text_transform'] = $settings->desc_typography_transform;
				unset( $settings->desc_typography_transform );
			}
			if ( isset( $settings->desc_typography_letter_spacing ) ) {
				$settings->desc_font_typo['letter_spacing'] = array(
					'length' => $settings->desc_typography_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_typography_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Link hadling.
			if ( isset( $settings->link_target ) ) {
				$settings->link_url_target = $settings->link_target;
				unset( $settings->link_target );
			}

			// Handle opacity settings.
			$helper->handle_opacity_inputs( $settings, 'img_background_color_opc', 'img_background_color' );
			$helper->handle_opacity_inputs( $settings, 'img_overlay_color_opc', 'img_overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'title_background_color_opc', 'title_background_color' );

			// For title typography settings.
			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) && '' !== $settings->title_typography_font_family ) {

				if ( isset( $settings->title_typography_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->title_typography_font_size['small'] ) && ! isset( $settings->title_font_typo_responsive['font_size'] ) ) {

				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) && ! isset( $settings->title_font_typo_medium['font_size'] ) ) {

				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) && ! isset( $settings->title_font_typo['font_size'] ) ) {

				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 !== $settings->title_typography_font_size['desktop'] && ! isset( $settings->title_font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 !== $settings->title_typography_font_size['medium'] && ! isset( $settings->title_font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 !== $settings->title_typography_font_size['small'] && ! isset( $settings->title_font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Unset the old values.
			if ( isset( $settings->title_typography_font_size['desktop'] ) ) {
				unset( $settings->title_typography_font_size['desktop'] );
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) ) {
				unset( $settings->title_typography_font_size['medium'] );
			}
			if ( isset( $settings->title_typography_font_size['small'] ) ) {
				unset( $settings->title_typography_font_size['small'] );
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) ) {
				unset( $settings->title_typography_line_height['desktop'] );
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) ) {
				unset( $settings->title_typography_line_height['medium'] );
			}
			if ( isset( $settings->title_typography_line_height['small'] ) ) {
				unset( $settings->title_typography_line_height['small'] );
			}
			// For description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) && '' !== $settings->desc_typography_font_family ) {

				if ( isset( $settings->desc_typography_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
				}
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_typography_font_size['small'] ) && ! isset( $settings->desc_font_typo_responsive['font_size'] ) ) {

				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) && ! isset( $settings->desc_font_typo_medium['font_size'] ) ) {

				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) && ! isset( $settings->desc_font_typo['font_size'] ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 !== $settings->desc_typography_font_size['desktop'] && ! isset( $settings->desc_font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 !== $settings->desc_typography_font_size['medium'] && ! isset( $settings->desc_font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 !== $settings->desc_typography_font_size['small'] && ! isset( $settings->desc_font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			// Unset the old values.
			if ( isset( $settings->desc_typography_font_size['desktop'] ) ) {
				unset( $settings->desc_typography_font_size['desktop'] );
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) ) {
				unset( $settings->desc_typography_font_size['medium'] );
			}
			if ( isset( $settings->desc_typography_font_size['small'] ) ) {
				unset( $settings->desc_typography_font_size['small'] );
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) ) {
				unset( $settings->desc_typography_line_height['desktop'] );
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) ) {
				unset( $settings->desc_typography_line_height['medium'] );
			}
			if ( isset( $settings->desc_typography_line_height['small'] ) ) {
				unset( $settings->desc_typography_line_height['small'] );
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/interactive-banner-2-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/interactive-banner-2/interactive-banner-2-bb-less-than-2-2-compatibility.php';
}

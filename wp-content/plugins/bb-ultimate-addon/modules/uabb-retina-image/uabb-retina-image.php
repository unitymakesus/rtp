<?php
/**
 *  UABB Retina Image Module file
 *
 *  @package UABB Retina Image Module
 */

/**
 * Function that initializes UABB Retina Image Module
 *
 * @class UABBRetinaImageModule
 */
class UABBRetinaImageModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Retina Image module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Retina Image', 'uabb' ),
				'description'     => __( 'Upload a photo or display one from the media library.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-retina-image/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-retina-image/',
				'partial_refresh' => true,
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'icon'            => 'retina-image.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the Retina Image module.
	 *
	 * @since 1.21.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-retina-image/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-retina-image/icon/' . $icon );
		}
		return '';
	}

	/**
	 * Function that gets link
	 *
	 * @since 1.21.0
	 * @method get_link
	 */
	public function get_link() {

		if ( 'url' === $this->settings->link_type ) {
			$link = $this->settings->link_url;
		} else {
			$link = '';
		}

		return $link;
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.21.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check = UABB_Compatibility::$version_bb_check;

		if ( $version_bb_check ) {
			// Compatibility for Caption typography settings.
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->font ) ) {

				if ( isset( $settings->font['family'] ) ) {

					$settings->font_typo['font_family'] = $settings->font['family'];
					unset( $settings->font['family'] );
				}
				if ( isset( $settings->font['weight'] ) ) {

					if ( 'regular' === $settings->font['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->font['weight'];
					}
					unset( $settings->font['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {
				$settings->font_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->font_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->font_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->font_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->font_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->font_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			// Link handling.
			if ( isset( $settings->link_target ) ) {
				$settings->link_url_target = $settings->link_target;
				unset( $settings->link_target );
			}
			if ( isset( $settings->link_nofollow ) ) {
				$settings->link_url_nofollow = ( '1' === $settings->link_nofollow ) ? 'yes' : '';
				unset( $settings->link_nofollow );
			}

			// Opacity.
			$helper->handle_opacity_inputs( $settings, 'style_bg_color_opc', 'style_bg_color' );

			// For overall alignment and responsive alignment settings.
			if ( isset( $settings->align ) ) {
				$settings->align = $settings->align;
			}
			if ( isset( $settings->responsive_align ) ) {
				$settings->responsive_align = $settings->responsive_align;
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
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-retina-image/uabb-retina-image-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-retina-image/uabb-retina-image-bb-less-than-2-2-compatibility.php';
}

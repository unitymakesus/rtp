<?php
/**
 *  UABB iHover Module file
 *
 *  @package UABB iHover Module
 */

/**
 * Function that initializes iHover Module
 *
 * @class iHoverModule
 */
class iHoverModule extends FLBuilderModule { // @codingStandardsIgnoreLine.

	/**
	 * Constructor function that constructs default values for the iHover Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'iHover', 'uabb' ),
				'description'     => __( 'iHover', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/ihover/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/ihover/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'ihover.svg',
			)
		);

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

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {

						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
				if ( isset( $settings->title_typography_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
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
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) ) {
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
				if ( isset( $settings->desc_typography_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
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

			foreach ( $settings->ihover_item as $item ) {

				if ( isset( $item->border_color ) ) {

					$item->border_style_param = array();

					if ( isset( $item->border_style ) ) {
						$item->border_style_param['style'] = $item->border_style;
						unset( $item->border_style );
					}
					$item->border_style_param['color'] = ( '' === $item->border_color ) ? 'EFEFEF' : UABB_Helper::uabb_colorpicker( $item, 'border_color', true );
					if ( isset( $item->border_size ) ) {
						$item->border_style_param['width'] = array(
							'top'    => $item->border_size,
							'right'  => $item->border_size,
							'bottom' => $item->border_size,
							'left'   => $item->border_size,
						);
						unset( $item->border_size );
					}
					unset( $item->border_color );
				}
			}

			if ( isset( $settings->align ) ) {
				$settings->align_param = $settings->align;
				unset( $settings->align );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_typography_font_family ) ) {
				if ( isset( $settings->title_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->title_typography_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {

						$settings->title_font_typo['font_weight'] = $settings->title_typography_font_family['weight'];
					}
					unset( $settings->title_typography_font_family['weight'] );
				}
				if ( isset( $settings->title_typography_font_family['family'] ) ) {

					$settings->title_font_typo['font_family'] = $settings->title_typography_font_family['family'];
					unset( $settings->title_typography_font_family['family'] );
				}
			}
			if ( isset( $settings->title_typography_font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['medium'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_typography_line_height['desktop'] ) && isset( $settings->title_typography_font_size['desktop'] ) && 0 !== $settings->title_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_typography_line_height['desktop'] ) && is_numeric( $settings->title_typography_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['desktop'] / $settings->title_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['medium'] ) && isset( $settings->title_typography_font_size['medium'] ) && 0 !== $settings->title_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->title_typography_line_height['medium'] ) && is_numeric( $settings->title_typography_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['medium'] / $settings->title_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_typography_line_height['small'] ) && isset( $settings->title_typography_font_size['small'] ) && 0 !== $settings->title_typography_font_size['small'] ) {
				if ( is_numeric( $settings->title_typography_line_height['small'] ) && is_numeric( $settings->title_typography_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_typography_line_height['small'] / $settings->title_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_typography_font_family ) ) {
				if ( isset( $settings->desc_typography_font_family['weight'] ) ) {
					if ( 'regular' === $settings->desc_typography_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_typography_font_family['weight'];
					}
					unset( $settings->desc_typography_font_family['weight'] );
				}
				if ( isset( $settings->desc_typography_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_typography_font_family['family'];
					unset( $settings->desc_typography_font_family['family'] );
				}
			}
			if ( isset( $settings->desc_typography_font_size['desktop'] ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_typography_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['medium'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_typography_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_font_size['small'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_typography_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_typography_line_height['desktop'] ) && isset( $settings->desc_typography_font_size['desktop'] ) && 0 !== $settings->desc_typography_font_size['desktop'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['desktop'] ) && is_numeric( $settings->desc_typography_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['desktop'] / $settings->desc_typography_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['medium'] ) && isset( $settings->desc_typography_font_size['medium'] ) && 0 !== $settings->desc_typography_font_size['medium'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['medium'] ) && is_numeric( $settings->desc_typography_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['medium'] / $settings->desc_typography_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_typography_line_height['small'] ) && isset( $settings->desc_typography_font_size['small'] ) && 0 !== $settings->desc_typography_font_size['small'] ) {
				if ( is_numeric( $settings->desc_typography_line_height['small'] ) && is_numeric( $settings->desc_typography_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_typography_line_height['small'] / $settings->desc_typography_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			foreach ( $settings->ihover_item as $item ) {

				if ( isset( $item->border_color ) ) {
					$item->border_style_param = array();

					if ( isset( $item->border_style ) ) {
						$item->border_style_param['style'] = $item->border_style;
						unset( $item->border_style );
					}
					$item->border_style_param['color'] = ( '' === $item->border_color ) ? 'EFEFEF' : UABB_Helper::uabb_colorpicker( $item, 'border_color', true );
					if ( isset( $item->border_size ) ) {
						$item->border_style_param['width'] = array(
							'top'    => $item->border_size,
							'right'  => $item->border_size,
							'bottom' => $item->border_size,
							'left'   => $item->border_size,
						);
						unset( $item->border_size );
					}
					unset( $item->border_color );
				}
			}

			if ( isset( $settings->content_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				$count = count( $output );
				for ( $i = 0; $i < $count; $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
				unset( $settings->content_padding );
			}
			if ( isset( $settings->align ) ) {
				$settings->align_param = $settings->align;
				unset( $settings->align );
			}
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
	/**
	 * Function that gets the icon for iHover module.
	 *
	 * @method get_icons
	 * @param string $icon to check if $icon is referencing an included icon.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/ihover/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/ihover/icon/' . $icon );
		}
		return '';
	}


	/**
	 * Function that renders the Image for the iHover module.
	 *
	 * @method render_image
	 * @param array $i to render for the iHover module.
	 */
	public function render_image( $i ) {
		if ( isset( $this->settings->ihover_item[ $i ]->photo_src ) ) {
			$photo_data = FLBuilderPhoto::get_attachment_data( $this->settings->ihover_item[ $i ]->photo );
			$alt        = ( isset( $photo_data->alt ) ) ? $photo_data->alt : '';
			echo '<img src="' . esc_attr( $this->settings->ihover_item[ $i ]->photo_src ) . '" alt="' . esc_attr( $alt ) . '" class="uabb-ih-image">';
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/ihover/ihover-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/ihover/ihover-bb-less-than-2-2-compatibility.php';
}

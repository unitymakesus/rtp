<?php
/**
 *  UABB Heading module file
 *
 *  @package UABB Heading
 */

/**
 * Function that initializes UABB Heading Module
 *
 * @class UABBHeadingModule
 */
class UABBHeadingModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Heading module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Heading', 'uabb' ),
				'description'     => __( 'Display a title/page heading.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-heading/',
				'partial_refresh' => true,
				'icon'            => 'text.svg',
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
			// Compatibility for description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size_unit ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit );
			}
			if ( isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_medium );
			}

			if ( isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit );
			}
			if ( isset( $settings->desc_line_height_unit_medium ) ) {
				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_medium );
			}
			if ( isset( $settings->desc_line_height_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {

				$settings->desc_font_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );
			}
			if ( isset( $settings->desc_letter_spacing ) ) {

				$settings->desc_font_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}
			if ( ! isset( $settings->separator_font_typo ) || ! is_array( $settings->separator_font_typo ) ) {

				$settings->separator_font_typo            = array();
				$settings->separator_font_typo_medium     = array();
				$settings->separator_font_typo_responsive = array();
			}
			if ( isset( $settings->separator_text_font_family ) ) {

				if ( isset( $settings->separator_text_font_family['family'] ) ) {

					$settings->separator_font_typo['font_family'] = $settings->separator_text_font_family['family'];
					unset( $settings->separator_text_font_family['family'] );
				}
				if ( isset( $settings->separator_text_font_family['weight'] ) ) {

					if ( 'regular' === $settings->separator_text_font_family['weight'] ) {
						$settings->separator_font_typo['font_weight'] = 'normal';
					} else {
						$settings->separator_font_typo['font_weight'] = $settings->separator_text_font_family['weight'];
					}
					unset( $settings->separator_text_font_family['weight'] );
				}
			}
			if ( isset( $settings->separator_text_font_size_unit ) ) {

				$settings->separator_font_typo['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit );
			}
			if ( isset( $settings->separator_text_font_size_unit_medium ) ) {
				$settings->separator_font_typo_medium['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit_medium );
			}
			if ( isset( $settings->separator_text_font_size_unit_responsive ) ) {
				$settings->separator_font_typo_responsive['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit_responsive );
			}
			if ( isset( $settings->separator_text_line_height_unit ) ) {

				$settings->separator_font_typo['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit );
			}
			if ( isset( $settings->separator_text_line_height_unit_medium ) ) {
				$settings->separator_font_typo_medium['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit_medium );
			}
			if ( isset( $settings->separator_text_line_height_unit_responsive ) ) {
				$settings->separator_font_typo_responsive['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit_responsive );
			}
			if ( isset( $settings->separator_transform ) ) {
				$settings->separator_font_typo['text_transform'] = $settings->separator_transform;
				unset( $settings->separator_transform );
			}
			if ( isset( $settings->separator_letter_spacing ) ) {

				$settings->separator_font_typo['letter_spacing'] = array(
					'length' => $settings->separator_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->separator_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {
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
			if ( isset( $settings->new_font_size['small'] ) && ! isset( $settings->font_typo_responsive['font_size'] ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->new_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->new_font_size['medium'] ) && ! isset( $settings->font_typo_medium['font_size'] ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->new_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->new_font_size['desktop'] ) && ! isset( $settings->font_typo['font_size'] ) ) {

				$settings->font_typo['font_size'] = array(
					'length' => $settings->new_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->new_font_size['desktop'] ) && 0 !== $settings->new_font_size['desktop'] && ! isset( $settings->font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->new_font_size['desktop'] ) ) {
					$settings->font_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->new_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->new_font_size['medium'] ) && 0 !== $settings->new_font_size['medium'] && ! isset( $settings->font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->new_font_size['medium'] ) ) {
					$settings->font_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->new_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->new_font_size['small'] ) && 0 !== $settings->new_font_size['small'] && ! isset( $settings->font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->new_font_size['small'] ) ) {
					$settings->font_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->new_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' === $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size['desktop'] ) && ! isset( $settings->desc_font_typo['font_size'] ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['medium'] ) && ! isset( $settings->desc_font_typo_medium['font_size'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['small'] ) && ! isset( $settings->desc_font_typo_responsive['font_size'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 !== $settings->desc_font_size['desktop'] && ! isset( $settings->desc_line_height_unit ) ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 !== $settings->desc_font_size['medium'] && ! isset( $settings->desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 !== $settings->desc_font_size['small'] && ! isset( $settings->desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->separator_font_typo ) || ! is_array( $settings->separator_font_typo ) ) {

				$settings->separator_font_typo            = array();
				$settings->separator_font_typo_medium     = array();
				$settings->separator_font_typo_responsive = array();
			}
			if ( isset( $settings->separator_text_font_family ) ) {

				if ( isset( $settings->separator_text_font_family['family'] ) ) {

					$settings->separator_font_typo['font_family'] = $settings->separator_text_font_family['family'];
					unset( $settings->separator_text_font_family['family'] );
				}
				if ( isset( $settings->separator_text_font_family['weight'] ) ) {

					if ( 'regular' === $settings->separator_text_font_family['weight'] ) {
						$settings->separator_font_typo['font_weight'] = 'normal';
					} else {
						$settings->separator_font_typo['font_weight'] = $settings->separator_text_font_family['weight'];
					}
					unset( $settings->separator_text_font_family['weight'] );
				}
			}
			if ( isset( $settings->separator_text_font_size['desktop'] ) && ! isset( $settings->separator_font_typo['font_size'] ) ) {
				$settings->separator_font_typo['font_size'] = array(
					'length' => $settings->separator_text_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {
				$settings->separator_font_typo_medium['font_size'] = array(
					'length' => $settings->separator_text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->separator_font_typo_responsive['font_size'] = array(
					'length' => $settings->separator_text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_line_height['desktop'] ) && isset( $settings->separator_text_font_size['desktop'] ) && 0 !== $settings->separator_text_font_size['desktop'] && ! isset( $settings->separator_text_line_height_unit ) ) {
				if ( is_numeric( $settings->separator_text_line_height['desktop'] ) && is_numeric( $settings->separator_text_font_size['desktop'] ) ) {
					$settings->separator_font_typo['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['desktop'] / $settings->separator_text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->separator_text_line_height['medium'] ) && isset( $settings->separator_text_font_size['medium'] ) && 0 !== $settings->separator_text_font_size['medium'] && ! isset( $settings->separator_text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->separator_text_line_height['medium'] ) && is_numeric( $settings->separator_text_font_size['medium'] ) ) {
					$settings->separator_font_typo_medium['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['medium'] / $settings->separator_text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->separator_text_line_height['small'] ) && isset( $settings->separator_text_font_size['small'] ) && 0 !== $settings->separator_text_font_size['small'] && ! isset( $settings->separator_text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->separator_text_line_height['small'] ) && is_numeric( $settings->separator_text_font_size['small'] ) ) {
					$settings->separator_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['small'] / $settings->separator_text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			// Unset the old values.
			if ( isset( $settings->new_font_size['desktop'] ) ) {
				unset( $settings->new_font_size['desktop'] );
			}
			if ( isset( $settings->new_font_size['medium'] ) ) {
				unset( $settings->new_font_size['medium'] );
			}
			if ( isset( $settings->new_font_size['small'] ) ) {
				unset( $settings->new_font_size['small'] );
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
			// Unset the old values.
			if ( isset( $settings->desc_font_size['desktop'] ) ) {
				unset( $settings->desc_font_size['desktop'] );
			}
			if ( isset( $settings->desc_font_size['medium'] ) ) {
				unset( $settings->desc_font_size['medium'] );
			}
			if ( isset( $settings->desc_font_size['small'] ) ) {
				unset( $settings->desc_font_size['small'] );
			}
			if ( isset( $settings->desc_line_height['desktop'] ) ) {
				unset( $settings->desc_line_height['desktop'] );
			}
			if ( isset( $settings->desc_line_height['medium'] ) ) {
				unset( $settings->desc_line_height['medium'] );
			}
			if ( isset( $settings->desc_line_height['small'] ) ) {
				unset( $settings->desc_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->separator_text_font_size['desktop'] ) ) {
				unset( $settings->separator_text_font_size['desktop'] );
			}
			if ( isset( $settings->separator_text_font_size['medium'] ) ) {
				unset( $settings->separator_text_font_size['medium'] );
			}
			if ( isset( $settings->separator_text_font_size['small'] ) ) {
				unset( $settings->separator_text_font_size['small'] );
			}
			if ( isset( $settings->separator_text_line_height['desktop'] ) ) {
				unset( $settings->separator_text_line_height['desktop'] );
			}
			if ( isset( $settings->separator_text_line_height['medium'] ) ) {
				unset( $settings->separator_text_line_height['medium'] );
			}
			if ( isset( $settings->separator_text_line_height['small'] ) ) {
				unset( $settings->separator_text_line_height['small'] );
			}
		}

		return $settings;
	}

	/**
	 * Function that renders separator pos
	 *
	 * @since 1.14.0
	 * @param string $pos gets the position of the separator.
	 */
	public function render_separator( $pos ) {

		$version_bb_check = UABB_Compatibility::$version_bb_check;

		if ( $version_bb_check ) {

			if ( 'none' !== $this->settings->separator_style && $this->settings->separator_position === $pos ) {

				$position = '0';
				if ( 'center' === $this->settings->alignment ) {
					$position = '50';
				} elseif ( 'right' === $this->settings->alignment ) {
					$position = '100';
				}
				$line_color      = uabb_theme_base_color( $this->settings->separator_line_color );
				$separator_array = array(
					/* General Section */
					'separator'                 => $this->settings->separator_style,
					'style'                     => $this->settings->separator_line_style,
					'color'                     => $line_color,
					'height'                    => $this->settings->separator_line_height,
					'width'                     => ( '' !== $this->settings->separator_line_width ) ? $this->settings->separator_line_width : '30',
					'alignment'                 => $this->settings->alignment,
					'icon_photo_position'       => $position,

					/* Icon Basics */
					'icon'                      => $this->settings->icon,
					'icon_size'                 => $this->settings->icon_size,
					'icon_align'                => $this->settings->alignment,
					'icon_color'                => $this->settings->separator_icon_color,

					/* Image Basics */
					'photo_source'              => $this->settings->photo_source,
					'photo'                     => $this->settings->photo,
					'photo_url'                 => $this->settings->photo_url,
					'img_align'                 => $this->settings->alignment,
					'image_style'               => 'simple',
					'photo_src'                 => isset( $this->settings->photo_src ) ? $this->settings->photo_src : '',

					/* Text */
					'text_inline'               => $this->settings->text_inline,
					'text_tag_selection'        => $this->settings->separator_text_tag_selection,
					'text_font_size'            => isset( $this->settings->separator_text_font_size ) ? $this->settings->separator_text_font_size : '',
					'text_line_height'          => isset( $this->settings->separator_text_line_height ) ? $this->settings->separator_text_line_height : '',

					'text_font_typo'            => ( isset( $this->settings->separator_font_typo ) ) ? $this->settings->separator_font_typo : '',
					'text_font_typo_mediun'     => ( isset( $this->settings->separator_font_typo_medium ) ) ? $this->settings->separator_font_typo_medium : '',
					'text_font_typo_responsive' => ( isset( $this->settings->separator_font_typo_responsive ) ) ? $this->settings->separator_font_typo_responsive : '',

				);

				FLBuilder::render_module_html( 'advanced-separator', $separator_array );
			}
		} else {

			if ( 'none' !== $this->settings->separator_style && $this->settings->separator_position === $pos ) {

				$position = '0';
				if ( 'center' === $this->settings->alignment ) {
					$position = '50';
				} elseif ( 'right' === $this->settings->alignment ) {
					$position = '100';
				}
				$line_color      = uabb_theme_base_color( $this->settings->separator_line_color );
				$separator_array = array(
					/* General Section */
					'separator'                        => $this->settings->separator_style,
					'style'                            => $this->settings->separator_line_style,
					'color'                            => $line_color,
					'height'                           => $this->settings->separator_line_height,
					'width'                            => ( '' !== $this->settings->separator_line_width ) ? $this->settings->separator_line_width : '30',
					'alignment'                        => $this->settings->alignment,
					'icon_photo_position'              => $position,

					/* Icon Basics */
					'icon'                             => $this->settings->icon,
					'icon_size'                        => $this->settings->icon_size,
					'icon_align'                       => $this->settings->alignment,
					'icon_color'                       => $this->settings->separator_icon_color,

					/* Image Basics */
					'photo_source'                     => $this->settings->photo_source,
					'photo'                            => $this->settings->photo,
					'photo_url'                        => $this->settings->photo_url,
					'img_align'                        => $this->settings->alignment,
					'image_style'                      => 'simple',
					'photo_src'                        => isset( $this->settings->photo_src ) ? $this->settings->photo_src : '',

					/* Text */
					'text_inline'                      => $this->settings->text_inline,
					'text_tag_selection'               => $this->settings->separator_text_tag_selection,
					'text_font_family'                 => $this->settings->separator_text_font_family,
					'text_font_size'                   => isset( $this->settings->separator_text_font_size ) ? $this->settings->separator_text_font_size : '',
					'text_line_height'                 => isset( $this->settings->separator_text_line_height ) ? $this->settings->separator_text_line_height : '',
					'text_font_size_unit_responsive'   => $this->settings->separator_text_font_size_unit_responsive,
					'text_line_height_unit_responsive' => $this->settings->separator_text_line_height_unit_responsive,
					'text_font_size_unit_medium'       => $this->settings->separator_text_font_size_unit_medium,
					'text_line_height_unit_medium'     => $this->settings->separator_text_line_height_unit_medium,
					'text_font_size_unit'              => $this->settings->separator_text_font_size_unit,
					'text_line_height_unit'            => $this->settings->separator_text_line_height_unit,
					'text_color'                       => $this->settings->separator_text_color,
					'text_transform'                   => $this->settings->separator_transform,
					'text_letter_spacing'              => $this->settings->separator_letter_spacing,
				);

				FLBuilder::render_module_html( 'advanced-separator', $separator_array );
			}
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/uabb-heading-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/uabb-heading-bb-less-than-2-2-compatibility.php';
}

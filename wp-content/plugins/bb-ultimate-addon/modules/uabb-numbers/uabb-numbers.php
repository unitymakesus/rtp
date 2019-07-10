<?php
/**
 *  UABB Numbers Module file
 *
 *  @package UABB Numbers Module
 */

/**
 * Function that initializes UABB Numbers Module
 *
 * @class UABBNumbersModule
 */
class UABBNumbersModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Numbers module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Counter', 'uabb' ),
				'description'     => __( 'Renders an animated number counter.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$creative_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-numbers/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-numbers/',
				'partial_refresh' => true,
				'icon'            => 'chart-bar.svg',
			)
		);

		$this->add_js( 'jquery-waypoints' );
		$this->add_css( 'font-awesome-5' );

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

			// Compatibility for Number Typography.
			if ( ! isset( $settings->num_typo ) || ! is_array( $settings->num_typo ) ) {

				$settings->num_typo            = array();
				$settings->num_typo_medium     = array();
				$settings->num_typo_responsive = array();
			}
			if ( isset( $settings->num_font_family ) ) {

				if ( isset( $settings->num_font_family['family'] ) ) {

					$settings->num_typo['font_family'] = $settings->num_font_family['family'];
					unset( $settings->num_font_family['family'] );
				}
				if ( isset( $settings->num_font_family['weight'] ) ) {

					if ( 'regular' == $settings->num_font_family['weight'] ) {
						$settings->num_typo['font_weight'] = 'normal';
					} else {
						$settings->num_typo['font_weight'] = $settings->num_font_family['weight'];
					}
					unset( $settings->num_font_family['weight'] );
				}
			}
			if ( isset( $settings->num_font_size_unit ) ) {
				$settings->num_typo['font_size'] = array(
					'length' => $settings->num_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->num_font_size_unit );
			}
			if ( isset( $settings->num_font_size_unit_medium ) ) {
				$settings->num_typo_medium['font_size'] = array(
					'length' => $settings->num_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->num_font_size_unit_medium );
			}
			if ( isset( $settings->num_font_size_unit_responsive ) ) {
				$settings->num_typo_responsive['font_size'] = array(
					'length' => $settings->num_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->num_font_size_unit_responsive );
			}
			if ( isset( $settings->num_line_height_unit ) ) {

				$settings->num_typo['line_height'] = array(
					'length' => $settings->num_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->num_line_height_unit );
			}
			if ( isset( $settings->num_line_height_unit_medium ) ) {
				$settings->num_typo_medium['line_height'] = array(
					'length' => $settings->num_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->num_line_height_unit_medium );
			}
			if ( isset( $settings->num_line_height_unit_responsive ) ) {
				$settings->num_typo_responsive['line_height'] = array(
					'length' => $settings->num_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->num_line_height_unit_responsive );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->num_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}

			// Compatibility for Before After Text Starts.
			if ( ! isset( $settings->ba_typo ) || ! is_array( $settings->ba_typo ) ) {

				$settings->ba_typo            = array();
				$settings->ba_typo_medium     = array();
				$settings->ba_typo_responsive = array();
			}
			if ( isset( $settings->ba_font_family ) ) {

				if ( isset( $settings->ba_font_family['family'] ) ) {

					$settings->ba_typo['font_family'] = $settings->ba_font_family['family'];
					unset( $settings->ba_font_family['family'] );
				}
				if ( isset( $settings->ba_font_family['weight'] ) ) {

					if ( 'regular' == $settings->ba_font_family['weight'] ) {
						$settings->ba_typo['font_weight'] = 'normal';
					} else {
						$settings->ba_typo['font_weight'] = $settings->ba_font_family['weight'];
					}
					unset( $settings->ba_font_family['weight'] );
				}
			}
			if ( isset( $settings->ba_font_size_unit ) ) {

				$settings->ba_typo['font_size'] = array(
					'length' => $settings->ba_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->ba_font_size_unit );
			}
			if ( isset( $settings->ba_font_size_unit_medium ) ) {
				$settings->ba_typo_medium['font_size'] = array(
					'length' => $settings->ba_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->ba_font_size_unit_medium );
			}
			if ( isset( $settings->ba_font_size_unit_responsive ) ) {
				$settings->ba_typo_responsive['font_size'] = array(
					'length' => $settings->ba_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->ba_font_size_unit_responsive );
			}
			if ( isset( $settings->ba_line_height_unit ) ) {

				$settings->ba_typo['line_height'] = array(
					'length' => $settings->ba_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->ba_line_height_unit );
			}
			if ( isset( $settings->ba_line_height_unit_medium ) ) {
				$settings->ba_typo_medium['line_height'] = array(
					'length' => $settings->ba_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->ba_line_height_unit_medium );
			}
			if ( isset( $settings->ba_line_height_unit_responsive ) ) {
				$settings->ba_typo_responsive['line_height'] = array(
					'length' => $settings->ba_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->ba_line_height_unit_responsive );
			}
			if ( isset( $settings->ba_transform ) ) {

				$settings->ba_typo['text_transform'] = $settings->ba_transform;
				unset( $settings->ba_transform );
			}
			if ( isset( $settings->ba_letter_spacing ) ) {

				$settings->ba_typo['letter_spacing'] = array(
					'length' => $settings->ba_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->ba_letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			if ( ! isset( $settings->num_typo ) || ! is_array( $settings->num_typo ) ) {

				$settings->num_typo            = array();
				$settings->num_typo_medium     = array();
				$settings->num_typo_responsive = array();
			}
			if ( isset( $settings->num_font_family ) ) {

				if ( isset( $settings->num_font_family['family'] ) ) {

					$settings->num_typo['font_family'] = $settings->num_font_family['family'];
					unset( $settings->num_font_family['family'] );
				}
				if ( isset( $settings->num_font_family['weight'] ) ) {

					if ( 'regular' == $settings->num_font_family['weight'] ) {
						$settings->num_typo['font_weight'] = 'normal';
					} else {
						$settings->num_typo['font_weight'] = $settings->num_font_family['weight'];
					}
					unset( $settings->num_font_family['weight'] );
				}
			}
			if ( isset( $settings->num_font_size['desktop'] ) ) {
				$settings->num_typo['font_size'] = array(
					'length' => $settings->num_font_size['desktop'],
					'unit'   => 'px',
				);
			}

			if ( isset( $settings->num_font_size['medium'] ) ) {
				$settings->num_typo_medium['font_size'] = array(
					'length' => $settings->num_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->num_font_size['small'] ) ) {
				$settings->num_typo_responsive['font_size'] = array(
					'length' => $settings->num_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->num_line_height['desktop'] ) && isset( $settings->num_font_size['desktop'] ) && 0 != $settings->num_font_size['desktop'] && ! isset( $settings->num_typo['line_height'] ) ) {

				if ( is_numeric( $settings->num_line_height['desktop'] ) && is_numeric( $settings->num_font_size['desktop'] ) ) {
					$settings->num_typo['line_height'] = array(
						'length' => round( $settings->num_line_height['desktop'] / $settings->num_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->num_line_height['medium'] ) && isset( $settings->num_font_size['medium'] ) && 0 != $settings->num_font_size['medium'] && ! isset( $settings->num_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->num_line_height['medium'] ) && is_numeric( $settings->num_font_size['medium'] ) ) {
					$settings->num_typo_medium['line_height'] = array(
						'length' => round( $settings->num_line_height['medium'] / $settings->num_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->num_line_height['small'] ) && isset( $settings->num_font_size['small'] ) && 0 != $settings->num_font_size['small'] && ! isset( $settings->num_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->num_line_height['small'] ) && is_numeric( $settings->num_font_size['small'] ) ) {
					$settings->num_typo_responsive['line_height'] = array(
						'length' => round( $settings->num_line_height['small'] / $settings->num_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}

			if ( ! isset( $settings->ba_typo ) || ! is_array( $settings->ba_typo ) ) {

				$settings->ba_typo            = array();
				$settings->ba_typo_medium     = array();
				$settings->ba_typo_responsive = array();
			}

			if ( isset( $settings->ba_font_family ) ) {

				if ( isset( $settings->ba_font_family['family'] ) ) {

					$settings->ba_typo['font_family'] = $settings->ba_font_family['family'];
					unset( $settings->ba_font_family['family'] );
				}
				if ( isset( $settings->ba_font_family['weight'] ) ) {

					if ( 'regular' == $settings->ba_font_family['weight'] ) {
						$settings->ba_typo['font_weight'] = 'normal';
					} else {
						$settings->ba_typo['font_weight'] = $settings->ba_font_family['weight'];
					}
					unset( $settings->ba_font_family['weight'] );
				}
			}

			if ( isset( $settings->ba_font_size['desktop'] ) ) {
				$settings->ba_typo['font_size'] = array(
					'length' => $settings->ba_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->ba_font_size['medium'] ) ) {
				$settings->ba_typo_medium['font_size'] = array(
					'length' => $settings->ba_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->ba_font_size['small'] ) ) {
				$settings->ba_typo_responsive['font_size'] = array(
					'length' => $settings->ba_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->ba_line_height['desktop'] ) && isset( $settings->ba_font_size['desktop'] ) && 0 != $settings->ba_font_size['desktop'] && ! isset( $settings->ba_line_height_unit ) ) {
				if ( is_numeric( $settings->ba_line_height['desktop'] ) && is_numeric( $settings->ba_font_size['desktop'] ) ) {
					$settings->ba_typo['line_height'] = array(
						'length' => round( $settings->ba_line_height['desktop'] / $settings->ba_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->ba_line_height['medium'] ) && isset( $settings->ba_font_size['medium'] ) && 0 != $settings->ba_font_size['medium'] && ! isset( $settings->ba_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->ba_line_height['medium'] ) && is_numeric( $settings->ba_font_size['medium'] ) ) {
					$settings->ba_typo_medium['line_height'] = array(
						'length' => round( $settings->ba_line_height['medium'] / $settings->ba_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->ba_line_height['small'] ) && isset( $settings->ba_font_size['small'] ) && 0 != $settings->ba_font_size['small'] && ! isset( $settings->ba_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->ba_line_height['small'] ) && is_numeric( $settings->ba_font_size['small'] ) ) {
					$settings->ba_typo_responsive['line_height'] = array(
						'length' => round( $settings->ba_line_height['small'] / $settings->ba_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			// Unset the old values.
			if ( isset( $settings->num_font_size['desktop'] ) ) {
				unset( $settings->num_font_size['desktop'] );
			}
			if ( isset( $settings->num_font_size['medium'] ) ) {
				unset( $settings->num_font_size['medium'] );
			}
			if ( isset( $settings->num_font_size['small'] ) ) {
				unset( $settings->num_font_size['small'] );
			}
			if ( isset( $settings->num_line_height['desktop'] ) ) {
				unset( $settings->num_line_height['desktop'] );
			}
			if ( isset( $settings->num_line_height['medium'] ) ) {
				unset( $settings->num_line_height['medium'] );
			}
			if ( isset( $settings->num_line_height['small'] ) ) {
				unset( $settings->num_line_height['small'] );
			}
			if ( isset( $settings->ba_font_size['desktop'] ) ) {
				unset( $settings->ba_font_size['desktop'] );
			}
			if ( isset( $settings->ba_font_size['medium'] ) ) {
				unset( $settings->ba_font_size['medium'] );
			}
			if ( isset( $settings->ba_font_size['small'] ) ) {
				unset( $settings->ba_font_size['small'] );
			}
			if ( isset( $settings->ba_line_height['desktop'] ) ) {
				unset( $settings->ba_line_height['desktop'] );
			}
			if ( isset( $settings->ba_line_height['medium'] ) ) {
				unset( $settings->ba_line_height['medium'] );
			}
			if ( isset( $settings->ba_line_height['small'] ) ) {
				unset( $settings->ba_line_height['small'] );
			}
		}

		return $settings;
	}

	/**
	 * Function that update settings for the photo
	 *
	 * @method update
	 * @param object $settings {object}.
	 */
	public function update( $settings ) {
		// Cache the photo data.
		if ( ! empty( $settings->photo ) ) {

			$data = FLBuilderPhoto::get_attachment_data( $settings->photo );

			if ( $data ) {
				$settings->photo_data = $data;
			}
		}

		return $settings;
	}

	/**
	 * Function that render number
	 *
	 * @method render_number
	 */
	public function render_number() {

		$number = 0;
		$layout = $this->settings->layout ? $this->settings->layout : 'default';
		$type   = $this->settings->number_type ? $this->settings->number_type : 'percent';
		$prefix = 'percent' == $type ? '' : $this->settings->number_prefix;
		$suffix = 'percent' == $type ? '%' : $this->settings->number_suffix;
		$tag    = ( 'default' != $this->settings->num_tag_selection ) ? $this->settings->num_tag_selection : 'div';

		$html = '<' . $tag . ' class="uabb-number-string">' . $prefix . '<span class="uabb-number-int">' . number_format( $number ) . '</span>' . $suffix . '</' . $tag . '>';

		echo $html;
	}

	/**
	 * Function that render before number text
	 *
	 * @method render_before_number_text
	 */
	public function render_before_number_text() {
		$html = '';
		if ( ! empty( $this->settings->before_number_text ) ) {
			$html .= '<span class="uabb-number-before-text">' . $this->settings->before_number_text . '</span>';
		}
		echo $html;
	}

	/**
	 * Function that render before counter text
	 *
	 * @method render_before_counter_text
	 */
	public function render_before_counter_text() {
		$html = '';
		if ( '' != $this->settings->before_counter_text ) {
			$html .= '<span class="uabb-counter-before-text">' . $this->settings->before_counter_text . '</span>';
		}
		return $html;
	}

	/**
	 * Function that render after number text
	 *
	 * @method render_after_number_text
	 */
	public function render_after_number_text() {
		$html = '';
		if ( ! empty( $this->settings->after_number_text ) ) {
			$html .= '<span class="uabb-number-after-text">' . $this->settings->after_number_text . '</span>';
		}
		echo $html;
	}

	/**
	 * Function that render after counter text
	 *
	 * @method render_after_counter_text
	 */
	public function render_after_counter_text() {
		$html = '';
		if ( '' != $this->settings->after_counter_text ) {
			$html .= '<span class="uabb-counter-after-text">' . $this->settings->after_counter_text . '</span>';
		}
		return $html;
	}

	/**
	 * Function that render after circle bar
	 *
	 * @method render_circle_bar
	 */
	public function render_circle_bar() {

		$width        = ! empty( $this->settings->circle_width ) ? $this->settings->circle_width : 300;
		$stroke_width = ! empty( $this->settings->circle_dash_width ) ? $this->settings->circle_dash_width : 10;
		$pos          = ( $width / 2 );
		// Calculate radius according to stroke width.
		$radius = $pos - ( $stroke_width / 2 );
		$dash   = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '' );

		$html  = '<div class="svg-container">';
		$html .= '<svg class="svg" viewBox="0 0 ' . $width . ' ' . $width . '" version="1.1" preserveAspectRatio="xMinYMin meet">
			<circle class="uabb-bar-bg" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="0"></circle>
			<circle class="uabb-bar" r="' . $radius . '" cx="' . $pos . '" cy="' . $pos . '" fill="transparent" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '" transform="rotate(-90.1 ' . $pos . ' ' . $pos . ')"></circle>
		</svg>';
		$html .= '</div>';

		echo $html;
	}

	/**
	 * Function that render semi circle bar
	 *
	 * @method render_semi_circle_bar
	 */
	public function render_semi_circle_bar() {

		$width        = ! empty( $this->settings->circle_width ) ? $this->settings->circle_width : 300;
		$stroke_width = ! empty( $this->settings->circle_dash_width ) ? $this->settings->circle_dash_width : 10;
		$pos          = ( $width / 2 );
		// Calculate radius according to stroke width.
		$radius = $pos - ( $stroke_width / 2 );
		$dash   = number_format( ( ( M_PI * 2 ) * $radius ), 2, '.', '' );

		$html = '<div class="svg-container">';

		$html .= '<svg class="semi-circle-svg" viewBox="0 0 ' . $width . ' ' . $pos . '" version="1.1" preserveAspectRatio="xMinYMin meet">
			<circle class="uabb-bar-bg" r="' . $radius . '" fill="transparent" cx="' . $pos . '" cy="' . $pos . '" stroke-dasharray="' . $dash . '" stroke-dashoffset="0"></circle>
			<circle class="uabb-bar" r="' . $radius . '" fill="transparent" cx="' . $pos . '" cy="' . $pos . '" stroke-dasharray="' . $dash . '" stroke-dashoffset="' . $dash . '"></circle>
		</svg>';
		/* Before Text */
		$html .= $this->render_before_counter_text();
		/* After Text */
		$html .= $this->render_after_counter_text();
		$html .= '</div>';
		echo $html;
	}

	/**
	 * Function that render separator
	 *
	 * @method render_button
	 */
	public function render_separator() {

		if ( 'yes' == $this->settings->show_separator ) {
			$separator_settings = array(
				'color'     => $this->settings->separator_color,
				'height'    => $this->settings->separator_height,
				'width'     => $this->settings->separator_width,
				'alignment' => $this->settings->separator_alignment,
				'style'     => $this->settings->separator_style,
			);

			echo '<div class="uabb-number-separator">';
			FLBuilder::render_module_html( 'uabb-separator', $separator_settings );
			echo '</div>';
		}
	}

	/**
	 * Function that render Image
	 *
	 * @method render_image
	 * @param string $position gets the position of the image.
	 */
	public function render_image( $position ) {
		if ( 'none' != $this->settings->image_type ) {

			/* Get setting pos according to image type */
			$set_pos = '';
			if ( 'circle' == $this->settings->layout ) {
				$set_pos = $this->settings->circle_position;
			} elseif ( 'default' == $this->settings->layout ) {
				$set_pos = $this->settings->img_icon_position;
			}

			/* Render Image / icon */
			if ( $position == $set_pos ) {
				$imageicon_array = array(

					/* General Section */
					'image_type'            => $this->settings->image_type,

					/* Icon Basics */
					'icon'                  => $this->settings->icon,
					'icon_size'             => $this->settings->icon_size,
					'icon_align'            => $this->settings->align,

					/* Image Basics */
					'photo_source'          => $this->settings->photo_source,
					'photo'                 => $this->settings->photo,
					'photo_url'             => $this->settings->photo_url,
					'img_size'              => $this->settings->img_size,
					'img_align'             => $this->settings->align,
					'photo_src'             => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '',

					/* Icon Style */
					'icon_style'            => $this->settings->icon_style,
					'icon_bg_size'          => $this->settings->icon_bg_size,
					'icon_border_style'     => $this->settings->icon_border_style,
					'icon_border_width'     => $this->settings->icon_border_width,
					'icon_bg_border_radius' => $this->settings->icon_bg_border_radius,

					/* Image Style */
					'image_style'           => $this->settings->image_style,
					'img_bg_size'           => $this->settings->img_bg_size,
					'img_border_style'      => $this->settings->img_border_style,
					'img_border_width'      => $this->settings->img_border_width,
					'img_bg_border_radius'  => $this->settings->img_bg_border_radius,
				);

				/* Render HTML Function */
				FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			}
		}

	}

}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-numbers/uabb-numbers-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-numbers/uabb-numbers-bb-less-than-2-2-compatibility.php';
}

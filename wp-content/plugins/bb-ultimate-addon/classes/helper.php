<?php
/**
 *  UABB Helper
 *
 *  Helper functions, actions & filter hooks etc.
 *
 *  @package UABB Helper
 */

if ( ! class_exists( 'UABB_Helper' ) ) {
	/**
	 * This class initializes UABB helper
	 *
	 * @class UABB_Helper
	 */
	class UABB_Helper {

		/**
		 * Helper function to render css styles for a selected font.
		 *
		 * @since  1.0
		 * @param  array $font An array with font-family and weight.
		 * @return void
		 */
		public static function uabb_font_css( $font ) {
			$css = '';

			if ( array_key_exists( $font['family'], FLBuilderFontFamilies::$system ) ) {
				$css .= 'font-family: ' . $font['family'] . ',' . FLBuilderFontFamilies::$system[ $font['family'] ]['fallback'] . ';';
			} else {
				$css .= 'font-family: ' . $font['family'] . ';';
			}

			if ( 'regular' === $font['weight'] ) {
				$css .= 'font-weight: normal;';
			} else {
				$css .= 'font-weight: ' . $font['weight'] . ';';
			}

			echo esc_attr( $css );
		}

		/**
		 *  Get - Color
		 *
		 * Get HEX color and return RGBA. Default return HEX color.
		 *
		 * @param  var $hex        HEX color code.
		 * @param  var $opacity    Opacity of HEX color.
		 * @since 1.0
		 */
		public static function uabb_get_color( $hex, $opacity ) {
			$rgba = $hex;
			if ( '' !== $opacity ) {
				if ( strlen( $hex ) === 3 ) {
					$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
					$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
					$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
				} else {
					$r = hexdec( substr( $hex, 0, 2 ) );
					$g = hexdec( substr( $hex, 2, 2 ) );
					$b = hexdec( substr( $hex, 4, 2 ) );
				}
				return 'rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ' )';
			} else {
				return '#' . $hex;
			}
		}

		/**
		 *  Get - RGBA Color
		 *
		 *  Get HEX color and return RGBA. Default return RGB color.
		 *
		 * @param  var   $color      Gets the color value.
		 * @param  var   $opacity    Gets the opacity value.
		 * @param  array $is_array Gets an array of the value.
		 * @since   1.0
		 */
		public static function uabb_hex2rgba( $color, $opacity = false, $is_array = false ) {

			$default = $color;

			// Return default if no color provided.
			if ( empty( $color ) ) {
				return $default;
			}

			// Sanitize $color if "#" is provided.
			if ( '#' === $color[0] ) {
				$color = substr( $color, 1 );
			}

			// Check if color has 6 or 3 characters and get values.
			if ( strlen( $color ) === 6 ) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) === 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}

			// Convert hexadec to rgb.
			$rgb = array_map( 'hexdec', $hex );

			// Check if opacity is set(rgba or rgb).
			if ( false !== $opacity && '' !== $opacity ) {
				if ( abs( $opacity ) > 1 ) {
					$opacity = $opacity / 100;
				}
				$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ',', $rgb ) . ')';
			}

			if ( $is_array ) {
				return $rgb;
			} else {
				// Return rgb(a) color string.
				return $output;
			}
		}

		/**
		 *  Get - Colorpicker Value based on colorpicker
		 *
		 * @param   object $settings gets settings objects values.
		 * @param   var    $name       gets name of the values.
		 * @param   var    $opc        gets the opacity of the colorpicker.
		 * @since   1.0
		 */
		public static function uabb_colorpicker( $settings, $name = '', $opc = false ) {

			$hex_color = '';
			$opacity   = '';
			$hex_color = $settings->$name;

			if ( '' !== $hex_color && 'r' !== $hex_color[0] && 'R' !== $hex_color[0] ) {

				if ( true === $opc && isset( $settings->{ $name . '_opc' } ) ) {
					if ( '' !== $settings->{ $name . '_opc' } ) {
						$opacity = $settings->{ $name . '_opc' };
						$rgba    = self::uabb_hex2rgba( $hex_color, $opacity / 100 );
						return $rgba;
					}
				}

				if ( '#' !== $hex_color[0] ) {

					return '#' . $hex_color;
				}
			}

			return $hex_color;

		}

		/**
		 *  Get - Gradient color CSS
		 *
		 * @param   array $gradient  returns array of gradient.
		 * @since   1.0
		 */
		public static function uabb_gradient_css( $gradient ) {
			$gradient['angle'] = ( isset( $gradient['angle'] ) ) ? $gradient['angle'] : '';
			$gradient_angle    = intval( $gradient['angle'] );
			$direction         = $gradient['direction'];
			$color1            = '';
			$color2            = '';
			$angle             = 0;
			$css               = '';

			if ( 'custom' !== $direction ) {
				switch ( $direction ) {
					case 'left_right':
						$gradient_angle = 0;
						break;
					case 'right_left':
						$gradient_angle = 180;
						break;
					case 'top_bottom':
						$gradient_angle = 270;
						break;
					case 'bottom_top':
						$gradient_angle = 90;
						break;
					default:
						break;
				}
			}

			if ( isset( $gradient['color_one'] ) && '' !== $gradient['color_one'] ) {
				$color1 = self::uabb_hex2rgba( $gradient['color_one'] );
			}

			if ( isset( $gradient['color_two'] ) && '' !== $gradient['color_two'] ) {
				$color2 = self::uabb_hex2rgba( $gradient['color_two'] );
			}

			$angle = abs( $gradient_angle - 450 ) % 360;

			if ( '' !== $color1 && '' !== $color2 ) {

				$css .= 'background: -webkit-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -o-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -ms-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -moz-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: linear-gradient(' . $angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
			}
			echo esc_attr( $css );
		}

		/**
		 *  Get - Gradient color CSS
		 *
		 * @param array  $settings  returns settings object.
		 * @param string $name     returns name.
		 * @param string $property  returns Property.
		 * @param string $media  returns media.
		 * @since   1.0
		 */
		public static function uabb_dimention_css( $settings, $name, $property = 'padding', $media = 'desktop' ) {

			$css    = '';
			$device = '';

			if ( 'medium' === $media ) {
				$device = '_medium';
			} elseif ( 'responsive' === $media ) {
				$device = '_responsive';
			}

			if ( 'padding' === $property || 'margin' === $property ) {

				if ( '' !== $settings->{ $name . '_top' } ) {
					$css .= isset( $settings->{ $name . '_top' . $device } ) ? $property . '-top:' . $settings->{ $name . '_top' . $device } . 'px;' : '';
				}

				if ( '' !== $settings->{ $name . '_right' } ) {
					$css .= isset( $settings->{ $name . '_right' . $device } ) ? $property . '-right:' . $settings->{ $name . '_right' . $device } . 'px;' : '';
				}

				if ( '' !== $settings->{ $name . '_bottom' } ) {
					$css .= isset( $settings->{ $name . '_bottom' . $device } ) ? $property . '-bottom:' . $settings->{ $name . '_bottom' . $device } . 'px;' : '';
				}

				if ( '' !== $settings->{ $name . '_left' } ) {
					$css .= isset( $settings->{ $name . '_left' . $device } ) ? $property . '-left:' . $settings->{ $name . '_left' . $device } . 'px;' : '';
				}
			}
			return $css;
		}
	}
}

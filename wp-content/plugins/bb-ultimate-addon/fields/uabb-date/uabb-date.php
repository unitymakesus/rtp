<?php
/**
 *  UABB Date file
 *
 *  Showing Evergreen and Normal Date field
 *
 *  @package Date Field
 */

if ( ! class_exists( 'UABB_Date_Field' ) ) {
	/**
	 * This class adds UABB date field
	 *
	 * @class UABB_Date_Field
	 */
	class UABB_Date_Field {
		/**
		 * Constructor function that initializes required actions of date field
		 *
		 * @since x.x.x
		 */
		public function __construct() {
				add_action( 'fl_builder_control_uabb-normal-date', array( $this, 'uabb_normal_date' ), 1, 4 );
				add_action( 'fl_builder_control_uabb-evergreen-date', array( $this, 'uabb_evergreen_date' ), 1, 4 );
				add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}

		/**
		 * Function that renders UI Date Fields
		 *
		 * @since x.x.x
		 * @param object $fields an object to get various settings.
		 */
		public function ui_fields( $fields ) {
			$fields['uabb-normal-date'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-date/ui-field-uabb-normal-date.php';

			$fields['uabb-evergreen-date'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-date/ui-field-uabb-evergreen-date.php';

			return $fields;
		}

		/**
		 * Function that renders UI Fields
		 *
		 * @since x.x.x
		 * @param var    $name gets the name of the days of the week.
		 * @param array  $value an array to get the values of the days of the week.
		 * @param array  $field an object to get various settings.
		 * @param object $settings an object to get various settings.
		 */
		public function uabb_normal_date( $name, $value, $field, $settings ) {

			$custom_class = isset( $field['class'] ) ? $field['class'] : '';

			$preview = isset( $field['preview'] ) ? wp_json_encode( $field['preview'] ) : wp_json_encode( array( 'type' => 'refresh' ) );

			echo '<div class="uabb-date-wrap fl-field" data-type="select" data-preview=\'' . esc_attr( $preview ) . '\'><div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_attr( $name ) . '_days" ><option value="0">' . esc_html__( 'Date', 'uabb' ) . '</option>';

			for ( $i = 1; $i <= 31; $i++ ) {
					$selected = '';
				if ( isset( $settings->fixed_date_days ) ) {
					if ( $i === $settings->fixed_date_days ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 29 === $i ) {
					$selected = 'selected';
				}

				if ( $i <= 9 ) {
					echo '<option value="' . esc_attr( $i ) . '" ' . esc_attr( $selected ) . '>0' . esc_attr( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_attr( $i ) . '" ' . esc_attr( $selected ) . '>' . esc_attr( $i ) . '</option>';
				}
			}

			echo '</select></br><label>' . esc_attr__( 'Date', 'uabb' ) . '</label></div>';

			echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_attr( $name ) . '_month" >';
			echo '<option value="0">' . esc_attr__( 'Month', 'uabb' ) . '</option>';
			echo '<option value="01" ' . ( ( isset( $settings->fixed_date_month ) && '01' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Jan</option>';
			echo '<option value="02" ' . ( ( isset( $settings->fixed_date_month ) && '02' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Feb</option>';
			echo '<option value="03" ' . ( ( isset( $settings->fixed_date_month ) && '03' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Mar</option>';
			echo '<option value="04" ' . ( ( isset( $settings->fixed_date_month ) && '04' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Apr</option>';
			echo '<option value="05" ' . ( ( isset( $settings->fixed_date_month ) && '05' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >May</option>';
			echo '<option value="06" ' . ( ( isset( $settings->fixed_date_month ) && '06' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Jun</option>';
			echo '<option value="07" ' . ( ( isset( $settings->fixed_date_month ) && '07' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Jul</option>';
			echo '<option value="08" ' . ( ( isset( $settings->fixed_date_month ) && '08' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Aug</option>';
			echo '<option value="09" ' . ( ( isset( $settings->fixed_date_month ) && '09' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Sep</option>';
			echo '<option value="10" ' . ( ( isset( $settings->fixed_date_month ) && '10' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Oct</option>';
			echo '<option value="11" ' . ( ( isset( $settings->fixed_date_month ) && '11' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Nov</option>';
			echo '<option value="12" ' . ( ( isset( $settings->fixed_date_month ) && '12' === $settings->fixed_date_month ) ? 'selected' : '' ) . ' >Dec</option>';
			echo '</select></br><label>' . esc_attr__( 'Months', 'uabb' ) . '</label></div>';

			echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_attr( $name ) . '_year" >';
			echo '<option value="0">' . esc_attr__( 'Year', 'uabb' ) . '</option>';
			for ( $i = date( 'Y' ); $i < date( 'Y' ) + 6; $i++ ) { // @codingStandardsIgnoreLine.  ( WordPress.DateTime.RestrictedFunctions.date_date , Generic.CodeAnalysis.ForLoopWithTestFunctionCall.NotAllowed )
					$selected = '';
				if ( isset( $settings->fixed_date_year ) ) {
					if ( $i === $settings->fixed_date_year ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( date( 'Y' ) + 5 === $i ) { //phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
					$selected = 'selected';
				}
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
			}
					echo '</select></br><label>' . esc_html__( 'Years', 'uabb' ) . '</label></div>';
					echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_html( $name ) . '_hour" >';
					echo '<option value="0">' . esc_html__( 'Hour', 'uabb' ) . '</option>';
			for ( $i = 0; $i < 24; $i++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_hour ) ) {
					if ( $i === $settings->fixed_date_hour ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 23 === $i ) {
					$selected = 'selected';
				}

				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
					echo '</select></br><label>' . esc_html__( 'Hours', 'uabb' ) . '</label></div>';
					echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_html( $name ) . '_minutes" >';
					echo '<option value="0">' . esc_html__( 'Minutes', 'uabb' ) . '</option>';
			for ( $i = 0; $i < 60; $i++ ) {
				$selected = '';
				if ( isset( $settings->fixed_date_minutes ) ) {
					if ( $i === $settings->fixed_date_minutes ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 59 === $i ) {
					$selected = 'selected';
				}

				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
					echo '</select></br><label>' . esc_html__( 'Minutes', 'uabb' ) . '</label></div><div>';
		}

		/**
		 * Function that renders UI Fields evergreen date
		 *
		 * @since x.x.x
		 * @param var    $name gets the name of the date of the month.
		 * @param array  $value an array to get the values of the date of the month.
		 * @param array  $field an object to get various settings.
		 * @param object $settings an object to get various settings.
		 */
		public function uabb_evergreen_date( $name, $value, $field, $settings ) {

			$custom_class = isset( $field['class'] ) ? $field['class'] : '';
			$selected     = '';
			$preview      = isset( $field['preview'] ) ? wp_json_encode( $field['preview'] ) : wp_json_encode( array( 'type' => 'refresh' ) );

			echo '<div class="fl-field uabb-evergreen-wrap" data-type="select" data-preview=\'' . esc_attr( $preview ) . '\'><div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_attr( $name ) . '_days" >';
			echo '<option value="0">' . esc_attr__( 'Days', 'uabb' ) . '</option>';
			for ( $i = 0; $i <= 31; $i++ ) {
				if ( isset( $settings->evergreen_date_days ) ) {
					if ( $i === $settings->evergreen_date_days ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 30 === $i ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
			echo '</select></br><label>' . esc_html__( 'Days', 'uabb' ) . '</label></div>';

			echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_attr( $name ) . '_hour" >';
			echo '<option value="0">' . esc_html__( 'Hours', 'uabb' ) . '</option>';
			for ( $i = 0; $i < 24; $i++ ) {
				if ( isset( $settings->evergreen_date_hour ) ) {
					if ( $i === $settings->evergreen_date_hour ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 23 === $i ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
					echo '</select></br><label>' . esc_html__( 'Hours', 'uabb' ) . '</label></div>';
					echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_html( $name ) . '_minutes" >';
					echo '<option value="0">' . esc_html__( 'Minutes', 'uabb' ) . '</option>';
			for ( $i = 0; $i < 60; $i++ ) {
				if ( isset( $settings->evergreen_date_minutes ) ) {
					if ( $i === $settings->evergreen_date_minutes ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 59 === $i ) {
						$selected = 'selected';
				}

				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
					echo '</select></br><label>' . esc_attr__( 'Minutes', 'uabb' ) . '</label></div>';
					echo '<div class="uabb-countdown-custom-fields"><select class="text text-full" name="' . esc_html( $name ) . '_seconds" >';
					echo '<option value="0">' . esc_html__( 'Seconds', 'uabb' ) . '</option>';
			for ( $i = 0; $i < 60; $i++ ) {
				if ( isset( $settings->evergreen_date_seconds ) ) {
					if ( $i === $settings->evergreen_date_seconds ) {
						$selected = 'selected';
					} else {
						$selected = '';
					}
				} elseif ( 59 === $i ) {
					$selected = 'selected';
				}
				if ( $i <= 9 ) {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>0' . esc_html( $i ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $i ) . '" ' . esc_html( $selected ) . '>' . esc_html( $i ) . '</option>';
				}
			}
					echo '</select></br><label>' . esc_html__( 'Seconds', 'uabb' ) . '</label></div></div>';
		}
	}

	$uabb_date_field = new UABB_Date_Field();
}

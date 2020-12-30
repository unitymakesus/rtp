<?php
/**
 * Static Sortable Param
 *
 * @package Sortable Param
 */

if ( ! class_exists( 'UABB_Sortable_Field' ) ) {
	/**
	 * This class adds UABB sortable and UI fields
	 *
	 * @class UABB_Sortable_Field
	 */
	class UABB_Sortable_Field {
		/**
		 * Constructor function that initializes required actions of sortable and fields
		 *
		 * @since x.x.x
		 */
		public function __construct() {
			add_action( 'fl_builder_control_uabb-sortable', array( $this, 'uabb_sortable' ), 1, 4 );
				add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}
		/**
		 * Function that renders UI Fields
		 *
		 * @since x.x.x
		 * @param object $fields an object to get various settings.
		 */
		public function ui_fields( $fields ) {
			$fields['uabb-sortable'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-sortable/ui-field-uabb-sortable.php';

			return $fields;
		}
		/**
		 * Function that renders UI Fields
		 *
		 * @since x.x.x
		 * @param var    $name gets the CSS for the row gradient.
		 * @param array  $value an array to get the nodes of the row.
		 * @param array  $field an object to get various settings.
		 * @param object $settings an object to get various settings.
		 */
		public function uabb_sortable( $name, $value, $field, $settings ) {

				$custom_class = isset( $field['class'] ) ? $field['class'] : '';

				$default = ( isset( $field['default'] ) && '' !== $field['default'] ) ? $field['default'] : '';

				$assign_val = ( '' !== $value ) ? $value : $default;

				$preview = isset( $field['preview'] ) ? wp_json_encode( $field['preview'] ) : wp_json_encode( array( 'type' => 'refresh' ) );

			if ( isset( $field['options'] ) ) {
				if ( '' !== $field['options'] ) {
						$output  = '<script> jQuery(function(){ UABBSortable._init({name: "' . $name . '"}); });</script>
                              <div class="uabb-sortable-wrap fl-field" data-type="text" data-preview=\'' . $preview . '\'>
                                    <ul class="uabb-sortable ' . $custom_class . '">';
						$old_val = explode( ',', $assign_val );
						$options = $field['options'];
					$count       = count( $old_val );
					for ( $i = 0; $i < $count; $i++ ) {
						if ( isset( $options[ $old_val[ $i ] ] ) ) {
									$output .= '<li class="' . $old_val[ $i ] . '">' . $options[ $old_val[ $i ] ] . '</span></li>';
									unset( $options[ $old_val[ $i ] ] );
						}
					}

					foreach ( $options as $key => $option ) {
						$output .= '<li class="' . $key . '">' . $option . '</span></li>';
					}

							$output .= '</ul><input type="hidden" value="' . $assign_val . '" name="' . $name . '"/></div>';

							echo esc_attr( $output );
				}
			}
		}
	}
	$uabb_sortable_field = new UABB_Sortable_Field();
}

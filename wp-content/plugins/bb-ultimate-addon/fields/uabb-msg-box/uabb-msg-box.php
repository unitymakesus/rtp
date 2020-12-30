<?php
/**
 *  Static Message Box Param
 *
 *  @package Message Box
 */

if ( ! class_exists( 'UABB_MSG_Field' ) ) {
	/**
	 * This class initializes UABB message field
	 *
	 * @class UABB Message field
	 */
	class UABB_MSG_Field {
		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since x.x.x
		 */
		public function __construct() {
			add_action( 'fl_builder_control_uabb-msgbox', array( $this, 'uabb_msgbox' ), 1, 4 );
				add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}
		/**
		 * Function that renders UI fields' files
		 *
		 * @since x.x.x
		 * @param array $fields gets an array of fields.
		 */
		public function ui_fields( $fields ) {
			$fields['uabb-msgbox'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-msg-box/ui-field-uabb-msgbox.php';

			return $fields;
		}
		/**
		 * Function that outputs messsage box values
		 *
		 * @since x.x.x
		 * @param array  $name gets the values of the message box.
		 * @param array  $value an values of the message box.
		 * @param array  $field an array of field values.
		 * @param object $settings an object to get various settings.
		 */
		public function uabb_msgbox( $name, $value, $field, $settings ) {

			$msg_type      = isset( $field['msg_type'] ) ? $field['msg_type'] : 'info';
			$custom_class  = isset( $field['class'] ) ? $field['class'] : '';
			$custom_class .= ' uabb-msg-' . $msg_type;
			$msg_content   = '';

			if ( isset( $field['content'] ) ) {
				if ( '' !== $field['content'] ) {

					switch ( $msg_type ) {
						case 'info':
							$msg_content = '<strong>Info!</strong> ';
							break;
						case 'success':
							$msg_content = '<strong>Success!</strong> ';
							break;
						case 'warning':
							$msg_content = '<strong>Warning!</strong> ';
							break;
						case 'danger':
							$msg_content = '<strong>Danger!</strong> ';
							break;
					}

					$msg_content .= $field['content'];

					$output  = "<div class='uabb-msg " . $custom_class . " uabb-msg-field'>";
					$output .= $msg_content;
					$output .= '</div>';

					echo esc_attr( $output );
				}
			}
		}
	}

	new UABB_MSG_Field();
}

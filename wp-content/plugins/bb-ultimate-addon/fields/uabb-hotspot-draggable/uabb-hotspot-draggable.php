<?php
/**
 *  Draggable pointer on an Image param
 *
 *  @package Draggable Pointer param
 */

if ( ! class_exists( 'UABB_Hotspot_Draggable' ) ) {
	/**
	 * This class initializes Hotspot Draggable
	 *
	 * @class UABB_Hotspot_Draggable
	 */
	class UABB_Hotspot_Draggable {
		/**
		 * Constructor function that initializes required actions
		 *
		 * @since x.x.x
		 */
		function __construct() {
			add_action( 'fl_builder_control_uabb-draggable', array( $this, 'uabb_draggable' ), 1, 4 );
			add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}

		/**
		 * Function that renders row's CSS
		 *
		 * @since x.x.x
		 * @param array $fields gets the fields for the hotspot.
		 */
		function ui_fields( $fields ) {
			$fields['uabb-draggable'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-hotspot-draggable/ui-field-uabb-draggable.php';

			return $fields;
		}

		/**
		 * Function that renders row's CSS
		 *
		 * @since x.x.x
		 * @param var    $name gets the name for the draggable field.
		 * @param var    $value gets the position value of the coordinates.
		 * @param array  $field gets the field values.
		 * @param object $settings gets the object of respective fields.
		 */
		function uabb_draggable( $name, $value, $field, $settings ) {

			$val     = ( isset( $value ) && '' != $value ) ? $value : '0,0';
			$coord   = explode( ',', $val );
			$preview = isset( $field['preview'] ) ? json_encode( $field['preview'] ) : json_encode( array( 'type' => 'refresh' ) );

			echo "<script>jQuery(function(){ UABBHotspotDraggable._init({name:'" . $name . "'}); });</script><div class='uabb-hotspot-draggable-wrap fl-field' data-type='text' data-preview='" . $preview . "'><div class='uabb-hotspot-draggable'></div><div class='uabb-hotspot-draggable-point' style='top:" . $coord[1] . '%;left:' . $coord[0] . "%;'></div></div><input type='hidden' value='" . $val . "' name='" . $name . "' />";
		}
	}

	new UABB_Hotspot_Draggable();
}

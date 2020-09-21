<?php
/**
 *  Off Canvas Module Module file
 *
 *  @package Off Canvas Module Module
 */

$is_builder_active = '';
if ( FLBuilderModel::is_builder_active() ) {
	$is_builder_active = 'yes';
}
?>
jQuery(document).ready(function() {
	new UABBOffCanvasModule({
		id: '<?php echo esc_attr( $id ); ?>',
		overlay_click: '<?php echo esc_attr( $settings->overlay_click ); ?>',
		esc_keypress: '<?php echo esc_attr( $settings->esc_keypress ); ?>',
		preview_off_canvas: '<?php echo esc_attr( $settings->preview_off_canvas ); ?>',
		offcanvas_on: '<?php echo esc_attr( $settings->offcanvas_on ); ?>',
		offcanvas_custom: '<?php echo esc_attr( $settings->off_canvas_custom ); ?>',
		close_on: '<?php echo esc_attr( $settings->close_on_link ); ?>',
		is_builder_active : '<?php echo esc_attr( $is_builder_active ); ?>',
		collapse_inactive : '<?php echo esc_attr( $settings->collapse_inactive ); ?>',
		submenu_toggle : '<?php echo esc_attr( $settings->submenu_toggle ); ?>'
	});

});

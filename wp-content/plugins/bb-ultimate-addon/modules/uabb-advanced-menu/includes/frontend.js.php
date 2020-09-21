<?php
/**
 *  UABB Creative Menu front-end JS php file
 *
 *  @package UABB Creative Menu
 */

?>
<?php

	// Set defaults.
	$menu_type         = isset( $settings->creative_menu_layout ) ? $settings->creative_menu_layout : 'horizontal';
	$mobile            = isset( $settings->creative_menu_mobile_toggle ) ? $settings->creative_menu_mobile_toggle : 'expanded';
	$below_row         = 'below-row' === $settings->creative_mobile_menu_type ? 'true' : 'false';
	$mobile_breakpoint = isset( $settings->creative_menu_mobile_breakpoint ) ? $settings->creative_menu_mobile_breakpoint : 'mobile';
?>

jQuery(document).ready(function(){
	new UABBCreativeMenu({
		id: '<?php echo esc_attr( $id ); ?>',
		type: '<?php echo esc_attr( $menu_type ); ?>',
		mobile: '<?php echo esc_attr( $mobile ); ?>',
		mobileBelowRow: <?php echo esc_attr( $below_row ); ?>,
		breakPoints: {
			medium: <?php echo esc_attr( $global_settings->medium_breakpoint ); ?>,
			small: <?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>,
			custom: <?php echo esc_attr( ( $settings->custom_breakpoint ) ? $settings->custom_breakpoint : '768' ); ?>
		},
		mobileBreakpoint: '<?php echo esc_attr( $mobile_breakpoint ); ?>',
		mediaBreakpoint: '<?php echo wp_kses_post( $module->media_breakpoint() ); ?>',
		mobileMenuType: '<?php echo esc_attr( $settings->creative_mobile_menu_type ); ?>',
		fullScreenAnimation: '',
		isBuilderActive: <?php echo ( FLBuilderModel::is_builder_active() ) ? 'true' : 'false'; ?>
	});
});


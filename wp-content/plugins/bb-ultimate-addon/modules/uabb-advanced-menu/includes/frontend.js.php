<?php
/**
 *  UABB Creative Menu front-end JS php file
 *
 *  @package UABB Creative Menu
 */

?>
<?php

	// Set defaults.
	$type              = isset( $settings->creative_menu_layout ) ? $settings->creative_menu_layout : 'horizontal';
	$mobile            = isset( $settings->creative_menu_mobile_toggle ) ? $settings->creative_menu_mobile_toggle : 'expanded';
	$below_row         = 'below-row' == $settings->creative_mobile_menu_type ? 'true' : 'false';
	$mobile_breakpoint = isset( $settings->creative_menu_mobile_breakpoint ) ? $settings->creative_menu_mobile_breakpoint : 'mobile';
?>

jQuery(document).ready(function(){
	new UABBCreativeMenu({
		id: '<?php echo $id; ?>',
		type: '<?php echo $type; ?>',
		mobile: '<?php echo $mobile; ?>',
		mobileBelowRow: <?php echo $below_row; ?>,
		breakPoints: {
			medium: <?php echo $global_settings->medium_breakpoint; ?>,
			small: <?php echo $global_settings->responsive_breakpoint; ?>,
			custom: <?php echo $settings->custom_breakpoint; ?>
		},
		mobileBreakpoint: '<?php echo $mobile_breakpoint; ?>',
		mediaBreakpoint: '<?php echo $module->media_breakpoint(); ?>',
		mobileMenuType: '<?php echo $settings->creative_mobile_menu_type; ?>',
		fullScreenAnimation: '',
		isBuilderActive: <?php echo ( FLBuilderModel::is_builder_active() ) ? 'true' : 'false'; ?>
	});
});


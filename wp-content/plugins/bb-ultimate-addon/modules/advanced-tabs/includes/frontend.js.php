<?php
/**
 *  UABB Advanced Tabs Module front-end file
 *
 *  @package UABB Advanced Tabs Module
 */

?>
(function($) {

	$(function() {
		new UABBTabs({
			id: '<?php echo esc_attr( $id ); ?>'
		});
	});

})(jQuery);
<?php
$settings->responsive_breakpoint = ( isset( $settings->responsive_breakpoint ) && '' !== $settings->responsive_breakpoint ) ? $settings->responsive_breakpoint : $global_settings->responsive_breakpoint;
if ( 'accordion' === $settings->responsive ) {
	?>
	jQuery(window).resize(function() {
		var breakpoint_val = parseInt( '<?php echo esc_attr( $settings->responsive_breakpoint ); ?>' );
		if( jQuery(document).width() <= breakpoint_val ) {

			<?php
			if ( 'yes' === $settings->enable_first ) {
				?>
			jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-tabs').find('.uabb-content-current .uabb-content').slideUp('normal');
				<?php
			}
			?>
		}
	});

	jQuery(document).ready(function() {
		var breakpoint_val = parseInt( '<?php echo esc_attr( $settings->responsive_breakpoint ); ?>' );
		if( jQuery(document).width() <= breakpoint_val ) {

			<?php
			if ( 'yes' === $settings->enable_first ) {
				?>
			jQuery('.fl-node-<?php echo esc_attr( $id ); ?> .uabb-tabs').find('.uabb-content-current .uabb-content').slideUp('normal');
				<?php
			}
			?>
		}
	});
	<?php
}
?>

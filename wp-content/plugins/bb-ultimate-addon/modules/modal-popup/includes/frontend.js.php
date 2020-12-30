<?php
/**
 *  UABB Modal Popup Module front-end JS php file
 *
 *  @package UABB Modal Popup Module
 */

?>

jQuery(document).ready(function($){
	if( 'function' === typeof UABBModalPopup ) {
		var UABBModalPopup_<?php echo esc_attr( $id ); ?> =  new UABBModalPopup({
			id: '<?php echo esc_attr( $id ); ?>',
			modal_on: '<?php echo esc_attr( $settings->modal_on ); ?>',
			modal_custom: '<?php echo esc_attr( $settings->modal_custom ); ?>',
			modal_content: '<?php echo esc_attr( $settings->content_type ); ?>',
			video_autoplay: '<?php echo esc_attr( $settings->video_autoplay ); ?>',
			enable_cookies: '<?php echo esc_attr( $settings->enable_cookies ); ?>',
			expire_cookie: '<?php echo esc_attr( $settings->close_cookie_days ); ?>',
			esc_keypress: '<?php echo esc_attr( $settings->esc_keypress ); ?>',
			overlay_click: '<?php echo esc_attr( $settings->overlay_click ); ?>',
			responsive_display: '<?php echo esc_attr( $settings->responsive_display ); ?>',
			medium_device: '<?php echo esc_attr( $global_settings->medium_breakpoint ); ?>',
			small_device: '<?php echo esc_attr( $global_settings->responsive_breakpoint ); ?>',
		});

		<?php if ( '' !== $settings->modal_width && ( 'youtube' === $settings->content_type || 'vimeo' === $settings->content_type ) ) { ?>
			setTimeout(function(){
				$(".uamodal-<?php echo esc_attr( $id ); ?> .uabb-modal-content-data").fitVids();
			}, 300);
		<?php } ?>

		/*<?php if ( 'custom' === $settings->modal_on && '' !== $settings->modal_custom ) { ?>
			var custom_wrap = $("<?php echo esc_attr( $settings->modal_custom ); ?>");

			custom_wrap.addClass("uabb-modal-action uabb-trigger");
			custom_wrap.attr( 'data-modal', "modal-<?php echo esc_attr( $id ); ?>" );
		<?php } ?>*/
		<?php if ( 'automatic' === $settings->modal_on && ! FLBuilderModel::is_builder_active() ) { ?>
			<?php if ( $settings->after_second ) { ?>
				setTimeout(function() {
					UABBModalPopup_<?php echo esc_attr( $id ); ?>._showAutomaticModalPopup();
				},<?php echo esc_attr( $settings->after_second_value ) . '000'; ?>);
			<?php } ?>

			<?php if ( $settings->exit_intent ) { ?>
				$(this).on('mouseleave', function(e){
					if( e.clientY < 0 ) {
						UABBModalPopup_<?php echo esc_attr( $id ); ?>._showAutomaticModalPopup();
					}
				});
			<?php } ?>
		<?php } ?>

		<?php if ( FLBuilderModel::is_builder_active() ) { ?>
			$( ".uabb-live-preview-button" ).click(function() {
				setTimeout(function(){
					UABBModalPopup_<?php echo esc_attr( $id ); ?>._initModalPopup();
				}, 200);
			});
		<?php } ?>
	}
});

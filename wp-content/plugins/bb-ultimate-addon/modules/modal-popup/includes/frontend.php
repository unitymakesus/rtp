<?php
/**
 *  UABB Modal Popup Module front-end file
 *
 *  @package UABB Modal Popup Module
 */

?>

<div <?php echo ( '' != $settings->id ) ? 'id="' . $settings->id . '-overlay"' : ''; ?> class="uabb-modal-parent-wrapper uabb-module-content uamodal-<?php echo $id; ?> <?php echo ( '' != $settings->class ) ? $settings->class . '-overlay' : ''; ?>">
	<div class="uabb-modal uabb-drag-fix uabb-center-modal uabb-modal-<?php echo $settings->content_type; ?> uabb-modal-custom <?php echo $settings->modal_effect; ?> uabb-aspect-ratio-<?php echo $settings->video_ratio; ?>" id="modal-<?php echo $id; ?>" data-content="<?php echo $settings->content_type; ?>">
		<div class="uabb-content ">
			<?php if ( ( ( 'icon' == $settings->close_source && '' != $settings->close_icon ) || ( 'image' == $settings->close_source && '' != $settings->close_photo ) ) && ( 'popup-top-left' == $settings->icon_position || 'popup-top-right' == $settings->icon_position || 'popup-edge-top-right' == $settings->icon_position || 'popup-edge-top-left' == $settings->icon_position ) ) { ?>
			<span class="uabb-modal-close uabb-close-custom-<?php echo $settings->icon_position; ?>" >
				<?php
				$close_photo_src = ( isset( $settings->close_photo_src ) ) ? $settings->close_photo_src : '';
				if ( 'icon' == $settings->close_source ) {
					echo '<i class="uabb-close-icon ' . $settings->close_icon . '"></i>';
				} else {
					echo '<img class="uabb-close-image" src="' . $close_photo_src . '"/>';
				}
				?>
			</span>
			<?php } ?>

			<?php if ( $settings->enable_title && '' != $settings->modal_width ) { ?>
			<div class="uabb-modal-title-wrap">
			<<?php echo $settings->title_tag_selection; ?> class="uabb-modal-title"><?php echo ( '' != $settings->title ) ? $settings->title : 'This is modal title'; ?></<?php echo $settings->title_tag_selection; ?>>
			</div>
			<?php } ?>
			<div class="uabb-modal-text uabb-modal-content-data <?php echo ( 'content' == $settings->content_type ) ? 'uabb-text-editor' : ''; ?> fl-clearfix">
			<?php echo $module->get_modal_content( $settings ); ?>
			</div>

		</div>
	</div>

	<?php if ( ( ( 'icon' == $settings->close_source && '' != $settings->close_icon ) || ( 'image' == $settings->close_source && '' != $settings->close_photo ) ) && ( 'top-left' == $settings->icon_position || 'top-right' == $settings->icon_position ) ) { ?>
	<span class="uabb-modal-close uabb-close-custom-<?php echo $settings->icon_position; ?>" >
		<?php
		$close_photo_src = ( isset( $settings->close_photo_src ) ) ? $settings->close_photo_src : '';
		if ( 'icon' == $settings->close_source ) {
			echo '<i class="uabb-close-icon ' . $settings->close_icon . '"></i>';
		} else {
			$image_data = FLBuilderPhoto::get_attachment_data( $settings->close_photo );
			$image_alt  = isset( $image_data->alt ) ? $image_data->alt : '';
			echo '<img class="uabb-close-image" src="' . $close_photo_src . '" alt="' . $image_alt . '"/>';
		}
		?>
			</span>
	<?php } ?>
	<div class="uabb-overlay"></div>
</div>

<div class="uabb-modal-action-wrap">
<?php if ( 'button' == $settings->modal_on ) { ?>
	<?php $module->render_button( $id ); ?>
<?php } elseif ( 'text' == $settings->modal_on ) { ?>
	<div class="uabb-modal-action uabb-trigger" data-modal="<?php echo $id; ?>"><?php echo $settings->modal_text; ?></div>
<?php } elseif ( 'icon' == $settings->modal_on ) { ?>
<div class="uabb-modal-action uabb-trigger uabb-modal-icon-wrap" data-modal="<?php echo $id; ?>"><i class="uabb-modal-icon <?php echo $settings->icon; ?>"></i></div>
<?php } elseif ( 'photo' == $settings->modal_on ) { ?>
	<?php
		$img_src = '';
	if ( isset( $settings->photo_src ) && ! empty( $settings->photo_src ) ) {
		$image_data = FLBuilderPhoto::get_attachment_data( $settings->photo );
		$image_alt  = isset( $image_data->alt ) ? $image_data->alt : '';
		$img_src    = $settings->photo_src;
		?>
	<div class="uabb-modal-action uabb-trigger uabb-modal-photo-wrap" data-modal="<?php echo $id; ?>"><img class="uabb-modal-photo" src="<?php echo $img_src; ?>" alt="<?php echo $image_alt; ?>"></div>
	<?php } ?>
<?php }if ( ( 'custom' == $settings->modal_on || 'automatic' == $settings->modal_on ) && FLBuilderModel::is_builder_active() ) { ?>
	<div class="uabb-builder-msg" style="text-align: center;">
		<h5><?php _e( 'Modal Popup - ID ', 'uabb' ); ?><?php echo $module->node; ?></h5>
		<?php _e( 'Click here to edit the "Modal Popup" settings. This text will not be visible on frontend.', 'uabb' ); ?>
	</div>
<?php } ?>
</div>

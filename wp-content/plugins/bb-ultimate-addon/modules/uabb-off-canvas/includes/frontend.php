<?php
/**
 *  UABB Off Canvas Module front-end file
 *
 *  @package UABB Off Canvas
 */

$img_src = '';
if ( 'button' === $settings->offcanvas_on ) {

	$module->render_button( $id );
} elseif ( 'text' === $settings->offcanvas_on ) {
	?>
	<div class="uabb-offcanvas-action uabb-offcanvas-trigger uabb-offcanvas-text-wrap" data-modal="<?php echo $id; ?>"><?php echo $settings->offcanvas_text; ?></div>
	<?php
} elseif ( 'icon' === $settings->offcanvas_on ) {
	?>
	<div class="uabb-offcanvas-action uabb-offcanvas-trigger uabb-offcanvas-icon-wrap" data-modal="<?php echo $id; ?>"><i class="uabb-offcanvas-icon <?php echo $settings->icon; ?>"></i></div>
	<?php
} elseif ( 'photo' === $settings->offcanvas_on ) {

	if ( isset( $settings->photo_src ) && ! empty( $settings->photo_src ) ) {
		$img_src = $settings->photo_src;
		?>
		<div class="uabb-offcanvas-action uabb-offcanvas-trigger uabb-offcanvas-photo-wrap" data-modal="<?php echo $id; ?>"><img class="uabb-offcanvas-photo" src="<?php echo $img_src; ?>"></div>
		<?php
	}
}
if ( ( 'custom' === $settings->offcanvas_on || 'automatic' === $settings->offcanvas_on ) && FLBuilderModel::is_builder_active() ) {
	?>
	<div class="uabb-builder-msg" style="text-align: center;">
		<h5><?php _e( 'Off - Canvas - ID ', 'uabb' ); ?><?php echo $id; ?></h5>
		<?php _e( 'Click here to edit the "Off - Canvas" settings. This text will not be visible on frontend.', 'uabb' ); ?>
	</div>
	<?php
}
echo $module->render( $id );


<?php
/**
 * Render the frontend content.
 *
 * @package UABB Info Table Module
 */

global $wp_embed;
$target           = '';
$it_link_nofollow = '';
if ( UABB_Compatibility::check_bb_version() ) {

	if ( isset( $settings->it_link_target ) ) {
		$target = $settings->it_link_target;
	}
	if ( isset( $settings->it_link_nofollow ) ) {
		$it_link_nofollow = ( 'yes' == $settings->it_link_nofollow ) ? '1' : '';
	}
} else {
	if ( isset( $settings->it_link_target ) ) {
		$target = $settings->it_link_target;
	}
	if ( isset( $settings->it_link_nofollow ) ) {
		$it_link_nofollow = $settings->it_link_nofollow;
	}
}
?>
<?php if ( 'complete_link' == $settings->it_link_type ) { ?>
<a href="<?php echo $settings->it_link; ?>" target="<?php echo $target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $target, $it_link_nofollow, 1 ); ?>>
<?php } ?>
<div class="uabb-module-content info-table-wrap info-table-<?php echo $settings->box_design; ?> info-table-cs-<?php echo $settings->color_scheme; ?>">
	<div class="info-table">
		<div class="info-table-heading">
			<?php echo '<' . $settings->heading_tag_selection . " class='info-table-main-heading'>"; ?>
			<?php echo $settings->it_title; ?>
			<?php echo '</' . $settings->heading_tag_selection . '>'; ?>

			<?php echo '<' . $settings->sub_heading_tag_selection . " class='info-table-sub-heading'>"; ?>
			<?php echo $settings->sub_heading; ?>
			<?php echo '</' . $settings->sub_heading_tag_selection . '>'; ?>
			<?php if ( 'cta' == $settings->it_link_type && 'design02' == $settings->box_design ) { ?>
			<div class="info-table-button">
				<a href="<?php echo $settings->it_link; ?>" target="<?php echo $target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $target, $it_link_nofollow, 1 ); ?>><?php echo $settings->button_text; ?></a>
			</div>
			<?php } ?>
		</div>
		<div class="info-table-icon">
			<?php
			$imageicon_array = array(

				/* General Section */
				'image_type'            => $settings->image_type,

				/* Icon Basics */
				'icon'                  => $settings->icon,
				'icon_size'             => $settings->icon_size,
				'icon_align'            => 'center',

				/* Image Basics */
				'photo_source'          => $settings->photo_source,
				'photo'                 => $settings->photo,
				'photo_url'             => $settings->photo_url,
				'img_size'              => $settings->img_size,
				'img_align'             => 'center',
				'photo_src'             => ( isset( $settings->photo_src ) ) ? $settings->photo_src : '',

				/* Icon Style */
				'icon_style'            => $settings->icon_style,
				'icon_bg_size'          => $settings->icon_bg_size,
				'icon_border_style'     => $settings->icon_border_style,
				'icon_border_width'     => $settings->icon_border_width,
				'icon_bg_border_radius' => $settings->icon_bg_border_radius,

				/* Image Style */
				'image_style'           => $settings->image_style,
				'img_bg_size'           => $settings->img_bg_size,
				'img_border_style'      => $settings->img_border_style,
				'img_border_width'      => $settings->img_border_width,
				'img_bg_border_radius'  => $settings->img_bg_border_radius,
			);
			/* Render HTML Function */
			FLBuilder::render_module_html( 'image-icon', $imageicon_array );
			?>
		</div>
		<div class="info-table-description uabb-text-editor">
			<?php echo wpautop( $wp_embed->autoembed( $settings->it_long_desc ) ); ?>
		</div>
		<?php if ( 'cta' == $settings->it_link_type && 'design02' != $settings->box_design ) { ?>
		<div class="info-table-button">
			<a href="<?php echo $settings->it_link; ?>" target="<?php echo $target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $target, $it_link_nofollow, 1 ); ?>><?php echo $settings->button_text; ?></a>
		</div>
		<?php } ?>
	</div>
</div>
<?php if ( 'complete_link' == $settings->it_link_type ) { ?>
</a>
<?php } ?>

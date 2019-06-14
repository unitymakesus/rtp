<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Advanced Accordion
 */

?>

<div class="<?php echo ( FLBuilderModel::is_builder_active() ) ? 'uabb-accordion-edit ' : ''; ?>uabb-module-content uabb-adv-accordion 
						<?php
						if ( 'yes' == $settings->collapse ) {
							echo 'uabb-adv-accordion-collapse';}
						?>
" <?php echo 'data-enable_first="' . $settings->enable_first . '"'; ?>>
	<?php
	for ( $i = 0; $i < count( $settings->acc_items );
	$i++ ) :
		if ( empty( $settings->acc_items[ $i ] ) ) {
			continue;}
		?>
	<div class="uabb-adv-accordion-item"
		<?php
		if ( ! empty( $settings->id ) ) {
			echo ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"';}
		?>
	data-index="<?php echo $i; ?>">
		<div class="uabb-adv-accordion-button uabb-adv-accordion-button<?php echo $id; ?> uabb-adv-<?php echo $settings->icon_position; ?>-text">
			<?php echo $module->render_icon( 'before' ); ?>
			<<?php echo $settings->tag_selection; ?> class="uabb-adv-accordion-button-label"><?php echo $settings->acc_items[ $i ]->acc_title; ?></<?php echo $settings->tag_selection; ?>>
			<?php echo $module->render_icon( 'after' ); ?>
		</div>
		<div class="uabb-adv-accordion-content uabb-adv-accordion-content<?php echo $id; ?> fl-clearfix <?php echo ( 'content' == $settings->acc_items[ $i ]->content_type ) ? 'uabb-accordion-desc uabb-text-editor' : ''; ?>">
			<?php
			if ( isset( $settings->acc_items[ $i ]->acc_content ) && 'content' == $settings->acc_items[ $i ]->content_type && '' != $settings->acc_items[ $i ]->acc_content && '' == $settings->acc_items[ $i ]->ct_content ) {
				global $wp_embed;
				echo wpautop( $wp_embed->autoembed( $settings->acc_items[ $i ]->acc_content ) );
			} else {
				echo $module->get_accordion_content( $settings->acc_items[ $i ] );
			}
			?>
		</div>
	</div>
	<?php endfor; ?>
</div>

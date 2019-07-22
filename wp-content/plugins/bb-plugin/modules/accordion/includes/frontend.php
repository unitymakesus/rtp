<?php global $wp_embed; ?>
<div class="fl-accordion fl-accordion-<?php echo $settings->label_size; ?><?php echo ( $settings->collapse ) ? ' fl-accordion-collapse' : ''; ?>" role="tablist"<?php echo ( ! $settings->collapse ) ? 'multiselectable="true"' : ''; ?>>
	<?php
	for ( $i = 0; $i < count( $settings->items ); $i++ ) :
		if ( empty( $settings->items[ $i ] ) ) {
			continue;
		}
		?>
	<div class="fl-accordion-item"<?php echo ( ! empty( $settings->id ) ) ? ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"' : ''; ?>>
		<div class="fl-accordion-button" id="<?php echo 'fl-accordion-' . $module->node . '-tab-' . $i; ?>" aria-selected="false" aria-controls="<?php echo 'fl-accordion-' . $module->node . '-panel-' . $i; ?>" aria-expanded="<?php echo ( $i > 0 || ! $settings->open_first ) ? 'false' : 'true'; ?>" role="tab" tabindex="0">

			<?php if ( 'left' === $settings->label_icon_position ) : ?>
			<i class="fl-accordion-button-icon fl-accordion-button-icon-left <?php echo $settings->label_icon; ?>"></i>
			<?php endif; ?>

			<div class="fl-accordion-button-label" tabindex="0"><?php echo $settings->items[ $i ]->label; ?></div>

			<?php if ( 'right' === $settings->label_icon_position ) : ?>
			<i class="fl-accordion-button-icon fl-accordion-button-icon-right <?php echo $settings->label_icon; ?>"></i>
			<?php endif; ?>

		</div>
		<div class="fl-accordion-content fl-clearfix" id="<?php echo 'fl-accordion-' . $module->node . '-panel-' . $i; ?>" aria-labelledby="<?php echo 'fl-accordion-' . $module->node . '-tab-' . $i; ?>" aria-hidden="<?php echo ( $i > 0 || ! $settings->open_first ) ? 'true' : 'false'; ?>" role="tabpanel" aria-live="polite"><?php echo wpautop( $wp_embed->autoembed( $settings->items[ $i ]->content ) ); ?></div>
	</div>
	<?php endfor; ?>
</div>

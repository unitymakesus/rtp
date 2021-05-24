<?php
/**
 *  UABB Advanced Tabs Module front-end file
 *
 *  @package UABB Advanced Tabs Module
 */

global $wp_embed;

/* Fallback depricated underline Style */
if ( 'underline' === $settings->style ) {
	$settings->style         = 'topline';
	$settings->line_position = 'bottom';
}
$tab_positions = '';
if ( 'vertical' === $settings->tab_layout ) {
	$tab_positions = 'uabb-tab-position-' . $settings->tab_position;
}
?>
	<div class="uabb-module-content uabb-tabs uabb-tabs-layout-<?php echo esc_attr( $settings->tab_layout ); ?> <?php echo esc_attr( $tab_positions ); ?> uabb-tabs-style-<?php echo esc_attr( $settings->style ); ?>">
		<nav class="uabb-tabs-nav uabb-tabs-nav<?php echo esc_attr( $id ); ?>">
			<ul>
				<?php
				$count = count( $settings->items );
				for ( $i = 0; $i < $count;
				$i++ ) :
					if ( ! is_object( $settings->items[ $i ] ) ) {
						continue;
					}
					$class = ( 'yes' === $settings->show_icon || 'iconfall' === $settings->style ) ? '<span class="uabb-tabs-icon"><i class= " ' . esc_attr( $settings->items[ $i ]->tab_icon ) . '"></i></span>' : '';
					?>
				<li class="<?php echo ( (int) $settings->active_tab === $i ) ? 'uabb-tab-current' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>">
					<<?php echo esc_attr( $settings->title_tag_selection ); ?> class="uabb-tag-selected">
						<a class="uabb-tab-link" href="javascript:void(0);" class=""><?php echo wp_kses_post( $class ); ?><span class="uabb-tab-title"><?php echo $settings->items[ $i ]->label; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<?php if ( isset( $settings->items[ $i ]->description ) && ! empty( $settings->items[ $i ]->description ) ) { ?>
					<div class="uabb-tab-description">
							<?php echo $settings->items[ $i ]->description; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
						</a>
					</<?php echo esc_attr( $settings->title_tag_selection ); ?>>
				</li>
				<?php endfor; ?>
			</ul>
		</nav>
		<div class="uabb-content-wrap uabb-content-wrap<?php echo esc_attr( $id ); ?>">
			<?php
			for ( $i = 0; $i < $count; $i++ ) :
				if ( ! is_object( $settings->items[ $i ] ) ) {
					continue;
				}

				$class = ( 'yes' === $settings->show_icon || 'iconfall' === $settings->style ) ? '<span class="uabb-tabs-icon"><i class= " ' . $settings->items[ $i ]->tab_icon . '"></i></span>' : '';
				?>

			<div id="section-<?php echo esc_attr( $settings->style ); ?>-<?php echo esc_attr( $i ); ?>" class="<?php echo esc_attr( $settings->id ) . '-' . esc_attr( $i ); ?> section <?php echo ( (int) $settings->active_tab === $i ) ? 'uabb-content-current' : ''; ?>">
				<?php if ( 'accordion' === $settings->responsive ) : ?>
				<div class="uabb-tab-acc-title uabb-acc-<?php echo esc_attr( $i ); ?>">
					<<?php echo esc_attr( $settings->title_tag_selection ); ?> class="uabb-title-tag">
						<?php echo ( 'right' !== $settings->icon_position ) ? wp_kses_post( $class ) : ''; ?>
						<span class="uabb-tab-title"><?php echo $settings->items[ $i ]->label; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<?php echo ( 'right' === $settings->icon_position ) ? wp_kses_post( $class ) : ''; ?>
					</<?php echo esc_attr( $settings->title_tag_selection ); ?>>
					<span class="uabb-acc-icon"><i class="ua-icon ua-icon-chevron-down2"></i></span>
				</div>
				<?php endif; ?>
				<div class="uabb-content uabb-tab-acc-content clearfix <?php echo ( 'content' === $settings->items[ $i ]->content_type ) ? 'uabb-tabs-desc uabb-text-editor' : ''; ?>">
					<?php
					if ( isset( $settings->items[ $i ]->content ) && 'content' === $settings->items[ $i ]->content_type && '' !== $settings->items[ $i ]->content && '' === $settings->items[ $i ]->ct_content ) {
						global $wp_embed;
						echo wp_kses_post( wpautop( $wp_embed->autoembed( $settings->items[ $i ]->content ) ) );
					} else {
						echo $module->get_tab_content( $settings->items[ $i ] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			</div>	
			<?php endfor; ?>
		</div><!-- /content -->
	</div><!-- /tabs -->

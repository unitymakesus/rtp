<?php
/**
 *  UABB Advanced Tabs Module front-end file
 *
 *  @package UABB Advanced Tabs Module
 */

global $wp_embed;

/* Fallback depricated underline Style */
if ( 'underline' == $settings->style ) {
	$settings->style         = 'topline';
	$settings->line_position = 'bottom';
}
?>
	<div class="uabb-module-content uabb-tabs uabb-tabs-style-<?php echo $settings->style; ?>">
		<nav class="uabb-tabs-nav uabb-tabs-nav<?php echo $id; ?>">
			<ul>
				<?php
				for ( $i = 0; $i < count( $settings->items );
				$i++ ) :
					if ( ! is_object( $settings->items[ $i ] ) ) {
						continue;
					}
					$class = ( 'yes' == $settings->show_icon || 'iconfall' == $settings->style ) ? '<span class="uabb-tabs-icon"><i class= " ' . $settings->items[ $i ]->tab_icon . '"></i></span>' : '';
					?>
				<li class="<?php echo ( 0 == $i ) ? 'uabb-tab-current' : ''; ?>" data-index="<?php echo $i; ?>">
					<<?php echo $settings->title_tag_selection; ?> class="uabb-tag-selected">
						<a class="uabb-tab-link" href="javascript:void(0);" class=""><?php echo $class; ?><span class="uabb-tab-title"><?php echo $settings->items[ $i ]->label; ?></span></a>
					</<?php echo $settings->title_tag_selection; ?>>
				</li>
				<?php endfor; ?>
			</ul>
		</nav>
		<div class="uabb-content-wrap uabb-content-wrap<?php echo $id; ?>">
			<?php
			for ( $i = 0; $i < count( $settings->items ); $i++ ) :
				if ( ! is_object( $settings->items[ $i ] ) ) {
					continue;
				}

				$class = ( 'yes' == $settings->show_icon || 'iconfall' == $settings->style ) ? '<span class="uabb-tabs-icon"><i class= " ' . $settings->items[ $i ]->tab_icon . '"></i></span>' : '';
				?>

			<div id="section-<?php echo $settings->style; ?>-<?php echo $i; ?>" class="<?php echo $settings->id . '-' . $i; ?> section <?php echo ( 0 == $i ) ? 'uabb-content-current' : ''; ?>">
				<?php if ( 'accordion' == $settings->responsive ) : ?>
				<div class="uabb-tab-acc-title uabb-acc-<?php echo $i; ?>">
					<<?php echo $settings->title_tag_selection; ?> class="uabb-title-tag">
						<?php echo ( 'right' != $settings->icon_position ) ? $class : ''; ?>
						<span class="uabb-tab-title"><?php echo $settings->items[ $i ]->label; ?></span>
						<?php echo ( 'right' == $settings->icon_position ) ? $class : ''; ?>
					</<?php echo $settings->title_tag_selection; ?>>
					<span class="uabb-acc-icon"><i class="ua-icon ua-icon-chevron-down2"></i></span>
				</div>
				<?php endif; ?>
				<div class="uabb-content uabb-tab-acc-content clearfix <?php echo ( 'content' == $settings->items[ $i ]->content_type ) ? 'uabb-tabs-desc uabb-text-editor' : ''; ?>">
					<?php
					if ( isset( $settings->items[ $i ]->content ) && 'content' == $settings->items[ $i ]->content_type && '' != $settings->items[ $i ]->content && '' == $settings->items[ $i ]->ct_content ) {
						global $wp_embed;
						echo wpautop( $wp_embed->autoembed( $settings->items[ $i ]->content ) );
					} else {
						echo $module->get_tab_content( $settings->items[ $i ] );
					}
					?>
				</div>
			</div>	
			<?php endfor; ?>
		</div><!-- /content -->
	</div><!-- /tabs -->

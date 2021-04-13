<?php
/**
 *  UABB Search Module results file
 *
 *  @package UABB Search Module
 */

?>
<div class="uabb-search-results">
	<?php
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {

			$query->the_post();
			?>

			<div class="uabb-search-post-item">
				<?php if ( $settings->show_image ) { ?>
				<div class="uabb-search-post-image">
					<?php $module->render_featured_image( get_the_id() ); ?>
				</div>
				<?php } ?>

				<div class="uabb-search-post-text">

					<div class="uabb-search-post-title" itemprop="headline">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</div>

					<?php if ( $settings->show_content ) { ?>
					<div class="uabb-search-post-content">
						<?php the_excerpt(); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	} else {
		?>
		<div class="uabb-search-no-posts">
			<p><?php echo $settings->no_results_message; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		</div>
		<?php
	}
	?>
</div>
<div class="uabb-clear"></div>

<?php wp_reset_postdata(); ?>

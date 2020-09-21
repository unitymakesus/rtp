<?php

namespace App;

/**
 * Staff list shortcode
 */
add_shortcode('team', function($atts) {
	$people = new \WP_Query([
		'post_type' => 'simple-team',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	]);

	ob_start(); ?>

	<div class='team-container flex-grid l3x m2x s1x'>

	<?php if ($people->have_posts()) :
		while ($people->have_posts()) : $people->the_post();
		?>

		<div class="flex-item">
	    <div class="person">
	      <div class="person-img">
					<?php if (!empty($image = get_field('primary_image'))) { ?>
						<img class="biopic" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php } ?>

					<?php if (!empty($imagehov = get_field('hover_image'))) { ?>
						<img class="biopic-hover" src="<?php echo $imagehov['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php } ?>
	      </div>
	      <div class="person-info">
					<span class="roles">
						<?php
							$terms = wp_get_post_terms( get_the_id(), 'simple-team-category');
							echo join(' <span class="interpunct">&#183;</span> ', wp_list_pluck($terms, 'name'));
						?>
					</span>

	        <h2 itemprop="name"><?php the_title(); ?></h2>

	        <?php if (!empty($title = get_field('title'))) { ?>
	          <h3 class="title" itemprop="jobTitle"><?php echo $title; ?></h3>
	        <?php } ?>

	        <?php
	          if (!empty($short_bio = get_field('short_bio'))) {
	            echo $short_bio;
						}
						if (!empty(get_field('longer_bio'))) {
	            echo '<p><a href="' . get_permalink() . '">Read more >></a>';
	          }
	        ?>
	      </div>
	    </div>
		</div>

		<?php
		endwhile; endif; wp_reset_postdata(); ?>

	</div>

	<?php return ob_get_clean();
});

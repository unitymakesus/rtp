<?php
// Save the current post, so that it can be restored later
global $post;
$initial_current_post = $post;

$events = $module->query_events($settings);
?>

<div class="flex-grid l3x m2x">
  <?php

    if (!empty($events)) : foreach ($events as $post) : setup_postdata($post);

    $id = get_the_ID();
    $startDate = strtotime(get_post_meta($id, 'mec_start_date', true));
    $startH = get_post_meta($id, 'mec_start_time_hour', true);
    $starti = get_post_meta($id, 'mec_start_time_minutes', true);
    $starta = get_post_meta($id, 'mec_start_time_ampm', true);
    $endH = get_post_meta($id, 'mec_end_time_hour', true);
    $endi = get_post_meta($id, 'mec_end_time_minutes', true);
    $enda = get_post_meta($id, 'mec_end_time_ampm', true);
    $locationID = get_post_meta($id, 'mec_location_id', true);
    $location = get_term($locationID, 'mec_location');
    ?>
    <article class="figure-card">
      <?php if (has_post_thumbnail()) : ?>
        <?php
          $thumbnail_id = get_post_thumbnail_id( $post->ID );
          $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
          echo get_the_post_thumbnail( $post->ID, 'full', ['alt' => $alt, 'itemprop' => 'image'] );
        ?>
      <?php else : ?>
        <div class="placeholder"></div>
      <?php endif; ?>

      <div class="card card-cta card-pattern" itemprop="description">
        <div class="badge"><span><?php echo $module->siteBadge(); ?></span></div>

        <div class="meta">
          <time class="date startDate" datetime="<?php echo date('F j, Y', $startDate); ?>" itemprop="startDate"><?php echo date('F j, Y', $startDate); ?></time>
        </div>

        <h3 class="card-title" itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

        <div class="details">
          <div class="time"><?php echo "$startH:$starti"; if ($starta !== $enda) echo " $starta"; ?> -
            <?php echo "$endH:$endi $enda"; ?></div>
          <div class="location"><?php echo $location->name; ?></div>
        </div>

        <div class="cta"><a href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-events-feed/images/arrow-right.svg'); ?></span></a></div>
      </div>

      <div class="pattern-background">
        <?php include(CBB_MODULES_DIR . 'modules/cbb-events-feed/includes/pattern-bracket.php'); ?>
      </div>
    </article>

    <?php
  endforeach;

  else:
    /*?>

    <article class="figure-card figure-card-vertical">
  		<?php echo wp_get_attachment_image($settings->image, 'full', false, ['alt' => $settings->image_alt, 'itemprop' => 'image']); ?>

      <div class="card" itemprop="description">
        <div class="card-badge"><span><?php echo $badge; ?></span></div>
        <h3 class="card-title" itemprop="name"><?php echo $settings->title; ?></h3>

    		<div class="card-content">
    			<?php echo $settings->content; ?>
    		</div>

    		<?php if ($settings->enable_cta == 'block') { ?>
        	<div class="card-cta"><a href="<?php echo $settings->cta_link; ?>"><span><?php echo $settings->cta_text; ?></span> <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-figure-card/images/arrow-right.svg'); ?></span></a></div>
    		<?php } ?>

      </div>

      <?php if ($settings->structure == 'vertical') { ?>
        <div class="pattern-background">
          <?php include(CBB_MODULES_DIR . 'modules/cbb-figure-card/includes/pattern-bracket.php'); ?>
        </div>
      <?php } ?>
    </article>

    <?php*/
  endif;

  wp_reset_postdata();

  ?>
</div>

<?php

// Restore the original current post.
$post = $initial_current_post;
setup_postdata( $initial_current_post );

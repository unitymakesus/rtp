<?php
// Save the current post, so that it can be restored later
global $post;
$initial_current_post = $post;

$events = $module->query_events($settings);
$count = sizeof($events);

if ($count >= 3) {
  $grid_class = "l3x m2x";
} elseif ($count == 2) {
  $grid_class = "l2x m2x";
} else {
  $grid_class = "m1x";
}
?>

<div class="flex-grid <?php echo $grid_class; ?>">
  <?php

  if (!empty($events)) : foreach ($events as $event) :
    $post = $event['result'];
    setup_postdata($post);

    $id = get_the_ID();
    $startDate = strtotime($event['date']);
    $startH = get_post_meta($id, 'mec_start_time_hour', true);
    $starti = sprintf('%02d', get_post_meta($id, 'mec_start_time_minutes', true));
    $starta = get_post_meta($id, 'mec_start_time_ampm', true);
    $endH = get_post_meta($id, 'mec_end_time_hour', true);
    $endi = sprintf('%02d', get_post_meta($id, 'mec_end_time_minutes', true));
    $enda = get_post_meta($id, 'mec_end_time_ampm', true);
    $locationID = get_post_meta($id, 'mec_location_id', true);
    $location = get_term($locationID, 'mec_location');

    $badge = $module->siteBadge($id);
    $classes = [
      'badge-' . str_replace(' ', '-', strtolower($badge))
    ];
    ?>
    <div class="flex-item">
      <article class="figure-card <?php echo (($settings->show_thumb) ? 'figure-card-vertical' : 'no-image'); ?> <?php echo implode(' ', $classes); ?>">
        <div class="figure-card-img">
          <?php if ($settings->show_thumb) {
            $siteID = get_post_meta($id, 'dt_original_blog_id', true);
            $origID = get_post_meta($id, 'dt_original_post_id', true);

            if (!empty($siteID)) {
              // If this is a syndicated post, switch to original site to get featured image
              switch_to_blog($siteID);
              $module->featuredImage($origID);
              restore_current_blog();
            } else {
              // Just get the featured image from this site
              $module->featuredImage($id);
            }
          } ?>
        </div>

        <div class="card" itemprop="description">
          <div class="meta">
            <time class="date startDate" datetime="<?php echo date('F j, Y', $startDate); ?>" itemprop="startDate"><?php echo date('F j, Y', $startDate); ?></time>
          </div>

          <div class="card-inner">
            <div class="card-badge"><span><?php echo $badge; ?></span></div>

            <h3 class="card-title" itemprop="name">
              <a class="a11y-link-wrap" href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </h3>

            <div class="card-content">
              <div class="time"><?php echo "$startH:$starti"; if ($starta !== $enda) echo " $starta"; ?> -
                <?php echo "$endH:$endi $enda"; ?></div>
                <?php if ($location) : ?>
                <div class="location"><?php echo $location->name; ?></div>
                <?php endif; ?>
            </div>

            <div class="card-cta" aria-hidden="true"><a tabindex="-1" href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
          </div>
        </div>

        <div class="pattern-background">
          <?php include(CBB_MODULES_DIR . 'assets/images/pattern-bracket.svg'); ?>
        </div>
      </article>
    </div>
    <?php
  endforeach;

  endif;

  wp_reset_postdata();

  ?>
</div>

<?php

// Restore the original current post.
$post = $initial_current_post;
setup_postdata( $initial_current_post );

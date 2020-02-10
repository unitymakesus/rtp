<?php
// Save the current post, so that it can be restored later
global $post;
$initial_current_post = $post;

$events = $module->query_events($settings);
$limit = (int)$settings->posts_per_page;
$count = sizeof($events);
$i = 0;

if ($count >= 3) {
  $grid_class = "l3x m2x";
} elseif ($count == 2) {
  $grid_class = "l2x m2x";
} else {
  $grid_class = "m1x";
}
?>

<div class="flex-grid l3x m2x">
  <?php

  if (!empty($events)) : while ($i < $limit) :

    $badge = $module->siteBadge(get_the_ID());
    $classes = [
      'badge-' . str_replace(' ', '-', strtolower($badge))
    ];

    if (!isset($events[$i]['result'])) {
      $nextday = $events[$i+1]['date'];
      ?>
      <div class="flex-item">
        <article class="figure-card no-image <?php echo implode(' ', $classes); ?>">
          <div class="placeholder"></div>

          <div class="card" itemprop="description">
            <div class="card-inner">
              <div class="card-badge"><span><?php echo $badge; ?></span></div>

              <h3 class="card-title" itemprop="name">Plan Ahead</h3>

              <div class="card-content">
                <p>We'll be back on <?php echo date('l, F j, Y', strtotime($nextday)); ?> with more fun things to do!</p>
              </div>
            </div>
          </div>

          <div class="pattern-background">
            <?php include(CBB_MODULES_DIR . 'assets/images/pattern-bracket.svg'); ?>
          </div>
        </article>
      </div>
      <?php
    } else {
      $post = $events[$i]['result'];
      setup_postdata($post);

      $id = get_the_ID();
      $startDate = strtotime($events[$i]['date']);
      $startH = get_post_meta($id, 'mec_start_time_hour', true);
      $starti = sprintf('%02d', get_post_meta($id, 'mec_start_time_minutes', true));
      $starta = get_post_meta($id, 'mec_start_time_ampm', true);
      $endH = get_post_meta($id, 'mec_end_time_hour', true);
      $endi = sprintf('%02d', get_post_meta($id, 'mec_end_time_minutes', true));
      $enda = get_post_meta($id, 'mec_end_time_ampm', true);
      $locationID = get_post_meta($id, 'mec_location_id', true);
      $location = get_term($locationID, 'mec_location');

      $badge = $module->siteBadge(get_the_ID());
      $classes = [
        'badge-' . str_replace(' ', '-', strtolower($badge))
      ];
      ?>
      <div class="flex-item">
        <article class="figure-card figure-card-vertical <?php echo implode(' ', $classes); ?>">
          <div class="figure-card-img">
            <?php
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
            ?>
          </div>

          <div class="card" itemprop="description">
            <div class="meta">
              <time class="date startDate" datetime="<?php echo date('F j, Y', $startDate); ?>" itemprop="startDate"><?php echo date('F j, Y', $startDate); ?></time>
            </div>

            <div class="card-inner">
              <div class="card-badge"><span><?php echo $badge; ?></span></div>

              <h3 class="card-title" itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

              <div class="card-content">
                <div class="time"><?php echo "$startH:$starti"; if ($starta !== $enda) echo " $starta"; ?> -
                  <?php echo "$endH:$endi $enda"; ?></div>
                  <?php if ($location) : ?>
                    <div class="location"><?php echo $location->name; ?></div>
                  <?php endif; ?>
              </div>

              <div class="card-cta"><a class="a11y-link-wrap" tabindex="-1" href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
            </div>
          </div>

          <div class="pattern-background">
            <?php include(CBB_MODULES_DIR . 'assets/images/pattern-bracket.svg'); ?>
          </div>
        </article>
      </div>
      <?php
    }
    $i++;
  endwhile; endif;

  wp_reset_postdata();

  ?>
</div>

<?php

// Restore the original current post.
$post = $initial_current_post;
setup_postdata( $initial_current_post );

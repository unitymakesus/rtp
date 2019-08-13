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

<div class="flex-grid l3x m2x">
  <?php

  if (!empty($events)) : foreach ($events as $n=>$event) :

    $badge = $module->siteBadge(get_the_ID());
    $classes = [
      'badge-' . str_replace(' ', '-', strtolower($badge))
    ];

    if ($event == 'Plan Ahead') {
      $nextday = $events[$n+1]['date'];
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
            <?php include(CBB_MODULES_DIR . 'modules/cbb-events-feed/images/pattern-bracket.svg'); ?>
          </div>
        </article>
      </div>
      <?php
    } else {
      $post = $event['result'];
      setup_postdata($post);

      $id = get_the_ID();
      $startDate = strtotime($event['date']);
      $startH = get_post_meta($id, 'mec_start_time_hour', true);
      $starti = get_post_meta($id, 'mec_start_time_minutes', true);
      $starta = get_post_meta($id, 'mec_start_time_ampm', true);
      $endH = get_post_meta($id, 'mec_end_time_hour', true);
      $endi = get_post_meta($id, 'mec_end_time_minutes', true);
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
          <?php if (has_post_thumbnail()) : ?>
            <?php
              $thumbnail_id = get_post_thumbnail_id( $post->ID );
              $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              echo get_the_post_thumbnail( $post->ID, 'full', ['alt' => $alt, 'itemprop' => 'image'] );
            ?>
          <?php else : ?>
            <div class="placeholder"></div>
          <?php endif; ?>

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
                <div class="location"><?php echo $location->name; ?></div>
              </div>

              <div class="card-cta"><a href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-events-feed/images/arrow-right.svg'); ?></span></a></div>
            </div>
          </div>

          <div class="pattern-background">
            <?php include(CBB_MODULES_DIR . 'modules/cbb-events-feed/images/pattern-bracket.svg'); ?>
          </div>
        </article>
      </div>
      <?php
    }
  endforeach; endif;

  wp_reset_postdata();

  ?>
</div>

<?php

// Restore the original current post.
$post = $initial_current_post;
setup_postdata( $initial_current_post );

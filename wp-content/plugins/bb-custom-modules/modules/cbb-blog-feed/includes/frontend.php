<div class="flex-grid l3x m2x">
  <?php

  $query = FLBuilderLoop::query( $settings );

  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    $id = get_the_ID();

    $badge = $module->siteBadge($id);
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
            <time class="date updated published" datetime="<?php echo get_post_time('c', true); ?>" itemprop="datePublished"><?php echo get_the_date('F j, Y'); ?></time>
          </div>

          <div class="card-inner">
            <div class="card-badge"><span><?php echo $badge; ?></span></div>

            <h3 class="card-title" itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

            <div class="card-cta"><a href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'assets/images/arrow-right.svg'); ?></span></a></div>
          </div>
        </div>

        <div class="pattern-background">
          <?php include(CBB_MODULES_DIR . 'assets/images/pattern-bracket.svg'); ?>
        </div>
      </article>
    </div>

    <?php
  endwhile; endif;

  wp_reset_postdata();

  ?>
</div>

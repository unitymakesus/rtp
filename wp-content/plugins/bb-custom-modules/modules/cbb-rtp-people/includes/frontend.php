<div class="flex-grid l3x m2x">
  <?php
  // Make sure we're querying people
  $settings->post_type = 'rtp-people';
  $settings->posts_per_page = '-1';

  $query = FLBuilderLoop::query( $settings );

  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    $id = get_the_ID();
    ?>
    <div class="flex-item">
      <article class="figure-card figure-card-people">
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

        <div class="card" itemprop="description">
          <h3 class="card-title" itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
          <h4 class="card-subtitle"><?php echo get_field('job_title'); ?></h4>
        </div>
      </article>
    </div>

    <?php
  endwhile; endif;

  wp_reset_postdata();

  ?>
</div>

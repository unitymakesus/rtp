<div class="flex-grid l3x m2x">
  <?php

  $query = FLBuilderLoop::query( $settings );

  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    ?>
    <article class="figure-card">
      <?php if (has_post_thumbnail()) : ?>
        <?php
          $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
          $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
          echo get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => $alt, 'itemprop' => 'image'] );
        ?>
      <?php else : ?>
        <div class="placeholder"></div>
      <?php endif; ?>

      <div class="card card-cta card-pattern" itemprop="description">
        <div class="badge"><span><?php echo $module->siteBadge(); ?></span></div>

        <div class="meta">
          <time class="date updated published" datetime="<?php echo get_post_time('c', true); ?>" itemprop="datePublished"><?php echo get_the_date('F j, Y'); ?></time>
        </div>

        <h3 class="card-title" itemprop="name"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

        <div class="cta"><a href="<?php echo get_permalink(); ?>">Read More <span class="arrow"><?php echo file_get_contents(CBB_MODULES_DIR . 'modules/cbb-blog-feed/images/arrow-right.svg'); ?></span></a></div>
      </div>

      <div class="pattern-background">
        <?php include(CBB_MODULES_DIR . 'modules/cbb-blog-feed/includes/pattern-bracket.php'); ?>
      </div>
    </article>

    <?php
  endwhile; endif;

  wp_reset_postdata();

  ?>
</div>

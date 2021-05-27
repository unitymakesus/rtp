<?php

$events = $module->get_todays_events($settings);

?>

<div class="cbb-today-feed">
    <?php if ($events->have_posts()) : ?>
        <?php while ($events->have_posts()) : $events->the_post(); ?>
            <?php
                $id = get_the_ID();
                $startH = get_post_meta($id, 'mec_start_time_hour', true);
                $starti = sprintf('%02d', get_post_meta($id, 'mec_start_time_minutes', true));
                $starta = get_post_meta($id, 'mec_start_time_ampm', true);
                $endH = get_post_meta($id, 'mec_end_time_hour', true);
                $endi = sprintf('%02d', get_post_meta($id, 'mec_end_time_minutes', true));
                $enda = get_post_meta($id, 'mec_end_time_ampm', true);
            ?>
            <div class="cbb-today-feed-item">
                <div class="cbb-today-feed-item__content">
                    <h3><?php echo get_the_title(); ?></h3>
                    <div class="time"><?php echo "$startH:$starti"; if ($starta !== $enda) echo " $starta"; ?> — <?php echo "$endH:$endi $enda"; ?></div>
                    <?php echo the_excerpt(); ?>
                    <a class="a11y-link-wrap" href="<?php echo get_the_permalink(); ?>"><?php echo __('View Event', 'cbb'); ?><span class="screen-reader-text">: <?php echo get_the_title(); ?></span></a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; wp_reset_postdata(); ?>
</div>

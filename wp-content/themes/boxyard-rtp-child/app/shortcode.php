<?php

namespace App;

/**
 * Boxyard Logo w/ Date
 */
add_shortcode('boxyard-date', function ($atts) {
    extract(shortcode_atts([
        'date' => current_time('Y-m-d'), // Fallback to current date if not provided.
    ], $atts));

    $date = strtotime($date);

    ob_start(); ?>
        <div class="boxes">
            <div class="box-wrap">
                <div class="box box-1"></div>
                <div class="box box-2"></div>
                <div class="box box-3"></div>
                <div class="box box-4"></div>
                <div class="box box-5"></div>
                <div class="box box-6"></div>
                <div class="box box-7"></div>
                <div class="box box-8"></div>
                <div class="box box-9"></div>
                <span class="month" aria-hidden="true"><?php echo date('M', $date); ?></span>
            </div>
            <div class="box-date">
                <span class="day" aria-hidden="true"><?php echo date('d', $date); ?></span>
            </div>
            <span class="screen-reader-text"><?php echo sprintf(__('Events On %s', 'sage'), date('F d', $date)); ?></span>
        </div>
    <?php return ob_get_clean();
});

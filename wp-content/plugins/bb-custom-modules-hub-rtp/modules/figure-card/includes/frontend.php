<div class="hub-rtp-figure-card hub-rtp-figure-card--align-<?php echo $settings->image_align; ?>">
    <figure class="hub-rtp-figure-card__image">
        <?php echo wp_get_attachment_image($settings->image, 'large'); ?>
    </figure>
    <div class="hub-rtp-figure-card__content">
        <?php echo $settings->content; ?>
    </div>
</div>

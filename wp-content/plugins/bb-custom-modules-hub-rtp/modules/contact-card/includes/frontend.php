<div class="hub-rtp-contact-card">
    <div class="hub-rtp-contact-card__content">
        <?php echo wp_get_attachment_image($settings->logo, 'large', false, ['class' => 'hub-rtp-contact-card__logo']); ?>
        <strong><?php echo $settings->name; ?></strong>
        <span><?php echo $settings->email; ?></span>
    </div>
</div>

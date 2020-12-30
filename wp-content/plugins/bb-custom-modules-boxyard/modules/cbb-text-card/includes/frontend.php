<?php
/**
 * Text Card Module - Front End
 */
?>

<div class="cbb-card cbb-card--text border-card border-card--<?php echo esc_attr($settings->border_color); ?>">
    <div class="cbb-card__content">
        <?php echo $settings->text; ?>
        <?php if (!empty($settings->link)) : ?>
            <a class="cbb-card__link cbb-card__link--<?php echo esc_attr($settings->link_type); ?>" href="<?php echo $settings->link; ?>"><?php echo $settings->link_text; ?></a>
        <?php endif; ?>
    </div>
</div>

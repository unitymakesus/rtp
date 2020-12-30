<?php
/**
 * Navigation Card Module - Front End
 */
?>

<div class="cbb-card cbb-card--navigation">
    <div class="cbb-card__content">
        <?php if (!empty($settings->link)) : ?>
            <a class="cbb-card__link cbb-card__link--text" href="<?php echo $settings->link; ?>"><?php echo $settings->link_text; ?></a>
        <?php endif; ?>
        <div class="cbb-card__text">
            <?php echo $settings->text; ?>
        </div>
    </div>

  <?php if (!empty($settings->image)) : ?>
    <div class="cbb-card__image">
        <?php echo wp_get_attachment_image($settings->image, 'large'); ?>
    </div>
  <?php endif; ?>
</div>

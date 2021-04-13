<?php

$namespace = uniqid();
$i = 1;

?>

<?php if ($settings->images) : ?>
    <div class="unity-modaal-gallery">
        <?php foreach ($settings->images as $image) : ?>
            <div class="unity-modaal-gallery-item">
                <a
                    class="unity-modaal-gallery-item__link"
                    href="<?php echo wp_get_attachment_image_src($image, 'large')[0]; ?>"
                    data-group="modaal-gallery-<?php echo esc_attr($namespace); ?>" data-modaal-desc="<?php echo esc_attr(get_post_meta($image, '_wp_attachment_image_alt', true)); ?>"
                >
                    <?php echo wp_get_attachment_image($image, 'medium'); ?>
                </a>

                <?php
                /**
                 * The caption will be inserted into lightbox caption via JS.
                 */
                ?>
                <?php if ($caption = wp_get_attachment_caption($image)) : ?>
                    <div class="unity-modaal-gallery-item__caption" data-index="<?php echo ($i - 1); ?>" style="display:none;">
                        <div class="unity-modaal-gallery-item__caption-wrapper">
                            <p><?php echo $caption; ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php $i++; endforeach; ?>
    </div>
<?php endif; ?>

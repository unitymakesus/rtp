<?php if ($settings->cta_link) : ?>
    <div class="unity-jump-link" style="text-align:<?= $settings->align; ?>;">
        <a href="<?= esc_url($settings->cta_link); ?>" class="unity-jump-link__btn btn fl-button"><?= $settings->cta_text; ?></a>
    </div>
<?php endif; ?>

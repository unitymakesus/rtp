<?php

$cta_target = $settings->cta_target ?: "modaal-{$id}";
$modaal_id = $settings->modaal_id ?: "modaal-{$id}";

?>

<?php if ($settings->cta_text) : ?>
    <div class="unity-modaal" style="text-align:<?= $settings->align; ?>;">
        <a role="button" href="#<?= $cta_target; ?>" class="unity-modaal__inline btn fl-button"><?= $settings->cta_text; ?></a>
        <?php if (!empty($settings->modaal_content)) : ?>
            <div id="<?= $modaal_id; ?>" style="display:none;">
                <?= $settings->modaal_content; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php global $wp_embed; ?>

<div class="fl-accordion" data-allow-toggle>
    <?php for ($i = 0; $i < count($settings->items); $i++) : ?>
        <?php
            if (empty($settings->items[$i])) {
                continue;
            }

            $label_id   = 'fl-accordion-' . $module->node . '-label-' . $i;
            $icon_id    = 'fl-accordion-' . $module->node . '-icon-' . $i;
            $content_id = 'fl-accordion-' . $module->node . '-panel-' . $i;
            $control_id = 'fl-accordion-' . $module->node . '-control-' . $i;
        ?>
        <h3>
            <button class="fl-accordion-trigger" id="<?php echo $control_id; ?>" aria-expanded="false" aria-controls="<?php echo $content_id; ?>">
                <span class="fl-accordion-title">
                    <?php echo $settings->items[$i]->label; ?>
                    <span class="fl-accordion-icon"></span>
                </span>
            </button>
        </h3>
        <div class="fl-accordion-panel" id="<?php echo $content_id; ?>" role="region" aria-labelledby="<?php echo $control_id; ?>" hidden>
            <div>
                <?php echo wpautop($wp_embed->autoembed($settings->items[$i]->content)); ?>
            </div>
        </div>
    <?php endfor; ?>
</div>

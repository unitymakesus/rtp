<?php if (!empty($settings->cards)) : ?>
    <div class="cbb-lifestyle">
        <?php for ($i = 0; $i < count($settings->cards); $i++) : ?>
            <?php
                if (empty($settings->cards[$i])) {
                    continue;
                }
            ?>
            <div class="cbb-lifestyle__card">
                <div class="cbb-lifestyle__card-inner">
                    <a role="button" href="#" class="cbb-lifestyle__card-toggle a11y-link-wrap" aria-expanded="false" aria-describedby="lifestyle-card-<?php echo $i; ?>">
                        <span>
                            <svg viewBox="0 0 10 10"><path d="m1 4h8v2h-8zm3-3h2v8h-2z" fill="#FFFFFF"/></svg>
                        </span>
                    </a>
                    <div class="cbb-lifestyle__card-body">
                        <div class="cbb-lifestyle__card-front">
                            <div class="cbb-lifestyle__card-front-img" style="background-image:url(<?php echo wp_get_attachment_image_src($settings->cards[$i]->background_image, 'large')[0]; ?>);"></div>
                        </div>
                        <div class="cbb-lifestyle__card-back">
                            <div class="cbb-lifestyle__card-back-inner">
                                <div ckass="cbb-lifestyle__card-content">
                                    <h4 id="lifestyle-card-<?php echo $i; ?>"><?php echo $settings->cards[$i]->heading; ?></h4>
                                    <div><?php echo $settings->cards[$i]->text; ?></div>
                                </div>
                                <?php if (!empty($settings->cards[$i]->icon)) : ?>
                                    <div class="cbb-lifestyle__card-icon">
                                        <?php echo wp_get_attachment_image($settings->cards[$i]->icon, 'full'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
<?php endif; ?>

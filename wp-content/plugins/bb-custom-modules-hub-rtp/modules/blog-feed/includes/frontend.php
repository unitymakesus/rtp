<?php

$query = FLBuilderLoop::query($settings);
$i = 1;

?>

<div class="cbb-blog-feed">
    <h2><?php echo $settings->heading; ?></h2>
    <div class="cbb-blog-feed__grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
                $id = get_the_ID();
                $unique_id = uniqid(); // For namespacing.
                $badge = $module->siteBadge($id);
                $classes = [
                  'badge-' . str_replace(' ', '-', strtolower($badge))
                ];
            ?>
            <div class="cbb-blog-feed__grid-item cbb-blog-feed__grid-item--<?php echo $i; ?> <?php echo implode(' ', $classes); ?>">
                <article class="figure-card">
                    <div class="figure-card-img">
                        <?php
                            $site_id = get_post_meta($id, 'dt_original_blog_id', true);
                            $orig_id = get_post_meta($id, 'dt_original_post_id', true);
                            if (!empty($site_id)) {
                                // If this is a syndicated post, switch to original site to get featured image
                                // switch_to_blog($site_id);
                                // $module->featuredImage($orig_id);
                                // restore_current_blog();
                            } else {
                                // Just get the featured image from this site
                                $module->featuredImage($id);
                            }
                        ?>
                    </div>
                    <div class="card" itemprop="description">
                        <div class="card-inner">
                            <div class="card-badge"><span><?php echo $badge; ?></span></div>
                            <h3 class="card-title" itemprop="name"><a class="a11y-link-wrap" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                            <div class="card-excerpt"><?php echo get_the_excerpt(); ?></div>
                            <div class="card-cta" aria-hidden="true"><a tabindex="-1" href="#">Read More <span class="arrow"><svg xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg></span></a></div>
                        </div>
                    </div>
                    <div class="pattern-background">
                        <svg class="pattern-brackets">
                            <defs>
                                <pattern id="brackets-<?php echo $unique_id; ?>" x="13" y="13" width="30" height="30" patternUnits="userSpaceOnUse">
                                    <clipPath id="clip-path-<?php echo $unique_id; ?>">
                                        <polygon class="cls-1" points="21.25 18.24 21.25 21.25 18.24 21.25 18.24 22.22 22.22 22.22 22.22 18.24 21.25 18.24"/>
                                    </clipPath>
                                    <clipPath id="clip-path-2-<?php echo $unique_id; ?>">
                                        <polygon class="cls-1" points="5.9 8.9 5.9 5.9 8.91 5.9 8.91 4.93 4.93 4.93 4.93 8.9 5.9 8.9"/>
                                    </clipPath>
                                    <g class="cls-3" clip-path="url(#clip-path-<?php echo $unique_id; ?>)">
                                        <rect x="13.75" y="13.75" width="13.32" height="13.32" fill="white"/>
                                    </g>
                                    <g class="cls-4" clip-path="url(#clip-path-2-<?php echo $unique_id; ?>)">
                                        <rect x="0.07" y="0.07" width="13.68" height="13.68" fill="white"/>
                                    </g>
                                </pattern>
                                <linearGradient id="rtp-gradient-<?php echo $unique_id; ?>" x1="0" x2="100%" y1="0" y2="0" gradientUnits="userSpaceOnUse" >
                                    <stop stop-color="#4B9CD3" offset="0%"/>
                                    <stop stop-color="#012169" offset="33%"/>
                                    <stop stop-color="#82052A" offset="66%"/>
                                    <stop stop-color="#CC0000" offset="99%"/>
                                </linearGradient>
                            </defs>
                            <mask id="brackets-mask-<?php echo $unique_id; ?>">
                                <rect x="0" y="0" width="1000" height="1000" fill="url(#brackets-<?php echo $unique_id; ?>)"></rect>
                            </mask>
                            <rect x="0" y="0" width="100%" height="100%" fill="url(#rtp-gradient-<?php echo $unique_id; ?>)" mask="url(#brackets-mask-<?php echo $unique_id; ?>)"></rect>
                        </svg>
                    </div>
                </article>
            </div>
            <?php $i++; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
</div>

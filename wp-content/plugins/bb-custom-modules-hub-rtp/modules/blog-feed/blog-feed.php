<?php

class HubRTPBlogFeed extends FLBuilderModule {
    public function __construct() {
        parent::__construct([
            'name'        => __( 'Blog Feed (Hub RTP)', '' ),
            'description' => __( '' ),
            'icon'        => 'button.svg',
            'category'    => __( 'Layout', '' ),
            'dir'         => CBB_HUB_DIR . 'modules/blog-feed/',
            'url'         => CBB_HUB_DIR . 'modules/blog-feed/',
        ]);

        /**
         * CSS
         */
        $this->add_css('cbb-hub-rtp-blog-feed-css', asset_path('styles/hub-rtp-blog-feed.css'));
    }

    /**
     * Return a blog name / badge.
     */
    public function siteBadge($post_id) {
        $site_id = get_post_meta($post_id, 'dt_original_blog_id', true);

        if (empty($site_id)) {
            $site_id = get_current_blog_id();
        }

        if ($site_id == 1) {
            $site_name = 'RTP';
        } else {
            $data = get_blog_details($site_id, true);
            $site_name = $data->blogname;
        }

        return $site_name;
    }

    public function featuredImage($post_id) {
        if (has_post_thumbnail($post_id)) {
            $thumbnail_id = get_post_thumbnail_id( $post_id );
            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            echo get_the_post_thumbnail($post_id, 'large', ['alt' => $alt, 'itemprop' => 'image']);
        } else {
            echo '<div class="placeholder"></div>';
        }
    }
}

FLBuilder::register_module('HubRTPBlogFeed', [
    'hub-rtp-blog-feed-general' => [
        'title'    => __( 'General', '' ),
        'sections' => [
            'content' => [
                'title'  => __( 'Content', '' ),
                'fields' => [
                    'heading' => [
                        'type' => 'text',
                        'label' => __('Heading', ''),
                    ],
                    'posts_per_page' => [
                        'type'        => 'text',
                        'label'       => __( 'Post Count', '' ),
                        'help'        => __( 'Enter the total number of posts you want to display in module. Supports up to 4 posts.', '' ),
                        'default'     => '4',
                        'size'        => '2',
                        'placeholder' => '4',
                    ],
                    'tax_post_category_matching' => [
                        'type'    => 'select',
                        'label'   => 'Blog Category',
                        'help'    => __( 'Enter a comma separated list of categories. Only posts with these categories will be shown.', '' ),
                        'options' => [
                            '1' => __( 'Match these categories', '' ),
                            '0' => __( 'Do not match these categories', '' )
                        ]
                    ],
                    'tax_post_category' => [
                        'type'   => 'suggest',
                        'action' => 'fl_as_terms',
                        'data'   => 'category',
                        'label'  => '&nbsp',
                    ],
                ],
            ],
        ],
    ],
]);

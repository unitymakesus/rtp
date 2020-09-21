<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.16.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Business Review Module
 */

$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );
$branding            = '';
$link                = ''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
	$branding = 'no';
	$link     = '<a href="https://www.ultimatebeaver.com/docs/unable-to-display-more-google-and-yelp-reviews/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> <b> here </b> </a>'; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
} else {
	$branding = 'yes';
	$link     = ''; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}
$review_notice_google      = sprintf( /* translators: %1$s: search term */
	'<div class="uabb-business-review-desc" style="%1$s">' . __( 'Google allows maximum 5 reviews. Click', 'uabb' ) . $link . __( 'to know more.', 'uabb' ) . '</div>',
	$style1
);
$review_notice_yelp        = sprintf( /* translators: %1$s: search term */
	'<div class="uabb-business-review-desc" style="%1$s">' . __( 'Yelp allows maximum 3 reviews.Click', 'uabb' ) . $link . __( 'to know more.', 'uabb' ) . '</div>',
	$style1
);
$review_text_yelp          = sprintf( /* translators: %1$s: search term */
	'<div class="uabb-business-review-desc" style="%1$s">' . __( 'Yelp API allows to fetch only the 160 charachters of the review.', 'uabb' ) . '</div>',
	$style1
);
$review_notice_yelp_google = sprintf( /* translators: %1$s: search term */
	'<div class="uabb-business-review-desc" style="%1$s">' . __( 'Google allows maximum 5 reviews & Yelp allows maximum 3 reviews. Click', 'uabb' ) . $link . __( 'to know more.', 'uabb' ) . '</div>',
	$style1
);
$filter_notice             = sprintf( /* translators: %1$s: search term */
	'<div class="uabb-business-review-desc" style="%1$s">' . __( 'Choose the lowest star ratings to display. For example, choosing 3 star will display reviews with 3 star and above.', 'uabb' ) . '</div>',
	$style1
);

FLBuilder::register_module(
	'UABBBusinessReview',
	array(
		'general'    => array(
			'title'       => __( 'General', 'uabb' ), // Tab title.
			'description' => $notice,
			'sections'    => array( // Tab Sections.
				'general'                  => array( // Section.
					'title'  => __( 'General', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'review_source'    => array(
							'type'    => 'select',
							'label'   => __( 'Review Source', 'uabb' ),
							'default' => 'google',
							'options' => array(
								'google' => __( 'Google Places', 'uabb' ),
								'yelp'   => __( 'Yelp', 'uabb' ),
								'all'    => __( 'Both', 'uabb' ),
							),
							'toggle'  => array(
								'google' => array(
									'fields' => array( 'google_place_id', 'google_reviews_count' ),
								),
								'yelp'   => array(
									'fields' => array( 'yelp_business_id', 'yelp_reviews_number' ),
								),
								'all'    => array(
									'fields' => array( 'yelp_business_id', 'google_place_id', 'total_reviews_number' ),
								),
							),
						),
						'google_place_id'  => array(
							'type'        => 'text',
							'label'       => __( 'Google Place ID', 'uabb' ),
							'default'     => 'ChIJBUo5LX5FXj4RqXDEdkjfdmA',
							'description' => __( '</br></br>Click <a href="https://developers.google.com/places/place-id" target="_blank" rel="noopener"><i><b>here </b></i></a> to find your Google Place ID.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'yelp_business_id' => array(
							'type'        => 'text',
							'label'       => __( 'Yelp Business ID', 'uabb' ),
							'default'     => 'osteria-francescana-modena-2',
							'description' => __( '</br></br>Click <a href="https://www.yelp-support.com/article/What-is-my-Yelp-Business-ID" target="_blank" rel="noopener"><i><b>here </b></i></a> to find your Yelp Business ID.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
					),
				),
				'skin'                     => array( // Section.
					'title'  => __( 'Skin', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'_skin' => array(
							'type'    => 'select',
							'label'   => __( 'Select Skin', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'card'    => __( 'Card', 'uabb' ),
								'bubble'  => __( 'Bubble', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'fields' => array( 'image_align' ),
								),
								'card'    => array(
									'fields' => array( 'image_align' ),
								),
								'bubble'  => array(
									'fields' => array( 'content_block_bottom_spacing' ),
								),
							),
						),
					),
				),
				'review_structure'         => array(
					'title'  => __( 'Layout', 'uabb' ),
					'fields' => array( // Section Fields.
						'review_layout'        => array(
							'type'    => 'select',
							'label'   => __( 'Select Layout', 'uabb' ),
							'default' => 'grid',
							'options' => array(
								'grid'     => __( 'Grid', 'uabb' ),
								'carousel' => __( 'Carousel', 'uabb' ),
							),
							'toggle'  => array(
								'grid'     => array(
									'sections' => array( 'section_grid_content' ),
									'fields'   => array( 'row_gap' ),
								),
								'carousel' => array(
									'sections' => array( 'section_carousel_options', 'section_style_navigation' ),
								),
							),
						),
						'google_reviews_count' => array(
							'type'        => 'unit',
							'label'       => __( 'Number of Reviews', 'uabb' ),
							'default'     => '3',
							'description' => $review_notice_google,
							'slider'      => array(
								'step' => 1,
								'max'  => 5,
							),
						),
						'yelp_reviews_number'  => array(
							'type'        => 'unit',
							'label'       => __( 'Number of Reviews', 'uabb' ),
							'default'     => '3',
							'description' => $review_notice_yelp,
							'slider'      => array(
								'step' => 1,
								'max'  => 3,
							),
						),
						'total_reviews_number' => array(
							'type'        => 'unit',
							'label'       => __( 'Number of Reviews', 'uabb' ),
							'default'     => '5',
							'description' => $review_notice_yelp_google,
							'slider'      => array(
								'step' => 1,
								'max'  => 8,
							),
						),
						'gallery_columns'      => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'maxlength'  => '3',
							'size'       => '5',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '3',
									'medium'     => '2',
									'responsive' => '1',
								),
							),
						),
						'set_transient_time'   => array(
							'type'    => 'select',
							'label'   => __( 'Reload Reviews after a', 'uabb' ),
							'default' => 'HOUR_IN_SECONDS',
							'options' => array(
								'60 * MINUTE_IN_SECONDS' => __( 'Hour', 'uabb' ),
								'24 * HOUR_IN_SECONDS'   => __( 'Day', 'uabb' ),
								'7 * DAY_IN_SECONDS'     => __( 'Week', 'uabb' ),
								'30 * DAY_IN_SECONDSS'   => __( 'Month', 'uabb' ),
								'365 * DAY_IN_SECONDS'   => __( 'Year', 'uabb' ),
							),
						),
					),
				),
				'section_carousel_options' => array(
					'title'  => __( 'Carousel', 'uabb' ),
					'fields' => array(
						'slides_to_scroll' => array(
							'type'       => 'unit',
							'label'      => __( 'Slides To Scroll', 'uabb' ),
							'default'    => '1',
							'maxlength'  => '5',
							'size'       => '6',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '1',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'navigation'       => array(
							'type'    => 'select',
							'label'   => __( 'Navigation', 'uabb' ),
							'default' => 'both',
							'options' => array(
								'both'   => __( 'Arrows and Dots', 'uabb' ),
								'arrows' => __( 'Arrows', 'uabb' ),
								'dots'   => __( 'Dots', 'uabb' ),
								'none'   => __( 'None', 'uabb' ),
							),
							'toggle'  => array(
								'arrows' => array(
									'fields' => array( 'arrows_size', 'arrows_color', 'arrow_border_radius', 'arrows_border_size' ),
								),
								'dots'   => array(
									'fields' => array( 'dots_size', 'dots_color' ),
								),
								'both'   => array(
									'fields' => array( 'arrows_size', 'arrows_color', 'arrow_border_radius', 'arrows_border_size', 'dots_size', 'dots_color' ),
								),
							),
						),
						'autoplay'         => array(
							'type'    => 'select',
							'label'   => __( 'Autoplay', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'autoplay_speed', 'pause_on_hover' ),
								),
							),
						),
						'autoplay_speed'   => array(
							'type'        => 'unit',
							'label'       => __( 'Autoplay Speed', 'uabb' ),
							'default'     => '5000',
							'description' => __( 'ms', 'uabb' ),
							'slider'      => array(
								'step' => 10,
								'max'  => 1000,
							),
						),
						'pause_on_hover'   => array(
							'type'    => 'select',
							'label'   => __( 'Pause on Hover', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'infinite'         => array(
							'type'    => 'select',
							'label'   => __( 'Infinite Loop', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'transition_speed' => array(
							'type'        => 'unit',
							'label'       => __( 'Transition Speed', 'uabb' ),
							'default'     => '500',
							'description' => __( 'ms', 'uabb' ),
							'slider'      => array(
								'step' => 10,
								'max'  => 1000,
							),
						),
						'equal_height'     => array(
							'type'    => 'select',
							'label'   => __( 'Equal Height', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'layout'     => array(
			'title'    => __( 'Layout', 'uabb' ),
			'sections' => array(
				'fliter'  => array( // Section.
					'title'  => __( 'Fliters', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'reviews_filter_by'  => array(
							'type'    => 'select',
							'label'   => __( 'Filter By', 'uabb' ),
							'default' => 'rating',
							'options' => array(
								'default' => __( 'No Filter', 'uabb' ),
								'rating'  => __( 'Rating', 'uabb' ),
								'date'    => __( 'Review Date', 'uabb' ),
							),
						),
						'reviews_min_rating' => array(
							'type'        => 'select',
							'label'       => __( 'Minimum Rating', 'uabb' ),
							'default'     => 'no',
							'description' => $filter_notice,
							'options'     => array(
								'no' => __( 'No Minimum Rating', 'uabb' ),
								'2'  => __( '2 stars', 'uabb' ),
								'3'  => __( '3 stars', 'uabb' ),
								'4'  => __( '4 stars', 'uabb' ),
								'5'  => __( '5 stars', 'uabb' ),
							),
						),
					),
				),
				'image'   => array( // Section.
					'title'  => __( 'Reviewer Info', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'reviewer_image'      => array(
							'type'    => 'select',
							'label'   => __( ' Display Reviewer Image', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'image_size', 'image_align' ),
								),
							),
						),
						'image_align'         => array(
							'type'    => 'select',
							'label'   => __( 'Reviewer Image Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'top'      => __( 'Above Name ', 'uabb' ),
								'left'     => __( 'Left of Name', 'uabb' ),
								'all_left' => __( 'Left of all content', 'uabb' ),
							),
							'toggle'  => array(
								'top' => array(
									'fields' => array( 'overall_align' ),
								),
							),
						),
						'image_size'          => array(
							'type'    => 'unit',
							'label'   => __( 'Image Size', 'uabb' ),
							'default' => '60',
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-review-image',
										'property' => 'width',
									),
									array(
										'selector' => '.uabb-review-image',
										'property' => 'height',
									),
								),
								'unit'  => 'px',
							),
							'units'   => array( 'px' ),
						),
						'overall_align'       => array(
							'type'    => 'select',
							'label'   => __( 'Overall align', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'reviewer_name'       => array(
							'type'    => 'select',
							'label'   => __( 'Reviewer Name', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'reviewer_name_link', 'reviewer_name_color' ),
								),
							),
						),
						'reviewer_name_link'  => array(
							'type'    => 'select',
							'label'   => __( 'Link Name', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'reviewer_name_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'show_reset'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name .uabb-reviewer-link, .uabb-reviewer-name',
								'property'  => 'color',
								'important' => true,
							),
						),
						'review_source_icon'  => array(
							'type'    => 'select',
							'label'   => __( 'Review Source Icon', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Enable', 'uabb' ),
								'no'  => __( 'Disable', 'uabb' ),
							),
						),
					),
				),
				'date'    => array( // Section.
					'title'  => __( 'Review Date', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'review_date'         => array(
							'type'    => 'select',
							'label'   => __( ' Display Review Date ', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'reviewer_date_color' ),
								),
							),
						),
						'review_date_type'    => array(
							'type'    => 'select',
							'label'   => __( 'Select Type', 'uabb' ),
							'default' => 'relative',
							'options' => array(
								'default'  => __( 'Default ', 'uabb' ),
								'relative' => __( 'Relative', 'uabb' ),
							),
						),
						'reviewer_date_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => 'adadad',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-time',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'content' => array(
					'title'  => __( 'Review Text', 'uabb' ),
					'fields' => array(
						'review_content'         => array(
							'type'    => 'select',
							'label'   => __( ' Display Review Text', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'reviewer_content_color', 'review_content_length', 'read_more', 'read_more_color' ),
								),
							),
						),
						'reviewer_content_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
								'property'  => 'color',
								'important' => true,
							),
						),
						'review_content_length'  => array(
							'type'        => 'unit',
							'label'       => __( 'Content Maximum Length', 'uabb' ),
							'default'     => 25,
							'description' => $review_text_yelp,
							'slider'      => array(
								'step' => 1,
								'max'  => 1000,
							),
						),
						'read_more'              => array(
							'type'        => 'text',
							'label'       => __( 'Read More Text', 'uabb' ),
							'default'     => 'Read More »',
							'help'        => __( 'Enter the text for your Read More link.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'read_more_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Read More Text Color', 'uabb' ),
							'default'     => '',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content .uabb-reviews-read-more',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'rating'  => array( // Section.
					'title'  => __( 'Rating', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'review_rating'        => array(
							'type'    => 'select',
							'label'   => __( 'Star Rating', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'select_star_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Star Icon Style', 'uabb' ),
							'default' => 'custom',
							'options' => array(
								'default' => __( 'Default ', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
						),
						'icon_size'            => array(
							'type'    => 'unit',
							'label'   => __( 'Icon Size', 'uabb' ),
							'default' => '13',
							'units'   => array( 'px' ),
							'slider'  => true,
						),
						'rating_icon_color'    => array(
							'type'        => 'color',
							'label'       => __( 'Marked Color', 'uabb' ),
							'default'     => 'ffab40',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review .uabb-star-full',
								'property'  => 'color',
								'important' => true,
							),
						),
						'stars_unmarked_color' => array(
							'type'        => 'color',
							'label'       => __( 'Unmarked Color', 'uabb' ),
							'default'     => 'ccd6df',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => 'uabb-review .uabb-star-empty',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
			),
		),
		// Style tab Strat from here.
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'section_spacing'          => array(
					'title'  => __( 'Spacing', 'uabb' ),
					'fields' => array(
						'column_gap'                   => array(
							'type'       => 'unit',
							'label'      => __( 'Columns Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'row_gap'                      => array(
							'type'       => 'unit',
							'label'      => __( 'Rows Gap', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-wrap',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'reviewer_name_spacing'        => array(
							'type'       => 'unit',
							'label'      => __( 'Name bottom spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'reviewer_image_spacing'       => array(
							'type'       => 'unit',
							'label'      => __( 'Image spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'star_spacing'                 => array(
							'type'       => 'unit',
							'label'      => __( 'Five star bottom spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-star-rating__wrapper',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'date_spacing'                 => array(
							'type'       => 'unit',
							'label'      => __( 'Date bottom spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-time',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'content_spacing'              => array(
							'type'       => 'unit',
							'label'      => __( 'Content bottom spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'maxlength'  => '6',
							'size'       => '8',
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'content_block_bottom_spacing' => array(
							'type'       => 'unit',
							'label'      => __( 'Content Block Bottom Spacing', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'responsive' => array(
								'default' => array(
									'default'    => '20',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content-wrap',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
					),
				),
				'section_styling'          => array(
					'title'  => __( 'Box', 'uabb' ),
					'fields' => array(
						'block_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'fafafa',
							'connections' => array( 'color' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'block_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'default'    => '30',
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'block_border'   => array(
							'type'       => 'border',
							'label'      => __( 'Border', 'uabb' ),
							'responsive' => true,
							'default'    => array(
								'style'  => 'solid',
								'color'  => 'ededed',
								'width'  => array(
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1',
								),
								'radius' => array(
									'top_left'     => '5',
									'top_right'    => '5',
									'bottom_left'  => '5',
									'bottom_right' => '5',
								),
							),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-skin-default .uabb-review,.uabb-reviews-skin-bubble .uabb-review-content,.uabb-reviews-skin-card .uabb-review',
							),
						),
					),
				),
				'section_style_navigation' => array(
					'title'  => __( 'Navigation', 'uabb' ),
					'fields' => array(
						'arrows_size'         => array(
							'type'   => 'unit',
							'label'  => __( 'Arrows Size', 'uabb' ),
							'units'  => array( 'px' ),
							'slider' => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'arrows_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Arrows Color', 'uabb' ),
							'show_reset'  => 'true',
							'show_alpha'  => 'true',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow i',
										'property' => 'color',
									),
									array(
										'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow',
										'property' => 'border-color',
									),
								),
							),
						),
						'arrows_border_size'  => array(
							'type'    => 'unit',
							'label'   => __( 'Arrows Border Size', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'arrow_border_radius' => array(
							'type'    => 'unit',
							'label'   => __( 'Border Radius', 'uabb' ),
							'units'   => array( 'px' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'dots_size'           => array(
							'type'    => 'unit',
							'label'   => __( 'Dots Size', 'uabb' ),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap .slick-dots li button:before',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
						),
						'dots_color'          => array(
							'type'        => 'color',
							'label'       => __( 'Dots Color', 'uabb' ),
							'show_alpha'  => 'true',
							'show_reset'  => 'true',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap .slick-dots li button:before,.uabb-reviews-module-wrap ul.slick-dots li.slick-active button:before',
								'property' => 'color',
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'section_name_typography' => array(
					'title'  => __( 'Reviewer Name ', 'uabb' ),
					'fields' => array(
						'typography_name' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name, .uabb-reviewer-link',
								'important' => true,
							),
						),
					),
				),
				'sections_date_time_typo' => array(
					'title'  => __( 'Review Date', 'uabb' ),
					'fields' => array(
						'date_time_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-time',
								'important' => true,
							),
						),
					),
				),
				'sections_content_typo'   => array(
					'title'  => __( 'Review Content', 'uabb' ),
					'fields' => array(
						'content_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
								'important' => true,
							),
						),
					),
				),
				'sections_readmore_typo'  => array(
					'title'  => __( 'Read More Text', 'uabb' ),
					'fields' => array(
						'readmore_typography' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviews-read-more_wrap .uabb-reviews-read-more',
								'important' => true,
							),
						),
					),
				),
			),
		),
		'uabb_docs'  => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::$is_branding_enabled . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/business-reviews-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> Getting started article </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/find-yelp-api-key/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> How to get Yelp API key? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/find-yelp-business-id/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> How to find Yelp Business ID? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-create-google-api-key-in-uabb-google-map-element/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> How to get Google Map API key? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/find-google-place-id/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> How to find Google Place ID? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/business-reviews-filters/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> How to use Business Reviews Filters to better display Reviews? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/unable-to-display-more-google-and-yelp-reviews/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=business-reviews-module" target="_blank" rel="noopener"> Unable to display more than 5 Google reviews/3 Yelp Reviews? </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);

<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Business Review Module
 */

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
								'all'    => __( 'All', 'uabb' ),
							),
							'toggle'  => array(
								'google' => array(
									'fields' => array( 'google_place_id', 'google_reviews_count', 'review_date_type' ),
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
							'description' => __( '</br></br>Click <a href="https://developers.google.com/places/place-id" target="_blank" rel="noopener"><i><b>here </b></i></a> to find your Google Place ID', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'yelp_business_id' => array(
							'type'        => 'text',
							'label'       => __( 'Yelp business ID', 'uabb' ),
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
								),
								'carousel' => array(
									'sections' => array( 'section_carousel_options', 'section_style_navigation' ),
								),
							),
						),
						'google_reviews_count' => array(
							'type'    => 'unit',
							'label'   => __( 'Number of Reviews', 'uabb' ),
							'default' => '5',
						),
						'yelp_reviews_number'  => array(
							'type'    => 'unit',
							'label'   => __( 'Number of Reviews', 'uabb' ),
							'default' => '5',
						),
						'total_reviews_number' => array(
							'type'    => 'unit',
							'label'   => __( 'Number of Reviews', 'uabb' ),
							'default' => '5',
						),
						'gallery_columns'      => array(
							'type'       => 'unit',
							'label'      => __( 'Columns', 'uabb' ),
							'maxlength'  => '3',
							'size'       => '5',
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
								'both'   => array(
									'fields' => array( 'arrows_size', 'arrows_color', 'arrow_border_radius', 'arrows_border_size', 'dots_size', 'dots_color' ),
								),
								'arrows' => array(
									'fields' => array( 'arrows_size', 'arrows_color', 'arrow_border_radius', 'arrows_border_size' ),
								),
								'dots'   => array(
									'fields' => array( 'dots_size', 'dots_color' ),
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
				'fliter'                   => array( // Section.
					'title'  => __( 'Fliters', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'reviews_filter_by'  => array(
							'type'    => 'select',
							'label'   => __( 'Filter By', 'uabb' ),
							'default' => 'rating',
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'rating'  => __( 'Rating', 'uabb' ),
								'date'    => __( 'Date', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviews_min_rating',
								'important' => true,
							),
						),
						'reviews_min_rating' => array(
							'type'    => 'select',
							'label'   => __( 'Minimum Rating', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no' => __( 'No', 'uabb' ),
								'2'  => __( '2 stars', 'uabb' ),
								'3'  => __( '3 stars', 'uabb' ),
								'4'  => __( '4 stars', 'uabb' ),
								'5'  => __( '5 stars', 'uabb' ),
							),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviews_min_rating',
								'important' => true,
							),
						),
					),
				),
				'image'                    => array( // Section.
					'title'  => __( 'Reviewer Info', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'reviewer_image'      => array(
							'type'    => 'select',
							'label'   => __( 'Reviewer Image', 'uabb' ),
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
							'label'   => __( 'Select Style', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'top'      => __( 'Above Name ', 'uabb' ),
								'left'     => __( 'Before Name', 'uabb' ),
								'all_left' => __( 'Before all content', 'uabb' ),
							),
							'toggle'  => array(
								'top' => array(
									'fields' => array( 'overall_align' ),
								),
							),
						),
						'image_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Image Size', 'uabb' ),
							'default'     => '70',
							'description' => __( 'px', 'uabb' ),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-image',
								'property'  => 'width',
								'unit'      => 'px',
								'important' => true,
							),
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
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'reviewer_name_color' => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_alpha' => true,
							'show_reset' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name .uabb-reviewer-link, .uabb-reviewer-name',
								'property'  => 'color',
								'important' => true,
							),
						),
					),
				),
				'date'                     => array( // Section.
					'title'  => __( 'Review Date', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'review_date'         => array(
							'type'    => 'select',
							'label'   => __( 'Review Date', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes ', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'reviewer_date_color', 'review_date_type' ),
								),
							),
						),
						'review_date_type'    => array(
							'type'    => 'select',
							'label'   => __( 'Select Type', 'uabb' ),
							'default' => 'default',
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
				'rating'                   => array( // Section.
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
							'default' => 'default',
							'options' => array(
								'default' => __( 'Default ', 'uabb' ),
								'custom'  => __( 'Custom', 'uabb' ),
							),
						),
						'icon_size'            => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'default'     => '25',
							'description' => __( 'px', 'uabb' ),
							'slider'      => true,
						),
						'rating_icon_color'    => array(
							'type'       => 'color',
							'label'      => __( 'Marked Color', 'uabb' ),
							'default'    => 'f0ad4e',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review .uabb-star-full',
								'property'  => 'background',
								'important' => true,
							),
						),
						'stars_unmarked_color' => array(
							'type'       => 'color',
							'label'      => __( 'Unmarked Color', 'uabb' ),
							'default'    => 'ccd6df',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => 'uabb-review .uabb-star-empty',
								'property'  => 'background',
								'important' => true,
							),
						),
					),
				),
				'content'                  => array(
					'title'  => __( 'Review Text', 'uabb' ),
					'fields' => array(
						'review_content'         => array(
							'type'    => 'select',
							'label'   => __( 'Review Text', 'uabb' ),
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
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
								'property'  => 'color',
								'important' => true,
							),
						),
						'review_content_length'  => array(
							'type'    => 'unit',
							'label'   => __( 'Content Maximum Length', 'uabb' ),
							'default' => 25,
						),
						'read_more'              => array(
							'type'        => 'text',
							'label'       => __( 'Read More Text', 'uabb' ),
							'default'     => 'Read More »',
							'connections' => array( 'string', 'html' ),
							'help'        => __( 'Enter the text for your call to action link.', 'uabb' ),
						),
						'read_more_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Read More Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content .uabb-reviews-read-more',
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
						'column_gap'             => array(
							'type'        => 'unit',
							'label'       => __( 'Columns Gap', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '20',
									'medium'     => '20',
									'responsive' => '20',
								),
							),
						),
						'row_gap'                => array(
							'type'        => 'unit',
							'label'       => __( 'Rows Gap', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '20',
									'medium'     => '20',
									'responsive' => '20',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-wrap',
								'property'  => 'margin',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'reviewer_name_spacing'  => array(
							'type'        => 'unit',
							'label'       => __( 'Name bottom spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'reviewer_image_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Image spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'star_spacing'           => array(
							'type'        => 'unit',
							'label'       => __( 'Five star bottom spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-star-rating__wrapper',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'date_spacing'           => array(
							'type'        => 'unit',
							'label'       => __( 'Date bottom spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-time',
								'property'  => 'margin-bottom',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'content_spacing'        => array(
							'type'        => 'unit',
							'label'       => __( 'Content bottom spacing', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'maxlength'   => '6',
							'size'        => '8',
							'responsive'  => array(
								'default' => array(
									'default'    => '20',
									'medium'     => '20',
									'responsive' => '20',
								),
							),
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
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
						'block_bg_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f2f2f2',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review',
								'property'  => 'background-color',
								'important' => true,
							),
						),
						'block_padding'      => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'slider'      => true,
							'responsive'  => true,
							'description' => __( 'px', 'uabb' ),
							'default'     => '20',
							'preview'     => array(
								'type'      => 'css',
								'selector'  => '.uabb-review',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'block_border_style' => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-review',
								'property' => 'border-style',
							),
						),
						'block_border_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review',
								'property' => 'border-width',
							),
						),
						'block_border_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'show_alpha'  => 'true',
							'show_resset' => 'true',
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review',
								'property' => 'border-color',
							),
						),
					),
				),
				'section_style_navigation' => array(
					'title'  => __( 'Navigation', 'uabb' ),
					'fields' => array(
						'arrows_size'         => array(
							'type'        => 'unit',
							'label'       => __( 'Arrows Size', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
						),
						'arrows_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Arrows Color', 'uabb' ),
							'show_reset' => 'true',
							'show_alpha' => 'true',
							'preview'    => array(
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
							'type'        => 'unit',
							'label'       => __( 'Arrows Border Size', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'arrow_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap.slick-slider .slick-arrow',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
						'dots_size'           => array(
							'type'        => 'unit',
							'label'       => __( 'Dots Size', 'uabb' ),
							'description' => __( 'px', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviews-module-wrap .slick-dots li button:before',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'dots_color'          => array(
							'type'       => 'color',
							'label'      => __( 'Dots Color', 'uabb' ),
							'show_alpha' => 'true',
							'show_reset' => 'true',
							'preview'    => array(
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
						'typography_name'           => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-reviewer-name, .uabb-reviewer-link',
								'important' => true,
							),
						),
						'name_font'                 => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-reviewer-name a',
							),
						),
						'name_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviewer-name a',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'name_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviewer-name a',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'name_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-reviewer-name a',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'name_title_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-reviewer-name a',
								'property' => 'text-transform',
							),
						),
					),
				),
				'sections_date_time_typo' => array(
					'title'  => __( 'Review Date', 'uabb' ),
					'fields' => array(
						'date_font'                 => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-review-time',
							),
						),
						'date_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-time',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'date_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-time',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'date_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-time',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'date_title_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-review-time',
								'property' => 'text-transform',
							),
						),
					),
				),
				'sections_content_typo'   => array(
					'title'  => __( 'Review Content', 'uabb' ),
					'fields' => array(
						'content_typography'           => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content',
								'important' => true,
							),
						),
						'content_font'                 => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-review-content',
							),
						),
						'content_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'content_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'content_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'content_title_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content',
								'property' => 'text-transform',
							),
						),
					),
				),
				'sections_readmore_typo'  => array(
					'title'  => __( 'Read More Text', 'uabb' ),
					'fields' => array(
						'readmore_typography'           => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-review-content .uabb-reviews-read-more',
								'important' => true,
							),
						),
						'readmore_font'                 => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-review-content .uabb-reviews-read-more',
							),
						),
						'readmore_font_size_unit'       => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content .uabb-reviews-read-more',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'readmore_line_height_unit'     => array(
							'type'        => 'unit',
							'label'       => __( 'Line height', 'uabb' ),
							'description' => 'em',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content .uabb-reviews-read-more',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'readmore_title_letter_spacing' => array(
							'type'        => 'unit',
							'label'       => __( 'Letter Spacing', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content .uabb-reviews-read-more',
								'property' => 'letter-spacing',
								'unit'     => 'px',
							),
						),
						'readmore_title_transform'      => array(
							'type'    => 'select',
							'label'   => __( 'Transform', 'uabb' ),
							'default' => '',
							'options' => array(
								''           => __( 'Default', 'uabb' ),
								'uppercase'  => __( 'UPPERCASE', 'uabb' ),
								'lowercase'  => __( 'lowercase', 'uabb' ),
								'capitalize' => __( 'Capitalize', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-review-content .uabb-reviews-read-more',
								'property' => 'text-transform',
							),
						),
					),
				),
			),
		),
	)
);

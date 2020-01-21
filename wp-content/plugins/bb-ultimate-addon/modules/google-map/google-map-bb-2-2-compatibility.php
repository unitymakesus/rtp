<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Google Map Module
 */

FLBuilder::register_module(
	'GoogleMapModule', array(
		'multiple_addresses' => array( // Tab.
			'title'       => __( 'Addresses', 'uabb' ), // Tab title.
			'description' => $notice,
			'sections'    => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => __( 'Addresses', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'uabb_gmap_addresses' => array(
							'type'         => 'form',
							'label'        => __( 'Address', 'uabb' ),
							'form'         => 'uabb_google_map_addresses',
							'preview_text' => 'map_name',
							'multiple'     => true,
						),
					),
				),
			),
		),
		'general'            => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'map_width'      => array(
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'size'        => '6',
							'slider'      => array(
								'%' => array(
									'min' => 0,
									'max' => 300,
								),
							),
							'units'       => array( '%' ),
						),
						'map_height'     => array(
							'type'        => 'unit',
							'label'       => __( 'Height', 'uabb' ),
							'placeholder' => '300',
							'size'        => '6',
							'slider'      => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'       => array( 'px' ),
						),
						'map_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Map type', 'uabb' ),
							'default' => 'ROADMAP',
							'options' => array(
								'ROADMAP'   => __( 'Roadmap', 'uabb' ),
								'SATELLITE' => __( 'Satellite', 'uabb' ),
								'HYBRID'    => __( 'Hybrid', 'uabb' ),
								'TERRAIN'   => __( 'Terrain', 'uabb' ),
							),
							'toggle'  => array(
								'ROADMAP'   => array(
									'fields' => array( 'map_skin' ),
								),
								'SATELLITE' => array(
									'fields' => array( '' ),
								),
								'HYBRID'    => array(
									'fields' => array( 'map_skin' ),
								),
								'TERRAIN'   => array(
									'fields' => array( 'map_skin' ),
								),
							),
						),
						'map_fit_marker' => array(
							'type'    => 'select',
							'label'   => __( 'Auto Zoom', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no' => array(
									'fields' => array( 'map_zoom' ),
								),
							),
						),
						'map_zoom'       => array(
							'type'    => 'select',
							'label'   => __( 'Map Zoom', 'uabb' ),
							'default' => '15',
							'options' => array(
								'1'  => __( '1', 'uabb' ),
								'2'  => __( '2', 'uabb' ),
								'3'  => __( '3', 'uabb' ),
								'4'  => __( '4', 'uabb' ),
								'5'  => __( '5', 'uabb' ),
								'6'  => __( '6', 'uabb' ),
								'7'  => __( '7', 'uabb' ),
								'8'  => __( '8', 'uabb' ),
								'9'  => __( '9', 'uabb' ),
								'10' => __( '10', 'uabb' ),
								'11' => __( '11', 'uabb' ),
								'12' => __( '12', 'uabb' ),
								'13' => __( '13', 'uabb' ),
								'14' => __( '14', 'uabb' ),
								'15' => __( '15', 'uabb' ),
								'16' => __( '16', 'uabb' ),
								'17' => __( '17', 'uabb' ),
								'18' => __( '18', 'uabb' ),
								'19' => __( '19', 'uabb' ),
								'20' => __( '20', 'uabb' ),
							),
						),
						'map_expand'     => array(
							'type'    => 'select',
							'label'   => __( 'Disable map zoom on mouse wheel scroll', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'control'            => array( // Tab.
			'title'    => __( 'Controls', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => __( 'Advanced Controls', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'street_view'           => array(
							'type'    => 'select',
							'label'   => __( 'Street view control', 'uabb' ),
							'default' => 'false',
							'options' => array(
								'true'  => __( 'Yes', 'uabb' ),
								'false' => __( 'No', 'uabb' ),
							),
						),
						'map_type_control'      => array(
							'type'    => 'select',
							'label'   => __( 'Map type control', 'uabb' ),
							'default' => 'false',
							'options' => array(
								'true'  => __( 'Yes', 'uabb' ),
								'false' => __( 'No', 'uabb' ),
							),
						),
						'zoom'                  => array(
							'type'    => 'select',
							'label'   => __( 'Zoom control', 'uabb' ),
							'default' => 'false',
							'options' => array(
								'true'  => __( 'Yes', 'uabb' ),
								'false' => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'true' => array(
									'fields' => array( 'zoom_control_position' ),
								),
							),
						),
						'zoom_control_position' => array(
							'type'    => 'select',
							'label'   => __( 'Zoom control position', 'uabb' ),
							'default' => 'RIGHT_BOTTOM',
							'options' => array(
								'RIGHT_TOP'    => 'Right Top',
								'RIGHT_CENTER' => 'Right Center',
								'RIGHT_BOTTOM' => 'Right Bottom',
								'LEFT_TOP'     => 'Left Top',
								'LEFT_CENTER'  => 'Left Center',
								'LEFT_BOTTOM'  => 'Left Bottom',
							),
						),
						'dragging'              => array(
							'type'    => 'select',
							'label'   => __( 'Disable dragging on Mobile', 'uabb' ),
							'default' => 'false',
							'options' => array(
								'false' => __( 'Yes', 'uabb' ),
								'true'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'              => array( // Tab.
			'title'    => __( 'JSON Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title' => array( // Section.
					'title'  => __( 'Map Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'map_skin'  => array(
							'type'    => 'select',
							'label'   => __( 'Map Skin', 'uabb' ),
							'default' => 'custom',
							'options' => array(
								'standard'     => __( 'Standard', 'uabb' ),
								'silver'       => __( 'Silver', 'uabb' ),
								'retro'        => __( 'Retro', 'uabb' ),
								'dark'         => __( 'Dark', 'uabb' ),
								'night'        => __( 'Night', 'uabb' ),
								'aubergine'    => __( 'Aubergine', 'uabb' ),
								'aqua'         => __( 'Aqua', 'uabb' ),
								'classic_blue' => __( 'Classic Blue', 'uabb' ),
								'earth'        => __( 'Earth', 'uabb' ),
								'magnesium'    => __( 'Magnesium', 'uabb' ),
								'custom'       => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'map_style' ),
								),
							),
						),
						'map_style' => array(
							'type'          => 'editor',
							'label'         => '',
							'rows'          => 25,
							'media_buttons' => false,
							'description'   => __( '<br/><br/><a target="_blank" rel="noopener" href="https://mapstyle.withgoogle.com/">Click here</a> to get the style JSON code for styling your map.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'uabb_docs'          => array(
			'title'    => __( 'Docs', 'uabb' ),
			'sections' => array(
				'knowledge_base' => array(
					'title'  => __( 'Helpful Information', 'uabb' ),
					'fields' => array(
						'uabb_helpful_information' => array(
							'type'    => 'raw',
							'content' => '<ul class="uabb-docs-list" data-branding=' . BB_Ultimate_Addon_Helper::uabb_get_branding_for_docs() . '>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-create-google-api-key-in-uabb-google-map-element/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=google-map-module" target="_blank" rel="noopener"> How to create Google API key in Google Maps module? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/how-to-hide-the-google-maps-info-window-on-page-load/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=Google-Map-module" target="_blank" rel="noopener"> How to hide the Google Map’s Info Window on Page Load? </a> </li>

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/unable-to-see-the-address-on-entering/?utm_source=Uabb-Pro-Backend&utm_medium=Module-Editor-Screen&utm_campaign=Google-Map-module" target="_blank" rel="noopener"> Unable to see the address on entering? </a> </li>
								
							 </ul>',
						),
					),
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'uabb_google_map_addresses', array(
		'title' => __( 'Add Address', 'uabb' ),
		'tabs'  => array(
			'general'     => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'features' => array(
						'title'  => __( 'Address', 'uabb' ),
						'fields' => array(
							'map_name'      => array(
								'type'        => 'text',
								'label'       => __( 'Name', 'uabb' ),
								'placeholder' => 'Name the Address',
								'help'        => __( 'Name the Address to identify while editing', 'uabb' ),
							),
							'map_lattitude' => array(
								'type'        => 'text',
								'label'       => __( 'Latitude', 'uabb' ),
								'placeholder' => '40.76142',
								'description' => __( '</br></br><a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank" rel="noopener">Here is a tool</a> where you can find Latitude & Longitude of your location', 'uabb' ),
								'connections' => array( 'custom_field' ),
							),
							'map_longitude' => array(
								'type'        => 'text',
								'label'       => __( 'Longitude', 'uabb' ),
								'placeholder' => '-73.97712',
								'description' => __( '</br></br><a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank" rel="noopener">Here is a tool</a> where you can find Latitude & Longitude of your location', 'uabb' ),
								'connections' => array( 'custom_field' ),
							),
						),
					),
				),
			),
			'marker'      => array(
				'title'    => __( 'Marker', 'uabb' ),
				'sections' => array(
					'features' => array(
						'title'  => '',
						'fields' => array(
							'marker_point' => array(
								'type'    => 'select',
								'label'   => __( 'Marker Point Icon', 'uabb' ),
								'default' => 'default',
								'options' => array(
									'default' => 'Default',
									'custom'  => 'Custom',
								),
								'toggle'  => array(
									'custom' => array(
										'fields' => array( 'marker_img' ),
									),
								),
							),
							'marker_img'   => array(
								'type'        => 'photo',
								'label'       => __( 'Custom Marker', 'uabb' ),
								'show_remove' => true,
							),
						),
					),
				),
			),
			'info_window' => array( // Tab.
				'title'    => __( 'Info Text', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'title' => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'enable_info'      => array(
								'type'    => 'select',
								'label'   => __( 'Show Info Text', 'uabb' ),
								'default' => 'yes',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
								'toggle'  => array(
									'yes' => array(
										'fields' => array( 'info_window_text', 'open_marker' ),
									),
								),
							),
							'info_window_text' => array(
								'type'          => 'editor',
								'label'         => '',
								'media_buttons' => false,
								'connections'   => array( 'string', 'html' ),
							),
							'open_marker'      => array(
								'type'    => 'select',
								'label'   => __( 'Disable Info Window On Load', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'yes' => __( 'Yes', 'uabb' ),
									'no'  => __( 'No', 'uabb' ),
								),
							),
						),
					),
				),
			),
		),
	)
);

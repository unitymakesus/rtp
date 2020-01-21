<?php
/**
 *  UABB Global Settings
 *
 *  @package Global Settings Form
 */

$notice        = '';
$style1        = 'line-height: 1.45em; color: #a94442;';
$theme         = wp_get_theme();
$theme_name    = ( $theme->name ? $theme->name : $theme->parent_theme );
$branding_name = __( 'Ultimate Addons for Beaver Builder', 'uabb' );

if ( UABB_PREFIX != '' && UABB_PREFIX != 'UABB' ) {
	$branding_name = UABB_PREFIX;
}
$title = __( 'Astra', 'uabb' );

if ( class_exists( 'Astra_Ext_White_Label_Markup' ) ) {
	$branding = Astra_Ext_White_Label_Markup::$branding;
	if ( '' != $branding['astra']['name'] ) {
		$title = $branding['astra']['name'];
	}
}

if ( 'Astra' == $theme->name || 'Astra' == $theme->parent_theme || 'Beaver Builder Theme' == $theme->name || 'Beaver Builder Theme' == $theme->parent_theme || 'GeneratePress' == $theme->name || 'GeneratePress' == $theme->parent_theme ) {
	$notice = sprintf( /* translators: "%1$s: search term, "%2$s: search term, "%3$s: search term, "%4$s: search term*/
		__( '<span style="%1$s"> %2$s offers extra compatibility with %3$s, GeneratePress and Beaver Builder theme and it can automatically adapt colors and other settings from the theme customizer. <br> If you would like %4$s to automatically take settings from the theme, select No. But if you would rather like to make your own global settings, select Yes. </span>', 'uabb' ),
		$style1, $branding_name, $title, $branding_name, $theme_name
	);
}

FLBuilder::register_settings_form(
	'uabb-global', array(
		'title' => __( ' - Global Settings', 'uabb' ),
		'tabs'  => array(
			'general' => array(
				'title'       => __( 'Style', 'uabb' ),
				'description' => $notice,
				'sections'    => array(
					'enable_disable' => array(
						'title'  => __( 'Global Styling', 'uabb' ),
						'fields' => array(
							'enable_global' => array(
								'type'    => 'select',
								'label'   => __( 'Enable Global Styling', 'uabb' ),
								'default' => 'yes',
								'options' => array(
									'yes' => 'Yes',
									'no'  => 'No',
								),
								'toggle'  => array(
									'yes' => array(
										'sections' => array( 'theme', 'button' ),
									),
								),
							),
						),
					),
					'theme'          => array(
						'title'  => __( 'General', 'uabb' ),
						'fields' => array(
							'theme_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Primary Color', 'uabb' ),
								'default'    => 'f7b91a',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'theme_text_color' => array(
								'type'       => 'color',
								'label'      => __( 'Primary Text Color', 'uabb' ),
								'default'    => '808285',
								'show_reset' => true,
								'show_alpha' => true,
							),
						),
					),
					'button'         => array(
						'title'  => __( 'Button', 'uabb' ),
						'fields' => array(
							'btn_bg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => 'f7b91a',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'btn_bg_color_opc'       => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'btn_bg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '000000',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_bg_hover_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'btn_text_color'         => array(
								'type'       => 'color',
								'label'      => __( 'Text Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
								'show_alpha' => true,
							),
							'btn_text_hover_color'   => array(
								'type'       => 'color',
								'label'      => __( 'Text Hover Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
								'show_alpha' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_font_size'          => array(
								'type'        => 'text',
								'label'       => __( 'Font Size', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_line_height'        => array(
								'type'        => 'text',
								'label'       => __( 'Line Height', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_letter_spacing'     => array(
								'type'        => 'text',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_text_transform'     => array(
								'type'    => 'select',
								'label'   => __( 'Text Transform', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'       => __( 'None', 'uabb' ),
									'capitalize' => __( 'Capitalize', 'uabb' ),
									'uppercase'  => __( 'Uppercase', 'uabb' ),
									'lowercase'  => __( 'Lowercase', 'uabb' ),
									'initial'    => __( 'Initial', 'uabb' ),
									'inherit'    => __( 'Inherit', 'uabb' ),
								),
							),
							'btn_border_radius'      => array(
								'type'        => 'text',
								'label'       => __( 'Border Radius', 'uabb' ),
								'default'     => '5',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_vertical_padding'   => array(
								'type'        => 'text',
								'label'       => __( 'Vertical Padding', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_horizontal_padding' => array(
								'type'        => 'text',
								'label'       => __( 'Horizontal Padding', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
						),
					),
				),
			),
		),
	)
);

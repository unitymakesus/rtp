<?php
/**
 *  UABB Search Module front-end CSS php file
 *
 *  @package UABB Search Module
 */

$form_selector      = ".fl-node-$id .uabb-search-form";
$form_selector_wrap = ".fl-node-$id .uabb-search-form-wrap";
$input_selector     = ".fl-node-$id .uabb-form-field input[type=search]";
$input_placeholder  = $input_selector . '::placeholder';

// Default form styles.
FLBuilderCSS::rule(
	array(
		'selector' => $form_selector_wrap,
		'props'    => array(
			'font-size' => '16px',
			'padding'   => '10px',
		),
	)
);

// Form width.
FLBuilderCSS::rule(
	array(
		'selector' => $form_selector_wrap,
		'enabled'  => 'custom' === $settings->width,
		'props'    => array(
			'width' => array(
				'value' => $settings->custom_width,
				'unit'  => $settings->custom_width_unit,
			),
		),
	)
);

// Overall Alignment.
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'form_align',
		'selector'     => $form_selector,
		'prop'         => 'text-align',
	)
);

// Form height.
FLBuilderCSS::responsive_rule(
	array(
		'settings'     => $settings,
		'unit'         => 'px',
		'setting_name' => 'form_height',
		'selector'     => $form_selector_wrap,
		'prop'         => 'min-height',
	)
);

// Form background color.
FLBuilderCSS::rule(
	array(
		'selector' => $form_selector_wrap,
		'props'    => array(
			'background-color' => $settings->form_bg_color,
		),
	)
);

// Form hover background.
FLBuilderCSS::rule(
	array(
		'selector' => $form_selector_wrap . ':hover',
		'props'    => array(
			'background-color' => $settings->form_bg_hover_color,
		),
	)
);

// Form Border - Settings.
FLBuilderCSS::border_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'form_border',
		'selector'     => $form_selector_wrap,
	)
);

// Form Border - Hover color.
FLBuilderCSS::rule(
	array(
		'selector' => $form_selector_wrap . ':hover',
		'props'    => array(
			'border-color' => $settings->form_border_hov_color,
		),
	)
);

// Form padding.
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'form_padding',
		'selector'     => $form_selector_wrap,
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'form_padding_top',
			'padding-right'  => 'form_padding_right',
			'padding-bottom' => 'form_padding_bottom',
			'padding-left'   => 'form_padding_left',
		),
	)
);

// Default input styles.
FLBuilderCSS::rule(
	array(
		'selector' => $input_selector,
		'props'    => array(
			'border-radius' => '4px',
			'font-size'     => '16px',
			'line-height'   => '16px',
			'padding'       => '12px 24px',
		),
	)
);

// Input color.
FLBuilderCSS::rule(
	array(
		'selector' => $input_selector . ',' . $input_placeholder . ", .fl-node-$id .uabb-search-form.uabb-search-form-input .icon",
		'enabled'  => ! empty( $settings->input_color ),
		'props'    => array(
			'color' => $settings->input_color,
		),
	)
);

// Input background color.
FLBuilderCSS::rule(
	array(
		'selector' => $input_selector . ", .fl-node-$id .uabb-search-results-content",
		'props'    => array(
			'background-color' => $settings->input_bg_color,
		),
	)
);

// input hover background.
FLBuilderCSS::rule(
	array(
		'selector' => $input_selector . ':hover',
		'props'    => array(
			'background-color' => $settings->input_bg_hover_color,
		),
	)
);

// Input typography.
FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'input_typo',
		'selector'     => $input_selector . ", .fl-node-$id .uabb-search-post-text, .fl-node-$id .uabb-search-form.uabb-search-button-fullscreen .uabb-form-field input[type=search]",
	)
);

// Input Border.
FLBuilderCSS::border_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'input_border',
		'selector'     => $input_selector,
	)
);

// Input Border Hover color.
FLBuilderCSS::rule(
	array(
		'selector' => $input_selector . ':hover,' . $input_selector . ':focus',
		'props'    => array(
			'border-color' => $settings->input_border_hov_color,
		),
	)
);

// Input padding.
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'input_padding',
		'selector'     => $input_selector,
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'input_padding_top',
			'padding-right'  => 'input_padding_right',
			'padding-bottom' => 'input_padding_bottom',
			'padding-left'   => 'input_padding_left',
		),
	)
);

// Button CSS.
if ( 'button' === $settings->display || 'both' === $settings->display ) {
	$btn_settings = array(

		/* General Section */
		'text'                                       => $settings->btn_text,

		/* Link Section */
		'link'                                       => '',
		'link_target'                                => '',

		/* Colors */
		'bg_color'                                   => $settings->btn_bg_color,
		'bg_hover_color'                             => $settings->btn_bg_hover_color,
		'text_color'                                 => $settings->btn_text_color,
		'text_hover_color'                           => $settings->btn_text_hover_color,

		/* Icon */
		'icon'                                       => $settings->btn_icon,
		'icon_position'                              => $settings->btn_icon_position,

		/* Structure */
		'button_padding_dimension_top'               => ( isset( $settings->button_padding_dimension_top ) ) ? $settings->button_padding_dimension_top : '',
		'button_padding_dimension_left'              => ( isset( $settings->button_padding_dimension_left ) ) ? $settings->button_padding_dimension_left : '',
		'button_padding_dimension_bottom'            => ( isset( $settings->button_padding_dimension_bottom ) ) ? $settings->button_padding_dimension_bottom : '',
		'button_padding_dimension_right'             => ( isset( $settings->button_padding_dimension_right ) ) ? $settings->button_padding_dimension_right : '',
		'button_padding_dimension_top_medium'        => ( isset( $settings->button_padding_dimension_top_medium ) ) ? $settings->button_padding_dimension_top_medium : '',
		'button_padding_dimension_left_medium'       => ( isset( $settings->button_padding_dimension_left_medium ) ) ? $settings->button_padding_dimension_left_medium : '',
		'button_padding_dimension_bottom_medium'     => ( isset( $settings->button_padding_dimension_bottom_medium ) ) ? $settings->button_padding_dimension_bottom_medium : '',
		'button_padding_dimension_right_medium'      => ( isset( $settings->button_padding_dimension_right_medium ) ) ? $settings->button_padding_dimension_right_medium : '',
		'button_padding_dimension_top_responsive'    => ( isset( $settings->button_padding_dimension_top_responsive ) ) ? $settings->button_padding_dimension_top_responsive : '',
		'button_padding_dimension_left_responsive'   => ( isset( $settings->button_padding_dimension_left_responsive ) ) ? $settings->button_padding_dimension_left_responsive : '',
		'button_padding_dimension_bottom_responsive' => ( isset( $settings->button_padding_dimension_bottom_responsive ) ) ? $settings->button_padding_dimension_bottom_responsive : '',
		'button_padding_dimension_right_responsive'  => ( isset( $settings->button_padding_dimension_right_responsive ) ) ? $settings->button_padding_dimension_right_responsive : '',
		'button_border'                              => ( isset( $settings->button_border ) ) ? $settings->button_border : '',
		'border_hover_color'                         => ( isset( $settings->border_hover_color ) ) ? $settings->border_hover_color : '',
	);
	/* CSS Render Function */
	FLBuilder::render_module_css( 'uabb-button', $id, $btn_settings );

	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'btn_typo',
			'selector'     => ".fl-node-$id .uabb-creative-button-wrap a,.fl-node-$id .uabb-creative-button-wrap a:visited",
		)
	);
}

// Button layout style.
if ( 'button' === $settings->display ) {

	if ( 'expand' === $settings->btn_action ) {
		// Default text field styles.
		FLBuilderCSS::rule(
			array(
				'selector' => ".fl-node-$id .uabb-search-text, .fl-node-$id .uabb-search-text:focus",
				'enabled'  => empty( $settings->text_bg_color ),
				'props'    => array(
					'background-color' => $settings->btn_bg_color,
				),
			)
		);
	}

	if ( 'fullscreen' === $settings->btn_action ) {
		// Input width.
		FLBuilderCSS::rule(
			array(
				'selector' => ".fl-node-$id .uabb-search-form-input-wrap",
				'props'    => array(
					'width' => array(
						'value' => $settings->fs_input_width,
						'unit'  => $settings->fs_input_width_unit,
					),
				),
			)
		);

		// Overlay Background.
		FLBuilderCSS::rule(
			array(
				'selector' => ".fl-node-$id .uabb-search-overlay",
				'enabled'  => ! empty( $settings->fs_overlay_bg ),
				'props'    => array(
					'background-color' => $settings->fs_overlay_bg,
					'opacity'          => 1,
					'filter'           => 'none',
				),
			)
		);
	}
}

// Button Icon.
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .uabb-button-icon:before",
		'enabled'  => ! empty( $settings->btn_icon_color ),
		'props'    => array(
			'color' => $settings->btn_icon_color,
		),
	)
);

$btn_icon_color_hover = $settings->btn_icon_color_hover;

// Button Icon Hover.
FLBuilderCSS::rule(
	array(
		'selector' => ".fl-node-$id .uabb-button:hover .uabb-button-icon:before",
		'enabled'  => ! empty( $settings->btn_icon_color ),
		'props'    => array(
			'color' => ! empty( $btn_icon_color_hover ) ? $btn_icon_color_hover : $settings->btn_text_hover_color,
		),
	)
);

// Ajax Results.
if ( 'yes' === $settings->enable_ajax ) {
	FLBuilderCSS::rule(
		array(
			'selector' => ".fl-node-$id .uabb-search-results-content",
			'enabled'  => 'custom' === $settings->result_width,
			'props'    => array(
				'width' => array(
					'value' => $settings->custom_result_width,
					'unit'  => $settings->custom_result_width_unit,
				),
			),
		)
	);

	if ( '1' === $settings->show_image ) {
		FLBuilderCSS::rule(
			array(
				'selector' => ".fl-node-$id .uabb-search-post-image img",
				'props'    => array(
					'border-radius' => array(
						'value' => $settings->img_border_radius,
						'unit'  => 'px',
					),
				),
			)
		);
	}
}

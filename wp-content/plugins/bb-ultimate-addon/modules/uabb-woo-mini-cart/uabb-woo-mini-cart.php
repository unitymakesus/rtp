<?php
/**
 * UABB Woo Mini Cart File.
 *
 * @package UABB Woo - Mini Cart module.
 */

/**
 * Function that initializes UABB Woo - Mini Cart Module
 *
 * @class UABBWooMiniCartModule
 */
class UABBWooMiniCartModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Woo - Mini Cart', 'uabb' ),
				'description'     => __( 'Display WooCommerce Mini Cart', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$woo_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-mini-cart/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-woo-mini-cart/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'uabb-woo-mini-cart.svg',
			)
		);
		$this->add_css( 'font-awesome-5' );

		add_filter(
			'woocommerce_add_to_cart_fragments',
			function ( $fragments ) {
				$fragments['span.uabb-cart-btn-badge'] = '<span class="uabb-cart-btn-badge">' . WC()->cart->get_cart_contents_count() . '</span>';

				$fragments['span.uabb-mc__btn-subtotal'] = '<span class="uabb-mc__btn-subtotal">' . WC()->cart->get_cart_subtotal() . '</span>';

				$fragments['span.uabb-mini-cart-header-badge'] = '<span class="uabb-mini-cart-header-badge">' . WC()->cart->get_cart_contents_count() . '</div>';

				$fragments['span.uabb-mini-cart-header-text'] = '<span class="uabb-mini-cart-header-text">' . __( 'Subtotal: ', 'uabb' ) . WC()->cart->get_cart_subtotal() . '</span>';

				ob_start();
				?>
				<div class="uabb-mini-cart-items">
					<?php echo woocommerce_mini_cart();//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
				$fragments['div.uabb-mini-cart-items'] = ob_get_clean();
				return $fragments;

			}
		);
	}

	/**
	 * Function to get the icon for the Devices
	 *
	 * @since 1.27.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-mini-cart/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-mini-cart/icon/' . $icon );
		}
		return '';
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBWooMiniCartModule',
	array(
		'General'            => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'cart_btn' => array(
					'title'  => 'Cart',
					'fields' => array(
						'btn_style'      => array(
							'type'    => 'select',
							'label'   => __( 'Button Style', 'uabb' ),
							'default' => 'icon',
							'options' => array(
								'icon'      => __( 'Icon', 'uabb' ),
								'text'      => __( 'Text', 'uabb' ),
								'icon-text' => __( 'Icon + Text', 'uabb' ),
							),
							'toggle'  => array(
								'icon'      => array(
									'fields' => array( 'cart_icon' ),
								),
								'text'      => array(
									'fields'   => array( 'cart_text', 'in_cart_icon', 'show_subtotal' ),
									'sections' => array( 'cart_btn_typography' ),
								),
								'icon-text' => array(
									'fields'   => array( 'cart_text', 'cart_icon_space', 'cart_icon', 'show_subtotal' ),
									'sections' => array( 'cart_btn_typography' ),
								),
							),
						),
						'cart_icon'      => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'fa fa-shopping-cart',
							'show_remove' => true,
						),
						'cart_text'      => array(
							'type'        => 'text',
							'default'     => 'Cart',
							'label'       => __( 'Cart Text', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'show_subtotal'  => array(
							'type'    => 'select',
							'label'   => __( 'Show Subtotal', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'show_badge'     => array(
							'type'    => 'select',
							'label'   => __( 'Show Badge', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'badge_position', 'badge_style' ),
								),
							),
						),
						'badge_position' => array(
							'type'    => 'select',
							'label'   => __( 'Badge Position', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline' => __( 'After Icon', 'uabb' ),
								'top'    => __( 'Bubble', 'uabb' ),
							),
						),
						'badge_style'    => array(
							'type'    => 'select',
							'label'   => __( 'Badge Style', 'uabb' ),
							'default' => 'circle',
							'options' => array(
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
							),
						),
						'cart_btn_align' => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'left',
						),
					),
				),
				'cart'     => array(
					'title'  => 'Cart Content',
					'fields' => array(
						'preview_cart'       => array(
							'type'    => 'select',
							'label'   => __( 'Preview Cart', 'uabb' ),
							'default' => '1',
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
							'help'    => __( 'If enabled, you will see preview of Mini Cart at backend. This option is just for preview purpose.', 'uabb' ),
						),
						'in_cart_icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'fa fa-shopping-cart',
							'show_remove' => true,
						),
						'cart_style'         => array(
							'type'    => 'select',
							'label'   => __( 'Cart Style', 'uabb' ),
							'default' => 'dropdown',
							'options' => array(
								'dropdown'   => __( 'Dropdown', 'uabb' ),
								'modal'      => __( 'Modal', 'uabb' ),
								'off-canvas' => __( 'Off-Canvas', 'uabb' ),
							),
							'toggle'  => array(
								'dropdown'   => array(
									'fields' => array( 'cart_margin_left', 'cart_margin_top', 'open_cart_on' ),
								),
								'modal'      => array(
									'fields' => array( 'esc_keypress', 'overlay_click', 'overlay_color', 'display_position', 'modal_height' ),
								),
								'off-canvas' => array(
									'fields' => array( 'esc_keypress', 'overlay_click', 'offcanvas_position', 'overlay_color', 'display_position' ),
								),
							),
						),
						'display_position'   => array(
							'type'    => 'select',
							'label'   => __( 'Cart Button Position', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline'   => __( 'Inline', 'uabb' ),
								'floating' => __( 'Floating', 'uabb' ),
							),
							'toggle'  => array(
								'floating' => array(
									'fields' => array( 'floating_align', 'ver_floating_position', 'hor_floating_position' ),
								),
								'inline'   => array(
									'fields' => array( 'cart_btn_align' ),
								),
							),
						),
						'floating_align'     => array(
							'type'    => 'select',
							'label'   => __( 'Floating Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
							),
						),
						'open_cart_on'       => array(
							'type'    => 'select',
							'label'   => __( 'Open Cart On', 'uabb' ),
							'default' => 'click',
							'options' => array(
								'click' => __( 'Click', 'uabb' ),
								'hover' => __( 'Hover', 'uabb' ),
							),
						),
						'offcanvas_position' => array(
							'type'    => 'select',
							'label'   => __( 'Off- Canvas Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
							),
						),
						'overlay_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'default'     => 'rgba(0,0,0,0.75)',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-cart-off-canvas-wrap, .uabb-cart-modal-wrap',
										'property' => 'background-color',
									),
								),
							),
						),
						'esc_keypress'       => array(
							'type'    => 'select',
							'label'   => __( 'Close Cart on ESC Keypress', 'uabb' ),
							'default' => '0',
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
						'overlay_click'      => array(
							'type'    => 'select',
							'label'   => __( 'Close Cart on Overlay Click', 'uabb' ),
							'default' => '0',
							'options' => array(
								'1' => __( 'Yes', 'uabb' ),
								'0' => __( 'No', 'uabb' ),
							),
						),
						'cart_title'         => array(
							'type'        => 'text',
							'label'       => __( 'Cart Title', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'cart_msg'           => array(
							'type'        => 'editor',
							'label'       => 'Cart Message',
							'default'     => '100% Secure Checkout!',
							'connections' => array( 'string', 'html' ),
						),
					),
				),
			),
		),
		'cart_btn_style_tab' => array( // Tab.
			'title'    => __( 'Cart Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'cart_btn_icon' => array(
					'title'  => 'Cart Icon',
					'fields' => array(
						'cart_icon_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Icon Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-btn-icon, .uabb-mini-cart-header-icon',
								'property' => 'color',
							),
						),
						'cart_icon_size'        => array(
							'type'       => 'unit',
							'label'      => __( 'Icon Size', 'uabb' ),
							'default'    => '25',
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-btn-icon, .uabb-mini-cart-header-icon',
								'property' => 'font-size',
							),
						),
						'ver_floating_position' => array(
							'type'    => 'unit',
							'label'   => __( 'Vertical Floating Position', 'uabb' ),
							'default' => 50,
							'slider'  => true,
							'units'   => array( '%' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'hor_floating_position' => array(
							'type'    => 'unit',
							'label'   => __( 'Horizontal Floating Position', 'uabb' ),
							'default' => 0,
							'slider'  => true,
							'units'   => array( '%' ),
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'cart_icon_space'       => array(
							'type'       => 'unit',
							'default'    => '7',
							'label'      => __( 'Space between Icon & Text', 'uabb' ),
							'units'      => array(
								'px',
							),
							'slider'     => array(
								'px' => array(
									'min' => -100,
									'max' => 100,
								),
							),
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-text',
								'property' => 'margin-left',
							),
						),
					),
				),
				'badge_styling' => array(
					'title'  => 'Badge',
					'fields' => array(
						'badge_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-btn-badge, .uabb-mini-cart-header-badge',
								'property' => 'color',
							),
						),
						'badge_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-btn-badge, .uabb-mini-cart-header-badge',
								'property' => 'background-color',
							),
						),
						'badge_space'    => array(
							'type'       => 'unit',
							'label'      => __( 'Spacing', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-btn-badge, .uabb-mini-cart-header-badge',
								'property' => 'margin-left',
							),
						),
					),
				),
			),
		),
		'cart_style_tab'     => array( // Tab.
			'title'    => __( 'Cart Content Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'cart_container_style' => array(
					'title'  => 'Cart Container',
					'fields' => array(
						'cart_bg_type'       => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'none',
							'options' => array(
								'none'     => __( 'None', 'uabb' ),
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
								'image'    => __( 'Image', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'cart_bg_color' ),
								),
								'gradient' => array(
									'fields' => array( 'cart_bg_gradient' ),
								),
								'image'    => array(
									'fields' => array( 'cart_bg_img', 'cart_bg_img_pos', 'cart_bg_img_repeat', 'cart_bg_img_size' ),
								),
							),
						),
						'cart_bg_img'        => array(
							'type'        => 'photo',
							'label'       => __( 'Image', 'uabb' ),
							'show_remove' => true,
						),
						'cart_bg_img_pos'    => array(
							'type'    => 'select',
							'label'   => __( 'Background Position', 'uabb' ),
							'default' => 'center center',
							'options' => array(
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							),
						),
						'cart_bg_img_repeat' => array(
							'type'    => 'select',
							'label'   => __( 'Background Repeat', 'uabb' ),
							'default' => 'repeat',
							'options' => array(
								'no-repeat' => __( 'No Repeat', 'uabb' ),
								'repeat'    => __( 'Repeat All', 'uabb' ),
								'repeat-x'  => __( 'Repeat Horizontally', 'uabb' ),
								'repeat-y'  => __( 'Repeat Vertically', 'uabb' ),
							),
						),
						'cart_bg_img_size'   => array(
							'type'    => 'select',
							'label'   => __( 'Background Size', 'uabb' ),
							'default' => 'cover',
							'options' => array(
								'contain' => __( 'Contain', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'initial' => __( 'Initial', 'uabb' ),
								'inherit' => __( 'Inherit', 'uabb' ),
							),
						),
						'cart_bg_gradient'   => array(
							'type'  => 'gradient',
							'label' => __( 'Gradient', 'uabb' ),
						),
						'cart_bg_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'background-color',
							),
						),
						'cart_border'        => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
						'modal_height'       => array(
							'type'       => 'unit',
							'label'      => __( 'Cart Height', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-cart-style-modal',
								'property' => 'height',
								'unit'     => 'px',
							),
						),
						'cart_width'         => array(
							'type'       => 'unit',
							'label'      => __( 'Cart Width', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'width',
								'unit'     => 'px',
							),
						),
						'cart_padding'       => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
						'cart_margin_left'   => array(
							'type'    => 'unit',
							'label'   => __( 'Left Spacing', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => -100,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'margin-left',
								'unit'     => 'px',
							),
						),
						'cart_margin_top'    => array(
							'type'    => 'unit',
							'label'   => __( 'Top Distance', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => -100,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-content',
								'property' => 'margin-top',
								'unit'     => 'px',
							),
						),
						'space_bet_btns'     => array(
							'type'    => 'unit',
							'label'   => __( 'Space Between View Cart & Checkout Button', 'uabb' ),
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 100,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.button.checkout.wc-forward',
								'property' => 'margin-left',
								'unit'     => 'px',
							),
						),
					),
				),
				'subtotal_style'       => array(
					'title'     => 'Cart Sub Total',
					'collapsed' => true,
					'fields'    => array(
						'subtotal_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-header-text',
								'property' => 'color',
							),
						),
						'subtotal_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-header-text',
								'property' => 'background-color',
							),
						),
						'subtotal_border'   => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-header-text',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
						'subtotal_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-header-text',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'cart_title_style'     => array(
					'title'     => 'Cart Title',
					'collapsed' => true,
					'fields'    => array(
						'cart_title_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-title',
								'property' => 'color',
							),
						),
						'cart_title_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-title',
								'property' => 'background-color',
							),
						),
						'cart_title_align'    => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-title',
								'property' => 'text-align',
							),
						),
						'cart_title_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-title',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'cart_msg_style'       => array(
					'title'     => 'Cart Message',
					'collapsed' => true,
					'fields'    => array(
						'cart_msg_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-message',
								'property' => 'color',
							),
						),
						'cart_msg_bg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-message',
								'property' => 'background-color',
							),
						),
						'cart_msg_align'    => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-message',
								'property' => 'text-align',
							),
						),
						'cart_msg_padding'  => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-message',
								'property' => 'padding',
								'unit'     => 'px',
							),
						),
					),
				),
				'empty_msg_style'      => array(
					'title'     => 'Empty Cart Message',
					'collapsed' => true,
					'fields'    => array(
						'empty_msg_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__empty-message',
								'property' => 'color',
							),
						),
						'empty_msg_align' => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => '',
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__empty-message',
								'property' => 'text-align',
							),
						),
					),
				),
				'item_container_style' => array(
					'title'     => 'Item Container',
					'collapsed' => true,
					'fields'    => array(
						'item_name_color'      => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Item Name Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart li.woocommerce-mini-cart-item.mini_cart_item > a:nth-child(2)',
								'property' => 'color',
							),
						),
						'item_img_border'      => array(
							'type'    => 'border',
							'label'   => __( 'Item Image Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
						'item_qty_price_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Item Quantity & Price Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart-item.mini_cart_item span.quantity',
								'property' => 'color',
							),
						),
						'remove_icon_size'     => array(
							'type'   => 'unit',
							'label'  => __( 'Remove Item Icon Size', 'uabb' ),
							'slider' => true,
							'units'  => array( 'px' ),
						),
						'remove_icon_color'    => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Remove Item Icon Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart ul.woocommerce-mini-cart.cart_list.product_list_widget li a.remove.remove_from_cart_button',
								'property' => 'color',
							),
						),
						'remove_icon_border'   => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart ul.woocommerce-mini-cart.cart_list.product_list_widget li a.remove.remove_from_cart_button',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
					),
				),
				'view_cart_btn_style'  => array(
					'title'     => 'View Cart Button',
					'collapsed' => true,
					'fields'    => array(
						'view_btn_text_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)',
								'property' => 'color',
							),
						),
						'view_btn_text_hov_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'view_btn_bg_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)',
								'property' => 'background-color',
							),
						),
						'view_btn_bg_hov_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'view_btn_border'           => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
						'view_btn_border_hov_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
				'checkout_btn_style'   => array(
					'title'     => 'Checkout Button',
					'collapsed' => true,
					'fields'    => array(
						'checkout_text_color'       => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout',
								'property' => 'color',
							),
						),
						'checkout_text_hov_color'   => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'checkout_bg_color'         => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout',
								'property' => 'background-color',
							),
						),
						'checkout_bg_hov_color'     => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'checkout_border'           => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout',
								'property' => 'border',
								'unit'     => 'px',
							),
						),
						'checkout_border_hov_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
			),
		),
		'typography'         => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'cart_btn_typography'       => array(
					'title'  => __( 'Cart Button Text', 'uabb' ),
					'fields' => array(
						'cart_btn_typo'      => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-text, .woocommerce-Price-amount.amount',
							),
						),
						'cart_btn_txt_color' => array(
							'type'        => 'color',
							'connections' => array( 'color' ),
							'label'       => __( 'Text Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-text',
								'property' => 'color',
							),
						),
					),
				),
				'subtotal_typography'       => array(
					'title'  => __( 'Subtotal', 'uabb' ),
					'fields' => array(
						'subtotal_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-header-text',
							),
						),
					),
				),
				'cart_title_typography'     => array(
					'title'  => __( 'Cart Title', 'uabb' ),
					'fields' => array(
						'cart_title_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-title',
							),
						),
					),
				),
				'cart_msg_typography'       => array(
					'title'  => __( 'Cart Message', 'uabb' ),
					'fields' => array(
						'cart_msg_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-mini-cart-message',
							),
						),
					),
				),
				'empt_msg_typography'       => array(
					'title'  => __( 'Empty Cart Message', 'uabb' ),
					'fields' => array(
						'empt_msg_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__empty-message',
							),
						),
					),
				),
				'item_name_typography'      => array(
					'title'  => __( 'Item Name', 'uabb' ),
					'fields' => array(
						'item_name_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart li.woocommerce-mini-cart-item.mini_cart_item > a:nth-child(2)',
							),
						),
					),
				),
				'item_qty_price_typography' => array(
					'title'  => __( 'Item Quantity & Price', 'uabb' ),
					'fields' => array(
						'item_qty_price_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart-item.mini_cart_item span.quantity',
							),
						),
					),
				),
				'view_cart_typography'      => array(
					'title'  => __( 'View Cart Button', 'uabb' ),
					'fields' => array(
						'view_cart_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout)',
							),
						),
					),
				),
				'checkout_typography'       => array(
					'title'  => __( 'Checkout Button', 'uabb' ),
					'fields' => array(
						'checkout_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-woo-mini-cart .woocommerce-mini-cart__buttons a.button.checkout',
							),
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

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/woo-mini-cart-module/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=woo-mini-cart-module" target="_blank" rel="noopener"> Getting started article </a> </li>
							 </ul>',
						),
					),
				),
			),
		),
	)
);

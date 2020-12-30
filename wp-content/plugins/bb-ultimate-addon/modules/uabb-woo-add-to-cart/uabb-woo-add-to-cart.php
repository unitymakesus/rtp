<?php
/**
 *  UABB Woo Add To Cart Module file
 *
 *  @package UABB Woo Add To Cart Module
 */

if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * Function that initializes UABB Woo Add To Cart Module
	 *
	 * @class UABBWooAddToCartModule
	 */
	class UABBWooAddToCartModule extends FLBuilderModule {

		/**
		 * Products Query
		 *
		 * @var query
		 */
		private $query = null;

		/**
		 * Constructor function that constructs default values for the UABBWooAddToCartModule module
		 *
		 * @method __construct
		 */
		public function __construct() {
			parent::__construct(
				array(
					'name'            => __( 'Woo - Add To Cart', 'uabb' ),
					'description'     => __( 'Display WooCommerce Add to Cart button.', 'uabb' ),
					'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$woo_modules ),
					'group'           => UABB_CAT,
					'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-add-to-cart/',
					'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-woo-add-to-cart/',
					'partial_refresh' => true,
					'icon'            => 'uabb-woo-add-to-cart.svg',
				)
			);

			$this->add_css( 'font-awesome-5' );
		}

		/**
		 * Function that renders icons for the Woo - Add To Cart
		 *
		 * @param object $icon get an object for the icon.
		 */
		public function get_icon( $icon = '' ) {

			if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-add-to-cart/icon/' . $icon ) ) {
				return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-add-to-cart/icon/' . $icon );
			}
			return '';
		}

		/**
		 * Ensure backwards compatibility with old settings.
		 *
		 * @since 1.14.0
		 * @param object $settings A module settings object.
		 * @param object $helper A settings compatibility helper.
		 * @return object
		 */
		public function filter_settings( $settings, $helper ) {

			$version_bb_check        = UABB_Compatibility::$version_bb_check;
			$page_migrated           = UABB_Compatibility::$uabb_migration;
			$stable_version_new_page = UABB_Compatibility::$stable_version_new_page;

			if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {

				// compatibility for Button.
				if ( ! isset( $settings->button_font_typo ) || ! is_array( $settings->button_font_typo ) ) {

					$settings->button_font_typo            = array();
					$settings->button_font_typo_medium     = array();
					$settings->button_font_typo_responsive = array();
				}
				if ( isset( $settings->font_family ) ) {

					if ( isset( $settings->font_family['family'] ) ) {

						$settings->button_font_typo['font_family'] = $settings->font_family['family'];
						unset( $settings->font_family['family'] );
					}
					if ( isset( $settings->font_family['weight'] ) ) {

						if ( 'regular' === $settings->font_family['weight'] ) {
							$settings->button_font_typo['font_weight'] = 'normal';
						} else {
							$settings->button_font_typo['font_weight'] = $settings->font_family['weight'];
						}
						unset( $settings->font_family['weight'] );
					}
				}
				if ( isset( $settings->font_size ) ) {

					$settings->button_font_typo['font_size'] = array(
						'length' => $settings->font_size,
						'unit'   => 'px',
					);
					unset( $settings->font_size );
				}
				if ( isset( $settings->font_size_medium ) ) {
					$settings->button_font_typo_medium['font_size'] = array(
						'length' => $settings->font_size_medium,
						'unit'   => 'px',
					);
					unset( $settings->font_size_medium );
				}
				if ( isset( $settings->font_size_responsive ) ) {
					$settings->button_font_typo_responsive['font_size'] = array(
						'length' => $settings->font_size_responsive,
						'unit'   => 'px',
					);
					unset( $settings->font_size_responsive );
				}
				if ( isset( $settings->line_height ) ) {

					$settings->button_font_typo['line_height'] = array(
						'length' => $settings->line_height,
						'unit'   => 'em',
					);
					unset( $settings->line_height );
				}
				if ( isset( $settings->line_height_medium ) ) {
					$settings->button_font_typo_medium['line_height'] = array(
						'length' => $settings->line_height_medium,
						'unit'   => 'em',
					);
					unset( $settings->line_height_medium );
				}
				if ( isset( $settings->line_height_responsive ) ) {
					$settings->button_font_typo_responsive['line_height'] = array(
						'length' => $settings->line_height_responsive,
						'unit'   => 'em',
					);
					unset( $settings->line_height_responsive );
				}
				if ( isset( $settings->transform ) ) {

					$settings->button_font_typo['text_transform'] = $settings->transform;
					unset( $settings->transform );
				}
				if ( isset( $settings->letter_spacing ) ) {

					$settings->button_font_typo['letter_spacing'] = array(
						'length' => $settings->letter_spacing,
						'unit'   => 'px',
					);
					unset( $settings->letter_spacing );
				}
			}

			return $settings;
		}

		/**
		 * Render Cart Button.
		 *
		 * @since 1.10.0
		 * @method get_inner_classes
		 */
		public function get_inner_classes() {

			$settings = $this->settings;
			$classes  = array();

			$classes = array(
				'uabb-woo--align-' . $settings->content_alignment,
			);

			if ( 'grid' === $settings->layout ) {

				$classes[] = 'uabb-woo-cat__column-' . $settings->grid_columns_desktop;
				$classes[] = 'uabb-woo-cat__column-tablet-' . $settings->grid_columns_medium;
				$classes[] = 'uabb-woo-cat__column-mobile-' . $settings->grid_columns_small;
			} elseif ( 'carousel' === $settings->layout ) {
				$classes[] = 'uabb-woo-cat__column-' . $settings->slider_columns_desktop;
				$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_position;
				$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_style;

				if ( 'yes' === $settings->enable_dots ) {
					$classes[] = 'uabb-slick-dotted';
				}
			}

			return implode( ' ', $classes );
		}

		/**
		 * Render Cart Button.
		 *
		 * @since 1.10.0
		 * @method render_cart_button
		 */
		public function render_cart_button() {

			$settings  = $this->settings;
			$node_id   = $this->node;
			$atc_html  = '';
			$product   = false;
			$new_class = '';

			if ( ! empty( $settings->product_id ) ) {
				$product_data = get_post( $settings->product_id );
			}

			$product = ! empty( $product_data ) && in_array( $product_data->post_type, array( 'product', 'product_variation' ) ) ? wc_setup_product_data( $product_data ) : false; // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict

			if ( $product ) {

				$product_id   = $product->get_id();
				$product_type = $product->get_type();

				$class = array(
					'button',
					'uabb-button',
					'product_type_' . $product_type,
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
				);

				if ( 'transparent' === $settings->style ) {
					$class[] = 'uabb-creative-button uabb-creative-transparent-btn';
					if ( isset( $settings->transparent_button_options ) && ! empty( $settings->transparent_button_options ) ) {
						$class[] .= ' uabb-' . $settings->transparent_button_options . '-btn';
					}
				} else {
					$class[] = 'uabb-adc-normal-btn';
				}

				if ( 'yes' === $settings->auto_redirect ) {
					$class[] = 'uabb-redirect';
				}

				$attr = array(
					'rel'             => 'nofollow',
					'href'            => $product->add_to_cart_url(),
					'data-quantity'   => ( isset( $settings->quantity ) ? $settings->quantity : 1 ),
					'data-product_id' => $product_id,
				);

				$attr_string = '';

				foreach ( $attr as $key => $value ) {
					$attr_string .= ' ' . $key . '="' . $value . '"';
				}

				$atc_html     .= '<a class="' . implode( ' ', $class ) . '"' . $attr_string . '>';
					$atc_html .= '<span class="uabb-atc-content-wrapper">';

				if ( ! empty( $settings->btn_icon ) ) :
					$atc_html     .= '<span class="uabb-atc-icon-align uabb-atc-align-icon-' . $settings->btn_icon_position . '">';
						$atc_html .= '<i class="' . $settings->btn_icon . '" aria-hidden="true"></i>';
					$atc_html     .= '</span>';
					endif;

						$atc_html .= '<span class="uabb-atc-btn-text">' . $settings->btn_text . '</span>';
					$atc_html     .= '</span>';
				$atc_html         .= '</a>';

				echo $atc_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} elseif ( current_user_can( 'manage_options' ) ) {

				if ( 'transparent' === $settings->style ) {
					$new_class = ' uabb-creative-button uabb-creative-transparent-btn';
					if ( isset( $settings->transparent_button_options ) && ! empty( $settings->transparent_button_options ) ) {
						$new_class .= 'uabb-' . $settings->transparent_button_options . '-btn';
					}
				} else {
					$new_class = 'uabb-adc-normal-btn';
				}
				$atc_html         .= '<a class="button uabb-button ' . $new_class . '">';
					$atc_html     .= '<span class="uabb-atc-select-text">';
						$atc_html .= __( 'Please select the product', 'uabb' );
					$atc_html     .= '</span>';
				$atc_html         .= '</a>';

				echo $atc_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}

	/*
	 * Condition to verify Beaver Builder version.
	 * And accordingly render the required form settings file.
	 *
	 */

	if ( UABB_Compatibility::$version_bb_check ) {
		require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-add-to-cart/uabb-woo-add-to-cart-bb-2-2-compatibility.php';
	} else {
		require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-add-to-cart/uabb-woo-add-to-cart-bb-less-than-2-2-compatibility.php';
	}
}

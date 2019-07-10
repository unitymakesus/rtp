<?php
/**
 *  UABB Woo-Categories Module file
 *
 *  @package UABB Woo-Categories Module
 */

/**
 * Function that initializes UABB Woo-Categories Module
 *
 * @class UABBWooCategoriesModule
 */
class UABBWooCategoriesModule extends FLBuilderModule {

	/**
	 * Products Query
	 *
	 * @var query
	 */
	private $query = null;

	/**
	 * Constructor function that constructs default values for the UABBWooCategoriesModule module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Woo - Categories', 'uabb' ),
				'description'     => __( 'Display WooCommerce Categories.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$woo_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-woo-categories/',
				'partial_refresh' => true,
				'icon'            => 'uabb-woo-categories.svg',
			)
		);

		$this->add_css( 'font-awesome-5' );
		$this->add_js( 'imagesloaded-uabb', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/imagesloaded.min.js', array( 'jquery' ), '', true );
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );
	}

	/**
	 * Function that renders icons for the Woo Categories
	 *
	 * @param object $icon get an object for the icon.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
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

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Categories typography settings.
			if ( ! isset( $settings->category_typo ) || ! is_array( $settings->category_typo ) ) {

				$settings->category_typo            = array();
				$settings->category_typo_medium     = array();
				$settings->category_typo_responsive = array();
			}
			if ( isset( $settings->content_font ) ) {

				if ( isset( $settings->content_font['family'] ) ) {

					$settings->category_typo['font_family'] = $settings->content_font['family'];
					unset( $settings->content_font['family'] );
				}
				if ( isset( $settings->content_font['weight'] ) ) {

					if ( 'regular' == $settings->content_font['weight'] ) {
						$settings->category_typo['font_weight'] = 'normal';
					} else {
						$settings->category_typo['font_weight'] = $settings->content_font['weight'];
					}
					unset( $settings->content_font['weight'] );
				}
			}
			if ( isset( $settings->content_font_size ) ) {

				$settings->category_typo['font_size'] = array(
					'length' => $settings->content_font_size,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size );
			}
			if ( isset( $settings->content_font_size_medium ) ) {
				$settings->category_typo_medium['font_size'] = array(
					'length' => $settings->content_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size_medium );
			}
			if ( isset( $settings->content_font_size_responsive ) ) {

				$settings->category_typo_responsive['font_size'] = array(
					'length' => $settings->content_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->content_font_size_responsive );
			}
			if ( isset( $settings->content_line_height ) ) {

				$settings->category_typo['line_height'] = array(
					'length' => $settings->content_line_height,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height );
			}
			if ( isset( $settings->content_line_height_medium ) ) {
				$settings->category_typo_medium['line_height'] = array(
					'length' => $settings->content_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height_medium );
			}
			if ( isset( $settings->content_line_height_responsive ) ) {
				$settings->category_typo_responsive['line_height'] = array(
					'length' => $settings->content_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->content_line_height_responsive );
			}
			if ( isset( $settings->content_transform ) ) {

				$settings->category_typo['text_transform'] = $settings->content_transform;
				unset( $settings->content_transform );
			}
			if ( isset( $settings->content_letter_spacing ) ) {

				$settings->category_typo['letter_spacing'] = array(
					'length' => $settings->content_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->content_letter_spacing );
			}

			// Description typography settings.
			if ( ! isset( $settings->description_typo ) || ! is_array( $settings->description_typo ) ) {

				$settings->description_typo            = array();
				$settings->description_typo_medium     = array();
				$settings->description_typo_responsive = array();
			}
			if ( isset( $settings->desc_font ) ) {

				if ( isset( $settings->desc_font['family'] ) ) {

					$settings->description_typo['font_family'] = $settings->desc_font['family'];
					unset( $settings->desc_font['family'] );
				}
				if ( isset( $settings->desc_font['weight'] ) ) {

					if ( 'regular' == $settings->desc_font['weight'] ) {
						$settings->description_typo['font_weight'] = 'normal';
					} else {
						$settings->description_typo['font_weight'] = $settings->desc_font['weight'];
					}
					unset( $settings->desc_font['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size ) ) {

				$settings->description_typo['font_size'] = array(
					'length' => $settings->desc_font_size,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size );
			}
			if ( isset( $settings->desc_font_size_medium ) ) {
				$settings->description_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_medium );
			}
			if ( isset( $settings->desc_font_size_responsive ) ) {
				$settings->description_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_responsive );
			}
			if ( isset( $settings->desc_line_height ) ) {

				$settings->description_typo['line_height'] = array(
					'length' => $settings->desc_line_height,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height );
			}
			if ( isset( $settings->desc_line_height_medium ) ) {
				$settings->description_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_medium );
			}
			if ( isset( $settings->desc_line_height_responsive ) ) {
				$settings->description_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {
				$settings->description_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );
			}
			if ( isset( $settings->desc_letter_spacing ) ) {

				$settings->description_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}
		}

		return $settings;
	}

	/**
	 * Function to get inner classes for woo-categories
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

			$classes[] = 'uabb-woo-cat__column-' . $settings->grid_columns_new;
			$classes[] = 'uabb-woo-cat__column-tablet-' . $settings->grid_columns_new_medium;
			$classes[] = 'uabb-woo-cat__column-mobile-' . $settings->grid_columns_new_responsive;
		} elseif ( 'carousel' === $settings->layout ) {
			$classes[] = 'uabb-woo-cat__column-' . $settings->slider_columns_new;
			$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_position;
			$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_style;

			if ( 'yes' === $settings->enable_dots ) {
				$classes[] = 'uabb-slick-dotted';
			}
		}

		return implode( ' ', $classes );
	}

	/**
	 * List all product categories.
	 *
	 * @since 1.10.0
	 * @method query_product_categories
	 */
	public function query_product_categories() {

		if ( ! isset( $this->settings->filter_rule ) ) {
			$this->settings->filter_rule = 'all';
		}

		if ( ! isset( $this->settings->display_empty_cat ) ) {
			$this->settings->display_empty_cat = 'no';
		}

		if ( ! isset( $this->settings->display_cat_desc ) ) {
			$this->settings->display_cat_desc = 'no';
		}

		if ( ! isset( $this->settings->order_by ) ) {
			$this->settings->order_by = 'name';
		}

		if ( ! isset( $this->settings->order ) ) {
			$this->settings->order = 'DESC';
		}

		$settings    = $this->settings;
		$include_ids = array();
		$exclude_ids = array();

		$atts = array(
			'limit'   => '8',
			'columns' => '4',
			'parent'  => '',
		);

		if ( 'grid' === $settings->layout ) {

			$atts['limit']   = ( $settings->grid_categories ) ? $settings->grid_categories : '-1';
			$atts['columns'] = ( $settings->grid_columns_new ) ? $settings->grid_columns_new : '4';
		} elseif ( 'carousel' === $settings->layout ) {
			$atts['limit']   = ( $settings->slider_categories ) ? $settings->slider_categories : '-1';
			$atts['columns'] = ( $settings->slider_columns_new ) ? $settings->slider_columns_new : '4';
		}

		if ( 'top' === $settings->filter_rule ) {
			$atts['parent'] = 0;
		} elseif ( 'include' === $settings->filter_rule && '' !== $settings->tax_product_product_cat ) {
			$cat_ids     = explode( ',', $settings->tax_product_product_cat );
			$include_ids = array_filter( array_map( 'trim', $cat_ids ) );
		} elseif ( 'exclude' === $settings->filter_rule && '' !== $settings->tax_product_product_cat ) {
			$cat_ids     = explode( ',', $settings->tax_product_product_cat );
			$exclude_ids = array_filter( array_map( 'trim', $cat_ids ) );
		}

		$hide_empty = ( 'yes' === $settings->display_empty_cat ) ? 0 : 1;

		// Get terms and workaround WP bug with parents/pad counts.
		$args = array(
			'orderby'    => ( $settings->order_by ) ? $settings->order_by : 'name',
			'order'      => ( $settings->order ) ? $settings->order : 'ASC',
			'hide_empty' => $hide_empty,
			'pad_counts' => true,
			'child_of'   => $atts['parent'],
			'include'    => $include_ids,
			'exclude'    => $exclude_ids,
		);

		$product_categories = get_terms( 'product_cat', $args );

		if ( '' !== $atts['parent'] ) {
			$product_categories = wp_list_filter(
				$product_categories, array(
					'parent' => $atts['parent'],
				)
			);
		}

		if ( $hide_empty ) {
			foreach ( $product_categories as $key => $category ) {
				if ( 0 === $category->count ) {
					unset( $product_categories[ $key ] );
				}
			}
		}

		$atts['limit'] = intval( $atts['limit'] );

		if ( $atts['limit'] > 0 ) {
			$product_categories = array_slice( $product_categories, 0, $atts['limit'] );
		}

		$columns = absint( $atts['columns'] );

		wc_set_loop_prop( 'columns', $columns );

		/* Category Link */
		remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
		add_action( 'woocommerce_before_subcategory', array( $this, 'template_loop_category_link_open' ), 10 );

		/* Category Wrapper */
		add_action( 'woocommerce_before_subcategory', array( $this, 'category_wrap_start' ), 15 );
		add_action( 'woocommerce_after_subcategory', array( $this, 'category_wrap_end' ), 8 );

		if ( 'yes' === $settings->display_cat_desc ) {
			add_action( 'woocommerce_after_subcategory', array( $this, 'category_description' ), 8 );
		}

		/* Category Title */
		remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
		add_action( 'woocommerce_shop_loop_subcategory_title', array( $this, 'template_loop_category_title' ), 10 );

		ob_start();

		if ( $product_categories ) {
			woocommerce_product_loop_start();

			foreach ( $product_categories as $category ) {

				include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/templates/content-product-cat.php';
			}

			woocommerce_product_loop_end();
		}

		woocommerce_reset_loop();

		$inner_content = ob_get_clean();

		/* Category Link */
		add_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
		remove_action( 'woocommerce_before_subcategory', array( $this, 'template_loop_category_link_open' ), 10 );

		/* Category Wrapper */
		remove_action( 'woocommerce_before_subcategory', array( $this, 'category_wrap_start' ), 15 );
		remove_action( 'woocommerce_after_subcategory', array( $this, 'category_wrap_end' ), 8 );

		if ( 'yes' === $settings->display_cat_desc ) {
			remove_action( 'woocommerce_after_subcategory', array( $this, 'category_description' ), 8 );
		}

		/* Category Title */
		remove_action( 'woocommerce_shop_loop_subcategory_title', array( $this, 'template_loop_category_title' ), 10 );
		add_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );

		echo $inner_content;
	}

	/**
	 * Wrapper Start.
	 *
	 * @param object $category Category object.
	 */
	function template_loop_category_link_open( $category ) {
		$link = apply_filters( 'uabb_woo_category_link', esc_url( get_term_link( $category, 'product_cat' ) ) );

		echo '<a href="' . $link . '">';
	}

	/**
	 * Wrapper Start.
	 *
	 * @param object $category Category object.
	 */
	public function category_wrap_start( $category ) {
		echo '<div class="uabb-product-cat-inner">';
	}


	/**
	 * Wrapper End.
	 *
	 * @param object $category Category object.
	 */
	public function category_wrap_end( $category ) {
		echo '</div>';
	}

	/**
	 * Category Description.
	 *
	 * @param object $category Category object.
	 */
	public function category_description( $category ) {

		if ( $category && ! empty( $category->description ) ) {

			echo '<div class="uabb-product-cat-desc">';
				echo '<div class="uabb-term-description">' . wc_format_content( $category->description ) . '</div>'; // WPCS: XSS ok.
			echo '</div>';
		}
	}

	/**
	 * Show the subcategory title in the product loop.
	 *
	 * @param object $category Category object.
	 */
	public function template_loop_category_title( $category ) {
		$output          = '<div class="uabb-category__title-wrap">';
			$output     .= '<h2 class="woocommerce-loop-category__title">';
				$output .= esc_html( $category->name );
			$output     .= '</h2>';

		if ( $category->count > 0 ) {
				$output .= sprintf( // WPCS: XSS OK.
					/* translators: 1: number of products */
					_nx( '<mark class="uabb-count">%1$s Product</mark>', '<mark class="uabb-count">%1$s Products</mark>', $category->count, 'product categories', 'uabb' ),
					number_format_i18n( $category->count )
				);
		}
		$output .= '</div>';

		echo $output;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/uabb-woo-categories-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-categories/uabb-woo-categories-bb-less-than-2-2-compatibility.php';
}

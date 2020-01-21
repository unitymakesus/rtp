<?php
/**
 *  UABB Woo-Products file
 *
 *  @package UABB Woo-Products Module
 */

/**
 * Function that initializes UABB Woo-Products Module
 *
 * @class UABBWooProductsModule
 */
class UABBWooProductsModule extends FLBuilderModule {

	/**
	 * Products Query
	 *
	 * @var query
	 */
	private $query = null;

	/**
	 * Constructor function that constructs default values for the UABBWooProductsModule module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Woo - Products', 'uabb' ),
				'description'     => __( 'Display WooCommerce Products.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$woo_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-woo-products/',
				'partial_refresh' => true,
				'icon'            => 'uabb-woo-products.svg',
			)
		);

		$this->add_css( 'font-awesome-5' );
		$this->add_js( 'imagesloaded-uabb', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/imagesloaded.min.js', array( 'jquery' ), '', true );
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );

		add_filter( 'fl_builder_loop_query_args', array( $this, 'woo_filter_args' ) );

		// quick view ajax.
		add_action( 'wp_ajax_uabb_woo_quick_view', array( $this, 'load_quick_view_product' ) );
		add_action( 'wp_ajax_nopriv_uabb_woo_quick_view', array( $this, 'load_quick_view_product' ) );

		/* Add tO cart */
		add_action( 'wp_ajax_uabb_add_cart_single_product', array( $this, 'add_cart_single_product_ajax' ) );
		add_action( 'wp_ajax_nopriv_uabb_add_cart_single_product', array( $this, 'add_cart_single_product_ajax' ) );

		add_action( 'wp_ajax_uabb_get_products', array( $this, 'uabb_get_products' ) );
		add_action( 'wp_ajax_nopriv_uabb_get_products', array( $this, 'uabb_get_products' ) );
	}

	/**
	 * Function that renders icons for the Woo - Products
	 *
	 * @param object $icon get an object for the icon.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	/**
	 * Get Woo Data via AJAX call.
	 *
	 * @since 1.5.0
	 * @access public
	 */
	public function uabb_get_products() {

		$data = array(
			'message'    => __( 'Saved', 'uabb' ),
			'html'       => '',
			'pagination' => '',
		);

		ob_start();

		$this->settings = (object) $_POST['settings'];

		add_filter( 'fl_builder_loop_query_args', array( $this, 'loop_query_args' ), 10, 1 );

		$this->render_query();
		$this->render_loop_args();
		$this->render_woo_loop_start();
			$this->render_woo_loop();
		$this->render_woo_loop_end();

		$data['html'] = ob_get_clean();

		ob_start();
		$this->render_pagination_structure();
		$data['pagination'] = ob_get_clean();

		wp_send_json_success( $data );
	}

	/**
	 * Filter the args.
	 *
	 * @since 0.0.1
	 * @access public
	 * @param array $args page numbers.
	 */
	public function loop_query_args( $args ) {

		if ( isset( $_POST['page_number'] ) && '' != $_POST['page_number'] ) {
			$args['paged']  = $_POST['page_number'];
			$args['offset'] = ( ( $_POST['page_number'] - 1 ) * $this->settings->posts_per_page );
		}
		return $args;
	}

	/**
	 * Filter the args.
	 *
	 * @since 0.0.1
	 * @access protected
	 * @param array $args fetches the array.
	 */
	public function woo_filter_args( $args ) {

		if ( 'uabb-woo-products' === $args['settings']->type ) {

			if ( isset( $args['settings']->filter_by ) ) {
				if ( 'sale' === $args['settings']->filter_by ) {

					$sale_ids = wc_get_product_ids_on_sale();

					if ( isset( $args['post__in'] ) ) {

						$post_in  = $args['post__in'];
						$sale_ids = array_intersect( $post_in, $sale_ids );
					}

					$args['post__in'] = $sale_ids;
				} elseif ( 'featured' === $args['settings']->filter_by ) {

					$product_visibility_term_ids = wc_get_product_visibility_term_ids();

					$args['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['featured'],
					);
				}
			}
		}

		return $args;
	}

	/**
	 * Getting inner markup classes.
	 *
	 * @since 0.0.1
	 * @access public
	 */
	public function get_inner_classes() {

		$settings = $this->settings;
		$classes  = array();

		$classes = array(
			'uabb-woo--align-' . $settings->content_alignment,
			'uabb-woo--align-mobile-' . $settings->mobile_align,
			'uabb-woo-product__hover-' . $settings->image_hover_style,
			'uabb-woo-product__hover-' . $settings->image_hover_style,
			'uabb-sale-flash-' . $settings->sale_flash_style,
			'uabb-featured-flash-' . $settings->featured_flash_style,
		);

		if ( 'grid' === $settings->layout ) {
			$classes[] = 'columns-' . $settings->grid_columns_new;
			$classes[] = 'uabb-woo-product__column-' . $settings->grid_columns_new;
			$classes[] = 'uabb-woo-product__column-tablet-' . $settings->grid_columns_new_medium;
			$classes[] = 'uabb-woo-product__column-mobile-' . $settings->grid_columns_new_responsive;
		} elseif ( 'carousel' === $settings->layout ) {

			$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_position;
			$classes[] = 'uabb-woo-slider-arrow-' . $settings->arrow_style;

			if ( 'yes' === $settings->enable_dots ) {
				$classes[] = 'uabb-slick-dotted';
			}
		}

		return implode( ' ', $classes );
	}
	/**
	 * Register Get Query.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	public function get_query() {
		return $this->query;
	}

	/**
	 * Get query products based on settings.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.8.0
	 * @access public
	 */
	public function render_query() {

		global $post;

		$this->settings->post_type = 'product';

		$settings = $this->settings;

		if ( ! isset( $settings->order_by ) ) {
			$this->settings->order_by = 'date';
		}

		if ( ! isset( $settings->order ) ) {
			$this->settings->order = 'DESC';
		}

		$query_args = array(
			'post_type'      => 'product',
			'posts_per_page' => -1,
			'paged'          => 1,
			'post__not_in'   => array(),
		);

		if ( isset( $_POST['page_number'] ) && '' != $_POST['page_number'] ) {
			$query_args['paged'] = $_POST['page_number'];
		}

		if ( 'grid' === $settings->layout ) {

			if ( $settings->grid_products > 0 ) {

				$query_args['posts_per_page'] = $settings->grid_products;

				$settings->posts_per_page = $settings->grid_products;
			}
		} else {

			if ( $settings->slider_products > 0 ) {
				$query_args['posts_per_page'] = $settings->slider_products;
				$settings->posts_per_page     = $settings->slider_products;
			}
		}

		$this->query = FLBuilderLoop::query( $settings );

		// Default ordering args.
		$ordering_args = WC()->query->get_catalog_ordering_args( $settings->order_by, $settings->order );

		$query_args['orderby'] = $ordering_args['orderby'];
		$query_args['order']   = $ordering_args['order'];

		// Order by meta value arg.
		if ( strstr( $query_args['orderby'], 'meta_value' ) ) {

			if ( isset( $settings->order_by_meta_key ) ) {
				$query_args['meta_key'] = $settings->order_by_meta_key;
			}
		}
	}

	/**
	 * Render loop required arguments.
	 *
	 * @since 1.1.0
	 */
	public function render_loop_args() {

		global $woocommerce_loop;

		$query = $this->get_query();

		$settings = $this->settings;

		if ( 'grid' === $settings->layout ) {

			$woocommerce_loop['columns'] = (int) $settings->grid_columns_new;

			// Pagination.
			if ( 0 < $settings->grid_products && '' !== $settings->pagination_type ) {
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				if ( isset( $_POST['page_number'] ) && '' != $_POST['page_number'] ) {
					$paged = $_POST['page_number'];
				}
				$woocommerce_loop['paged']        = $paged;
				$woocommerce_loop['total']        = $query->found_posts;
				$woocommerce_loop['post_count']   = $query->post_count;
				$woocommerce_loop['per_page']     = $settings->grid_products;
				$woocommerce_loop['total_pages']  = ceil( $query->found_posts / $settings->grid_products );
				$woocommerce_loop['current_page'] = $paged;
			}
		} elseif ( 'carousel' === $settings->layout ) {

			$woocommerce_loop['columns'] = (int) $settings->slider_columns_new;
		}
	}

	/**
	 * Render woo default template.
	 *
	 * @since 1.1.0
	 */
	public function render_woo_loop_template() {

		$settings = $this->settings;

		if ( 'classic' === $settings->skin ) {
			include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/content-product-default.php';

		} elseif ( 'modern' === $settings->skin ) {
			include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/content-product-modern.php';
		}
	}

	/**
	 * Render woo loop start.
	 *
	 * @since 1.1.0
	 */
	public function render_woo_loop_start() {
		woocommerce_product_loop_start();
	}

	/**
	 * Render woo loop.
	 *
	 * @since 1.1.0
	 */
	public function render_woo_loop() {

		$query = $this->get_query();

		while ( $query->have_posts() ) :
			$query->the_post();
			$this->render_woo_loop_template();
		endwhile;
	}

	/**
	 * Render woo loop end.
	 *
	 * @since 1.1.0
	 */
	public function render_woo_loop_end() {
		woocommerce_product_loop_end();
	}

	/**
	 * Render reset loop.
	 *
	 * @since 1.1.0
	 */
	public function render_reset_loop() {

		woocommerce_reset_loop();

		wp_reset_postdata();
	}

	/**
	 * Short Description.
	 *
	 * @since 0.0.1
	 */
	public function woo_shop_short_desc() {
		if ( has_excerpt() ) {
			echo '<div class="uabb-woo-products-description">';
				echo the_excerpt();
			echo '</div>';
		}
	}

	/**
	 * Parent Category.
	 *
	 * @since 1.1.0
	 */
	public function woo_shop_parent_category() {
		if ( apply_filters( 'uabb_woo_shop_parent_category', true ) ) : ?>
			<span class="uabb-woo-product-category">
				<?php
				global $product;
				$product_categories = function_exists( 'wc_get_product_category_list' ) ? wc_get_product_category_list( get_the_ID(), ',', '', '' ) : $product->get_categories( ',', '', '' );

				$product_categories = strip_tags( $product_categories );
				if ( $product_categories ) {
					list( $parent_cat ) = explode( ',', $product_categories );
					echo esc_html( $parent_cat );
				}
				?>
			</span>
			<?php
		endif;
	}

	/**
	 * Product Flip Image.
	 *
	 * @since 0.0.1
	 */
	public function woo_shop_product_flip_image() {

		global $product;

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids ) {

			$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );

			echo apply_filters( 'uabb_woocommerce_product_flip_image', wp_get_attachment_image( reset( $attachment_ids ), $image_size, false, array( 'class' => 'uabb-show-on-hover' ) ) );
		}
	}

	/**
	 * Pagination Structure.
	 *
	 * @since 1.1.0
	 */
	public function render_pagination_structure() {

		$settings = $this->settings;

		if ( '' !== $settings->pagination_type ) {

			$query = $this->get_query();

			add_filter( 'wc_get_template', array( $this, 'woo_pagination_template' ), 10, 5 );
			add_filter( 'uabb_woocommerce_pagination_args', array( $this, 'woo_pagination_options' ) );

			$total_pages         = $query->max_num_pages;
			$permalink_structure = get_option( 'permalink_structure' );
			$paged               = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';

			if ( isset( $_POST['page_number'] ) && '' != $_POST['page_number'] ) {
				$paged = $_POST['page_number'];
			}
			$base = html_entity_decode( get_pagenum_link() );

			if ( $total_pages > 1 ) {

				if ( ! $current_page = $paged ) { // @codingStandardsIgnoreLine.
					$current_page = 1;
				}

				// Refer this function if any issue woocommerce_pagination();.
				$base   = FLBuilderLoop::build_base_url( $permalink_structure, $base );
				$format = FLBuilderLoop::paged_format( $permalink_structure, $base );

				$args = array(
					'base'    => $base . '%_%',
					'format'  => $format,
					'current' => $current_page,
					'total'   => $total_pages,
				);

				wc_get_template( 'loop/pagination.php', $args );
			}

			remove_filter( 'uabb_woocommerce_pagination_args', array( $this, 'woo_pagination_options' ) );
			remove_filter( 'wc_get_template', array( $this, 'woo_pagination_template' ), 10, 5 );
		}
	}

	/**
	 * Change pagination arguments based on settings.
	 *
	 * @since 0.0.1
	 * @access protected
	 * @param string $located location.
	 * @param string $template_name template name.
	 * @param array  $args arguments.
	 * @param string $template_path path.
	 * @param string $default_path default path.
	 * @return string template location
	 */
	public function woo_pagination_template( $located, $template_name, $args, $template_path, $default_path ) {

		if ( 'loop/pagination.php' === $template_name ) {
			$located = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/loop/pagination.php';
		}

		return $located;
	}

	/**
	 * Change pagination arguments based on settings.
	 *
	 * @since 0.0.1
	 * @access protected
	 * @param array $args pagination args.
	 * @return array
	 */
	public function woo_pagination_options( $args ) {

		$settings = $this->settings;

		$pagination_arrow = false;

		if ( 'numbers_arrow' === $settings->pagination_type ) {
			$pagination_arrow = true;
		}

		$args['prev_next'] = $pagination_arrow;

		return $args;
	}

	/**
	 * Quick View.
	 *
	 * @since 0.0.1
	 * @access public
	 */
	public function quick_view_modal() {

		$settings        = $this->settings;
		$quick_view_type = $settings->quick_view;

		if ( '' !== $quick_view_type ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
			wp_enqueue_script( 'flexslider' );

			$widget_id = $this->node;

			include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/quick-view-modal.php';
		}
	}

	/**
	 * Load Quick View Product.
	 *
	 * @since 0.0.1
	 * @access public
	 */
	public function load_quick_view_product() {

		if ( ! isset( $_REQUEST['product_id'] ) ) {
			die();
		}

		$this->quick_view_content_actions();

		$product_id = intval( $_REQUEST['product_id'] );

		// set the main wp query for the product.
		wp( 'p=' . $product_id . '&post_type=product' );

		ob_start();

		// load content template.
		include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/quick-view-product.php';

		echo ob_get_clean();

		die();
	}

	/**
	 * Quick view actions
	 */
	public function quick_view_content_actions() {

		add_action( 'uabb_woo_quick_view_product_image', 'woocommerce_show_product_sale_flash', 10 );
		// Image.
		add_action( 'uabb_woo_quick_view_product_image', array( $this, 'quick_view_product_images_markup' ), 20 );

		// Summary.
		add_action( 'uabb_woo_quick_view_product_summary', array( $this, 'quick_view_product_content_structure' ), 10 );
	}

	/**
	 * Quick view product images markup.
	 */
	public function quick_view_product_images_markup() {

		include BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/templates/quick-view-product-image.php';
	}

	/**
	 * Quick view product content structure.
	 */
	public function quick_view_product_content_structure() {

		global $product;

		$post_id = $product->get_id();

		$single_structure = apply_filters(
			'uabb_quick_view_product_structure',
			array(
				'title',
				'ratings',
				'price',
				'short_desc',
				'meta',
				'add_cart',
			)
		);

		if ( is_array( $single_structure ) && ! empty( $single_structure ) ) {

			foreach ( $single_structure as $value ) {

				switch ( $value ) {
					case 'title':
						/**
						 * Add Product Title on single product page for all products.
						 */
						do_action( 'uabb_quick_view_title_before', $post_id );
						woocommerce_template_single_title();
						do_action( 'uabb_quick_view_title_after', $post_id );
						break;
					case 'price':
						/**
						 * Add Product Price on single product page for all products.
						 */
						do_action( 'uabb_quick_view_price_before', $post_id );
						woocommerce_template_single_price();
						do_action( 'uabb_quick_view_price_after', $post_id );
						break;
					case 'ratings':
						/**
						 * Add rating on single product page for all products.
						 */
						do_action( 'uabb_quick_view_rating_before', $post_id );
						woocommerce_template_single_rating();
						do_action( 'uabb_quick_view_rating_after', $post_id );
						break;
					case 'short_desc':
						do_action( 'uabb_quick_view_short_description_before', $post_id );
						woocommerce_template_single_excerpt();
						do_action( 'uabb_quick_view_short_description_after', $post_id );
						break;
					case 'add_cart':
						do_action( 'uabb_quick_view_add_to_cart_before', $post_id );
						woocommerce_template_single_add_to_cart();
						do_action( 'uabb_quick_view_add_to_cart_after', $post_id );
						break;
					case 'meta':
						do_action( 'uabb_quick_view_category_before', $post_id );
						woocommerce_template_single_meta();
						do_action( 'uabb_quick_view_category_after', $post_id );
						break;
					default:
						break;
				}
			}
		}

	}

	/**
	 * Single Product add to cart ajax request
	 *
	 * @since 1.1.0
	 *
	 * @return void.
	 */
	function add_cart_single_product_ajax() {
		$product_id   = isset( $_POST['product_id'] ) ? sanitize_text_field( $_POST['product_id'] ) : 0;
		$variation_id = isset( $_POST['variation_id'] ) ? sanitize_text_field( $_POST['variation_id'] ) : 0;
		$quantity     = isset( $_POST['quantity'] ) ? sanitize_text_field( $_POST['quantity'] ) : 0;

		if ( $variation_id ) {
			WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
		} else {
			WC()->cart->add_to_cart( $product_id, $quantity );
		}
		die();
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

			// compatibility for Category.
			if ( ! isset( $settings->woo_cat_font_typo ) || ! is_array( $settings->woo_cat_font_typo ) ) {

				$settings->woo_cat_font_typo            = array();
				$settings->woo_cat_font_typo_medium     = array();
				$settings->woo_cat_font_typo_responsive = array();
			}
			if ( isset( $settings->cat_font ) ) {

				if ( isset( $settings->cat_font['family'] ) ) {

					$settings->woo_cat_font_typo['font_family'] = $settings->cat_font['family'];
					unset( $settings->cat_font['family'] );
				}
				if ( isset( $settings->cat_font['weight'] ) ) {

					if ( 'regular' == $settings->cat_font['weight'] ) {
						$settings->woo_cat_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_cat_font_typo['font_weight'] = $settings->cat_font['weight'];
						unset( $settings->cat_font['weight'] );
					}
				}
			}
			if ( isset( $settings->cat_font_size ) ) {

				$settings->woo_cat_font_typo['font_size'] = array(
					'length' => $settings->cat_font_size,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size );
			}
			if ( isset( $settings->cat_font_size_medium ) ) {
				$settings->woo_cat_font_typo_medium['font_size'] = array(
					'length' => $settings->cat_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size_medium );
			}
			if ( isset( $settings->cat_font_size_responsive ) ) {

				$settings->woo_cat_font_typo_responsive['font_size'] = array(
					'length' => $settings->cat_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->cat_font_size_responsive );
			}
			if ( isset( $settings->cat_line_height ) ) {

				$settings->woo_cat_font_typo['line_height'] = array(
					'length' => $settings->cat_line_height,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height );
			}
			if ( isset( $settings->cat_line_height_medium ) ) {
				$settings->woo_cat_font_typo_medium['line_height'] = array(
					'length' => $settings->cat_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height_medium );
			}
			if ( isset( $settings->cat_line_height_responsive ) ) {
				$settings->woo_cat_font_typo_responsive['line_height'] = array(
					'length' => $settings->cat_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->cat_line_height_responsive );
			}
			if ( isset( $settings->cat_transform ) ) {

				$settings->woo_cat_font_typo['text_transform'] = $settings->cat_transform;
				unset( $settings->cat_transform );
			}
			if ( isset( $settings->cat_letter_spacing ) ) {

				$settings->woo_cat_font_typo['letter_spacing'] = array(
					'length' => $settings->cat_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->cat_letter_spacing );
			}

			// compatibility for Title.
			if ( ! isset( $settings->woo_title_font_typo ) || ! is_array( $settings->woo_title_font_typo ) ) {

				$settings->woo_title_font_typo            = array();
				$settings->woo_title_font_typo_medium     = array();
				$settings->woo_title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font ) ) {

				if ( isset( $settings->title_font['family'] ) ) {

					$settings->woo_title_font_typo['font_family'] = $settings->title_font['family'];
					unset( $settings->title_font['family'] );
				}
				if ( isset( $settings->title_font['weight'] ) ) {

					if ( 'regular' == $settings->title_font['weight'] ) {
						$settings->woo_title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_title_font_typo['font_weight'] = $settings->title_font['weight'];
					}
					unset( $settings->title_font['weight'] );
				}
			}
			if ( isset( $settings->title_font_size ) ) {

				$settings->woo_title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size );
			}
			if ( isset( $settings->title_font_size_medium ) ) {
				$settings->woo_title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_medium );
			}
			if ( isset( $settings->title_font_size_responsive ) ) {

				$settings->woo_title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_responsive );
			}
			if ( isset( $settings->title_line_height ) ) {

				$settings->woo_title_font_typo['line_height'] = array(
					'length' => $settings->title_line_height,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height );
			}
			if ( isset( $settings->title_line_height_medium ) ) {
				$settings->woo_title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_medium );
			}
			if ( isset( $settings->title_line_height_responsive ) ) {
				$settings->woo_title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_responsive );
			}
			if ( isset( $settings->title_transform ) ) {

				$settings->woo_title_font_typo['text_transform'] = $settings->title_transform;
				unset( $settings->title_transform );
			}
			if ( isset( $settings->title_letter_spacing ) ) {

				$settings->woo_title_font_typo['letter_spacing'] = array(
					'length' => $settings->title_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->title_letter_spacing );
			}

			// compatibility for Price.
			if ( ! isset( $settings->woo_price_font_typo ) || ! is_array( $settings->woo_price_font_typo ) ) {

				$settings->woo_price_font_typo            = array();
				$settings->woo_price_font_typo_medium     = array();
				$settings->woo_price_font_typo_responsive = array();
			}
			if ( isset( $settings->price_font ) ) {

				if ( isset( $settings->price_font['family'] ) ) {

					$settings->woo_price_font_typo['font_family'] = $settings->price_font['family'];
					unset( $settings->price_font['family'] );
				}
				if ( isset( $settings->price_font['weight'] ) ) {

					if ( 'regular' == $settings->price_font['weight'] ) {
						$settings->woo_price_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_price_font_typo['font_weight'] = $settings->price_font['weight'];
					}
					unset( $settings->price_font['weight'] );
				}
			}
			if ( isset( $settings->price_font_size ) ) {

				$settings->woo_price_font_typo['font_size'] = array(
					'length' => $settings->price_font_size,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size );
			}
			if ( isset( $settings->price_font_size_medium ) ) {
				$settings->woo_price_font_typo_medium['font_size'] = array(
					'length' => $settings->price_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size_medium );
			}
			if ( isset( $settings->price_font_size_responsive ) ) {

				$settings->woo_price_font_typo_responsive['font_size'] = array(
					'length' => $settings->price_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size_responsive );
			}
			if ( isset( $settings->price_line_height ) ) {

				$settings->woo_price_font_typo['line_height'] = array(
					'length' => $settings->price_line_height,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height );
			}
			if ( isset( $settings->price_line_height_medium ) ) {
				$settings->woo_price_font_typo_medium['line_height'] = array(
					'length' => $settings->price_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height_medium );
			}
			if ( isset( $settings->price_line_height_responsive ) ) {
				$settings->woo_price_font_typo_responsive['line_height'] = array(
					'length' => $settings->price_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height_responsive );
			}
			if ( isset( $settings->price_transform ) ) {

				$settings->woo_price_font_typo['text_transform'] = $settings->price_transform;
				unset( $settings->price_transform );
			}
			if ( isset( $settings->price_letter_spacing ) ) {

				$settings->woo_price_font_typo['letter_spacing'] = array(
					'length' => $settings->price_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->price_letter_spacing );
			}

			// compatibility for Description.
			if ( ! isset( $settings->woo_desc_font_typo ) || ! is_array( $settings->woo_desc_font_typo ) ) {

				$settings->woo_desc_font_typo            = array();
				$settings->woo_desc_font_typo_medium     = array();
				$settings->woo_desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font ) ) {

				if ( isset( $settings->desc_font['family'] ) ) {

					$settings->woo_desc_font_typo['font_family'] = $settings->desc_font['family'];
					unset( $settings->desc_font['family'] );
				}
				if ( isset( $settings->desc_font['weight'] ) ) {

					if ( 'regular' == $settings->desc_font['weight'] ) {
						$settings->woo_desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_desc_font_typo['font_weight'] = $settings->desc_font['weight'];
					}
					unset( $settings->desc_font['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size ) ) {

				$settings->woo_desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size );
			}
			if ( isset( $settings->desc_font_size_medium ) ) {
				$settings->woo_desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_medium );
			}
			if ( isset( $settings->desc_font_size_responsive ) ) {

				$settings->woo_desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_responsive );
			}
			if ( isset( $settings->desc_line_height ) ) {

				$settings->woo_desc_font_typo['line_height'] = array(
					'length' => $settings->desc_line_height,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height );
			}
			if ( isset( $settings->desc_line_height_medium ) ) {
				$settings->woo_desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_medium );
			}
			if ( isset( $settings->desc_line_height_responsive ) ) {
				$settings->woo_desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {

				$settings->woo_desc_font_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );
			}
			if ( isset( $settings->desc_letter_spacing ) ) {

				$settings->woo_desc_font_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}

			// compatibility for Add Cart.
			if ( ! isset( $settings->woo_cart_font_typo ) || ! is_array( $settings->woo_cart_font_typo ) ) {

				$settings->woo_cart_font_typo            = array();
				$settings->woo_cart_font_typo_medium     = array();
				$settings->woo_cart_font_typo_responsive = array();
			}
			if ( isset( $settings->add_cart_font ) ) {

				if ( isset( $settings->add_cart_font['family'] ) ) {

					$settings->woo_cart_font_typo['font_family'] = $settings->add_cart_font['family'];
					unset( $settings->add_cart_font['family'] );
				}
				if ( isset( $settings->add_cart_font['weight'] ) ) {

					if ( 'regular' == $settings->add_cart_font['weight'] ) {
						$settings->woo_cart_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_cart_font_typo['font_weight'] = $settings->add_cart_font['weight'];
					}
					unset( $settings->add_cart_font['weight'] );
				}
			}
			if ( isset( $settings->add_cart_font_size ) ) {

				$settings->woo_cart_font_typo['font_size'] = array(
					'length' => $settings->add_cart_font_size,
					'unit'   => 'px',
				);
				unset( $settings->add_cart_font_size );
			}
			if ( isset( $settings->add_cart_font_size_medium ) ) {
				$settings->woo_cart_font_typo_medium['font_size'] = array(
					'length' => $settings->add_cart_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->add_cart_font_size_medium );
			}
			if ( isset( $settings->add_cart_font_size_responsive ) ) {

				$settings->woo_cart_font_typo_responsive['font_size'] = array(
					'length' => $settings->add_cart_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->add_cart_font_size_responsive );
			}
			if ( isset( $settings->add_cart_line_height ) ) {

				$settings->woo_cart_font_typo['line_height'] = array(
					'length' => $settings->add_cart_line_height,
					'unit'   => 'em',
				);
				unset( $settings->add_cart_line_height );
			}
			if ( isset( $settings->add_cart_line_height_medium ) ) {
				$settings->woo_cart_font_typo_medium['line_height'] = array(
					'length' => $settings->add_cart_line_height_medium,
					'unit'   => 'em',
				);
				unset( $settings->add_cart_line_height_medium );
			}
			if ( isset( $settings->add_cart_line_height_responsive ) ) {
				$settings->woo_cart_font_typo_responsive['line_height'] = array(
					'length' => $settings->add_cart_line_height_responsive,
					'unit'   => 'em',
				);
				unset( $settings->add_cart_line_height_responsive );
			}
			if ( isset( $settings->add_cart_transform ) ) {

				$settings->woo_cart_font_typo['text_transform'] = $settings->add_cart_transform;
				unset( $settings->add_cart_transform );
			}
			if ( isset( $settings->add_cart_letter_spacing ) ) {

				$settings->woo_cart_font_typo['letter_spacing'] = array(
					'length' => $settings->add_cart_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->add_cart_letter_spacing );
			}

			// compatibility for Sale.
			if ( ! isset( $settings->woo_sale_font_typo ) || ! is_array( $settings->woo_sale_font_typo ) ) {

				$settings->woo_sale_font_typo            = array();
				$settings->woo_sale_font_typo_medium     = array();
				$settings->woo_sale_font_typo_responsive = array();
			}
			if ( isset( $settings->sale_flash_font ) ) {

				if ( isset( $settings->sale_flash_font['family'] ) ) {

					$settings->woo_sale_font_typo['font_family'] = $settings->sale_flash_font['family'];
					unset( $settings->sale_flash_font['family'] );
				}
				if ( isset( $settings->sale_flash_font['weight'] ) ) {

					if ( 'regular' == $settings->sale_flash_font['weight'] ) {
						$settings->woo_sale_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_sale_font_typo['font_weight'] = $settings->sale_flash_font['weight'];
					}
					unset( $settings->sale_flash_font['weight'] );
				}
			}
			if ( isset( $settings->sale_flash_font_size ) ) {

				$settings->woo_sale_font_typo['font_size'] = array(
					'length' => $settings->sale_flash_font_size,
					'unit'   => 'px',
				);
				unset( $settings->sale_flash_font_size );
			}
			if ( isset( $settings->sale_flash_font_size_medium ) ) {
				$settings->woo_sale_font_typo_medium['font_size'] = array(
					'length' => $settings->sale_flash_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->sale_flash_font_size_medium );
			}
			if ( isset( $settings->sale_flash_font_size_responsive ) ) {

				$settings->woo_sale_font_typo_responsive['font_size'] = array(
					'length' => $settings->sale_flash_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->sale_flash_font_size_responsive );
			}
			if ( isset( $settings->sale_flash_transform ) ) {

				$settings->woo_sale_font_typo['text_transform'] = $settings->sale_flash_transform;
				unset( $settings->sale_flash_transform );
			}
			if ( isset( $settings->sale_flash_letter_spacing ) ) {

				$settings->woo_sale_font_typo['letter_spacing'] = array(
					'length' => $settings->sale_flash_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->sale_flash_letter_spacing );
			}

			// compatibility for Flash.
			if ( ! isset( $settings->woo_flash_font_typo ) || ! is_array( $settings->woo_flash_font_typo ) ) {

				$settings->woo_flash_font_typo            = array();
				$settings->woo_flash_font_typo_medium     = array();
				$settings->woo_flash_font_typo_responsive = array();
			}
			if ( isset( $settings->featured_flash_font ) ) {

				if ( isset( $settings->featured_flash_font['family'] ) ) {

					$settings->woo_flash_font_typo['font_family'] = $settings->featured_flash_font['family'];
					unset( $settings->featured_flash_font['family'] );
				}
				if ( isset( $settings->featured_flash_font['weight'] ) ) {

					if ( 'regular' == $settings->featured_flash_font['weight'] ) {
						$settings->woo_flash_font_typo['font_weight'] = 'normal';
					} else {
						$settings->woo_flash_font_typo['font_weight'] = $settings->featured_flash_font['weight'];
					}
					unset( $settings->featured_flash_font['weight'] );
				}
			}
			if ( isset( $settings->featured_flash_font_size ) ) {

				$settings->woo_flash_font_typo['font_size'] = array(
					'length' => $settings->featured_flash_font_size,
					'unit'   => 'px',
				);
				unset( $settings->featured_flash_font_size );
			}
			if ( isset( $settings->featured_flash_font_size_medium ) ) {
				$settings->woo_flash_font_typo_medium['font_size'] = array(
					'length' => $settings->featured_flash_font_size_medium,
					'unit'   => 'px',
				);
				unset( $settings->featured_flash_font_size_medium );
			}
			if ( isset( $settings->featured_flash_font_size_responsive ) ) {

				$settings->woo_flash_font_typo_responsive['font_size'] = array(
					'length' => $settings->featured_flash_font_size_responsive,
					'unit'   => 'px',
				);
				unset( $settings->featured_flash_font_size_responsive );
			}
			if ( isset( $settings->featured_flash_transform ) ) {

				$settings->woo_flash_font_typo['text_transform'] = $settings->featured_flash_transform;
				unset( $settings->featured_flash_transform );
			}
			if ( isset( $settings->featured_flash_letter_spacing ) ) {

				$settings->woo_flash_font_typo['letter_spacing'] = array(
					'length' => $settings->featured_flash_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->featured_flash_letter_spacing );
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/uabb-woo-products-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-woo-products/uabb-woo-products-bb-less-than-2-2-compatibility.php';
}

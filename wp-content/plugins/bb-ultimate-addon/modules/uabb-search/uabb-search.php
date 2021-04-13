<?php
/**
 * UABB Search module File.
 *
 * @package UABB Search module.
 */

/**
 * Function that initializes UABB Search Module
 *
 * @class UABBSearchModule
 */
class UABBSearchModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Search', 'uabb' ),
				'description'     => __( 'Add Search bar on your site.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$lead_generation ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-search/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-search/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'uabb-search.svg',
			)
		);
		add_action( 'wp_ajax_uabb_search_query', array( $this, 'search_query' ) );
		add_action( 'wp_ajax_nopriv_uabb_search_query', array( $this, 'search_query' ) );
		add_filter( 'fl_builder_loop_query_args', array( $this, 'loop_query_args' ) );
		$this->add_css( 'font-awesome-5' );
	}

	/**
	 * Function to get the icon for the offcanvas
	 *
	 * @since 1.19.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-search/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-search/icon/' . $icon );
		}
		return '';
	}

	/**
	 * Function that enqueues scripts
	 *
	 * @method enqueue_scripts
	 */
	public function enqueue_scripts() {
		if ( $this->settings && 'button' === $this->settings->display && 'fullscreen' === $this->settings->btn_action ) {
			$this->add_css( 'font-awesome-5' );
		}
	}

	/**
	 * Function that runs search query
	 *
	 * @method search_query
	 */
	public function search_query() {

		check_ajax_referer( 'uabb-search-nonce', 'security' );

		$post_id          = isset( $_POST['post_id'] ) ? $_POST['post_id'] : false;
		$node_id          = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$template_id      = isset( $_POST['template_id'] ) ? sanitize_text_field( $_POST['template_id'] ) : false;
		$template_node_id = isset( $_POST['template_node_id'] ) ? sanitize_text_field( $_POST['template_node_id'] ) : false;
		$keyword          = $_POST['keyword'];
		$args             = new stdClass();
		$query            = null;
		$html             = '';

		// Get the module settings.
		if ( $template_id ) {
			$post_id  = FLBuilderModel::get_node_template_post_id( $template_id );
			$data     = FLBuilderModel::get_layout_data( 'published', $post_id );
			$settings = $data[ $template_node_id ]->settings;
		} else {
			$module   = FLBuilderModel::get_module( $node_id );
			$settings = $module->settings;
		}

		$s = stripcslashes( $keyword );
		$s = trim( $s );
		$s = preg_replace( '/\s+/', ' ', $s );

		$args->keyword     = $s;
		$args->post_type   = 'any';
		$args->post_status = 'publish';
		$args->settings    = $settings;

		// Remove paged & offset parameters.
		add_filter( 'fl_builder_loop_query_args', array( $this, 'remove_pagination_args' ), 10 );

		$query = FLBuilderLoop::custom_query( $args );

		// Reset paged & offset parameters to prevent breaking other modules.
		remove_filter( 'fl_builder_loop_query_args', array( $this, 'remove_pagination_args' ), 10 );

		ob_start();
		include $this->dir . '/includes/results.php';
		$html = ob_get_clean();

		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		die();
	}

	/**
	 * Removes orderby parameter to use the WP core search terms ordering.
	 *
	 * @param array $query_args The query parameters.
	 */
	public function loop_query_args( $query_args ) {
		if ( isset( $query_args['s'] ) ) {
			unset( $query_args['orderby'] );
		}

		return $query_args;
	}

	/**
	 * Remove pagination parameters
	 *
	 * @param array $query_args     Generated query args to override.
	 * @return array                Updated query args
	 */
	public function remove_pagination_args( $query_args ) {
		$query_args['paged']  = 0;
		$query_args['offset'] = isset( $this->settings->offset ) ? $this->settings->offset : 0;
		return $query_args;
	}

	/**
	 * Render thumbnail for a post.
	 *
	 * Get's the post ID and renders the html markup for the featured image
	 * in the desired cropped size.
	 *
	 * @param  int $id    The post ID.
	 * @return void
	 */
	public function render_featured_image( $id = null ) {

		if ( isset( $this->settings->show_image ) && '1' === $this->settings->show_image ) {

			// get image source and data.
			$src        = $this->get_uncropped_url( $id );
			$photo_data = $this->get_img_data( $id );

			// set params.
			$photo_settings = array(
				'align'        => 'center',
				'link_type'    => 'url',
				'photo'        => $photo_data,
				'photo_src'    => $src,
				'photo_source' => 'library',
				'attributes'   => array(
					'data-no-lazy' => 1,
				),
			);

			// if link id is provided, set link_url param.
			if ( $id ) {
				$photo_settings['link_url'] = get_the_permalink( $id );
			}

			if ( has_post_thumbnail() ) {
				// Render image.
				FLBuilder::render_module_html( 'uabb-photo', $photo_settings );

			} elseif ( ! empty( $this->settings->image_fallback ) ) {
				// Render fallback.
				printf(
					'<a href="%s" rel="bookmark" title="%s">%s</a>',
					get_the_permalink(), //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					the_title_attribute( 'echo=0' ),
					wp_get_attachment_image( $this->settings->image_fallback, $this->settings->image_size )
				);
			}
		}

	}

	/**
	 * Full attachment image url.
	 *
	 * Gets a post ID and returns the url for the 'full' size of the attachment
	 * set as featured image.
	 *
	 * @param  int $id   The post ID.
	 * @return string    The featured image url for the 'full' size.
	 */
	protected function get_uncropped_url( $id ) {
		$thumb_id = get_post_thumbnail_id( $id );
		$size     = isset( $this->settings->image_size ) ? $this->settings->image_size : 'medium';
		$img      = wp_get_attachment_image_src( $thumb_id, $size );
		return is_array( $img ) ? $img[0] : '';
	}

	/**
	 * Get the featured image data.
	 *
	 * Gets a post ID and returns an array containing the featured image data.
	 *
	 * @param  int $id   The post ID.
	 * @return array    The image data.
	 */
	protected function get_img_data( $id ) {
		$thumb_id = get_post_thumbnail_id( $id );

		return FLBuilderPhoto::get_attachment_data( $thumb_id );
	}

	/**
	 * Function that gets form classes
	 *
	 * @method get_form_classes
	 */
	public function get_form_classes() {
		$classname = 'uabb-search-form';

		if ( ! empty( $this->settings->display ) ) {
			$classname .= ' uabb-search-form-' . $this->settings->display;
			if ( ! empty( $this->settings->layout ) ) {
				$classname .= ' uabb-search-form-' . $this->settings->layout;
			}
			if ( 'button' === $this->settings->display ) {
				$classname .= ' uabb-search-button-' . $this->settings->btn_action;
				$classname .= ' uabb-search-button-' . $this->settings->btn_align;

				if ( 'expand' === $this->settings->btn_action ) {
					$classname .= ' uabb-search-button-expand-' . $this->settings->expand_position;
				}
			}
		}

		if ( ! empty( $this->settings->width ) ) {
			$classname .= ' uabb-search-form-width-' . $this->settings->width;
		}

		if ( ! empty( $this->settings->form_align ) && 'full' !== $this->settings->width ) {
			$classname .= ' uabb-search-form-' . $this->settings->form_align;
		}

		return $classname;
	}

	/**
	 * Renders button.
	 *
	 * @param  int $module_id   The module ID.
	 */
	public function render_button( $module_id ) {
			$btn_settings = array(

				/* General Section */
				'text'                                     => $this->settings->btn_text,

				/* Link Section */
				'link'                                     => 'javascript:void(0)',
				'link_target'                              => '_self',

				/* Colors */
				'bg_color'                                 => $this->settings->btn_bg_color,
				'bg_hover_color'                           => $this->settings->btn_bg_hover_color,
				'text_color'                               => $this->settings->btn_text_color,
				'text_hover_color'                         => $this->settings->btn_text_hover_color,

				/* Icon */
				'icon'                                     => $this->settings->btn_icon,
				'icon_position'                            => $this->settings->btn_icon_position,

				/* Structure */
				'a_data'                                   => 'data-modal=' . $module_id . ' ',
				'button_padding_dimension_top'             => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
				'button_padding_dimension_left'            => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
				'button_padding_dimension_bottom'          => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
				'button_padding_dimension_right'           => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
				'button_padding_dimension_top_medium'      => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
				'button_padding_dimension_left_medium'     => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
				'button_padding_dimension_bottom_medium'   => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
				'button_padding_dimension_right_medium'    => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
				'button_padding_dimension_top_responsive'  => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
				'button_padding_dimension_left_responsive' => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
				'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
				'button_padding_dimension_right_responsive' => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
				'button_border'                            => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
				'border_hover_color'                       => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
			);
			FLBuilder::render_module_html( 'uabb-button', $btn_settings );
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'UABBSearchModule',
	array(
		'layout'     => array(
			'title'    => __( 'Layout', 'uabb' ),
			'sections' => array(
				'general'  => array(
					'title'  => '',
					'fields' => array(
						'display'         => array(
							'type'    => 'select',
							'label'   => __( 'Display Layout', 'uabb' ),
							'default' => 'both',
							'options' => array(
								'input'  => __( 'Input Field Only', 'uabb' ),
								'button' => __( 'Button Only', 'uabb' ),
								'both'   => __( 'Both Input Field & Button', 'uabb' ),
							),
							'toggle'  => array(
								'button' => array(
									'fields'   => array( 'btn_action', 'btn_text' ),
									'sections' => array( 'btn-style', 'btn-icon', 'btn_typography' ),
								),
								'both'   => array(
									'fields'   => array( 'layout', 'btn_text' ),
									'sections' => array( 'btn-style', 'btn-icon', 'btn_typography' ),
								),
							),
						),
						'layout'          => array(
							'type'    => 'select',
							'label'   => __( 'Layout', 'uabb' ),
							'default' => 'inline',
							'options' => array(
								'inline'  => __( 'Inline', 'uabb' ),
								'stacked' => __( 'Stacked', 'uabb' ),
							),
						),
						'btn_action'      => array(
							'type'    => 'select',
							'label'   => __( 'Button Click Action', 'uabb' ),
							'default' => 'expand',
							'options' => array(
								'expand'     => __( 'Expand', 'uabb' ),
								'fullscreen' => __( 'Full Screen', 'uabb' ),
							),
							'toggle'  => array(
								'expand'     => array(
									'fields' => array( 'expand_position' ),
								),
								'fullscreen' => array(
									'sections' => array( 'fullscreen_style' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),

						),
						'expand_position' => array(
							'type'    => 'select',
							'label'   => __( 'Expand Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Left', 'uabb' ),
								'right' => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'placeholder'     => array(
							'type'    => 'text',
							'label'   => 'Placeholder Text',
							'default' => __( 'Search...', 'uabb' ),
							'preview' => array(
								'type'      => 'attribute',
								'attribute' => 'placeholder',
								'selector'  => '.uabb-search-text',
							),
						),
						'btn_text'        => array(
							'type'    => 'text',
							'label'   => __( 'Button Text', 'uabb' ),
							'default' => __( 'Search', 'uabb' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-button-text',
							),
						),
						'enable_ajax'     => array(
							'type'    => 'select',
							'label'   => __( 'Enable AJAX Search', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
							'toggle'  => array(
								'yes' => array(
									'tabs' => array( 'results' ),
								),
							),
						),
					),
				),
				'btn-icon' => array( // Section.
					'title'     => __( 'Button Icons', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'btn_icon'          => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'btn_icon_position' => array(
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'before',
							'options' => array(
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'style'      => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'general_style'    => array(
					'title'  => 'Search Container',
					'fields' => array(
						'width'                 => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'full',
							'options' => array(
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'auto'   => array(
									'fields' => array( 'form_align' ),
								),
								'full'   => array(),
								'custom' => array(
									'fields' => array( 'form_align', 'custom_width' ),
								),
							),
						),
						'custom_width'          => array(
							'type'     => 'unit',
							'label'    => __( 'Custom Width', 'uabb' ),
							'default'  => '1100',
							'sanitize' => 'absint',
							'units'    => array( 'px', '%' ),
							'slider'   => array(
								'min'  => 0,
								'max'  => 1100,
								'step' => 10,
							),
							'help'     => __( 'The max width of the search form container.', 'uabb' ),
							'preview'  => array(
								'type'     => 'css',
								'selector' => '{node} .uabb-search-form-wrap',
								'property' => 'width',
							),
						),
						'form_height'           => array(
							'type'       => 'unit',
							'label'      => __( 'Height', 'uabb' ),
							'default'    => '0',
							'responsive' => true,
							'sanitize'   => 'absint',
							'units'      => array(
								'px',
								'vw',
								'vh',
							),
							'slider'     => array(
								'max'  => 600,
								'step' => 10,
							),
							'help'       => __( 'This setting is the minimum height of the form. Content will expand the height automatically.', 'uabb' ),
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '{node} .uabb-search-form-wrap',
								'property'  => 'min-height',
								'important' => true,
							),
						),
						'form_align'            => array(
							'type'       => 'align',
							'label'      => __( 'Alignment', 'uabb' ),
							'default'    => 'center',
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-search-form',
								'property' => 'text-align',
							),
						),
						'form_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '{node}.uabb-module-search .uabb-search-form-wrap',
								'property' => 'background-color',
							),
						),
						'form_bg_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'form_border'           => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '{node}.uabb-module-search .uabb-search-form-wrap',
								'important' => true,
							),
						),
						'form_border_hov_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'form_padding'          => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '10',
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '{node}.uabb-module-search .uabb-search-form-wrap',
								'property' => 'padding',
							),
						),
					),
				),
				'input_style'      => array(
					'title'     => 'Input Style',
					'collapsed' => true,
					'fields'    => array(
						'input_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '{node}.uabb-module-search .uabb-search-text, {node}.uabb-module-search .uabb-search-text::placeholder',
								'property' => 'color',
							),
						),
						'input_bg_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => 'input.uabb-search-text',
								'property' => 'background-color',
							),
						),
						'input_bg_hover_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'input_border'           => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '{node}.uabb-module-search .uabb-search-text',
								'important' => true,
							),
						),
						'input_border_hov_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'input_padding'          => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'default'    => '15',
							'responsive' => true,
							'slider'     => true,
							'units'      => array( 'px' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '{node}.uabb-module-search .uabb-search-text',
								'property' => 'padding',
							),
						),
					),
				),
				// Button Start.
				'btn-style'        => array( // Section.
					'title'     => __( 'Button style', 'uabb' ),
					'collapsed' => true,
					'fields'    => array(
						'btn_align'                => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'preview' => array(
								'type' => 'refresh',
							),
						),
						'btn_text_color'           => array(
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '54595f',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a.uabb-button *',
								'property' => 'color',
							),
						),
						'btn_text_hover_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'btn_icon_color'           => array(
							'type'       => 'color',
							'default'    => '',
							'label'      => __( 'Icon Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type'      => 'css',
								'property'  => 'color',
								'selector'  => 'i.uabb-button-icon.fas:before',
								'important' => true,
							),
						),
						'btn_icon_color_hover'     => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'             => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'e0e0e0',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type'  => 'css',
								'rules' => array(
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-flat-btn',
										'property' => 'background',
									),
									array(
										'selector' => '.uabb-creative-button-wrap a.uabb-creative-transparent-btn',
										'property' => 'border-color',
									),
								),
							),
						),
						'btn_bg_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'button_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => array( 'px' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'button_border'            => array(
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => array( 'px' ),
							'preview' => array(
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							),
						),
						'border_hover_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
					),
				),
				/* Button End */
				'fullscreen_style' => array(
					'title'     => 'Fullscreen',
					'collapsed' => true,
					'fields'    => array(
						'fs_input_width'  => array(
							'type'     => 'unit',
							'label'    => __( 'Input Width', 'uabb' ),
							'default'  => '600',
							'sanitize' => 'absint',
							'units'    => array( 'px', '%' ),
							'slider'   => array(
								'min'  => 0,
								'max'  => 1100,
								'step' => 10,
							),
							'help'     => __( 'The max width of the input field on fullscreen.', 'uabb' ),
							'preview'  => array(
								'type' => 'none',
							),
						),
						'fs_overlay_bg'   => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'fs_close_button' => array(
							'type'    => 'select',
							'label'   => __( 'Close Icon', 'uabb' ),
							'default' => 'show',
							'options' => array(
								'hide' => __( 'Hide', 'uabb' ),
								'show' => __( 'Show', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'results'    => array(
			'title'    => __( 'Results', 'uabb' ),
			'sections' => array(
				'ajax_result' => array(
					'title'  => __( 'Ajax Result', 'uabb' ),
					'fields' => array(
						'result_width'        => array(
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'full',
							'options' => array(
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'full'   => array(),
								'custom' => array(
									'fields' => array( 'custom_result_width' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'custom_result_width' => array(
							'type'     => 'unit',
							'label'    => __( 'Custom Width', 'uabb' ),
							'default'  => '1100',
							'sanitize' => 'absint',
							'units'    => array( 'px', '%' ),
							'slider'   => array(
								'min'  => 0,
								'max'  => 1100,
								'step' => 10,
							),
							'help'     => __( 'The max width of the ajax result container.', 'uabb' ),
							'preview'  => array(
								'type' => 'none',
							),
						),
						'show_image'          => array(
							'type'    => 'select',
							'label'   => __( 'Featured Image', 'uabb' ),
							'default' => '1',
							'options' => array(
								'1' => __( 'Show', 'uabb' ),
								'0' => __( 'Hide', 'uabb' ),
							),
							'toggle'  => array(
								'1' => array(
									'fields' => array( 'image_size', 'crop', 'image_fallback' ),
								),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'image_size'          => array(
							'type'    => 'photo-sizes',
							'label'   => __( 'Size', 'uabb' ),
							'default' => 'medium',
							'preview' => array(
								'type' => 'none',
							),
						),
						'img_border_radius'   => array(
							'type'    => 'unit',
							'label'   => __( 'Image Border Radius', 'uabb' ),
							'default' => '',
							'slider'  => array(
								'px' => array(
									'min'  => 0,
									'max'  => 1000,
									'step' => 10,
								),
							),
							'units'   => array( 'px' ),
						),
						'image_fallback'      => array(
							'type'        => 'photo',
							'show_remove' => true,
							'label'       => __( 'Fallback Image', 'uabb' ),
							'preview'     => array(
								'type' => 'none',
							),
						),
						'show_content'        => array(
							'type'    => 'select',
							'label'   => __( 'Content', 'uabb' ),
							'default' => '0',
							'options' => array(
								'1' => __( 'Show', 'uabb' ),
								'0' => __( 'Hide', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'no_results_message'  => array(
							'type'    => 'textarea',
							'label'   => __( 'No Results Message', 'uabb' ),
							'default' => __( "Sorry, we couldn't find any posts. Please try a different search.", 'uabb' ),
							'rows'    => 6,
							'preview' => array(
								'type' => 'none',
							),
						),
					),
				),
			),
		),
		'typography' => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'input_typography' => array(
					'title'  => __( 'Input Text', 'uabb' ),
					'fields' => array(
						'input_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '{node}.uabb-module-search .uabb-search-text',
								'important' => true,
							),
						),
					),
				),
				'btn_typography'   => array(
					'title'  => __( 'Button Text', 'uabb' ),
					'fields' => array(
						'btn_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '{node}.uabb-creative-button-wrap a,{node}.uabb-creative-button-wrap a:visited',
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

								<li class="uabb-docs-list-item"> <i class="ua-icon ua-icon-chevron-right2"> </i> <a href="https://www.ultimatebeaver.com/docs/searchmodule/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=search-module" target="_blank" rel="noopener"> Introducing Search Module. </a> </li>

							 </ul>',
						),
					),
				),
			),
		),
	)
);


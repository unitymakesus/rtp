<?php
/**
 *  UABB Advanced Posts Module file
 *
 *  @package UABB Advanced Posts Module
 */

/**
 * Function that initializes UABB Advanced Posts Module
 *
 * @class BlogPostsModule
 */
class BlogPostsModule extends FLBuilderModule {

	/**
	 * Variable for editor
	 *
	 * @var null $_editor
	 */
	protected $_editor = null;
	/**
	 * Variable for UABB args
	 *
	 * @var array $uabb_args
	 */
	protected $uabb_args = array();

	/**
	 * Constructor function that constructs default values for the Advanced Posts module.
	 *
	 * @method __construct
	 */
	public function __construct() {

		parent::__construct(
			array(
				'name'            => __( 'Advanced Posts', 'uabb' ),
				'description'     => __( 'Advanced Posts', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/blog-posts/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/blog-posts/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'schedule.svg',
			)
		);
		$this->add_css( 'font-awesome-5' );
		add_filter( 'wp_footer', array( $this, 'enqueue_scripts' ) );
		add_filter( 'fl_builder_loop_query_args', array( $this, 'uabb_loop_query_args' ), 1 );
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

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'arrow_background_color_opc', 'arrow_background_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'content_background_color_opc', 'content_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_background_color_opc', 'pagination_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_hover_background_color_opc', 'pagination_hover_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_active_background_color_opc', 'pagination_active_background_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_color_opc', 'masonary_background_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_hover_color_opc', 'masonary_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_active_color_opc', 'masonary_background_active_color' );
			$helper->handle_opacity_inputs( $settings, 'date_background_color_opc', 'date_background_color' );

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {
				if ( isset( $settings->title_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
				if ( isset( $settings->title_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
				}
				unset( $settings->title_font_family['family'] );
			}
			if ( isset( $settings->title_font_size_unit ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit );
			}
			if ( isset( $settings->title_font_size_unit_medium ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_medium );
			}
			if ( isset( $settings->title_font_size_unit_responsive ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->title_font_size_unit_responsive );
			}
			if ( isset( $settings->title_line_height_unit ) ) {

				$settings->title_font_typo['line_height'] = array(
					'length' => $settings->title_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit );
			}
			if ( isset( $settings->title_line_height_unit_medium ) ) {
				$settings->title_font_typo_medium['line_height'] = array(
					'length' => $settings->title_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_medium );
			}
			if ( isset( $settings->title_line_height_unit_responsive ) ) {
				$settings->title_font_typo_responsive['line_height'] = array(
					'length' => $settings->title_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->title_line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->title_font_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->title_font_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {
				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
			}
			if ( isset( $settings->desc_font_size_unit ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit );
			}
			if ( isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_medium );
			}
			if ( isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit );
			}
			if ( isset( $settings->desc_line_height_unit_medium ) ) {
				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_medium );
			}
			if ( isset( $settings->desc_line_height_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_responsive );
			}
			if ( isset( $settings->desc_transform ) ) {
				$settings->desc_font_typo['text_transform'] = $settings->desc_transform;
				unset( $settings->desc_transform );
			}
			if ( isset( $settings->desc_letter_spacing ) ) {
				$settings->desc_font_typo['letter_spacing'] = array(
					'length' => $settings->desc_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->desc_letter_spacing );
			}
			if ( ! isset( $settings->meta_font_typo ) || ! is_array( $settings->meta_font_typo ) ) {

				$settings->meta_font_typo            = array();
				$settings->meta_font_typo_medium     = array();
				$settings->meta_font_typo_responsive = array();
			}
			if ( isset( $settings->meta_font_family ) ) {
				if ( isset( $settings->meta_font_family['weight'] ) ) {
					if ( 'regular' == $settings->meta_font_family['weight'] ) {
						$settings->meta_font_typo['font_weight'] = 'normal';
					} else {
						$settings->meta_font_typo['font_weight'] = $settings->meta_font_family['weight'];
					}
					unset( $settings->meta_font_family['weight'] );
				}
				if ( isset( $settings->meta_font_family['family'] ) ) {
					$settings->meta_font_typo['font_family'] = $settings->meta_font_family['family'];
					unset( $settings->meta_font_family['family'] );
				}
			}
			if ( isset( $settings->meta_font_size_unit ) ) {
				$settings->meta_font_typo['font_size'] = array(
					'length' => $settings->meta_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->meta_font_size_unit );
			}
			if ( isset( $settings->meta_font_size_unit_medium ) ) {
				$settings->meta_font_typo_medium['font_size'] = array(
					'length' => $settings->meta_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->meta_font_size_unit_medium );
			}
			if ( isset( $settings->meta_font_size_unit_responsive ) ) {
				$settings->meta_font_typo_responsive['font_size'] = array(
					'length' => $settings->meta_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->meta_font_size_unit_responsive );
			}
			if ( isset( $settings->meta_line_height_unit ) ) {

				$settings->meta_font_typo['line_height'] = array(
					'length' => $settings->meta_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->meta_line_height_unit );
			}
			if ( isset( $settings->meta_line_height_unit_medium ) ) {
				$settings->meta_font_typo_medium['line_height'] = array(
					'length' => $settings->meta_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->meta_line_height_unit_medium );
			}
			if ( isset( $settings->meta_line_height_unit_responsive ) ) {
				$settings->meta_font_typo_responsive['line_height'] = array(
					'length' => $settings->meta_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->meta_line_height_unit_responsive );
			}
			if ( isset( $settings->meta_transform ) ) {
				$settings->meta_font_typo['text_transform'] = $settings->meta_transform;
				unset( $settings->meta_transform );
			}
			if ( isset( $settings->meta_letter_spacing ) ) {
				$settings->meta_font_typo['letter_spacing'] = array(
					'length' => $settings->meta_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->meta_letter_spacing );
			}
			if ( ! isset( $settings->date_font_typo ) || ! is_array( $settings->date_font_typo ) ) {

				$settings->date_font_typo            = array();
				$settings->date_font_typo_medium     = array();
				$settings->date_font_typo_responsive = array();
			}
			if ( isset( $settings->date_font_family ) ) {
				if ( isset( $settings->date_font_family['weight'] ) ) {
					if ( 'regular' == $settings->date_font_family['weight'] ) {
						$settings->date_font_typo['font_weight'] = 'normal';
					} else {
						$settings->date_font_typo['font_weight'] = $settings->date_font_family['weight'];
					}
					unset( $settings->date_font_family['weight'] );
				}
				if ( isset( $settings->date_font_family['family'] ) ) {
					$settings->date_font_typo['font_family'] = $settings->date_font_family['family'];
					unset( $settings->date_font_family['family'] );
				}
			}
			if ( isset( $settings->date_font_size_unit ) ) {
				$settings->date_font_typo['font_size'] = array(
					'length' => $settings->date_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->date_font_size_unit );
			}
			if ( isset( $settings->date_font_size_unit_medium ) ) {
				$settings->date_font_typo_medium['font_size'] = array(
					'length' => $settings->date_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->date_font_size_unit_medium );
			}
			if ( isset( $settings->date_font_size_unit_responsive ) ) {
				$settings->date_font_typo_responsive['font_size'] = array(
					'length' => $settings->date_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->date_font_size_unit_responsive );
			}
			if ( isset( $settings->date_transform ) ) {
				$settings->date_font_typo['text_transform'] = $settings->date_transform;
				unset( $settings->date_transform );
			}
			if ( isset( $settings->date_letter_spacing ) ) {
				$settings->date_font_typo['letter_spacing'] = array(
					'length' => $settings->date_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->date_letter_spacing );
			}
			if ( ! isset( $settings->link_font_typo ) || ! is_array( $settings->link_font_typo ) ) {

				$settings->link_font_typo            = array();
				$settings->link_font_typo_medium     = array();
				$settings->link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {
				if ( isset( $settings->link_font_family['weight'] ) ) {
					if ( 'regular' == $settings->link_font_family['weight'] ) {
						$settings->link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
				if ( isset( $settings->link_font_family['family'] ) ) {
					$settings->link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset( $settings->link_font_family['family'] );
				}
			}
			if ( isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit );
			}
			if ( isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_medium );
			}
			if ( isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->link_font_size_unit_responsive );
			}
			if ( isset( $settings->link_line_height_unit ) ) {

				$settings->link_font_typo['line_height'] = array(
					'length' => $settings->link_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit );
			}
			if ( isset( $settings->link_line_height_unit_medium ) ) {
				$settings->link_font_typo_medium['line_height'] = array(
					'length' => $settings->link_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_medium );
			}
			if ( isset( $settings->link_line_height_unit_responsive ) ) {
				$settings->link_font_typo_responsive['line_height'] = array(
					'length' => $settings->link_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->link_line_height_unit_responsive );
			}
			if ( isset( $settings->link_transform ) ) {
				$settings->link_font_typo['text_transform'] = $settings->link_transform;
				unset( $settings->link_transform );
			}
			if ( isset( $settings->link_letter_spacing ) ) {
				$settings->link_font_typo['letter_spacing'] = array(
					'length' => $settings->link_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->link_letter_spacing );
			}
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit );
			}
			if ( isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_medium );
			}
			if ( isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->btn_font_size_unit_responsive );
			}
			if ( isset( $settings->btn_line_height_unit ) ) {

				$settings->btn_font_typo['line_height'] = array(
					'length' => $settings->btn_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit );
			}
			if ( isset( $settings->btn_line_height_unit_medium ) ) {
				$settings->btn_font_typo_medium['line_height'] = array(
					'length' => $settings->btn_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_medium );
			}
			if ( isset( $settings->btn_line_height_unit_responsive ) ) {
				$settings->btn_font_typo_responsive['line_height'] = array(
					'length' => $settings->btn_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->btn_line_height_unit_responsive );
			}
			if ( isset( $settings->btn_transform ) ) {

				$settings->btn_font_typo['text_transform'] = $settings->btn_transform;
				unset( $settings->btn_transform );
			}
			if ( isset( $settings->btn_letter_spacing ) ) {

				$settings->btn_font_typo['letter_spacing'] = array(
					'length' => $settings->btn_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->btn_letter_spacing );
			}
			if ( ! isset( $settings->taxonomy_filter_font_typo ) || ! is_array( $settings->taxonomy_filter_font_typo ) ) {

				$settings->taxonomy_filter_font_typo            = array();
				$settings->taxonomy_filter_font_typo_medium     = array();
				$settings->taxonomy_filter_font_typo_responsive = array();
			}
			if ( isset( $settings->taxonomy_filter_select_font_family ) ) {
				if ( isset( $settings->taxonomy_filter_select_font_family['weight'] ) ) {
					if ( 'regular' == $settings->taxonomy_filter_select_font_family['weight'] ) {
						$settings->taxonomy_filter_font_typo['font_weight'] = 'normal';
					} else {
						$settings->taxonomy_filter_font_typo['font_weight'] = $settings->taxonomy_filter_select_font_family['weight'];
					}
					unset( $settings->taxonomy_filter_select_font_family['weight'] );
				}
				if ( isset( $settings->taxonomy_filter_select_font_family['family'] ) ) {
					$settings->taxonomy_filter_font_typo['font_family'] = $settings->taxonomy_filter_select_font_family['family'];
					unset( $settings->taxonomy_filter_select_font_family['family'] );
				}
			}
			if ( isset( $settings->taxonomy_filter_select_font_size_unit ) ) {

				$settings->taxonomy_filter_font_typo['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->taxonomy_filter_select_font_size_unit );
			}
			if ( isset( $settings->taxonomy_filter_select_font_size_unit_medium ) ) {
				$settings->taxonomy_filter_font_typo_medium['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->taxonomy_filter_select_font_size_unit_medium );
			}
			if ( isset( $settings->taxonomy_filter_select_font_size_unit_responsive ) ) {
				$settings->taxonomy_filter_font_typo_responsive['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->taxonomy_filter_select_font_size_unit_responsive );
			}
			if ( isset( $settings->taxonomy_transform ) ) {

				$settings->taxonomy_filter_font_typo['text_transform'] = $settings->taxonomy_transform;
				unset( $settings->taxonomy_transform );

			}
			if ( isset( $settings->taxonomy_letter_spacing ) ) {

				$settings->taxonomy_filter_font_typo['letter_spacing'] = array(
					'length' => $settings->taxonomy_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->taxonomy_letter_spacing );
			}
			if ( isset( $settings->pagination_color_border ) ) {
				$settings->pagination_border_param = array();
				if ( isset( $settings->pagination_border_style ) ) {
					$settings->pagination_border_param['style'] = $settings->pagination_border_style;
					unset( $settings->pagination_border_style );
				}
				$settings->pagination_border_param['color'] = $settings->pagination_color_border;
				if ( isset( $settings->pagination_border_size ) ) {
					$settings->pagination_border_param['width'] = array(
						'top'    => $settings->pagination_border_size,
						'right'  => $settings->pagination_border_size,
						'bottom' => $settings->pagination_border_size,
						'left'   => $settings->pagination_border_size,
					);
					unset( $settings->pagination_border_size );
				}
				unset( $settings->pagination_color_border );
			}	
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'arrow_background_color_opc', 'arrow_background_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_color_opc', 'btn_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'btn_bg_hover_color_opc', 'btn_bg_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'content_background_color_opc', 'content_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_background_color_opc', 'pagination_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_hover_background_color_opc', 'pagination_hover_background_color' );
			$helper->handle_opacity_inputs( $settings, 'pagination_active_background_color_opc', 'pagination_active_background_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_color_opc', 'masonary_background_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_hover_color_opc', 'masonary_background_hover_color' );
			$helper->handle_opacity_inputs( $settings, 'masonary_background_active_color_opc', 'masonary_background_active_color' );
			$helper->handle_opacity_inputs( $settings, 'date_background_color_opc', 'date_background_color' );

			if ( ! isset( $settings->title_font_typo ) || ! is_array( $settings->title_font_typo ) ) {

				$settings->title_font_typo            = array();
				$settings->title_font_typo_medium     = array();
				$settings->title_font_typo_responsive = array();
			}
			if ( isset( $settings->title_font_family ) ) {
				if ( isset( $settings->title_font_family['weight'] ) ) {
					if ( 'regular' == $settings->title_font_family['weight'] ) {
						$settings->title_font_typo['font_weight'] = 'normal';
					} else {
						$settings->title_font_typo['font_weight'] = $settings->title_font_family['weight'];
					}
					unset( $settings->title_font_family['weight'] );
				}
				if ( isset( $settings->title_font_family['family'] ) ) {
					$settings->title_font_typo['font_family'] = $settings->title_font_family['family'];
					unset( $settings->title_font_family['family'] );
				}
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				$settings->title_font_typo['font_size'] = array(
					'length' => $settings->title_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['medium'] ) ) {
				$settings->title_font_typo_medium['font_size'] = array(
					'length' => $settings->title_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_font_size['small'] ) ) {
				$settings->title_font_typo_responsive['font_size'] = array(
					'length' => $settings->title_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->title_line_height['desktop'] ) && isset( $settings->title_font_size['desktop'] ) && 0 != $settings->title_font_size['desktop'] ) {
				if ( is_numeric( $settings->title_line_height['desktop'] ) && is_numeric( $settings->title_font_size['desktop'] ) ) {
					$settings->title_font_typo['line_height'] = array(
						'length' => round( $settings->title_line_height['desktop'] / $settings->title_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['medium'] ) && isset( $settings->title_font_size['medium'] ) && 0 != $settings->title_font_size['medium'] ) {
				if ( is_numeric( $settings->title_line_height['medium'] ) && is_numeric( $settings->title_font_size['medium'] ) ) {
					$settings->title_font_typo_medium['line_height'] = array(
						'length' => round( $settings->title_line_height['medium'] / $settings->title_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->title_line_height['small'] ) && isset( $settings->title_font_size['small'] ) && 0 != $settings->title_font_size['small'] && ! isset( $settings->title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->title_line_height['small'] ) && is_numeric( $settings->title_font_size['small'] ) ) {
					$settings->title_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->title_line_height['small'] / $settings->title_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {
				if ( isset( $settings->desc_font_family['weight'] ) ) {
					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
				if ( isset( $settings->desc_font_family['family'] ) ) {
					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
			}
			if ( isset( $settings->desc_font_size['desktop'] ) ) {
				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['medium'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_font_size['small'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->desc_line_height['desktop'] ) && isset( $settings->desc_font_size['desktop'] ) && 0 != $settings->desc_font_size['desktop'] ) {
				if ( is_numeric( $settings->desc_line_height['desktop'] ) && is_numeric( $settings->desc_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->desc_line_height['desktop'] / $settings->desc_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['medium'] ) && isset( $settings->desc_font_size['medium'] ) && 0 != $settings->desc_font_size['medium'] ) {
				if ( is_numeric( $settings->desc_line_height['medium'] ) && is_numeric( $settings->desc_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->desc_line_height['medium'] / $settings->desc_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->desc_line_height['small'] ) && isset( $settings->desc_font_size['small'] ) && 0 != $settings->desc_font_size['small'] ) {
				if ( is_numeric( $settings->desc_line_height['small'] ) && is_numeric( $settings->desc_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->desc_line_height['small'] / $settings->desc_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->meta_font_typo ) || ! is_array( $settings->meta_font_typo ) ) {

				$settings->meta_font_typo            = array();
				$settings->meta_font_typo_medium     = array();
				$settings->meta_font_typo_responsive = array();
			}
			if ( isset( $settings->meta_font_family ) ) {
				if ( isset( $settings->meta_font_family['weight'] ) ) {
					if ( 'regular' == $settings->meta_font_family['weight'] ) {
						$settings->meta_font_typo['font_weight'] = 'normal';
					} else {
						$settings->meta_font_typo['font_weight'] = $settings->meta_font_family['weight'];
					}
					unset( $settings->meta_font_family['weight'] );
				}
				if ( isset( $settings->meta_font_family['family'] ) ) {
					$settings->meta_font_typo['font_family'] = $settings->meta_font_family['family'];
					unset( $settings->meta_font_family['family'] );
				}
			}
			if ( isset( $settings->meta_font_size['desktop'] ) ) {
				$settings->meta_font_typo['font_size'] = array(
					'length' => $settings->meta_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->meta_font_size['medium'] ) ) {
				$settings->meta_font_typo_medium['font_size'] = array(
					'length' => $settings->meta_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->meta_font_size['small'] ) ) {
				$settings->meta_font_typo_responsive['font_size'] = array(
					'length' => $settings->meta_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->meta_line_height['desktop'] ) && isset( $settings->meta_font_size['desktop'] ) && 0 != $settings->meta_font_size['desktop'] ) {
				if ( is_numeric( $settings->meta_line_height['desktop'] ) && is_numeric( $settings->meta_font_size['desktop'] ) ) {
					$settings->meta_font_typo['line_height'] = array(
						'length' => round( $settings->meta_line_height['desktop'] / $settings->meta_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->meta_line_height['medium'] ) && isset( $settings->meta_font_size['medium'] ) && 0 != $settings->meta_font_size['medium'] ) {
				if ( is_numeric( $settings->meta_line_height['medium'] ) && is_numeric( $settings->meta_font_size['medium'] ) ) {
					$settings->meta_font_typo_medium['line_height'] = array(
						'length' => round( $settings->meta_line_height['medium'] / $settings->meta_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->meta_line_height['small'] ) && isset( $settings->meta_font_size['small'] ) && 0 != $settings->meta_font_size['small'] ) {
				if ( is_numeric( $settings->meta_line_height['small'] ) && is_numeric( $settings->meta_font_size['small'] ) ) {
					$settings->meta_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->meta_line_height['small'] / $settings->meta_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->date_font_typo ) || ! is_array( $settings->date_font_typo ) ) {

				$settings->date_font_typo            = array();
				$settings->date_font_typo_medium     = array();
				$settings->date_font_typo_responsive = array();
			}
			if ( isset( $settings->date_font_family ) ) {
				if ( isset( $settings->date_font_family['weight'] ) ) {
					if ( 'regular' == $settings->date_font_family['weight'] ) {
						$settings->date_font_typo['font_weight'] = 'normal';
					} else {
						$settings->date_font_typo['font_weight'] = $settings->date_font_family['weight'];
					}
					unset(  $settings->date_font_family['weight'] );
				}
				if ( isset( $settings->date_font_family['family'] ) ) {
					$settings->date_font_typo['font_family'] = $settings->date_font_family['family'];
					unset(  $settings->date_font_family['family'] );
				}
			}
			if ( isset( $settings->date_font_size['desktop'] ) ) {
				$settings->date_font_typo['font_size'] = array(
					'length' => $settings->date_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->date_font_size['medium'] ) ) {
				$settings->date_font_typo_medium['font_size'] = array(
					'length' => $settings->date_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->date_font_size['small'] ) ) {
				$settings->date_font_typo_responsive['font_size'] = array(
					'length' => $settings->date_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( ! isset( $settings->link_font_typo ) || ! is_array( $settings->link_font_typo ) ) {

				$settings->link_font_typo            = array();
				$settings->link_font_typo_medium     = array();
				$settings->link_font_typo_responsive = array();
			}
			if ( isset( $settings->link_font_family ) ) {
				if ( isset( $settings->link_font_family['weight'] ) ) {
					if ( 'regular' == $settings->link_font_family['weight'] ) {
						$settings->link_font_typo['font_weight'] = 'normal';
					} else {
						$settings->link_font_typo['font_weight'] = $settings->link_font_family['weight'];
					}
					unset( $settings->link_font_family['weight'] );
				}
				if ( isset( $settings->link_font_family['family'] ) ) {
					$settings->link_font_typo['font_family'] = $settings->link_font_family['family'];
					unset(  $settings->link_font_family['family'] );
				}
			}
			if ( isset( $settings->link_font_size['desktop'] ) ) {
				$settings->link_font_typo['font_size'] = array(
					'length' => $settings->link_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['medium'] ) ) {
				$settings->link_font_typo_medium['font_size'] = array(
					'length' => $settings->link_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_font_size['small'] ) ) {
				$settings->link_font_typo_responsive['font_size'] = array(
					'length' => $settings->link_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 != $settings->link_font_size['desktop'] ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_font_typo['line_height'] = array(
						'length' => round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 != $settings->link_font_size['medium'] ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_font_typo_medium['line_height'] = array(
						'length' => round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 != $settings->link_font_size['small'] ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->btn_font_typo ) || ! is_array( $settings->btn_font_typo ) ) {

				$settings->btn_font_typo            = array();
				$settings->btn_font_typo_medium     = array();
				$settings->btn_font_typo_responsive = array();
			}
			if ( isset( $settings->btn_font_family ) ) {
				if ( isset( $settings->btn_font_family['weight'] ) ) {
					if ( 'regular' == $settings->btn_font_family['weight'] ) {
						$settings->btn_font_typo['font_weight'] = 'normal';
					} else {
						$settings->btn_font_typo['font_weight'] = $settings->btn_font_family['weight'];
					}
				}
				if ( isset( $settings->btn_font_family['family'] ) ) {
					$settings->btn_font_typo['font_family'] = $settings->btn_font_family['family'];
				}
				unset( $settings->btn_font_family );
			}
			if ( isset( $settings->btn_font_size['desktop'] ) ) {
				$settings->btn_font_typo['font_size'] = array(
					'length' => $settings->btn_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['medium'] ) ) {
				$settings->btn_font_typo_medium['font_size'] = array(
					'length' => $settings->btn_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_font_size['small'] ) ) {
				$settings->btn_font_typo_responsive['font_size'] = array(
					'length' => $settings->btn_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 != $settings->btn_font_size['desktop'] ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_font_typo['line_height'] = array(
						'length' => round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 != $settings->btn_font_size['medium'] ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_font_typo_medium['line_height'] = array(
						'length' => round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 != $settings->btn_font_size['small'] ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->taxonomy_filter_font_typo ) || ! is_array( $settings->taxonomy_filter_font_typo ) ) {

				$settings->taxonomy_filter_font_typo            = array();
				$settings->taxonomy_filter_font_typo_medium     = array();
				$settings->taxonomy_filter_font_typo_responsive = array();
			}
			if ( isset( $settings->taxonomy_filter_select_font_family ) ) {

				if ( isset( $settings->taxonomy_filter_select_font_family['weight'] ) ) {
					if ( 'regular' == $settings->taxonomy_filter_select_font_family['weight'] ) {
						$settings->taxonomy_filter_font_typo['font_weight'] = 'normal';
					} else {
						$settings->taxonomy_filter_font_typo['font_weight'] = $settings->taxonomy_filter_select_font_family['weight'];
					}
					unset( $settings->taxonomy_filter_select_font_family['weight'] );
				}
				if ( isset( $settings->taxonomy_filter_select_font_family['family'] ) ) {

					$settings->taxonomy_filter_font_typo['font_family'] = $settings->taxonomy_filter_select_font_family['family'];
					unset( $settings->taxonomy_filter_select_font_family['family'] );
				}
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['desktop'] ) ) {

				$settings->taxonomy_filter_font_typo['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['medium'] ) ) {
				$settings->taxonomy_filter_font_typo_medium['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['small'] ) ) {
				$settings->taxonomy_filter_font_typo_responsive['font_size'] = array(
					'length' => $settings->taxonomy_filter_select_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->pagination_color_border ) ) {
				$settings->pagination_border_param = array();
				if ( isset( $settings->pagination_border_style ) ) {
					$settings->pagination_border_param['style'] = $settings->pagination_border_style;
					unset( $settings->pagination_border_style );
				}
				$settings->pagination_border_param['color'] = $settings->pagination_color_border;
				if ( isset( $settings->pagination_border_size ) ) {
					$settings->pagination_border_param['width'] = array(
						'top'    => $settings->pagination_border_size,
						'right'  => $settings->pagination_border_size,
						'bottom' => $settings->pagination_border_size,
						'left'   => $settings->pagination_border_size,
					);
					unset( $settings->pagination_border_size );
				}
				unset( $settings->pagination_color_border );
			}
			if ( isset( $settings->overall_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->overall_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->overall_padding_dimension_top    = '';
				$settings->overall_padding_dimension_bottom = '';
				$settings->overall_padding_dimension_left   = '';
				$settings->overall_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->overall_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->overall_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->overall_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->overall_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->overall_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->overall_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->content_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->content_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->content_padding_dimension_top    = '';
				$settings->content_padding_dimension_bottom = '';
				$settings->content_padding_dimension_left   = '';
				$settings->content_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->content_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->content_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->content_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->content_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->content_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->content_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->content_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->masonary_padding ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->masonary_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->masonary_padding_dimension_top    = '';
				$settings->masonary_padding_dimension_bottom = '';
				$settings->masonary_padding_dimension_left   = '';
				$settings->masonary_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->masonary_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->masonary_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->masonary_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->masonary_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->masonary_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->masonary_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
			if ( isset( $settings->title_font_size['desktop'] ) ) {
				unset( $settings->title_font_size['desktop'] );	
			}
			if ( isset( $settings->title_font_size['medium']) ) {
				unset( $settings->title_font_size['medium'] );	
			}
			if ( isset( $settings->title_font_size['small']) ) {
				unset( $settings->title_font_size['small'] );	
			}
			if ( isset( $settings->title_line_height['desktop']) ) {
				unset( $settings->title_line_height['desktop'] );
			}
			if ( isset( $settings->title_line_height['medium'] ) ) {
				unset( $settings->title_line_height['medium'] );	
			}
			if ( isset( $settings->title_line_height['small'] ) ) {
				unset( $settings->title_line_height['small'] );	
			}
			if ( isset( $settings->desc_font_size['desktop'] ) ) {
				unset( $settings->desc_font_size['desktop'] );	
			}
			if ( isset( $settings->desc_font_size['medium']) ) {
				unset( $settings->desc_font_size['medium'] );	
			}
			if ( isset( $settings->desc_font_size['small']) ) {
				unset( $settings->desc_font_size['small'] );	
			}
			if ( isset( $settings->desc_line_height['desktop']) ) {
				unset( $settings->desc_line_height['desktop'] );
			}
			if ( isset( $settings->desc_line_height['medium'] ) ) {
				unset( $settings->desc_line_height['medium'] );	
			}
			if ( isset( $settings->desc_line_height['small'] ) ) {
				unset( $settings->desc_line_height['small'] );	
			}
			if ( isset( $settings->meta_font_size['desktop'] ) ) {
				unset( $settings->meta_font_size['desktop'] );	
			}
			if ( isset( $settings->meta_font_size['medium']) ) {
				unset( $settings->meta_font_size['medium'] );	
			}
			if ( isset( $settings->meta_font_size['small']) ) {
				unset( $settings->meta_font_size['small'] );	
			}
			if ( isset( $settings->meta_line_height['desktop']) ) {
				unset( $settings->meta_line_height['desktop'] );
			}
			if ( isset( $settings->meta_line_height['medium'] ) ) {
				unset( $settings->meta_line_height['medium'] );	
			}
			if ( isset( $settings->meta_line_height['small'] ) ) {
				unset( $settings->meta_line_height['small'] );	
			}
			if ( isset( $settings->date_font_size['desktop'] ) ) {
				unset( $settings->date_font_size['desktop'] );	
			}
			if ( isset( $settings->date_font_size['medium']) ) {
				unset( $settings->date_font_size['medium'] );	
			}
			if ( isset( $settings->date_font_size['small']) ) {
				unset( $settings->date_font_size['small'] );	
			}
			if ( isset( $settings->link_font_size['desktop'] ) ) {
				unset( $settings->link_font_size['desktop'] );	
			}
			if ( isset( $settings->link_font_size['medium']) ) {
				unset( $settings->link_font_size['medium'] );	
			}
			if ( isset( $settings->link_font_size['small']) ) {
				unset( $settings->link_font_size['small'] );	
			}
			if ( isset( $settings->link_line_height['desktop']) ) {
				unset( $settings->link_line_height['desktop'] );
			}
			if ( isset( $settings->link_line_height['medium'] ) ) {
				unset( $settings->link_line_height['medium'] );	
			}
			if ( isset( $settings->link_line_height['small'] ) ) {
				unset( $settings->link_line_height['small'] );	
			}
			if ( isset( $settings->btn_font_size ) ) {
				unset( $settings->btn_font_size );
			}
			if ( isset( $settings->btn_line_height ) ) {
				unset( $settings->btn_line_height );
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['desktop'] ) ) {
				unset($settings->taxonomy_filter_select_font_size['desktop'] );	
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['medium']) ) {
				unset( $settings->taxonomy_filter_select_font_size['medium'] );	
			}
			if ( isset( $settings->taxonomy_filter_select_font_size['small']) ) {
				unset( $settings->taxonomy_filter_select_font_size['small'] );	
			}
			if ( isset( $settings->overall_padding ) ) {
				unset( $settings->overall_padding );
			}
			if ( isset( $settings->content_padding ) ) {
				unset( $settings->content_padding );
			}
			if ( isset( $settings->masonary_padding ) ) {
				unset( $settings->masonary_padding );
			}
		}
		return $settings;
	}
	/**
	 * Function that updates the rewrite rules.
	 *
	 * @since 1.10.7
	 * @param object $settings gets an object for the settings.
	 */
	public function update( $settings ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules( false );
		return $settings;
	}

	/**
	 * Mutator function to update $uabb_args
	 *
	 * @method Mutator function to update $uabb_args
	 * @param array $args gets an array of arguments.
	 */
	public function set_uabb_args( $args ) {
		$this->uabb_args = $args;
	}

	/**
	 * Accessor function to get $uabb_args
	 *
	 * @method Accessor function to get $uabb_args
	 * @public
	 */
	public function get_uabb_args() {
		return $this->uabb_args;
	}

	/**
	 * Filter to modify WP Query args
	 *
	 * @method Filter to modify WP Query args
	 * @public
	 * @param array $args gets an array of args.
	 */
	public function uabb_loop_query_args( $args ) {
		if ( is_array( $args ) && is_array( $this->uabb_args ) ) {
			$args = array_merge( $args, $this->uabb_args );
		}
		return $args;
	}

	/**
	 * Filter to enqueue scripts
	 */
	public function enqueue_scripts() {

		$this->add_js( 'jquery-infinitescroll' );
		$this->add_js( 'jquery-mosaicflow' );
		$this->add_js( 'isotope', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-masonary.js', array( 'jquery' ), '', true );
		$this->add_js( 'carousel', BB_ULTIMATE_ADDON_URL . 'assets/js/global-scripts/jquery-carousel.js', array( 'jquery' ), '', true );
		$this->add_js( 'jquery-infinitescroll' );
	}

	/**
	 * Returns an array of data for post types supported.
	 *
	 * @since 1.6.2
	 * @return array
	 */
	static public function post_types() {
		$post_types = get_post_types(
			array(
				'public'  => true,
				'show_ui' => true,
			), 'objects'
		);

		unset( $post_types['attachment'] );
		unset( $post_types['fl-builder-template'] );
		unset( $post_types['fl-theme-layout'] );

		return $post_types;
	}

	/**
	 * Function that gets editor.
	 *
	 * @method _get_editor
	 * @protected
	 * @param string $url gets the URL of the editor.
	 */
	protected function _get_editor( $url ) {
		$url_path  = $url;
		$file_path = ABSPATH . 'wp-content' . str_replace( content_url(), '', $url_path );

		if ( file_exists( $file_path ) ) {
			$this->_editor = wp_get_image_editor( $file_path );
		} else {
			$this->_editor = wp_get_image_editor( $url_path );
		}

		return $this->_editor;
	}


	/**
	 * Function that gets the cropped path
	 *
	 * @method _get_cropped_path
	 * @protected
	 * @param int    $i gets an integer.
	 * @param string $url gets an string for the path.
	 */
	protected function _get_cropped_path( $i, $url ) {
		$crop      = 'custom_crop';
		$cache_dir = FLBuilderModel::get_cache_dir();

		if ( empty( $url ) ) {
			$filename = uniqid(); // Return a file that doesn't exist.
		} else {

			if ( stristr( $url, '?' ) ) {
				$parts = explode( '?', $url );
				$url   = $parts[0];
			}

			$pathinfo = pathinfo( $url );
			$dir      = $pathinfo['dirname'];
			$ext      = $pathinfo['extension'];
			$name     = wp_basename( $url, ".$ext" );
			$new_ext  = strtolower( $ext );
			$filename = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename,
		);
	}


	/**
	 * Function that deletes the cropped URL.
	 *
	 * @method delete
	 * @param int    $i gets an integer.
	 * @param string $url gets an string for the path.
	 */
	public function deleteUrl( $i, $url ) {
		$cropped_path = $this->_get_cropped_path( $i, $url );
		if ( file_exists( $cropped_path['path'] ) ) {
			unlink( $cropped_path['path'] );
		}
	}


	/**
	 * Function that crops the Image.
	 *
	 * @method crop
	 * @param int    $i gets the id.
	 * @param string $url gets the URL of the existing image.
	 * @param size   $width gets the width of the image.
	 * @param size   $height gets the height of the image.
	 */
	public function crop( $i, $url, $width, $height ) {
		// Delete an existing crop if it exists.
		$this->deleteUrl( $i, $url );

		$editor = $this->_get_editor( $url );

		if ( ! $editor || is_wp_error( $editor ) ) {
			return false;
		}

		$cropped_path = $this->_get_cropped_path( $i, $url );
		$new_width    = $width;
		$new_height   = $height;

		// Make sure we have enough memory to crop @ini_set( 'memory_limit', '300M' );.
		ini_set( 'memory_limit', '300M' );

		// Crop the photo.
		$editor->resize( $new_width, $new_height, true );

		// Save the photo.
		$editor->save( $cropped_path['path'] );
		// Return the new url.
		return $cropped_path['url'];
	}

	/**
	 * Add rewrite rules for pagination that allows multiple advanced post modules
	 * on the same page to be paged independently.
	 *
	 * @since 1.4.7
	 * @return void
	 */
	public function uabb_init_rewrite_rules() {
		for ( $x = 2; $x <= 10; $x++ ) {
			add_rewrite_rule( 'paged-' . $x . '/([0-9]*)/?', 'index.php?page_id=' . get_option( 'page_on_front' ) . '&flpaged' . $x . '=$matches[1]', 'top' );
			add_rewrite_rule( 'paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?&flpaged' . $x . '=$matches[1]', 'top' );
			add_rewrite_rule( '(.?.+?)/paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?pagename=$matches[1]&flpaged' . $x . '=$matches[2]', 'top' );
			add_rewrite_rule( '([^/]+)/paged-' . $x . '/?([0-9]{1,})/?$', 'index.php?name=$matches[1]&flpaged' . $x . '=$matches[2]', 'top' );
			add_rewrite_tag( "%flpaged{$x}%", '([^&]+)' );
		}
	}

	/**
	 * Disable canonical redirection on the frontpage when query var 'flpaged' is found.
	 *
	 * @param  string $redirect_url  The redirect URL.
	 * @param  string $requested_url The requested URL.
	 * @since  1.4.7
	 * @return bool|string
	 */
	public function uabb_override_canonical( $redirect_url, $requested_url ) {
		global $wp_the_query;

		if ( is_array( $wp_the_query->query ) ) {
			foreach ( $wp_the_query->query as $key => $value ) {
				if ( strpos( $key, 'flpaged' ) === 0 && is_page() && get_option( 'page_on_front' ) ) {
					$redirect_url = false;
					break;
				}
			}

			$supported_post_types = self::post_types();
			// Disable canonical on CPT single.
			if ( isset( $wp_the_query->query_vars['post_type'] )
				&& ! is_array( $wp_the_query->query_vars['post_type'] )
				&& isset( $supported_post_types[ $wp_the_query->query_vars['post_type'] ] )
				&& true === $wp_the_query->is_singular
				&& - 1 == $wp_the_query->current_post
				&& true === $wp_the_query->is_paged
			) {
				$redirect_url = false;
			}
		}
		return $redirect_url;
	}

	/**
	 * Function that renders pagination.
	 *
	 * @method render_pagination
	 * @param object $query gets an array of query.
	 */
	public function render_pagination( $query ) {
		// Get current page number.
		$permalink_structure = get_option( 'permalink_structure' );
		$base                = untrailingslashit( html_entity_decode( get_pagenum_link() ) );
		$paged               = FLBuilderLoop::get_paged();

		$this->settings->total_posts_switch = ( isset( $this->settings->total_posts_switch ) ? $this->settings->total_posts_switch : 'all' );

		$this->settings->total_posts = ( isset( $this->settings->total_posts ) ? $this->settings->total_posts : $query->found_posts );

		// Get total number of posts from query.
		$total_posts = ( 'all' == $this->settings->total_posts_switch ) ? $query->found_posts : ( ( '' != $this->settings->total_posts ) ? $this->settings->total_posts : '6' );

		$base   = FLBuilderLoop::build_base_url( $permalink_structure, $base );
		$format = FLBuilderLoop::paged_format( $permalink_structure, $base );

		// Offset value if any.
		$offset = ( ! isset( $this->settings->offset ) || ! is_int( (int) $this->settings->offset ) ) ? 0 : ( ( '' != $this->settings->offset ) ? $this->settings->offset : 0 );

		$max = $query->found_posts - $offset;

		$max = ( $total_posts <= $max ) ? $total_posts : $max;

		if ( 'all' == $this->settings->total_posts_switch || ( isset( $this->settings->data_source ) && 'main_query' == $this->settings->data_source ) ) {
			$total_pages = $query->max_num_pages;
		} else {
			$posts_per_page = ( isset( $this->settings->posts_per_page ) ) ? ( ( '' != $this->settings->posts_per_page ) ? $this->settings->posts_per_page : '10' ) : '10';
			$total_pages    = ceil( $max / $posts_per_page );
		}

		// Return pagination html.
		if ( $total_pages > 1 ) {

			$current_page = $paged;
			if ( ! $current_page ) {
				$current_page = 1;
			}
			echo paginate_links(
				array(
					'base'    => $base . '%_%',
					'format'  => $format,
					'current' => $current_page,
					'total'   => $total_pages,
					'type'    => 'list',
				)
			);
		}
	}

	/**
	 * Function that renders args for pagination.
	 *
	 * @method render_args
	 */
	public function render_args() {

		$show_pagination = ( isset( $this->settings->show_pagination ) ) ? $this->settings->show_pagination : 'yes';

		$args['post_type'] = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';
		$args['orderby']   = ( isset( $this->settings->order_by ) ) ? $this->settings->order_by : '';

		$this->settings->total_posts_switch = ( isset( $this->settings->total_posts_switch ) ) ? $this->settings->total_posts_switch : 'custom';

		$this->settings->total_posts = ( isset( $this->settings->total_posts ) ? $this->settings->total_posts : '6' );

			// Order by meta value arg.
		if ( strstr( $args['orderby'], 'meta_value' ) ) {
			if ( isset( $this->settings->order_by_meta_key ) ) {
				$args['meta_key'] = $this->settings->order_by_meta_key;
			}
		}

		if ( 'carousel' != $this->settings->is_carousel && 'yes' == $show_pagination ) {

			$cat           = 'masonary_filter_' . $args['post_type'];
			$do_pagination = ( isset( $this->settings->$cat ) ) ? ( ( -1 == $this->settings->$cat ) ? true : false ) : true;

			if ( 'masonary' == $this->settings->is_carousel ) {
				if ( true == $do_pagination ) {
					$args['posts_per_page'] = ( isset( $this->settings->posts_per_page ) ) ? ( ( '' != $this->settings->posts_per_page ) ? $this->settings->posts_per_page : '10' ) : '10';
				} else {
					$args['posts_per_page'] = ( 'all' == $this->settings->total_posts_switch ) ? '-1' : $this->settings->total_posts;
				}
			} else {
				$args['posts_per_page'] = ( isset( $this->settings->posts_per_page ) ) ? ( ( '' != $this->settings->posts_per_page ) ? $this->settings->posts_per_page : '10' ) : '10';
			}
		} else {
			$args['posts_per_page'] = ( 'all' == $this->settings->total_posts_switch ) ? '-1' : $this->settings->total_posts;
		}
		return $args;
	}


	/**
	 * Function that renders the CTA Button
	 *
	 * @method render_button
	 * @protected
	 * @param string $link   gets the link for the Blog content button.
	 * @param string $link_target gets the target for the Blog button.
	 */
	protected function render_button( $link = '', $link_target = '_blank' ) {

		// Return CTA.
		if ( 'button' == $this->settings->cta_type ) {
			if ( ! UABB_Compatibility::check_bb_version() ) {
				$btn_settings = array(
					/* General Section */
					'text'                        => do_shortcode( $this->settings->btn_text ),

					/* Link Section */
					'link'                        => $link,
					'link_target'                 => $link_target,
					'link_nofollow'               => $this->settings->link_nofollow,

					/* Style Section */
					'style'                       => $this->settings->btn_style,
					'border_size'                 => $this->settings->btn_border_size,
					'transparent_button_options'  => $this->settings->btn_transparent_button_options,
					'threed_button_options'       => $this->settings->btn_threed_button_options,
					'flat_button_options'         => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                    => $this->settings->btn_bg_color,
					'bg_hover_color'              => $this->settings->btn_bg_hover_color,
					'text_color'                  => $this->settings->btn_text_color,
					'text_hover_color'            => $this->settings->btn_text_hover_color,

					/* Icon */
					'icon'                        => $this->settings->btn_icon,
					'icon_position'               => $this->settings->btn_icon_position,

					/* Structure */
					'width'                       => $this->settings->btn_width,
					'custom_width'                => $this->settings->btn_custom_width,
					'custom_height'               => $this->settings->btn_custom_height,
					'padding_top_bottom'          => $this->settings->btn_padding_top_bottom,
					'padding_left_right'          => $this->settings->btn_padding_left_right,
					'border_radius'               => $this->settings->btn_border_radius,
					'align'                       => $this->settings->overall_alignment,
					'mob_align'                   => '',

					/* Typography */
					'font_size'                   => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
					'line_height'                 => ( isset( $this->settings->btn_line_height ) ) ? $this->settings->btn_line_height : '',
					'line_height_unit'            => $this->settings->btn_line_height_unit,
					'font_size_unit'              => $this->settings->btn_font_size_unit,
					'font_size_unit_medium'       => $this->settings->btn_font_size_unit_medium,
					'line_height_unit_medium'     => $this->settings->btn_line_height_unit_medium,
					'font_size_unit_responsive'   => $this->settings->btn_font_size_unit_responsive,
					'line_height_unit_responsive' => $this->settings->btn_line_height_unit_responsive,

					'font_family'                 => $this->settings->btn_font_family,

					'button_padding_dimension'    => ( isset( $this->settings->button_padding_dimension ) ) ? $this->settings->button_padding_dimension : '',
					'button_border_style'               => ( isset( $this->settings->button_border_style ) ) ? $this->settings->button_border_style : '',
					'button_border_width'               => ( isset( $this->settings->button_border_width ) ) ? $this->settings->button_border_width : '',
					'button_border_radius'               => ( isset( $this->settings->button_border_radius ) ) ? $this->settings->button_border_radius : '',
					'button_border_color'               => ( isset( $this->settings->button_border_color ) ) ? $this->settings->button_border_color : '',

					'border_hover_color'          => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
					
				);
			} else {
				$btn_settings = array(
					/* General Section */
					'text'                       => do_shortcode( $this->settings->btn_text ),

					/* Link Section */
					'link'                       => $link,
					'link_target'                => $link_target,
					'link_nofollow'              => $this->settings->link_nofollow,

					/* Style Section */
					'style'                      => $this->settings->btn_style,
					'border_size'                => $this->settings->btn_border_size,
					'transparent_button_options' => $this->settings->btn_transparent_button_options,
					'threed_button_options'      => $this->settings->btn_threed_button_options,
					'flat_button_options'        => $this->settings->btn_flat_button_options,

					/* Colors */
					'bg_color'                   => $this->settings->btn_bg_color,
					'bg_hover_color'             => $this->settings->btn_bg_hover_color,
					'text_color'                 => $this->settings->btn_text_color,
					'text_hover_color'           => $this->settings->btn_text_hover_color,

					/* Icon */
					'icon'                       => $this->settings->btn_icon,
					'icon_position'              => $this->settings->btn_icon_position,

					/* Structure */
					'width'                      => $this->settings->btn_width,
					'custom_width'               => $this->settings->btn_custom_width,
					'custom_height'              => $this->settings->btn_custom_height,
					'padding_top_bottom'         => $this->settings->btn_padding_top_bottom,
					'padding_left_right'         => $this->settings->btn_padding_left_right,
					'border_radius'              => $this->settings->btn_border_radius,
					'align'                      => $this->settings->overall_alignment,
					'mob_align'                  => '',

					/* Typography */
					'font_size'                  => ( isset( $this->settings->btn_font_size ) ) ? $this->settings->btn_font_size : '',
					'line_height'                => ( isset( $this->settings->btn_line_height ) ) ? $this->settings->btn_line_height : '',
					'button_typo'                => ( isset( $this->settings->btn_font_typo ) ) ? $this->settings->btn_font_typo : '',
					'button_typo_medium'         => ( isset( $this->settings->btn_font_typo_medium ) ) ? $this->settings->btn_font_typo_medium : '',
					'button_typo_responsive'     => ( isset( $this->settings->btn_font_typo_responsive ) ) ? $this->settings->btn_font_typo_responsive : '',

					'button_padding_dimension'    => ( isset( $this->settings->button_padding_dimension ) ) ? $this->settings->button_padding_dimension : '',
					'button_border'               => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
					'border_hover_color'          => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',

				);
			}
			echo '<div class="uabb-blog-post-section">';
			FLBuilder::render_module_html( 'uabb-button', $btn_settings );
			echo '</div>';

		} elseif ( 'link' == $this->settings->cta_type ) {
			$nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0';
			echo '<span class="uabb-read-more-text uabb-blog-post-section"><a href="' . $link . '" target="' . $link_target . '" ' . BB_Ultimate_Addon_Helper::get_link_rel( $link_target, $nofollow, 0 ) . '>' . do_shortcode( $this->settings->cta_text ) . ' <span class="uabb-next-right-arrow">&#8594;</span></a></span>';
		}
	}

	/**
	 * Function that renders the Image URL
	 *
	 * @method render_image_url
	 * @protected
	 * @param array  $i   gets the values for the Blog content.
	 * @param object $post_attachment_id gets the id of the attachment.
	 */
	protected function render_image_url( $i, $post_attachment_id ) {

		// Predefined values.
		$id   = -1;
		$id   = get_post_thumbnail_id( $post_attachment_id );
		$alt  = get_post_meta( $id, '_wp_attachment_image_alt', true );
		$size = ( isset( $this->settings->featured_image_size ) ) ? $this->settings->featured_image_size : 'medium';

		// Get attachment if any.
		if ( -1 != $id && '' != $id ) {
			if ( 'custom' != $size ) {
				$temp  = wp_get_attachment_image_src( $id, $size );
				$image = $temp[0];
			} else {
				$temp  = wp_get_attachment_image_src( $id, 'full' );
				$image = $this->crop( $i, $temp[0], $this->settings->featured_image_size_width, $this->settings->featured_image_size_height );
			}
		} else {
			$return_array = array(
				'image' => '',
				'alt'   => '',
			);
			return $return_array;
		}

		$return_array = array(
			'image' => $image,
			'alt'   => $alt,
		);
		return $return_array;
	}


	/**
	 * Function that renders Mansonry Filters
	 *
	 * @method render_masonary_filters
	 */
	public function render_masonary_filters() {

		$post_type = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';

		// Get taxonomies for given custom/default post type.
		$taxonomies = get_object_taxonomies( $post_type, 'objects' );
		$data       = array();

		foreach ( $taxonomies as $tax_slug => $tax ) {

			if ( ! $tax->public || ! $tax->show_ui ) {
				continue;
			}
			$data[ $tax_slug ] = $tax;
		}

		$taxonomies = $data;
		$cat        = 'masonary_filter_' . $post_type;
		$tax_value  = '';

		// Parse the categories.
		if ( isset( $this->settings->$cat ) ) {
			if ( -1 != $this->settings->$cat ) {

				foreach ( $taxonomies as $tax_slug => $tax ) {

					$tax_value = '';
					if ( $this->settings->$cat == $tax_slug ) {
						// New settings slug.
						if ( isset( $this->settings->{'tax_' . $post_type . '_' . $tax_slug} ) ) {
							$tax_value = $this->settings->{'tax_' . $post_type . '_' . $tax_slug};
						} elseif ( isset( $this->settings->{'tax_' . $tax_slug} ) ) {
							// Legacy settings slug.
							$tax_value = $this->settings->{'tax_' . $tax_slug};
						}
						break;
					}
				}
				$tax_value = ( '' != $tax_value ) ? explode( ',', $tax_value ) : array();

				$object_taxonomies = get_object_taxonomies( $post_type );

				if ( ! empty( $object_taxonomies ) ) {

					$category_detail = get_terms( $this->settings->$cat );

					if ( count( $category_detail ) > 0 ) {

						echo '<div class="uabb-masonary-filters-wrapper">';

						$all_text = 'uabb_masonary_filter_all_edit_' . $post_type;

						$filter_type = 'uabb_masonary_filter_type_' . $post_type;

						if ( isset( $this->settings->$filter_type ) && 'drop-down' == $this->settings->$filter_type ) {
							echo '<select class="uabb-masonary-filters">';
							echo '<option class="uabb-masonary-filter-' . $this->node . ' uabb-masonary-current" data-filter="*" value="all">' . ( isset( $this->settings->$all_text ) ? $this->settings->$all_text : __( 'All', 'uabb' ) ) . '</option>';

							foreach ( $category_detail as $cat_details ) {
								if ( ! empty( $tax_value ) ) {
									if (  isset( $this->settings->{ 'masonary_filter_' . $post_type } ) && $tax_slug === $this->settings->{ 'masonary_filter_' . $post_type }  ) {
										if ( isset( $this->settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'} ) && '0' === $this->settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'} ) {
											if (  ! in_array( $cat_details->term_id, $tax_value ) ) {
												echo '<option class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</option>';
											}
										} else {
											if ( in_array( $cat_details->term_id, $tax_value ) ) {
												echo '<option class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</option>';
											}
										}
									}
								} else {
									echo '<option class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</option>';
								}
							}
							echo '</select>';
						} else {
								echo '<ul class="uabb-masonary-filters">';
								echo '<li class="uabb-masonary-filter-' . $this->node . ' uabb-masonary-current" data-filter="*">' . ( isset( $this->settings->$all_text ) ? $this->settings->$all_text : __( 'All', 'uabb' ) ) . '</li>';
							foreach ( $category_detail as $cat_details ) {
								if ( ! empty( $tax_value ) ) {
									if ( isset( $this->settings->{ 'masonary_filter_' . $post_type } ) && $tax_slug === $this->settings->{ 'masonary_filter_' . $post_type } ) {
										if ( isset( $this->settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'} ) && '0' === $this->settings->{'tax_' . $post_type . '_' . $tax_slug . '_matching'} ) {
											if (  ! in_array( $cat_details->term_id, $tax_value ) ) {
												echo '<li class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</li>';
											}
										} else {
											if ( in_array( $cat_details->term_id, $tax_value ) ) {
												echo '<li class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</li>';
											}
										}
									}
								} else {
									echo '<li class="uabb-masonary-filter-' . $this->node . '" data-filter=".uabb-masonary-cat-' . $cat_details->term_id . '">' . $cat_details->name . '</li>';
								}
							}
								echo '</ul>';
						}
						echo '</div>';
					}
				}
			}
		}
	}


	/**
	 * Function that renders Featured Image
	 *
	 * @method render_featured_image
	 * @param string $pos gets the string for the position of the Image.
	 * @param object $obj gets the blogs object.
	 * @param array  $i   gets the values for the Blog content.
	 */
	public function render_featured_image( $pos = 'top', $obj, $i ) {
		$html = '';
		// Match current Image position.
		if ( $pos == $this->settings->blog_image_position ) {

			$show_featured_image = ( isset( $this->settings->show_featured_image ) ) ? $this->settings->show_featured_image : 'yes';

			$link = apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID, $this->settings );

			if ( 'yes' == $show_featured_image ) {

				// Get image url + alt.
				$img_data = $this->render_image_url( $i, $obj->ID );
				$img_url  = $img_data['image'];

				if ( '' != $img_url ) {

					if ( 'carousel' == $this->settings->is_carousel && 'yes' == $this->settings->lazyload ) {
						$img_url = 'data-lazy="' . $img_url . '"';
					} else {
						$img_url = 'src="' . $img_url . '"';
					}

					ob_start();

					$spacing_class = ( substr( $this->settings->layout_sort_order, 0, 3 ) == 'img' && 'top' == $pos ) ? '' : ' uabb-blog-post-section';
					?>

			<div class="uabb-post-thumbnail <?php echo ( 'custom' == $this->settings->featured_image_size ) ? 'uabb-crop-thumbnail' : ''; ?> <?php echo $spacing_class; ?>">

					<?php do_action( 'uabb_blog_posts_before_image', $obj->ID, $this->settings ); ?>
					<?php $nofollow = ( isset( $this->settings->link_nofollow ) ) ? $this->settings->link_nofollow : '0'; ?>
				<a href="<?php echo $link; ?>" target="<?php echo $this->settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $nofollow, 1 ); ?> title="<?php the_title_attribute(); ?>">
				<img <?php echo $img_url; ?> alt="<?php echo $img_data['alt']; ?>" />
				</a>

					<?php do_action( 'uabb_blog_posts_after_image', $obj->ID, $this->settings ); ?>
					<?php
					if ( 'yes' == $this->settings->show_date_box ) {
						$date_box_format = ( isset( $this->settings->date_box_format ) ) ? $this->settings->date_box_format : 'M j, Y';
						switch ( $date_box_format ) {

							case 'M j Y':
								$month = 'M';
								$day   = 'j';
								$year  = 'Y';
								break;

							case 'F j Y':
								$month = 'F';
								$day   = 'j';
								$year  = 'Y';
								break;

							case 'm d Y':
								$month = 'm';
								$day   = 'd';
								$year  = 'Y';
								break;

							case 'd m Y':
								$month = 'd';
								$day   = 'm';
								$year  = 'Y';
								break;

							case 'Y m d':
								$month = 'Y';
								$day   = 'm';
								$year  = 'd';
								break;

							default:
								$month = 'M';
								$day   = 'j';
								$year  = 'Y';
								break;
						}
						?>
					<div class="uabb-next-date-meta">
						<<?php echo $this->settings->date_tag_selection; ?> class="uabb-posted-on">
							<time class="uabb-entry-date uabb-published uabb-updated" datetime="<?php echo date_i18n( 'c', strtotime( $obj->post_date ) ); ?>">
								<span class="uabb-date-month"><?php echo date_i18n( $month, strtotime( $obj->post_date ) ); ?></span>
								<span class="uabb-date-day"><?php echo date_i18n( $day, strtotime( $obj->post_date ) ); ?></span>
								<span class="uabb-date-year"><?php echo date_i18n( $year, strtotime( $obj->post_date ) ); ?></span>
							</time>
						</<?php echo $this->settings->date_tag_selection; ?>>
					</div>
						<?php
					}
					?>
			</div>

					<?php
					$html = ob_get_contents();
					ob_end_clean();
				}
			}
		}
		return $html;
	}


	/**
	 * Function that renders the Title section.
	 *
	 * @method render_title_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_title_section( $obj ) {
		$show_title = ( isset( $this->settings->show_title ) ) ? $this->settings->show_title : 'yes';
		if ( 'yes' == $show_title ) {
			?>
			<<?php echo $this->settings->title_tag_selection; ?> class="uabb-post-heading uabb-blog-post-section">
				<?php
				$title = '<a href=' . apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID ) . ' title="' . the_title_attribute( 'echo=0' ) . '" tabindex="0" class="">' . get_the_title() . '</a>';

				echo apply_filters( 'uabb_advanced_post_title_link', $title, get_the_title(), get_permalink( $obj->ID ), $obj->ID, $this->settings );
				?>
			</<?php echo $this->settings->title_tag_selection; ?>>
			<?php
		}
	}


	/**
	 * Function that renders content section
	 *
	 * @method render_content_section
	 * @protected
	 * @method render_blog_content
	 * @param object $obj gets the blogs object.
	 */
	protected function render_content_section( $obj ) {

		// Predefined variables.
		$show_excerpt = ( isset( $this->settings->show_excerpt ) ) ? $this->settings->show_excerpt : 'yes';

		$content_type = ( isset( $this->settings->content_type ) ) ? $this->settings->content_type : 'excerpt';

		$excerpt_count = ( isset( $this->settings->excerpt_count ) ) ? $this->settings->excerpt_count : '';

		$strip_html = ( isset( $this->settings->strip_content_html ) ) ? $this->settings->strip_content_html : 'yes';

		$content = '';
		$txt     = '';

		if ( 'yes' == $show_excerpt ) {
			if ( 'excerpt' == $content_type ) {
				$content = get_the_excerpt( $obj->ID );
			} else {
				$txt = $obj->post_content;
				$txt = do_shortcode( $txt );

				if ( 'custom' == $content_type ) {
					if ( '' != $excerpt_count ) {
						$content = wp_trim_words( $txt, $excerpt_count, ' ...' );
					} else {
						$content = wp_trim_words( $txt, 55, ' ...' );
					}
				} else {
					$content = $txt;
				}
			}
			$content_count = strlen( $content );

			if ( 0 != $content_count ) {
				if ( 'excerpt' == $content_type && 'no' == $strip_html ) {
					?>
					<div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters( 'uabb_blog_posts_excerpt', the_excerpt(), $this->settings ); ?></div>
					<?php
				} elseif ( 'content' == $content_type && 'no' == $strip_html ) {
					?>
					<div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters( 'uabb_blog_posts_excerpt', the_content(), $this->settings ); ?></div>
					<?php
				} else {
					?>
					<div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor"><?php echo apply_filters( 'uabb_blog_posts_excerpt', $content, $this->settings ); ?></div>
					<?php
				}
			}
		}
	}


	/**
	 * Functoin that renders author section.
	 *
	 * @method render_author_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_author_section( $obj ) {
		$show_author = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
		ob_start();
		if ( 'yes' == $show_author ) {
			?>
			<?php _e( 'By', 'uabb' ); ?><span class="uabb-posted-by"> <a class="url fn n" href="<?php echo get_author_posts_url( $obj->post_author ); ?>">
					<?php

						$author = ( get_the_author_meta( 'display_name', $obj->post_author ) != '' ) ? get_the_author_meta( 'display_name', $obj->post_author ) : get_the_author_meta( 'user_nicename', $obj->post_author );

						echo $author;
					?>
				</a>
			</span>
			<?php
		}
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	/**
	 * Function that renders the date section
	 *
	 * @method render_date_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_date_section( $obj ) {

		$show_date   = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';
		$date_format = ( isset( $this->settings->date_format ) ) ? $this->settings->date_format : 'M j, Y';

		ob_start();

		if ( 'yes' == $show_date ) {
			?>
			<span class="uabb-meta-date"><?php echo date_i18n( $date_format, strtotime( $obj->post_date ) ); ?>
			</span>
			<?php
		}

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	/**
	 * Function that renders Taxonomy section.
	 *
	 * @method render_taxonomy_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_taxonomy_section( $obj ) {
		$show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
		$show_tags       = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
		$category_detail = array();

		ob_start();

		if ( 'yes' == $show_categories ) {
			$post_type         = ( isset( $this->settings->post_type ) ) ? $this->settings->post_type : 'post';
			$object_taxonomies = get_object_taxonomies( $post_type );
			if ( ! empty( $object_taxonomies ) ) {
				$category_detail = wp_get_post_terms( $obj->ID, $object_taxonomies[0] );

				if ( count( $category_detail ) > 0 ) {

					for ( $j = 0; $j < count( $category_detail ); $j++ ) {
						?>
				<span class="uabb-cat-links"><a href="<?php echo get_term_link( $category_detail[ $j ]->term_id ); ?>" rel="category tag"><?php echo $category_detail[ $j ]->name; ?></a></span><?php echo ( count( $category_detail ) != $j + 1 ) ? trim( ',&nbsp;' ) : '';
					}
				}
			}
		}

		if ( 'yes' == $show_tags ) {

			$tag_detail = get_the_tags( $obj->ID );
			if ( '' != $tag_detail ) {
				echo ( count( $category_detail ) > 0 ) ? ', ' : '';
				for ( $k = 0; $k < count( $tag_detail ); $k++ ) {
					?>
			<span class="uabb-tag-links"><a href="<?php echo get_tag_link( $tag_detail[ $k ]->term_id ); ?>" rel="category tag"><?php echo $tag_detail[ $k ]->name; ?></a></span><?php echo ( count( $tag_detail ) != $k + 1 ) ? trim( ',&nbsp;' ) : '';
				}
			}
		}

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * Function that renders comment section.
	 *
	 * @method render_comment_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_comment_section( $obj ) {
		$show_comments = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';

		ob_start();

		if ( 'yes' == $show_comments ) {

			if ( $obj->comment_count > 0 ) {
				?>
			<span class="uabb-comments-link"><a href="<?php echo get_permalink( $obj->ID ); ?>#comments"><?php echo $obj->comment_count; ?> <?php echo ( $obj->comment_count > 1 ) ? __( 'Comments', 'uabb' ) : __( 'Comment', 'uabb' ); ?></a></span>
				<?php
			}
		}

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	/**
	 * Function that renders meta section.
	 *
	 * @method render_meta_section
	 * @protected
	 * @param object $obj gets the blogs object.
	 */
	protected function render_meta_section( $obj ) {

		$show_author     = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
		$show_meta       = ( isset( $this->settings->show_meta ) ) ? $this->settings->show_meta : 'yes';
		$show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
		$show_tags       = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
		$show_comments   = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';
		$show_date       = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';

		$output = '';

		if ( 'yes' == $show_meta ) {
			if ( 'yes' == $show_author || 'yes' == $show_categories || 'yes' == $show_tags || 'yes' == $show_comments || 'yes' == $show_date ) {
				?>
				<<?php echo $this->settings->meta_tag_selection; ?> class="uabb-post-meta uabb-blog-post-section">
				<?php
					$meta_order = explode( ',', $this->settings->meta_sort_order );

				for ( $i = 0; $i < count( $meta_order ); $i++ ) {
					switch ( $meta_order[ $i ] ) {
						case 'author':
							$output = $this->render_author_section( $obj );
							break;

						case 'date':
							$output = $this->render_date_section( $obj );
							break;

						case 'taxonomy':
							$output = $this->render_taxonomy_section( $obj );
							break;

						case 'comment':
							$output = $this->render_comment_section( $obj );
							break;

						default:
							// Nothing to do here.
							break;
					}
					$output_array[] = $output;
				}
					$meta_html = implode( ' | ', array_filter( $output_array ) );
					echo $meta_html;
				?>
				</<?php echo $this->settings->meta_tag_selection; ?>>
				<?php
			}
		}
	}

	/**
	 * Function that renders blog content
	 *
	 * @method render_blog_content
	 * @param object $obj gets the blogs object.
	 * @param array  $i   gets the values for the Blog content.
	 */
	public function render_blog_content( $obj, $i ) {

		$link            = apply_filters( 'uabb_blog_posts_link', get_permalink( $obj->ID ), $obj->ID, $this->settings );
		$show_title      = ( isset( $this->settings->show_title ) ) ? $this->settings->show_title : 'yes';
		$show_excerpt    = ( isset( $this->settings->show_excerpt ) ) ? $this->settings->show_excerpt : 'yes';
		$show_author     = ( isset( $this->settings->show_author ) ) ? $this->settings->show_author : 'yes';
		$show_meta       = ( isset( $this->settings->show_meta ) ) ? $this->settings->show_meta : 'yes';
		$show_categories = ( isset( $this->settings->show_categories ) ) ? $this->settings->show_categories : 'no';
		$show_tags       = ( isset( $this->settings->show_tags ) ) ? $this->settings->show_tags : 'no';
		$show_comments   = ( isset( $this->settings->show_comments ) ) ? $this->settings->show_comments : 'no';
		$show_date       = ( isset( $this->settings->show_date ) ) ? $this->settings->show_date : 'yes';

		if ( 'yes' == $show_meta && ( 'yes' == $show_author || 'yes' == $show_categories || 'yes' == $show_tags || 'yes' == $show_comments || 'yes' == $show_date ) ) {
			$meta_flag = true;
		} else {
			$meta_flag = false;
		}
		$img_html = '';
		if ( substr( $this->settings->layout_sort_order, 0, 3 ) != 'img' && substr( $this->settings->layout_sort_order, -3 ) != 'img' ) {
			$img_html = $this->render_featured_image( 'top', $obj, $i );
		}

		if ( 'yes' == $show_title || 'yes' == $show_excerpt || 'none' != $this->settings->cta_type || $meta_flag || '' != $img_html ) {
			?>
		<div class="uabb-blog-post-content">
			<?php
			$layout_sequence = explode( ',', $this->settings->layout_sort_order );

			foreach ( $layout_sequence as $sq ) {
				switch ( $sq ) {
					case 'img':
						if ( substr( $this->settings->layout_sort_order, 0, 3 ) != 'img' && substr( $this->settings->layout_sort_order, -3 ) != 'img' ) {
							echo $this->render_featured_image( 'top', $obj, $i );
						}
						break;
					case 'title':
						do_action( 'uabb_blog_posts_before_title', $obj->ID, $this->settings );
						$this->render_title_section( $obj );
						do_action( 'uabb_blog_posts_after_title', $obj->ID, $this->settings );
						break;

					case 'content':
						do_action( 'uabb_blog_posts_before_content', $obj->ID, $this->settings );
						$this->render_content_section( $obj );
						do_action( 'uabb_blog_posts_after_content', $obj->ID, $this->settings );
						break;

					case 'meta':
						do_action( 'uabb_blog_posts_before_meta', $obj->ID, $this->settings );
						$this->render_meta_section( $obj );
						do_action( 'uabb_blog_posts_after_meta', $obj->ID, $this->settings );
						break;

					case 'cta':
						$this->render_button( $link, $this->settings->link_target );
						break;

					default:
						// Nothing to do here.
						break;
				}
			}
			?>
		</div>
			<?php
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/blog-posts/blog-posts-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/blog-posts/blog-posts-bb-less-than-2-2-compatibility.php';
}

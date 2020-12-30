<?php
/**
 *  Off Canvas Module file
 *
 *  @package Off Canvas Module
 */

/**
 * Function that initializes UABB Off Canvas Module
 *
 * @class UABBOffCanvasModule
 */
class UABBOffCanvasModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Price List Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Off-Canvas', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-off-canvas/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-off-canvas/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true, // Defaults to false and can be omitted.
				'icon'            => 'offcanvas.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the offcanvas
	 *
	 * @since 1.19.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-off-canvas/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-off-canvas/icon/' . $icon );
		}
		return '';
	}
	/**
	 * Function that renders the menus
	 *
	 * @since 1.19.0
	 * @method render_menus
	 */
	public static function render_menus() {
		$nav_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$fields    = array(
			'type'   => 'select',
			'label'  => __( 'Menu', 'uabb' ),
			'helper' => __( 'Select a WordPress menu that you created in the admin under Appearance > Menus.', 'uabb' ),
		);

		if ( $nav_menus ) {

			foreach ( $nav_menus as $key => $menu ) {

				if ( 0 === $key ) {
					$fields['default'] = $menu->name;
				}

				$menus[ $menu->slug ] = $menu->name;
			}

			$fields['options'] = $menus;

		} else {
			$fields['options'] = array( '' => __( 'No Menus Found', 'uabb' ) );
		}

		return $fields;
	}
	/**
	 * Function that renders the menus
	 *
	 * @since 1.19.0
	 * @param object $settings gets the settings for menu.
	 * @method get_modal_content
	 */
	public function get_modal_content( $settings ) {

		$content_type = $settings->content_type;

		switch ( $content_type ) {
			case 'content':
				global $wp_embed;
				return '<div class="uabb-text-editor uabb-offcanvas-text-content" >' . wpautop( $wp_embed->autoembed( $settings->ct_content ) ) . '</div>';
			case 'saved_rows':
				return '[fl_builder_insert_layout id="' . $settings->ct_saved_rows . '" type="fl-builder-template"]';
			case 'saved_modules':
				return '[fl_builder_insert_layout id="' . $settings->ct_saved_modules . '" type="fl-builder-template"]';
			case 'saved_page_templates':
				return '[fl_builder_insert_layout id="' . $settings->ct_page_templates . '" type="fl-builder-template"]';
			case 'menu':
				return $this->get_menu( $settings );
			default:
				return;
		}
	}
	/**
	 * Renders menu
	 *
	 * @since 1.19.0
	 * @method get_menu
	 * @param object $settings gets the settings for menu.
	 */
	public function get_menu( $settings ) {
		do_action( 'uabb_off_canvas_menu_before', $settings );
		?>
		<?php
		if ( ! empty( $settings->wp_menu ) ) {

			$defaults = array(
				'menu'       => $settings->wp_menu,
				'container'  => false,
				'menu_class' => 'uabb-offcanvas-menu',
				'walker'     => new Creative_Menu_Walker( $settings ),
			);

			wp_nav_menu( $defaults );
		}
		do_action( 'uabb_off_canvas_menu_before', $settings );
	}
	/**
	 * Render Button
	 *
	 * @since 1.19.0
	 * @param var $module_id gets the id of the module.
	 */
	public function render_button( $module_id ) {

		$btn_settings = array(

			/* General Section */
			'text'                                       => $this->settings->btn_text,

			/* Link Section */
			'link'                                       => 'javascript:void(0)',
			'link_target'                                => '_self',
			/* Style Section */
			'style'                                      => $this->settings->btn_style,
			'border_size'                                => $this->settings->btn_border_size,
			'transparent_button_options'                 => $this->settings->btn_transparent_button_options,
			'threed_button_options'                      => $this->settings->btn_threed_button_options,

			/* Colors */
			'bg_color'                                   => $this->settings->btn_bg_color,
			'bg_hover_color'                             => $this->settings->btn_bg_hover_color,
			'text_color'                                 => $this->settings->btn_text_color,
			'text_hover_color'                           => $this->settings->btn_text_hover_color,

			/* Icon */
			'icon'                                       => $this->settings->btn_icon,
			'icon_position'                              => $this->settings->btn_icon_position,

			/* Structure */
			'width'                                      => $this->settings->btn_width,
			'custom_width'                               => $this->settings->btn_custom_width,
			'custom_height'                              => $this->settings->btn_custom_height,
			'padding_top_bottom'                         => $this->settings->btn_padding_top_bottom,
			'padding_left_right'                         => $this->settings->btn_padding_left_right,
			'border_radius'                              => $this->settings->btn_border_radius,
			'align'                                      => $this->settings->btn_align,
			'mob_align'                                  => $this->settings->btn_mob_align,

			'a_data'                                     => 'data-modal=' . $module_id . ' ',
			'a_class'                                    => 'uabb-offcanvas-trigger',
			'button_padding_dimension_top'               => ( isset( $this->settings->button_padding_dimension_top ) ) ? $this->settings->button_padding_dimension_top : '',
			'button_padding_dimension_left'              => ( isset( $this->settings->button_padding_dimension_left ) ) ? $this->settings->button_padding_dimension_left : '',
			'button_padding_dimension_bottom'            => ( isset( $this->settings->button_padding_dimension_bottom ) ) ? $this->settings->button_padding_dimension_bottom : '',
			'button_padding_dimension_right'             => ( isset( $this->settings->button_padding_dimension_right ) ) ? $this->settings->button_padding_dimension_right : '',
			'button_padding_dimension_top_medium'        => ( isset( $this->settings->button_padding_dimension_top_medium ) ) ? $this->settings->button_padding_dimension_top_medium : '',
			'button_padding_dimension_left_medium'       => ( isset( $this->settings->button_padding_dimension_left_medium ) ) ? $this->settings->button_padding_dimension_left_medium : '',
			'button_padding_dimension_bottom_medium'     => ( isset( $this->settings->button_padding_dimension_bottom_medium ) ) ? $this->settings->button_padding_dimension_bottom_medium : '',
			'button_padding_dimension_right_medium'      => ( isset( $this->settings->button_padding_dimension_right_medium ) ) ? $this->settings->button_padding_dimension_right_medium : '',
			'button_padding_dimension_top_responsive'    => ( isset( $this->settings->button_padding_dimension_top_responsive ) ) ? $this->settings->button_padding_dimension_top_responsive : '',
			'button_padding_dimension_left_responsive'   => ( isset( $this->settings->button_padding_dimension_left_responsive ) ) ? $this->settings->button_padding_dimension_left_responsive : '',
			'button_padding_dimension_bottom_responsive' => ( isset( $this->settings->button_padding_dimension_bottom_responsive ) ) ? $this->settings->button_padding_dimension_bottom_responsive : '',
			'button_padding_dimension_right_responsive'  => ( isset( $this->settings->button_padding_dimension_right_responsive ) ) ? $this->settings->button_padding_dimension_right_responsive : '',
			'button_border'                              => ( isset( $this->settings->button_border ) ) ? $this->settings->button_border : '',
			'border_hover_color'                         => ( isset( $this->settings->border_hover_color ) ) ? $this->settings->border_hover_color : '',
		);
		FLBuilder::render_module_html( 'uabb-button', $btn_settings );
	}
	/**
	 * Render Button
	 *
	 * @since 1.19.0
	 * @param var $node gets the id of the module.
	 */
	public function render( $node ) {

		$offcanvas_position = isset( $this->settings->offcanvas_position ) ? 'at-' . $this->settings->offcanvas_position : '';
		?>
			<div class="uabb-offcanvas-<?php echo esc_attr( $node ); ?> uabb-offcanvas-parent-wrapper">
				<div id="offcanvas-<?php echo esc_attr( $node ); ?>" class="uabb-offcanvas uabb-custom-offcanvas uabb-offcanvas-position-<?php echo esc_attr( $offcanvas_position ); ?> uabb-offcanvas-type-<?php echo esc_attr( $this->settings->offcanvas_type ); ?>">
					<div class="uabb-offcanvas-content">
						<div class="uabb-offcanvas-action-wrap">
							<?php echo wp_kses_post( $this->render_close_icon() ); ?>
						</div>
						<div class="uabb-offcanvas-text uabb-offcanvas-content-data">
							<?php echo $this->get_modal_content( $this->settings ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</div>
				</div>
				<div class="uabb-offcanvas-overlay "></div>
			</div>
		<?php
	}
	/**
	 * Render Close Icon
	 *
	 * @since 1.19.0
	 */
	public function render_close_icon() {

		$close_position = '';

		$close_position = 'uabb-offcanvas-close-icon-position-' . $this->settings->close_inside_icon_position;
		?>
		<div class="uabb-offcanvas-close-icon-wrapper <?php echo esc_attr( $close_position ); ?>">
			<span class="uabb-offcanvas-close">
				<?php
				if ( '' !== $this->settings->close_icon ) {
					echo '<i class="uabb-offcanvas-close-icon ' . esc_attr( $this->settings->close_icon ) . '"></i>';
				} else {
					?>
					<svg class="uabb-offcanvas-close-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
						<path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
					</svg>
				<?php } ?>
			</span>
		</div>
		<?php
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-off-canvas/uabb-off-canvas-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-off-canvas/uabb-off-canvas-bb-less-than-2-2-compatibility.php';
}

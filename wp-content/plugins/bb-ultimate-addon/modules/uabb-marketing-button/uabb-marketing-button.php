<?php
/**
 *  UABB Marketing Button Module file
 *
 *  @package UABB Button Module
 */

/**
 * Function that initializes UABB Button Module
 *
 * @class UABBMarketingButtonModule
 */
class UABBMarketingButtonModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Button Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Marketing Button', 'uabb' ),
				'description'     => __( 'A simple call to action button.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-marketing-button/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-marketing-button/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true,
				'icon'            => 'marketing-button.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the Info Circle
	 *
	 * @since 1.11.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-marketing-button/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-marketing-button/icon/' . $icon;
		}
		if ( file_exists( $path ) ) {
			$remove_icon = apply_filters( 'uabb_remove_svg_icon', false, 10, 1 );
			if ( true === $remove_icon ) {
				return;
			} else {
				return file_get_contents( $path );
			}
		} else {
			return '';
		}
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.16.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::Check_BB_Version();
		$page_migrated           = UABB_Compatibility::Check_Old_Page_Migration();
		$stable_version_new_page = UABB_Compatibility::Check_Stable_Version_New_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Handle color opacity fields.
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );

			if ( ! isset( $settings->button_typo ) || ! is_array( $settings->button_typo ) ) {
				$settings->button_typo            = array();
				$settings->button_typo_medium     = array();
				$settings->button_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->button_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->button_typo['font_weight'] = 'normal';
					} else {
						$settings->button_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->button_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->button_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {
				$settings->button_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->button_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->button_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->button_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->button_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->button_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			if ( isset( $settings->align ) ) {
				$settings->new_align = $settings->align;
				unset( $settings->align );
			}
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' == $settings->link_nofollow || 'yes' == $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}
			if ( ! isset( $settings->button_typo_subtitle ) || ! is_array( $settings->button_typo_subtitle ) ) {
				$settings->button_typo_subtitle            = array();
				$settings->button_typo_subtitle_medium     = array();
				$settings->button_typo_subtitle_responsive = array();
			}
			if ( isset( $settings->subtitle_font_family ) ) {

				if ( isset( $settings->subtitle_font_family['family'] ) ) {

					$settings->button_typo_subtitle['font_family'] = $settings->subtitle_font_family['family'];
					unset( $settings->subtitle_font_family['family'] );
				}
				if ( isset( $settings->subtitle_font_family['weight'] ) ) {

					if ( 'regular' == $settings->subtitle_font_family['weight'] ) {
						$settings->button_typo_subtitle['font_weight'] = 'normal';
					} else {
						$settings->button_typo_subtitle['font_weight'] = $settings->subtitle_font_family['weight'];
					}
					unset( $settings->subtitle_font_family['weight'] );
				}
			}
			if ( isset( $settings->subtitle_font_size_unit ) ) {

				$settings->button_typo_subtitle['font_size'] = array(
					'length' => $settings->subtitle_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->subtitle_font_size_unit );
			}
			if ( isset( $settings->subtitle_font_size_unit_medium ) ) {
				$settings->button_typo_subtitle_medium['font_size'] = array(
					'length' => $settings->subtitle_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->subtitle_font_size_unit_medium );
			}
			if ( isset( $settings->subtitle_font_size_unit_responsive ) ) {
				$settings->button_typo_subtitle_responsive['font_size'] = array(
					'length' => $settings->subtitle_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->subtitle_font_size_unit_responsive );
			}
			if ( isset( $settings->subtitle_line_height_unit ) ) {

				$settings->button_typo_subtitle['line_height'] = array(
					'length' => $settings->subtitle_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->subtitle_line_height_unit );
			}
			if ( isset( $settings->subtitle_line_height_unit_medium ) ) {
				$settings->button_typo_subtitle_medium['line_height'] = array(
					'length' => $settings->subtitle_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->subtitle_line_height_unit_medium );
			}
			if ( isset( $settings->subtitle_line_height_unit_responsive ) ) {
				$settings->button_typo_subtitle_responsive['line_height'] = array(
					'length' => $settings->subtitle_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->subtitle_line_height_unit_responsive );
			}
			if ( isset( $settings->subtitle_transform ) ) {
				$settings->button_typo_subtitle['text_transform'] = $settings->subtitle_transform;
				unset( $settings->subtitle_transform );
			}
			if ( isset( $settings->subtitle_transform ) ) {
				$settings->button_typo_subtitle['letter_spacing'] = array(
					'length' => $settings->subtitle_transform,
					'unit'   => 'px',
				);
				unset( $settings->subtitle_transform );
			}
		}
		return $settings;
	}

	/**
	 * Render Button HTML.
	 *
	 * @since 1.16.0
	 * @access public
	 */
	public function render_button() {
		$custom_class    = '';
		$animation_class = '';
		$astra_class     = '';

		if ( isset( $this->settings->custom_class ) ) {
			$custom_class = $this->settings->custom_class;
		}
		if ( isset( $this->settings->hover_animation ) && '' !== $this->settings->hover_animation ) {
			$animation_class = 'uabb-marketing-button-animation-' . $this->settings->hover_animation;
		}
		if ( 'default' === $this->settings->style ) {
			$astra_class = 'ast-button';
		}
		?>
		<div class="uabb-marketing-button uabb-module-content <?php echo $this->get_classname(); ?>">
			<a href ="<?php echo $this->settings->link; ?>" target="<?php echo $this->settings->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $this->settings->link_target, $this->settings->link_nofollow, 1 ); ?> class="uabb-button uabb-marketing-button  <?php echo $animation_class; ?> uabb-marketing-button-wrap-<?php echo $this->settings->icon_position; ?> <?php echo $custom_class; ?> uabb-marketing-btn__link <?php echo $astra_class; ?>">
				<?php
					echo $this->render_html();
				?>
			</a>
		</div>
		<?php
	}

	/**
	 * Render Button Text.
	 *
	 * @since 1.16.0
	 * @access public
	 */
	public function render_html() {
		if ( 'all_before' === $this->settings->icon_position || 'all_after' === $this->settings->icon_position ) {
			?>
			<?php if ( isset( $this->settings->icon ) && '' !== $this->settings->icon ) { ?>
				<div class="uabb-marketing-button-icon uabb-align-icon-<?php echo $this->settings->icon_position; ?> uabb-marketing-button-icon-<?php echo $this->settings->icon_position; ?>" >
						<i class="uabb-button-icon uabb-marketing-button-icon <?php echo $this->settings->icon_position; ?> <?php echo $this->settings->icon; ?>"></i>
				</div>
			<?php } ?>
			<div class="uabb-marketing-buttons-wrap">
				<?php if ( isset( $this->settings->title ) && '' !== $this->settings->title ) { ?>
					<div class="uabb-button-content-wrapper uabb-marketing-title uabb-buttons-icon-<?php echo $this->settings->icon_position; ?>">
						<?php echo $this->settings->title; ?>
					</div>
				<?php } ?>
				<?php if ( isset( $this->settings->sub_title ) && '' !== $this->settings->sub_title ) { ?>
					<div class="uabb-marketing-subheading uabb-marketing-button-text">
						<?php echo $this->settings->sub_title; ?>
					</div>
				<?php } ?>
			</div>
			<?php
		} elseif ( 'before' === $this->settings->icon_position || 'after' === $this->settings->icon_position ) {
			?>
				<div class="uabb-marketing-buttons-wrap">
					<div class="uabb-marketing-buttons-contentwrap uabb-marketing-button-icon-<?php echo $this->settings->icon_position; ?>">
							<?php if ( isset( $this->settings->icon ) && '' !== $this->settings->icon ) { ?>
								<span class="uabb-marketing-buttons-icon-innerwrap uabb-marketing-button-icon-<?php echo $this->settings->icon_position; ?>">
									<i class="uabb-button-icon uabb-marketing-button-icon-<?php echo $this->settings->icon_position; ?> <?php echo $this->settings->icon; ?>"></i>
								</span>
							<?php } ?>
						<?php if ( isset( $this->settings->title ) && '' !== $this->settings->title ) { ?>
							<span class="uabb-marketing-buttons-title-innerwrap uabb-marketing-title uabb-button-text uabb-marketing-title ">
								<?php echo $this->settings->title; ?>
							</span>
						<?php } ?>
					</div>
					<div class="uabb-marketing-buttons-desc-innerwrap">
						<?php if ( isset( $this->settings->sub_title ) && '' !== $this->settings->sub_title ) { ?>
							<span class="uabb-marketing-subheading uabb-marketing-button-text">
								<?php echo $this->settings->sub_title; ?>
							</span>
						<?php } ?>
					</div>
				</div>
			<?php
		}
	}

	/**
	 * Function that gets the class names
	 *
	 * @since 1.16.0
	 * @method get_classname
	 */
	public function get_classname() {
		$classname = 'uabb-button-wrap uabb-marketing-button-wrap';

		if ( ! empty( $this->settings->width ) ) {
			$classname .= ' uabb-marketing-button-width-' . $this->settings->width;
		}
		if ( ! UABB_Compatibility::Check_BB_Version() ) {
			if ( ! empty( $this->settings->align ) ) {
				$classname .= ' uabb-marketing-button-' . $this->settings->align;
			}
			if ( ! empty( $this->settings->mob_align ) ) {
				$classname .= ' uabb-marketing-button-reponsive-' . $this->settings->mob_align;
			}
		} else {
			if ( ! empty( $this->settings->new_align ) ) {
				$classname .= ' uabb-marketing-button-' . $this->settings->new_align;
			}
			if ( ! empty( $this->settings->mob_align ) ) {
				$classname .= ' uabb-marketing-button-reponsive-' . $this->settings->mob_align;
			}
		}
		return $classname;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::Check_BB_Version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-marketing-button/uabb-marketing-button-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-marketing-button/uabb-marketing-button-bb-less-than-2-2-compatibility.php';
}

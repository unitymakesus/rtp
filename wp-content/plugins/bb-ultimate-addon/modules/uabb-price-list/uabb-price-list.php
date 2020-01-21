<?php
/**
 *  UABB Price List Module file
 *
 *  @package UABB Price List Module
 */

/**
 * Function that initializes Price List Module
 *
 * @class UABBPriceList
 */
class UABBPriceList extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Price List Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Price List', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-price-list/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-price-list/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => true, // Defaults to false and can be omitted.
				'icon'            => 'price-list.svg',
			)
		);
	}

	/**
	 * Function to get the icon for the Price List
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-price-list/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-price-list/icon/' . $icon;
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
	 * @since 1.15.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// List link settings.
			foreach ( $settings->add_price_list_item as $price_list_item ) {

				if ( isset( $price_list_item->price_list_item_url ) ) {
					if ( isset( $price_list_item->price_list_item_url_nofollow ) ) {
						$price_list_item->price_list_item_url_nofollow = ( '1' == $price_list_item->price_list_item_url_nofollow ) ? 'yes' : '';
					}
				}
			}

			// Handle old border settings.
			if ( ! isset( $settings->price_border ) || empty( $settings->price_border ) ) {

				$settings->price_border = array();

				// Border style, color, and width.
				if ( isset( $settings->price_list_border_type ) ) {

					$settings->price_border['style'] = $settings->price_list_border_type;
					unset( $settings->price_list_border_type );
				}

				if ( isset( $settings->price_list_border_width ) ) {

					$settings->price_border['width'] = array(
						'top'    => $settings->price_list_border_width,
						'right'  => $settings->price_list_border_width,
						'bottom' => $settings->price_list_border_width,
						'left'   => $settings->price_list_border_width,
					);

					unset( $settings->price_list_border_width );
				}

				if ( isset( $settings->price_list_border_color ) && ! empty( $settings->price_list_border_color ) ) {

					$settings->price_border['color'] = $settings->price_list_border_color;
					unset( $settings->price_list_border_color );
				}
			}
			// compatibility for price list title typography.
			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {

				if ( isset( $settings->heading_font_family['family'] ) ) {

					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];
					unset( $settings->heading_font_family['family'] );
				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {

					if ( 'regular' == $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
					unset( $settings->heading_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size_unit ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit );
			}
			if ( isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_medium );
			}
			if ( isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_responsive );
			}
			if ( isset( $settings->heading_line_height_unit ) ) {

				$settings->heading_font_typo['line_height'] = array(
					'length' => $settings->heading_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit );
			}
			if ( isset( $settings->heading_line_height_unit_medium ) ) {
				$settings->heading_font_typo_medium['line_height'] = array(
					'length' => $settings->heading_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_medium );
			}
			if ( isset( $settings->heading_line_height_unit_responsive ) ) {
				$settings->heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_responsive );
			}
			if ( isset( $settings->heading_transform ) ) {

				$settings->heading_font_typo['text_transform'] = $settings->heading_transform;
				unset( $settings->heading_transform );
			}
			if ( isset( $settings->heading_letter_spacing ) ) {

				$settings->heading_font_typo['letter_spacing'] = array(
					'length' => $settings->heading_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->heading_letter_spacing );
			}

			// For Description Typo.
			if ( ! isset( $settings->description_font_typo ) || ! is_array( $settings->description_font_typo ) ) {

				$settings->description_font_typo            = array();
				$settings->description_font_typo_medium     = array();
				$settings->description_font_typo_responsive = array();
			}
			if ( isset( $settings->description_font_family ) ) {

				if ( isset( $settings->description_font_family['family'] ) ) {

					$settings->description_font_typo['font_family'] = $settings->description_font_family['family'];
					unset( $settings->description_font_family['family'] );
				}
				if ( isset( $settings->description_font_family['weight'] ) ) {

					if ( 'regular' == $settings->description_font_family['weight'] ) {
						$settings->description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->description_font_typo['font_weight'] = $settings->description_font_family['weight'];
					}
					unset( $settings->description_font_family['weight'] );
				}
			}
			if ( isset( $settings->description_font_size_unit ) ) {

				$settings->description_font_typo['font_size'] = array(
					'length' => $settings->description_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit );
			}
			if ( isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit_medium );
			}
			if ( isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit_responsive );
			}
			if ( isset( $settings->description_line_height_unit ) ) {

				$settings->description_font_typo['line_height'] = array(
					'length' => $settings->description_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit );
			}
			if ( isset( $settings->description_line_height_unit_medium ) ) {
				$settings->description_font_typo_medium['line_height'] = array(
					'length' => $settings->description_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit_medium );
			}
			if ( isset( $settings->description_line_height_unit_responsive ) ) {
				$settings->description_font_typo_responsive['line_height'] = array(
					'length' => $settings->description_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit_responsive );
			}
			if ( isset( $settings->description_transform ) ) {

				$settings->description_font_typo['text_transform'] = $settings->description_transform;
				unset( $settings->description_transform );
			}
			if ( isset( $settings->description_letter_spacing ) ) {

				$settings->description_font_typo['letter_spacing'] = array(
					'length' => $settings->description_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->description_letter_spacing );
			}

			// For Price Typography.
			if ( ! isset( $settings->price_font_typo ) || ! is_array( $settings->price_font_typo ) ) {

				$settings->price_font_typo            = array();
				$settings->price_font_typo_medium     = array();
				$settings->price_font_typo_responsive = array();
			}
			if ( isset( $settings->price_font_family ) ) {

				if ( isset( $settings->price_font_family['family'] ) ) {

					$settings->price_font_typo['font_family'] = $settings->price_font_family['family'];
					unset( $settings->price_font_family['family'] );
				}
				if ( isset( $settings->price_font_family['weight'] ) ) {

					if ( 'regular' == $settings->price_font_family['weight'] ) {
						$settings->price_font_typo['font_weight'] = 'normal';
					} else {
						$settings->price_font_typo['font_weight'] = $settings->price_font_family['weight'];
					}
					unset( $settings->price_font_family['weight'] );
				}
			}
			if ( isset( $settings->price_font_size_unit ) ) {

				$settings->price_font_typo['font_size'] = array(
					'length' => $settings->price_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size_unit );
			}
			if ( isset( $settings->price_font_size_unit_medium ) ) {
				$settings->price_font_typo_medium['font_size'] = array(
					'length' => $settings->price_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size_unit_medium );
			}
			if ( isset( $settings->price_font_size_unit_responsive ) ) {
				$settings->price_font_typo_responsive['font_size'] = array(
					'length' => $settings->price_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->price_font_size_unit_responsive );
			}
			if ( isset( $settings->price_line_height_unit ) ) {

				$settings->price_font_typo['line_height'] = array(
					'length' => $settings->price_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height_unit );
			}
			if ( isset( $settings->price_line_height_unit_medium ) ) {
				$settings->price_font_typo_medium['line_height'] = array(
					'length' => $settings->price_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height_unit_medium );
			}
			if ( isset( $settings->price_line_height_unit_responsive ) ) {
				$settings->price_font_typo_responsive['line_height'] = array(
					'length' => $settings->price_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->price_line_height_unit_responsive );
			}
			if ( isset( $settings->price_letter_spacing ) ) {

				$settings->price_font_typo['letter_spacing'] = array(
					'length' => $settings->price_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->price_letter_spacing );
			}
		}

		return $settings;
	}

	/**
	 *  Render HTML.
	 *
	 *  @since 1.15.0
	 */
	public function render() {
		?>

		<div class="uabb-price-list uabb-price-list-<?php echo $this->settings->image_position; ?> uabb-pl-price-position-<?php echo ( 'top' !== $this->settings->image_position ) ? $this->settings->price_position : ''; ?>">
			<?php
			foreach ( $this->settings->add_price_list_item  as $index => $item ) {
				?>
					<div class="uabb-price-list-item uabb-price-list-animation-<?php echo $this->settings->price_list_hover_animation; ?>">
						<div class="uabb-price-list-image">
							<?php if ( 'library' == $item->image_type && isset( $item->photo ) && ! empty( $item->photo_src ) ) { ?>
								<img src=" <?php echo $item->photo_src; ?>">
							<?php } ?>
							<?php if ( 'url' == $item->image_type && isset( $item->photo ) && ! empty( $item->photo_url ) ) { ?>
								<img src=" <?php echo $item->photo_url; ?>">
							<?php } ?>
						</div>
						<div class="uabb-price-list-text">
							<div class="uabb-price-list-header">
								<?php echo $this->render_item_header( $item ); ?>
									<span>
										<?php echo $item->price_list_item_title; ?>
									</span>
								<?php
								echo $this->render_item_footer( $item );
								if ( 'top' !== $this->settings->image_position && 'below' !== $this->settings->price_position ) {
									?>
									<span class="uabb-price-list-separator"></span>
									<?php
								}
								if ( 'below' != $this->settings->price_position && 'top' != $this->settings->image_position ) {
										$this->get_price( $item, 'inner' );
								}
								?>
							</div>
							<?php if ( '' != $item->price_list_item_description ) { ?>
								<div class="uabb-price-list-description" >
								<?php echo $item->price_list_item_description; ?>
								</div> 
							<?php } ?>
							<?php
							$this->get_price( $item, 'outer' );
							?>
						</div>
					</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	/**
	 * Renders header for link.
	 *
	 * @param string $item link attributes.
	 * @since 1.15.0
	 * @access public
	 */
	public function render_item_header( $item ) {

		if ( '' !== $item->price_list_item_url ) {
			?>

			<a href ="<?php echo $item->price_list_item_url; ?>" target="<?php echo $item->price_list_item_url_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $item->price_list_item_url_target, $item->price_list_item_url_nofollow, 1 ); ?> class="uabb-price-list-title">

		<?php } else { ?>
			<div class="uabb-price-list-title">
			<?php
}
	}
	/**
	 *  Render footer for link HTML.
	 *
	 *  @param string $item link attributes.
	 *  @since 1.15.0
	 */
	public function render_item_footer( $item ) {

		if ( $item->price_list_item_url ) {
				return '</a>';
		} else {
			return '</div>';
		}
	}
	/**
	 *  Render Price HTML.
	 *
	 *  @param integer $item current item index.
	 *  @param integer $pos current items price position.
	 *  @since 1.15.0
	 */
	public function get_price( $item, $pos ) {

		$price_pos = 'uabb-pl-price-' . $pos;

		if ( 'yes' == $item->discount_offer ) {
			$price_item_cls = 'has-discount';
			$original_price = $item->original_price;
		} else {
			$price_item_cls = '';
			$original_price = $item->price;
		}
		?>
		<span class="uabb-price-wrapper  <?php echo $price_pos; ?>">
			<span class="uabb-price-list-price <?php echo $price_item_cls; ?>"><?php echo $original_price; ?></span>
			<?php if ( 'yes' == $item->discount_offer ) { ?>
				<span class="uabb-price-list-price"><?php echo $item->price; ?></span>
			<?php } ?>
		</span>	
		<?php
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-price-list/uabb-price-list-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-price-list/uabb-price-list-bb-less-than-2-2-compatibility.php';
}

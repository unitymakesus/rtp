<?php
/**
 *  UABB Photo Gallery Module file
 *
 *  @package UABB Photo Gallery Module
 */

/**
 * Function that initializes Photo Gallery Module
 *
 * @class UABBPhotoGalleryModule
 */
class UABBPhotoGalleryModule extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Photo Gallery Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Photo Gallery', 'uabb' ),
				'description'     => __( 'Display multiple photos in a gallery view.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/photo-gallery/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/photo-gallery/',
				'editor_export'   => false,
				'partial_refresh' => true,
				'icon'            => 'format-gallery.svg',
			)
		);

		$this->add_js( 'jquery-magnificpopup' );
		$this->add_css( 'jquery-magnificpopup' );
		$this->add_js( 'jquery-masonry' );
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
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'caption_bg_color_opc', 'caption_bg_color' );

			if ( ! isset( $settings->caption_font_typo ) || ! is_array( $settings->caption_font_typo ) ) {

				$settings->caption_font_typo            = array();
				$settings->caption_font_typo_medium     = array();
				$settings->caption_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {
				if ( isset( $settings->font_family['family'] ) ) {
					$settings->caption_font_typo['font_family'] = $settings->font_family['family'];
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->caption_font_typo['font_weight'] = 'normal';
					} else {
						$settings->caption_font_typo['font_weight'] = $settings->font_family['weight'];
					}
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->caption_font_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);

			}
			if ( isset( $settings->font_size_unit_medium ) ) {

				$settings->caption_font_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {

				$settings->caption_font_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->caption_font_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->line_height_unit_medium ) ) {

				$settings->caption_font_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {

				$settings->caption_font_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
			}
			if ( isset( $settings->transform ) ) {

				$settings->caption_font_typo['text_transform'] = $settings->transform;

			}
			if ( isset( $settings->letter_spacing ) ) {

				$settings->caption_font_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_family ) ) {
				unset( $settings->font_family );
				unset( $settings->font_size_unit );
				unset( $settings->font_size_unit_medium );
				unset( $settings->font_size_unit_responsive );
				unset( $settings->line_height_unit );
				unset( $settings->line_height_unit_medium );
				unset( $settings->line_height_unit_responsive );
				unset( $settings->transform );
				unset( $settings->letter_spacing );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'overlay_color_opc', 'overlay_color' );
			$helper->handle_opacity_inputs( $settings, 'caption_bg_color_opc', 'caption_bg_color' );

			if ( ! isset( $settings->caption_font_typo ) || ! is_array( $settings->caption_font_typo ) ) {

				$settings->caption_font_typo            = array();
				$settings->caption_font_typo_medium     = array();
				$settings->caption_font_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {
					$settings->caption_font_typo['font_family'] = $settings->font_family['family'];
				}
				if ( isset( $settings->font_family['weight'] ) ) {
					if ( 'regular' == $settings->font_family['weight'] ) {
						$settings->caption_font_typo['font_weight'] = 'normal';
					} else {
						$settings->caption_font_typo['font_weight'] = $settings->font_family['weight'];
					}
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				$settings->caption_font_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				$settings->caption_font_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) ) {
				$settings->caption_font_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 != $settings->font_size['desktop'] ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->caption_font_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 != $settings->font_size['medium'] ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->caption_font_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 != $settings->font_size['small'] ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->caption_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->font_family ) ) {
				unset( $settings->font_family );
				unset( $settings->font_size );
				unset( $settings->line_height );
			}
		}
		return $settings;
	}
	/**
	 * Function that updates the WordPress Photos
	 *
	 * @method update
	 * @param object $settings gets the object for the module.
	 */
	public function update( $settings ) {
		// Cache the photo data if using the WordPress media library.
		$settings->photo_data = $this->get_wordpress_photos();

		return $settings;
	}

	/**
	 * Function that gets the photos
	 *
	 * @method get_photos
	 */
	public function get_photos() {
		$default_order = $this->get_wordpress_photos();
		$photos_id     = array();
		// WordPress.
		if ( 'random' == $this->settings->photo_order && is_array( $default_order ) ) {

			$keys = array_keys( $default_order );
			shuffle( $keys );

			foreach ( $keys as $key ) {
				$photos_id[ $key ] = $default_order[ $key ];
			}
		} else {
			$photos_id = $default_order;
		}

		return $photos_id;

	}

	/**
	 * Function that gets the WordPress Photos
	 *
	 * @method get_wordpress_photos
	 */
	public function get_wordpress_photos() {
		$photos   = array();
		$ids      = $this->settings->photos;
		$medium_w = get_option( 'medium_size_w' );
		$large_w  = get_option( 'large_size_w' );

		/* Template Cache */
		$photo_from_template   = false;
		$photo_attachment_data = false;

		if ( empty( $this->settings->photos ) ) {
			return $photos;
		}

		/* Check if all photos are available on host */
		foreach ( $ids as $id ) {
			$photo_attachment_data[ $id ] = FLBuilderPhoto::get_attachment_data( $id );

			if ( ! $photo_attachment_data[ $id ] ) {
				$photo_from_template = true;
			}
		}

		foreach ( $ids as $id ) {

			$photo = $photo_attachment_data[ $id ];

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo && $photo_from_template ) {

				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				} elseif ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				} elseif ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				} else {
					continue;
				}
			}

			// Only use photos who have the sizes object.
			if ( isset( $photo->sizes ) ) {

				$data = new stdClass();

				// Photo data object.
				$data->id          = $id;
				$data->alt         = $photo->alt;
				$data->caption     = $photo->caption;
				$data->description = $photo->description;
				$data->title       = $photo->title;

				$photo_size = $this->settings->photo_size;

				$photo->sizes = (array) ( $photo->sizes );

				if ( -1 != $id && '' != $id ) {
					if ( isset( $photo_size ) ) {
						$temp      = wp_get_attachment_image_src( $id, $photo_size );
						$data->src = $temp[0];
					}
				}

				// Photo Link.
				if ( isset( $photo->sizes['full'] ) ) {
					$data->link = $photo->sizes['full']->url;
				} else {
					$data->link = $photo->sizes['large']->url;
				}

				// Push the photo data.
				/* Add Custom field attachment data to object */
				$cta_link       = get_post_meta( $id, 'uabb-cta-link', true );
				$data->cta_link = $cta_link;

				$photos[ $id ] = $data;
			}
		}

		return $photos;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/photo-gallery/photo-gallery-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/photo-gallery/photo-gallery-bb-less-than-2-2-compatibility.php';
}

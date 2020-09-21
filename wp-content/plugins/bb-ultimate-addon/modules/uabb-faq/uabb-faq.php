<?php
/**
 *  UABB FAQ module file
 *
 *  @package UABB FAQ
 */

/**
 * Function that initializes UABB FAQ Module
 *
 * @class UABBFAQModule
 */
class UABBFAQModule extends FLBuilderModule {

	/**
	 * Checks if schema is rendered.
	 *
	 * @var $is_schema_rendered
	 */
	private $is_schema_rendered = false;

	/**
	 * Constructor function that constructs default values for the FAQ module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'FAQ Schema', 'uabb' ),
				'description'     => __( 'FAQ Schema', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-faq/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-faq/',
				'partial_refresh' => true,
				'icon'            => 'faq.svg',
			)
		);

		$this->add_css( 'font-awesome-5' );
	}

	/**
	 * Render schema markup.
	 *
	 * @param boolean $return checks if return schema data.
	 */
	public function render_schema( $return = false ) {
		global $uabb_faq_schema_items;

		$settings      = $this->settings;
		$enable_schema = true;

		if ( isset( $settings->enable_schema ) && 'no' === $settings->enable_schema ) {
			$enable_schema = false;
		}

		if ( ! $enable_schema ) {
			return;
		}

		if ( $this->is_schema_rendered ) {
			return;
		}

		$schema_data = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array(),
		);

		$items = $this->get_faq_items();

		$count = count( $items );

		for ( $i = 0; $i < $count; $i++ ) {
			if ( ! is_object( $items[ $i ] ) ) {
				continue;
			}

			$item = (object) array(
				'@type'          => 'Question',
				'name'           => $items[ $i ]->faq_question,
				'acceptedAnswer' => (object) array(
					'@type' => 'Answer',
					'text'  => $items[ $i ]->faq_answer,
				),
			);

			$schema_data['mainEntity'][] = $item;
		}

		$uabb_faq_schema_items[] = $schema_data['mainEntity'];

		if ( $return ) {
			return $schema_data;
		}
		?>
		<script type="application/ld+json">
		<?php echo wp_json_encode( $schema_data ); ?>
		</script>
		<?php

		$this->is_schema_rendered = true;
	}

	/**
	 * Function to get the icon for the Table of Contents
	 *
	 * @since 1.25.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-faq/icon/' . $icon ) ) {
			return fl_builder_filesystem()->file_get_contents( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-faq/icon/' . $icon );
		}
		return '';
	}

	/**
	 * Function that renders FAQ's Content
	 *
	 * @since 1.25.0
	 * @param object $settings gets an object for the settings.
	 */
	public function get_faq_content( $settings ) {
			global $wp_embed;

			$html = wpautop( $wp_embed->autoembed( $settings->faq_answer ) );

			return $html;
	}

	/**
	 * Function to get FAQ items.
	 */
	public function get_faq_items() {

		return $this->settings->faq_items;
	}

	/**
	 * Function that renders FAQ's Icon
	 *
	 * @since 1.25.0
	 * @param object $pos gets an object for the icon's settings.
	 */
	public function render_icon( $pos ) {

		if ( esc_attr( $this->settings->icon_position ) === $pos && ( '' !== esc_attr( $this->settings->open_icon ) || '' !== esc_attr( $this->settings->close_icon ) ) ) {

				$output  = '<div class="uabb-faq-icon-wrap" tabindex="0" >';
				$output .= '<i class="uabb-faq-button-icon ' . esc_attr( $this->settings->close_icon ) . '"></i>';
				$output .= '</div>';
			return $output;
		}
		return '';
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */

if ( UABB_Compatibility::$version_bb_check ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-faq/uabb-faq-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-faq/uabb-faq-bb-less-than-2-2-compatibility.php';
}

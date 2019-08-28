<?php

class CbbPeopleModule extends FLBuilderModule {

	public function __construct() {
		parent::__construct(array(
			'name'            => __( 'People', 'fl-builder' ),
			'description'     => __( 'A module that pulls in people from the RTP People post type.', 'fl-builder' ),
			'icon'            => 'people.svg',
			'category'        => __( 'Layout', 'fl-builder' ),
			'dir'             => CBB_MODULES_DIR . 'modules/cbb-rtp-people/',
			'url'             => CBB_MODULES_URL . 'modules/cbb-rtp-people/'
		));

		// Include custom CSS
		$this->add_css('cbb-figure-card', CBB_MODULES_URL . 'dist/styles/cbb-figure-card.css');
		$this->add_css('cbb-people-card', CBB_MODULES_URL . 'dist/styles/cbb-people-card.css');
	}

	/**
	 * Function to get the icon for the Custom Posts module.
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( CBB_MODULES_DIR . 'assets/icons/' . $icon ) ) {
			$path = CBB_MODULES_DIR . 'assets/icons/' . $icon;
		}

		if ( file_exists( $path ) ) {
			return file_get_contents( $path );
		} else {
			return '';
		}
	}

	public function featuredImage($post_id) {
		if (has_post_thumbnail($post_id)) {
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
			echo get_the_post_thumbnail( $post_id, 'medium-square-thumbnail', ['alt' => $alt, 'itemprop' => 'image'] );
		} else {
			echo '<div class="placeholder"></div>';
		}
	}

}

/*
	Register the module
 */
FLBuilder::register_module( 'CbbPeopleModule', [
	'cbb-people-general' => [
		'title' => __( 'General', 'cbb' ),
		'sections' => [
			'cbb-people' => [
				'title' => __( 'Content', 'cbb' ),
				'fields' => [
					'tax_rtp-people_rtp-team_matching' => [
						'type'    => 'select',
						'label'   => 'Teams',
						'help'    => __( 'Enter a comma separated list of teams to display. Only people on these teams will be shown.', 'cbb' ),
						'options' => [
							'1' => __( 'Match these teams', 'cbb' ),
							'0' => __( 'Do not match these teams', 'cbb' )
						]
					],
					'tax_rtp-people_rtp-team' => [
						'type'   => 'suggest',
						'action' => 'fl_as_terms',
						'data'   => 'rtp-team',
						'label'  => '&nbsp',
					]
				]
			]
		]
	]
] );
?>

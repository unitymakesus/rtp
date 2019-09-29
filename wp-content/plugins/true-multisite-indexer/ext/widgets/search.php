<?php

class mishaWidgetSearch extends WP_Widget {

	/**
	 * Sets up a new Search widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'multisite_widget_search',
			'description' => __( 'Works like the default WordPress search but shows results from all sites in your Multisite Network.', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ),
			'customize_selective_refresh' => true
		);
		parent::__construct( 'multisite_search', __( 'Global Search', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN ), $widget_ops );

		add_filter('get_search_form',array($this,'search_q'),9999,1);
	}

	/**
	 * Outputs the content for the current Search widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Search widget instance.
	 */
	public function widget( $args, $instance ) {
		global $multisite_search_form;
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo str_replace('multisite_widget_search','widget_search multisite_widget_search', $args['before_widget']);
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$multisite_search_form = 1;

		// Use current theme search form if it exists
		echo str_replace('</form>','<input type="hidden" name="msite" value="1" /></form>',get_search_form( false ) );

		$multisite_search_form = 0;

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Search widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}

	/**
	 * Handles updating settings for the current Search widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	function search_q( $form ){
		global $multisite_search_form;

		if( !isset($_GET['s']) )
			return $form;

		if( ( isset($_GET['s']) && $_GET['s'] && isset($_GET['msite']) && $_GET['msite'] == 1 && $multisite_search_form !== 1 )
		|| ( isset($_GET['s']) && $_GET['s'] && !isset($_GET['msite']) && $multisite_search_form == 1 ))
			return str_replace('value="' . get_search_query() . '"','',$form);
	}

}

function true_indexer_widget() {
	register_widget( 'mishaWidgetSearch' );
}
add_action( 'widgets_init', 'true_indexer_widget' );

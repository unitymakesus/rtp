<?php
if (!class_exists('true_multisite_widget')) {

class true_multisite_widget extends WP_Widget {

	/*
	 * создание виджета
	 */
	function __construct() {
		parent::__construct(
			'true_multisite_widget',
			__('Multisite Recent Posts', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN),
			array( 'description' => __('Recent posts from specific blogs from your multisite network.', TRUE_MULTISITE_INDEXER_TEXT_DOMAIN) )
		);
	}

	/*
	 * фронтэнд виджета
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$widget_html = '';

		if( isset( $args['before_widget'] ) )
			$widget_html .= $args['before_widget'];

		if ( ! empty( $title ) )
			$widget_html .= $args['before_title'] . $title . $args['after_title'];

		$args = array(
			'posts_per_page' => $instance[ 'posts_per_page' ]
		);

		$q = new Network_Query( $args );
		if( $q->have_posts() ) :
			$widget_html .= '<ul>';
			while( $q->have_posts() ) : $q->the_post();
				//print_r( $q->post );
				switch_to_blog( $q->post->BLOG_ID );
				$widget_html .= '<li>
				<a href="' . get_permalink( $q->post->ID ) . '">' . $q->post->post_title . '</a>
				'. ( $instance[ 'show_date' ] == 'on' ? '<span class="post-date">' . get_the_time( get_option('date_format'), $q->post->ID ) : '') . '</span>' . '
				</li>';
				restore_current_blog();
			endwhile;
			$widget_html .= '</ul>';
		endif;
		network_reset_postdata();

 		if( isset( $args['after_widget'] ) )
			$widget_html .= $args['after_widget'];

		echo $widget_html;
	}

	/*
	 * бакэнд виджета
	 */
	public function form( $instance ) {

		$title='';
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		$posts_per_page='5';
		if ( isset( $instance[ 'posts_per_page' ] ) ) {
			$posts_per_page = $instance[ 'posts_per_page' ];
		}
		$show_date='';
		if ( isset( $instance[ 'show_date' ] ) ) {
			$show_date = $instance[ 'show_date' ];
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e('Number of posts to show:' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" type="text" value="<?php echo $posts_per_page; ?>" size="3" />
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" <?php checked('on',$show_date) ?>>
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Display post date?') ?></label>
		</p>


		<?php
	}

	/*
	 * сохранение настроек виджета
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['show_date'] = ( ! empty( $new_instance['show_date'] ) ) ? $new_instance['show_date'] : '';
		$instance['posts_per_page'] = ( ! empty( $new_instance['posts_per_page'] ) ) ? intval($new_instance['posts_per_page']) : '5';
		return $instance;
	}
}
}

/*
 * регистрация виджета
 */
function true_load_widget1() {
	register_widget( 'true_multisite_widget' );
}
add_action( 'widgets_init', 'true_load_widget1' );

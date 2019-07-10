<?php
$class = 'fl-map';

if ( ! empty( $settings->height_responsive ) ) {
	$class .= ' fl-map-auto-responsive-disabled';
}

/**
 * Allow users to filter map args, perhaps to change location based on language or to use their own keys.
 * @since 2.2
 * @see fl_builder_map_args
 */
$params = apply_filters( 'fl_builder_map_args', array(
	'q'   => empty( $settings->address ) ? 'United Kingdom' : urlencode( do_shortcode( $settings->address ) ),
	'key' => 'AIzaSyD09zQ9PNDNNy9TadMuzRV_UsPUoWKntt8',
), $settings );
$url    = add_query_arg( $params, 'https://www.google.com/maps/embed/v1/place' );

// ACF Google map passes back an iframe so we need to sanitize it.
if ( false !== strpos( do_shortcode( $settings->address ), 'iframe' ) ) {
	$iframe = preg_replace( '#\s?style=\'.+\'#', '', do_shortcode( $settings->address ) );
} else {
	$iframe = sprintf( '<iframe src="%s"></iframe>', $url );
}

?>
<div class="<?php echo $class; ?>">
	<?php echo $iframe; ?>
</div>

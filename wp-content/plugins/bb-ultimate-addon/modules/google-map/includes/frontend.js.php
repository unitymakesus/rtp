<?php

if ( isset( $settings->map_lattitude ) && isset( $settings->map_longitude ) ) {

	if ( $settings->uabb_gmap_addresses[0]->map_lattitude == '' && $settings->uabb_gmap_addresses[0]->map_longitude == '' ) {
		if ( isset( $settings->marker_point ) ) {
			$settings->uabb_gmap_addresses[0]->marker_point = ( $settings->marker_point != '' ) ? $settings->marker_point : 'default';
		}

		if ( isset( $settings->open_marker ) ) {
			$settings->uabb_gmap_addresses[0]->open_marker = ( $settings->open_marker != '' ) ? $settings->open_marker : 'no';
		}
		if ( isset( $settings->marker_img_src ) ) {
			$settings->uabb_gmap_addresses[0]->marker_img_src = ( $settings->marker_img_src != '' ) ? $settings->marker_img_src : '';
		}
	}

	if ( isset( $settings->uabb_gmap_addresses[0]->map_lattitude ) && $settings->uabb_gmap_addresses[0]->map_lattitude == '' ) {
		$settings->uabb_gmap_addresses[0]->map_lattitude = ( $settings->map_lattitude != '' ) ? $settings->map_lattitude : 40.76142;
	}

	if ( isset( $settings->uabb_gmap_addresses[0]->map_longitude ) && $settings->uabb_gmap_addresses[0]->map_longitude == '' ) {
		$settings->uabb_gmap_addresses[0]->map_longitude = ( $settings->map_longitude != '' ) ? $settings->map_longitude : -73.97712;
	}
}

if ( isset( $settings->info_window_text ) ) {
	if ( isset( $settings->uabb_gmap_addresses[0]->info_window_text ) && $settings->uabb_gmap_addresses[0]->info_window_text == '' ) {
		$settings->uabb_gmap_addresses[0]->info_window_text = ( $settings->info_window_text != '' ) ? $settings->info_window_text : '';
	}
}

?>

(function($) {
	<?php
	$uabb_setting_options = UABB_Init::$uabb_options['fl_builder_uabb'];
		$google_api_key   = '';

	if ( isset( $uabb_setting_options['uabb-google-map-api'] ) && ! empty( $uabb_setting_options['uabb-google-map-api'] ) ) {
		?>
	var markers = new Array(),
		pos = [],
		marker_img_src = [],
		info_window_text = [],
		enable_info = [],
		open_marker = [],
		marker_point = [];
		<?php
		if ( count( $settings->uabb_gmap_addresses ) > 0 ) {
			?>
			<?php
			foreach ( $settings->uabb_gmap_addresses as $marker ) {
				// echo '<xmp>'; print_r($marker); echo '</xmp>';
				$marker->map_lattitude = ( $marker->map_lattitude != '' ) ? $marker->map_lattitude : 40.76142;
				$marker->map_longitude = ( $marker->map_longitude != '' ) ? $marker->map_longitude : -73.97712;
				?>
		
			pos['lat'] = <?php echo json_encode( do_shortcode( $marker->map_lattitude ) ); ?>;
			pos['lng'] = <?php echo json_encode( do_shortcode( $marker->map_longitude ) ); ?>;
			markers.push(pos);
			pos = [];
			marker_img_src.push( '<?php echo ( isset( $marker->marker_img_src ) ) ? $marker->marker_img_src : ''; ?>' );

			info_window_text.push( <?php echo json_encode( trim( preg_replace( '/\s+/', ' ', do_shortcode( $marker->info_window_text ) ) ) ); ?> );

			enable_info.push( '<?php echo $marker->enable_info; ?>' );
			open_marker.push( '<?php echo ( isset( $marker->open_marker ) ) ? $marker->open_marker : 'no'; ?>' );
			marker_point.push( '<?php echo ( isset( $marker->marker_point ) ) ? $marker->marker_point : 'default'; ?>' );
			

				<?php
			}
		}
		?>
	
	var args = {
			id: '<?php echo $id; ?>',
			markers: markers,
			dragging: '<?php echo $settings->dragging; ?>',
			map_zoom: '<?php echo $settings->map_zoom; ?>',
			map_expand: '<?php echo $settings->map_expand; ?>',
			street_view: '<?php echo $settings->street_view; ?>',
			map_type_control: '<?php echo $settings->map_type_control; ?>',
			zoom: '<?php echo $settings->zoom; ?>',
			zoom_control_position: '<?php echo $settings->zoom_control_position; ?>',
			map_type: '<?php echo $settings->map_type; ?>',
			map_style: '<?php $order = array( "\r\n", "\n", "\r", '<br/>', '<br>' );
			$map_style = strip_tags( $settings->map_style ); echo rawurldecode( str_replace( $order, '', $map_style ) ); ?>',
			map_skin: '<?php echo $settings->map_skin; ?>',
			marker_point: marker_point,
			marker_img_src: marker_img_src,
			info_window_text: info_window_text,
			enable_info: enable_info,
			open_marker: open_marker,
			map_fit_marker: '<?php echo ( isset( $settings->map_fit_marker ) ) ? $settings->map_fit_marker : 'no'; ?>'
		};

	jQuery(document).ready( function() {
		
		/* Accordion Click Trigger */
		UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
			new UABBGoogleMaps( args );
		});

		/* Tab Click Trigger */
		UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
			new UABBGoogleMaps( args );
		});

		/* Modal Click Trigger */
		UABBTrigger.addHook( 'uabb-modal-click', function( argument, selector ) {
			new UABBGoogleMaps( args );
		});

		new UABBGoogleMaps( args );

	});

	jQuery(window).load( function() {
		new UABBGoogleMaps( args );
	});

	new UABBGoogleMaps( args );
		<?php
	}
	?>

})(jQuery);
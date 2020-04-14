<?php
/**
 *  UABB Google Map Module front-end CSS php file
 *
 *  @package UABB Google Map Module
 */

?>

.fl-node-<?php echo esc_attr( $id ); ?> {
	width: 100%;
}

.fl-node-<?php echo esc_attr( $id ); ?> .uabb-google-map-wrapper {
	width: <?php echo ( '' !== $settings->map_width ) ? esc_attr( $settings->map_width ) : '100'; ?>%;
	height: <?php echo ( '' !== $settings->map_height ) ? esc_attr( $settings->map_height ) : '300'; ?>px;
	background-color: #CCC;
}

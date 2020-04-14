<?php
/**
 *  UABB Modal Popup Module front-end JS php file
 *
 *  @package UABB Modal Popup Module
 */

?>
<?php

if ( empty( $settings->heading_title ) ) {
	return;
}
$heading = '';
if ( 'yes' === $settings->heading_one ) {
	$heading = 'h1';
}
if ( 'yes' === $settings->heading_two ) {
	$heading .= 'h2';
}
if ( 'yes' === $settings->heading_three ) {
	$heading .= 'h3';
}
if ( 'yes' === $settings->heading_four ) {
	$heading .= 'h4';
}
if ( 'yes' === $settings->heading_five ) {
	$heading .= 'h5';
}
if ( 'yes' === $settings->heading_six ) {
	$heading .= 'h6';
}

$headings       = str_split( $heading, 2 );
$select_heading = implode( ',', $headings );

?>

jQuery(document).ready(function() {
	new UABBTableofContents({
			id: '<?php echo esc_attr( $id ); ?>',
			heading_title:'<?php echo esc_attr( $settings->heading_title ); ?>',
			head_data: '<?php echo esc_attr( $select_heading ); ?>',
			scroll_animation: '<?php echo esc_attr( $settings->scroll_animation ); ?>',
			scroll_effect: '<?php echo esc_attr( $settings->scroll_effect ); ?>',
			scroll_offset: '<?php echo esc_attr( $settings->scroll_offset ); ?>',
			scroll_top: '<?php echo esc_attr( $settings->scroll_top ); ?>',
			toc_toggle:'<?php echo esc_attr( $settings->show_button ); ?>',
			auto_collapsible:'<?php echo esc_attr( $settings->toc_collpseable ); ?>',

		});

});

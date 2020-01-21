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
			id: '<?php echo $id; ?>',
			heading_title:'<?php echo $settings->heading_title; ?>',
			head_data: '<?php echo $select_heading; ?>',
			list_select: '<?php echo $settings->bullet_icon; ?>',
			scroll_animation: '<?php echo $settings->scroll_animation; ?>',
			scroll_effect: '<?php echo $settings->scroll_effect; ?>',
			scroll_offset: '<?php echo $settings->scroll_offset; ?>',
			scroll_top: '<?php echo $settings->scroll_top; ?>',
			toc_toggle:'<?php echo $settings->show_button; ?>',
			auto_collapsible:'<?php echo $settings->toc_collpseable; ?>',

		});

});

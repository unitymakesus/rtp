<?php
/**
 *  UABB Table Module file
 *
 *  @package UABB Table Module
 */

?>

(function($) {
	$(function() {
		new UABBTable({
			id: '<?php echo esc_attr( $id ); ?>',
			show_entries : '<?php echo esc_attr( $settings->show_entries ); ?>',
			show_sort : '<?php echo esc_attr( $settings->show_sort ); ?>',
			table_type : '<?php echo esc_attr( $settings->table_type ); ?>',
			show_entries_all_label: '<?php echo esc_attr( $settings->show_entries_all_label ); ?>',
			responsive_layout : '<?php echo esc_attr( $settings->responsive_layout ); ?>',
		});
	});
})(jQuery);

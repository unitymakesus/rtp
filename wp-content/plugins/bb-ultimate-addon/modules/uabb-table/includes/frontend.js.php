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
			id: '<?php echo $id; ?>',
			show_entries : '<?php echo $settings->show_entries; ?>',
			show_sort : '<?php echo $settings->show_sort; ?>',
			table_type : '<?php echo $settings->table_type; ?>',
			show_entries_all_label: '<?php echo $settings->show_entries_all_label; ?>',
		});
	});
})(jQuery);

<?php
/**
 *  UABB FAQ front-end JS php file
 *
 *  @package UABB FAQ
 */

?>


jQuery(document).ready(function() {
new UABBFAQModule ({
id:'<?php echo esc_attr( $id ); ?>',
close_icon:'<?php echo esc_attr( $settings->close_icon ); ?>',
open_icon:'<?php echo esc_attr( $settings->open_icon ); ?>',
enable_first: '<?php echo esc_attr( $settings->faq_enable_first ); ?>'
});
});

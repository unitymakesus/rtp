<?php
/**
 *  UABB Price List Module front-end file
 *
 *  @package UABB Price List Module
 */

?>
<div class="uabb-align-price-list-<?php echo esc_attr( $settings->overall_alignment ); ?> uabb-pricelist-stack-<?php echo esc_attr( $settings->enable_stack ); ?>">
	<?php echo $module->render(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>

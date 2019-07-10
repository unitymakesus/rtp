<?php
/**
 *  UABB Price List Module front-end file
 *
 *  @package UABB Price List Module
 */

?>
<div class="uabb-align-price-list-<?php echo $settings->overall_alignment; ?> uabb-pricelist-stack-<?php echo $settings->enable_stack; ?>">
	<?php
		echo $module->render();
	?>
</div>

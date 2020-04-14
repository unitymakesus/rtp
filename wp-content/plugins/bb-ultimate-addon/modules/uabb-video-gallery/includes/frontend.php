<?php
/**
 *  UABB Video Gallery Module front-end file
 *
 *  @package UABB Video Gallery Module
 */

?>
<div class="uabb-video-gallery__column-<?php echo esc_attr( $settings->gallery_columns ); ?> uabb-video-gallery-tablet__column-<?php echo esc_attr( $settings->gallery_columns_medium ); ?> uabb-video-gallery-mobile__column-<?php echo esc_attr( $settings->gallery_columns_responsive ); ?> uabb-video-gallery-stack-<?php echo esc_attr( $settings->filters_tab_heading_stack ); ?>">
	<?php echo $module->render(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>

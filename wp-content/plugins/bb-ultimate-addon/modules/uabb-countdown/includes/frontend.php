<?php
/**
 *  UABB Countdown Module front-end file
 *
 *  @package UABB Countdown Module
 */

?>
<?php
$class_hide = 'uabb-hide-seprator-' . $settings->hide_separator;
?>

<div class="uabb-module-content uabb-countdown uabb-countdown-wrapper <?php echo esc_attr( $class_hide ); ?> ">
	<div class="uabb-module-content uabb-countdown uabb-timer">
		<div id="countdown-<?php echo esc_attr( $module->node ); ?>" class="uabb-countdown uabb-countdown-<?php echo esc_attr( $settings->timer_type ); ?>-timer
								<?php
								if ( 'yes' === $settings->show_separator && isset( $settings->separator_type ) ) {
									echo ' uabb-countdown-separator-' . esc_attr( $settings->separator_type ); }
								?>
		"></div>
	</div>
</div>

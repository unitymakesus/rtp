<?php
/**
 *  UABB Business Hour Module front-end file
 *
 *  @package UABB Business Hour Module
 */

?>

<div class="uabb-business-hours-container">
	<?php
	$i = 1;
	foreach ( $settings->businessHours as $business_hours_content ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$day_color  = ( isset( $business_hours_content->day_color ) && '' !== $business_hours_content->day_color && 'yes' === $business_hours_content->highlight_styling ) ? 'uabb-business-day-highlight' : '';
		$hour_color = ( isset( $business_hours_content->hour_color ) && '' !== $business_hours_content->hour_color && 'yes' === $business_hours_content->highlight_styling ) ? 'uabb-business-hours-highlight' : '';
		?>
			<div class="uabb-business-hours-wrap uabb-business-hours-wrap-<?php echo esc_attr( $i ); ?> ">
				<div class="uabb-business-day <?php echo esc_attr( $day_color ); ?> uabb-business-day-<?php echo esc_attr( $i ); ?> "> <?php echo $business_hours_content->days; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<div class="uabb-business-hours <?php echo esc_attr( $hour_color ); ?> uabb-business-hours-<?php echo esc_attr( $i ); ?> "> <?php echo $business_hours_content->hours; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		<?php
		$i++;
	}
	?>
</div>

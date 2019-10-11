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
	foreach ( $settings->businessHours as $business_hours_content ) {
		$day_color  = ( isset( $business_hours_content->day_color ) && '' != $business_hours_content->day_color && 'yes' == $business_hours_content->highlight_styling ) ? 'uabb-business-day-highlight' : '';
		$hour_color = ( isset( $business_hours_content->hour_color ) && '' != $business_hours_content->hour_color && 'yes' == $business_hours_content->highlight_styling ) ? 'uabb-business-hours-highlight' : '';
		?>
			<div class="uabb-business-hours-wrap uabb-business-hours-wrap-<?php echo $i; ?> ">
				<div class="uabb-business-day <?php echo $day_color; ?> uabb-business-day-<?php echo $i; ?> "> <?php echo $business_hours_content->days; ?>
				</div>
				<div class="uabb-business-hours <?php echo $hour_color; ?> uabb-business-hours-<?php echo $i; ?> "> <?php echo $business_hours_content->hours; ?>
				</div>
			</div>
		<?php
		$i++;
	}
	?>
</div>

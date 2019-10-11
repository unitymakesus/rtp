<?php 
/**
 *  UABB Countdown Module front-end JS php file
 *
 *  @package UABB Countdown Module
 */

//Set Labels If User Entered Some
$fixed_plural_year = ( isset( $settings->year_plural_label ) && $settings->year_plural_label != "" && $settings->year_custom_label == "yes" ) ? $settings->year_plural_label : "Years";

$fixed_singular_year = ( isset( $settings->year_singular_label ) && $settings->year_singular_label != "" && $settings->year_custom_label == "yes" ) ? $settings->year_singular_label : "Year";

$fixed_plural_month = ( isset( $settings->month_plural_label ) && $settings->month_plural_label != "" && $settings->month_custom_label == "yes" ) ? $settings->month_plural_label : "Months";

$fixed_singular_month = ( isset( $settings->month_singular_label ) && $settings->month_singular_label != "" && $settings->month_custom_label == "yes" ) ? $settings->month_singular_label : "Month";

$fixed_plural_day = ( isset( $settings->day_plural_label ) && $settings->day_plural_label != "" && $settings->day_custom_label == "yes" ) ? $settings->day_plural_label : "Days";

$fixed_singular_day = ( isset( $settings->day_singular_label ) && $settings->day_singular_label != "" && $settings->day_custom_label == "yes" ) ? $settings->day_singular_label : "Day";

$fixed_plural_hour = ( isset( $settings->hour_plural_label ) && $settings->hour_plural_label != "" && $settings->hour_custom_label == "yes" ) ? $settings->hour_plural_label : "Hours";

$fixed_singular_hour = ( isset( $settings->hour_singular_label ) && $settings->hour_singular_label != "" && $settings->hour_custom_label == "yes" ) ? $settings->hour_singular_label : "Hour";

$fixed_plural_minute = ( isset( $settings->minute_plural_label ) && $settings->minute_plural_label != "" && $settings->minute_custom_label == "yes" ) ? $settings->minute_plural_label : "Minutes";

$fixed_singular_minute = ( isset( $settings->minute_singular_label ) && $settings->minute_singular_label != "" && $settings->minute_custom_label == "yes" ) ? $settings->minute_singular_label : "Minute";

$fixed_plural_second = ( isset( $settings->second_plural_label ) && $settings->second_plural_label != "" && $settings->second_custom_label == "yes" ) ? $settings->second_plural_label : "Seconds";

$fixed_singular_second = ( isset( $settings->second_singular_label ) && $settings->second_singular_label != "" && $settings->second_custom_label == "yes" ) ? $settings->second_singular_label : "Second";
?>

<?php if ( $settings->timer_style == "normal" && $settings->normal_options == "normal_below" ) { ?>
	var default_layout =  '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout +=  '{y<}'+ '<?php echo $module->render_normal_countdown( '{ynn}', '{yl}' ); ?>' + '{y>}';
	<?php } ?>
		default_layout += '{o<}'+ '<?php echo $module->render_normal_countdown( '{onn}', '{ol}' ); ?>' +
		'{o>}'+
		'{d<}'+ '<?php echo $module->render_normal_countdown( '{dnn}', '{dl}' ); ?>' +
		'{d>}'+
		'{h<}'+ '<?php echo $module->render_normal_countdown( '{hnn}', '{hl}' ); ?>' +
		'{h>}'+
		'{m<}'+ '<?php echo $module->render_normal_countdown( '{mnn}', '{ml}' ); ?>' +
		'{m>}'+
		'{s<}'+ '<?php echo $module->render_normal_countdown( '{snn}', '{sl}' ); ?>' +
		'{s>}';
<?php } else if ( $settings->timer_style == "normal" && $settings->normal_options == "normal_above" ) { ?>
	
	var default_layout = '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout += '{y<}' + '<?php echo $module->render_normal_above_countdown( '{ynn}', '{yl}', '{y>}' ); ?>';
	<?php } ?>
		default_layout += '{o<}' + '<?php echo $module->render_normal_above_countdown( '{onn}', '{ol}', '{o>}' ); ?>' +
		'{d<}' + '<?php echo $module->render_normal_above_countdown( '{dnn}', '{dl}', '{d>}' ); ?>' +
		'{h<}' + '<?php echo $module->render_normal_above_countdown( '{hnn}', '{hl}', '{h>}' ); ?>' +
		'{m<}' + '<?php echo $module->render_normal_above_countdown( '{mnn}', '{ml}', '{m>}' ); ?>' +
		'{s<}' + '<?php echo $module->render_normal_above_countdown( '{snn}', '{sl}', '{s>}' ); ?>';

<?php } else if ( $settings->unit_position == "outside" && $settings->outside_options == "out_below" ) { ?>

	var default_layout = '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout += '{y<}'+ '<?php echo $module->render_normal_countdown( '{ynn}', '{yl}' ); ?>' +
		'{y>}';
	<?php } ?>
	
	default_layout = '{o<}'+ '<?php echo $module->render_normal_countdown( '{onn}', '{ol}' ); ?>' +
		'{o>}'+
		'{d<}'+ '<?php echo $module->render_normal_countdown( '{dnn}', '{dl}' ); ?>' +
		'{d>}'+
		'{h<}'+ '<?php echo $module->render_normal_countdown( '{hnn}', '{hl}' ); ?>' +
		'{h>}'+
		'{m<}'+ '<?php echo $module->render_normal_countdown( '{mnn}', '{ml}' ); ?>' +
		'{m>}'+
		'{s<}'+ '<?php echo $module->render_normal_countdown( '{snn}', '{sl}' ); ?>' +
		'{s>}';

<?php } else if ( $settings->unit_position == "inside" && $settings->inside_options == "in_below" ) { ?>

	var default_layout = '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout += '{y<}' + '<?php echo $module->render_inside_below_countdown( '{ynn}', '{yl}', '{y>}' ); ?>';
	<?php } ?>
	
	default_layout += '{o<}' + '<?php echo $module->render_inside_below_countdown( '{onn}', '{ol}', '{o>}' ); ?>' +
		'{d<}' + '<?php echo $module->render_inside_below_countdown( '{dnn}', '{dl}', '{d>}' ); ?>' +
		'{h<}' + '<?php echo $module->render_inside_below_countdown( '{hnn}', '{hl}', '{h>}' ); ?>' +
		'{m<}' + '<?php echo $module->render_inside_below_countdown( '{mnn}', '{ml}', '{m>}' ); ?>' +
		'{s<}' + '<?php echo $module->render_inside_below_countdown( '{snn}', '{sl}', '{s>}' ); ?>';

<?php } else if ( $settings->unit_position == "inside" && $settings->inside_options == "in_above" ) { ?>
	
	var default_layout = '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout += '{y<}' + '<?php echo $module->render_inside_above_countdown( '{ynn}', '{yl}', '{y>}' ); ?>';
	<?php } ?>
	default_layout += '{o<}' + '<?php echo $module->render_inside_above_countdown( '{onn}', '{ol}', '{o>}' ); ?>' +
		'{d<}' + '<?php echo $module->render_inside_above_countdown( '{dnn}', '{dl}', '{d>}' ); ?>' +
		'{h<}' + '<?php echo $module->render_inside_above_countdown( '{hnn}', '{hl}', '{h>}' ); ?>' +
		'{m<}' + '<?php echo $module->render_inside_above_countdown( '{mnn}', '{ml}', '{m>}' ); ?>' +
		'{s<}' + '<?php echo $module->render_inside_above_countdown( '{snn}', '{sl}', '{s>}' ); ?>';

<?php } else if ( $settings->unit_position == "outside" && ( $settings->outside_options == "out_above" || $settings->outside_options == "out_right" || $settings->outside_options == "out_left" ) ) { ?>

	var default_layout = '';
	<?php if( $settings->timer_type != "evergreen" ) { ?>
	default_layout += '{y<}' + '<?php echo $module->render_outside_countdown( '{ynn}', '{yl}', '{y>}' ); ?>';
	<?php } ?>
	
	default_layout += '{o<}' + '<?php echo $module->render_outside_countdown( '{onn}', '{ol}', '{o>}' ); ?>' +
		'{d<}' + '<?php echo $module->render_outside_countdown( '{dnn}', '{dl}', '{d>}' ); ?>' +
		'{h<}' + '<?php echo $module->render_outside_countdown( '{hnn}', '{hl}', '{h>}' ); ?>' +
		'{m<}' + '<?php echo $module->render_outside_countdown( '{mnn}', '{ml}', '{m>}' ); ?>' +
		'{s<}' + '<?php echo $module->render_outside_countdown( '{snn}', '{sl}', '{s>}' ); ?>';

<?php } ?>

(function ($) {

	<?php if( $settings->timer_type == "evergreen" ) { ?>
		var moduleDay = new Date();
	<?php
	} else {
	?>
	var moduleDay = new Date( "<?php if( isset( $settings->fixed_date_year ) ){ echo $settings->fixed_date_year; } ?>", "<?php if( isset( $settings->fixed_date_month ) ) { echo $settings->fixed_date_month - 1; } ?>", "<?php if( isset( $settings->fixed_date_days ) ) { echo $settings->fixed_date_days; } ?>", "<?php if( isset( $settings->fixed_date_hour ) ) { echo $settings->fixed_date_hour; } ?>", "<?php if( isset( $settings->fixed_date_minutes ) ) { echo $settings->fixed_date_minutes; } ?>" );
	<?php
	}
	?>
	
	new UABBCountdown({
		id: "<?php echo $id; ?>",
		fixed_timer_action: "<?php echo $settings->fixed_timer_action; ?>",
		evergreen_timer_action: "<?php echo $settings->evergreen_timer_action; ?>",
		timertype: "<?php echo $settings->timer_type; ?>",
		timer_date: moduleDay,
		timer_format: "<?php if( isset( $settings->year_string ) ){ echo $settings->year_string; }?><?php if( isset( $settings->month_string ) ){ echo $settings->month_string; }?><?php if( isset( $settings->day_string ) ){ echo $settings->day_string; }?><?php if( isset( $settings->hour_string ) ){ echo $settings->hour_string; }?><?php if( isset( $settings->minute_string ) ){ echo $settings->minute_string; }?><?php if( isset( $settings->second_string ) ){ echo $settings->second_string; }?>",
		timer_layout: default_layout,
		redirect_link_target: "<?php echo ( $settings->redirect_link_target != '' ) ? $settings->redirect_link_target : ''; ?>",
		redirect_link: "<?php echo ( $settings->redirect_link != '' ) ? $settings->redirect_link : ''; ?>",
		expire_message: "<?php echo ( $settings->expire_message != '' ) ? preg_replace('/\s+/', ' ', $settings->expire_message) : ''; ?>",
		timer_labels: "<?php echo $fixed_plural_year; ?>,<?php echo $fixed_plural_month; ?>,,<?php echo $fixed_plural_day; ?>,<?php echo $fixed_plural_hour; ?>,<?php echo $fixed_plural_minute; ?>,<?php echo $fixed_plural_second; ?>",
		timer_labels_singular: 	"<?php echo $fixed_singular_year; ?>,<?php echo $fixed_singular_month; ?>,,<?php echo $fixed_singular_day; ?>,<?php echo $fixed_singular_hour; ?>,<?php echo $fixed_singular_minute; ?>,<?php echo $fixed_singular_second; ?>",
		evergreen_date_days: "<?php echo isset( $settings->evergreen_date_days ) ? $settings->evergreen_date_days : ''; ?>",
		evergreen_date_hour: "<?php echo isset( $settings->evergreen_date_hour ) ? $settings->evergreen_date_hour : ''; ?>",
		evergreen_date_minutes: "<?php echo isset( $settings->evergreen_date_minutes ) ? $settings->evergreen_date_minutes : ''; ?>",
		evergreen_date_seconds: "<?php echo isset( $settings->evergreen_date_seconds ) ? $settings->evergreen_date_seconds : ''; ?>",
		time_zone: "<?php echo $module->get_gmt_difference( $settings ); ?>",
		<?php if( isset( $settings->fixed_timer_action ) && $settings->fixed_timer_action == "msg"){ ?>
		timer_exp_text: '<div class="uabb-countdown-expire-message">'+ $.cookie( "countdown-<?php echo $id ;?>expiremsg" ) +'</div>'
		<?php } ?>
	});

})(jQuery);
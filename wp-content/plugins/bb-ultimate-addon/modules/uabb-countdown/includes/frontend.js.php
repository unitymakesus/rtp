<?php
/**
 *  UABB Countdown Module front-end JS php file
 *
 *  @package UABB Countdown Module
 */

// Set Labels If User Entered Some.
$fixed_plural_year = ( isset( $settings->year_plural_label ) && '' !== $settings->year_plural_label && 'yes' === $settings->year_custom_label ) ? $settings->year_plural_label : 'Years';

$fixed_singular_year = ( isset( $settings->year_singular_label ) && '' !== $settings->year_singular_label && 'yes' === $settings->year_custom_label ) ? $settings->year_singular_label : 'Year';

$fixed_plural_month = ( isset( $settings->month_plural_label ) && '' !== $settings->month_plural_label && 'yes' === $settings->month_custom_label ) ? $settings->month_plural_label : 'Months';

$fixed_singular_month = ( isset( $settings->month_singular_label ) && '' !== $settings->month_singular_label && 'yes' === $settings->month_custom_label ) ? $settings->month_singular_label : 'Month';

$fixed_plural_day = ( isset( $settings->day_plural_label ) && '' !== $settings->day_plural_label && 'yes' === $settings->day_custom_label ) ? $settings->day_plural_label : 'Days';

$fixed_singular_day = ( isset( $settings->day_singular_label ) && '' !== $settings->day_singular_label && 'yes' === $settings->day_custom_label ) ? $settings->day_singular_label : 'Day';

$fixed_plural_hour = ( isset( $settings->hour_plural_label ) && '' !== $settings->hour_plural_label && 'yes' === $settings->hour_custom_label ) ? $settings->hour_plural_label : 'Hours';

$fixed_singular_hour = ( isset( $settings->hour_singular_label ) && '' !== $settings->hour_singular_label && 'yes' === $settings->hour_custom_label ) ? $settings->hour_singular_label : 'Hour';

$fixed_plural_minute = ( isset( $settings->minute_plural_label ) && '' !== $settings->minute_plural_label && 'yes' === $settings->minute_custom_label ) ? $settings->minute_plural_label : 'Minutes';

$fixed_singular_minute = ( isset( $settings->minute_singular_label ) && '' !== $settings->minute_singular_label && 'yes' === $settings->minute_custom_label ) ? $settings->minute_singular_label : 'Minute';

$fixed_plural_second = ( isset( $settings->second_plural_label ) && '' !== $settings->second_plural_label && 'yes' === $settings->second_custom_label ) ? $settings->second_plural_label : 'Seconds';

$fixed_singular_second = ( isset( $settings->second_singular_label ) && '' !== $settings->second_singular_label && 'yes' === $settings->second_custom_label ) ? $settings->second_singular_label : 'Second';
?>

<?php if ( 'normal' === $settings->timer_style && 'normal_below' === $settings->normal_options ) { ?>
	var default_layout =  '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout +=  '{y<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{ynn}', '{yl}' ) ); ?>' + '{y>}';
	<?php } ?>
		default_layout += '{o<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{onn}', '{ol}' ) ); ?>' +
		'{o>}'+
		'{d<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{dnn}', '{dl}' ) ); ?>' +
		'{d>}'+
		'{h<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{hnn}', '{hl}' ) ); ?>' +
		'{h>}'+
		'{m<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{mnn}', '{ml}' ) ); ?>' +
		'{m>}'+
		'{s<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{snn}', '{sl}' ) ); ?>' +
		'{s>}';
<?php } elseif ( 'normal' === $settings->timer_style && 'normal_above' === $settings->normal_options ) { ?>

	var default_layout = '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout += '{y<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{ynn}', '{yl}', '{y>}' ) ); ?>';
	<?php } ?>
		default_layout += '{o<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{onn}', '{ol}', '{o>}' ) ); ?>' +
		'{d<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{dnn}', '{dl}', '{d>}' ) ); ?>' +
		'{h<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{hnn}', '{hl}', '{h>}' ) ); ?>' +
		'{m<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{mnn}', '{ml}', '{m>}' ) ); ?>' +
		'{s<}' + '<?php echo wp_kses_post( $module->render_normal_above_countdown( '{snn}', '{sl}', '{s>}' ) ); ?>';

<?php } elseif ( 'outside' === $settings->unit_position && 'out_below' === $settings->outside_options ) { ?>

	var default_layout = '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout += '{y<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{ynn}', '{yl}' ) ); ?>' +
		'{y>}';
	<?php } ?>

	default_layout = '{o<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{onn}', '{ol}' ) ); ?>' +
		'{o>}'+
		'{d<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{dnn}', '{dl}' ) ); ?>' +
		'{d>}'+
		'{h<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{hnn}', '{hl}' ) ); ?>' +
		'{h>}'+
		'{m<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{mnn}', '{ml}' ) ); ?>' +
		'{m>}'+
		'{s<}'+ '<?php echo wp_kses_post( $module->render_normal_countdown( '{snn}', '{sl}' ) ); ?>' +
		'{s>}';

<?php } elseif ( 'inside' === $settings->unit_position && 'in_below' === $settings->inside_options ) { ?>

	var default_layout = '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout += '{y<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{ynn}', '{yl}', '{y>}' ) ); ?>';
	<?php } ?>

	default_layout += '{o<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{onn}', '{ol}', '{o>}' ) ); ?>' +
		'{d<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{dnn}', '{dl}', '{d>}' ) ); ?>' +
		'{h<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{hnn}', '{hl}', '{h>}' ) ); ?>' +
		'{m<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{mnn}', '{ml}', '{m>}' ) ); ?>' +
		'{s<}' + '<?php echo wp_kses_post( $module->render_inside_below_countdown( '{snn}', '{sl}', '{s>}' ) ); ?>';

<?php } elseif ( 'inside' === $settings->unit_position && 'in_above' === $settings->inside_options ) { ?>

	var default_layout = '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout += '{y<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{ynn}', '{yl}', '{y>}' ) ); ?>';
	<?php } ?>
	default_layout += '{o<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{onn}', '{ol}', '{o>}' ) ); ?>' +
		'{d<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{dnn}', '{dl}', '{d>}' ) ); ?>' +
		'{h<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{hnn}', '{hl}', '{h>}' ) ); ?>' +
		'{m<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{mnn}', '{ml}', '{m>}' ) ); ?>' +
		'{s<}' + '<?php echo wp_kses_post( $module->render_inside_above_countdown( '{snn}', '{sl}', '{s>}' ) ); ?>';

<?php } elseif ( 'outside' === $settings->unit_position && ( 'out_above' === $settings->outside_options || 'out_right' === $settings->outside_options || 'out_left' === $settings->outside_options ) ) { ?>

	var default_layout = '';
	<?php if ( 'evergreen' !== $settings->timer_type ) { ?>
	default_layout += '{y<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{ynn}', '{yl}', '{y>}' ) ); ?>';
	<?php } ?>
	default_layout += '{o<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{onn}', '{ol}', '{o>}' ) ); ?>' +
		'{d<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{dnn}', '{dl}', '{d>}' ) ); ?>' +
		'{h<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{hnn}', '{hl}', '{h>}' ) ); ?>' +
		'{m<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{mnn}', '{ml}', '{m>}' ) ); ?>' +
		'{s<}' + '<?php echo wp_kses_post( $module->render_outside_countdown( '{snn}', '{sl}', '{s>}' ) ); ?>';

<?php } ?>

(function ($) {

	<?php if ( 'evergreen' === $settings->timer_type ) { ?>
		var moduleDay = new Date();
		<?php
	} else {
		?>
	var moduleDay = new Date( "<?php if ( isset( $settings->fixed_date_year ) ) { echo wp_kses_post( $settings->fixed_date_year ); } ?>", "<?php if ( isset( $settings->fixed_date_month ) ) { echo wp_kses_post( $settings->fixed_date_month - 1 ); } ?>", "<?php if ( isset( $settings->fixed_date_days ) ) { echo wp_kses_post( $settings->fixed_date_days ); } ?>", "<?php if ( isset( $settings->fixed_date_hour ) ) { echo wp_kses_post( $settings->fixed_date_hour ); } ?>", "<?php if ( isset( $settings->fixed_date_minutes ) ) { echo wp_kses_post( $settings->fixed_date_minutes ); } // phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace ?>" );
		<?php
	}
	?>

	new UABBCountdown({
		id: "<?php echo esc_attr( $id ); ?>",
		fixed_timer_action: "<?php echo esc_attr( $settings->fixed_timer_action ); ?>",
		evergreen_timer_action: "<?php echo esc_attr( $settings->evergreen_timer_action ); ?>",
		timertype: "<?php echo esc_attr( $settings->timer_type ); ?>",
		timer_date: moduleDay,
		timer_format: "<?php if ( isset( $settings->year_string ) ) { echo wp_kses_post( $settings->year_string ); } ?> <?php if ( isset( $settings->month_string ) ) { echo wp_kses_post( $settings->month_string ); } ?> <?php if ( isset( $settings->day_string ) ) { echo wp_kses_post( $settings->day_string ); } ?> <?php if ( isset( $settings->hour_string ) ) { echo wp_kses_post( $settings->hour_string ); } ?> <?php if ( isset( $settings->minute_string ) ) { echo wp_kses_post( $settings->minute_string ); } ?> <?php if ( isset( $settings->second_string ) ) { echo wp_kses_post( $settings->second_string ); } // @codingStandardsIgnoreLine. ?>",
		timer_layout: default_layout,
		redirect_link_target: "<?php echo ( '' !== $settings->redirect_link_target ) ? esc_attr( $settings->redirect_link_target ) : ''; ?>",
		redirect_link: "<?php echo ( '' !== $settings->redirect_link ) ? esc_url( $settings->redirect_link ) : ''; ?>",
		expire_message: "<?php echo ( '' !== $settings->expire_message ) ? preg_replace( '/\s+/', ' ', $settings->expire_message ) : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>",
		timer_labels: "<?php echo $fixed_plural_year; ?>,<?php echo $fixed_plural_month; ?>,,<?php echo $fixed_plural_day; ?>,<?php echo $fixed_plural_hour; ?>,<?php echo $fixed_plural_minute; ?>,<?php echo $fixed_plural_second; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>",
		timer_labels_singular: 	"<?php echo $fixed_singular_year; ?>,<?php echo $fixed_singular_month; ?>,,<?php echo $fixed_singular_day; ?>,<?php echo $fixed_singular_hour; ?>,<?php echo $fixed_singular_minute; ?>,<?php echo $fixed_singular_second; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>",
		evergreen_date_days: "<?php echo isset( $settings->evergreen_date_days ) ? wp_kses_post( $settings->evergreen_date_days ) : ''; ?>",
		evergreen_date_hour: "<?php echo isset( $settings->evergreen_date_hour ) ? wp_kses_post( $settings->evergreen_date_hour ) : ''; ?>",
		evergreen_date_minutes: "<?php echo isset( $settings->evergreen_date_minutes ) ? wp_kses_post( $settings->evergreen_date_minutes ) : ''; ?>",
		evergreen_date_seconds: "<?php echo isset( $settings->evergreen_date_seconds ) ? wp_kses_post( $settings->evergreen_date_seconds ) : ''; ?>",
		time_zone: "<?php echo wp_kses_post( $module->get_gmt_difference( $settings ) ); ?>",
		<?php if ( isset( $settings->fixed_timer_action ) && 'msg' === $settings->fixed_timer_action ) { ?>
		timer_exp_text: '<div class="uabb-countdown-expire-message">'+ $.cookie( "countdown-<?php echo esc_attr( $id ); ?>expiremsg" ) +'</div>'
		<?php } ?>
	});

})(jQuery);

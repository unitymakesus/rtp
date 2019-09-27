<?php

namespace App;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  // Unenqueue files from parent theme
  wp_dequeue_style('sage/main.css');
  wp_dequeue_script('sage/main.js');

  // Enqueue files for child theme (which include the above as imports)
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * REMOVE WP EMOJI
 */
 remove_action('wp_head', 'print_emoji_detection_script', 7);
 remove_action('wp_print_styles', 'print_emoji_styles');
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enable plugins to manage the document title
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
 */
add_theme_support('title-tag');

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'social_links' => __('Social Links', 'sage')
]);

/**
 * Enable post thumbnails
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
 * Enable HTML5 markup support
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

/**
 * Enable selective refresh for widgets in customizer
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
 */
add_theme_support('customize-selective-refresh-widgets');

/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
add_theme_support( 'align-wide' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'wp-block-styles' );

/**
 * Enqueue editor styles for Gutenberg
 */
// function simple_editor_styles() {
//   wp_enqueue_style( 'simple-gutenberg-style', asset_path('styles/main.css') );
// }
// add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\simple_editor_styles' );

/**
 * Add image quality
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Enable logo uploader in customizer
 */
add_image_size('rtp-logo', 200, 200, false);
add_image_size('rtp-logo-2x', 400, 400, false);
add_theme_support('custom-logo', array(
  'size' => 'rtp-logo-2x'
));

/**
 * Add image sizes
 */
add_image_size('medium-square-thumbnail', 600, 600, true);

add_filter( 'image_size_names_choose', function( $sizes ) {
  return array_merge( $sizes, array(
    'medium-square-thumbnail' => __( 'Medium Square Thumbnail' ),
  ) );
} );

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ];
  register_sidebar([
    'name'          => __('Footer-Social-Left', 'sage'),
    'id'            => 'footer-social-left'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Social-Right', 'sage'),
    'id'            => 'footer-social-right'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Utility-Left', 'sage'),
    'id'            => 'footer-utility-left'
  ] + $config);
  register_sidebar([
    'name'          => __('Footer-Utility-Right', 'sage'),
    'id'            => 'footer-utility-right'
  ] + $config);
});

/**
 * Register options page
 */
 if( function_exists('acf_add_options_page') ) {
 	acf_add_options_page(array(
 		'page_title' 	=> 'Frontier 800 Schedule',
 		'menu_title'	=> 'Frontier 800 Schedule',
 		'menu_slug' 	=> 'schedule-settings',
 		'capability'	=> 'manage_options',
 		'redirect'		=> false
 	));
}


/**
 * Frontier 800 schedule shortcode
 */
add_shortcode('frontier-800-schedule', function($atts) {
	$regular = get_field('regular_schedule', 'option');

  $today = strtotime(current_time('Y-m-d'));
  $dayofweek = date('N', $today);

  $status = get_day_status($today);

  // If it's closed, when will it reopen?
  if ($status['closed'] == true) {
    $i = 1;

    $closed = $status['closed'];
    // Loop through upcoming days until it's open again
    while ($closed == true) {
      $day = strtotime("+$i Days", current_time('timestamp'));
      $nextopen = get_day_status($day);
      $closed = $nextopen['closed'];
      $i++;
    }

    $openday = date('l, F j, Y', $nextopen['schedule']);

    $schedule = "{$status['schedule']} We'll reopen at {$regular['open']} on $openday. Our regular hours on Mondays-Fridays are from {$regular['open']} to {$regular['close']}.";
  } else {
    $schedule = "Frontier 800 is open weekdays from {$regular['open']} to {$regular['close']}.";
  }

  return $schedule;
});

function get_day_status($test) {
  $exceptions = get_field('closed_days', 'option');
  $closed = false;

  // Is it a holiday?
  foreach($exceptions as $exception) {
    $date = strtotime($exception['date']);
    if ($test == $date) {
      $closed = true;
      $schedule = "Frontier 800 is closed today, {$exception['date']} {$exception['reason']} {$exception['fill_in_the_blank']}.";
      break;
    }
  }

  // Is it the weekend?
  if ($dayofweek > 5) {
    $closed = true;
    $schedule = 'Frontier 800 is closed for the weekend.';
  }

  if (!$closed) {
    $schedule = $test;
  }

  return array('closed' => $closed, 'schedule' => $schedule);
}

/**
 * Fix issue where page header loads before theme on non-SSL pages that load Give Square add-on
 */
remove_action( 'give_square_cc_form', 'give_square_credit_card_form', 10, 3 );
add_action( 'give_square_cc_form', __NAMESPACE__ . '\rtp_give_square_credit_card_form', 10, 3 );
function rtp_give_square_credit_card_form( $form_id, $args, $echo = true ) {

	$id_prefix = ! empty( $args['id_prefix'] ) ? $args['id_prefix'] : '';

	$card_number_class = 'form-row form-row-two-thirds form-row-responsive give-square-cc-field-wrap';
	$card_cvc_class    = 'form-row form-row-one-third form-row-responsive give-square-cc-field-wrap';
	$card_name_class   = 'form-row form-row-two-thirds form-row-responsive give-square-cc-field-wrap';
	$card_exp_class    = 'form-row form-row-first form-row-responsive card-expiration give-square-cc-field-wrap';
	$card_zip_class    = 'form-row form-row-last form-row-responsive give-square-cc-field-wrap';

	if ( give_square_can_collect_billing_details() ) {
		$card_exp_class = 'card-expiration form-row form-row-one-third form-row-responsive give-square-cc-field-wrap';
		$card_zip_class = 'form-row form-row-one-third form-row-responsive give-square-cc-field-wrap';
	}

   // Show frontend notice when site not accessed with SSL.
   if ( ! is_ssl() ) {
      Give()->notices->print_frontend_notice( __( 'This page requires a valid SSL certificate for secure donations. Please try accessing this page with HTTPS in order to load Credit Card fields.', 'give-square' ) );
      return false;
   }

	ob_start();

	do_action( 'give_before_cc_fields', $form_id );
	?>

	<fieldset id="give_cc_fields" class="give-do-validate">
		<legend><?php esc_html_e( 'Credit Card Info', 'give-square' ); ?></legend>
       <?php
       $application_id = give_square_get_application_id();
       if ( empty( $application_id ) ) {

           // Show frontend notice when Square is not configured properly.
	        Give()->notices->print_frontend_notice(
               sprintf(
                   /* translators: 1. Text, 2. Link, 3. Link Text */
            '%1$s <a href="%2$s">%3$s</a>',
                   __( 'Square is not set up yet to accept payments. Please configure the gateway in order to accept donations. If you\'re having trouble please review', '' ),
                   esc_url( 'http://docs.givewp.com/addon-square' ),
                   __( 'Give\'s Square documentation.', 'give-square' )
               )
           );
	        return false;
       }
       ?>
       <div id="give_secure_site_wrapper">
           <span class="give-icon padlock"></span>
           <span>
               <?php esc_attr_e( 'This is a secure SSL encrypted payment.', 'give-square' ); ?>
           </span>
       </div>

		<div id="give-card-number-wrap" class="<?php echo esc_attr( $card_number_class ); ?>">
			<div>
				<label for="give-card-number-field-<?php echo esc_html( $id_prefix ); ?>" class="give-label">
					<?php esc_attr_e( 'Card Number', 'give-square' ); ?>
					<span class="give-required-indicator">*</span>
					<span class="give-tooltip give-icon give-icon-question"
						data-tooltip="<?php esc_attr_e( 'The (typically) 16 digits on the front of your credit card.', 'give-square' ); ?>"></span>
					<span class="card-type"></span>
				</label>
				<div id="give-card-number-field-<?php echo esc_html( $id_prefix ); ?>" class="input empty give-square-cc-field give-square-card-number-field"></div>
			</div>
		</div>

		<div id="give-card-cvc-wrap" class="<?php echo esc_attr( $card_cvc_class ); ?>">
			<div>
				<label for="give-card-cvc-field-<?php echo esc_html( $id_prefix ); ?>" class="give-label">
					<?php esc_attr_e( 'CVC', 'give-square' ); ?>
					<span class="give-required-indicator">*</span>
					<span class="give-tooltip give-icon give-icon-question"
						data-tooltip="<?php esc_attr_e( 'The 3 digit (back) or 4 digit (front) value on your card.', 'give-square' ); ?>"></span>
				</label>
				<div id="give-card-cvc-field-<?php echo esc_html( $id_prefix ); ?>" class="input empty give-square-cc-field give-square-card-cvc-field"></div>
			</div>
		</div>

       <?php
       if ( give_square_can_collect_billing_details() ) {
           ?>
           <div id="give-card-name-wrap" class="<?php echo esc_attr( $card_name_class ); ?>">
               <label for="card_name" class="give-label">
                   <?php esc_attr_e( 'Cardholder Name', 'give-square' ); ?>
                   <span class="give-required-indicator">*</span>
                   <span class="give-tooltip give-icon give-icon-question"
                         data-tooltip="<?php esc_attr_e( 'The name of the credit card account holder.', 'give-square' ); ?>"></span>
               </label>

               <input
                       type="text"
                       autocomplete="off"
                       id="card_name"
                       name="card_name"
                       class="card-name give-input required"
                       placeholder="<?php esc_attr_e( 'Cardholder Name', 'give-square' ); ?>"
               />
           </div>
           <?php
       }

       do_action( 'give_before_cc_expiration' );
       ?>

		<div id="give-card-expiration-wrap" class="<?php echo esc_attr( $card_exp_class ); ?>">
			<div>
				<label for="give-card-expiration-field-<?php echo esc_html( $id_prefix ); ?>" class="give-label">
					<?php esc_attr_e( 'Expiration', 'give-square' ); ?>
					<span class="give-required-indicator">*</span>
					<span class="give-tooltip give-icon give-icon-question"
						data-tooltip="<?php esc_attr_e( 'The date your credit card expires, typically on the front of the card.', 'give-square' ); ?>"></span>
				</label>

				<div id="give-card-expiration-field-<?php echo esc_html( $id_prefix ); ?>" class="input empty give-square-cc-field give-square-card-expiration-field"></div>
			</div>
		</div>

       <?php
       if ( ! give_square_can_collect_billing_details() ) {
           ?>
           <div id="give-card-zip-wrap" class="<?php echo esc_attr( $card_zip_class ); ?>">
               <label for="card_zip" class="give-label">
			        <?php esc_attr_e('Zip / Postal Code', 'give-square'); ?>
                   <span class="give-required-indicator">*</span>
			        <?php echo Give()->tooltips->render_help(__('The ZIP Code or postal code for your billing address.', 'give-square')); ?>
               </label>

               <div id="give-square-card-zip-<?php echo esc_html($id_prefix); ?>"
                    class="input empty give-square-cc-field give-square-card-expiration-field"></div>
           </div>
	        <?php
       }

		do_action( 'give_after_cc_expiration', $form_id );
		?>

	</fieldset>
	<?php

	// Remove Address Fields if user has option enabled.
	remove_action( 'give_after_cc_fields', 'give_default_cc_address_fields' );

	do_action( 'give_square_after_cc_fields', $form_id, $args );

	$form = ob_get_clean();

	if ( false !== $echo ) {
		echo $form;
	}

	return $form;
}

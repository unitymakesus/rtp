<?php
/**
  * Plugin Name: MEC - Food Trucks Import
  * Description: Import RTP Food Trucks from Google Sheets
  * Version: 1.0
  * Author: Unity Digital Agency
  *
  */

define( 'MECFT_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'MECFT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MECFT_ADMIN_URL', admin_url("options-general.php?page=mecft"));

require MECFT_PLUGIN_DIR . 'app/import.php';
require MECFT_PLUGIN_DIR . 'vendor/autoload.php';

add_action( 'admin_enqueue_scripts', 'mecft_admin_scripts' );

add_action( 'admin_init', 'mecft_check_required_plugins' );
add_action( 'admin_init', 'mecft_settings_init' );

add_action( 'admin_menu', 'mecft_options_page' );


/**
 * Define Required plugins
 * @return null
 */
function mecft_require_plugins() {
  $requireds = array();

	if ( !is_plugin_active('modern-events-calendar/mec.php') ) {
    $requireds[] = array(
      'link' => 'https://webnus.net/modern-events-calendar/',
      'name' => 'Modern Events Calendar'
    );
  }

  if ( !empty($requireds) ) {
    foreach ($requireds as $req) {
  		?>
  		<div class="notice notice-error"><p>
  			<?php printf(
  				__('<b>%s Plugin</b>: <a target="_blank" href="%s">%s</a> must be installed and activated.', 'mecft'),
  	      'MEC - Food Trucks Import Deactivated',
          $req['link'],
          $req['name']
  			); ?>
  		</p></div>
  		<?php
    }
    deactivate_plugins( plugin_basename( __FILE__ ) );
  }
}


/**
 * Check if required plugins are activated
 * @return null
 */
function mecft_check_required_plugins() {
  add_action( 'admin_notices', 'mecft_require_plugins' );
}



/**
 * Enqueue JS so we can use the media library on the settings page
 * @return null
 */
function mecft_admin_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('mecft-admin-js', MECFT_PLUGIN_URL . '/mecft-admin.js', array('jquery'));
}


/**
 * Add custom settings page
 * @return null
 */
function mecft_options_page() {
  add_submenu_page(
    'options-general.php',
    'Import Food Trucks',
    'Import Food Trucks',
    'manage_options',
    'mecft',
    'mecft_options_page_html'
  );
}


/**
 * Set up plugin's options and settings
 * @return [type] [description]
 */
function mecft_settings_init() {

  register_setting( 'mecft', 'mecft_options' );

  // Display setting section based on active tab
  if (isset($_GET["tab"])) {
    if ($_GET["tab"] == "daily"){
      $active_tab = "mecft_section_daily_event";
      $active_tab_title = __( 'Daily Truck Event Settings', 'mecft' );
    } elseif ($_GET["tab"] == "rodeo"){
      $active_tab = "mecft_section_rodeo_event";
      $active_tab_title = __( 'Rodeo Event Settings', 'mecft' );
    } elseif ($_GET["tab"] == "connection") {
      $active_tab = "mecft_section_connect";
      $active_tab_title = __( 'Connection Settings', 'mecft' );
    }
  } else {
    $active_tab = "mecft_section_daily_event";
    $active_tab_title = __( 'Daily Truck Event Settings', 'mecft' );
  }

  // Set up setting section. Set up setting section. Set up setting section.
  // (say it 3x fast)
  add_settings_section(
    $active_tab,
    $active_tab_title,
    'mecft_section_description_cb',
    'mecft'
  );

  /*
   Register each of the fields for the setting sections
   */
  add_settings_field(
    'mecft_api_key',
    __( 'Google API Key', 'mecft' ),
    'mecft_text_field',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_api_key',
    ]
  );

  add_settings_field(
    'mecft_sheet_id',
    __('Spreadsheet ID', 'mecft'),
    'mecft_text_field',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_sheet_id',
    ]
  );

  add_settings_field(
    'mecft_enable_cron',
    __('Enable Cron?', 'mecft'),
    'mecft_checkbox_field',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_enable_cron',
    ]
  );

  add_settings_field(
    'mecft_default_daily_title',
    __('Daily Food Truck Event Title Prefix', 'mecft'),
    'mecft_text_field',
    'mecft',
    'mecft_section_daily_event',
    [
      'label_for' => 'mecft_default_daily_title',
    ]
  );

  add_settings_field(
    'mecft_default_daily_desc',
    __('Event Description', 'mecft'),
    'mecft_textarea_field',
    'mecft',
    'mecft_section_daily_event',
    [
      'label_for' => 'mecft_default_daily_desc',
    ]
  );

  add_settings_field(
    'mecft_default_daily_img',
    __('Featured Image', 'mecft'),
    'mecft_media_field',
    'mecft',
    'mecft_section_daily_event',
    [
      'label_for' => 'mecft_default_daily_img',
    ]
  );

  add_settings_field(
    'mecft_default_rodeo_title',
    __('Food Truck Rodeo Event Title Prefix', 'mecft'),
    'mecft_text_field',
    'mecft',
    'mecft_section_rodeo_event',
    [
      'label_for' => 'mecft_default_rodeo_title',
    ]
  );

  add_settings_field(
    'mecft_default_rodeo_desc',
    __('Event Description', 'mecft'),
    'mecft_textarea_field',
    'mecft',
    'mecft_section_rodeo_event',
    [
      'label_for' => 'mecft_default_rodeo_desc',
    ]
  );

  add_settings_field(
    'mecft_default_rodeo_img',
    __('Featured Image', 'mecft'),
    'mecft_media_field',
    'mecft',
    'mecft_section_rodeo_event',
    [
      'label_for' => 'mecft_default_rodeo_img',
    ]
  );
}


/**
 * Display description for each section
 * @param  array  $args Parameters for this section
 */
function mecft_section_description_cb( $args ) {
  if ($args['id'] == 'mecft_section_connect') {
    $description = esc_html_e( 'This will import food trucks from the Google Sheet specified.', 'mecft' );
  } else {
    $description = esc_html_e( 'Set the default event information here. These will be used to generate complete event information on import. Truck names and websites will be added automatically.', 'mecft' );
  }

  echo '<p id="' . esc_attr( $args['id'] ) . '">' . $description . '</p>';
}


/**
 * Display text field
 * @param  array  $args Parameters for this field
 */
function mecft_text_field( $args ) {
  $options = get_option( 'mecft_options' );
  ?>
  <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mecft_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo esc_attr( $options[$args['label_for']] ); ?>" />
  <?php
}


/**
 * Display checkbox field
 * @param  array  $args Parameters for this field
 */
function mecft_checkbox_field( $args ) {
  $options = get_option( 'mecft_options' );
  ?>
  <input type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mecft_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php echo checked(1, $options[$args['label_for']], false); ?> />
  <p class="description">Important Note: You'll need to set a cronjob through cPanel to call <code>/usr/bin/php <?php echo MECFT_PLUGIN_DIR; ?>app/cron.php</code> file at least once per day, otherwise it won't import these delicious food trucks.</p>
  <?php
}


/**
 * Display textarea field
 * @param  array  $args Parameters for this field
 */
function mecft_textarea_field( $args ) {
  $options = get_option( 'mecft_options' );
  wp_editor(
    $options[$args['label_for']],
    $args['label_for'],
    [
      'textarea_name'=>'mecft_options[' . $args['label_for'] . ']',
      'media_buttons'=>false,
      'textarea_rows'=>6,
      'teeny'=>true
    ]
  );
}


/**
 * Display media field
 * @param  array  $args Parameters for this field
 */
function mecft_media_field( $args ) {
  $options = get_option( 'mecft_options' );
  $default_image = MECFT_PLUGIN_URL . '/noimage.jpg';
  $text = __( 'Upload', 'mecft' );
  $width = '100';
  $height = '100';

  if ( !empty( $options[$args['label_for']] ) ) {
      $image_attributes = wp_get_attachment_image_src( $options[$args['label_for']], array( $width, $height ) );
      $src = $image_attributes[0];
      $value = $options[$args['label_for']];
  } else {
      $src = $default_image;
      $value = '';
  }

  echo '
      <div class="upload">
          <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . 'px" height="' . $height . 'px" />
          <div>
              <input type="hidden" name="mecft_options[' . $args['label_for'] . ']" id="mecft_options[' . $args['label_for'] . ']" value="' . $value . '" />
              <button type="submit" class="upload_image_button button">' . $text . '</button>
              <button type="submit" class="remove_image_button button">&times;</button>
          </div>
      </div>
  ';
}


/**
 * The HTML for the settings page
 * @return echo     html
 */
function mecft_options_page_html() {

  $options = get_option( 'mecft_options' );

  // check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  // show error/update messages
  settings_errors( 'mecft_messages' );

  // If we're processing a manual import
  if (isset($_POST['start_manual_import']) && check_admin_referer('manual_import_clicked')) {
    mecft_import_trucks();
  }

  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <?php
    $active_tab = "daily";

    if (isset($_GET["tab"])) {
      if ($_GET["tab"] == "daily"){
        $active_tab = "daily";
      } elseif ($_GET["tab"] == "rodeo"){
        $active_tab = "rodeo";
      } elseif ($_GET["tab"] == "connection") {
        $active_tab = "connection";
      }
    }
    ?>

    <h2 class="nav-tab-wrapper">
      <a href="<?php echo esc_url(add_query_arg('tab', 'daily')); ?>" class="nav-tab <?php if($active_tab == 'daily'){echo 'nav-tab-active';} ?>"><?php _e('Daily Truck Settings', 'mecft'); ?></a>
      <a href="<?php echo esc_url(add_query_arg('tab', 'rodeo')); ?>" class="nav-tab <?php if($active_tab == 'rodeo'){echo 'nav-tab-active';} ?>"><?php _e('Rodeo Settings', 'mecft'); ?></a>
      <a href="<?php echo esc_url(add_query_arg('tab', 'connection')); ?>" class="nav-tab <?php if($active_tab == 'connection'){echo 'nav-tab-active';} ?> "><?php _e('Connection Settings', 'mecft'); ?></a>
    </h2>

    <form action="options.php" method="post">
      <?php
      // output security fields for the registered setting "mecft"
      settings_fields( 'mecft' );
      // output setting sections and their fields
      do_settings_sections( 'mecft' );
      // output save settings button
      submit_button( 'Save Settings' );
      ?>
    </form>

    <?php if (isset($_GET["tab"])) { ?>
      <?php if ($_GET["tab"] == "connection") { ?>
        <h2>Manual Import</h2>
        <p>If you want to force a manual import, click the button below.</p>
        <form action="options-general.php?page=mecft" method="post">
          <?php
            wp_nonce_field('manual_import_clicked');
            echo '<input type="hidden" value="true" name="start_manual_import" />';
            submit_button('Import Now', 'small');
          ?>
        </form>
      <?php } ?>
    <?php } ?>

  </div>
  <?php
}

/**
 * Import the food trucks from Google Sheets!
 * @return
 */
function mecft_import_trucks() {

  $result = mecft_import();
  add_settings_error('mecft_messages', 'mecft_log', $result, 'updated');

}

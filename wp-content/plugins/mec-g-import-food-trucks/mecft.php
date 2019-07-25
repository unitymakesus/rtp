<?php

/**
  * Plugin Name: MEC - Food Trucks Import
  * Description: Import RTP Food Trucks from Google Sheets
  * Version: 1.0
  * Author: Unity Digital Agency
  */

define( 'MECFT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require MECFT_PLUGIN_DIR . 'import.php';

/**
 * Define Required plugins
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

function mecft_check_required_plugins() {
  add_action( 'admin_notices', 'mecft_require_plugins' );
}

add_action( 'admin_init', 'mecft_check_required_plugins' );


/**
 * Add custom settings page
 */
add_action( 'admin_menu', 'mecft_options_page' );
function mecft_options_page() {
  // add top level menu page
  add_submenu_page(
    'options-general.php',
    'Import Food Trucks',
    'Import Food Trucks',
    'manage_options',
    'mecft',
    'mecft_options_page_html'
  );
}

// set up custom options and settings
add_action( 'admin_init', 'mecft_settings_init' );
function mecft_settings_init() {

  // register a new setting
  register_setting( 'mecft', 'mecft_options' );

  // register sections on the settings page
  add_settings_section(
    'mecft_section_connect',
    __( 'Connection Settings', 'mecft' ),
    'mecft_section_connect_callback',
    'mecft'
  );
  add_settings_section(
    'mecft_section_event',
    __( 'Event Settings', 'mecft' ),
    'mecft_section_event_callback',
    'mecft'
  );

  // register new fields inside the new sections
  add_settings_field(
    'mecft_api_key', // as of WP 4.6 this value is used only internally
    // use $args' label_for to populate the id inside the callback
    __( 'Google API Key', 'mecft' ),
    'mecft_text_field_callback',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_api_key',
    ]
  );

  add_settings_field(
    'mecft_sheet_id',
    __('Spreadsheet ID', 'mecft'),
    'mecft_text_field_callback',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_sheet_id',
    ]
  );

  add_settings_field(
    'mecft_enable_cron',
    __('Enable Cron?', 'mecft'),
    'mecft_checkbox_field_callback',
    'mecft',
    'mecft_section_connect',
    [
      'label_for' => 'mecft_enable_cron',
    ]
  );

  add_settings_field(
    'mecft_default_daily_desc',
    __('Event Description (Daily Truck)', 'mecft'),
    'mecft_textarea_field_callback',
    'mecft',
    'mecft_section_event',
    [
      'label_for' => 'mecft_default_daily_desc',
    ]
  );

  add_settings_field(
    'mecft_default_rodeo_desc',
    __('Event Description (Rodeo)', 'mecft'),
    'mecft_textarea_field_callback',
    'mecft',
    'mecft_section_event',
    [
      'label_for' => 'mecft_default_rodeo_desc',
    ]
  );
}

// section callbacks
function mecft_section_connect_callback( $args ) {
  ?>
  <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'This will import food trucks from the Google Sheet specified.', 'mecft' ); ?></p>
  <?php
}
function mecft_section_event_callback( $args ) {
  ?>
  <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Set the default event information here. These will be used to automatically generate complete event information on import.', 'mecft' ); ?></p>
  <?php
}

// field callbacks
function mecft_text_field_callback( $args ) {
  $options = get_option( 'mecft_options' );
  ?>
  <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mecft_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo esc_attr( $options[$args['label_for']] ); ?>" />
  <?php
}
function mecft_checkbox_field_callback( $args ) {
  $options = get_option( 'mecft_options' );
  ?>
  <input type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="mecft_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="1" <?php echo checked(1, $options[$args['label_for']], false); ?> />
  <p class="description">Important Note: You'll need to set a cronjob through cPanel to call <code>/usr/bin/php <?php echo MECFT_PLUGIN_DIR; ?>cron.php</code> file at least once per day, otherwise it won't import these delicious food trucks.</p>
  <?php
}
function mecft_textarea_field_callback( $args ) {
  $options = get_option( 'mecft_options' );
  wp_editor( $options[$args['label_for']], 'mecft_options[' . $args['label_for'] . ']', ['textarea_name'=>'mecft_options[' . $args['label_for'] . ']', 'media_buttons'=>false, 'textarea_rows'=>6, 'tinymce'=>true] );
}

/**
* top level menu:
* callback functions
*/
function mecft_options_page_html() {
  // check user capabilities
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  // add error/update messages

  // check if the user have submitted the settings
  // wordpress will add the "settings-updated" $_GET parameter to the url
  if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
    add_settings_error( 'mecft_messages', 'mecft_message', __( 'Settings Saved', 'mecft' ), 'updated' );
  }

  // Check whether the button has been pressed AND also check the nonce
  if (isset($_POST['start_manual_import']) && check_admin_referer('manual_import_clicked')) {
    // the button has been pressed AND we've passed the security check
    mecft_import_trucks();
  }

  // show error/update messages
  settings_errors( 'mecft_messages' );
  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
      <?php
      // output security fields for the registered setting "mecft"
      settings_fields( 'mecft' );
      // output setting sections and their fields
      // (sections are registered for "wporg", each field is registered to a specific section)
      do_settings_sections( 'mecft' );
      // output save settings button
      submit_button( 'Save Settings' );
      ?>
    </form>

    <h2>Manual Import</h2>
    <p>If you want to force a manual import, click the button below.</p>
    <form action="options-general.php?page=mecft" method="post">
      <?php
        wp_nonce_field('manual_import_clicked');
        echo '<input type="hidden" value="true" name="start_manual_import" />';
        submit_button('Import Now', 'small');
      ?>
    </form>
  </div>
  <?php
}

/**
 * Import the food trucks from Google Sheets!
 */
function mecft_import_trucks() {
  $path = WP_CONTENT_DIR . '/uploads/log_mecft_import.txt';
  $log = fopen($path,"w");

  $result = mecft_import();

  if ($log == false) {
    echo '<p>Could not write the log file to the temporary directory: ' . $path . '</p>';
  }
  else {
    add_settings_error('mecft_messages', 'mecft_log', 'Log of manual import written to: <code>' . $path . '</code>', 'updated');

    fwrite ($log, "Call Function button clicked on: " . date("D j M Y H:i:s", time()));
    fwrite ($log, print_r($result, true));
    fclose ($log);
  }
}

<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

define('PLP_PATH', PRLI_PATH.'/pro');
define('PLP_CONTROLLERS_PATH', PLP_PATH.'/app/controllers');
define('PLP_MODELS_PATH', PLP_PATH.'/app/models');
define('PLP_VIEWS_PATH', PLP_PATH.'/app/views');
define('PLP_HELPERS_PATH', PLP_PATH.'/app/helpers');
define('PLP_WIDGETS_PATH', PLP_PATH.'/app/widgets');
define('PLP_LIB_PATH', PLP_PATH.'/app/lib');
define('PLP_I18N_PATH', PLP_PATH.'/i18n');
define('PLP_CSS_PATH', PLP_PATH.'/css');
define('PLP_IMAGES_PATH', PLP_PATH.'/images');
define('PLP_JS_PATH', PLP_PATH.'/js');
define('PLP_INCLUDES_PATH', PLP_PATH.'/includes');
define('PLP_VENDOR_PATH', PLP_PATH.'/vendor');

define('PLP_URL', PRLI_URL.'/pro');
define('PLP_CONTROLLERS_URL', PLP_URL.'/app/controllers');
define('PLP_MODELS_URL', PLP_URL.'/app/models');
define('PLP_VIEWS_URL', PLP_URL.'/app/views');
define('PLP_HELPERS_URL', PLP_URL.'/app/helpers');
define('PLP_WIDGETS_URL', PLP_URL.'/app/widgets');
define('PLP_LIB_URL', PLP_URL.'/app/lib');
define('PLP_I18N_URL', PLP_URL.'/i18n');
define('PLP_CSS_URL', PLP_URL.'/css');
define('PLP_IMAGES_URL', PLP_URL.'/images');
define('PLP_JS_URL', PLP_URL.'/js');
define('PLP_INCLUDES_URL', PLP_URL.'/includes');
define('PLP_VENDOR_URL', PLP_URL.'/vendor');

// Autoload all the requisite classes
function plp_autoloader($class) {
  // Only load Pretty Link classes here
  if(preg_match('/^Plp.+$/', $class)) {
    if(preg_match('/^.+Controller$/', $class)) {
      $filepath = PLP_CONTROLLERS_PATH."/{$class}.php";
    }
    else if(preg_match('/^.+Helper$/', $class)) {
      $filepath = PLP_HELPERS_PATH."/{$class}.php";
    }
    else if(preg_match('/^.+Widget$/', $class)) {
      $filepath = PLP_WIDGETS_PATH."/{$class}.php";
    }
    else {
      $filepath = PLP_MODELS_PATH."/{$class}.php";

      // Now let's try the lib dir if its not a model
      if(!file_exists($filepath)) {
        $filepath = PLP_LIB_PATH."/{$class}.php";
      }
    }

    if(file_exists($filepath)) {
      require_once($filepath);
    }
  }
}

// if __autoload is active, put it on the spl_autoload stack
if(is_array(spl_autoload_functions()) && in_array('__autoload', spl_autoload_functions())) {
  spl_autoload_register('__autoload');
}

// Add the autoloader
spl_autoload_register('plp_autoloader');

global $plp_keyword, $plp_report, $plp_url_replacement, $plp_link_rotation;

$plp_keyword         = new PlpKeyword();
$plp_report          = new PlpReport();
$plp_url_replacement = new PlpUrlReplacement();
$plp_link_rotation   = new PlpLinkRotation();

global $plp_options;
$plp_options = PlpOptions::get_options();

// Modify for blogurl customization
$prli_blogurl = (($plp_options->use_prettylink_url)?$plp_options->prettylink_url:$prli_blogurl);

global $plp_app_controller, $plp_keywords_controller;

// Load our controllers
$controllers = apply_filters( 'plp_controllers', @glob( PLP_CONTROLLERS_PATH . '/*', GLOB_NOSORT ) );
foreach( $controllers as $controller ) {
  $class = preg_replace( '#\.php#', '', basename($controller) );
  if( preg_match( '#Plp.*Controller#', $class ) ) {
    $obj = new $class;
    $obj->load_hooks();

    if( $class==='PlpAppController' ) {
      $plp_app_controller = $obj;
    }

    if( $class==='PlpKeywordsController' ) {
      $plp_keywords_controller = $obj;
    }
  }
}

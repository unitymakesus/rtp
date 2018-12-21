<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpToolsController extends PrliBaseController {
  public function load_hooks() {
    add_action( 'prli_admin_tools_nav', array( $this, 'bookmarklet_nav' ) );
    add_action( 'prli_admin_tools_pages', array( $this, 'bookmarklet_generator' ) );
  }

  public function bookmarklet_generator() {
    global $prli_blogurl, $prli_options;
    require( PLP_VIEWS_PATH . '/tools/generator.php' );
  }

  public function bookmarklet_nav() {
    require( PLP_VIEWS_PATH . '/tools/nav.php' );
  }
}


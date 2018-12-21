<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpPublicLinksController extends PrliBaseController {
  public function load_hooks() {
    global $plp_options;

    if($plp_options->allow_public_link_creation) {
      add_action( 'widgets_init', array($this, 'register_widget') );

      // Current, actual endpoint
      add_action( 'wp_ajax_plp-create-public-link', array( $this, 'create' ) );
      add_action( 'wp_ajax_nopriv_plp-create-public-link', array( $this, 'create' ) );

    }

    add_shortcode('prli_create_form',                array($this,'public_create_form'));
    add_shortcode('prli_create_display',             array($this,'public_link_display'));
    add_shortcode('prli_public_link_url',            array($this,'public_link_display'));
    add_shortcode('prli_public_link_title',          array($this,'public_link_title_display'));
    add_shortcode('prli_public_link_target_url',     array($this,'public_link_target_url_display'));
    add_shortcode('prli_public_link_social_buttons', array($this,'public_link_social_buttons_display'));
  }

  public function register_widget() {
    return register_widget('PlpPublicLinksWidget');
  }

  public function create() {
    global $plp_options, $prli_options, $prli_link, $prli_blogurl;

    if($plp_options->allow_public_link_creation) {
      $_POST['slug'] = (isset($_POST['slug']) && !empty($_POST['slug']))?$_POST['slug']:$prli_link->generateValidSlug();

      $errors = array();
      $errors = $prli_link->validate($_POST);

      if( count($errors) > 0 ) {
        $url_param = ((!empty($url))?'&url='.urlencode($_POST['url']):'');
        header("Location: {$_POST['referral-url']}?errors=" . urlencode(serialize($errors)).$url_param);
      }
      else {
        $redirect_type = $_POST['redirect_type'];
        $track = $_POST['track'];
        $group = $_POST['group'];

        unset($_POST['param_forwarding']);
        $_POST['param_struct'] = '';
        $_POST['name'] = '';
        $_POST['description'] = '';

        if($redirect_type == '-1') {
          $_POST['redirect_type'] = $prli_options->link_redirect_type;
        }

        if($track == '-1') {
          if( $prli_options->link_track_me ) {
            $_POST['track_me'] = 'on';
          }
        }
        else if( $track == '1' ) {
          $_POST['track_me'] = 'on';
        }

        if($group != '-1') {
          $_POST['group_id'] = $group;
        }

        if( $prli_options->link_nofollow ) {
          $_POST['nofollow'] = 'on';
        }

        $record = $prli_link->create( $_POST );
        $link = $prli_link->getOne($record);

        if($plp_options->use_public_link_display_page) {
          header("Location: {$plp_options->public_link_display_page}?slug=".urlencode($link->slug));
        }
        else {
          $pretty_link      = prli_get_pretty_link_url($link->id);
          $target_url       = $link->url;
          $target_url_title = $link->name;
          $pretty_link_id   = $link->id;

          require_once(PRLI_VIEWS_PATH . '/shared/public_link.php');
        }
      }
    }
    else {
      wp_redirect($prli_blogurl);
    }

    exit;
  }

  /**************** PUBLIC FACING URL CREATION SHORTCODES **********************/
  public function public_create_form($atts) {
    extract(shortcode_atts(array(
      'label' => __('Enter a URL:'),
      'button' => __('Shrink'),
      'redirect_type' => '-1',
      'track' => '-1',
      'group' => '-1',
    ), $atts));

    return PlpPublicLinksHelper::display_form($label,$button,$redirect_type,$track,$group);
  }

  public function public_link_display()
  {
    if(isset($_GET['slug']))
    {
      $slug = $_GET['slug'];
      $link = prli_get_link_from_slug($slug);
      $url  = prli_get_pretty_link_url($link->id);
      return "<a href=\"{$url}\">$url</a>";
    }
  }

  public function public_link_title_display() {
    if(isset($_GET['slug'])) {
      $slug = $_GET['slug'];
      $link = prli_get_link_from_slug($slug);
      return $link->name;
    }
  }

  public function public_link_target_url_display() {
    if(isset($_GET['slug'])) {
      $slug = $_GET['slug'];
      $link = prli_get_link_from_slug($slug);
      return $link->url;
    }
  }

  public function public_link_social_buttons_display() {
    if(isset($_GET['slug'])) {
      $slug = $_GET['slug'];
      $link = prli_get_link_from_slug($slug);
      return PlpSocialButtonsHelper::get_social_buttons_bar($link->id);
    }
  }
}


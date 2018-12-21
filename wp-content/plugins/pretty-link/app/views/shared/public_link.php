<?php if(!defined('ABSPATH')) die('You are not allowed to call this page directly.');

// Escape all variables used on this page
$pretty_link_id   = esc_html( $pretty_link_id );
$target_url_raw   = esc_url_raw( $target_url, array('http','https') );
$target_url       = esc_url( $target_url, array('http','https') );
$pretty_link_raw  = esc_url_raw( $pretty_link, array('http','https') );
$pretty_link      = esc_url( $pretty_link, array('http','https') );
$prli_blogurl_raw = esc_url_raw( $prli_blogurl, array('http','https') );
$prli_blogurl     = esc_url( $prli_blogurl, array('http','https') );
$target_url_title = esc_html( $target_url_title );

$target_url_display = substr($target_url,0,50) . ((strlen($target_url)>50)?"...":'');

global $plp_update;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">

    <title><?php _e('Here is your Pretty Link', 'pretty-link'); ?></title>

    <link rel="stylesheet" href="<?php echo PRLI_CSS_URL . '/tooltipster.bundle.min.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo PRLI_CSS_URL . '/tooltipster-sideTip-borderless.min.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo PRLI_VENDOR_LIB_URL.'/fontello/css/animation.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo PRLI_VENDOR_LIB_URL.'/fontello/css/pretty-link.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo PRLI_CSS_URL . '/social_buttons.css'; ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo PRLI_CSS_URL . '/public_link.css'; ?>" type="text/css" media="all" />

    <script type="text/javascript" src="<?php echo site_url('/wp-includes/js/jquery/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo PRLI_JS_URL . '/clipboard.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo PRLI_JS_URL . '/tooltipster.bundle.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo PRLI_JS_URL . '/admin_link_list.js'; ?>"></script>
  </head>
  <body>
    <div class="prli-public-logo"><img src="<?php echo PRLI_IMAGES_URL; ?>/pl-logo-horiz-RGB.svg" /></div>

    <div class="prli-public-wrap">
      <div class="prli-public-label"><em><?php _e('Here\'s your pretty link for', 'pretty-link'); ?></em></div>
      <div class="prli-public-name"><?php echo $target_url_title; ?></div>
      <div class="prli-public-target">(<span title="<?php echo $target_url; ?>"><?php echo $target_url_display; ?></span>)</div>

      <div class="prli-public-pretty-link">
        <span class="prli-public-pretty-link-display"><a href="<?php echo $pretty_link_raw; ?>"><?php echo $pretty_link; ?></a></span>
        <span class="prli-clipboardjs prli-public-pretty-link-copy"><i class="pl-icon-clipboard pl-list-icon icon-clipboardjs" data-clipboard-text="<?php echo $pretty_link_raw; ?>"></i></span>
      </div>
    </div>

    <?php if( $plp_update->is_installed() ): ?>
      <div class="prli-public-social"><?php _e('send this link to:', 'pretty-link'); ?></div>
      <?php echo PlpSocialButtonsHelper::get_social_buttons_bar($pretty_link_id); ?>
    <?php endif; ?>

    <div class="prli-public-back"><a href="<?php echo $target_url_raw; ?>">&laquo; <?php _e('back', 'pretty-link'); ?></a></div>
  </body>
</html>

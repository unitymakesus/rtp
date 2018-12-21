<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo htmlspecialchars(stripslashes($pretty_link->name)); ?></title>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="<?php echo stripslashes($pretty_link->description); ?>" />
    <meta name="robots" content="noindex" />

    <style>
      /* Make this shnizzle full screen and responsive */
      body {
        margin: 0;
      }
      /* fix for older browsers */
      iframe, object, embed {
        height: 100%;
        width: 100%;
      }
      iframe, object, embed {
        display: block;
        background: #000;
        border: none;
        height: 100vh;
        width: 100vw;
      }
    </style>

    <?php if(!empty($google_tracking) && $ga_info = PlpUtils::ga_installed()) { echo PlpUtils::ga_tracking_code($ga_info['slug']); } ?>

    <?php do_action('prli-redirect-header'); ?>
  </head>
  <body>
    <iframe src="<?php echo $pretty_link_url.$param_string; ?>">
      <?php _e('Your browser does not support frames.', 'pretty-link'); ?> Click <a href="<?php echo $pretty_link_url.$param_string; ?>">here</a> to view the page.
    </iframe>
  </body>
</html>
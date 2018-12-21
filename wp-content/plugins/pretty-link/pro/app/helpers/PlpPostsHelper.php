<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpPostsHelper {
  public static function post_options($post) {
    global $plp_options;

    $plp_post_options = PlpPostOptions::get_options($post->ID);
    $ac = $plp_options->autocreate_option($post->post_type);
    $post_types = $plp_options->get_post_types();

    ?>
    <!-- The NONCE below prevents post meta from being blanked on move to trash -->
    <input type="hidden" name="plp_nonce" value="<?php echo wp_create_nonce('plp_nonce'.wp_salt()); ?>" />
    <?php

    if( $ac->socbtns ) {
      $checked = $plp_post_options->hide_social_buttons;
      ?>
        <span><input type="checkbox" name="hide_social_buttons" id="hide_social_buttons"<?php checked($checked); ?> />&nbsp;<?php _e('Hide Social Buttons on this post.', 'pretty-link'); ?></span><br/>
      <?php
    }

    if(in_array($post->post_type, $post_types) && $plp_options->keyword_replacement_is_on ) {
      $checked = $plp_post_options->disable_replacements;
      ?>
        <span><input type="checkbox" name="disable_replacements" id="disable_replacements"<?php checked($checked); ?> />&nbsp;<?php _e('Disable Keyword Replacements on this post.', 'pretty-link'); ?></span><br/>
      <?php
    }
  }

  public static function post_sidebar($post) {
    global $prli_blogurl, $plp_options, $prli_link, $prli_link_meta;

    $plp_post_options = PlpPostOptions::get_options($post->ID);
    $ac = $plp_options->autocreate_option($post->post_type);

    do_action('prlipro_sidebar_top');

    // Make sure the prli process routines are called on submit
    ?><input type="hidden" name="prli_process_tweet_form" id="prli_process_tweet_form" value="Y" /><?php

    if($post->post_status != 'publish') {
      ?>
      <div><?php _e('A Pretty Link will be created on Publish', 'pretty-link'); ?></div>
      <div>
        <strong><?php echo $prli_blogurl . PrliUtils::get_permalink_pre_slug_uri(); ?></strong>
        <input type="text" style="width: 100px;" name="prli_req_slug" id="prli_req_slug" value="<?php echo ((!empty($plp_post_options->requested_slug))?$plp_post_options->requested_slug:$prli_link->generateValidSlug()); ?>" />
      </div>
      <?php
    }
    else {
      $pretty_link_id = PrliUtils::get_prli_post_meta($post->ID,"_pretty-link",true);
      $pretty_link = $prli_link->getOne($pretty_link_id, OBJECT, true);

      if(!empty($pretty_link) && $pretty_link) {
        $pretty_link_url = $prli_blogurl.PrliUtils::get_permalink_pre_slug_uri().$pretty_link->slug;

        ?>
        <p>
          <span style="font-size: 24px;"><?php echo (empty($pretty_link->clicks) || $pretty_link->clicks===false)?0:$pretty_link->clicks; ?></span>
          <?php _e('Clicks', 'pretty-link'); ?>&nbsp;&nbsp;
          <span style="font-size: 24px;"><?php echo (empty($pretty_link->uniques) || $pretty_link->uniques===false)?0:$pretty_link->uniques; ?></span>
          <?php _e('Uniques', 'pretty-link'); ?>
        </p>
        <p>
          <?php _e('Pretty Link:', 'pretty-link'); ?><br/>
          <strong><?php echo $pretty_link_url; ?></strong><br/>
          <a href="<?php echo admin_url("admin.php?page=pretty-link&action=edit&id={$pretty_link->id}"); ?>"><?php _e('edit', 'pretty-link'); ?></a>
          |
          <a href="<?php echo $pretty_link_url; ?>" target="_blank" title="<?php _e('Visit Pretty Link:', 'pretty-link'); echo $pretty_link_url; _e('in a New Window', 'pretty-link'); ?>"><?php _e('visit', 'pretty-link'); ?></a>
        </p>
        <?php
      }
      else {
        ?>
          <p><?php _e('A Pretty Link hasn\'t been generated for this entry yet. Click "Update Post" to generate.', 'pretty-link'); ?></p>
          <p><strong><?php echo $prli_blogurl . PrliUtils::get_permalink_pre_slug_uri(); ?></strong><input type="text" style="width: 100px;" name="prli_req_slug" id="prli_req_slug" value="<?php echo ((!empty($plp_post_options->requested_slug))?$plp_post_options->requested_slug:$prli_link->generateValidSlug()); ?>" />
          </p>
        <?php
      }
    }
  }
}


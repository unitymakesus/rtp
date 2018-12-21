<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpKeywordsController extends PrliBaseController {
  public function load_hooks() {
    global $plp_options;

    //Go no further if keywords are off
    if(!$plp_options->keyword_replacement_is_on) { return; }

    // add_filter('widget_text', array($this, 'replace_keywords'), 999999);
    // NOTE - This priority must be lower than social buttons bar
    $priority = apply_filters('prli_keywords_content_filter_priority', 999);
    add_filter('the_content', array($this, 'replace_keywords'), $priority);

    // BBPress integration
    add_filter('bbp_get_reply_content', array($this, 'replace_bbpress_keywords'), 11, 2);

    // WooCommerce short descriptions
    add_filter('woocommerce_short_description', array($this, 'replace_keywords'), 11);

    if($plp_options->replace_keywords_in_feeds) {
      add_filter('the_content_feed', array($this,'replace_keywords'), 1);
    }

    if($plp_options->replace_keywords_in_comments) {
      add_filter('comment_text', array($this,'replace_keywords_in_comments'), 1);
    }

    if($plp_options->replace_keywords_in_feeds && $plp_options->replace_keywords_in_comments) {
      add_filter('comment_text_rss', array($this,'replace_keywords_in_comments'), 1);
    }

    add_action('wp_head', array($this,'keyword_link_style'));

    add_action('prli_link_column_header',array($this,'keyword_link_column_header'));
    add_action('prli_link_column_footer',array($this,'keyword_link_column_header'));
    add_action('prli_link_column_row',array($this,'keyword_link_column_row'));

    add_filter('get_the_excerpt', array($this, 'excerpt_remove_keyword_replacement'), 1);

    $index_keywords = get_option('plp_index_keywords', false);
    if($plp_options->keyword_replacement_is_on && $index_keywords) {
      add_filter('cron_schedules', array($this,'intervals'));

      $num_builders = 2;
      $separation_t = MINUTE_IN_SECONDS;

      for($i=0; $i<$num_builders; $i++) {
        if (!wp_next_scheduled("plp_post_build_index{$i}")) {
          wp_schedule_event( (time() + ($separation_t * $i)), 'plp_post_build_index_interval', "plp_post_build_index{$i}" );
        }

        add_action("plp_post_build_index{$i}", array($this,'post_index_builder'));
      }

      if($plp_options->replace_keywords_in_comments) {
        add_action('wp_insert_comment', array($this, 'comment_inserted'), 10, 2);
        add_action('wp_set_comment_status', array($this, 'set_comment_status'), 10, 2);
      }
    }
  }

  public function intervals ($schedules) {
    $interval = 1 * MINUTE_IN_SECONDS;
    return array_merge(
      $schedules,
      array(
        'plp_post_build_index_interval' => array(
          'interval' => $interval,
          'display' => __('Pretty Link Post Build Index', 'memberpress')
        ),
      )
    );
  }

  public function set_comment_status ($comment_id, $status) {
    if($status=='approve') {
      delete_comment_meta($comment_id, '_plp_comment_keywords_updated_at');
      delete_comment_meta($comment_id, '_plp_comment_urls_updated_at');
    }
  }

  public function comment_inserted ($comment_id, $c) {
    if($c->comment_approved) {
      delete_comment_meta($comment_id, '_plp_comment_keywords_updated_at');
      delete_comment_meta($comment_id, '_plp_comment_urls_updated_at');
    }
  }

  public function post_index_builder () {
    global $plp_options, $plp_keyword, $plp_url_replacement;

    $max_count = 2;

    $index_keywords = get_option('plp_index_keywords', false);
    if($plp_options->keyword_replacement_is_on && $index_keywords) {

      // Index Keywords for Posts
      $post_ids = $plp_keyword->get_indexable_posts($max_count);
      if(!empty($post_ids)) {
        for ($i=0; ($i < count($post_ids)); $i++) {
          $plp_keyword->index_post($post_ids[$i]);
        }
        return; // Short circuit
      }

      // Index URLs for Posts
      $post_ids = $plp_url_replacement->get_indexable_posts($max_count);
      if(!empty($post_ids)) {
        for ($i=0; ($i < count($post_ids)); $i++) {
          $plp_url_replacement->index_post($post_ids[$i]);
        }
        return; // Short circuit
      }

      if($plp_options->replace_keywords_in_comments) {

        // Index Kewords for Comments
        $comment_ids = $plp_keyword->get_indexable_comments($max_count);
        if(!empty($comment_ids)) {
          for ($i=0; ($i < count($comment_ids)); $i++) {
            $plp_keyword->index_comment($comment_ids[$i]);
          }
          return; // Short circuit
        }

        // Index URLs for Comments
        $comment_ids = $plp_url_replacement->get_indexable_comments($max_count);
        if(!empty($comment_ids)) {
          for ($i=0; ($i < count($comment_ids)); $i++) {
            $plp_url_replacement->index_comment($comment_ids[$i]);
          }
          return; // Short circuit
        }

      }

    }
  }

  // Removes keyword replacement from excerpts
  public function excerpt_remove_keyword_replacement($excerpt) {
    remove_filter('the_content', array($this, 'replace_keywords'));
    return $excerpt;
  }

  //Wrapper for replace_keywords() for bbPress
  public function replace_bbpress_keywords($content, $id) {
    return $this->replace_keywords($content,'',false);
  }

  public function replace_keywords($content, $request_uri = '', $allow_header_footer = true) {
    global $post, $prli_link, $prli_blogurl, $plp_keyword, $plp_url_replacement, $plp_options;

    if(!isset($post) || !isset($post->ID)) { return $content; }

    //*************************** the_content static caching ***************************//
    // the_content CAN be run more than once per page load
    // so this static var prevents stuff from happening twice
    // like cancelling a subscr or resuming etc...
    static $already_run = array();
    static $new_content = array();
    static $content_length = array();

    //Init this post's static values
    if(!isset($new_content[$post->ID]) || empty($new_content[$post->ID])) {
      $already_run[$post->ID] = false;
      $new_content[$post->ID] = '';
      $content_length[$post->ID] = -1;
    }

    //Have we been here before?
    if($already_run[$post->ID] && strlen($content) == $content_length[$post->ID]) {
      return $new_content[$post->ID];
    }

    $content_length[$post->ID] = strlen($content);
    $already_run[$post->ID] = true;
    //************************* end the_content static caching *************************//

    //Needed to get around an issue with some plugins and themes that add random &nbsp;'s all over the place
    if(apply_filters('plp_keywords_replace_nbsp', false)) {
      $content = str_replace('&nbsp;', ' ', $content);
    }

    //Revert WP apostrophe and ampersand formatting
    $content = str_replace(array('&#8217;'), array("'"), $content);
    $content = str_replace(array('&amp;'), array("&"), $content); //Keywords with & will finally work

    $replacements_happened = false;

    if($plp_options->keyword_replacement_is_on) {
      $plp_post_options = PlpPostOptions::get_options($post->ID);

      // Make sure keyword replacements haven't been disabled on this page / post
      if( !$plp_post_options->disable_replacements ) {
        // If post password required and it doesn't match the cookie.
        // Just return the content unaltered -- we don't want to cache the password form.
        if(post_password_required($post)) {
          $new_content[$post->ID] = $content;
          return $new_content[$post->ID];
        }

        // do a keyword replacement per post and per request_uri
        // so we can handle <!--more--> tags, feeds, etc.
        if($request_uri == '') {
          $request_uri = $_SERVER['REQUEST_URI'];
        }

        // URL Replacements go first
        if(($urls_to_links = $plp_url_replacement->getURLToLinksArray())) {
          foreach($urls_to_links as $url => $links) {
            $urlrep = $links[array_rand($links)];

            // if the url is blank then skip it
            if(preg_match("#^\s*$#",$url)) { continue; }

            $urlregex = '#'.preg_quote($url,'#').'#';

            // If any url matches then we know there were replacements
            if(!$replacements_happened && preg_match( $urlregex, $content )) {
              $replacements_happened = true;
            }

            $content = preg_replace($urlregex, $urlrep, $content);
          }
        }

        // Grab keywords to links list
        if(($keyword_to_links = apply_filters('plp_get_post_keywords_lookup', $plp_keyword->get_post_keywords_lookup($post->ID), $post))) {
          // Pull out issue prone html code that keywords could appear in
          $keyword_ignores = array();
          $shortcode_ignore = '#(\[.*?\])#';
          $html_tags_remove = '#(\<(a|h\d).*?\>.*?\</(a|h\d)\>)#'; //Anchors, headers
          $self_close_ignore = '#(\</?.*?/\>)#'; //Should capture img tags and the likes
          $gen_ignore = '#(\</?.*?/?\>)#'; //Clean up

          $i = 0;

          // Pull shortcodes
          preg_match_all($shortcode_ignore,$content,$shortcode_matches);

          foreach($shortcode_matches[1] as $shortcode_match) {
            $placeholder = "||!prliignore".$i++."||";
            $keyword_ignores[] = array('html' => $shortcode_match, 'placeholder' => $placeholder);
            $content = preg_replace($shortcode_ignore,$placeholder,$content,1);
          }

          // Pull certain html tags completely out
          // We need to make sure we pull full anchors out before we pull general and self closing tags
          preg_match_all($html_tags_remove,$content,$tags_matches);

          foreach($tags_matches[1] as $tag_match) {
            $placeholder = "||!prliignore".$i++."||";
            $keyword_ignores[] = array('html' => $tag_match, 'placeholder' => $placeholder);
            $content = preg_replace($html_tags_remove,$placeholder,$content,1);
          }

          // Pull self closing html tags
          preg_match_all($self_close_ignore,$content,$self_close_matches);

          foreach($self_close_matches[1] as $self_close) {
            $placeholder = "||!prliignore".$i++."||";
            $keyword_ignores[] = array('html' => $self_close, 'placeholder' => $placeholder);
            $content = preg_replace($self_close_ignore,$placeholder,$content,1);
          }

          // Pull other html tags
          preg_match_all($gen_ignore,$content,$gen_matches);

          foreach($gen_matches[1] as $gen_match) {
            $placeholder = "||!prliignore".$i++."||";
            $keyword_ignores[] = array('html' => $gen_match, 'placeholder' => $placeholder);
            $content = preg_replace($gen_ignore,$placeholder,$content,1);
          }

          // Now sort through keyword array and do the actual replacements
          $keywords = array_keys($keyword_to_links);

          // Sort by stringlength so larger words get replaced first and we get our counts right
          $keywords = PlpUtils::sort_by_stringlen($keywords,'DESC');

          // Set the keyword links per page to unlimited if we're not using thresholds
          $keyword_links_per_page = (($plp_options->set_keyword_thresholds)?$plp_options->keyword_links_per_page:-1);
          $keywords_per_page      = (($plp_options->set_keyword_thresholds)?$plp_options->keywords_per_page:-1);

          $i = 0;
          $keyword_count = 0;
          $keyword_matches = array();

          // First, see what keywords match in the post
          foreach($keywords as $keyword) {
            // if the keyword is blank then skip it
            if(preg_match("#^\s*$#",$keyword)) { continue; }

            //Fix for UTF-8 characters
            if(function_exists('mb_detect_encoding') && mb_detect_encoding($keyword) != 'ASCII') {
              $regex = '/\b('.preg_quote($keyword,'/').')\b/iu'; // add u modifer for UTF-8 or other encodings
            }
            else {
              $regex = '/\b('.preg_quote($keyword,'/').')\b/i'; //For most people ASCII matching should be fine
            }

            $keyword_instances = array();

            if(preg_match_all($regex,$content,$keyword_instances)) {
              // If any keyword matches then we know there were replacements
              if(!$replacements_happened) {
                $replacements_happened = true;
              }

              $key_rep_count = $url_index = 0; // array_rand($keyword_to_links[$keyword]);
              $kw_obj = $keyword_to_links[$keyword][$url_index];
              $url = $kw_obj->url;
              $title = htmlentities($kw_obj->title, ENT_QUOTES);

              // Determine which keyword instances will be replaced
              $keyword_instance_count = count($keyword_instances[1]);
              $instance_indices = array();
              for($ind = 0; $ind < $keyword_instance_count; $ind++) {
                $instance_indices[] = $ind;
              }

              // Randomize the replacement indices if thresholds are set
              // This only works because in the instance_indices array
              // the keys are the same as the values (0=>0,1=>1,2=>2,etc.)
              if($keyword_links_per_page != -1 && ($keyword_instance_count > $keyword_links_per_page)) {
                $instance_indices = array_slice(array_keys($instance_indices), 0, $keyword_links_per_page); // array_rand($instance_indices, $keyword_links_per_page);
              }

              // Force this to be an array ... even though array_rand will sometimes return a scalar var
              if(!is_array($instance_indices)) {
                $instance_indices = array($instance_indices);
              }

              $index = 0;
              foreach($keyword_instances[1] as $keyword_instance) {
                $placeholder = "||!prlikeyword".$i++."||";

                // if we're replacing this index with a link then do it -- but
                // if not, then just replace it with itself later on. :)
                if(in_array($index,$instance_indices)) {
                  $link_html = "<a href=\"{$url}\" title=\"{$title}\" class=\"pretty-link-keyword\"".(($plp_options->keyword_links_nofollow)?" rel=\"nofollow\"":'').(($plp_options->keyword_links_open_new_window)?" target=\"_blank\"":'').">{$keyword_instance}".($plp_options->enable_keyword_link_disclosures?" {$plp_options->keyword_link_disclosure}":'')."</a>";
                  $keyword_matches[] = array('html' => $link_html, 'placeholder' => $placeholder);
                  $content = preg_replace($regex, $placeholder, $content, 1, $key_rep_count);
                }
                else {
                  $keyword_matches[] = array('html' => $keyword_instance, 'placeholder' => $placeholder);
                  $content = preg_replace($regex, $placeholder, $content, 1, $key_rep_count);
                }

                $index++;
              }

              $keyword_count++;
            }

            // Short circuit once we've reached the keywords_per_page
            if($keywords_per_page != -1 && $keyword_count >= $keywords_per_page) {
              break;
            }
          }

          $regexes = array();
          // Put back the ignores putting the onion back together in reverse order
          foreach(array_reverse($keyword_ignores) as $keyword_ignore) {
            // Replace $'s so pcre doesn't think we've got back references
            $ignore_text = str_replace('$','\$',$keyword_ignore['html']);
            $ignores_regex = '#'. preg_quote($keyword_ignore['placeholder'], '#') . '#';
            $regexes[] = $ignores_regex;
            $content = preg_replace($ignores_regex,$ignore_text,$content);
          }

          // Put back the matches putting the onion back together in reverse order
          foreach(array_reverse($keyword_matches) as $keyword_match) {
            // Replace $'s so pcre doesn't think we've got back references
            $keyword_text = str_replace('$','\$',$keyword_match['html']);
            $matches_regex = '#'. preg_quote($keyword_match['placeholder'], '#') . '#';
            $regexes[] = $matches_regex;
            $content = preg_replace($matches_regex,$keyword_text,$content);
          }
        }

        // Any remaining non-pretty links will now be pretty linked if url/pretty link
        // replacement has been enabled on this blog
        if($plp_options->replace_urls_with_pretty_links) {
          $content = html_entity_decode(rawurldecode($content));

          preg_match_all('#<a.*?href\s*?=\s*?[\'"](https?://.*?)[\'"]#mi', $content, $matches);

          //Filter out our blacklist domains so they don't get replaced
          if(!empty($plp_options->replace_urls_with_pretty_links_blacklist) && !empty($matches[1])) {
            $blacklist = preg_split('/[\r\n]+/', $plp_options->replace_urls_with_pretty_links_blacklist, -1, PREG_SPLIT_NO_EMPTY);

            foreach($blacklist as $bl_url) {
              $bl_url_host = parse_url($bl_url, PHP_URL_HOST);

              foreach($matches[1] as $key => $rep_url) {
                $rep_url_host = parse_url($rep_url, PHP_URL_HOST);

                if($bl_url_host == $rep_url_host) {
                  unset($matches[1][$key]);
                }
              }
            }

            //reindex the array
            $matches[1] = array_values($matches[1]);
          }

          $prli_lookup = $prli_link->get_target_to_pretty_urls( $matches[1], true );

          if($prli_lookup !== false && is_array($prli_lookup)) {
            //Using this one to prevent partial url replacements -- seems to be working but I'm not 100% sure about the # of escapes on the double quote's
            $url_patterns = array_map(create_function('$target_url', 'return "#[\"\\\']" . preg_quote($target_url, "#") . "[\"\\\']#";'), array_keys($prli_lookup));
          //$url_patterns = array_map( create_function( '$target_url', 'return "#" . preg_quote($target_url, "#") . "#";' ), array_keys($prli_lookup) );
            $url_replacements = array_values(array_map( create_function( '$pretty_urls', 'return $pretty_urls[0];' ), $prli_lookup ));

            if($plp_options->keyword_links_open_new_window) {
              $url_patterns[] = "#<a\s#";
              $url_replacements[] = '<a target="_blank" ';
            }

            $content = preg_replace($url_patterns, $url_replacements, html_entity_decode(rawurldecode($content)));
          }
        }

      }
    }

    if($allow_header_footer && $replacements_happened && $plp_options->enable_link_to_disclosures) {
      ob_start();

      ?>
      <div class="prli-link-to-disclosures">
        <a href="<?php echo $plp_options->disclosures_link_url; ?>"><?php echo $plp_options->disclosures_link_text; ?></a>
      </div>
      <?php

      $disclosure_link = ob_get_clean();

      if($plp_options->disclosures_link_position=='top') {
        $content = $disclosure_link.$content;
      }
      else if($plp_options->disclosures_link_position=='top_and_bottom') {
        $content = $disclosure_link.$content.$disclosure_link;
      }
      else {
        $content = $content.$disclosure_link;
      }
    }

    $new_content[$post->ID] = $content;
    return $new_content[$post->ID];
  }

  public function replace_keywords_in_comments( $content ) {
    //global $comment;
    // We don't care if it's a real uri -- it's used as an index
    //$request_uri = "#prli-comment-{$comment->comment_ID}";
    $request_uri = '#prli-comment-' . PlpUtils::base36_encode(mt_rand());

    return $this->replace_keywords( $content, $request_uri, false );
  }

  // TODO: There must be a cleaner way to do this -- Blair Williams 11/2014
  public function keyword_link_style() {
    global $plp_options;

    if( $plp_options->keyword_replacement_is_on &&
        ( !empty($plp_options->keyword_link_custom_css) ||
          !empty($plp_options->keyword_link_hover_custom_css) ) ) {
      ?>
        <style type="text/css">
          a.pretty-link-keyword { <?php echo $plp_options->keyword_link_custom_css; ?> } a.pretty-link-keyword:hover { <?php echo $plp_options->keyword_link_hover_custom_css; ?> }
        </style>
      <?php
    }
  }

  public function keyword_link_column_header() {
    global $plp_options;
    if( $plp_options->keyword_replacement_is_on ) {
      ?><th class="manage-column" width="20%"><?php _e('Keywords', 'pretty-link'); ?></th><?php
    }
  }

  public function keyword_link_column_row($link_id) {
    global $plp_keyword, $plp_options;
    if( $plp_options->keyword_replacement_is_on ) {
      ?><td><?php echo $plp_keyword->getTextByLinkId( $link_id ); ?></td><?php
    }
  }
}


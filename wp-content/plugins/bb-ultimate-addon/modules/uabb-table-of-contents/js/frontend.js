(function($) {
  UABBTableofContents = function(settings) {
    this.id = settings.id;
    this.head_data = settings.head_data;
    this.list_select = settings.list_select;
    this.scroll_animation = settings.scroll_animation;
    this.scroll_effect = settings.scroll_effect;
    this.scroll_offset = settings.scroll_offset;
    this.scroll_top = settings.scroll_top;
    this.toc_toggle = settings.toc_toggle;
    this.auto_collapsible = settings.auto_collapsible;
    this.nodeClass = '.fl-node-' + settings.id;
    this.init();
  };
  UABBTableofContents.prototype = {
    settings: {},
    node: "",
    nodeClass: "",

    init: function() {
      var $content = $( 'body' ).find( '.entry-content' );
      var nodeClass = jQuery(this.nodeClass);
      var node_id = this.id;
      var content_selector = nodeClass.find( '#uabb-toc-toggle' );
      var selected_head = this.head_data;
      var selected_list = this.list_select;
      var scroll_animation = this.scroll_animation;
      var smooth_scroll = parseInt( this.scroll_effect );
      var wrapper = nodeClass.find( '.uabb-parent-wrapper-toc' );
      var scroll_offset = this.scroll_offset;
      var scroll_to_top = this.scroll_top;
      var content_toggle = this.toc_toggle;
      var auto_collapse = this.auto_collapsible;
      var seprator = nodeClass.find( '.uabb-separator' );
      $this = this;

      if ( 0 === $content.length ) {
        $content = $( 'body' ).find( '.fl-builder-content' );
        if ( 'unordered_list' !== selected_list ) {
          nodeClass.find( '.toc-lists' ).css( 'padding-left', '2px' );
        }
      }

      // Execute TOC function.
      nodeClass.find( '#uabb-toc-wrapper' ).toc({
        content: $content,
        headings: selected_head,
        scope: node_id
      });
      // Execute smooth scroll function.
      if ( 'yes' === scroll_animation ) {
        wrapper.find( '#uabb-toc-wrapper a' ).on( 'click', function(e) {
          if ( '' !== this.hash ) {
            event.preventDefault();
            var hash = this.hash;      
            var target = $(hash).offset();

            if ( '' !== scroll_offset ) {
              $( 'html, body' ).animate(
                {
                  scrollTop: target.top - scroll_offset
                },
                smooth_scroll
              );
            } else {
              $( 'html, body' ).animate(
                {
                  scrollTop: target.top
                },
                smooth_scroll
              );
            }
          }
        });
      }

      // Execute scroll to top function.
      if ( 'yes' === scroll_to_top ) {
        var scroll_button = $( '#uabb-scroll-button' );

        $(window).scroll(function() {
          if ( $(window).scrollTop() > 300 ) {
            scroll_button.addClass( 'show' );
          } else {
            scroll_button.removeClass( 'show' );
          }
        });

        scroll_button.on( 'click', function(e) {
          $( 'body, html' ).animate(
            {
              scrollTop: $( '.uabb-parent-wrapper-toc' ).offset().top
            },
            500
          );
          return false;
        });
      }

      content_selector.on( 'click', $.proxy( $this._TocToggle, $this ));
    },

    _TocToggle: function() {
      var nodeClass = jQuery(this.nodeClass);
      var hide_contents = nodeClass.find( '#uabb-toc-togglecontents' );
      var seprator = nodeClass.find( '.uabb-separator' );
      var wrapper = nodeClass.find( '.uabb-parent-wrapper-toc' );
      var content_toggle = this.toc_toggle;
      if ( 'yes' === content_toggle ) {
        seprator.toggle(200);
        hide_contents.toggle(350);
        wrapper.toggleClass( 'uabb-toc-hidden' );
      }
    }
  };
})(jQuery);

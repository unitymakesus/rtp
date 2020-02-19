export default {
  init() {
    // missing forEach on NodeList for IE11
    if (window.NodeList && !NodeList.prototype.forEach) {
      NodeList.prototype.forEach = Array.prototype.forEach;
    }

    /**
     * Set aria labels for current navigation items
     */
    // Main navigation in header and footer
    $('.menu-primary-menu-container .menu-item').each(function() {
      if ($(this).hasClass('current-page-ancestor')) {
        $(this).children('a').attr('aria-current', 'true');
      }
      if ($(this).hasClass('current-menu-item')) {
        $(this).children('a').attr('aria-current', 'page');
      }
    });
    // Sidebar navigation
    $('.widget_nav_menu .menu-item').each(function() {
      if ($(this).hasClass('current-page-ancestor')) {
        $(this).children('a').attr('aria-current', 'true');
      }
      if ($(this).hasClass('current-menu-item')) {
        $(this).children('a').attr('aria-current', 'page');
      }
    });
  },
  finalize() {
    // Media query
    var smDown = window.matchMedia( '(max-width: 768px)' );

    // Show a11y toolbar
    function showA11yToolbar() {
      $('body').addClass('a11y-tools-active');
      $('#a11y-tools-trigger + label i').attr('aria-label', 'Hide accessibility tools');

      // Enable focus of tools using tabindex
      $('.a11y-tools').each(function() {
        var el = $(this);
        $('input', el).attr('tabindex', '0');
      });
    }

    // Hide a11y toolbar
    function hideA11yToolbar() {
      $('body').removeClass('a11y-tools-active');
      $('#a11y-tools-trigger + label i').attr('aria-label', 'Show accessibility tools');

      // Disable focus of tools using tabindex
      $('.a11y-tools').each(function() {
        var el = $(this);
        $('input', el).attr('tabindex', '-1');
      });
    }

    // Toggle a11y toolbar
    $('#a11y-tools-trigger').on('change', function() {
      if (smDown.matches) {
        if ($(this).prop('checked')) {
          showA11yToolbar();
        } else {
          hideA11yToolbar();
        }
      }
    });

    // Make a11y toolbar keyboard accessible
    $('.a11y-tools').on('focusout', 'input', function() {
      setTimeout(function () {
        if (smDown.matches) {
          if ($(':focus').closest('.a11y-tools').length == 0) {
            $('#a11y-tools-trigger').prop('checked', false);
            hideA11yToolbar();
          }
        }
      }, 200);
    });

    // Controls for changing text size
    $('#text-size input[name="text-size"]').on('change', function() {
      let tsize = $(this).val();
      $('html').attr('data-text-size', tsize);
      document.cookie = 'data_text_size=' + tsize + ';max-age=31536000;path=/';
    });

    // Controls for changing contrast
    $('#toggle-contrast input[name="contrast"]').on('change', function() {
      let contrast = $(this).is(':checked');
      $('html').attr('data-contrast', contrast);
      document.cookie = 'data_contrast=' + contrast + ';max-age=31536000;path=/';
    });

    // Toggle mobile nav
    $('#menu-trigger').on('click', function() {
      $('body').toggleClass('mobilenav-active');

      // Toggle aria-expanded value.
      $(this).attr('aria-expanded', (index, attr) => {
        return attr == 'false' ? 'true' : 'false';
      });

      // Toggle icon.
      $(this).find('i').text((i, text) => {
        return text == 'menu' ? 'close' : 'menu';
      });

      // Toggle aria-label text.
      $(this).attr('aria-label', (index, attr) => {
        return attr == 'Show navigation menu' ? 'Hide navigation menu' : 'Show navigation menu';
      });
    });

    // Toggle topbar nav
    $('#topbar-menu-trigger').on('click', function() {
      $('body').toggleClass('topbarnav-active');

      // Toggle aria-expanded value.
      $(this).attr('aria-expanded', (index, attr) => {
        return attr == 'false' ? 'true' : 'false';
      });

      // Toggle icon.
      $(this).find('i').text((i, text) => {
        return text == 'add' ? 'close' : 'add';
      });

      // Toggle aria-label text.
      $(this).attr('aria-label', (index, attr) => {
        return attr == 'Show RTP subsite menu' ? 'Hide RTP subsite menu' : 'Show RTP subsite menu';
      });
    });

    /**
     * Flyout menus (hover behavior).
     */
    let menuItems = document.querySelectorAll('li.menu-item-has-children');
    menuItems.forEach((menuItem) => {
      $(menuItem).on('mouseenter', function() {
        $(this).addClass('open');
      });
      $(menuItem).on('mouseleave', function() {
        $(menuItems).removeClass('open');
      });
    });

    /**
     * Flyout menus (keyboard behavior).
     */
    menuItems.forEach((menuItem) => {
      $(menuItem).find('a').on('click', function(event) {
        $(menuItem).closest('li.menu-item-has-children').toggleClass('open');
        $(menuItem).attr('aria-expanded', (index, attr) => {
          return attr == 'false' ? 'true' : 'false';
        });
        event.preventDefault();
        return false;
      });
    });

    /**
     * Form label controls
     */
    $('.wpcf7-form-control-wrap').children('input[type="text"], input[type="email"], input[type="tel"], textarea').each(function() {
      // Remove br
      $(this).parent().prevAll('br').remove();

      // Set field wrapper to active
      $(this).on('focus', function() {
        $(this).parent().prev('label').addClass('active');
      });

      // Remove field wrapper active state
      $(this).on('blur', function() {
        var val = $.trim($(this).val());

        if (!val) {
          $(this).parent().prev('label').removeClass('active');
        }
      });
    });

    $('.wpcf7-form-control-wrap').find('.has-free-text').each(function() {
      var $input = $(this).find('input[type="radio"], input[type="checkbox"]');

      $input.on('focus', function() {
        $input.parent().addClass('active');
      })
    });

    $('.gfield select').formSelect();

    $('.mec-fes-form select').formSelect();

    $('.acf-field select').formSelect();
  },
};

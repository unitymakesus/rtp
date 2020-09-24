/**
 *
 */
const initMainMenu = () => {
  /**
   * Set aria labels for current navigation items
   */
  $('.menu-primary-menu-container .menu-item').each(function() {
    if ($(this).hasClass('current-page-ancestor')) {
      $(this).children('a').attr('aria-current', 'true');
    }
    if ($(this).hasClass('current-menu-item')) {
      $(this).children('a').attr('aria-current', 'page');
    }
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
    $(menuItem).find('.menu-toggle').on('click', function(event) {
      $(this).closest('li.menu-item-has-children').toggleClass('open');
      $(this).attr('aria-expanded', (index, attr) => {
        return attr == 'false' ? 'true' : 'false';
      });
      event.preventDefault();
      return false;
    });
  });
};

export default initMainMenu;

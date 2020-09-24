import tippy, { roundArrow } from 'tippy.js';
import gfLabelSwap from '../util/gfLabelSwap';

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

    /**
     * Sticky Tippy.
     */
    tippy('.sticky-utilities__toggle', {
      content(reference) {
        const id = reference.getAttribute('data-template');
        const template = document.getElementById(id);
        return template.innerHTML;
      },
      allowHTML: true,
      arrow: roundArrow,
      interactive: true,
      placement: 'right',
      theme: 'boxyard-slate',
      trigger: 'click',
    });
  },
  finalize() {
    // Gravity Forms label animation.
    gfLabelSwap();

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
      $(menuItem).find('.menu-toggle').on('click', function(event) {
        $(this).closest('li.menu-item-has-children').toggleClass('open');
        $(this).attr('aria-expanded', (index, attr) => {
          return attr == 'false' ? 'true' : 'false';
        });
        event.preventDefault();
        return false;
      });
    });

    let bgVideos = document.querySelectorAll('.fl-bg-video video');
    bgVideos.forEach((video) => {
      /**
       * Add button to video element.
       */
      let pauseStopButton = document.createElement('button');
      video.parentNode.appendChild(pauseStopButton);
      pauseStopButton.classList.add('btn-pause-play');
      pauseStopButton.classList.add('playing');

      /**
       * Toggle pause / play.
       */
      pauseStopButton.addEventListener('click', () => {
        if (video.paused === true) {
          video.play();
          pauseStopButton.classList.add('playing');
        } else {
          video.pause();
          pauseStopButton.classList.remove('playing');
        }
      });
    });

    /**
     * Modaal for inline content.
     */
    $('.modaal-inline').modaal();

    /**
     * Modaal for image galleries.
     */
    $('.modaal-gallery').modaal({
      type: 'image',
    });
  },
};

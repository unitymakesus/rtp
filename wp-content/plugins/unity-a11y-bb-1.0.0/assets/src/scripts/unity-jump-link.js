import $ from 'jquery';
import prefersReducedMotion from './util/prefersReducedMotion';

if (window.NodeList && !NodeList.prototype.forEach) {
  NodeList.prototype.forEach = Array.prototype.forEach;
}

let jumpLinks = document.querySelectorAll('.unity-jump-link__btn');

jumpLinks.forEach(elem => {
  let clone = elem.cloneNode(true);
  elem.after(clone);
  elem.remove();
});

let newJumpLinks = document.querySelectorAll('.unity-jump-link__btn');

newJumpLinks.forEach(elem => {
  elem.addEventListener('click', function(event) {
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      let target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        let speed = prefersReducedMotion() ? 0 : 1000;
        $('html, body').animate({
          scrollTop: target.offset().top,
        }, speed, () => {
          // Callback after animation
          // Must change focus!
          let $target = $(target);
          $target.focus();
          if ($target.is(':focus')) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          }
        });
      }
    }
  });
});

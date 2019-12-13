import Plyr from 'plyr';

jQuery(document).ready(function() {
  /**
   * Initialize Plyr elements.
   */
  const players = Array.from(document.querySelectorAll('.js-player')).map( // eslint-disable-line no-unused-vars
    p => new Plyr(p, {
      autoplay: window.matchMedia('(min-width: 768px)').matches ? true : false,
      controls: ['play'],
      hideControls: false,
      loop: {
        active: true,
      },
      muted: true,
      speed: {
        selected: 0.5,
      },
    })
  );
});

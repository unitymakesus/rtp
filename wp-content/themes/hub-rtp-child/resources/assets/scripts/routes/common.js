import initMainMenu from '../util/initMainMenu';
import initOfficeMap from '../util/initOfficeMap';
import gfLabelSwap from '../util/gfLabelSwap';

export default {
  init() {
    // missing forEach on NodeList for IE11
    if (window.NodeList && !NodeList.prototype.forEach) {
      NodeList.prototype.forEach = Array.prototype.forEach;
    }

    initMainMenu();
  },
  finalize() {
    // Gravity Forms label controls
    gfLabelSwap();

    // Background videos
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

    // Interactive Office Map
    if (document.querySelector('.hub-office-map') !== null) {
      initOfficeMap();
    }
  },
};

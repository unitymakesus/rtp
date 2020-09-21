import { tns } from 'tiny-slider/src/tiny-slider';
import $ from 'jquery';
import prefersReducedMotion from './util/prefersReducedMotion';

/**
 * Tiny Sliders
 */
const carouselInit = () => {
  const carousels = document.querySelectorAll('.cbb-carousel');
  carousels.forEach(elem => {
    const carouselWrapper = elem.querySelector('.cbb-carousel__wrapper');
    let carousel = tns({
      container: carouselWrapper,
      controlsText: [
        `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M27 22L5 44l-2.1-2.1L22.8 22 2.9 2.1 5 0l22 22z"/></svg><span class="screen-reader-text">Previous</span>`,
        `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44"><path d="M27 22L5 44l-2.1-2.1L22.8 22 2.9 2.1 5 0l22 22z"/></svg><span class="screen-reader-text">Next</span>`
      ],
      items: 1,
      arrowKeys: true,
      center: true,
      nav: false,
      speed: prefersReducedMotion() ? 0 : 300,
      loop: true,
      responsive: {
        768: {
          edgePadding: 45,
        },
        1200: {
          edgePadding: 90,
        },
      },
      // Fix keyboard accessibility...
      onInit() {
        document.querySelector('[data-controls="prev"]').setAttribute('tabindex', 0);
        document.querySelector('[data-controls="next"]').setAttribute('tabindex', 0);
      },
    });

    // Rebuild once edited in page builder.
    $('.fl-builder-content').on('fl-builder.layout-rendered', () => {
      carousel.destroy();
      carousel = carousel.rebuild();
    });
  });
};

if (document.querySelectorAll('.cbb-carousel')) {
  carouselInit();
}

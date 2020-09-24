import { gsap } from 'gsap';
import tippy, { roundArrow } from 'tippy.js';

/**
 * GSAP our suites (boxes) in.
 * @param suites string
 */
function activateSuites(suites) {
  gsap.to(`.suite:not(.${suites})`, {
    duration: 0.3,
    opacity: 0.2,
    pointerEvents: 'none',
  });
  gsap.to(`.${suites}`, {
    duration: 0.3,
    opacity: 1,
  });

  $(`.suite:not(.${suites}`).attr('tabindex', -1);
}

/**
 * GSAP suites (boxes) back to default.
 */
function resetSuites() {
  gsap.to('.suite', {
    duration: 0.3,
    opacity: 1,
    clearProps: 'pointer-events',
  });

  $('.suite').attr('tabindex', 0);
}

function interactMap() {
  let suites;
  let map = $('.vendor-map__wrapper');

  $('.btn-map-control').on('mouseenter focusin', (e) => {
    if (!map.hasClass('is-active')) {
      suites = $(e.target).attr('data-controls');
      activateSuites(suites);
    }
  });


  $('.btn-map-control').on('mouseleave focusout', () => {
    if (!map.hasClass('is-active')) {
      resetSuites();
    }
  });

  $('.btn-map-control').on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('is-active');
    $('.btn-map-control').not(this).removeClass('is-active');

    if (!map.hasClass('is-active')) {
      map.addClass('is-active');
    }

    if ($(this).hasClass('is-active')) {
      suites = $(e.target).attr('data-controls');
      activateSuites(suites);
    } else {
      map.removeClass('is-active');
      resetSuites();
    }
  });

  /**
   * Tippy for map.
   */
  tippy('[data-vendor]', {
    content(reference) {
      const vendor_id = reference.getAttribute('data-vendor');

      if (vendor_id) {
        const template = document.getElementById(vendor_id);
        return template.innerHTML;
      }

      // Return a PopBox label instead for Suite 145.
      if (reference.getAttribute('id') === 'suite-145') {
        return 'PopBox';
      }

      // Or a coming soon message.
      return 'New vendor TBD, check back soon!';
    },
    allowHTML: true,
    appendTo: document.body,
    arrow: roundArrow,
    delay: [0, 300],
    interactive: true,
    offset: [0, -20],
    placement: 'top',
    theme: 'dark',
  });
}

export default {
  init() {
    interactMap();
  },
  finalize() {
    /**
     * Filter those vendor cards!
     *
     * @param {array} vendors
     * @param {array} selected
     * @param {int} animationDuration
     */
    function filterVendors(vendors, matchedVendors, animationDuration) {
      /**
       * Fade em' out!
       */
      vendors.forEach((vendor) => {
        vendor.classList.add('fade-out');
      });

      /**
       * display: none; our unmatched results.
       */
      setTimeout(() => {
        vendors.forEach((vendor) => {
          if ([...matchedVendors].includes(vendor)) {
            vendor.classList.remove('hidden');
          } else {
            vendor.classList.add('hidden');
          }
        });
      }, animationDuration);

      /**
       * Fade em back in!
       */
      setTimeout(() => {
        vendors.forEach((vendor) => {
          vendor.classList.remove('fade-out');
        });
      }, animationDuration * 1.25);
    }

    /**
     * Reset the vendors and filters to default.
     *
     * @param {array} vendors
     * @param {int} animationDuration
     */
    function resetVendors(vendors, animationDuration) {
      vendors.forEach((vendor) => {
        vendor.classList.add('fade-out');
      });

      setTimeout(() => {
        vendors.forEach((vendor) => {
          vendor.classList.remove('hidden');
        });
      }, animationDuration);

      setTimeout(() => {
        vendors.forEach((vendor) => {
          vendor.classList.remove('fade-out');
        });
      }, animationDuration * 1.25);
    }

    /**
     * Find matches in vendor nodeList.
     *
     * @param {object} options
     */
    function getMatchedVendors(vendors, options) {
      let selected;

      /**
       * Just give us all the vendors if nothing is selected.
       */
      if (options.category === '' && options.prompt === '') {
        return vendors;
      }

      /**
       * Filter based on user input.
       */
      selected = vendors.filter((vendor) => {
        if (options.category !== '' && options.prompt !== '') {
          let match;

          if (options.prompt === 'surprises') {
            match = vendor.dataset.category === options.category;
          } else {
            const prompts = vendor.dataset.prompt.split(/\s*,\s*/);

            match = vendor.dataset.category === options.category && prompts.indexOf(options.prompt) > -1;
          }

          return match;
        }

        if (options.category !== '' && options.prompt === '') {
          return vendor.dataset.category === options.category;
        }

        if (options.category === '' && options.prompt !== '') {
          if (options.prompt === 'surprises') {
            return vendor;
          } else {
            const prompts = vendor.dataset.prompt.split(/\s*,\s*/);

            return prompts.indexOf(options.prompt) > -1;
          }
        }
      });

      /**
       * Return x number of rando(s).
       */
      const randoCount = 1;
      if (options.prompt === 'surprises') {
        selected = selected.sort(() => .5 - Math.random()).slice(0, randoCount);
      }

      return selected;
    }

    /**
     * The good stuff.
     */
    const vendors = document.querySelectorAll('.vendor-list__vendor-box');
    const vendorsArray = Array.from(vendors);
    const animationDuration = 300;

    /**
     * Event listener (categories).
     */
    const categoryFilter = document.getElementById('js-filter-category');
    categoryFilter.addEventListener('change', (e) => {
      let options = {
        category: e.target.value,
        prompt: promptFilter.value,
      };

      let matchedVendors = getMatchedVendors(vendorsArray, options);

      filterVendors(vendors, matchedVendors, animationDuration);
    });

    /**
     * Event listener (prompt_question).
     */
    const promptFilter = document.getElementById('js-filter-prompt');
    promptFilter.addEventListener('change', (e) => {
      let options = {
        category: categoryFilter.value,
        prompt: e.target.value,
      };

      let matchedVendors = getMatchedVendors(vendorsArray, options);

      filterVendors(vendors, matchedVendors, animationDuration);
    });

    /**
     * Select a random vendor.
     */
    const randomizeBtn = document.getElementById('js-filter-randomize');
    randomizeBtn.addEventListener('click', (e) => {
      e.preventDefault();
      let selected = vendors[Math.floor(Math.random() * vendors.length)];

      filterVendors(vendors, selected, animationDuration);
    });

    /**
     * Reset.
     */
    const resetBtn = document.getElementById('js-filter-reset');
    resetBtn.addEventListener('click', (e) => {
      e.preventDefault();
      categoryFilter.value = '';
      promptFilter.value = '';
      resetVendors(vendors, animationDuration);
    });
  },
};

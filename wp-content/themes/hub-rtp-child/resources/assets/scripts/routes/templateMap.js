import tippy, { roundArrow } from 'tippy.js';
import prefersReducedMotion from '../util/prefersReducedMotion';
import hideOnEsc from '../util/tippyjs/hideOnEsc';

export default {
  init() {
    /**
     * Toggle Phase 1 and 2 (highlights properties on the map).
     */
    const phaseBtn = document.querySelector('.hub-office-map__legend-filter');
    phaseBtn.addEventListener('click', (e) => {
      e.preventDefault();
      // Update aria-pressed for toggle switch.
      let pressed = phaseBtn.getAttribute('aria-pressed') === 'true';
      phaseBtn.setAttribute('aria-pressed', String(!pressed));

      // Update aria-label for toggle switch.
      if (pressed == true) {
        phaseBtn.setAttribute('data-phase', '1');
        phaseBtn.setAttribute('aria-label', 'Phase 1');
      } else {
        phaseBtn.setAttribute('data-phase', '2');
        phaseBtn.setAttribute('aria-label', 'Phase 2');
      }

      // Disable or enable properties.
      document.querySelectorAll('g.property').forEach((el) => {
        el.toggleAttribute('disabled');
      });
    });
          el.classList.toggle('property--is-highlighted');
        });
      });
    });

    /**
     * Tooltips.
     */
    tippy('[data-hub-property]', {
      content(reference) {
        const hub_property_id = reference.getAttribute('data-hub-property');

        if (hub_property_id) {
          const template = document.getElementById(`tippy_${hub_property_id}`);
          return template.innerHTML;
        }
      },
      allowHTML: true,
      animation: prefersReducedMotion() ? 'none' : 'scale-subtle',
      appendTo: document.body,
      arrow: roundArrow,
      interactive: true,
      interactiveBorder: 30,
      offset: [0, -20],
      placement: 'top-start',
      plugins: [hideOnEsc],
      theme: 'hub-blue',
    });
  },
};

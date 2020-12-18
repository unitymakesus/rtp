import tippy, { roundArrow } from 'tippy.js';
import prefersReducedMotion from '../util/prefersReducedMotion';
import hideOnEsc from '../util/tippyjs/hideOnEsc';

export default {
  init() {
    /**
     * Phase 1 and 2 toggles (highlights properties on the map).
     */
    const phaseBtns = document.querySelectorAll('.hub-office-map__legend-filter');
    phaseBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        // Update aria-pressed.
        let pressed = btn.getAttribute('aria-pressed') === 'true';
        btn.setAttribute('aria-pressed', String(!pressed));

        // Highlight or unhighlight properties.
        const { phaseTarget } = btn.dataset;
        document.querySelectorAll(`g[data-phase="${phaseTarget}"]`).forEach((el) => {
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

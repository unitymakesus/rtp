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

    /**
     * Legend highlights for properties on the map.
     */
    const legendItems = document.querySelectorAll('.legend-item');
    legendItems.forEach(item => {
      const { typeTarget } = item.dataset;
      item.addEventListener('mouseover', () => {
        // Dim other properties
        document.querySelector('.hub-office-map svg').classList.add('dim-properties');

        // Highlight properties that match legend
        document.querySelectorAll(`g[data-type="${typeTarget}"]`).forEach((el) => {
          el.classList.toggle('property--is-highlighted');
        })
      });
      item.addEventListener('mouseout', () => {
        // Remove dimmer
        document.querySelector('.hub-office-map svg').classList.remove('dim-properties');

        // Remove highlights
        document.querySelectorAll(`g[data-type="${typeTarget}"]`).forEach((el) => {
          el.classList.remove('property--is-highlighted');
        })
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
      onShown() {
        // Dim other properties
        document.querySelector('.hub-office-map svg').classList.add('dim-properties');
      },
      onHide() {
        // Remove dimmer
        document.querySelector('.hub-office-map svg').classList.remove('dim-properties');
      },
      allowHTML: true,
      animation: prefersReducedMotion() ? 'none' : 'scale-subtle',
      appendTo: document.body,
      arrow: roundArrow,
      duration: 300,
      interactive: false,
      interactiveBorder: 30,
      offset: [0, -20],
      placement: 'top',
      plugins: [hideOnEsc],
      theme: 'hub-blue',
    });
  },
};

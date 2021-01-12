import tippy, { followCursor, roundArrow } from 'tippy.js';
import prefersReducedMotion from './prefersReducedMotion';
import hideOnEsc from './tippyjs/hideOnEsc';

/**
 * Interactive Office Map
 */
const initOfficeMap = () => {
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

      // Enable or disable properties.
      const { phaseTarget } = btn.dataset;
      document.querySelectorAll(`g[data-phase="${phaseTarget}"]`).forEach((el) => {
        el.toggleAttribute('disabled');
      });
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
      });
    });
    item.addEventListener('mouseout', () => {
      // Remove dimmer
      document.querySelector('.hub-office-map svg').classList.remove('dim-properties');

      // Remove highlights
      document.querySelectorAll(`g[data-type="${typeTarget}"]`).forEach((el) => {
        el.classList.remove('property--is-highlighted');
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
    duration: 150,
    followCursor: true,
    interactive: false,
    interactiveBorder: 30,
    offset: [0, 64],
    placement: 'top',
    plugins: [hideOnEsc, followCursor],
    theme: 'hub-blue',
  });
}

export default initOfficeMap;

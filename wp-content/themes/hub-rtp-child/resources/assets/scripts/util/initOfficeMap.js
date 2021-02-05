import tippy, { followCursor, roundArrow } from 'tippy.js';
import toggleArrayValue from './toggleArrayValue';
import prefersReducedMotion from './prefersReducedMotion';
import hideOnEsc from './tippyjs/hideOnEsc';

/**
 * Figure out which properties to deactivate on the map (based on user filters).
 *
 * @param array properties
 * @param object activeFilters
 */
function highlightProperties(properties, activeFilters) {
  if (activeFilters.phase.length || activeFilters.type.length) {
    let filtered = properties.filter((property) => {
      let { phase, type } = property.dataset;

      if (activeFilters.phase.length && !activeFilters.phase.includes(phase)) {
        return property;
      }

      if (activeFilters.type.length && !activeFilters.type.includes(type)) {
        return property;
      }
    });

    properties.forEach((property) => {
      if (filtered.includes(property)) {
        property.setAttribute('disabled', '');
      } else {
        property.removeAttribute('disabled');
      }
    });
  } else {
    properties.forEach((property) => {
      property.removeAttribute('disabled');
    });
  }
}

/**
 * Interactive Office Map
 */
const initOfficeMap = () => {
  let properties = Array.from(document.querySelectorAll('.property'));

  // Keep track of "filters" selected by the user.
  let activeFilters = {
    'phase': [],
    'type': [],
  };

  // Select a phase and highlight all properties on the map.
  document.querySelectorAll('input[name="phase"]').forEach((elem) => {
    elem.addEventListener('change', (event) => {
      // Update active filters and properties with selection.
      let { value } = event.target;
      activeFilters.phase = (value === '') ? [] : [value];
      highlightProperties(properties, activeFilters);
    });
  });

  // Toggles.
  document.querySelectorAll('.hub-office-map__legend-filter').forEach((btn) => {
    btn.addEventListener('click', (event) => {
      event.preventDefault();
      // Update aria-pressed.
      let isPressed = btn.getAttribute('aria-pressed') === 'true' || false;
      btn.setAttribute('aria-pressed', !isPressed);

      // Update active filters and properties with selection.
      let { typeTarget } = btn.dataset;
      toggleArrayValue(activeFilters.type, typeTarget);
      highlightProperties(properties, activeFilters);
    });
  });

  // Tooltips.
  tippy('.property', {
    content(reference) {
      const template = document.getElementById(`tippy_${reference.id}`);
      return template.innerHTML;
    },
    onTrigger(instance) {
      // Highlight the current property by dimming all others.
      let { reference } = instance;

      // Disengage if this is a currently deactivated property.
      if (reference.getAttribute('disabled') === '') {
        return;
      }

      properties.forEach((property) => {
        if (reference === property) {
          return;
        }

        property.setAttribute('disabled', '');
      });
    },
    onUntrigger() {
      highlightProperties(properties, activeFilters);
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

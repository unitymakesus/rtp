import tippy, { roundArrow } from 'tippy.js';
import hideOnEsc from '../util/tippyjs/hideOnEsc';

export default {
  init() {
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
      appendTo: document.body,
      arrow: roundArrow + roundArrow,
      interactive: true,
      offset: [0, -20],
      placement: 'top',
      plugins: [hideOnEsc],
      theme: 'light',
    });
  },
};

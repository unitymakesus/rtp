import prefersReducedMotion from './util/prefersReducedMotion';

/**
 * Set active state for each lifestyle card.
 */
if (prefersReducedMotion() === true) {
  [...document.querySelectorAll('.cbb-lifestyle__card')].forEach((card) => {
    card.classList.add('prefers-reduced-motion');
  });
}

[...document.querySelectorAll('.cbb-lifestyle__card-toggle')].forEach((toggle) => {
  toggle.addEventListener('click', (e) => {
    e.preventDefault();
    let expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!expanded));

    toggle.parentNode.classList.toggle('is-active');
  });
});

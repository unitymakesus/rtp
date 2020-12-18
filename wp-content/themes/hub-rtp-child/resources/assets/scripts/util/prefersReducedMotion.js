/**
 * Check user settings for reduced motion preferences, if available.
 */
const prefersReducedMotion = () => {
  return window.matchMedia('(prefers-reduced-motion)').matches ? true : false;
}

export default prefersReducedMotion;

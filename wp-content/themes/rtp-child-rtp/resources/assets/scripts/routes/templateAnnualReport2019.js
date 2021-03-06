import 'focus-within-polyfill';
import 'intersection-observer';

export default {
  init() {
  },
  finalize() {
    const boxyard = document.getElementById('boxyard');
    const config = {
      threshold: 0.5,
    };

    let observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
          boxyard.classList.add('showtime');
        }
      });
    }, config);

    observer.observe(boxyard);
  },
};

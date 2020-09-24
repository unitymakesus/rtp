export default {
  init() {
    /**
     * Animate strokes of Boxyard Line Art.
     */
    let paths = document.querySelectorAll('.boxyard-line-art path');
    paths.forEach(path => {
      let length = path.getTotalLength();

      path.style.strokeDasharray = length + ' ' + length;
      path.style.strokeDashoffset = length;
    });
  },
  finalize() {
    /**
     * Watch for element in viewport before kicking off animation.
     */
    const observeElem = document.querySelectorAll('.boxyard-line-art-wrap');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
          entry.target.classList.add('in-viewport');
          observer.unobserve(entry.target);
        }
      });
    });

    observeElem.forEach(elem => {
      observer.observe(elem);
    });
  },
};

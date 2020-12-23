/**
 * Dismiss the Tippy tooltip when the escape key is pressed.
 *
 * @source https://atomiks.github.io/tippyjs/v6/plugins/#hideonesc
 */
const hideOnEsc = {
  name: 'hideOnEsc',
  defaultValue: true,
  fn({hide}) {
    function onKeyDown(event) {
      if (event.keyCode === 27) {
        hide();
      }
    }

    return {
      onShow() {
        document.addEventListener('keydown', onKeyDown);
      },
      onHide() {
        document.removeEventListener('keydown', onKeyDown);
      },
    };
  },
};

export default hideOnEsc;

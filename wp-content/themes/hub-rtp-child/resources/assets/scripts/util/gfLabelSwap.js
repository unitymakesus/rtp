/**
 * Callback fucntion setting up event handlers and checks for initial form load / validation.
 */
function setupFields() {
  let fields = document.querySelectorAll('.gfield--label-swap input');

  if (!fields.length) {
    return;
  }

  fields.forEach(field => {
    if ($(field).val().length !== 0) {
      $(field).closest('.gfield').addClass('active');
    }

    $(field).on('focus', function() {
      $(this).closest('.gfield').addClass('active');
    });

    $(field).on('blur', function() {
      if ($(this).val().length === 0) {
        $(this).closest('.gfield').removeClass('active');
      }
    });
  });
}

/**
 * Modify some label interaction behavior based on Materialized framework.
 */
const gfLabelSwap = () => {
  $(document).on('gform_post_render', () => {
    setupFields();
  });

  $(window).on('load', () => {
    setupFields();
  });
}

export default gfLabelSwap;

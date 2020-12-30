/**
 * Modify some label interaction behavior based on Materialized framework.
 */
const gfLabelSwap = () => {
  let fields = document.querySelectorAll('.gfield--label-swap input');
  fields.forEach(field => {
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

export default gfLabelSwap;

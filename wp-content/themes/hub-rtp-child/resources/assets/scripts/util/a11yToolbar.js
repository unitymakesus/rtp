/**
 *
 */
const a11yToolbar = () => {

  // Media query
  var smDown = window.matchMedia('(max-width: 768px)');

  // Show a11y toolbar
  function showA11yToolbar() {
    $('body').addClass('a11y-tools-active');
    $('#a11y-tools-trigger + label i').attr('aria-label', 'Hide accessibility tools');

    // Enable focus of tools using tabindex
    $('.a11y-tools').each(function () {
      var el = $(this);
      $('input', el).attr('tabindex', '0');
    });
  }

  // Hide a11y toolbar
  function hideA11yToolbar() {
    $('body').removeClass('a11y-tools-active');
    $('#a11y-tools-trigger + label i').attr('aria-label', 'Show accessibility tools');

    // Disable focus of tools using tabindex
    $('.a11y-tools').each(function () {
      var el = $(this);
      $('input', el).attr('tabindex', '-1');
    });
  }

  // Toggle a11y toolbar
  $('#a11y-tools-trigger').on('change', function () {
    if (smDown.matches) {
      if ($(this).prop('checked')) {
        showA11yToolbar();
      } else {
        hideA11yToolbar();
      }
    }
  });

  // Make a11y toolbar keyboard accessible
  $('.a11y-tools').on('focusout', 'input', function () {
    setTimeout(function () {
      if (smDown.matches) {
        if ($(':focus').closest('.a11y-tools').length == 0) {
          $('#a11y-tools-trigger').prop('checked', false);
          hideA11yToolbar();
        }
      }
    }, 200);
  });

  // Controls for changing text size
  $('#text-size input[name="text-size"]').on('change', function () {
    let tsize = $(this).val();
    $('html').attr('data-text-size', tsize);
    document.cookie = 'data_text_size=' + tsize + ';max-age=31536000;path=/';
  });

  // Controls for changing contrast
  $('#toggle-contrast input[name="contrast"]').on('change', function () {
    let contrast = $(this).is(':checked');
    $('html').attr('data-contrast', contrast);
    document.cookie = 'data_contrast=' + contrast + ';max-age=31536000;path=/';
  });
};

export default a11yToolbar;

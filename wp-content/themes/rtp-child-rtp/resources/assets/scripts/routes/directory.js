export default {
  init() {
  },
  finalize() {
    $(document).on('facetwp-loaded', function() {

      $('.facetwp-type-dropdown select').formSelect();

      // eslint-disable-next-line no-undef
      if (FWP.loaded) {
        $('html, body').animate({
          scrollTop: $('.facetwp-template').offset().top,
        }, 500);
      }

      $('.facetwp-facet').each(function() {
        let facet_name = $(this).attr('data-name');
        // eslint-disable-next-line no-undef
        let facet_label = FWP.settings.labels[facet_name];

        // Add label for facet
        if ($('.facet-label[data-for="' + facet_name + '"]').length < 1) {
          $(this).before('<div class="label facet-label" data-for="' + facet_name + '">' + facet_label + '</div>');
        }

        if (facet_name == 'search') {
          // Add aria support for search field
          $(this).find('input').attr('aria-label', facet_label);
        }
      });

    });

  },
};

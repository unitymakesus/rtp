jQuery(document).ready(function($) {
  $('.report_actions').hide();
  $('.edit_report').hover(
    function() {
      $(this).children('.report_actions').show();
    },
    function() {
      $(this).children('.report_actions').hide();
    }
  );

  for( i = 0; i < PlpReport.groups.length; i++ ) {
    var group = PlpReport.groups[i];
    $('.group-checkbox-'+group.id).change(function() {
      if ($('.group-checkbox-'+group.id).attr('checked')) {
        $('.group-link-checkbox-'+group.id).attr('checked', 'checked');
      }
      else {
        $('.group-link-checkbox-'+group.id).removeAttr('checked');
      }
    });

    $('.group-link-checkbox-'+group.id).change(function() {
      if ($('.group-link-checkbox-'+group.id).attr('checked')) {
        $('.group-checkbox-'+group.id).removeAttr('checked');
      }
    });
  }
});


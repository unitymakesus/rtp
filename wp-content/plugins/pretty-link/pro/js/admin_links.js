jQuery(document).ready(function($) {

  var prli_geo_countries_dropdown = function() {
    $('.prli_geo_countries').suggest(
      ajaxurl+'?action=prli_search_countries',
      {
        delay: 500,
        minchars: 2,
        multiple: true
      }
    );
  }

  $('.prli_geo_row_add').on('click', function(e) {
    e.preventDefault();
    $('.prli_geo_rows').append(PlpLink.geo_row_html.replace(/{{geo_url}}/m, '').replace(/{{geo_countries}}/m, ''));
    prli_geo_countries_dropdown();
  });

  $('.prli_geo_rows').on('click', '.prli_geo_row_remove', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  $.each(PlpLink.geo_url, function(i, v) {
    $('.prli_geo_rows').append(PlpLink.geo_row_html.replace(/{{geo_url}}/m, v).replace(/{{geo_countries}}/m, PlpLink.geo_countries[i]));
    prli_geo_countries_dropdown();
  });

  // Basic URL validation
  $('.prli_geo_rows').on('blur', '.prli_geo_url', function(e) {
    if($(this).val().match(/https?:\/\/[\w-]+(\.[\w-]{2,})*(:\d{1,5})?/)) {
      $(this).removeClass('prli_invalid');
    }
    else {
      $(this).addClass('prli_invalid');
    }
  });

  // Basic Countries validation
  $('.prli_geo_rows').on('blur', '.prli_geo_countries', function(e) {
    if($(this).val().match(/^([^,\[\]]+\[[a-zA-Z]+\])(,[^,\[\]]+\[[a-zA-Z]+\])+,? ?$/)) {
      $(this).removeClass('prli_invalid');
    }
    else {
      $(this).addClass('prli_invalid');
    }
  });

  // Technology redirects
  $('.prli_tech_row_add').on('click', function(e) {
    e.preventDefault();
    $('.prli_tech_rows').append(PlpLink.tech_row_html.replace(/{{tech_url}}/m, ''));
  });

  $('.prli_tech_rows').on('click', '.prli_tech_row_remove', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  $.each(PlpLink.tech_url, function(i, v) {
    $('.prli_tech_rows').append(PlpLink.tech_row_html.replace(/{{tech_url}}/m, v));
  });

  $.each($('.prli_tech_rows .prli-tech-row'), function(i, r) {
    $(r).find('.prli_tech_device').val(PlpLink.tech_device[i]);
    $(r).find('.prli_tech_os').val(PlpLink.tech_os[i]);
    $(r).find('.prli_tech_browser').val(PlpLink.tech_browser[i]);
  });

  // Basic URL validation
  $('.prli_tech_rows').on('blur', '.prli_tech_url', function(e) {
    if($(this).val().match(/https?:\/\/[\w-]+(\.[\w-]{2,})*(:\d{1,5})?/)) {
      $(this).removeClass('prli_invalid');
    }
    else {
      $(this).addClass('prli_invalid');
    }
  });

  // Time Period redirects
  $('.prli_time_row_add').on('click', function(e) {
    e.preventDefault();
    $('.prli_time_rows').append(PlpLink.time_row_html.replace(/{{time_url}}/m, '').replace(/{{time_start}}/m, '').replace(/{{time_end}}/m, ''));
    plp_load_datepicker();
  });

  $('.prli_time_rows').on('click', '.prli_time_row_remove', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  $.each(PlpLink.time_url, function(i, v) {
    $('.prli_time_rows').append(PlpLink.time_row_html.replace(/{{time_url}}/m, v).replace(/{{time_start}}/m, PlpLink.time_start[i]).replace(/{{time_end}}/m, PlpLink.time_end[i]));
  });

  plp_load_datepicker();

  // Basic URL validation
  $('.prli_time_rows').on('blur', '.prli_time_url', function(e) {
    if($(this).val().match(/https?:\/\/[\w-]+(\.[\w-]{2,})*(:\d{1,5})?/)) {
      $(this).removeClass('prli_invalid');
    }
    else {
      $(this).addClass('prli_invalid');
    }
  });

});


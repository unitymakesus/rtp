(function($) {
  $(document).ready(function() {
    function prli_objectify_form(formArray, allowed) {//serialize data function
      var returnArray = {};

      for (var i = 0; i < formArray.length; i++){
        var name = formArray[i]['name'],
            value = formArray[i]['value'];

        if(-1 !== $.inArray(name, allowed)) {
          if (name.slice(-2) === '[]') {
            if (typeof returnArray[name] === 'undefined') {
              returnArray[name] = [];
            }

            returnArray[name].push(value);
          } else {
            returnArray[name] = value;
          }
        }
      }

      return returnArray;
    }

    $('form#post').submit(function(e) {
      e.preventDefault();

      $('#pretty_link_errors').hide();
      $('.spinner').css('visibility','visible');

      var fields_to_validate = [
        'prli_url', 'redirect_type', 'slug', 'url_replacements', 'enable_expire', 'expire_type', 'expire_date',
        'expire_clicks', 'enable_expired_url', 'expired_url', 'dynamic_redirection', 'url_rotations[]',
        'target_url_weight', 'url_rotation_weights[]', 'prli_geo_url[]', 'prli_geo_countries[]', 'prli_tech_url[]',
        'prli_time_url[]', 'prli_time_start[]', 'prli_time_end[]', 'delay'
      ];

      var args = prli_objectify_form($(this).serializeArray(), fields_to_validate);
      args['id']       = PrliLinkValidation.args['id'];
      args['action']   = PrliLinkValidation.args['action'];
      args['security'] = PrliLinkValidation.args['security'];

      var form = this;

      $.post( ajaxurl, args, function(data) {
        if(data.valid) {
          $('#pretty_link_errors').hide();
          $(form).triggerHandler('submit.edit-post');
          form.submit();
        }
        else {
          $('#pretty_link_errors p').html(data.message);
          $('#pretty_link_errors').show();

          $('.spinner').css('visibility','hidden');
        }
      }, 'json' );
    });

    if (window.adminpage === 'post-new-php' && window.typenow === 'pretty-link') {
      $('#publish').val(PrliLinkValidation.args.update);
    }
  });
})(jQuery);

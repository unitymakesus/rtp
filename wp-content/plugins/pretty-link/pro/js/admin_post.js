jQuery(document).ready(function($) {
  $('.tweet-toggle-pane').hide();

  $('.tweet-toggle-button').click(function() {
    $('.tweet-toggle-pane').toggle();
  });

  $('.tweet-button').click(function() {
    $.ajax( {
       type: "POST",
       url: ajaxurl,
       data: {
         'action': 'plp-auto-tweet',
         'post': PlpPost.post_id,
         'message': document.getElementById('tweet-message').value
       },
       success: function(msg) {
         $('.tweet-response').replaceWith('Tweet Successful:');
         $('.tweet-status').replaceWith('Has already been tweeted');
         $('.tweet-message-display').replaceWith('<blockquote>'+msg+'</blockquote>');
       }
    });
  });
});

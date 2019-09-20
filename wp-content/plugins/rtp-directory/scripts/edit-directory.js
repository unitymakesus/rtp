jQuery(document).ready(function($) {
  // Hover State Section
  $('button.modaal').hover(
    function(){
      $(this).closest('.user-can-edit').css("box-shadow", "6px 2px 20px rgba(0,0,0,0.2)");
    }, function(){
      $(this).closest('.user-can-edit').css("box-shadow", "none");
    }
  );

  $('button.modaal').modaal();
});

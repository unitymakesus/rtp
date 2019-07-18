// Create Modal Instance
var modal = new tingle.modal({
    closeMethods: ['overlay', 'button', 'escape'],
    onOpen: function() {
      // $('.modal').css('display', 'block');
      // acf.do_action('append', $('.modal'));
      // acf.do_action('ready', $('.tingle-modal-box__content'));
      // acf.do_action('load', $('.tingle-modal-box__content'));
      acf.do_action( 'append', $('.tingle-modal-box__content'));
      // acf.do_action( 'append', $('.tingle-modal-box__content .acf-editor-wrap.delay'));
      acf.do_action( 'ready', $( 'body' ) );
      acf.do_action( 'load', $( 'body' ) );

      $('.tingle-modal-box__content .acf-editor-wrap.delay').trigger('mousedown');
      // acf.fields.wysiwyg.initialize();

      // $('.tingle-modal-box__content .acf-editor-wrap.delay').initialize();
      // $(document).trigger('acf/setup_fields', $('.tingle-modal-box__content'));
      // console.log(acf.do_action);
    },
    onClose: function() {
      // $('.modal').css('display', 'none');
    }
});

// Modal Action
function launchModal(id){
  modal.setContent(document.querySelector('#'+id).innerHTML)
  // modal.setContent($('#'+id).clone(true));
  $('.tingle-modal-box__content .select2-container').remove();
  modal.open();
}

// Detect Edit Clicks
$('.modal-btn').on('click', function(){
    var id = $(this).closest('.user-can-edit').attr('data-target');
    launchModal(id);
});

// Hover State Section
$('.modal-btn').hover(
  function(){
    $(this).closest('.user-can-edit').css("box-shadow", "6px 2px 20px rgba(0,0,0,0.2)");
  }, function(){
    $(this).closest('.user-can-edit').css("box-shadow", "none");
  }
);

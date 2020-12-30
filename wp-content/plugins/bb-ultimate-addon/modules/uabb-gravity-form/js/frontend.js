(function ($) {
  UABBGravityFormModule = function (settings) {
    this.id = settings.id;
    this.form_ajax = settings.form_ajax;
    this.nodeClass = ".fl-node-" + settings.id;
    this.init();
  };
})(jQuery);

UABBGravityFormModule.prototype = {
  settings: {},
  node: "",
  nodeClass: "",

  init: function () {
    var nodeClass = jQuery(this.nodeClass);
    var form_ajax = this.form_ajax;
    var confirmation_msg = nodeClass.find(".gform_confirmation_message");
    var form_title = nodeClass.find(".uabb-gf-form-title");
    var form_desc = nodeClass.find(".uabb-gf-form-desc");

    if ("true" === form_ajax) {
      //AJAX form submission
      jQuery(document).on("gform_confirmation_loaded", function (
        event,
        formId
      ) {
        // code to be trigger when confirmation page is loaded
        form_title.hide();
        form_desc.hide();
      });
    } else {
      //Hide the forms title and description after submit.
      if (confirmation_msg.length > 0) {
        form_title.hide();
        form_desc.hide();
      } else {
        form_title.show();
        form_desc.show();
      }
    }
    if ( typeof gform !== 'undefined' ) {
      gform.addAction( 'gform_input_change', function( elem, formId, fieldId ) {
          if( nodeClass.find( '.gfield_radio .gchoice_button' ).length && 'radio' == jQuery( elem ).attr( 'type' ) ){
            if( jQuery( elem ).parent().hasClass( 'uabb-radio-active') ){
            jQuery( elem ).parent().removeClass( 'uabb-radio-active' );            
            } else {
            jQuery( '.gchoice_button' ).removeClass( 'uabb-radio-active' );          
            jQuery( elem ).parent().addClass( 'uabb-radio-active' );           
            }
          }
      }, 10, 3 );
    }
  },
};

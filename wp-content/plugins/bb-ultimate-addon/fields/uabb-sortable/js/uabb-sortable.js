(function($){
    
    FLBuilder.addHook( 'settings-form-init', function() {
        
        var sort_elements = $( '.fl-builder-settings:visible .uabb-sortable' );
            
        sort_elements.each( function() {
            
            var element = $( this ),
                field = element.closest( 'tr.fl-field' ),
                name  = field.attr( 'id' ).replace( 'fl-field-', '' );
                
            element.sortable({
                update: function( event, ui ) {
                    var sequence = "",
                        input = $("#fl-field-" + name).find("input[name=" + name + "]");
                    $(this).children().each(function() {
                          var className = "," + $(this).attr("class");
                          sequence += className;
                    });
                    sequence = sequence.replace(/^,/, "");
                    input.val(sequence);
                    input.trigger('keyup');
                }
            });
            
        } );
    } );
    
})(jQuery);

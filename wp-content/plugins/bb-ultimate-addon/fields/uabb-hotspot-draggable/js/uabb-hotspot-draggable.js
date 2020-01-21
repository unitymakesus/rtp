(function($){
    
    FLBuilder.addHook( 'settings-form-init', function() {
        
        var points = $( '.fl-builder-settings:visible .uabb-hotspot-draggable-point' );
            
        points.each( function() {
            
            var point = $( this ),
                field = point.closest( 'tr.fl-field' ),
                name  = field.attr( 'id' ).replace( 'fl-field-', '' );
                
            point.draggable({
                containment: "parent",
                drag: function(event, ui) {
                    var top = $(this).position().top,
                        left = $(this).position().left,
                        wd = field.find('.uabb-hotspot-draggable').width(),
                        ht = field.find('.uabb-hotspot-draggable').height(),
                        coord_value = ( ( left/wd ) * 100 ) + ',' +  ( ( top/ht ) * 100 );
                        
                    field.find('input[name='+name+']').val( coord_value );
                }
            });
            
        } );
    } );
    
})(jQuery);

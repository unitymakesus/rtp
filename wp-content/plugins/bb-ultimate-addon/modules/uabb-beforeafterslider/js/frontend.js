
var UABBBeforeAfterSlider;

(function($) {
    
    /**
     * Class for Blog Posts Module
     *
     * @since 1.6.1
     */
    UABBBeforeAfterSlider = function( settings ){
        
        // set params
        this.nodeClass = '.fl-node-' + settings.id;
        this.id = settings.id;
        this.wrapperClass = '.baslider-' + this.id;
        this.before_after_orientation = settings.before_after_orientation;
        this.initial_offset = settings.initial_offset;
        this.move_on_hover = settings.move_on_hover;
        
        this._init();
    };

    UABBBeforeAfterSlider.prototype = {

        nodeClass                   : '',
        wrapperClass                : '',
        before_after_orientation    : '',
        initial_offset              : '',
        move_on_hover               : '',

        _init: function() {

            jQuery(".baslider-" + this.id).twentytwenty(
                {
                    default_offset_pct: this.initial_offset,
                    move_on_hover: this.move_on_hover,
                    orientation: this.before_after_orientation
                }
            );                

            jQuery( this.wrapperClass ).css( 'width', '' );
            jQuery( this.wrapperClass ).css( 'height', '' );
     
            
            max = -1;
            jQuery( this.wrapperClass + " img" ).each(function() {
                if( max < jQuery(this).width() ) {
                    max = jQuery(this).width();
                }
            });
            
            jQuery( this.wrapperClass ).css( 'width', max + 'px' );
        }
    };

})(jQuery);
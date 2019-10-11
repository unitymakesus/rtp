(function ( $, window, undefined ) {
    // Hide until page load
    $( window ).load(function() {
        $('.uabb-ih-container').css({'visibility':'visible', 'opacity':1});
    });
    $(document).ready(function () {
        uabb_ihover_init();
        $(document).ajaxComplete(function(e, xhr, settings){
            uabb_ihover_init();
        });
    });
    $(window).resize(function(){
        uabb_ihover_init();
    });
    
    function uabb_ihover_init() {
        $('.uabb-ih-list').each(function(index, el){
            var s   = $(el).attr('data-shape');
            var h  = $(el).attr('data-height');
            var w   = $(el).attr('data-width');
            var rh = $(el).attr('data-res_height');
            var rw  = $(el).attr('data-res_width');
            var ww = jQuery(window).width() || '';
                
            $(el).find('li').each(function(){
                // Shape
                $(el).find('.uabb-ih-item').addClass('uabb-ih-' + s);
            });
        });
    }

    if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
        var is_touch_device = false;
    else
        var is_touch_device = true;

    /*jQuery('#page').click(function(){
        jQuery('.uabb-ih-hover').removeClass('uabb-ih-hover');
    });*/
    if(!is_touch_device){
        jQuery('.uabb-ih-item').hover(function(event){
            //event.stopPropagation();
            jQuery(this).addClass('uabb-ih-hover');
        },function(event){
            event.stopPropagation();
            jQuery(this).removeClass('uabb-ih-hover');
        });
    } else{
        jQuery('.uabb-ih-item').on( 'click', function(event){
            //event.stopPropagation();
            if(jQuery(this).hasClass('uabb-ih-hover')){
                jQuery(this).removeClass('uabb-ih-hover');
            }
            else{
                jQuery('.uabb-ih-hover').removeClass('uabb-ih-hover');
                jQuery(this).addClass('uabb-ih-hover');
            }
        });
    }
}(jQuery, window));
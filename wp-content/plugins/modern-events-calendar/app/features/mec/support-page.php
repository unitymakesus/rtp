<?php 
wp_enqueue_style('mec-lity-style', $this->main->asset('packages/lity/lity.min.css'));
wp_enqueue_script('mec-lity-script', $this->main->asset('packages/lity/lity.min.js'));
?>
<div id="webnus-dashboard" class="wrap about-wrap">
    <div class="welcome-head w-clearfix">
        <div class="w-row">
            <div class="w-col-sm-9">
                <h1> <?php echo __('Support', 'mec'); ?> </h1>
                <div class="w-welcome">
                    <div class="support-page-links link-to-doc"><a href="https://webnus.net/dox/modern-events-calendar/" target="_blank"><?php esc_html_e('Documentation' , 'mec'); ?></a></div>
                    <div class="support-page-links link-to-videos"><a href="https://webnus.net/dox/modern-events-calendar/video-tutorials/" target="_blank"><?php esc_html_e('All videos' , 'mec'); ?></a></div>
                    <div class="support-page-links link-to-articles"><a href="https://webnus.ticksy.com/articles/100004962/" target="_blank"><?php esc_html_e('View all Articles' , 'mec'); ?></a></div>
                    <p>
                        <?php esc_html_e('If you have any questions regarding Modern Events Calendar and how to use it, you can use the following four methods we have prepared in this page. The detailed documentations of MEC along with its instructional videos will help you have a great experience working with it.So, if  you need futher instructions using the plugin, please first refer to the following to find your answers.' , 'mec'); ?>
                    </p>
                </div>
            </div>
            <div class="w-col-sm-3">
                <img src="<?php echo plugin_dir_url(__FILE__ ) . '../../../assets/img/mec-logo-w.png'; ?>" />
                <span class="w-theme-version"><?php echo __('Version', 'mec'); ?> <?php echo MEC_VERSION; ?></span>
            </div>
        </div>
    </div>
    <div class="welcome-content w-clearfix extra">
    <?php if(current_user_can('read')): ?>
        <div class="w-row">
            <div class="w-col-sm-12">
                <div class="w-box support-page searchbox">
                    <div class="w-box-content">
                        <p><?php esc_html_e('Advice and answers from the Webnus Team'); ?></p>  
                        <div class="search-form">
                            <form action="https://intercom.help/webnus" method="">
                                <input type="text" placeholder="<?php esc_html_e('Search...'); ?>" name="q">
                                <button><i class="mec-sl-magnifier"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
        <div class="w-row">
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Quick Setup', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Download the Plugin', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Install and Activate the Plugin', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Add a New Event', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/ZDzcAEtdkC0" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Activate License', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Login to Dashboard', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Get the License Key', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Activate the plugin', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/V8DAZXuVxrQ" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('New Event', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Add New Events, Date and Time', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Tags, Categories, Organizer, Location', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Hourly Schedule,  Set Up Shortcodes', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/cnVy2YzDMOk" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Enable Booking', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Enable Booking', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Customize the Booking Form', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Set Up a Payment Gateway', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/7X58lpjFDh8" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>

        <div class="w-row">
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Add booking form to event', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Enable Booking from Settings', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Set Up a Booking Form', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Customize the Booking Form', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/difbDGz6blU" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Create Shortcodes', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Create a New Shortcode', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Customize Shortcodes', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Use Filters in Shortcodes', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/iRIBZZlYq54" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('WooCommerce gateways', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Install and Activate WooCommerce', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Integrate with MEC', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Set Up WooCommerce Gateway', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/ZI9aWMtwYWE" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
            </div>
            </div>
            <div class="w-col-sm-3">
                <div class="w-box support-page videobox">
                    <div class="w-box-head">
                        <?php _e('Settings', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <ul>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('An Overview of the Settings', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Set Up Different Settings', 'mec'); ?></li>
                            <li><i class="mec-sl-arrow-right-circle"></i><?php echo esc_html__('Use Different Options', 'mec'); ?></li>
                        </ul>
                        <div class="w-button">
                            <a href="https://youtu.be/mdXWngl4Lso" data-lity><i class="mec-sl-control-play"></i><?php echo esc_html__('Watch Video', 'mec'); ?></a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>

        <div class="w-row">
            <div class="w-col-sm-6">
                <div class="w-box support-page faq-box">
                    <div class="w-box-head">
                        <?php _e('FAQ', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <div class="mec-faq-accordion">
                            <div class="mec-faq-accordion-trigger"><a href="" class="active"><?php echo esc_html__('How should I update plugin?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content active">
                            <?php echo sprintf(__('You have two options:<br>
                            1-	Uploading the plugin file using FTP. For more information, please <a href="%s" target="_blank">click here</a>.<br>
                            2-	Using the auto-update feature which needs the adding of the purchase code in the corresponding section in the plugin. For more information, please <a href="%s" target="_blank">click here</a>.', 'mec') , 'https://webnus.net/dox/modern-events-calendar/how-to-update-manually-plugin/', 'https://webnus.net/dox/modern-events-calendar/how-to-auto-update-plugin/' ); ?>
                            </div>

                            <div class="mec-faq-accordion-trigger"><a href=""><?php echo esc_html__('Do I lose all my data or customization if I update MEC?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content"><?php esc_html_e('If you’ve added a file to the main folder of MEC, this file will be removed after the update. Therefore, please do get a full back up before proceeding with the update process.', 'mec'); ?>
                            </div>

                            <div class="mec-faq-accordion-trigger"><a href=""><?php echo esc_html__('Can I customize the event pages?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content">
                            <?php echo sprintf(__('Yes, it is possible. In order to see the related documentations, please <a href="%s" target="_blank">click here</a>.', 'mec') , 'https://webnus.net/dox/modern-events-calendar/mec-theme-integration-guide/' ); ?>
                            </div>

                            <div class="mec-faq-accordion-trigger"><a href=""><?php echo esc_html__('Does MEC have default languages or it needs to be translated?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content">
                            <?php echo sprintf(__('Yes, for some of the languages MEC has the translation file as default. However, since these translations have been done by the users, they may be incomplete, hence updating them might be required. For more information, please <a href="%s" target="_blank">click here</a>.', 'mec') , 'https://webnus.net/dox/modern-events-calendar/translate-mec/' ); ?>
                            </div>

                            <div class="mec-faq-accordion-trigger"><a href=""><?php echo esc_html__('Can I have more than one calendar in one website?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content"><?php esc_html_e( 'Unfortunately, MEC does not support more than 1 calendar in a single website, however, it will be added in its upcoming updates.' , 'mec' ); ?></div>

                            <div class="mec-faq-accordion-trigger"><a href=""><?php echo esc_html__('Can I import/export from/to MEC?', 'mec'); ?></a></div>
                            <div class="mec-faq-accordion-content"><?php esc_html_e( 'Yes, you can get an XML export from MEC data or import the file you\'ve exported to MEC. Also, if you are using one of the following plugins (The event calendar, calendarize it, EventOn, Events Schedule WP Plugin), then you can easily transfer your events to MEC.', 'mec' ); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-col-sm-6">
                <div class="w-box support-page articles-box">
                    <div class="w-box-head">
                        <?php _e('Articles', 'mec'); ?>
                    </div>
                    <div class="w-box-content">
                        <a href="https://webnus.ticksy.com/article/13645/" target="_blank"><?php esc_html_e('MEC And Integrate With WooCommerce' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/13642/" target="_blank"><?php esc_html_e('Create Events With Your Page Builder' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/9621/" target="_blank"><?php esc_html_e('Why can\'t I use HTML tags?' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/13484/" target="_blank"><?php esc_html_e('Setup Date Option On Shortcodes' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8604/" target="_blank"><?php esc_html_e('I want to export booking, what should I do?' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8601/" target="_blank"><?php esc_html_e('I Can\'t Export iCal' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8600/" target="_blank"><?php esc_html_e('Booking Module Not Working' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8598/" target="_blank"><?php esc_html_e('Translate MEC' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8602/" target="_blank"><?php esc_html_e('No Event Found!' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/10488/" target="_blank"><?php esc_html_e('MEC Theme Integration Guide' , 'mec'); ?></a>
                        <a href="https://webnus.ticksy.com/article/8603/" target="_blank"><?php esc_html_e('Can I Override MEC Template ?' , 'mec'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php if($this->getPRO()) : ?>
        <div class="w-row">
            <div class="w-col-sm-12">
                <div class="w-box support-page mec-ticksy">
                    <div class="w-box-content">
                        <p><?php esc_html_e('Webnus is an elite and trusted author with a high percentage of satisfied users. If you have any issues please don\'t hesitate to contact us, we will reply as soon as possible.' , 'mec'); ?></p>
                        <a href="https://webnus.ticksy.com/" target="_blank"><?php esc_html_e('Go to support forum','mec'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>
    </div>
</div>
<script>
(function($) {

    var allPanels = $('.mec-faq-accordion > .mec-faq-accordion-content');
    $('.mec-faq-accordion>.mec-faq-accordion-content.active').show();

    $('.mec-faq-accordion > .mec-faq-accordion-trigger > a').click(function() {
        $this = $(this);
        $target =  $this.parent().next();
        
        if(!$target.hasClass('active')){
            allPanels.removeClass('active').slideUp();
            $target.addClass('active').slideDown();
            $('.mec-faq-accordion > .mec-faq-accordion-trigger > a').removeClass('active')
            $this.addClass('active');
        } else {
            $this.removeClass('active');
            $target.removeClass('active').slideUp();
        }
    return false;
    });

})(jQuery);
</script>
<?php if($this->getPRO()) : ?>
<script>
  var APP_ID = "w23d92wv";

 window.intercomSettings = {
    app_id: APP_ID
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/' + APP_ID;var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<?php endif; ?>
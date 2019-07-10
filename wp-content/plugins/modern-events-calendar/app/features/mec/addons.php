<?php
/** no direct access **/
defined('MECEXEC') or die();

$version = NULL;
if($this->getPRO())
{
    // Get MEC New Update
    $envato = $this->getEnvato();

    $v = $envato->get_MEC_info('version');
    $version = isset($v->version) ? $v->version : NULL;
}

wp_enqueue_style('mec-lity-style', $this->main->asset('packages/lity/lity.min.css'));
wp_enqueue_script('mec-lity-script', $this->main->asset('packages/lity/lity.min.js'));
?>
<div id="webnus-dashboard" class="wrap about-wrap mec-addons">
    <div class="welcome-head w-clearfix">
        <div class="w-row">
            <div class="w-col-sm-9">
                <h1> <?php echo __('Addons', 'mec'); ?> </h1>
                <div class="w-welcome">
                    <!-- <div class="addons-page-links link-to-purchase"><a href="https://webnus.net/dox/modern-events-calendar/" target="_blank"><?php esc_html_e('How to Purchase' , 'mec'); ?></a></div>
                    <div class="addons-page-links link-to-install-addons"><a href="https://webnus.net/dox/modern-events-calendar/video-tutorials/" target="_blank"><?php esc_html_e('Install Addons' , 'mec'); ?></a></div> -->
                    <div class="addons-page-notice">
                        <p>
                        <?php echo __( '<strong>Note:</strong> All addons are provided for the Pro version and you cannot install and use them on the Lite version.', 'mec'); ?>
                        </p>
                    </div>
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
        <?php
        $data_url = 'https://webnus.net/modern-events-calendar/addons-api/addons-api.json';
        $get_data = file_get_contents($data_url);

        if( $get_data !== false AND !empty($get_data) )
        {
            $obj = json_decode($get_data);
            $i = count((array)$obj);
        }
        elseif ( function_exists('curl_version') )
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $data_url);
            $result = curl_exec($ch);
            curl_close($ch);
            $obj = json_decode($result);
            $i = count((array)$obj);
        } else {
            $obj = '';
        }
        ?>
        <div class="w-row">
        <?php if ( !empty( $obj ) ) :  ?>
        <?php foreach ($obj as $key => $value) : ?>
            <div class="w-col-sm-3">
                <div class="w-box addon">
                    <div class="w-box-child mec-addon-box">
                        <div class="mec-addon-box-head">
                            <div class="mec-addon-box-title"><a href="#"><span><?php esc_html_e($value->name); ?></span></a></div>
                            <?php if ( $value->comingsoon == 'false' ) : ?> 
                            <div class="mec-addon-box-version"><span><?php esc_html_e('Version' , 'mec'); ?> <strong><?php esc_html_e($value->version); ?></strong></span></div>
                            <?php endif; ?>
                        </div>
                        <div class="mec-addon-box-body">
                            <div class="mec-addon-box-content">
                                <p><?php esc_html_e($value->desc); ?></p>
                            </div>
                        </div>
                        <div class="mec-addon-box-footer">
                            <?php if ( $value->comingsoon == 'false' ) : ?> 
                            <a class="mec-addon-box-purchase" href="<?php esc_html_e($value->purchase); ?>"><i class="mec-sl-basket-loaded"></i><span>Purchase</span></a>
                            <a class="mec-addon-box-intro" href="<?php esc_html_e($value->video); ?>" data-lity=""><i class="mec-sl-control-play"></i>Introduction</a>
                            <?php else : ?>
                            <div class="mec-addon-box-comingsoon" href="#" data-lity=""><?php esc_html_e('Coming Soon' , 'mec'); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="w-col-sm-12">
                <div class="addons-page-error">
                    <p>
                    <?php echo __( '<strong>"file_get_contents"</strong> and <strong>"Curl"</strong> functions are <strong>not activated</strong> on your server. Please contact your host provider in this regard.', 'mec'); ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        </div>
    <?php endif; ?>
    </div>
</div>
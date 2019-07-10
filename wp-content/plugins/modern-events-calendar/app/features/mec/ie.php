<?php
/** no direct access **/
defined('MECEXEC') or die();
?>

<div class="wns-be-container">

    <div id="wns-be-infobar"></div>

    <div class="wns-be-sidebar">

        <ul class="wns-be-group-menu">

            <li class="wns-be-group-menu-li has-sub">
                <a href="<?php echo $this->main->remove_qs_var('tab'); ?>" id="" class="wns-be-group-tab-link-a">
                    <span class="extra-icon">
                        <i class="sl-arrow-down"></i>
                    </span>
                    <i class="mec-sl-settings"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Settings', 'mec'); ?></span>
                </a>
            </li>

            <?php if($this->main->getPRO() and isset($this->settings['booking_status']) and $this->settings['booking_status']): ?>

                <li class="wns-be-group-menu-li">
                    <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-reg-form'); ?>" id="" class="wns-be-group-tab-link-a">
                        <i class="mec-sl-layers"></i> 
                        <span class="wns-be-group-menu-title"><?php _e('Booking Form', 'mec'); ?></span>
                    </a>
                </li>            

                <li class="wns-be-group-menu-li">
                    <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-gateways'); ?>" id="" class="wns-be-group-tab-link-a">
                        <i class="mec-sl-wallet"></i> 
                        <span class="wns-be-group-menu-title"><?php _e('Payment Gateways', 'mec'); ?></span>
                    </a>
                </li>

            <?php endif;?>

            <li class="wns-be-group-menu-li">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-notifications'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-envelope"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Notifications', 'mec'); ?></span>
                </a>
            </li>

            <li class="wns-be-group-menu-li">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-styling'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-equalizer"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Styling Options', 'mec'); ?></span>
                </a>
            </li>            

            <li class="wns-be-group-menu-li">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-customcss'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-wrench"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Custom CSS', 'mec'); ?></span>
                </a>
            </li>            

            <li class="wns-be-group-menu-li">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-messages'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-bubble"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Messages', 'mec'); ?></span>
                </a>
            </li>

            <li class="wns-be-group-menu-li active">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-ie'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-refresh"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Import / Export', 'mec'); ?></span>
                </a>
            </li>

            <!-- <li class="wns-be-group-menu-li">
                <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-support'); ?>" id="" class="wns-be-group-tab-link-a">
                    <i class="mec-sl-support"></i> 
                    <span class="wns-be-group-menu-title"><?php _e('Support', 'mec'); ?></span>
                </a>
            </li> -->

        </ul>
    </div>

    <div class="wns-be-main">

        <div id="wns-be-notification"></div>

        <div id="wns-be-content">
            <div class="wns-be-group-tab">
                <h2><?php _e('Import', 'mec'); ?></h2>
                <p><?php _e('Insert your backup files below and press import to restore your site\'s options to the last backup.', 'mec'); ?></p>
                <p style="color:#d80000"><?php _e('WARNING! Restoring backup will overwrite all of your current option values. Caution Indeed.', 'mec'); ?></p>
                <div class="mec-container">
                    <div class="mec-import-settings-wrap">
                        <textarea class="mec-import-settings-content" placeholder="<?php esc_html_e('Please paste your options here', 'mec'); ?>"></textarea>
                    </div>
                    <a class="mec-import-settings" href="#"><?php _e("Import Settings", 'mec'); ?></a>
                    <div class="mec-import-options-notification"></div>
                </div>

                <h2><?php _e('Export', 'mec'); ?></h2>
                <div class="mec-container">
                    <?php
                        $nonce = wp_create_nonce("mec_settings_download");
                        $export_link = admin_url('admin-ajax.php?action=download_settings&nonce='.$nonce);
                    ?>
                    <a class="mec-export-settings" href="<?php echo $export_link; ?>"><?php _e("Download Settings", 'mec'); ?></a>
                </div>
            </div>
        </div>

    </div>

</div>
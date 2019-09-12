<?php
/** no direct access **/
defined('MECEXEC') or die();

$settings = $this->main->get_settings();

$fees = isset($settings['fees']) ? $settings['fees'] : array();
$ticket_variations = isset($settings['ticket_variations']) ? $settings['ticket_variations'] : array();

// WordPress Pages
$pages = get_pages();

// Verify the Purchase Code
$verify = NULL;
if($this->getPRO())
{
    $envato = $this->getEnvato();
    $verify = $envato->get_MEC_info('dl');
}


// Booking form
$mec_email  = false;
$mec_name   = false;
$reg_fields = $this->main->get_reg_fields();
if(!is_array($reg_fields)) $reg_fields = array();

foreach($reg_fields as $field)
{
	if(isset($field['type']))
	{
		if($field['type'] == 'name') $mec_name = true;
		if($field['type'] == 'mec_email') $mec_email = true;
	}
	else break;
}

if(!$mec_name)
{
	array_unshift(
		$reg_fields,
		array(
			'mandatory' => '0',
			'type'      => 'name',
			'label'     => esc_html__('Name', 'mec'),
        )
	);
}

if(!$mec_email)
{
	array_unshift(
		$reg_fields,
		array(
			'mandatory' => '0',
			'type'      => 'mec_email',
			'label'     => esc_html__('Email', 'mec'),
        )
	);
}

// gateways
$gateways = $this->main->get_gateways();
$gateways_options = $this->main->get_gateways_options();
?>
<div class="wns-be-container wns-be-container-sticky">
    <div id="wns-be-infobar">
        <input id="mec-search-settings" type="text" placeholder="Search..">
        <a id="" class="dpr-btn dpr-save-btn"><?php _e('Save Changes', 'mec'); ?></a>
    </div>

    <div class="wns-be-sidebar">
        <?php $this->main->get_sidebar_menu('booking'); ?>
    </div>

    <div class="wns-be-main">
        <div id="wns-be-notification"></div>
        <div id="wns-be-content">
            <div class="wns-be-group-tab">
                <div class="mec-container">

                    <form id="mec_booking_form">

                        <div id="booking_option" class="mec-options-fields active">
                            <h4 class="mec-form-subtitle"><?php _e('Booking', 'mec'); ?></h4>

                            <?php if(!$this->main->getPRO()): ?>
                            <div class="info-msg"><?php echo sprintf(__("%s is required to use this feature.", 'mec'), '<a href="'.$this->main->get_pro_link().'" target="_blank">'.__('Pro version of Modern Events Calendar', 'mec').'</a>'); ?></div>
                            <?php else: ?>
                            <div class="mec-form-row">
                                <label>
                                    <input type="hidden" name="mec[settings][booking_status]" value="0" />
                                    <input onchange="jQuery('#mec_booking_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][booking_status]" <?php if(isset($settings['booking_status']) and $settings['booking_status']) echo 'checked="checked"'; ?> /> <?php _e('Enable booking module', 'mec'); ?>
                                    <p><?php esc_attr_e("After enabling and saving the settings, reloading the page will add 'payment Gateways' to the settings and a new menu item on the Dashboard", 'mec'); ?></p>
                                </label>
                            </div>
                            <div id="mec_booking_container_toggle" class="<?php if((isset($settings['booking_status']) and !$settings['booking_status']) or !isset($settings['booking_status'])) echo 'mec-util-hidden'; ?>">
                                <div class="mec-form-row">
                                    <label class="mec-col-3" for="mec_settings_booking_date_format1"><?php _e('Date Format', 'mec'); ?></label>
                                    <div class="mec-col-4">
                                        <input type="text" id="mec_settings_booking_date_format1" name="mec[settings][booking_date_format1]" value="<?php echo ((isset($settings['booking_date_format1']) and trim($settings['booking_date_format1']) != '') ? $settings['booking_date_format1'] : 'Y-m-d'); ?>" />
                                        <span class="mec-tooltip">
                                            <div class="box">
                                                <h5 class="title"><?php _e('Date Format', 'mec'); ?></h5>
                                                <div class="content"><p><?php esc_attr_e("Default is Y-m-d", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/booking/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>
                                            </div>
                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <label class="mec-col-3" for="mec_settings_booking_limit"><?php _e('Limit', 'mec'); ?></label>
                                    <div class="mec-col-4">
                                        <input type="number" id="mec_settings_booking_limit" name="mec[settings][booking_limit]" value="<?php echo ((isset($settings['booking_limit']) and trim($settings['booking_limit']) != '') ? $settings['booking_limit'] : ''); ?>" placeholder="<?php esc_attr_e('Default is empty', 'mec'); ?>" />
                                        <span class="mec-tooltip">
                                            <div class="box">
                                                <h5 class="title"><?php _e('Booking Limit', 'mec'); ?></h5>
                                                <div class="content"><p><?php esc_attr_e("Total tickets that a user can book. It is useful if you're providing free tickets. Leave it empty for unlimited booking.", 'mec'); ?></p></div>
                                            </div>
                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <label class="mec-col-3" for="mec_settings_booking_maximum_dates"><?php _e('Maximum Dates', 'mec'); ?></label>
                                    <div class="mec-col-4">
                                        <input type="number" id="mec_settings_booking_maximum_dates" name="mec[settings][booking_maximum_dates]" value="<?php echo ((isset($settings['booking_maximum_dates']) and trim($settings['booking_maximum_dates']) != '') ? $settings['booking_maximum_dates'] : '6'); ?>" placeholder="<?php esc_attr_e('Default is 6', 'mec'); ?>" min="1" />
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <label class="mec-col-3" for="mec_settings_booking_thankyou_page"><?php _e('Thank You Page', 'mec'); ?></label>
                                    <div class="mec-col-4">
                                        <select id="mec_settings_booking_thankyou_page" name="mec[settings][booking_thankyou_page]">
                                            <option value="">----</option>
                                            <?php foreach($pages as $page): ?>
                                                <option <?php echo ((isset($settings['booking_thankyou_page']) and $settings['booking_thankyou_page'] == $page->ID) ? 'selected="selected"' : ''); ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="mec-tooltip">
                                        <div class="box top">
                                            <h5 class="title"><?php _e('Thank You Page', 'mec'); ?></h5>
                                            <div class="content"><p><?php esc_attr_e("User redirects to this page after booking. Leave it empty if you want to disable it.", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/booking/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                        </div>
                                        <i title="" class="dashicons-before dashicons-editor-help"></i>
                                    </span>                                         
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_first_for_all">
                                            <input type="hidden" name="mec[settings][booking_first_for_all]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_first_for_all]" id="mec_settings_booking_first_for_all" <?php echo ((!isset($settings['booking_first_for_all']) or (isset($settings['booking_first_for_all']) and $settings['booking_first_for_all'] == '1')) ? 'checked="checked"' : ''); ?> value="1" />
                                            <?php _e('Enable Express Attendees Form', 'mec'); ?>
                                        </label>
                                        <span class="mec-tooltip">
                                        <div class="box top">
                                            <h5 class="title"><?php _e('Attendees Form', 'mec'); ?></h5>
                                            <div class="content"><p><?php esc_attr_e("Users are able to apply first attendee information for other attendees in the booking form.", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/booking/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                        </div>
                                        <i title="" class="dashicons-before dashicons-editor-help"></i>
                                    </span>                                            
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_invoice">
                                            <input type="hidden" name="mec[settings][booking_invoice]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_invoice]" id="mec_settings_booking_invoice"
                                                <?php echo ((!isset($settings['booking_invoice']) or (isset($settings['booking_invoice']) and $settings['booking_invoice'] == '1')) ? 'checked="checked"' : ''); ?>
                                                value="1" />
                                            <?php _e('Enable Invoice', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="mec-form-subtitle"><?php _e('Email verification', 'mec'); ?></h5>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_auto_verify_free">
                                            <input type="hidden" name="mec[settings][booking_auto_verify_free]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_auto_verify_free]" id="mec_settings_booking_auto_verify_free" <?php echo ((isset($settings['booking_auto_verify_free']) and $settings['booking_auto_verify_free'] == '1') ? 'checked="checked"' : ''); ?> value="1" />
                                            <?php _e('Auto verification for free bookings', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_auto_verify_paid">
                                            <input type="hidden" name="mec[settings][booking_auto_verify_paid]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_auto_verify_paid]" id="mec_settings_booking_auto_verify_paid" <?php echo ((isset($settings['booking_auto_verify_paid']) and $settings['booking_auto_verify_paid'] == '1') ? 'checked="checked"' : ''); ?> value="1" />
                                            <?php _e('Auto verification for paid bookings', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="mec-form-subtitle"><?php _e('Booking Confirmation', 'mec'); ?></h5>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_auto_confirm_free">
                                            <input type="hidden" name="mec[settings][booking_auto_confirm_free]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_auto_confirm_free]" id="mec_settings_booking_auto_confirm_free" <?php echo ((isset($settings['booking_auto_confirm_free']) and $settings['booking_auto_confirm_free'] == '1') ? 'checked="checked"' : ''); ?> value="1" />
                                            <?php _e('Auto confirmation for free bookings', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <div class="mec-col-12">
                                        <label for="mec_settings_booking_auto_confirm_paid">
                                            <input type="hidden" name="mec[settings][booking_auto_confirm_paid]" value="0" />
                                            <input type="checkbox" name="mec[settings][booking_auto_confirm_paid]" id="mec_settings_booking_auto_confirm_paid" <?php echo ((isset($settings['booking_auto_confirm_paid']) and $settings['booking_auto_confirm_paid'] == '1') ? 'checked="checked"' : ''); ?> value="1" />
                                            <?php _e('Auto confirmation for paid bookings', 'mec'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if(isset($this->settings['booking_status']) and $this->settings['booking_status']): ?>

                        <div id="coupon_option" class="mec-options-fields">
                            <h4 class="mec-form-subtitle"><?php _e('Coupons', 'mec'); ?></h4>

                            <?php if(!$this->main->getPRO()): ?>
                            <div class="info-msg"><?php echo sprintf(__("%s is required to use this feature.", 'mec'), '<a href="'.$this->main->get_pro_link().'" target="_blank">'.__('Pro version of Modern Events Calendar', 'mec').'</a>'); ?></div>
                            <?php else: ?>
                            <div class="mec-form-row">
                                <label>
                                    <input type="hidden" name="mec[settings][coupons_status]" value="0" />
                                    <input onchange="jQuery('#mec_coupons_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][coupons_status]" <?php if(isset($settings['coupons_status']) and $settings['coupons_status']) echo 'checked="checked"'; ?> /> <?php _e('Enable coupons module', 'mec'); ?>
                                </label>
                                <p><?php esc_attr_e("After enabling and saving the settings,, you should reload the page to see a new menu on the Dashboard > Booking", 'mec'); ?></p>
                            </div>
                            <div id="mec_coupons_container_toggle" class="<?php if((isset($settings['coupons_status']) and !$settings['coupons_status']) or !isset($settings['coupons_status'])) echo 'mec-util-hidden'; ?>">
                            </div>
                            <?php endif; ?>
                        </div>

                        <div id="taxes_option" class="mec-options-fields">
                            <h4 class="mec-form-subtitle"><?php _e('Taxes / Fees', 'mec'); ?></h4>

                            <?php if(!$this->main->getPRO()): ?>
                            <div class="info-msg"><?php echo sprintf(__("%s is required to use this feature.", 'mec'), '<a href="'.$this->main->get_pro_link().'" target="_blank">'.__('Pro version of Modern Events Calendar', 'mec').'</a>'); ?></div>
                            <?php else: ?>
                            <div class="mec-form-row">
                                <label>
                                    <input type="hidden" name="mec[settings][taxes_fees_status]" value="0" />
                                    <input onchange="jQuery('#mec_taxes_fees_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][taxes_fees_status]" <?php if(isset($settings['taxes_fees_status']) and $settings['taxes_fees_status']) echo 'checked="checked"'; ?> /> <?php _e('Enable taxes / fees module', 'mec'); ?>
                                </label>
                            </div>
                            <div id="mec_taxes_fees_container_toggle" class="<?php if((isset($settings['taxes_fees_status']) and !$settings['taxes_fees_status']) or !isset($settings['taxes_fees_status'])) echo 'mec-util-hidden'; ?>">
                                <div class="mec-form-row">
                                    <button class="button" type="button" id="mec_add_fee_button"><?php _e('Add Fee', 'mec'); ?></button>
                                </div>
                                <div class="mec-form-row" id="mec_fees_list">
                                    <?php $i = 0; foreach($fees as $key=>$fee): if(!is_numeric($key)) continue; $i = max($i, $key); ?>
                                    <div class="mec-box" id="mec_fee_row<?php echo $i; ?>">
                                        <div class="mec-form-row">
                                            <input class="mec-col-12" type="text" name="mec[settings][fees][<?php echo $i; ?>][title]" placeholder="<?php esc_attr_e('Fee Title', 'mec'); ?>" value="<?php echo (isset($fee['title']) ? $fee['title'] : ''); ?>" />
                                        </div>
                                        <div class="mec-form-row">
                                            <span class="mec-col-4">
                                                <input type="text" name="mec[settings][fees][<?php echo $i; ?>][amount]" placeholder="<?php esc_attr_e('Amount', 'mec'); ?>" value="<?php echo (isset($fee['amount']) ? $fee['amount'] : ''); ?>" />
                                                <span class="mec-tooltip">
                                                    <div class="box top">
                                                        <h5 class="title"><?php _e('Amount', 'mec'); ?></h5>
                                                        <div class="content"><p><?php esc_attr_e("Fee amount, considered as fixed amount if you set the type to amount otherwise considered as percentage", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/taxes-or-fees/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                    </div>
                                                    <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                </span>  
                                            </span>
                                            <span class="mec-col-4">
                                                <select name="mec[settings][fees][<?php echo $i; ?>][type]">
                                                    <option value="percent" <?php echo ((isset($fee['type']) and $fee['type'] == 'percent') ? 'selected="selected"' : ''); ?>><?php _e('Percent', 'mec'); ?></option>
                                                    <option value="amount" <?php echo ((isset($fee['type']) and $fee['type'] == 'amount') ? 'selected="selected"' : ''); ?>><?php _e('Amount (Per Ticket)', 'mec'); ?></option>
                                                    <option value="amount_per_booking" <?php echo ((isset($fee['type']) and $fee['type'] == 'amount_per_booking') ? 'selected="selected"' : ''); ?>><?php _e('Amount (Per Booking)', 'mec'); ?></option>
                                                </select>
                                            </span>
                                            <button class="button" type="button" id="mec_remove_fee_button<?php echo $i; ?>" onclick="mec_remove_fee(<?php echo $i; ?>);"><?php _e('Remove', 'mec'); ?></button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" id="mec_new_fee_key" value="<?php echo $i+1; ?>" />
                            <div class="mec-util-hidden" id="mec_new_fee_raw">
                                <div class="mec-box" id="mec_fee_row:i:">
                                    <div class="mec-form-row">
                                        <input class="mec-col-12" type="text" name="mec[settings][fees][:i:][title]" placeholder="<?php esc_attr_e('Fee Title', 'mec'); ?>" />
                                    </div>
                                    <div class="mec-form-row">
                                        <span class="mec-col-4">
                                            <input type="text" name="mec[settings][fees][:i:][amount]" placeholder="<?php esc_attr_e('Amount', 'mec'); ?>" />
                                            <span class="mec-tooltip">
                                                    <div class="box top">
                                                        <h5 class="title"><?php _e('Amount', 'mec'); ?></h5>
                                                        <div class="content"><p><?php esc_attr_e("Fee amount, considered as fixed amount if you set the type to amount otherwise considered as percentage", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/taxes-or-fees/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                    </div>
                                                    <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                </span>                                              
                                        </span>
                                        <span class="mec-col-4">
                                            <select name="mec[settings][fees][:i:][type]">
                                                <option value="percent"><?php _e('Percent', 'mec'); ?></option>
                                                <option value="amount"><?php _e('Amount (Per Ticket)', 'mec'); ?></option>
                                                <option value="amount_per_booking"><?php _e('Amount (Per Booking)', 'mec'); ?></option>
                                            </select>
                                        </span>
                                            <button class="button" type="button" id="mec_remove_fee_button:i:" onclick="mec_remove_fee(:i:);"><?php _e('Remove', 'mec'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div id="ticket_variations_option" class="mec-options-fields">
                            <h4 class="mec-form-subtitle"><?php _e('Ticket Variations & Options', 'mec'); ?></h4>

                            <?php if(!$this->main->getPRO()): ?>
                                <div class="info-msg"><?php echo sprintf(__("%s is required to use this feature.", 'mec'), '<a href="'.$this->main->get_pro_link().'" target="_blank">'.__('Pro version of Modern Events Calendar', 'mec').'</a>'); ?></div>
                            <?php else: ?>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="hidden" name="mec[settings][ticket_variations_status]" value="0" />
                                        <input onchange="jQuery('#mec_ticket_variations_container_toggle').toggle();" value="1" type="checkbox" name="mec[settings][ticket_variations_status]" <?php if(isset($settings['ticket_variations_status']) and $settings['ticket_variations_status']) echo 'checked="checked"'; ?> /> <?php _e('Enable ticket options module', 'mec'); ?>
                                    </label>
                                </div>
                                <div id="mec_ticket_variations_container_toggle" class="<?php if((isset($settings['ticket_variations_status']) and !$settings['ticket_variations_status']) or !isset($settings['ticket_variations_status'])) echo 'mec-util-hidden'; ?>">
                                    <div class="mec-form-row">
                                        <button class="button" type="button" id="mec_add_ticket_variation_button"><?php _e('Add Variation / Option', 'mec'); ?></button>
                                    </div>
                                    <div class="mec-form-row" id="mec_ticket_variations_list">
                                        <?php $i = 0; foreach($ticket_variations as $key=>$ticket_variation): if(!is_numeric($key)) continue; $i = max($i, $key); ?>
                                            <div class="mec-box" id="mec_ticket_variation_row<?php echo $i; ?>">
                                                <div class="mec-form-row">
                                                    <input class="mec-col-12" type="text" name="mec[settings][ticket_variations][<?php echo $i; ?>][title]" placeholder="<?php esc_attr_e('Title', 'mec'); ?>" value="<?php echo (isset($ticket_variation['title']) ? $ticket_variation['title'] : ''); ?>" />
                                                </div>
                                                <div class="mec-form-row">
                                                    <span class="mec-col-4">
                                                        <input type="text" name="mec[settings][ticket_variations][<?php echo $i; ?>][price]" placeholder="<?php esc_attr_e('Price', 'mec'); ?>" value="<?php echo (isset($ticket_variation['price']) ? $ticket_variation['price'] : ''); ?>" />
                                                        <span class="mec-tooltip">
                                                            <div class="box top">
                                                                <h5 class="title"><?php _e('Price', 'mec'); ?></h5>
                                                                <div class="content"><p><?php esc_attr_e("Option Price", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/ticket-variations/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                            </div>
                                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                        </span>                                                          
                                                    </span>
                                                    <span class="mec-col-4">
                                                        <input type="number" min="0" name="mec[settings][ticket_variations][<?php echo $i; ?>][max]" placeholder="<?php esc_attr_e('Maximum Per Ticket', 'mec'); ?>" value="<?php echo (isset($ticket_variation['max']) ? $ticket_variation['max'] : ''); ?>" />
                                                        <span class="mec-tooltip">
                                                            <div class="box top">
                                                                <h5 class="title"><?php _e('Maximum Per Ticket', 'mec'); ?></h5>
                                                                <div class="content"><p><?php esc_attr_e("Maximum Per Ticket. Leave it blank for unlimited.", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/ticket-variations/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                            </div>
                                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                        </span>                                                           
                                                    </span>
                                                    <button class="button" type="button" id="mec_remove_ticket_variation_button<?php echo $i; ?>" onclick="mec_remove_ticket_variation(<?php echo $i; ?>);"><?php _e('Remove', 'mec'); ?></button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="hidden" id="mec_new_ticket_variation_key" value="<?php echo $i+1; ?>" />
                                    <div class="mec-util-hidden" id="mec_new_ticket_variation_raw">
                                        <div class="mec-box" id="mec_ticket_variation_row:i:">
                                            <div class="mec-form-row">
                                                <input class="mec-col-12" type="text" name="mec[settings][ticket_variations][:i:][title]" placeholder="<?php esc_attr_e('Title', 'mec'); ?>" />
                                            </div>
                                            <div class="mec-form-row">
                                                <span class="mec-col-4">
                                                    <input type="text" name="mec[settings][ticket_variations][:i:][price]" placeholder="<?php esc_attr_e('Price', 'mec'); ?>" />
                                                    <span class="mec-tooltip">
                                                            <div class="box top">
                                                                <h5 class="title"><?php _e('Price', 'mec'); ?></h5>
                                                                <div class="content"><p><?php esc_attr_e("Option Price", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/ticket-variations/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                            </div>
                                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                        </span>                                                      
                                                </span>
                                                <span class="mec-col-4">
                                                    <input type="number" min="0" name="mec[settings][ticket_variations][:i:][max]" placeholder="<?php esc_attr_e('Maximum Per Ticket', 'mec'); ?>" value="1" />
                                                    <span class="mec-tooltip">
                                                        <div class="box top">
                                                            <h5 class="title"><?php _e('Maximum Per Ticket', 'mec'); ?></h5>
                                                            <div class="content"><p><?php esc_attr_e("Maximum Per Ticket. Leave it blank for unlimited.", 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/ticket-variations/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                                                        </div>
                                                        <i title="" class="dashicons-before dashicons-editor-help"></i>
                                                    </span>                                                      
                                                </span>
                                                <button class="button" type="button" id="mec_remove_ticket_variation_button:i:" onclick="mec_remove_ticket_variation(:i:);"><?php _e('Remove', 'mec'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div id="booking_form_option" class="mec-options-fields">
                            <h4 class="mec-form-subtitle"><?php _e('Booking Form', 'mec'); ?></h4>
                            <div class="mec-container">
                                <?php do_action( 'before_mec_reg_fields_form' ); ?>
                                <?php do_action( 'mec_reg_fields_form_start' ); ?>
                                <div class="mec-form-row" id="mec_reg_form_container">
                                    <?php /** Don't remove this hidden field **/ ?>
                                    <input type="hidden" name="mec[reg_fields]" value="" />

                                    <ul id="mec_reg_form_fields">
                                        <?php
                                        $i = 0;
                                        foreach ( $reg_fields as $key => $reg_field ) {
                                            if ( ! is_numeric( $key ) ) {
                                                continue;
                                            }
                                            $i = max( $i, $key );

                                            if ( $reg_field['type'] == 'text' ) {
                                                echo $this->main->field_text( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'name' ) {
                                                echo $this->main->field_name( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'mec_email' ) {
                                                echo $this->main->field_mec_email( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'email' ) {
                                                echo $this->main->field_email( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'date' ) {
                                                echo $this->main->field_date( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'file' ) {
                                                echo $this->main->field_file( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'tel' ) {
                                                echo $this->main->field_tel( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'textarea' ) {
                                                echo $this->main->field_textarea( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'p' ) {
                                                echo $this->main->field_p( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'checkbox' ) {
                                                echo $this->main->field_checkbox( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'radio' ) {
                                                echo $this->main->field_radio( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'select' ) {
                                                echo $this->main->field_select( $key, $reg_field );
                                            } elseif ( $reg_field['type'] == 'agreement' ) {
                                                echo $this->main->field_agreement( $key, $reg_field );
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <div id="mec_reg_form_field_types">
                                        <button type="button" class="button red" data-type="name"><?php _e( 'MEC Name', 'mec' ); ?></button>
                                        <button type="button" class="button red" data-type="mec_email"><?php _e( 'MEC Email', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="text"><?php _e( 'Text', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="email"><?php _e( 'Email', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="date"><?php _e( 'Date', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="tel"><?php _e( 'Tel', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="file"><?php _e( 'File', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="textarea"><?php _e( 'Textarea', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="checkbox"><?php _e( 'Checkboxes', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="radio"><?php _e( 'Radio Buttons', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="select"><?php _e( 'Dropdown', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="agreement"><?php _e( 'Agreement', 'mec' ); ?></button>
                                        <button type="button" class="button" data-type="p"><?php _e( 'Paragraph', 'mec' ); ?></button>
                                    </div>
                                    <?php do_action( 'mec_reg_fields_form_end' ); ?>
                                </div>
                                <div class="mec-form-row">
                                    <?php wp_nonce_field( 'mec_options_form' ); ?>
                                    <button  style="display: none;" id="mec_reg_fields_form_button" class="button button-primary mec-button-primary" type="submit"><?php _e( 'Save Changes', 'mec' ); ?></button>
                                </div>
                                <?php do_action( 'after_mec_reg_fields_form' ); ?>
                            </div>
                            <input type="hidden" id="mec_new_reg_field_key" value="<?php echo $i + 1; ?>" />
                            <div class="mec-util-hidden">
                                <div id="mec_reg_field_text">
                                    <?php echo $this->main->field_text( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_email">
                                    <?php echo $this->main->field_email( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_mec_email">
                                    <?php echo $this->main->field_mec_email( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_name">
                                    <?php echo $this->main->field_name( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_tel">
                                    <?php echo $this->main->field_tel( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_date">
                                    <?php echo $this->main->field_date( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_file">
                                    <?php echo $this->main->field_file( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_textarea">
                                    <?php echo $this->main->field_textarea( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_checkbox">
                                    <?php echo $this->main->field_checkbox( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_radio">
                                    <?php echo $this->main->field_radio( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_select">
                                    <?php echo $this->main->field_select( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_agreement">
                                    <?php echo $this->main->field_agreement( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_p">
                                    <?php echo $this->main->field_p( ':i:' ); ?>
                                </div>
                                <div id="mec_reg_field_option">
                                    <?php echo $this->main->field_option( ':fi:', ':i:' ); ?>
                                </div>
                            </div>
                        </div>

                        <div id="payment_gateways_option" class="mec-options-fields">
                            <h4 class="mec-form-subtitle"><?php _e('Payment Gateways', 'mec'); ?></h4>
                            <div class="mec-container">
                                <div class="mec-form-row" id="mec_gateways_form_container">
                                    <ul>
                                        <?php foreach($gateways as $gateway): ?>
                                            <li id="mec_gateway_id<?php echo $gateway->id(); ?>">
                                                <?php $gateway->options_form(); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="mec-form-row" style="margin-top: 30px;">
                                    <div class="mec-col-4">
                                        <label>
                                            <input type="hidden" name="mec[gateways][op_status]" value="0" />
                                            <input id="mec_gateways_op_status" value="1" type="checkbox" name="mec[gateways][op_status]" <?php if(isset($gateways_options['op_status']) and $gateways_options['op_status']) echo 'checked="checked"'; ?> /> <?php _e('Enable Organizer Payment Module', 'mec'); ?>
                                        </label>
                                        <span class="mec-tooltip">
                                            <div class="box">
                                                <h5 class="title"><?php _e('Organizer Payment', 'mec'); ?></h5>
                                                <div class="content"><p><?php esc_attr_e("By enabling this module, organizers are able to insert their own payment credentials for enabled gateways per event and receive the payments directly!", 'mec'); ?></p></div>
                                            </div>
                                            <i title="" class="dashicons-before dashicons-editor-help"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mec-form-row">
                                    <?php wp_nonce_field('mec_options_form'); ?>
                                    <button style="display: none;" id="mec_gateways_form_button" class="button button-primary mec-button-primary" type="submit"><?php _e('Save Changes', 'mec'); ?></button>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>

                        <div class="mec-options-fields">
                            <?php wp_nonce_field('mec_options_form'); ?>
                            <button style="display: none;" id="mec_booking_form_button" class="button button-primary mec-button-primary" type="submit"><?php _e('Save Changes', 'mec'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="wns-be-footer">
        <a id="" class="dpr-btn dpr-save-btn"><?php _e('Save Changes', 'mec'); ?></a>
    </div>

</div>

<script type="text/javascript">
jQuery(document).ready(function()
{   
    jQuery(".dpr-save-btn").on('click', function(event)
    {
        event.preventDefault();
        jQuery("#mec_booking_form_button").trigger('click');
    });
});

jQuery("#mec_booking_form").on('submit', function(event)
{
    event.preventDefault();
    
    // Add loading Class to the button
    jQuery(".dpr-save-btn").addClass('loading').text("<?php echo esc_js(esc_attr__('Saved', 'mec')); ?>");
    jQuery('<div class="wns-saved-settings"><?php echo esc_js(esc_attr__('Settings Saved!', 'mec')); ?></div>').insertBefore('#wns-be-content');

    if(jQuery(".mec-purchase-verify").text() != '<?php echo esc_js(esc_attr__('Verified', 'mec')); ?>')
    {
        jQuery(".mec-purchase-verify").text("<?php echo esc_js(esc_attr__('Checking ...', 'mec')); ?>");
    } 
    
    var settings = jQuery("#mec_booking_form").serialize();
    jQuery.ajax(
    {
        type: "POST",
        url: ajaxurl,
        data: "action=mec_save_settings&"+settings,
        beforeSend: function () {
            jQuery('.wns-be-main').append('<div class="mec-loarder-wrap mec-settings-loader"><div class="mec-loarder"><div></div><div></div><div></div></div></div>');
        },
        success: function(data)
        {
            // Remove the loading Class to the button
            setTimeout(function()
            {
                jQuery(".dpr-save-btn").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
                jQuery('.wns-saved-settings').remove();
                jQuery('.mec-loarder-wrap').remove();
                if(jQuery(".mec-purchase-verify").text() != '<?php echo esc_js(esc_attr__('Verified', 'mec')); ?>')
                {
                    jQuery(".mec-purchase-verify").text("<?php echo esc_js(esc_attr__('Please Refresh Page', 'mec')); ?>");
                }
            }, 1000);
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Remove the loading Class to the button
            setTimeout(function()
            {
                jQuery(".dpr-save-btn").removeClass('loading').text("<?php echo esc_js(esc_attr__('Save Changes', 'mec')); ?>");
                jQuery('.wns-saved-settings').remove();
                jQuery('.mec-loarder-wrap').remove();
            }, 1000);
        }
    });
});
</script>
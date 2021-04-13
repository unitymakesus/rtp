<?php 
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;
if(isset($fields['OwnerId']) && vxg_salesforce::$is_pr){
                      $panel_count++;
                      $users=$this->post('users',$info_meta);
           $meta_user=isset($meta['user']) ? $meta['user'] : '';
               ?>
     <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Object Owner',  'gravity-forms-salesforce-crm' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_owner"><?php _e("Assign Owner ", 'gravity-forms-salesforce-crm'); gform_tooltip('vx_owner_check');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_owner" class="crm_toggle_check <?php if(empty($users)){echo 'vx_refresh_btn';} ?>" name="meta[owner]" value="1" <?php echo !empty($meta["owner"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="owner"><?php _e("Yes and Do not trigger salesforce assignment rules", 'gravity-forms-salesforce-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_owner_div" style="<?php echo empty($meta["owner"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_sel_camp"><?php _e('Users List ','gravity-forms-salesforce-crm'); gform_tooltip('vx_owners'); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_users" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','gravity-forms-salesforce-crm') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','gravity-forms-salesforce-crm') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 

  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_user"><?php _e('Select User ','gravity-forms-salesforce-crm');   gform_tooltip('vx_sel_owner'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_user" name="meta[user]" style="width: 100%;" class="vx_input_100" autocomplete="off">
  <?php echo $this->gen_select($users,$meta_user,__('Select User','gravity-forms-salesforce-crm')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
 
  
  </div>
  

  </div>
  </div>
 
          <?php
                  }
 
if(isset($fields['AccountId']) && vxg_salesforce::$is_pr){
$panel_count++;
$account_feeds=$this->get_object_feeds($form_id,$this->account,'Account'); 

  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Assign Account',  'gravity-forms-salesforce-crm' ),$panel_count); 
echo  in_array($module, array("Order","Contract")) ? $req_span2 : "";
?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="account_check"><?php _e("Assign Account ", 'gravity-forms-salesforce-crm'); gform_tooltip('vx_assign_account');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="account_check" class="crm_toggle_check" name="meta[account_check]" value="1" <?php echo !empty($meta["account_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="contact_check"><?php _e("Enable", 'gravity-forms-salesforce-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="account_check_div" style="<?php echo empty($meta["account_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label for="object_account"><?php _e('Select Account Feed ','gravity-forms-salesforce-crm'); gform_tooltip('vx_sel_account'); ?></label>
</div> 
<div class="vx_col2">

  <select id="object_account" name="meta[object_account]" class="vx_input_100" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($account_feeds ,$meta['object_account'],__('Select Account Feed','gravity-forms-salesforce-crm')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
    <?php
  }  
  
if(isset($fields['ContractId']) ){
      $panel_count++;
      $contract_feeds=$this->get_object_feeds($form_id,$this->account,'Contract');  
  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Assign Contract',  'gravity-forms-salesforce-crm' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="contract_check"><?php _e("Assign Contract ", 'gravity-forms-salesforce-crm'); gform_tooltip('vx_assign_contract');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="contract_check" class="crm_toggle_check" name="meta[contract_check]" value="1" <?php echo !empty($meta["contract_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="contract_check"><?php _e("Enable", 'gravity-forms-salesforce-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="contract_check_div" style="<?php echo empty($meta["contract_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_contract"><?php _e('Select Contract Feed ','gravity-forms-salesforce-crm'); gform_tooltip('vx_sel_contract'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_contract" class="vx_input_100" name="meta[object_contract]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($contract_feeds ,$meta['object_contract'],__('Select Contract Feed','gravity-forms-salesforce-crm')); ?>
  </select>

   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
    <?php
  }
  
if($has_contact ){
      $panel_count++;
      $contact_feeds=$this->get_object_feeds($form_id,$this->account,'Contact');  
  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Assign Contact',  'gravity-forms-salesforce-crm' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">

        <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="contact_check"><?php _e("Assign Contact ", 'gravity-forms-salesforce-crm'); gform_tooltip('vx_assign_contact');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="contact_check" class="crm_toggle_check" name="meta[contact_check]" value="1" <?php echo !empty($meta["contact_check"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="contact_check"><?php _e("Enable", 'gravity-forms-salesforce-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="contact_check_div" style="<?php echo empty($meta["contact_check"]) ? "display:none" : ""?>">
         <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_contact"><?php _e('Select Contact Feed ','gravity-forms-salesforce-crm'); gform_tooltip('vx_sel_contact'); ?></label>
</div> 
<div class="vx_col2">

  <select id="crm_sel_contact" class="vx_input_100" name="meta[object_contact]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($contact_feeds ,$meta['object_contact'],__('Select Contact Feed','gravity-forms-salesforce-crm')); ?>
  </select>
<div class="howto"><?php echo sprintf(__('For assigning a contact to any field user %s as custom value','gravity-forms-salesforce-crm'),'<code>{sf_contact_id}</code>') ?></div>
   </div>

   <div class="clear"></div>
   </div>
    </div>

  </div>
  </div>
    <?php
  }
$camp_support=array("Lead","Contact"); 
if(in_array($module,$camp_support) && vxg_salesforce::$is_pr){
      $panel_count++;
      $campaigns=$this->post('campaigns',$info_meta);
      $member_status_arr=$this->post('member_status',$info_meta);
  ?>
    <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Add as Campaign Member',  'gravity-forms-salesforce-crm' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_camp"><?php _e("Add to Campaign ", 'gravity-forms-salesforce-crm'); gform_tooltip('vx_camp_check');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_camp" class="crm_toggle_check <?php if(empty($member_status_arr) && empty($campaigns)){echo 'vx_refresh_btn';} ?>" name="meta[add_to_camp]" value="1" <?php echo !empty($meta["add_to_camp"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_optin"><?php _e("Enable", 'gravity-forms-salesforce-crm'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_camp_div" style="<?php echo empty($meta["add_to_camp"]) ? "display:none" : ""?>">
   <?php  if($api_type != "web"){  ?> 
  <div class="vx_row">
  <div class="vx_col1">
  <label><?php _e('Campaign & Status Lists ','gravity-forms-salesforce-crm'); gform_tooltip('vx_camps'); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_campaigns" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php _e('Refresh Data','gravity-forms-salesforce-crm') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php _e('Refreshing...','gravity-forms-salesforce-crm') ?></span>
  </button>
  </div> 
   <div class="clear"></div>
  </div> 
  <?php } ?>
  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_camp"><?php _e('Select Campaign ','gravity-forms-salesforce-crm'); gform_tooltip('vx_sel_camp'); ?></label>
</div> <div class="vx_col2">
<?php   if($api_type != "web"){   ?>
<div style="width: 100%; display: table;">
<div style="display: table-cell; width: 85%;">
  <select id="crm_sel_camp" class="vx_input_100" name="meta[campaign]" style="width: 100%; <?php if($this->post('camp_type',$meta) != ""){echo 'display: none';} ?>" autocomplete="off">
  <?php echo $this->gen_select($campaigns,$meta['campaign'],__('Select Campaign','gravity-forms-salesforce-crm')); ?>
  </select>
  <input type="text" name="meta[campaign_id]" id="crm_camp_id" value="<?php echo $this->post('campaign_id',$meta); ?>" style="vertical-align: middle; width: 100%; <?php if($this->post('camp_type',$meta) == ""){echo 'display: none';} ?>" placeholder="<?php _e('Enter Campaign ID','gravity-forms-salesforce-crm') ?>" autocomplete="off">
   </div>
   
  <div style="display: table-cell; padding-left: 10px;">
  <input type="hidden" name="meta[camp_type]" id="crm_camp_type" value="<?php echo $this->post('camp_type',$meta);  ?>" autocomplete="off">
    <button class="button" id="toggle_camp" type="button" style="vertical-align: middle; width: 140px">
  <span class="reg_ok" style="<?php if($this->post('camp_type',$meta) != ""){echo 'display: none';} ?>"><?php _e('Enter Campaign ID','gravity-forms-salesforce-crm') ?></span>
  <span class="reg_proc" style="<?php if($this->post('camp_type',$meta) == ""){echo 'display: none';}else{echo 'display:block;';} ?>"><?php _e('Select Campaign','gravity-forms-salesforce-crm') ?></span>
  </button>
  </div>
  </div>
  <?php }else{ ?>
  <input type="text" id="crm_sel_camp" class="vx_input_100" name="meta[web_camp_id]" placeholder="<?php _e('Enter Campaign Id','gravity-forms-salesforce-crm'); ?>" value="<?php echo $this->post('web_camp_id',$meta); ?>">
  <?php } ?>
  </div>
   <div class="clear"></div>
   </div>
  <div class="vx_row">
   <div class="vx_col1">
  <label for="crm_sel_status"><?php _e('Member Status ','gravity-forms-salesforce-crm'); gform_tooltip('vx_sel_status'); ?></label>
  </div> 
  <div class="vx_col2">
  <?php   if($api_type != "web"){   ?>
  <select id="crm_sel_status" class="vx_input_100" name="meta[member_status]" class="vx_sel" autocomplete="off">
  <?php echo $this->gen_select($member_status_arr,$meta['member_status'],__('Select Status','gravity-forms-salesforce-crm')); ?>
  </select> 
   <?php }else{ ?>
  <input type="text" id="crm_sel_status" class="vx_input_100" name="meta[web_mem_status]" placeholder="<?php _e('Enter Member Status','gravity-forms-salesforce-crm'); ?>" value="<?php echo $this->post('web_mem_status',$meta); ?>">
  <?php } ?> 
  </div>
   <div class="clear"></div>
  </div>
  
  </div>
  

  </div>
  </div>
    <?php
  } 
?>


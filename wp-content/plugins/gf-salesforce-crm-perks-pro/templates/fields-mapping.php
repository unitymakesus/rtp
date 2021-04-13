<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                    
 ?>
<div  class="vx_div">
   <div class="vx_head">
<div class="crm_head_div"> <?php _e('4. Map Form Fields to Salesforce Fields.', 'gravity-forms-salesforce-crm'); ?></div>
<div class="crm_btn_div" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"><i class="fa crm_toggle_btn vx_action_btn fa-minus"></i></div>
<div class="crm_clear"></div> 
  </div>
  <div class="vx_group" style="padding: 10px 0px; border-width: 0px; background-color: transparent;">


  <div id="vx_fields_div">
  <?php 
   $req_span=" <span class='vx_red vx_required'>(".__('Required','gravity-forms-salesforce-crm').")</span>";
 $req_span2=" <span class='vx_red vx_required vx_req_parent'>(".__('Required','gravity-forms-salesforce-crm').")</span>";
 $options=$this->gf_fields_options($form_id,'',$this->account,$feed['id']); 
  foreach($map_fields as $k=>$v){
        if(isset($v['name_c'])){
  $v['name']=$v['name_c'];      
  $v['label']=__('Custom Field','gravity-forms-salesforce-crm');      
  } 
  if( in_array($v['name'] , array("OwnerId","AccountId","ContractId") )){
   // continue;
}
if($module == "Order" && in_array($v['name'] , array("Status" ))){
    continue;
} 
  $sel_val=isset($map[$k]['field']) ? $map[$k]['field'] : ""; 
  $val_type=isset($map[$k]['type']) && !empty($map[$k]['type']) ? $map[$k]['type'] : "field"; 

  $options=$this->gf_fields_options($form_id,$sel_val,$this->account,$feed['id']); 

    $display="none"; $btn_icon="fa-plus";
  if(isset($map[$k][$val_type]) && !empty($map[$k][$val_type])){
    $display="block"; 
    $btn_icon="fa-minus";   
  }
  $required=isset($v['req']) && $v['req'] == "true" ? true : false;
   $req_html=$required ? $req_span : "";
  ?>
<div class="crm_panel crm_panel_100">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text crm_text_label">  <?php echo $v['label'];?></span> <?php echo $req_html ?></div>
<div class="crm_btn_div">
<?php
 if(! $required){   
?>
<i class="vx_remove_btn vx_remove_btn vx_action_btn fa fa-trash-o" title="<?php _e('Delete','gravity-forms-salesforce-crm'); ?>"></i>
<?php } ?>
<i class="fa crm_toggle_btn vx_action_btn vx_btn_inner <?php echo $btn_icon ?>" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i>
</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: <?php echo $display ?>;">
  <?php if(!isset($v['name_c'])){ ?>

  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-name"><?php echo $v['name']; ?></span> </span>
  <?php if($this->post('type',$v) !=""){ ?>
    <span class="crm-desc-type-div">, <?php echo __('Type:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-type"><?php echo $v['type'] ?></span> </span>
<?php
   }
  if($this->post('maxlength',$v) !=""){ 
   ?>
   <span class="crm-desc-len-div">, <?php echo __('Max Length:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-len"><?php echo $v['maxlength']; ?></span> </span>
  <?php 
  }
  ?>
   </div> 
  <?php
  }
  ?>

<div class="vx_margin">

<?php
    if(isset($v['name_c'])){
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php _e('Field API Name','gravity-forms-salesforce-crm') ?></div>
<div class="entry_col2">
<input type="text" name="meta[map][<?php echo $k ?>][name_c]" value="<?php echo $v['name_c'] ?>" placeholder="<?php _e('Field API Name','gravity-forms-salesforce-crm') ?>" class="vx_input_100">
<div class="howto"><?php echo __('In Salesforce, go to setup -> customize -> leads -> fields and copy API name of a field','gravity-forms-salesforce-crm')?></div>
</div>
<div class="crm_clear"></div>
</div> 
<?php             
    }
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><label  for="vx_type_<?php echo $k ?>"><?php _e('Field Type','gravity-forms-salesforce-crm') ?></label></div>
<div class="entry_col2">
<select name='meta[map][<?php echo $k ?>][type]'  id="vx_type_<?php echo $k ?>" class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  $select="";
  if($this->post2($k,'type',$map) == $f_key)
  $select='selected="selected"';
  ?>
  <option value="<?php echo $f_key ?>" <?php echo $select ?>><?php echo $f_val?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  
<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">
<label for="vx_field_<?php echo $k ?>" style="<?php if($this->post2($k,'type',$map) != ''){echo 'display:none';} ?>" class="vxc_fields vxc_field_"><?php _e('Select Field','%dd%') ?></label>

<label for="vx_value_<?php echo $k ?>" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>" class="vxc_fields vxc_field_value"> <?php _e('Custom Value','%dd%') ?></label>
</div>
<div class="entry_col2">
<div class="vxc_fields vxc_field_value" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>">
<textarea name='meta[map][<?php echo $k?>][value]'  id="vx_value_<?php echo $k ?>" placeholder='<?php _e("Custom Value",'%dd%')?>' class='vx_input_100 vxc_field_input'><?php $text_val=$this->post2($k,'value',$map); echo htmlentities($text_val); ?></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','%dd%'),'<code>{field_id}</code>')?></div>
</div>


<select name="meta[map][<?php echo $k ?>][field]"  id="vx_field_<?php echo $k ?>" class="vxc_field_option vx_input_100">
<?php echo $options ?>
</select>


</div>
<div class="crm_clear"></div>
</div>  

  </div></div>
  <div class="clear"></div>
  </div>
<?php
  }
  ?> 
 
 <div id="vx_field_temp" style="display:none"> 
  <div class="crm_panel crm_panel_100 vx_fields">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text crm_text_label">  <?php _e('Custom Field', 'gravity-forms-salesforce-crm');?></span> </div>
<div class="crm_btn_div">
<i class="vx_remove_btn vx_action_btn fa fa-trash-o" title="<?php _e('Delete','gravity-forms-salesforce-crm'); ?>"></i>
<i class="fa crm_toggle_btn vx_action_btn vx_btn_inner fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i>
</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">

<?php
    if($api_type  != 'web'){
?>

  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-name"></span> </span>
  <span class="crm-desc-type-div">, <?php echo __('Type:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-type"></span> </span>
  <span class="crm-desc-len-div">, <?php echo __('Max Length:','gravity-forms-salesforce-crm')." ";?><span class="crm-desc-len"></span> </span>

   </div> 

<?php
    }
?>
<div class="vx_margin">

<?php
    if($api_type  == 'web'){
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php _e('Field API Name','gravity-forms-salesforce-crm') ?></div>
<div class="entry_col2">
<input type="text" name="name_c" placeholder="<?php _e('Field API Name','gravity-forms-salesforce-crm') ?>" class="vx_input_100">
<div class="howto"><?php echo __('In Salesforce, go to setup -> customize -> leads -> fields and copy API name of a field','gravity-forms-salesforce-crm')?></div>
</div>
<div class="crm_clear"></div>
</div> 
<?php
    }
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><label  for="vx_type"><?php _e('Field Type','gravity-forms-salesforce-crm') ?></label></div>
<div class="entry_col2">
<select name='type' class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  ?>
  <option value="<?php echo $f_key ?>"><?php echo $f_val?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  
<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">
<label for="vx_field" class="vxc_fields vxc_field_"><?php _e('Select Field','%dd%') ?></label>
<label for="vx_value" class="vxc_fields vxc_field_value" style="display: none;"> <?php _e('Custom Value','%dd%') ?></label>
</div>
<div class="entry_col2">
<div class="vxc_fields vxc_field_value" style="display: none;">
<textarea name='value'  placeholder='<?php _e("Custom Value",'%dd%')?>' class="vx_input_100 vxc_field_input"></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','%dd%'),'<code>{field_id}</code>')?></div>
</div>

<select name="field"  class="vxc_field_option vx_input_100">
<?php echo $options ?>
</select>


</div>
<div class="crm_clear"></div>
</div>  

  </div></div>
  <div class="clear"></div>
  </div>
   </div>
   <!--end field box template--->
     <?php
  if($api_type =="web"){
  if(vxg_salesforce::$is_pr){
   ?>
  <div class="vx_fields_footer">
  <div class="vx_row">
  <div class="vx_col1"> &nbsp;</div><div class="vx_col2">
  <button type="button" class="button button-default" id="xv_add_custom_field"><i class=" fa fa-plus-circle" ></i> <?php _e('Add Custom Field','gravity-forms-salesforce-crm')?></button></div>
  <div class="clear"></div></div>
   </div>
 <?php } }else{ ?> 
   <div class="crm_panel crm_panel_100">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text ">  <?php _e("Add New Field", 'gravity-forms-salesforce-crm');?></span> </div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn vx_btn_inner fa-minus" style="display: none;" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">

<div class="vx_margin">
<div style="display: table">
  <div style="display: table-cell; width: 85%; padding-right: 14px;">
<select id="vx_add_fields_select" class="vx_input_100" autocomplete="off">
<option value=""></option>
<?php
$json_fields=array();
 foreach($fields as $k=>$v){
     $v['type']=ucfirst($v['type']);
     if(!empty($v['options'])){
         $ops=array();
      foreach($v['options'] as $vv){
          $ops[$vv['value']]=$vv['label'];
      }
    $v['options']=$ops;     
     }
     $json_fields[$k]=$v;
   $disable='';
   if(isset($map_fields[$k])){
    $disable='disabled="disabled"';   
   } 
echo "<option value='{$k}' {$disable} >{$v['label']}</option>";   
} ?>
</select>
  </div><div style="display: table-cell;">
 <button type="button" class="button button-default" style="vertical-align: middle;" id="xv_add_custom_field"><i class="fa fa-plus-circle" ></i> <?php _e('Add Field','gravity-forms-salesforce-crm')?></button>
  
  </div></div>
 

  </div></div>
  <div class="clear"></div>
  </div>
  <!--add new field box template--->
  <script type="text/javascript">
var crm_fields=<?php echo json_encode($json_fields); ?>;

</script> 
  <?php
 }
 ?>
  </div>

  <div class="clear"></div>
  </div>
  </div>
<div class="vx_div">
   <div class="vx_head">
<div class="crm_head_div"> <?php _e('5. When to Send Entry to Salesforce.', 'gravity-forms-salesforce-crm'); ?></div>
<div class="crm_btn_div" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"><i class="fa crm_toggle_btn vx_action_btn fa-minus"></i></div>
<div class="crm_clear"></div> 
  </div>

  <div class="vx_group">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_manual_export">
  <?php esc_html_e('Disable Automatic Export', 'gravity-forms-salesforce-crm'); ?>
  <?php gform_tooltip("vx_manual_export") ?>
  </label>
  </div>
  <div class="vx_col2">
  <fieldset>
  <legend class="screen-reader-text"><span>
  <?php _e('Disable Automatic Export', 'gravity-forms-salesforce-crm'); ?>
  </span></legend>
  <label for="crm_manual_export">
  <input name="meta[manual_export]" id="crm_manual_export" type="checkbox" value="1" <?php echo isset($meta['manual_export'] ) ? 'checked="checked"' : ''; ?>>
  <?php _e( 'Manually send the entries to Salesforce.', 'gravity-forms-salesforce-crm'); ?> </label>
  </fieldset>
  </div>
  <div style="clear: both;"></div>
  </div>
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_optin">
  <?php _e("Opt-In Condition", 'gravity-forms-salesforce-crm'); ?>
  <?php gform_tooltip("vx_optin_condition") ?>
  </label>
  </div>
  <div class="vx_col2">
  <div>
  <input type="checkbox" style="margin-top: 0px;" id="crm_optin" class="crm_toggle_check" name="meta[optin_enabled]" value="1" <?php echo !empty($meta["optin_enabled"]) ? "checked='checked'" : ""?>/>
  <label for="crm_optin">
  <?php _e("Enable", 'gravity-forms-salesforce-crm'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  <div id="crm_optin_div"  style="margin-top: 16px; <?php echo empty($meta["optin_enabled"]) ? "display:none" : ""?>">
  <div>
  <?php
  $sno=0;
  foreach($filters as $filter_k=>$filter_v){
  $sno++;
                              ?>
  <div class="vx_filter_or" data-id="<?php echo $filter_k ?>">
  <?php if($sno>1){ ?>
  <div class="vx_filter_label">
  <?php _e('OR','gravity-forms-salesforce-crm') ?>
  </div>
  <?php } ?>
  <div class="vx_filter_div">
  <?php
  if(is_array($filter_v)){
  $sno_i=0;
  foreach($filter_v as $s_k=>$s_v){   
  $sno_i++;
  
  ?>
  <div class="vx_filter_and">
  <?php if($sno_i>1){ ?>
  <div class="vx_filter_label">
  <?php _e('AND','gravity-forms-salesforce-crm') ?>
  </div>
  <?php } ?>
  <div class="vx_filter_field vx_filter_field1">
  <select id="crm_optin_field" name="meta[filters][<?php echo $filter_k ?>][<?php echo $s_k ?>][field]" class='optin_select_filter'>
  <?php 
  echo $this->gf_fields_options($form_id,$this->post('field',$s_v));
                ?>
  </select>
  </div>
  <div class="vx_filter_field vx_filter_field2">
  <select name="meta[filters][<?php echo $filter_k ?>][<?php echo $s_k ?>][op]" >
  <?php
                 foreach($vx_op as $k=>$v){
  $sel="";
  if($this->post('op',$s_v) == $k)
  $sel='selected="selected"';
                   echo "<option value='".$k."' $sel >".$v."</option>";
               } 
              ?>
  </select>
  </div>
  <div class="vx_filter_field vx_filter_field3">
  <input type="text" class="vxc_filter_text" placeholder="<?php _e('Value','gravity-forms-salesforce-crm') ?>" value="<?php echo $this->post('value',$s_v) ?>" name="meta[filters][<?php echo $filter_k ?>][<?php echo $s_k ?>][value]">
  </div>
  <?php if( $sno_i>1){ ?>
  <div class="vx_filter_field vx_filter_field4"><i class="vx_icons-h vx_trash_and vxc_tips fa fa-trash-o" data-tip="Delete"></i></div>
  <?php } ?>
  <div style="clear: both;"></div>
  </div>
  <?php
  } }
                     ?>
  <div class="vx_btn_div">
  <button class="button button-default button-small vx_add_and" title="<?php _e('Add AND Filter','gravity-forms-salesforce-crm'); ?>"><i class="vx_icons-s vx_trash_and fa fa-hand-o-right"></i>
  <?php _e('Add AND Filter','gravity-forms-salesforce-crm') ?>
  </button>
  <?php if($sno>1){ ?>
  <a href="#" class="vx_trash_or">
  <?php _e('Trash','gravity-forms-salesforce-crm') ?>
  </a>
  <?php } ?>
  </div>
  </div>
  </div>
  <?php
                          }
                      ?>
  <div class="vx_btn_div">
  <button class="button button-default  vx_add_or" title="<?php _e('Add OR Filter','gravity-forms-salesforce-crm'); ?>"><i class="vx_icons vx_trash_and fa fa-check"></i>
  <?php _e('Add OR Filter','gravity-forms-salesforce-crm') ?>
  </button>
  </div>
  </div>
  <!--------- template------------>
  <div style="display: none;" id="vx_filter_temp">
  <div class="vx_filter_or">
  <div class="vx_filter_label">
  <?php _e('OR','gravity-forms-salesforce-crm') ?>
  </div>
  <div class="vx_filter_div">
  <div class="vx_filter_and">
  <div class="vx_filter_label vx_filter_label_and">
  <?php _e('AND','gravity-forms-salesforce-crm') ?>
  </div>
  <div class="vx_filter_field vx_filter_field1">
  <select id="crm_optin_field" name="field" class="optin_select_filter">
  <?php 
  echo $this->gf_fields_options($form_id);
                ?>
  </select>
  </div>
  <div class="vx_filter_field vx_filter_field2">
  <select name="op" >
  <?php
                 foreach($vx_op as $k=>$v){
  
                   echo "<option value='".$k."' >".$v."</option>";
               } 
              ?>
  </select>
  </div>
  <div class="vx_filter_field vx_filter_field3">
  <input type="text" class="vxc_filter_text" placeholder="<?php _e('Value','gravity-forms-salesforce-crm') ?>" name="value">
  </div>
  <div class="vx_filter_field vx_filter_field4"><i class="vx_icons vx_trash_and vxc_tips fa fa-trash-o"></i></div>
  <div style="clear: both;"></div>
  </div>
  <div class="vx_btn_div">
  <button class="button button-default button-small vx_add_and" title="<?php _e('Add AND Filter','gravity-forms-salesforce-crm'); ?>"><i class="vx_icons vx_trash_and  fa fa-hand-o-right"></i>
  <?php _e('Add AND Filter','gravity-forms-salesforce-crm') ?>
  </button>
  <a href="#" class="vx_trash_or">
  <?php _e('Trash','gravity-forms-salesforce-crm') ?>
  </a> </div>
  </div>
  </div>
  </div>
    <div style="display: none;">
<?php 
$form = RGFormsModel::get_form_meta($form_id);
if(!empty($form['fields'])){
 $temp_field=new stdClass();
 $temp_field->id='status';  
 $ops=array();
 $ops[]=array('value'=>'active','text'=>'Active');    
$ops[]=array('value'=>'trash','text'=>'Trash');    
$ops[]=array('value'=>'spam','text'=>'Spam'); 
 $temp_field->choices=$ops;   
 $form['fields'][]=$temp_field;
foreach($form['fields'] as $k=>$v){
$ops=array();
 if(!empty($v->choices)){
 $ops=$v->choices;   
} 
    if(!empty($ops)){ 
?>
  <select id="cfx_op_<?php echo $v->id ?>" class="cfx_op">
  <?php
foreach($ops as $v_op){
?>
<option value="<?php echo htmlentities($v_op['value']); ?>"><?php echo htmlentities($v_op['text']); ?></option>
<?php } ?>
  </select> 
<?php        
    }
} }
   ?>
  </div>
  <!--------- template end ------------>
  </div>
  </div>
  <div style="clear: both;"></div>
  </div>
<?php
   if($api_type != "web"){ 
         $settings=get_option($this->type.'_settings',array());
         if(!empty($settings['notes'])){
?>

  <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_notes"><?php _e('Entry Notes ', 'gravity-forms-salesforce-crm');  gform_tooltip('vx_entry_notes');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_notes" class="crm_toggle_check" name="meta[entry_notes]" value="1" <?php echo !empty($meta['entry_notes']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="vx_notes"><?php _e('Add / delete notes to Salesforce when added / deleted in Gravity Forms', 'gravity-forms-salesforce-crm'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div>
<?php
         }
    }
?>

  </div>    
   </div>
  <?php
   $panel_count=5;
  if($api_type != "web"){  
      $panel_count++;
      $key_fields=array();
      if(is_array($fields)){
          foreach($fields as $k=>$v){
         $key_fields[$k]=$v;
          if($k == 'FirstName' && isset($fields['LastName'])){
              $key_fields['FirstName+LastName']=array('label'=>'First Name & Last Name');
              if(isset($fields['Email'])){
              $key_fields['FirstName+LastName+Email']=array('label'=>'First Name & Last Name & Email');
          }    }
          }
      }
  ?>     
  <div class="vx_div "> 
  <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Choose Primary Key.',  'gravity-forms-salesforce-crm' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                    
    <div class="vx_group">
    
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_primary_field"><?php _e('Select Primary Key','gravity-forms-salesforce-crm') ?></label>
  </div><div class="vx_col2">
  <select id="crm_primary_field" name="meta[primary_key]" class="vx_sel vx_input_100" autocomplete="off">
  <?php echo $this->crm_select($key_fields,$meta['primary_key']); ?>
  </select> 
  <div class="description" style="float: none; width: 90%"><?php _e('If you want to update a pre-existing object, select what should be used as a unique identifier ("Primary Key"). For example, this may be an email address, lead ID, or address. When a new entry comes in with the same "Primary Key" you select, a new object will not be created, instead the pre-existing object will be updated.', 'gravity-forms-salesforce-crm'); ?></div>
  </div>
  <div class="clear"></div>
  </div>
  
    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_primary_field2"><?php _e('Second Primary Key','gravity-forms-salesforce-crm') ?></label>
  </div><div class="vx_col2">
  <select id="crm_primary_field2" name="meta[primary_key2]" class="vx_sel vx_input_100" autocomplete="off">
  <?php echo $this->crm_select($key_fields,$meta['primary_key2']); ?>
  </select> 
  <div class="description" style="float: none; width: 90%"><?php _e('(optional) If you set second key then plugin will find results matching with first primary key OR second primary key', 'gravity-forms-salesforce-crm'); ?></div>
  </div>
  <div class="clear"></div>
  </div>
  
 <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_update"><?php _e('Update Entry ', 'gravity-forms-salesforce-crm');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_update" class="crm_toggle_check" name="meta[update]" value="1" <?php echo !empty($meta['update']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="vx_update"><?php _e('Do not update entry, if already exists', 'gravity-forms-salesforce-crm'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div>
   
      <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_new_entry"><?php _e('Create New Entry ', 'gravity-forms-salesforce-crm');?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_new_entry" class="crm_toggle_check" name="meta[new_entry]" value="1" <?php echo !empty($meta['new_entry']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="vx_new_entry"><?php _e('Do not create new entry in Salesforce', 'gravity-forms-salesforce-crm'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div>
   
  </div>

  </div>
  <!-------------------------- lead owner -------------------->
  <div class="vx_div">
     <div class="vx_head">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Add Note.', 'gravity-forms-salesforce-crm'),$panel_count+=1); ?></div>
<div class="crm_btn_div" title="<?php _e('Expand / Collapse','gravity-forms-salesforce-crm') ?>"><i class="fa crm_toggle_btn fa-minus"></i></div>
<div class="crm_clear"></div> 
  </div>


  <div class="vx_group">

    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note">
  <?php _e("Add Note ", 'gravity-forms-salesforce-crm'); ?>
  <?php gform_tooltip('vx_entry_note') ?>
  </label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_note" class="crm_toggle_check" name="meta[note_check]" value="1" <?php echo !empty($meta['note_check']) ? "checked='checked'" : ""?>/>
  <label for="crm_note_div">
  <?php _e("Enable", 'gravity-forms-salesforce-crm'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  </div>
  <div id="crm_note_div" style="margin-top: 16px; <?php echo empty($meta["note_check"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note_fields">
  <?php _e( 'Note Fields ', 'gravity-forms-salesforce-crm' ); gform_tooltip("vx_note_fields") ?>
  </label>
  </div>
  <div class="vx_col2 entry_col2">
  <textarea name="meta[note_val]"  placeholder="<?php _e("{field-id} text",'gravity-forms-salesforce-crm')?>" class="vx_input_100 vxc_field_input" style="height: 60px"><?php
  if(!empty($meta['note_fields']) && is_array($meta['note_fields'])){
          $meta['note_val']='{'.implode("}\n{",$meta['note_fields'])."}";
}
   echo $this->post('note_val',$meta); ?></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields. You can use %s for separating note title from body','gravity-forms-salesforce-crm'),'<code>{field_id}</code>','<code>?</code>')?></div>

<select name="field"  class="vxc_field_option vx_input_100">
<?php echo $options ?>
</select>
   </div>
  <div style="clear: both;"></div>
  </div>
  
   <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note_list">
  <?php _e( 'Salesforce Related List ', 'gravity-forms-salesforce-crm' ); ?>
  </label>
  </div>
  <div class="vx_col2">
  <select name="meta[note_list]" id="crm_note_list" class="vx_input_100" style="width: 100%"  autocomplete="off">
  <?php 
  $note_lists=array(''=>'Notes and Attachments list','notes'=>'Notes List');
  echo $this->gen_select($note_lists,$meta['note_list']); ?>
  </select>
    <span class="howto">
  <?php _e('Note will be added to selected related list in salesforce.', 'gravity-forms-salesforce-crm'); ?>
  </span>
   </div>
  <div style="clear: both;"></div>
  </div>
  
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_disable_note">
  <?php _e( 'Disable Note ', 'gravity-forms-salesforce-crm' ); gform_tooltip("vx_disable_note") ?>
  </label>
  </div>
  <div class="vx_col2">
  
  <input type="checkbox" style="margin-top: 0px;" id="crm_disable_note" class="crm_toggle_check" name="meta[disable_entry_note]" value="1" <?php echo !empty($meta['disable_entry_note']) ? "checked='checked'" : ""?>/>
  <label for="crm_disable_note">
  <?php _e('Do not Add Note if entry already exists in Salesforce', 'gravity-forms-salesforce-crm'); ?>
  </label>
    
   </div>
  <div style="clear: both;"></div>
  </div>
  
  </div>

  </div>
  </div>
 <?php               
  }   
$file=self::$path.'pro/pro-mapping.php';
if(self::$is_pr && file_exists($file)){
include_once($file);
}
?>
  <div class="button-controls submit" style="padding-left: 5px;">
  <input type="hidden" name="form_id" value="<?php echo $form_id ?>">
  <button type="submit" title="<?php _e('Save Feed','gravity-forms-salesforce-crm'); ?>" name="<?php echo $this->id ?>_submit" class="button button-primary button-hero"> <i class="vx_icons vx vx-arrow-50"></i> <?php echo empty($fid) ? __("Save Feed", 'gravity-forms-salesforce-crm') : __("Update Feed", 'gravity-forms-salesforce-crm'); ?> </button>
  </div>

  <?php
      do_action('add_section_mapping_'.$this->id);
  ?>


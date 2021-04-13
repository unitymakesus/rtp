<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }
                                        
 ?>
<script type="text/javascript" src="<?php echo $this->get_base_url() ?>js/jquery.tablesorter.min.js"></script> 
<style type="text/css">
.vx_red{
color: #E31230;
}
  .vx_green{
    color:rgb(0, 132, 0);  
  }
</style>
<table class="widefat fixed sort striped vx_accounts_table" style="margin: 20px 0 50px 0">
<thead>
<tr> <th class="manage-column column-cb vx_pointer" style="width: 30px" ><?php _e("#",'gravity-forms-salesforce-crm'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th>  
<th class="manage-column vx_pointer"> <?php _e("Account",'gravity-forms-salesforce-crm'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column"> <?php _e("Status",'gravity-forms-salesforce-crm'); ?> </th> 
<th class="manage-column vx_pointer"> <?php _e("Created",'gravity-forms-salesforce-crm'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column vx_pointer"> <?php _e("Last Connection",'gravity-forms-salesforce-crm'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column"> <?php _e("Action",'gravity-forms-salesforce-crm'); ?> </th> </tr>
</thead>
<tbody>
<?php

$nonce=wp_create_nonce("vx_nonce");
if(is_array($accounts) && count($accounts) > 0){
 $sno=0;   
foreach($accounts as $id=>$v){
    $sno++; $id=$v['id'];
    $icon= $v['status'] == "1" ? 'fa-check vx_green' : 'fa-times vx_red';
    $icon_title= $v['status'] == "1" ? __('Connected','gravity-forms-salesforce-crm') : __('Disconnected','gravity-forms-salesforce-crm');
 ?>
<tr> <td><?php echo $id ?></td>  <td> <?php echo $v['name'] ?></td> 
<td> <i class="fa <?php echo $icon ?>" title="<?php echo $icon_title ?>"></i> </td> <td> <?php echo  date('M-d-Y H:i:s', strtotime($v['time'])+$offset); ?> </td>
 <td> <?php echo  date('M-d-Y H:i:s', strtotime($v['updated'])+$offset); ?> </td> 
<td><span class="row-actions visible">
<a href="<?php echo $page_link."&id=".$id ?>" title="<?php _e('View/Edit','gravity-forms-salesforce-crm'); ?>"><?php
if($v['status'] == "1"){
 _e('View','gravity-forms-salesforce-crm');
}else{
    _e('Edit','gravity-forms-salesforce-crm');
}
 ?></a>
 | <span class="delete"><a href="<?php echo $page_link.'&'.$this->id.'_tab_action=del_account&id='.$id.'&vx_nonce='.$nonce ?>" class="vx_del_account" > <?php _e("Delete",'gravity-forms-salesforce-crm'); ?> </a></span></span> </td> </tr>
<?php
} }else{
?>
<tr><td colspan="6"><p><?php echo sprintf(__("No Salesforce Account Found. %sAdd New Account%s",'gravity-forms-salesforce-crm'),'<a href="'.$new_account.'">','</a>'); ?></p></td></tr>
<?php
}
?>
</tbody>
<tfoot>
<tr> <th class="manage-column column-cb" style="width: 30px" ><?php _e("#",'gravity-forms-salesforce-crm'); ?></th>  
<th class="manage-column"> <?php _e("Account",'gravity-forms-salesforce-crm'); ?> </th> 
<th class="manage-column"> <?php _e("Status",'gravity-forms-salesforce-crm'); ?> </th> 
<th class="manage-column"> <?php _e("Created",'gravity-forms-salesforce-crm'); ?> </th> 
<th class="manage-column"> <?php _e("Last Connection",'gravity-forms-salesforce-crm'); ?> </th> 
<th class="manage-column"> <?php _e("Action",'gravity-forms-salesforce-crm'); ?> </th> </tr>
</tfoot>
</table>
<script>
jQuery(document).ready(function($){
    $('.vx_accounts_table').tablesorter( {headers: { 2:{sorter: false}, 5:{sorter: false}}} );
   $(".vx_del_account").click(function(e){
     if(!confirm('<?php _e('Are you sure to delete Account ?','gravity-forms-salesforce-crm') ?>')){
         e.preventDefault();
     }  
   }) 
})
</script>
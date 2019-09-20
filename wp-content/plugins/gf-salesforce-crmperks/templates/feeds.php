<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                            
 ?>  <style type="text/css">
  .user-list tr {
  cursor: move;
  }
  .user-list tr td a {
  cursor: pointer;
  }
  .user-list tr:nth-child(even) {
  background-color: #f5f5f5;
  }
  .vx_col{
  width: 35px; padding-top: 12px !important; text-align: center; cursor: auto;
  }
  .vx_date{
  width: 18%;
  }
  .ui-sortable-helper {
  display: table;
  background: #eee;
  }

  .vx_wrap .subsubsub{
margin-top: 0px;
margin-left: 2px;
}
  </style>
  <div class="vx_wrap"> <img alt="<?php _e("Salesforce Feeds", 'gravity-forms-salesforce-crm') ?>" title="<?php _e("Salesforce Feeds", 'gravity-forms-salesforce-crm') ?>" src="<?php echo $this->get_base_url()?>images/salesforce-crm-logo.png?ver=1" style="float:left; margin:0 7px 10px 0;" height="46" />
  <h2  style="margin-bottom: 12px"><?php _e("Salesforce Feeds", 'gravity-forms-salesforce-crm'); ?> 
  <a class="add-new-h2" href="<?php echo $new_feed_link?>">
  <?php _e("Add New", 'gravity-forms-salesforce-crm') ?>
  </a> </h2>
  <div class="clear"></div>
  <?php
  if(!$valid_accounts){
  ?>
  <div class="error below-h2" id="message" style="margin-top:20px;">
  <p><?php echo  sprintf( __("To get started, please configure your %s Salesforce Settings %s.", 'gravity-forms-salesforce-crm'), '<a href="'.$page_link.'">', "</a>") ?></p>
  </div>
  <?php
  } 
  ?>
  <ul class="subsubsub" style="margin-top:0;">
<?php
      foreach($menu_links as $k=>$link){
          ?>
       <li>
       <?php
       if($k!="settings"){
          echo " | ";   
        }
       ?>
       <a href="<?php echo $link['link'] ?>" title="<?php echo $link['title']?>" <?php if($link['current']){echo 'class="current"';} ?>><?php echo $link['title']?></a> 
       </li>     
          <?php
      }
  ?>
  </ul>
  <?php if(apply_filters('tab_contents_'.$this->id,false)){ return; } ?>  
  <form id="feed_form" method="post">
  <?php wp_nonce_field('vx_crm_ajax') ?>
  <input type="hidden" id="action" name="action"/>
  <input type="hidden" id="action_argument" name="action_argument"/>
  <div class="tablenav">
  <div class="alignleft actions" style="padding:8px 0 7px; ">
  <label class="hidden" for="bulk_action">
  <?php esc_html_e("Bulk action", 'gravity-forms-salesforce-crm') ?>
  </label>
  <select name="bulk_action" id="bulk_action" style="width: 200px">
  <option value=''>
  <?php esc_html_e("Bulk action", 'gravity-forms-salesforce-crm') ?>
  </option>
  <option value='delete'>
  <?php esc_html_e("Delete", 'gravity-forms-salesforce-crm') ?>
  </option>
  </select>
  <button type="submit" title="<?php  _e("Apply Action", 'gravity-forms-salesforce-crm') ?>" class="button" id="vx_bulk_actions_submit">
  <?php  _e("Apply", 'gravity-forms-salesforce-crm') ?>
  </button>
  </div>
  </div>
  <table class="widefat fixed sort" cellspacing="0">
  <thead>
  <tr>
  <th id="cb" class="column-cb check-column" style=""><input type="checkbox" /></th>
  <th id="active" class="vx_col"></th>
  <th><?php _e("Name", 'gravity-forms-salesforce-crm') ?></th>
  <th><?php _e("Salesforce Object", 'gravity-forms-salesforce-crm') ?></th>
  <th><?php _e("Primary Key", 'gravity-forms-salesforce-crm'); ?></th>
  <th class="vx_date"><?php _e("Created", 'gravity-forms-salesforce-crm') ?></th>
  </tr>
  </thead>
  <tfoot>
  <tr>
  <th id="cb" class="column-cb check-column" style=""><input type="checkbox" /></th>
  <th id="active" class="vx_col"></th>
  <th><?php _e("Name", 'gravity-forms-salesforce-crm') ?></th>
  <th><?php _e("Salesforce Object", 'gravity-forms-salesforce-crm') ?></th>
  <th><?php _e("Primary Key", 'gravity-forms-salesforce-crm'); ?></th>
  <th class="vx_date"><?php _e("Created", 'gravity-forms-salesforce-crm') ?></th>
  </tr>
  </tfoot>
  <tbody class="list:user user-list">
  <?php
  
  if(is_array($feeds) && !empty($feeds)){
  
      foreach($feeds as $feed){
          $data=$this->post('data',$feed);
          $meta=$this->post('meta',$feed);
          $data=json_decode($data,true);
          $fields=json_decode($meta,true);
          $fields=$this->post('fields',$fields);
  $primary_key=!empty($data['primary_key']) && isset($fields[$data['primary_key']]['label']) ? $fields[$data['primary_key']]['label'] : __('N/A','gravity-forms-salesforce-crm');
  $edit_link=$this->get_feed_link($feed['id']);
          ?>
  <tr class='author-self status-inherit' data-id="<?php echo $feed['id'] ?>">
  <th scope="row" class="check-column"><input type="checkbox" class="vx_check" name="feed[]" value="<?php echo $feed["id"] ?>"/></th>
  <td class="vx_col"><img src="<?php echo $this->get_base_url() ?>images/active<?php echo intval($feed["is_active"]) ?>.png" alt="<?php echo $feed["is_active"] ? __("Active", 'gravity-forms-salesforce-crm') : __("Inactive", 'gravity-forms-salesforce-crm');?>" title="<?php echo $feed["is_active"] ? __("Active", 'gravity-forms-salesforce-crm') : __("Inactive", 'gravity-forms-salesforce-crm');?>" class="vx_toggle_status" /></td>
  <td><a href="<?php echo $edit_link ?>" title="<?php echo esc_html( $feed["name"] ) ?>"><?php echo $feed["name"];  ?></a> 
  
  <div class="row-actions"> <span class="edit"> 
  <a title="<?php esc_attr_e("Edit Settings", 'gravity-forms-salesforce-crm') ?>" href="<?php echo $edit_link ?>">
  <?php esc_html_e("Edit", 'gravity-forms-salesforce-crm') ?>
  </a> | 
  </span> 
  <span class="edit"> 
  <a title="<?php esc_html_e("Delete", 'gravity-forms-salesforce-crm') ?>" href="#" class="vx_del_feed">
  <?php esc_html_e("Delete", 'gravity-forms-salesforce-crm')?>
  </a>  
  </span> 

  </div></td>
  <td><p><?php echo isset($objects[$feed["object"]]) ? $objects[$feed["object"]] : $feed["object"];  ?></p></td>
  <td><p><?php echo $primary_key; ?></p></td>
  <td><p><?php echo  date('M-d-Y H:i:s', strtotime($feed['time'])+$offset); ?></p></td>
  </tr>
  <?php
      }
  }
  else {
      if($valid_accounts){
          ?>
  <tr>
  <td colspan="4" style="padding:20px;"><?php echo sprintf(__("You don't have any Salesforce feeds configured. Let's go %s create one %s!", 'gravity-forms-salesforce-crm'), '<a href="'.$new_feed_link.'">', "</a>"); ?></td>
  </tr>
  <?php
      }
      else{
          ?>
  <tr>
  <td colspan="4" style="padding:20px;"><?php echo sprintf(__("To get started, please configure your %s Salesforce Settings%s.", 'gravity-forms-salesforce-crm'), '<a href="'.$page_link.'">', "</a>"); ?></td>
  </tr>
  <?php
      }
  }
  ?>
  </tbody>
  </table>
  </form>
  </div>
    <?php
      do_action('add_section_mapping_'.$this->id);
  ?>
  <script type="text/javascript">
  var vx_crm_nonce='<?php echo wp_create_nonce("vx_crm_ajax") ?>';

  (function( $ ) {
  
  $(document).ready( function($) {
      
        $(".vx_del_feed").click(function(e){
           e.preventDefault();
      if(!confirm("<?php _e("Delete this feed? 'Cancel' to stop, 'OK' to delete.", 'gravity-forms-salesforce-crm') ?>")){
          return;
      }
      var id=$(this).closest('tr').data('id');
     jQuery("#action_argument").val(id);
  jQuery("#action").val("delete");
  jQuery("#feed_form")[0].submit(); 
  });
  $(".vx_toggle_status").click(function(e){
      e.preventDefault();
    var feed_id;
    var img=this;
  var is_active = img.src.indexOf("active1.png") >=0
  var $img=$(this);
  
  if(is_active){
  img.src=img.src.replace("active1.png", "active0.png");
  $img.attr('title','<?php _e("Inactive", 'gravity-forms-salesforce-crm') ?>').attr('alt', '<?php _e("Inactive", 'gravity-forms-salesforce-crm') ?>');
  }
  else{
  img.src = img.src.replace("active0.png", "active1.png");
  $img.attr('title','<?php _e("Active", 'gravity-forms-salesforce-crm') ?>').attr('alt', '<?php _e("Active", 'gravity-forms-salesforce-crm') ?>');
  }
  
  if(feed_id = $img.closest('tr').attr('data-id')) {
      $.post(ajaxurl,{action:"update_feed_<?php echo $this->id ?>",vx_crm_ajax:vx_crm_nonce,feed_id:feed_id,is_active:is_active ? 0 : 1})
  }
  });
  
  $("#vx_bulk_actions_submit").click(function(e){
       if($("#bulk_action").val() == ""){
  alert('<?php _e('Please Select Action','gravity-forms-salesforce-crm') ?>');
  return false;
  }
  if($(".vx_check:checked").length == 0){
  alert('<?php _e('Please Select Feed','gravity-forms-salesforce-crm') ?>');
  return false;
  }
  if(!confirm('<?php _e("Are you sure to Delete selected feeds?",'gravity-forms-salesforce-crm'); ?>' )){
  return false;
  }    
  })
  $('.sort tbody').sortable({
  axis: 'y',
  helper: "clone",
  helper: function(e, tr)
  {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index)
    {
      // Set helper cell sizes to match the original sizes
      $(this).width($originals.eq(index).width());
    });
    return $helper;
  },
  update: function(event, ui){
  var data = {
  'action': 'update_feed_sort_<?php echo $this->id ?>',
  'sort': [],
  'vx_crm_ajax': vx_crm_nonce,
  };
  
  $(this).children().each(function(index, element) {
  var id = $(element).attr('data-id')
  data.sort.push(id);
  })
  
  $.post( ajaxurl, data );
  
  }
  });
  
  });
  
  }(jQuery));
  </script>
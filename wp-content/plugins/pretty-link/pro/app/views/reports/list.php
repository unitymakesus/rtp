<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<div class="wrap">
  <?php echo PrliAppHelper::page_title(__('Link Reports', 'pretty-link')); ?>
  <a href="<?php echo admin_url('admin.php?page=plp-reports&action=new'); ?>" class="page-title-action"><?php _e('Add Report', 'pretty-link'); ?></a>
  <hr class="wp-header-end">

  <?php if($record_count <= 0): ?>
    <div class="updated notice notice-success is-dismissible"><p><?php echo $prli_message; ?></p></div>
  <?php endif; ?>

  <div id="search_pane" style="float: right;">
    <form class="form-fields" name="report_form" method="post" action="">
      <?php wp_nonce_field('prlipro-reports'); ?>
      <input type="hidden" name="sort" id="sort" value="<?php echo $sort_str; ?>" />
      <input type="hidden" name="sdir" id="sort" value="<?php echo $sdir_str; ?>" />
      <input type="text" name="search" id="search" value="<?php echo esc_attr($search_str); ?>" style="display:inline;"/>
      <div class="submit" style="display: inline;"><input class="button button-primary" type="submit" name="Submit" value="Search"/>
      <?php if(!empty($search_str)): ?>
      &nbsp; <a href="<?php echo admin_url('admin.php?page=plp-reports&action=list'); ?>" class="button"><?php _e('Reset', 'pretty-link'); ?></a>
      <?php endif; ?>
      </div>
    </form>
  </div>

  <?php require(PRLI_VIEWS_PATH.'/shared/table-nav.php'); ?>
  <table class="widefat post fixed" cellspacing="0">
    <thead>
      <tr>
        <th class="manage-column" width="35%"><a href="<?php echo admin_url('admin.php?page=plp-reports&action=list&sort=name') . (($sort_str == 'name' && $sdir_str == 'asc')?'&sdir=desc':''); ?>"><?php _e('Name', 'pretty-link'); ?><?php echo (($sort_str == 'name')?'&nbsp;&nbsp;&nbsp;<img src="'.PRLI_IMAGES_URL.'/'.(($sdir_str == 'desc')?'arrow_down.png':'arrow_up.png').'"/>':'') ?></a></th>
        <th class="manage-column" width="35%"><a href="<?php echo admin_url('admin.php?page=plp-reports&action=list&sort=goal_link_name') . (($sort_str == 'goal_link_name' and $sdir_str == 'asc')?'&sdir=desc':''); ?>"><?php _e('Goal Link', 'pretty-link'); ?><?php echo (($sort_str == 'goal_link_name')?'&nbsp;&nbsp;&nbsp;<img src="'.PRLI_IMAGES_URL.'/'.(($sdir_str == 'desc')?'arrow_down.png':'arrow_up.png').'"/>':'') ?></a></th>
        <th class="manage-column" width="10%"><a href="<?php echo admin_url('admin.php?page=plp-reports.php&action=list&sort=link_count') . (($sort_str == 'link_count' and $sdir_str == 'asc')?'&sdir=desc':''); ?>"><?php _e('Links', 'pretty-link'); ?><?php echo (($sort_str == 'link_count')?'&nbsp;&nbsp;&nbsp;<img src="'.PRLI_IMAGES_URL.'/'.(($sdir_str == 'desc')?'arrow_down.png':'arrow_up.png').'"/>':'') ?></a></th>
        <th class="manage-column" width="20%"><a href="<?php echo admin_url('admin.php?page=plp-reports&action=list&sort=created_at') . (($sort_str == 'created_at' and $sdir_str == 'asc')?'&sdir=desc':''); ?>"><?php _e('Created', 'pretty-link'); ?><?php echo ((empty($sort_str) or $sort_str == 'created_at')?'&nbsp;&nbsp;&nbsp;<img src="'.PRLI_IMAGES_URL.'/'.((empty($sort_str) or $sdir_str == 'desc')?'arrow_down.png':'arrow_up.png').'"/>':'') ?></a></th>
      </tr>
    </thead>
    <?php

    if($record_count <= 0) {
        ?>
      <tr>
        <td colspan="4"><?php _e('No Pretty Link Reports were found', 'pretty-link'); ?></td>
      </tr>
      <?php
    }
    else {
      $row_index=0;
      foreach($reports as $report) {
        $alternate = ( $row_index++ % 2 ? '' : 'alternate' );
        ?>
        <tr id="record_<?php echo $report->id; ?>" class="<?php echo $alternate; ?>">
          <td class="edit_report">
          <a class="report_name" href="<?php echo admin_url("admin.php?page=plp-reports&action=edit&id={$report->id}"); ?>" title="Edit <?php echo stripslashes($report->name); ?>"><?php echo stripslashes($report->name); ?></a>
            <br/>
            <div class="report_actions">
              <a href="<?php echo admin_url("admin.php?page=plp-reports&action=edit&id={$report->id}"); ?>" title="Edit <?php echo $report->name; ?>"><?php _e('Edit', 'pretty-link'); ?></a>&nbsp;|
              <a href="<?php echo admin_url("admin.php?page=plp-reports&action=destroy&id={$report->id}"); ?>" onclick="return confirm('Are you sure you want to delete your <?php echo $report->name; ?> Pretty Link Report?');" title="Delete <?php echo $report->name; ?>"><?php _e('Delete', 'pretty-link'); ?></a>&nbsp;|
              <a href="<?php echo admin_url("admin.php?page=plp-reports&action=display-custom-report&id={$report->id}"); ?>" title="View report for <?php echo $report->name; ?>"><?php _e('View', 'pretty-link'); ?></a>
            </div>
          </td>
          <td><?php echo $report->goal_link_name; ?></td>
          <td><?php echo $report->link_count; ?></td>
          <td><?php echo $report->created_at; ?></td>
        </tr>
        <?php
      }
    }
    ?>
      <tfoot>
      <tr>
        <th class="manage-column"><?php _e('Name', 'pretty-link'); ?></th>
        <th class="manage-column"><?php _e('Goal Link', 'pretty-link'); ?></th>
        <th class="manage-column"><?php _e('Links', 'pretty-link'); ?></th>
        <th class="manage-column"><?php _e('Created', 'pretty-link'); ?></th>
      </tr>
      </tfoot>
  </table>
  <?php require(PRLI_VIEWS_PATH.'/shared/table-nav.php'); ?>
</div>

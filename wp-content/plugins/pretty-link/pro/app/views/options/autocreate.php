<?php if(!defined('ABSPATH')) die('You are not allowed to call this page directly.'); ?>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row">
        <label for="<?php echo $option_name; ?>">
          <?php printf(__('%s Shortlinks', 'pretty-link'), $p->labels->singular_name); ?>
          <?php
            PrliAppHelper::info_tooltip("prli-{$post_type}-auto",
              sprintf(__('Create Pretty Links for %s', 'pretty-link'), $p->labels->name),
              sprintf(__('Automatically Create a Pretty Link for each of your published %s', 'pretty-link'), $p->labels->name)
            );
          ?>
        </label>
      </th>
      <td>
        <input class="prli-toggle-checkbox" data-box="prli-<?php echo $post_type; ?>-option-box" type="checkbox" name="<?php echo $option_name; ?>" <?php checked(!empty($option)); ?>/>
      </td>
    </tr>
  </tbody>
</table>

<div class="prli-sub-box prli-<?php echo $post_type; ?>-option-box">
  <div class="prli-arrow prli-gray prli-up prli-sub-box-arrow"> </div>
  <table class="form-table">
    <tbody>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $group_name; ?>">
            <?php _e('Group', 'pretty-link'); ?>
            <?php
              PrliAppHelper::info_tooltip("prli-{$post_type}s-group",
                sprintf(__('%s Auto Link Group', 'pretty-link'), $p->labels->singular_name),
                sprintf(__('Group that Pretty Links for %s will be automatically added to.', 'pretty-link'), $p->labels->name)
              );
            ?>
          </label>
        </th>
        <td>
          <?php echo PrliAppHelper::groups_dropdown( $group_name, $group ); ?>
          <a href="<?php echo admin_url('admin.php?page=pretty-link-groups&action=new'); ?>" class="button"><?php _e('Add a New Group', 'pretty-link'); ?></a>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="<?php echo $socbtns_name; ?>">
            <?php _e('Show Social Buttons', 'pretty-link'); ?>
            <?php
              PrliAppHelper::info_tooltip("prli-social-{$post_type}s-buttons",
                sprintf(__('Show Social Buttons on %s', 'pretty-link'), $p->labels->name),
                sprintf(__('If this button is checked then you\'ll have the ability to include a social buttons bar on your %s.', 'pretty-link'), $p->labels->name)
              );
            ?>
          </label>
        </th>
        <td>
          <input type="checkbox" name="<?php echo $socbtns_name; ?>" <?php checked(!empty($socbtns)); ?>/>
        </td>
      </tr>
    </tbody>
  </table>
</div>


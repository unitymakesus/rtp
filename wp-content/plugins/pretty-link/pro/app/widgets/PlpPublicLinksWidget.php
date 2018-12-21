<?php
if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpPublicLinksWidget extends WP_Widget {
  // widget actual processes
  public function __construct() {
    parent::__construct(false, __('Create a Short URL'));
  }

  // outputs the content of the widget
  public function widget($args, $instance) {
    extract( $args );

    echo $before_widget . $before_title . $after_title .
      PlpPublicLinksHelper::display_form(
        $instance['label'],
        $instance['button'],
        $instance['redirect_type'],
        $instance['track'],
        $instance['group']
      ) . $after_widget;
  }

  // processes widget options to be saved
  public function update($new_instance, $old_instance) {
    return $new_instance;
  }

  // outputs the options form on admin
  public function form($instance) {
    $selected = ' selected="selected"';

    $instance = array_merge(
      array(
        'label' => '',
        'button' => '',
        'redirect_type' => '',
        'track' => '',
        'group' => '',
        'saved_before' => ''
      ),
      $instance
    );

    $label         = esc_attr($instance['label']);
    $button        = esc_attr($instance['button']);
    $redirect_type = esc_attr($instance['redirect_type']);
    $track         = esc_attr($instance['track']);
    $group         = esc_attr($instance['group']);
    $saved_before  = esc_attr($instance['saved_before']);
  ?>
    <input type="hidden" id="<?php echo $this->get_field_id('saved_before'); ?>" name="<?php echo $this->get_field_name('saved_before'); ?>" value="1" />
    <p><label for="<?php echo $this->get_field_id('label'); ?>"><?php _e('Label Text:', 'pretty-link'); ?> <input class="widefat" id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" type="text" value="<?php echo (($saved_before != '1')?'Enter a URL:&nbsp;':$label); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button Text:', 'pretty-link'); ?> <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo (($saved_before != '1')?'Shrink':$button); ?>" /></label><br/><small>(<?php _e('if left blank, no button will display', 'pretty-link'); ?>)</small></p>
    <p><strong><?php _e('Pretty Link Options', 'pretty-link'); ?></strong></p>
    <p>
      <label for="<?php echo $this->get_field_id('redirect_type'); ?>"><?php _e('Redirection:', 'pretty-link'); ?>
        <select id="<?php echo $this->get_field_id('redirect_type'); ?>" name="<?php echo $this->get_field_name('redirect_type'); ?>">
          <option value="-1"><?php _e('Default', 'pretty-link'); ?>&nbsp;</option>
          <option value="301"<?php echo (($redirect_type == '301')?$selected:''); ?>><?php _e('Permanent/301', 'pretty-link'); ?>&nbsp;</option>
          <option value="302"<?php echo (($redirect_type == '302')?$selected:''); ?>><?php _e('Temporary/302', 'pretty-link'); ?>&nbsp;</option>
          <option value="307"<?php echo (($redirect_type == '307')?$selected:''); ?>><?php _e('Temporary/307', 'pretty-link'); ?>&nbsp;</option>
          <option value="prettybar"<?php echo (($redirect_type == 'prettybar')?$selected:''); ?>><?php _e('PrettyBar', 'pretty-link'); ?>&nbsp;</option>
          <option value="cloak"<?php echo (($redirect_type == 'cloak')?$selected:''); ?>><?php _e('Cloak', 'pretty-link'); ?>&nbsp;</option>
        </select>
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('track'); ?>"><?php _e('Tracking Enabled:', 'pretty-link'); ?>
        <select id="<?php echo $this->get_field_id('track'); ?>" name="<?php echo $this->get_field_name('track'); ?>">
          <option value="-1"><?php _e('Default', 'pretty-link'); ?>&nbsp;</option>
          <option value="1"<?php echo (($track == '1')?$selected:''); ?>><?php _e('Yes', 'pretty-link'); ?>&nbsp;</option>
          <option value="0"<?php echo (($track == '0')?$selected:''); ?>><?php _e('No', 'pretty-link'); ?>&nbsp;</option>
        </select>
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('group'); ?>"><?php _e('Group:', 'pretty-link'); ?>
        <select id="<?php echo $this->get_field_id('group'); ?>" name="<?php echo $this->get_field_name('group'); ?>">
          <option value="-1"><?php _e('None', 'pretty-link'); ?>&nbsp;</option>
          <?php $groups = prli_get_all_groups(); ?>
          <?php foreach($groups as $g): ?>
          <option value="<?php echo $g['id']; ?>"<?php echo (($group == $g['id'])?$selected:''); ?>><?php echo $g['name']; ?>&nbsp;</option>
          <?php endforeach; ?>
        </select>
      </label>
    </p>
  <?php
  }
}


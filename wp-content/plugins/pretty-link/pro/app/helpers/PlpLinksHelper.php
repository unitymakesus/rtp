<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); }

class PlpLinksHelper {
  public static function rotation_weight_dropdown($rotation_weight, $select_name="url_rotation_weights[]") {
  ?>
    <select name="<?php echo $select_name; ?>">
    <?php for($p=0; $p<=100; $p+=5) { ?>
      <option value="<?php echo $p; ?>"<?php selected((int)$p, (int)$rotation_weight); ?>><?php echo $p; ?>%&nbsp;</option>
    <?php } ?>
    </select>
  <?php
  }

  public static function rotation_row($rotation, $weight, $select_name="url_rotations[]", $weight_select_name="url_rotation_weights[]") {
    ?>
    <li>
      <input type="text" class="regular-text" name="<?php echo $select_name; ?>" value="<?php echo $rotation; ?>" />
      <?php _e('weight:', 'pretty-link'); ?>
      <?php self::rotation_weight_dropdown($weight); ?>
    </li>
    <?php
  }

  public static function geo_row($geo_url='', $geo_countries='') {
    require(PLP_VIEWS_PATH.'/links/geo_row.php');
  }

  public static function tech_row($tech_url='', $tech_device='', $tech_os='', $tech_browser='') {
    require(PLP_VIEWS_PATH.'/links/tech_row.php');
  }

  public static function time_row($time_url='', $time_start='', $time_end='') {
    require(PLP_VIEWS_PATH.'/links/time_row.php');
  }
}


<?php 
/**
 *  UABB Fancy Text Module front-end JS php file
 *
 *  @package UABB Fancy Text Module
 */

if ( $settings->effect_type == 'type' ) { 
      $strings = $typeSpeed = $startDelay = $backSpeed = $backDelay = $loop = $loopCount = $showCursor = $cursorChar = '';
      // Order of replacement.
      $order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
      $replace = '|';
	  $str         = str_replace( $order, $replace, $settings->fancy_text );
	  $lines       = explode( '|', $str );
	  $count_lines = count( $lines );

	  $strings = '[';
	foreach ( $lines as $key => $line ) {
		$strings .= '"' . __( trim( htmlspecialchars_decode( strip_tags( $line ) ) ), 'uabb' ) . '"';
		if ( $key != ( $count_lines - 1 ) ) {
			$strings .= ',';
		}
	}
		$strings .= ']';
      $typeSpeed  = ( !empty($settings->typing_speed) ) ? $settings->typing_speed : 35;
      $startDelay = ( !empty($settings->start_delay) ) ? $settings->start_delay : 200;
      $backSpeed  = ( !empty($settings->back_speed) ) ? $settings->back_speed : 0;
      $backDelay  = ( !empty($settings->back_delay) ) ? $settings->back_delay : 1500;
      $loop       = ( $settings->enable_loop == 'no' ) ? 'false' : 'true';
      
      if( $settings->show_cursor == 'yes' ) {
        $showCursor = 'true';
        $cursorChar = ( !empty($settings->cursor_text) ) ? $settings->cursor_text : "|";
      }else{
        $showCursor = 'false';
      }
  ?>

  jQuery( document ).ready(function($) {
      new UABBFancyText({
        id:                 '<?php echo $id ?>',
        viewport_position:  90,
        animation:          '<?php echo $settings->effect_type; ?>',
        strings:            <?php echo $strings; ?>,
        typeSpeed:          <?php echo $typeSpeed; ?>,
        startDelay:         <?php echo $startDelay; ?>,
        backSpeed:          <?php echo $backSpeed; ?>,
        backDelay:          <?php echo $backDelay; ?>,
        loop:               <?php echo $loop; ?>,
        showCursor:         <?php echo $showCursor; ?>,
        cursorChar:         '<?php echo $cursorChar; ?>'
      });
  });

<?php }elseif ( $settings->effect_type == 'slide_up' ) {
      $speed = $pause = $mousePause = '';
      
      $speed = ( !empty($settings->animation_speed) ) ? $settings->animation_speed : 200; 
      $pause = ( !empty($settings->pause_time) ) ? $settings->pause_time : 3000;
      $mousePause = ( $settings->pause_hover == 'yes') ? true : false;
    ?>
    jQuery( document ).ready(function($) {
      var wrapper = $('.fl-node-<?php echo $id; ?>'),
          slide_block = wrapper.find('.uabb-slide-main'),
          slide_block_height = slide_block.find('.uabb-slide_text').height();
          slide_block.height(slide_block_height);

      var UABBFancy_<?php echo $id; ?> = new UABBFancyText({
        id:                 '<?php echo $id ?>',
        viewport_position:  90,
        animation:          '<?php echo $settings->effect_type; ?>',
        speed:              <?php echo $speed; ?>,
        pause:              <?php echo $pause; ?>,
        mousePause:         Boolean( '<?php echo $mousePause; ?>' ),
        suffix:             "<?php echo addslashes($settings->suffix); ?>",
        prefix:             "<?php echo addslashes($settings->prefix); ?>",
        alignment:          '<?php echo $settings->alignment; ?>',
      });

	  $( window ).resize(function() {
		  UABBFancy_<?php echo $id; ?>._initFancyText();
	  });
	});

	<?php

}
?>

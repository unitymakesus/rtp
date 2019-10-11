<?php
/**
 * UABB Content Toggle Module front-end file
 *
 *  @package UABB Content Toggle Module
 */

?>
<?php
$rbs_wrapper   = '';
$rbs_section_1 = '';
$rbs_section_2 = '';

if ( 'stack' === $settings->heading_layout ) {
	$rbs_wrapper = 'uabb-ct-desktop-stack--yes uabb-rbs-wrapper';
} else {
	$rbs_wrapper = 'uabb-ct-desktop-stack--no uabb-rbs-wrapper';
}

if ( 'stack' === $settings->heading_responsive_layout ) {
	$rbs_wrapper .= ' uabb-ct-responsive-stack--yes uabb-rbs-wrapper';
} elseif ( 'inline' === $settings->heading_responsive_layout ) {
	$rbs_wrapper .= ' uabb-ct-responsive-stack--no uabb-rbs-wrapper';
}

if ( 'content' === $settings->cont1_section ) {
	$rbs_section_1 = 'class="uabb-rbs-content-1"';
}

if ( 'content_head2' === $settings->cont2_section ) {
	$rbs_section_2 = 'class="uabb-rbs-content-2"';
}

$rbs_section_1 .= 'class="uabb-rbs-section-1"';
$rbs_section_2 .= 'class="uabb-rbs-section-2"';

if ( 'on' === $settings->default_display ) {
	$rbs_section_1 .= 'style="display:none;"';
} else {
	$rbs_section_2 .= 'style="display:none;"';
}

$label_off = ( isset( $settings->label_box_off ) ) ? $settings->label_box_off : 'OFF';
$label_on  = ( isset( $settings->label_box_on ) ) ? $settings->label_box_on : 'ON';

?>
<div class="<?php echo $rbs_wrapper; ?>">
	<div class="uabb-rbs-toggle">
		<div class="uabb-sec-1">
			<<?php echo $settings->html_tag; ?> class="uabb-rbs-head-1"><?php echo $settings->cont1_heading; ?>
			</<?php echo $settings->html_tag; ?>>
		</div>
		<div class="uabb-main-btn" data-switch-type="<?php echo $settings->select_switch_style; ?>">

			<?php

			$switch_html = '';
			$is_checked  = ( 'on' === $settings->default_display ) ? 'checked' : '';

			switch ( $settings->select_switch_style ) {
				case 'round1':
					$switch_html = '<label class="uabb-rbs-switch-label"><input type="checkbox" class="uabb-rbs-switch uabb-switch-round-1 uabb-clickable uabb-checkbox-clickable" ' . $is_checked . '><span class="uabb-rbs-slider uabb-rbs-round uabb-clickable switch1"></span></label>';
					break;

				case 'round2':
					$switch_html = '<div class="uabb-toggle"><input type="checkbox" class="uabb-switch-round-2 uabb-clickable uabb-checkbox-clickable" name="group1" id="toggle" ' . $is_checked . '><label for="toggle" class="uabb-clickable switch2"></label></div>';
					break;

				case 'rectangle':
					$switch_html = '<label class="uabb-rbs-switch-label"><input type="checkbox" class="uabb-rbs-switch uabb-switch-rectangle uabb-clickable uabb-checkbox-clickable" ' . $is_checked . '><span class="uabb-rbs-slider uabb-rbs-rect uabb-clickable switch3"></span></label>';
					break;

				case 'label_box':
					$switch_html = '<div class="uabb-label-box uabb-clickable"><input type="checkbox" name="uabb-label-box" class="uabb-label-box-checkbox uabb-switch-label-box uabb-clickable uabb-checkbox-clickable" ' . $is_checked . ' id="myonoffswitch"><label for="myonoffswitch" class="uabb-label-box-label switch4"><span class="uabb-label-box-inner"><span class="uabb-label-box-inactive"><span class="uabb-label-box-switch">' . $label_off . '</span></span><span class="uabb-label-box-active"><span class="uabb-label-box-switch">' . $label_on . '</span></span></span></label></div>';
					break;

				default:
					break;
			}
			?>

			<!-- Display Switch -->
			<?php echo $switch_html; ?>

		</div>
		<div class="uabb-sec-2">
			<<?php echo $settings->html_tag; ?> class="uabb-rbs-head-2"><?php echo $settings->cont2_heading; ?></<?php echo $settings->html_tag; ?>>
		</div>
	</div>
	<div class="uabb-rbs-toggle-sections">
		<div <?php echo $rbs_section_1; ?> >
			<?php
			if ( 'content' == $settings->cont1_section ) {
				global $wp_embed;
				echo wpautop( $wp_embed->autoembed( $settings->content_editor ) );
			} else {
				echo $module->get_toggle_content1( $settings );
			}
			?>

		</div>
		<div <?php echo $rbs_section_2; ?> >
			<?php
			if ( 'content_head2' == $settings->cont2_section ) {
				global $wp_embed;
				echo wpautop( $wp_embed->autoembed( $settings->content2_editor ) );
			} else {
				echo $module->get_toggle_content2( $settings );
			}
			?>
		</div>
	</div>
</div>

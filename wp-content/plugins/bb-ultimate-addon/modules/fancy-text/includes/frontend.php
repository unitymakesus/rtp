<?php
/**
 *  UABB Fancy Text Module front-end file
 *
 *  @package UABB Fancy Text Module
 */

$class = 'uabb-fancy-heading';

	$class .= ' uabb-fancy-text-' . $settings->effect_type;
if ( in_array( $settings->effect_type, array( 'swirl', 'blinds', 'wave' ) ) ) { // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
	$class .= ' uabb-fancy-letters';
}

?>

<div class="uabb-module-content uabb-fancy-text-node">
<?php if ( ! empty( $settings->effect_type ) ) { ?>
	<?php echo '<' . esc_attr( $settings->text_tag_selection ); ?> class="uabb-fancy-text-wrap <?php echo esc_attr( $class ); ?>"><!--
	--><span class="uabb-fancy-plain-text uabb-fancy-text-wrapper uabb-fancy-text-prefix"><?php echo $settings->prefix; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo '<!--'; ?>
	<?php
		$output = '';

	if ( 'type' === $settings->effect_type ) {
		$output      = '';
		$output     .= '--><span class="uabb-fancy-text-main uabb-typed-main-wrap">';
			$output .= '<span class="uabb-typed-main">';
			$output .= '</span>';
		$output     .= '</span><!--';
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} elseif ( 'slide_up' === $settings->effect_type ) {
		$adjust_class = '';
		$slide_order  = array( "\r\n", "\n", "\r", '<br/>', '<br>' );
		$replace      = '|';
		$str          = str_replace( $slide_order, $replace, trim( $settings->fancy_text ) );
		$lines        = explode( '|', $str );
		$count_lines  = count( $lines );
		$output       = '';

		$output     .= '--><span class="uabb-fancy-text-main  uabb-slide-main' . $adjust_class . '">';
			$output .= '<span class="uabb-slide-main_ul">';
		foreach ( $lines as $key => $line ) {
			$output .= '<span class="uabb-slide-block">';
			$output .= '<span class="uabb-slide_text">' . wp_strip_all_tags( $line ) . '</span>';
			$output .= '</span>';
			if ( 1 === $count_lines ) {
							$output .= '<span class="uabb-slide-block">';
							$output .= '<span class="uabb-slide_text">' . wp_strip_all_tags( $line ) . '</span>';
							$output .= '</span>';
			}
		}
			$output .= '</span>';
			$output .= '</span><!--';
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		$output .= '--><span class="uabb-fancy-text-dynamic-wrapper uabb-fancy-text-wrapper">';
		$output .= '</span><!--';
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	?>

	<?php echo '-->'; ?><span class=" uabb-fancy-plain-text uabb-fancy-text-wrapper uabb-fancy-text-suffix"><?php echo $settings->suffix; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php echo '</' . esc_attr( $settings->text_tag_selection ) . '>'; ?>
<?php } ?>
</div>

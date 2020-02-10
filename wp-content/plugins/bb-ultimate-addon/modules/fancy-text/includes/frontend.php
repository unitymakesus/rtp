<?php
/**
 *  UABB Fancy Text Module front-end file
 *
 *  @package UABB Fancy Text Module
 */

?>

<div class="uabb-module-content uabb-fancy-text-node">
<?php if ( ! empty( $settings->effect_type ) ) { ?>
	<?php echo '<' . esc_attr( $settings->text_tag_selection ); ?> class="uabb-fancy-text-wrap uabb-fancy-text-<?php echo esc_attr( $settings->effect_type ); ?>"><!--
	--><span class="uabb-fancy-text-prefix"><?php echo wp_kses_post( $settings->prefix ); ?></span><?php echo '<!--'; ?>
	<?php
		$output = '';

	if ( 'type' === $settings->effect_type ) {
		$output      = '';
		$output     .= '--><span class="uabb-fancy-text-main uabb-typed-main-wrap">';
			$output .= '<span class="uabb-typed-main">';
			$output .= '</span>';
		$output     .= '</span><!--';
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	if ( 'slide_up' === $settings->effect_type ) {
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
	}
	?>

	<?php echo '-->'; ?><span class="uabb-fancy-text-suffix"><?php echo wp_kses_post( $settings->suffix ); ?></span>
	<?php echo '</' . esc_attr( $settings->text_tag_selection ) . '>'; ?>
<?php } ?>
</div>

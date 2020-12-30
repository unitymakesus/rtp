<?php
/**
 *  UABB Button Module front-end file
 *
 *  @package UABB Button Module
 */

$theme_button = '';
if ( 'default' === $settings->style ) {
	$theme_button = 'ast-button';
}
?>

<div class="uabb-module-content <?php echo wp_kses_post( $module->get_classname() ); ?>">
	<?php
	if ( isset( $settings->threed_button_options ) && ( 'animate_top' === $settings->threed_button_options || 'animate_bottom' === $settings->threed_button_options || 'animate_left' === $settings->threed_button_options || 'animate_right' === $settings->threed_button_options ) ) {
		?>
		<p class="perspective">
		<?php
	}
	$nofollow = ( isset( $settings->link_nofollow ) ) ? $settings->link_nofollow : '0';
	?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo esc_attr( $settings->link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->link_target, $nofollow, 1 ); ?> class="uabb-button <?php echo esc_attr( $theme_button ); ?> uabb-creative-button <?php echo 'uabb-creative-' . esc_attr( $settings->style ) . '-btn'; ?> <?php echo wp_kses_post( $module->get_button_style() ); ?> <?php echo ( isset( $settings->a_class ) ) ? esc_attr( $settings->a_class ) : ''; ?> <?php echo esc_attr( $settings->custom_class ); ?>" <?php echo ( isset( $settings->a_data ) ) ? $settings->a_data : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> role="button">
			<?php
			if ( isset( $settings->icon_type ) && 'photo' === $settings->icon_type ) {

				$src = isset( $settings->photo_src ) ? $settings->photo_src : '';
				if ( ! empty( $settings->photo ) && ( 'before' === $settings->icon_position || ! isset( $settings->icon_position ) ) ) :
					?>
					<img class="uabb-btn-img uabb-button-icon-before uabb-creative-button-icon-before" src="<?php echo esc_url( $src ); ?>"/>
				<?php endif; ?>
				<span class="uabb-button-text uabb-creative-button-text"><?php echo $settings->text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>

				<?php
				if ( ! empty( $settings->photo ) && 'after' === $settings->icon_position ) :
					?>
					<img class="uabb-btn-img uabb-button-icon-before uabb-creative-button-icon-before" src="<?php echo esc_url( $src ); ?>"/>
					<?php
				endif;
			} else {

				if ( ! empty( $settings->icon ) && ( 'before' === $settings->icon_position || ! isset( $settings->icon_position ) ) && ( isset( $settings->icon_type ) && 'icon' === $settings->icon_type ) ) :

					if ( 'flat' === $settings->style && isset( $settings->flat_button_options ) && ( 'animate_to_right' === $settings->flat_button_options || 'animate_to_left' === $settings->flat_button_options || 'animate_from_top' === $settings->flat_button_options || 'animate_from_bottom' === $settings->flat_button_options ) ) {
						$add_class_to_icon = '';
					} else {
							$add_class_to_icon = 'uabb-button-icon-before uabb-creative-button-icon-before';
					}
					?>
					<i class="uabb-button-icon uabb-creative-button-icon <?php echo esc_attr( $add_class_to_icon ); ?> <?php echo esc_attr( $settings->icon ); ?>"></i>
							<?php endif; ?>
				<span class="uabb-button-text uabb-creative-button-text"><?php echo $settings->text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<?php
							if ( ! empty( $settings->icon ) && 'after' === $settings->icon_position && ( isset( $settings->icon_type ) && 'icon' === $settings->icon_type ) ) :

								if ( 'flat' === $settings->style && isset( $settings->flat_button_options ) && ( 'animate_to_right' === $settings->flat_button_options || 'animate_to_left' === $settings->flat_button_options || 'animate_from_top' === $settings->flat_button_options || 'animate_from_bottom' === $settings->flat_button_options ) ) {
									$add_class_to_icon = '';
								} else {
									$add_class_to_icon = 'uabb-button-icon-after uabb-creative-button-icon-after';
								}
								?>
					<i class="uabb-button-icon uabb-creative-button-icon <?php echo esc_attr( $add_class_to_icon ); ?> <?php echo esc_attr( $settings->icon ); ?>"></i>
							<?php endif; ?>

						<?php } ?>

		</a>
	<?php
	if ( isset( $settings->threed_button_options ) && ( 'animate_top' === $settings->threed_button_options || 'animate_bottom' === $settings->threed_button_options || 'animate_left' === $settings->threed_button_options || 'animate_right' === $settings->threed_button_options ) ) {
		?>
		</p>
		<?php
	}
	?>
</div>





<?php
/**
 *  UABB Heading Module front-end file
 *
 *  @package UABB Dual Button Module
 */

$btn_style_class = '';
$theme_button    = '';

if ( 'transparent' === $settings->dual_button_style ) {
	$btn_style_class = ' uabb-' . $settings->transparent_button_options;
} elseif ( 'gradient' === $settings->dual_button_style ) {
	$btn_style_class = ' uabb-gradient';
} elseif ( 'flat' === $settings->dual_button_style ) {
	$btn_style_class = ' uabb-' . $settings->flat_button_options;
}
if ( 'default' === $settings->dual_button_style ) {
	$theme_button = 'ast-button';
}

?>
<div class="uabb-module-content uabb-dual-button <?php echo 'uabb-align-' . esc_attr( $settings->dual_button_align ); ?>">
	<div class="uabb-dual-button-wrapper <?php echo 'uabb-' . esc_attr( $settings->dual_button_type ); ?> <?php echo 'uabb-' . esc_attr( $settings->dual_button_type ) . '-' . esc_attr( $settings->dual_button_width_type ); ?>">
		<div class="uabb-dual-button-one <?php echo 'uabb-btn-' . esc_attr( $settings->dual_button_type ); ?> <?php echo esc_attr( $settings->button_one_class ); ?>">
			<a class="uabb-btn uabb-btn-one<?php echo esc_attr( $btn_style_class ); ?>" href="<?php echo $settings->button_one_link; ?>" target="<?php echo esc_attr( $settings->button_one_link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->button_one_link_target, $settings->button_one_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php if ( 'before' === $settings->icon_position_btn_one && 'none' !== $settings->image_type_btn_one ) { ?>
				<div class="uabb-btn-img-icon before uabb-btn-one-img-icon">
					<?php
					$btn_one_img_icon = array(
						'image_type'   => $settings->image_type_btn_one,
						'icon'         => $settings->icon_btn_one,
						'icon_size'    => '',
						'photo_source' => 'library',
						'photo'        => $settings->photo_btn_one,
						'photo_url'    => '',
						'img_size'     => '',
						'photo_src'    => isset( $settings->photo_btn_one_src ) ? $settings->photo_btn_one_src : '',
					);
					$module->render_own_imgicon( $btn_one_img_icon );
					?>
				</div>
				<?php } ?>
				<span class="uabb-btn-one-text"><?php echo $settings->button_one_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php if ( 'after' === $settings->icon_position_btn_one && 'none' !== $settings->image_type_btn_one ) { ?>
				<div class="uabb-btn-img-icon after uabb-btn-one-img-icon">
					<?php
					$btn_one_img_icon = array(
						'image_type'   => $settings->image_type_btn_one,
						'icon'         => $settings->icon_btn_one,
						'icon_size'    => '',
						'photo_source' => 'library',
						'photo'        => $settings->photo_btn_one,
						'photo_url'    => '',
						'img_size'     => '',
						'photo_src'    => isset( $settings->photo_btn_one_src ) ? $settings->photo_btn_one_src : '',
					);
					$module->render_own_imgicon( $btn_one_img_icon );
					?>
				</div>
				<?php } ?>
			</a>
			<?php
			if ( ! ( 'horizontal' === $settings->dual_button_type && 'no' === $settings->join_buttons ) ) {
				if ( 'none' !== $settings->divider_options ) {
					?>
				<span class="uabb-middle-text">
					<?php
					if ( 'text' === $settings->divider_options ) {
						echo $settings->divider_text; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					if ( 'icon' === $settings->divider_options || 'photo' === $settings->divider_options ) {
						$divider_img_icon = array(
							'image_type'   => $settings->divider_options,
							'icon'         => $settings->divider_icon,
							'icon_size'    => '',
							'photo_source' => 'library',
							'photo'        => $settings->divider_photo,
							'photo_url'    => '',
							'img_size'     => '',
							'photo_src'    => isset( $settings->divider_photo_src ) ? $settings->divider_photo_src : '',
						);
						$module->render_image_icon( $divider_img_icon );
					}
					?>
				</span>
					<?php
				}
			}
			?>
		</div>
		<div class="uabb-dual-button-two <?php echo 'uabb-btn-' . esc_attr( $settings->dual_button_type ); ?> <?php echo esc_attr( $settings->button_two_class ); ?>">
			<a class="uabb-btn uabb-btn-two<?php echo esc_attr( $btn_style_class ); ?>" href="<?php echo $settings->button_two_link; ?>" target="<?php echo esc_attr( $settings->button_two_link_target ); ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->button_two_link_target, $settings->button_two_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php if ( 'before' === $settings->icon_position_btn_two && 'none' !== $settings->image_type_btn_two ) { ?>
				<div class="uabb-btn-img-icon before uabb-btn-two-img-icon">
					<?php
					$btn_two_img_icon = array(
						'image_type'   => $settings->image_type_btn_two,
						'icon'         => $settings->icon_btn_two,
						'icon_size'    => '',
						'photo_source' => 'library',
						'photo'        => $settings->photo_btn_two,
						'photo_url'    => '',
						'img_size'     => '',
						'photo_src'    => isset( $settings->photo_btn_two_src ) ? $settings->photo_btn_two_src : '',
					);
					$module->render_own_imgicon( $btn_two_img_icon );
					?>
				</div>
				<?php } ?>
				<span class="uabb-btn-two-text"><?php echo $settings->button_two_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php if ( 'after' === $settings->icon_position_btn_two && 'none' !== $settings->image_type_btn_two ) { ?>
				<div class="uabb-btn-img-icon after uabb-btn-two-img-icon">
					<?php
					$btn_two_img_icon = array(
						'image_type'   => $settings->image_type_btn_two,
						'icon'         => $settings->icon_btn_two,
						'icon_size'    => '',
						'photo_source' => 'library',
						'photo'        => $settings->photo_btn_two,
						'photo_url'    => '',
						'img_size'     => '',
						'photo_src'    => isset( $settings->photo_btn_two_src ) ? $settings->photo_btn_two_src : '',
					);
					$module->render_own_imgicon( $btn_two_img_icon );
					?>
				</div>
				<?php } ?>
			</a>
		</div>
	</div>
</div>

<?php
/**
 *  UABB iHover Module front-end file
 *
 *  @package UABB iHover Module
 */

$align = '';
if ( ! UABB_Compatibility::check_bb_version() ) {
	if ( isset( $settings->align ) ) {
		$align = $settings->align;
	}
} else {
	if ( isset( $settings->align_param ) ) {
		$align = $settings->align_param;
	}
}
?>
<?php $height_width = ( 'custom' == $settings->height_width_options ) ? $settings->height_width : '250'; ?>
<div class="uabb-module-content uabb-ih-container">
	<ul data-height="<?php echo $height_width; ?>" data-width="<?php echo $height_width; ?>" data-shape="<?php echo $settings->shape; ?>" class="uabb-ih-list uabb-align-<?php echo $align; ?>">
								<?php
								if ( count( $settings->ihover_item ) > 0 ) {
									for ( $i = 0; $i < count( $settings->ihover_item ); $i++ ) {
										if ( is_object( $settings->ihover_item[ $i ] ) ) {
											$advanced_effect  = '';
											$hidden_box_class = '';
											switch ( $settings->ihover_item[ $i ]->effect ) {
												case 'effect6':
													$advanced_effect = $settings->ihover_item[ $i ]->advanced_effect2;
													break;

												case 'effect10':
													$advanced_effect = $settings->ihover_item[ $i ]->advanced_effect3;
													break;

												case 'effect16':
													$advanced_effect = $settings->ihover_item[ $i ]->advanced_effect4;
													break;

												case 'effect1':
												case 'effect5':
												case 'effect15':
												case 'effect17':
												case 'effect19':
													$advanced_effect = 'top_to_bottom';
													break;

												case 'effect2':
												case 'effect3':
												case 'effect4':
												case 'effect7':
													$advanced_effect  = $settings->ihover_item[ $i ]->advanced_effect1;
													$hidden_box_class = 'uabb-hidden-box';
													break;

												default:
													$advanced_effect = $settings->ihover_item[ $i ]->advanced_effect1;
													break;
											}

											?>
		<li class="uabb-ih-list-item uabb-ih-item-<?php echo $i; ?>">
											<?php
											if ( 'link' == $settings->ihover_item[ $i ]->on_click ) {
												?>
			<a target="<?php echo $settings->ihover_item[ $i ]->link_target; ?>" <?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->ihover_item[ $i ]->link_target, 0, 1 ); ?> href="<?php echo $settings->ihover_item[ $i ]->link_url; ?>" class="uabb-ih-link">
												<?php
											}
											?>
			<div class="uabb-ih-item uabb-ih-<?php echo $settings->ihover_item[ $i ]->effect; ?> uabb-ih-<?php echo $advanced_effect; ?>  uabb-ih-<?php echo $settings->shape; ?>" >
				<div class="uabb-ih-image-block">
					<div class="uabb-ih-wrapper"></div>
											<?php echo $module->render_image( $i ); ?>
				</div>
											<?php echo ( 'effect8' == $settings->ihover_item[ $i ]->effect ) ? '<div class="uabb-info-container">' : ''; ?>
				<div class="uabb-ih-info <?php echo $hidden_box_class; ?>">
					<div class="uabb-ih-info-back">
						<div class="uabb-ih-content">
							<div style="" class="uabb-ih-heading-block">
											<?php
											if ( '' != $settings->ihover_item[ $i ]->title ) {
												?>
								<<?php echo $settings->title_typography_tag_selection; ?> class="uabb-ih-heading"><?php echo $settings->ihover_item[ $i ]->title; ?></<?php echo $settings->title_typography_tag_selection; ?>>
												<?php
											}
											?>
							</div>
							<div class="uabb-ih-divider-block">
								<span class="uabb-ih-line"></span>
							</div>
							<div class="uabb-ih-description-block">
								<div class="uabb-ih-description uabb-text-editor"><?php echo $settings->ihover_item[ $i ]->description; ?></div>
							</div>
						</div>
					</div>
				</div>
											<?php echo ( 'effect8' == $settings->ihover_item[ $i ]->effect ) ? '</div>' : ''; ?>
			</div>
											<?php
											if ( 'link' == $settings->ihover_item[ $i ]->on_click ) {
												?>
			</a>
												<?php
											}
											?>
		</li>
											<?php
										}
									}
								}
								?>
		</ul>
</div>

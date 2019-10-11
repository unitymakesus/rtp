<?php
/**
 * Render the frontend contend.
 *
 * @package UABB Advanced Testimonials Module
 */

if ( 'slider' == $settings->tetimonial_layout ) {

	$settings->testimonial_icon_image_size          = ( '' != $settings->testimonial_icon_image_size ) ? $settings->testimonial_icon_image_size : '75';
	$settings->testimonial_icon_image_size_noslider = ( '' != $settings->testimonial_icon_image_size_noslider ) ? $settings->testimonial_icon_image_size_noslider : '75';

	$testimonials_class = 'uabb-testimonials-wrap ' . $settings->navigation;
	?>
	<div class="uabb-module-content <?php echo $testimonials_class; ?>">
		<div class="uabb-testimonials uabb-testimonial-<?php echo $settings->testimonial_image_position; ?>">
			<?php
			$testimonial_list_counter = 0;
			foreach ( $settings->testimonials as $testimonial_item ) {
				?>
				<div class="uabb-testimonial uabb-testimonial<?php echo $testimonial_list_counter; ?>">
					<?php
					if ( 'none' != $testimonial_item->image_type && ( ( isset( $testimonial_item->photo_src ) && '' != $testimonial_item->photo_src ) || ( isset( $testimonial_item->photo_url ) && '' != $testimonial_item->photo_url ) || ( isset( $testimonial_item->icon ) && '' != $testimonial_item->icon ) ) ) {
						?>
					<div class="uabb-testimonial-photo uabb-testimonial-<?php echo $settings->testimonial_image_position; ?> testimonial-photo<?php echo $id; ?> <?php echo $settings->testimonial_icon_style; ?>">
						<?php
						$imageicon_array = array(

							/* General Section */
							'image_type'            => $testimonial_item->image_type,

							/* Icon Basics */
							'icon'                  => $testimonial_item->icon,
							'icon_size'             => $settings->testimonial_icon_image_size,
							'icon_align'            => 'center',

							/* Image Basics */
							'photo_source'          => $testimonial_item->photo_source,
							'photo'                 => $testimonial_item->photo,
							'photo_url'             => $testimonial_item->photo_url,
							'img_size'              => $settings->testimonial_icon_image_size,
							'img_align'             => 'center',
							'photo_src'             => ( isset( $testimonial_item->photo_src ) ) ? $testimonial_item->photo_src : '',

							/* Icon Style */
							'icon_style'            => $settings->testimonial_icon_style,
							'icon_bg_size'          => $settings->testimonial_icon_bg_size,
							'icon_border_style'     => 'none',
							'icon_border_width'     => '',
							'icon_bg_border_radius' => $settings->testimonial_icon_bg_border_radius,

							/* Image Style */
							'image_style'           => $settings->testimonial_icon_style,
							'img_bg_size'           => $settings->testimonial_icon_bg_size,
							'img_border_style'      => 'none',
							'img_border_width'      => '',
							'img_bg_border_radius'  => $settings->testimonial_icon_bg_border_radius,
						);
						/* Render HTML Function */
						FLBuilder::render_module_html( 'image-icon', $imageicon_array );
						?>
					</div>
					<?php } ?>

					<div class="uabb-testimonial-info uabb-testimonial-<?php echo $settings->testimonial_image_position; ?> testimonial-info<?php echo $id; ?>" style="
																				<?php
																				if ( 'none' == $testimonial_item->image_type ) {
																					echo 'display:block;';
																				}
																				?>
					">
						<?php
						if ( 'top' == $settings->author_name_position ) {
							?>
							<div class="uabb-testimonial-author testimonial-author<?php echo $id; ?>">
								<?php
								if ( '' != $testimonial_item->testimonial_author ) {
									echo '<' . $settings->testimonial_heading_tag_selection . " class='uabb-testimonial-author-name testimonial-author-name" . $id . "'>";
									echo $testimonial_item->testimonial_author;
									echo '</' . $settings->testimonial_heading_tag_selection . '>';
								}
								if ( isset( $settings->enable_rating ) && 'yes' == $settings->enable_rating ) {
									$module->render_ratings( $testimonial_item->slider_rating );
								}
								?>
								<div class="uabb-testimonial-author-designation testimonial-author-designation<?php echo $id; ?>">
									<?php
									if ( '' != $testimonial_item->testimonial_designation ) {
										echo $testimonial_item->testimonial_designation;
									}
									?>
								</div>
							</div>
							<?php
						}
						?>

						<div class="uabb-testimonial-author-description uabb-text-editor testimonial-author-description<?php echo $id; ?>">
							<?php
							if ( '' != $testimonial_item->testimonial ) {
								if ( strpos( $testimonial_item->testimonial, '</p>' ) > 0 ) {
									echo $testimonial_item->testimonial;
								} else {
									echo '<p>' . $testimonial_item->testimonial . '</p>';
								}
							}
							?>
						</div>
						<?php
						if ( 'bottom' == $settings->author_name_position ) {
							?>
							<div class="uabb-testimonial-author testimonial-author<?php echo $id; ?>">
								<?php
								if ( '' != $testimonial_item->testimonial_author ) {
									echo '<' . $settings->testimonial_heading_tag_selection . " class='uabb-testimonial-author-name testimonial-author-name" . $id . "'>";
									echo $testimonial_item->testimonial_author;
									echo '</' . $settings->testimonial_heading_tag_selection . '>';
								}
								if ( isset( $settings->enable_rating ) && 'yes' == $settings->enable_rating ) {
									$module->render_ratings( $testimonial_item->slider_rating );
								}
								?>
								<div class="uabb-testimonial-author-designation testimonial-author-designation<?php echo $id; ?>">
									<?php
									if ( '' != $testimonial_item->testimonial_designation ) {
										echo $testimonial_item->testimonial_designation;
									}
									?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<?php
				$testimonial_list_counter = $testimonial_list_counter + 1;
			}
			?>
		</div>
		<div class="uabb-slider-prev"></div>
		<div class="uabb-slider-next"></div>
	</div>
	<?php
}

if ( 'slider-no' == $settings->tetimonial_layout || 'box' == $settings->tetimonial_layout ) {
	if ( 'box' == $settings->tetimonial_layout && 'no' == $settings->test_box_style ) {
		$settings->tetimonial_layout = 'slider-no';
	}
	if ( isset( $settings->icon_position_half_box ) && 'yes' == $settings->icon_position_half_box && 'top' == $settings->testimonial_image_position ) {
		$settings->testimonial_image_position = 'top';
		$uabb_half_box                        = ' uabb_half_top';
	} else {
		$uabb_half_box = '';
	}
	?>
		<div class="uabb-module-content uabb-testimonials <?php echo $settings->tetimonial_layout . ' uabb-testimonial-' . $settings->testimonial_image_position . $uabb_half_box; ?>">
			<div class="uabb-testimonial<?php echo $uabb_half_box; ?>">
				<?php
				if ( 'none' != $settings->image_type_noslider && ( ( isset( $settings->photo_noslider_src ) && '' != $settings->photo_noslider_src ) || ( isset( $settings->photo_url_noslider ) && '' != $settings->photo_url_noslider ) || ( isset( $settings->icon_noslider ) && '' != $settings->icon_noslider ) ) ) {
					?>
				<div class="uabb-testimonial-photo uabb-testimonial-<?php echo $settings->testimonial_image_position; ?> testimonial-photo<?php echo $id; ?> <?php echo $settings->testimonial_icon_style; ?><?php echo $uabb_half_box; ?>">
					<?php
					$imageicon_array = array(
						/* General Section */
						'image_type'            => $settings->image_type_noslider,

						/* Icon Basics */
						'icon'                  => $settings->icon_noslider,
						'icon_size'             => $settings->testimonial_icon_image_size_noslider,
						'icon_align'            => 'center',

						/* Image Basics */
						'photo_source'          => $settings->photo_source_noslider,
						'photo'                 => $settings->photo_noslider,
						'photo_url'             => $settings->photo_url_noslider,
						'img_size'              => $settings->testimonial_icon_image_size_noslider,
						'img_align'             => 'center',
						'photo_src'             => ( isset( $settings->photo_noslider_src ) ) ? $settings->photo_noslider_src : '',

						/* Icon Style */
						'icon_style'            => $settings->testimonial_icon_style_noslider,
						'icon_bg_size'          => $settings->testimonial_icon_bg_size,
						'icon_border_style'     => 'none',
						'icon_border_width'     => '',
						'icon_bg_border_radius' => $settings->testimonial_icon_bg_border_radius_noslider,

						/* Image Style */
						'image_style'           => $settings->testimonial_icon_style_noslider,
						'img_bg_size'           => $settings->testimonial_icon_bg_size,
						'img_border_style'      => 'none',
						'img_border_width'      => '',
						'img_bg_border_radius'  => $settings->testimonial_icon_bg_border_radius_noslider,
					);
					/* Render HTML Function */
					FLBuilder::render_module_html( 'image-icon', $imageicon_array );
					?>
				</div>
				<?php } ?>
				<div class="uabb-testimonial-info uabb-testimonial-<?php echo $settings->testimonial_image_position; ?> testimonial-info<?php echo $id; ?><?php echo $uabb_half_box; ?>">
					<?php
					if ( 'top' == $settings->author_name_position ) {
						?>
						<div class="uabb-testimonial-author testimonial-author<?php echo $id; ?>">
							<?php
							if ( '' != $settings->testimonial_author_no_slider ) {
								echo '<' . $settings->testimonial_heading_tag_selection . " class='uabb-testimonial-author-name testimonial-author-name" . $id . "'>";
								echo $settings->testimonial_author_no_slider;
								echo '</' . $settings->testimonial_heading_tag_selection . '>';
							}
							if ( isset( $settings->enable_rating ) && 'yes' == $settings->enable_rating ) {
								$module->render_ratings( $settings->box_rating );
							}
							?>
							<div class="uabb-testimonial-author-designation testimonial-author-designation<?php echo $id; ?>">
								<?php
								if ( '' != $settings->testimonial_designation_no_slider ) {
									echo $settings->testimonial_designation_no_slider;
								}
								?>
							</div>
						</div>
						<?php
					}
					?>

					<div class="uabb-testimonial-author-description uabb-text-editor testimonial-author-description<?php echo $id; ?>">
						<?php
						if ( '' != $settings->testimonial_description ) {
							echo $settings->testimonial_description;
						}
						?>
					</div>
					<?php
					if ( 'bottom' == $settings->author_name_position ) {
						?>
						<div class="uabb-testimonial-author testimonial-author<?php echo $id; ?>">
							<?php
							if ( '' != $settings->testimonial_author_no_slider ) {
								echo '<' . $settings->testimonial_heading_tag_selection . " class='uabb-testimonial-author-name testimonial-author-name" . $id . "'>";
								echo $settings->testimonial_author_no_slider;
								echo '</' . $settings->testimonial_heading_tag_selection . '>';
							}
							if ( isset( $settings->enable_rating ) && 'yes' == $settings->enable_rating ) {
									$module->render_ratings( $settings->box_rating );
							}
							?>
							<div class="uabb-testimonial-author-designation testimonial-author-designation<?php echo $id; ?>">
								<?php
								if ( '' != $settings->testimonial_designation_no_slider ) {
									echo $settings->testimonial_designation_no_slider;
								}
								?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
			if ( 'box' == $settings->tetimonial_layout ) {
				?>
				<div class="testimonial-arrow-down arrow-down-elemet<?php echo $id; ?>"></div>
				<?php
			}
			?>
		</div>
	<?php
}
?>

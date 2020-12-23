<?php
/**
 *  UABB How To Module front-end file.
 *
 *  @package UABB How To Module.
 */

global $wp_embed;

$image_data            = FLBuilderPhoto::get_attachment_data( $settings->image );
$image_alt             = isset( $image_data->alt ) ? $image_data->alt : '';
$image_title           = isset( $image_data->title ) ? $image_data->title : '';
$supply_container      = array();
$tool_container        = array();
$steps_container       = array();
$steps_container_wrap  = array();
$supply_container_wrap = array();
$tool_container_wrap   = array();
$empty_items_array     = array();

if ( isset( $settings->uabb_supply ) && is_array( $settings->uabb_supply ) ) {

	foreach ( $settings->uabb_supply as $supply ) {

		$supply_container = array(

			'@type' => 'HowToSupply',
			'name'  => $supply,
		);
		array_push( $supply_container_wrap, $supply_container );
	}
}
if ( isset( $settings->uabb_tool ) && is_array( $settings->uabb_tool ) ) {

	foreach ( $settings->uabb_tool as $tool ) {

		$tool_container = array(

			'@type' => 'HowToTool',
			'name'  => $tool,
		);
		array_push( $tool_container_wrap, $tool_container );
	}
}
if ( isset( $settings->step_data ) && is_array( $settings->step_data ) ) {
	foreach ( $settings->step_data as $step ) {
		$steps_container = array(
			'@type' => 'HowToStep',
			'url'   => ! empty( $step->step_link ) ? $step->step_link : get_permalink(),
			'name'  => $step->step_title,
			'text'  => $step->step_description,
			'image' => $step->step_image_src,

		);
		array_push( $steps_container_wrap, $steps_container );

	}
}
if ( ! empty( $supply_container ) && is_array( $supply_container ) ) {

	$supply = wp_json_encode( $supply_container_wrap );
}
if ( ! empty( $tool_container ) && is_array( $tool_container ) ) {

	$tool = wp_json_encode( $tool_container_wrap );
}
if ( ! empty( $steps_container_wrap ) && is_array( $steps_container_wrap ) ) {

	$steps = wp_json_encode( $steps_container_wrap );
}

/* Conditions to Display Error Message. */
if ( empty( $settings->description ) ) {
	array_push( $empty_items_array, 'Description' );
}
if ( empty( $settings->image_src ) ) {
	array_push( $empty_items_array, 'Image' );
}
if ( empty( $settings->total_time ) ) {
	array_push( $empty_items_array, 'Total time' );
}
if ( empty( $settings->estimated_cost ) ) {
	array_push( $empty_items_array, 'Estimated cost' );
}
if ( empty( $settings->currency_iso_code ) ) {
	array_push( $empty_items_array, 'Country ISO code' );
}
if ( empty( $settings->uabb_supply[0] ) || 'no' === $settings->show_advanced || 'no' === $settings->add_supply ) {
	array_push( $empty_items_array, 'Supply' );
}
if ( empty( $settings->uabb_tool[0] ) || 'no' === $settings->show_advanced || 'no' === $settings->add_tool ) {
	array_push( $empty_items_array, 'Tools' );
}
?>		
		<div class="uabb-how-to-error-notices-wrap">
			<?php if ( FLBuilderModel::is_builder_active() && isset( $empty_items_array ) && ! empty( $empty_items_array ) && is_array( $empty_items_array ) ) { ?>

				<div class="uabb-how-to-error-notices-container">
					<?php

						$error_string = '';

					if ( isset( $empty_items_array ) && is_array( $empty_items_array ) ) {

						foreach ( $empty_items_array as $item ) {

							$error_string = $error_string . $item . ', ';
						}
					}

						$error_string = rtrim( $error_string, ', ' );

						echo 'It seems the<b> ' . esc_attr( $error_string ) . '</b> fields are empty.<br>It may generate Schema errors / warnings for your Page, we recommend you to fill those fields.';

					?>
				</div>
			<?php } ?>
			<?php if ( FLBuilderModel::is_builder_active() && isset( $settings->step_data ) && count( $settings->step_data ) < 2 ) { ?>

				<div class="uabb-how-to-error-notices-container">
					<?php echo 'It seems there are <b>less than 2 steps entered</b>.<br>It may generate Schema errors / warnings for your Page, we recommend you to add at least 2 Steps.'; ?>
				</div>
			<?php } ?>
		</div>
		<div class="uabb-how-to-wrap uabb-clearfix">
			<script type="application/ld+json">
					{
					"@context": "http://schema.org",
					"@type": "HowTo",
					"name": "<?php echo ! empty( $settings->uabb_how_to_title ) ? wp_kses_post( $settings->uabb_how_to_title ) : ''; ?>",
					"description": "<?php echo ! empty( $settings->description ) ? wp_kses_post( $settings->description ) : ''; ?>",
					<?php if ( ! empty( $settings->image_src ) ) { ?>
						"image": {
								"@type": "ImageObject",
								"url": "<?php echo ! empty( $settings->image_src ) ? esc_url( $settings->image_src ) : ''; ?>",
								"height": "406",
								"width": "305"
							},
					<?php } ?>
					<?php if ( ! empty( $settings->estimated_cost ) ) { ?>
						"estimatedCost": {
							"@type": "MonetaryAmount",
							"currency": "<?php echo ! empty( $settings->currency_iso_code ) ? wp_kses_post( $settings->currency_iso_code ) : ''; ?>",
							"value": "<?php echo ! empty( $settings->estimated_cost ) ? wp_kses_post( $settings->estimated_cost ) : ''; ?>"
						},
					<?php } ?>
					<?php if ( ! empty( $settings->uabb_supply[0] ) && 'yes' === $settings->show_advanced && 'yes' === $settings->add_supply ) { ?>
					"supply": 
						<?php
						if ( isset( $supply ) && ! empty( $supply ) ) {
							echo wp_kses_post( $supply );
						}
						?>
						,
					<?php } ?>
					<?php if ( ! empty( $settings->uabb_tool[0] ) && 'yes' === $settings->show_advanced && 'yes' === $settings->add_tool ) { ?>
					"tool": 
						<?php
						if ( isset( $tool ) && ! empty( $tool ) ) {
							echo wp_kses_post( $tool );
						}
						?>
						,
					<?php } ?>
					<?php if ( ! empty( $settings->step_data[0] ) ) { ?>
					"step": 
						<?php
						if ( isset( $steps ) && ! empty( $steps ) ) {
							echo wp_kses_post( $steps );
						}
					}
					?>
					<?php if ( ! empty( $settings->total_time ) ) { ?>	
						, "totalTime": 
						<?php
						if ( isset( $settings->total_time ) && ! empty( $settings->total_time ) ) {
							?>

								"PT<?php echo esc_attr( $settings->total_time ); ?>M"
							<?php } ?>
					<?php } ?>
					}
			</script>
			<div class="uabb-how-to-container uabb-clearfix">
				<<?php echo esc_attr( $settings->title_tag ); ?> class="uabb-how-to-title" ><?php echo $settings->uabb_how_to_title; ?></<?php echo esc_attr( $settings->title_tag ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<div class="uabb-how-to-description">
					<?php
					if ( isset( $settings->description ) && ! empty( $settings->description ) ) {

						echo wpautop( $wp_embed->autoembed( $settings->description ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
				<?php if ( isset( $settings->image_src ) && ! empty( $settings->image_src ) ) { ?>
				<div class="uabb-how-to-image">
					<img class="uabb-how-to-img-decs " src="<?php echo esc_url( $settings->image_src ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>" />
				</div>
				<?php } ?>
				<?php if ( 'yes' === esc_attr( $settings->show_advanced ) ) { ?>
					<div class="uabb-how-to-advanced-container">
						<?php
						if ( isset( $settings->total_time ) && ! empty( $settings->total_time ) ) {
							?>
							<p class="uabb-how-to-total-time">
								<?php echo ! empty( $settings->total_time_text ) ? $settings->total_time_text : ''; ?><?php echo ' ' . esc_attr( $settings->total_time ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> minutes
							</p>
						<?php } ?>						
							<p class="uabb-how-to-estimated-cost">

								<?php echo ! empty( $settings->estimated_cost_text ) ? $settings->estimated_cost_text : ''; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php if ( isset( $settings->estimated_cost ) && ! empty( $settings->estimated_cost ) && isset( $settings->currency_iso_code ) && ! empty( $settings->currency_iso_code ) ) { ?>
									<span><?php echo $settings->currency_iso_code . ' ' . $settings->estimated_cost; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								<?php } ?>
							</p>
					</div>

					<?php if ( 'yes' === esc_attr( $settings->add_supply ) ) { ?>
						<div class="uabb-how-to-supply">
							<?php if ( isset( $settings->supply_title ) && ! empty( $settings->supply_title ) ) { ?>
								<<?php echo esc_attr( $settings->supply_title_tag ); ?> class="uabb-how-to-supply-title"><?php echo $settings->supply_title; ?></<?php echo esc_attr( $settings->supply_title_tag ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php } ?>
							<?php
							if ( isset( $settings->uabb_supply ) ) {
								foreach ( $settings->uabb_supply as $key => $supply ) {
									?>
									<div class="uabb-supply uabb-supply-<?php echo esc_attr( $key + 1 ); ?>">
										<span><?php echo $supply; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
					<?php
					if ( 'yes' === esc_attr( $settings->add_tool ) ) {
						?>
						<div class="uabb-how-to-tool">
							<?php if ( isset( $settings->tool_title ) && ! empty( $settings->tool_title ) ) { ?>
								<<?php echo esc_attr( $settings->tool_title_tag ); ?> class="uabb-how-to-tool-title"><?php echo $settings->tool_title; ?></<?php echo esc_attr( $settings->tool_title_tag ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php } ?>
							<?php
							if ( isset( $settings->uabb_tool ) ) {
								foreach ( $settings->uabb_tool as $key => $tool ) {
									?>
									<div class="uabb-tool uabb-tool-<?php echo esc_attr( $key + 1 ); ?>" >
										<span ><?php echo $tool; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
				<?php if ( isset( $settings->step_data ) ) { ?>
					<div class="uabb-how-to-steps" id="step-<?php echo esc_attr( $id ); ?>">
						<?php
						if ( isset( $settings->step_section_title ) && ! empty( $settings->step_section_title ) ) {
							?>
							<<?php echo esc_attr( $settings->step_section_title_tag ); ?> class="uabb-how-to-step-section-title" ><?php echo $settings->step_section_title; ?></<?php echo esc_attr( $settings->step_section_title_tag ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php } ?>
						<?php
						foreach ( $settings->step_data as $key => $step ) {
							$target   = isset( $step->step_link_target ) ? ' target="' . $step->step_link_target . '"' : '';
							$nofollow = isset( $step->step_link_nofollow ) && 'yes' === esc_attr( $step->step_link_nofollow ) ? ' rel="nofollow"' : '';
							$step_id  = 'step-' . $id . '-' . ( $key + 1 );
							?>
							<div id="<?php echo esc_attr( $step_id ); ?>" class=" uabb-how-to-step-wrap uabb-how-to-step<?php echo isset( $step->step_image ) && ! empty( $step->step_image ) ? ' uabb-has-img' : ' uabb-no-img'; ?>" >

								<div class="uabb-how-to-step-content">
								<?php if ( isset( $step->step_title ) && ! empty( $step->step_title ) ) { ?>
									<?php if ( isset( $step->step_link ) && ! empty( $step->step_link ) ) { ?>
										<a href="<?php echo $step->step_link; ?>"<?php echo esc_attr( $target ); ?><?php echo esc_attr( $nofollow ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php } ?>
										<div class="uabb-how-to-step-title" ><?php echo $step->step_title; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<?php if ( isset( $step->step_link ) && ! empty( $step->step_link ) ) { ?>
										</a>
									<?php } ?>

									<?php if ( isset( $step->step_description ) && ! empty( $step->step_description ) ) { ?>
										<div class="uabb-how-to-step-description" >
											<?php echo wpautop( $wp_embed->autoembed( $step->step_description ) );  //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									<?php } ?>

								<?php } else { ?>
									<?php if ( isset( $step->step_link ) && ! empty( $step->step_link ) ) { ?>
										<a href="<?php echo $step->step_link; ?>"<?php echo esc_attr( $target ); ?><?php echo esc_attr( $nofollow ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
									<?php } ?>
										<?php if ( isset( $step->step_description ) && ! empty( $step->step_description ) ) { ?>
											<div class="uabb-how-to-step-description">
												<?php echo wpautop( $wp_embed->autoembed( $step->step_description ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</div>
										<?php } ?>

									<?php if ( isset( $step->step_link ) && ! empty( $step->step_link ) ) { ?>
										</a>
									<?php } ?>

								<?php } ?>
								</div>
								<?php
								if ( isset( $step->step_image ) && ! empty( $step->step_image ) ) {
									$image_data       = FLBuilderPhoto::get_attachment_data( $step->step_image );
									$step_image_alt   = isset( $image_data->alt ) ? $image_data->alt : '';
									$step_image_title = isset( $image_data->title ) ? $image_data->title : '';
									?>
									<div class="uabb-how-to-step-image">
										<img class="uabb-how-to-img-step" src="<?php echo esc_url( $step->step_image_src ); ?>" alt="<?php echo esc_attr( $step_image_alt ); ?>" title="<?php echo esc_attr( $step_image_title ); ?>" />
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>

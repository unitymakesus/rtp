<?php
/**
 *  UABB Table Module front-end file
 *
 *  @package UABB Table Module
 */

if ( 'manual' === $settings->table_type ) {
	$head_row         = count( $settings->thead_row );
	$body_row         = count( $settings->tbody_row );
	$row_filter_count = 0;

	for ( $row_cnt = 0; $row_cnt < $body_row; $row_cnt++ ) {
		if ( 'row' === $settings->tbody_row[ $row_cnt ]->action ) {
			$row_filter_count++;
		}
	}
}

if ( '' === $settings->search_label ) {
	$settings->search_label = __( 'Search...', 'uabb' );
}

if ( '' === $settings->show_entries_label ) {
	$settings->show_entries_label = __( 'Show Entries', 'uabb' );
}

if ( '' === $settings->show_entries_all_label ) {
	$settings->show_entries_all_label = __( 'All', 'uabb' );
}
?>

<?php if ( 'manual' === $settings->table_type ) : ?>
	<div class="table-data">
		<?php if ( 'yes' === $settings->show_entries ) : ?>
			<div class="entries-wrapper">
				<label class="lbl-entries"><?php echo $settings->show_entries_label; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label>
				<select class="select-filter">	
					<option class="filter-entry"><?php echo $settings->show_entries_all_label; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></option>
					<?php for ( $cnt = 1; $cnt < $row_filter_count; $cnt++ ) { ?>
						<option class="filter-entry"> <?php echo wp_kses_post( $cnt ); ?> </option>
					<?php } ?>									
				</select>
			</div>	
		<?php endif; ?>

		<?php if ( 'yes' === $settings->show_search ) : ?>
			<div class="search-wrapper">
				<input class="search-input" type="text" placeholder="<?php echo $settings->search_label; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" name="toSearch" id="searchHere"/>
			</div>
		<?php endif ?>	
	</div>
<?php endif ?>	

<?php if ( 'manual' === $settings->table_type ) { ?>
	<div class="uabb-table-module-content uabb-table">
		<div class="uabb-table-element-box">
			<div class="uabb-table-wrapper">
				<table class="uabb-table-inner-wrap">
					<thead class="uabb-table-header">
						<?php
						for ( $table_header = 0; $table_header < $head_row; $table_header++ ) {
							$head_text_color = ( isset( $settings->thead_row[ $table_header ]->head_text_color ) && '' !== $settings->thead_row[ $table_header ]->head_text_color && 'yes' === $settings->thead_row[ $table_header ]->head_advanced_opt ) ? 'table-head-text-highlight' : '';

							$head_bg_color = ( isset( $settings->thead_row[ $table_header ]->head_bg_color ) && '' !== $settings->thead_row[ $table_header ]->head_bg_color && 'yes' === $settings->thead_row[ $table_header ]->head_advanced_opt ) ? 'table-head-bg-highlight' : '';

							if ( 'row' === $settings->thead_row[ $table_header ]->head_action ) {
								?>
								<tr class="table-header-tr">
							<?php } ?>
								<th class="<?php echo esc_attr( $head_text_color ); ?> <?php echo esc_attr( $head_bg_color ); ?> table-heading-<?php echo esc_attr( $table_header ); ?> table-header-th" rowspan="<?php echo esc_attr( $settings->thead_row[ $table_header ]->head_row_span ); ?>" colspan="<?php echo esc_attr( $settings->thead_row[ $table_header ]->head_col_span ); ?>" >
								<?php
								if ( 'no' === $settings->thead_row[ $table_header ]->head_advanced_opt ) {

									if ( 'yes' === $settings->show_sort ) {
										?>
									<label class="head-style-<?php echo esc_attr( $table_header ); ?> th-style">
										<label class="head-inner-text"> <?php echo $settings->thead_row[ $table_header ]->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </label>
									</label>
									<i class="uabb-sort-icon fa fa-sort"> </i>
										<?php
									} else {
										?>
									<label class="head-style-<?php echo esc_attr( $table_header ); ?> th-style"> 
										<label class="head-inner-text"> <?php echo $settings->thead_row[ $table_header ]->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </label> 
									</label>
										<?php
									}
								} else {

									$before_icon = 'before-icon';
									$after_icon  = 'after-icon';

									$head_src = isset( $settings->thead_row[ $table_header ]->head_photo_src ) ? $settings->thead_row[ $table_header ]->head_photo_src : '';

									if ( ! empty( $settings->thead_row[ $table_header ]->head_link ) ) {
										?>

									<a href="<?php echo $settings->thead_row[ $table_header ]->head_link; ?>" target="<?php echo esc_attr( $settings->thead_row[ $table_header ]->head_link_target ); ?>" class="th-style head-style-<?php echo esc_attr( $table_header ); ?>"<?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->thead_row[ $table_header ]->head_link_target, $settings->thead_row[ $table_header ]->head_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >

										<?php
										if ( 'before' === $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

											<i class="<?php echo esc_attr( $before_icon ); ?> <?php echo esc_attr( $settings->thead_row[ $table_header ]->head_icon ); ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

											<img class="thead-img <?php echo esc_attr( $before_icon ); ?> head-content-img" src="<?php echo esc_url( $settings->thead_row[ $table_header ]->head_photo_src ); ?>"/>
												<?php
											}
										}
										?>

										<span class="thead-th-context"> <?php echo $settings->thead_row[ $table_header ]->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>									
										<?php
										if ( 'after' === $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

											<i class="<?php echo esc_attr( $after_icon ); ?> <?php echo esc_attr( $settings->thead_row[ $table_header ]->head_icon ); ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo esc_attr( $after_icon ); ?> head-content-img" src="<?php echo esc_url( $settings->thead_row[ $table_header ]->head_photo_src ); ?>"/>
												<?php
											}
										}
										?>
									</a>

										<?php if ( 'yes' === $settings->show_sort ) { ?>
										<i class="uabb-sort-icon fa fa-sort"> </i>
									<?php } ?>

										<?php
									} else {
										if ( 'yes' === $settings->show_sort ) {
											?>
											<label class="th-style head-style-<?php echo esc_attr( $table_header ); ?>">
										<?php } else { ?>
											<span class="head-inner-text"> 
											<?php
										} if ( 'before' === $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

											<i class="<?php echo esc_attr( $before_icon ); ?> <?php echo esc_attr( $settings->thead_row[ $table_header ]->head_icon ); ?>"></i>														
							<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo esc_attr( $before_icon ); ?> head-content-img" src="<?php echo esc_url( $settings->thead_row[ $table_header ]->head_photo_src ); ?>"/>
												<?php
							}
										}
										?>

										<span> <?php echo $settings->thead_row[ $table_header ]->heading; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>

										<?php
										if ( 'after' === $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

												<i class="<?php echo esc_attr( $after_icon ); ?> <?php echo esc_attr( $settings->thead_row[ $table_header ]->head_icon ); ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' === $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo esc_attr( $after_icon ); ?> head-content-img" src="<?php echo esc_url( $settings->thead_row[ $table_header ]->head_photo_src ); ?>"/>
												<?php
											}
										}

										if ( 'yes' === $settings->show_sort ) {
											?>
											</label> <i class="uabb-sort-icon fa fa-sort"></i>
										<?php } ?>

										<?php
									}
								}
								?>
							</th> 
						<?php } ?>
					</thead>

					<tbody class="uabb-table-features">
						<?php
						for ( $table_body = 0; $table_body < $body_row; $table_body++ ) {
							$body_text_color = ( isset( $settings->tbody_row[ $table_body ]->body_text_color ) && '' !== $settings->tbody_row[ $table_body ]->body_text_color && 'yes' === $settings->tbody_row[ $table_body ]->body_advanced_opt ) ? 'table-body-text-highlight' : '';

							$body_bg_color = ( isset( $settings->tbody_row[ $table_body ]->body_bg_color ) && '' !== $settings->tbody_row[ $table_body ]->body_bg_color && 'yes' === $settings->tbody_row[ $table_body ]->body_advanced_opt ) ? 'table-body-bg-highlight' : '';

							if ( 'row' === $settings->tbody_row[ $table_body ]->action ) {
								?>
									<tr class="tbody-row"> 
										<?php } ?>
										<td class="table-body-td <?php echo esc_attr( $body_text_color ); ?> <?php echo esc_attr( $body_bg_color ); ?> table-body-<?php echo esc_attr( $table_body ); ?>" colspan="<?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_col_span ); ?>" rowspan="<?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_row_span ); ?>"> 
											<?php if ( 'no' === $settings->tbody_row[ $table_body ]->body_advanced_opt ) { ?>
												<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>
													<?php
											} else {
												if ( 'yes' === $settings->tbody_row[ $table_body ]->body_advanced_opt ) {

													$before_icon = 'before-icon';
													$after_icon  = 'after-icon';

													$body_src = isset( $settings->tbody_row[ $table_body ]->body_photo_src ) ? $settings->tbody_row[ $table_body ]->body_photo_src : '';

													if ( ! empty( $settings->tbody_row[ $table_body ]->body_link ) ) {
														?>

													<a class="td-style" href="<?php echo $settings->tbody_row[ $table_body ]->body_link; ?>" target="<?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_link_target ); ?>"<?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->tbody_row[ $table_body ]->body_link_target, $settings->tbody_row[ $table_body ]->body_link_nofollow, 1 ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >

														<?php if ( 'photo' === $settings->tbody_row[ $table_body ]->body_icon_type && ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'before' === $settings->tbody_row[ $table_body ]->body_icon_position ) { ?>
															<img class="body-content-img <?php echo esc_attr( $before_icon ); ?>" src="<?php echo esc_url( $settings->tbody_row[ $table_body ]->body_photo_src ); ?>"/>
														<?php } ?>

														<?php if ( 'icon' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'before' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
															<i class="<?php echo esc_attr( $before_icon ); ?> <?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_icon ); ?>"></i>
														<?php } ?>

														<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>

														<?php if ( 'photo' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'after' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo esc_attr( $after_icon ); ?>" src="<?php echo esc_url( $settings->tbody_row[ $table_body ]->body_photo_src ); ?>"/>
															<?php } ?>

														<?php if ( 'icon' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'after' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
															<i class="<?php echo esc_attr( $after_icon ); ?> <?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_icon ); ?>"></i>
														<?php } ?>
													</a>

									<?php } else { ?>

													<span class="td-style"> 
														<?php if ( 'photo' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'before' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo esc_attr( $before_icon ); ?>" src="<?php echo esc_url( $settings->tbody_row[ $table_body ]->body_photo_src ); ?>"/>
															<?php } ?>

															<?php if ( 'icon' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'before' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
																<i class="<?php echo esc_attr( $before_icon ); ?> <?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_icon ); ?>"></i>
															<?php } ?>

															<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> </span>

															<?php if ( 'photo' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'after' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo esc_attr( $after_icon ); ?>" src="<?php echo esc_url( $settings->tbody_row[ $table_body ]->body_photo_src ); ?>"/>
															<?php } ?>

															<?php if ( 'icon' === $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'after' === $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
																<i class="<?php echo esc_attr( $after_icon ); ?> <?php echo esc_attr( $settings->tbody_row[ $table_body ]->body_icon ); ?>"></i>
															<?php } ?>
													</span>

														<?php
									}
												}
											}
											?>
										</td>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
	<?php
} else {
	echo $module->render(); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
?>

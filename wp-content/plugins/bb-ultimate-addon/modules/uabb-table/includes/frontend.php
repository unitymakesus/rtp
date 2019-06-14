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
		if ( 'row' == $settings->tbody_row[ $row_cnt ]->action ) {
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

<?php if ( 'manual' == $settings->table_type ) : ?>
	<div class="table-data">
		<?php if ( 'yes' == $settings->show_entries ) : ?>
			<div class="entries-wrapper">
				<label class="lbl-entries"><?php echo $settings->show_entries_label; ?></label>
				<select class="select-filter">	
					<option class="filter-entry"><?php echo $settings->show_entries_all_label; ?></option>
					<?php for ( $cnt = 1; $cnt < $row_filter_count; $cnt++ ) { ?>
						<option class="filter-entry"> <?php echo $cnt; ?> </option>
					<?php } ?>									
				</select>
			</div>	
		<?php endif; ?>

		<?php if ( 'yes' == $settings->show_search ) : ?>
			<div class="search-wrapper">
				<input class="search-input" type="text" placeholder="<?php echo $settings->search_label; ?>" name="toSearch" id="searchHere"/>
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
							$head_text_color = ( isset( $settings->thead_row[ $table_header ]->head_text_color ) && '' != $settings->thead_row[ $table_header ]->head_text_color && 'yes' == $settings->thead_row[ $table_header ]->head_advanced_opt ) ? 'table-head-text-highlight' : '';

							$head_bg_color = ( isset( $settings->thead_row[ $table_header ]->head_bg_color ) && '' != $settings->thead_row[ $table_header ]->head_bg_color && 'yes' == $settings->thead_row[ $table_header ]->head_advanced_opt ) ? 'table-head-bg-highlight' : '';

							if ( 'row' == $settings->thead_row[ $table_header ]->head_action ) {
								?>
								<tr class="table-header-tr">
							<?php } ?>
								<th class="<?php echo $head_text_color; ?> <?php echo $head_bg_color; ?> table-heading-<?php echo $table_header; ?> table-header-th" rowspan="<?php echo $settings->thead_row[ $table_header ]->head_row_span; ?>" colspan="<?php echo $settings->thead_row[ $table_header ]->head_col_span; ?>" >
								<?php
								if ( 'no' == $settings->thead_row[ $table_header ]->head_advanced_opt ) {

									if ( 'yes' == $settings->show_sort ) {
										?>
									<label class="head-style-<?php echo $table_header; ?> th-style">
										<label class="head-inner-text"> <?php echo $settings->thead_row[ $table_header ]->heading; ?> </label>
									</label>
									<i class="uabb-sort-icon fa fa-sort"> </i>
										<?php
									} else {
										?>
									<label class="head-style-<?php echo $table_header; ?> th-style"> 
										<label class="head-inner-text"> <?php echo $settings->thead_row[ $table_header ]->heading; ?> </label> 
									</label>
										<?php
									}
								} else {

									$before_icon = 'before-icon';
									$after_icon  = 'after-icon';

									$head_src = isset( $settings->thead_row[ $table_header ]->head_photo_src ) ? $settings->thead_row[ $table_header ]->head_photo_src : '';

									if ( ! empty( $settings->thead_row[ $table_header ]->head_link ) ) {
										?>

									<a href="<?php echo $settings->thead_row[ $table_header ]->head_link; ?>" target="<?php echo $settings->thead_row[ $table_header ]->head_link_target; ?>" class="th-style head-style-<?php echo $table_header; ?>"<?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->thead_row[ $table_header ]->head_link_target, $settings->thead_row[ $table_header ]->head_link_nofollow, 1 ); ?> >

										<?php
										if ( 'before' == $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

											<i class="<?php echo $before_icon; ?> <?php echo $settings->thead_row[ $table_header ]->head_icon; ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

											<img class="thead-img <?php echo $before_icon; ?> head-content-img" src="<?php echo $settings->thead_row[ $table_header ]->head_photo_src; ?>"/>
												<?php
}
										}
										?>

										<span class="thead-th-context"> <?php echo $settings->thead_row[ $table_header ]->heading; ?> </span>									
										<?php
										if ( 'after' == $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

											<i class="<?php echo $after_icon; ?> <?php echo $settings->thead_row[ $table_header ]->head_icon; ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo $after_icon; ?> head-content-img" src="<?php echo $settings->thead_row[ $table_header ]->head_photo_src; ?>"/>
												<?php
}
										}
										?>
									</a>

										<?php if ( 'yes' == $settings->show_sort ) { ?>
										<i class="uabb-sort-icon fa fa-sort"> </i>
									<?php } ?>

										<?php
									} else {
										if ( 'yes' == $settings->show_sort ) {
											?>
											<label class="th-style head-style-<?php echo $table_header; ?>">
										<?php } else { ?>
											<span class="head-inner-text"> 
											<?php
} if ( 'before' == $settings->thead_row[ $table_header ]->head_icon_position ) {

	if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
		?>

											<i class="<?php echo $before_icon; ?> <?php echo $settings->thead_row[ $table_header ]->head_icon; ?>"></i>														
							<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo $before_icon; ?> head-content-img" src="<?php echo $settings->thead_row[ $table_header ]->head_photo_src; ?>"/>
												<?php
}
}
?>

										<span> <?php echo $settings->thead_row[ $table_header ]->heading; ?> </span>

										<?php
										if ( 'after' == $settings->thead_row[ $table_header ]->head_icon_position ) {

											if ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'icon' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_icon ) ) ) {
												?>

												<i class="<?php echo $after_icon; ?> <?php echo $settings->thead_row[ $table_header ]->head_icon; ?>"></i>														
											<?php } elseif ( ( isset( $settings->thead_row[ $table_header ]->head_icon_type ) && 'photo' == $settings->thead_row[ $table_header ]->head_icon_type ) && ( ! empty( $settings->thead_row[ $table_header ]->head_photo ) ) ) { ?>

												<img class="thead-img <?php echo $after_icon; ?> head-content-img" src="<?php echo $settings->thead_row[ $table_header ]->head_photo_src; ?>"/>
												<?php
}
										}

										if ( 'yes' == $settings->show_sort ) {
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
							$body_text_color = ( isset( $settings->tbody_row[ $table_body ]->body_text_color ) && '' != $settings->tbody_row[ $table_body ]->body_text_color && 'yes' == $settings->tbody_row[ $table_body ]->body_advanced_opt ) ? 'table-body-text-highlight' : '';

							$body_bg_color = ( isset( $settings->tbody_row[ $table_body ]->body_bg_color ) && '' != $settings->tbody_row[ $table_body ]->body_bg_color && 'yes' == $settings->tbody_row[ $table_body ]->body_advanced_opt ) ? 'table-body-bg-highlight' : '';

							if ( 'row' == $settings->tbody_row[ $table_body ]->action ) {
								?>
									<tr class="tbody-row"> 
										<?php } ?>
										<td class="table-body-td <?php echo $body_text_color; ?> <?php echo $body_bg_color; ?> table-body-<?php echo $table_body; ?>" colspan="<?php echo $settings->tbody_row[ $table_body ]->body_col_span; ?>" rowspan="<?php echo $settings->tbody_row[ $table_body ]->body_row_span; ?>"> 
											<?php if ( 'no' == $settings->tbody_row[ $table_body ]->body_advanced_opt ) { ?>
												<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; ?> </span>
													<?php
} else {
	if ( 'yes' == $settings->tbody_row[ $table_body ]->body_advanced_opt ) {

		$before_icon = 'before-icon';
		$after_icon  = 'after-icon';

		$body_src = isset( $settings->tbody_row[ $table_body ]->body_photo_src ) ? $settings->tbody_row[ $table_body ]->body_photo_src : '';

		if ( ! empty( $settings->tbody_row[ $table_body ]->body_link ) ) {
			?>

													<a class="td-style" href="<?php echo $settings->tbody_row[ $table_body ]->body_link; ?>" target="<?php echo $settings->tbody_row[ $table_body ]->body_link_target; ?>"<?php BB_Ultimate_Addon_Helper::get_link_rel( $settings->tbody_row[ $table_body ]->body_link_target, $settings->tbody_row[ $table_body ]->body_link_nofollow, 1 ); ?> >

										<?php if ( 'photo' == $settings->tbody_row[ $table_body ]->body_icon_type && ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'before' == $settings->tbody_row[ $table_body ]->body_icon_position ) { ?>
															<img class="body-content-img <?php echo $before_icon; ?>" src="<?php echo $settings->tbody_row[ $table_body ]->body_photo_src; ?>"/>
														<?php } ?>

										<?php if ( 'icon' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'before' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
															<i class="<?php echo $before_icon; ?> <?php echo $settings->tbody_row[ $table_body ]->body_icon; ?>"></i>
														<?php } ?>

														<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; ?> </span>

										<?php if ( 'photo' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'after' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo $after_icon; ?>" src="<?php echo $settings->tbody_row[ $table_body ]->body_photo_src; ?>"/>
															<?php } ?>

										<?php if ( 'icon' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'after' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
															<i class="<?php echo $after_icon; ?> <?php echo $settings->tbody_row[ $table_body ]->body_icon; ?>"></i>
														<?php } ?>
													</a>

									<?php } else { ?>

													<span class="td-style"> 
														<?php if ( 'photo' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'before' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo $before_icon; ?>" src="<?php echo $settings->tbody_row[ $table_body ]->body_photo_src; ?>"/>
															<?php } ?>

															<?php if ( 'icon' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'before' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
																<i class="<?php echo $before_icon; ?> <?php echo $settings->tbody_row[ $table_body ]->body_icon; ?>"></i>
															<?php } ?>

															<span class="content-text"> <?php echo $settings->tbody_row[ $table_body ]->features; ?> </span>

															<?php if ( 'photo' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_photo ) && 'after' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) { ?>
																<img class="body-content-img <?php echo $after_icon; ?>" src="<?php echo $settings->tbody_row[ $table_body ]->body_photo_src; ?>"/>
															<?php } ?>

															<?php if ( 'icon' == $settings->tbody_row[ $table_body ]->body_icon_type && ( ! empty( $settings->tbody_row[ $table_body ]->body_icon ) && ( 'after' == $settings->tbody_row[ $table_body ]->body_icon_position ) ) ) { ?>
																<i class="<?php echo $after_icon; ?> <?php echo $settings->tbody_row[ $table_body ]->body_icon; ?>"></i>
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
	echo $module->render();
}
?>

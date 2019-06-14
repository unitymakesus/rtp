<?php
/**
 *  UABB Table Module file
 *
 *  @package UABB Table Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();

$settings->table_foreground_outside = UABB_Helper::uabb_colorpicker( $settings, 'table_foreground_outside' );

$settings->body_rows_bg_hover = UABB_Helper::uabb_colorpicker( $settings, 'body_rows_bg_hover' );

$settings->body_rows_text_hover = UABB_Helper::uabb_colorpicker( $settings, 'body_rows_text_hover' );

$settings->body_cell_text_hover = UABB_Helper::uabb_colorpicker( $settings, 'body_cell_text_hover' );

$settings->head_icons_global_color = UABB_Helper::uabb_colorpicker( $settings, 'head_icons_global_color' );

$settings->body_icons_global_color = UABB_Helper::uabb_colorpicker( $settings, 'body_icons_global_color' );

$settings->body_cell_bg_hover = UABB_Helper::uabb_colorpicker( $settings, 'body_cell_bg_hover' );

$settings->table_data_border_color = UABB_Helper::uabb_colorpicker( $settings, 'table_data_border_color' );

$settings->table_body_data_border_color = UABB_Helper::uabb_colorpicker( $settings, 'table_body_data_border_color' );

$settings->row_heading_color = UABB_Helper::uabb_colorpicker( $settings, 'row_heading_color' );

$settings->features_color = UABB_Helper::uabb_colorpicker( $settings, 'features_color' );

$settings->row_heading_background_color = UABB_Helper::uabb_colorpicker( $settings, 'row_heading_background_color' );

$settings->even_properties_bg = UABB_Helper::uabb_colorpicker( $settings, 'even_properties_bg' );

$settings->odd_properties_bg = UABB_Helper::uabb_colorpicker( $settings, 'odd_properties_bg' );

$settings->entries_label_color = UABB_Helper::uabb_colorpicker( $settings, 'entries_label_color' );

$settings->entries_input_color = UABB_Helper::uabb_colorpicker( $settings, 'entries_input_color' );

$settings->entries_background_color = UABB_Helper::uabb_colorpicker( $settings, 'entries_background_color' );

$settings->entries_border_color = UABB_Helper::uabb_colorpicker( $settings, 'entries_border_color' );

$table_header = 0;

foreach ( $settings->thead_row as $head_row ) {
	if ( 'no' !== $head_row->head_advanced_opt ) :
		?>
		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> {
			<?php if ( '' != $head_row->head_text_color && isset( $head_row->head_text_color ) ) { ?>
			color: <?php echo ( false === strpos( $head_row->head_text_color, 'rgb' ) ) ? '#' . $head_row->head_text_color : $head_row->head_text_color; ?>;
			<?php } ?>

			background: unset;
		}

		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> {
			<?php if ( '' != $head_row->head_bg_color && isset( $head_row->head_bg_color ) ) { ?>
				background-color: <?php echo ( false === strpos( $head_row->head_bg_color, 'rgb' ) ) ? '#' . $head_row->head_bg_color : $head_row->head_bg_color; ?>;
			<?php } ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> .before-icon,
		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> .after-icon {
			<?php if ( '' != $head_row->head_icon_color && isset( $head_row->head_icon_color ) ) { ?>
				color: <?php echo ( false === strpos( $head_row->head_icon_color, 'rgb' ) ) ? '#' . $head_row->head_icon_color : $head_row->head_icon_color; ?>;
			<?php } ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> {
			<?php if ( '' != $head_row->custom_header_col_width ) { ?>
				width: <?php echo $head_row->custom_header_col_width; ?>px;
			<?php } ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> .head-content-img {
			width: <?php echo $head_row->head_photo_img_width; ?>px;
		}

		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> .before-icon,
		.fl-node-<?php echo $id; ?> .uabb-table-header .table-heading-<?php echo $table_header; ?> .after-icon {
			font-size: <?php echo $head_row->head_icon_img_width; ?>px;
		}
		<?php
endif;
	$table_header++;
}

$table_body = 0;

foreach ( $settings->tbody_row as $body_row ) {
	if ( 'no' !== $body_row->body_advanced_opt ) :
		?>
		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?>,
		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .content-text {
			<?php if ( '' != $body_row->body_text_color && isset( $body_row->body_text_color ) ) { ?>
				color: <?php echo ( false === strpos( $body_row->body_text_color, 'rgb' ) ) ? '#' . $body_row->body_text_color : $body_row->body_text_color; ?>;
			<?php } ?>

			background: unset;
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> {
			<?php if ( '' != $body_row->body_bg_color && isset( $body_row->body_bg_color ) ) { ?>
				background-color: <?php echo ( false === strpos( $body_row->body_bg_color, 'rgb' ) ) ? '#' . $body_row->body_bg_color : $body_row->body_bg_color; ?>;
			<?php } ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .before-icon,
		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .after-icon {
			<?php if ( '' != $body_row->body_icon_color && isset( $body_row->body_icon_color ) ) { ?>
				color: <?php echo ( false === strpos( $body_row->body_icon_color, 'rgb' ) ) ? '#' . $body_row->body_icon_color : $body_row->body_icon_color; ?>;
			<?php } ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .body-content-img {
			width: <?php echo $body_row->body_photo_img_width; ?>px;
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .before-icon,
		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-<?php echo $table_body; ?> .after-icon {
			font-size: <?php echo $body_row->body_icon_img_width; ?>px;
		}

		<?php
endif;
	$table_body++;
}
?>

.fl-node-<?php echo $id; ?> .uabb-table-features .tbody-row {
	<?php if ( '' !== $settings->features_color ) : ?>
		color: <?php echo $settings->features_color; ?>;
	<?php endif; ?>

	<?php if ( '' !== $settings->table_foreground_outside && 'no' === $settings->strip_effect ) : ?>
		background: <?php echo $settings->table_foreground_outside; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .uabb-table-features .tbody-row:nth-child(even) {
	<?php if ( '' !== $settings->even_properties_bg && 'yes' == $settings->strip_effect ) : ?>
		background: <?php echo $settings->even_properties_bg; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .uabb-table-features .tbody-row:nth-child(odd) {
	<?php if ( '' !== $settings->odd_properties_bg && 'yes' == $settings->strip_effect ) : ?>
		background: <?php echo $settings->odd_properties_bg; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .uabb-table-features .tbody-row:hover {
	<?php if ( '' !== $settings->body_rows_text_hover ) : ?>
		color: <?php echo $settings->body_rows_text_hover; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->body_rows_bg_hover ) : ?>
		background: <?php echo $settings->body_rows_bg_hover; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .uabb-table-features .tbody-row .table-body-td:hover {
	<?php if ( '' !== $settings->body_cell_text_hover ) : ?>
		color: <?php echo $settings->body_cell_text_hover; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->body_cell_bg_hover ) : ?>
		background: <?php echo $settings->body_cell_bg_hover; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .table-header-th .before-icon,
.fl-node-<?php echo $id; ?> .table-header-th .after-icon {
	<?php if ( '' !== $settings->head_icons_global_color ) : ?>
		color: <?php echo $settings->head_icons_global_color; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->head_icons_gloabl_size ) : ?>
		font-size: <?php echo $settings->head_icons_gloabl_size; ?>px;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .table-body-td .before-icon,
.fl-node-<?php echo $id; ?> .table-body-td .after-icon {
	<?php if ( '' !== $settings->body_icons_global_color ) : ?>
		color: <?php echo $settings->body_icons_global_color; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->body_icons_gloabl_size ) : ?>
		font-size: <?php echo $settings->body_icons_gloabl_size; ?>px;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .table-header-th .head-content-img {
	<?php if ( '' !== $settings->head_image_gloabl_size ) : ?>
		width: <?php echo $settings->head_image_gloabl_size; ?>px;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .table-body-td .body-content-img {
	<?php if ( '' !== $settings->body_image_gloabl_size ) : ?>
		width: <?php echo $settings->body_image_gloabl_size; ?>px;
	<?php endif ?>
}

<?php
if ( '' === $settings->table_data_border_size ) {
	$settings->table_data_border_size = 1;
}
?>

.fl-node-<?php echo $id; ?> .uabb-table-inner-wrap .uabb-table-header .table-header-th {
	<?php if ( '' !== $settings->table_data_border_color ) : ?>
		border: <?php echo $settings->table_data_border_size; ?>px solid <?php echo $settings->table_data_border_color; ?>;
	<?php endif ?>

	padding: <?php echo $settings->header_cell_padding; ?>px;
}

<?php
if ( '' === $settings->table_body_data_border_size ) {
	$settings->table_body_data_border_size = 1;
}
?>

.fl-node-<?php echo $id; ?> .uabb-table-inner-wrap .uabb-table-features .table-body-td {
	<?php if ( '' !== $settings->table_body_data_border_color ) : ?>
		border: <?php echo $settings->table_body_data_border_size; ?>px solid <?php echo $settings->table_body_data_border_color; ?>;
	<?php endif ?>

	padding: <?php echo $settings->body_cell_padding; ?>px;
}

.fl-node-<?php echo $id; ?> .entries-wrapper .lbl-entries {
	<?php if ( '' !== $settings->entries_label_color ) : ?>
		color: <?php echo $settings->entries_label_color; ?>;
	<?php endif ?>
}

<?php
if ( '' === $settings->entries_border_size ) {
	$settings->entries_border_size = 1;
}
?>

.fl-node-<?php echo $id; ?> .search-wrapper .search-input::placeholder,
.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter {
	<?php if ( '' !== $settings->entries_input_color ) : ?>
		color: <?php echo $settings->entries_input_color; ?>;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .search-wrapper .search-input,
.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter {

	<?php if ( '' !== $settings->entries_background_color ) : ?>
		background: <?php echo $settings->entries_background_color; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->entries_border_color ) : ?>
		border: <?php echo $settings->entries_border_size; ?>px solid <?php echo $settings->entries_border_color; ?>;
	<?php endif ?>

	<?php if ( '' !== $settings->entries_input_padding ) : ?>
		padding: <?php echo $settings->entries_input_padding; ?>px;
	<?php endif ?>

	<?php if ( '' !== $settings->entries_input_size ) : ?>
		width: <?php echo $settings->entries_input_size; ?>px;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .table-data {
	<?php if ( '' !== $settings->entries_bottom_space ) : ?>
		margin-bottom: <?php echo $settings->entries_bottom_space; ?>px;
	<?php endif ?>
}

.fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th,
.fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th .th-style {
	<?php if ( isset( $settings->row_heading_color ) && '' != $settings->row_heading_color ) : ?>
		color: <?php echo $settings->row_heading_color; ?>;
	<?php endif; ?>

	<?php if ( isset( $settings->row_heading_background_color ) && '' != $settings->row_heading_background_color ) : ?>
		background: <?php echo $settings->row_heading_background_color; ?>;
	<?php endif; ?>
}

/* Table headings typography */

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th,
	.fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th .th-style {

		text-align: <?php echo $settings->headings_align; ?>;

		<?php echo ( 'Default' != $settings->heading_typography_font_family['family'] ) ? 'font-family: ' . $settings->heading_typography_font_family['family'] . ';' : ''; ?>

		<?php echo ( 'default' != $settings->heading_typography_font_family['weight'] ) ? 'font-weight: ' . $settings->heading_typography_font_family['weight'] . ';' : ''; ?>

		<?php if ( isset( $settings->heading_typography_font_size_unit ) && '' != $settings->heading_typography_font_size_unit ) : ?>
				font-size: <?php echo $settings->heading_typography_font_size_unit; ?>px;
		<?php endif; ?>

		<?php if ( isset( $settings->heading_typography_line_height_unit ) && '' != $settings->heading_typography_line_height_unit ) : ?>
				line-height: <?php echo $settings->heading_typography_line_height_unit; ?>em;
		<?php endif; ?>

		<?php if ( isset( $settings->table_headings_typography_transform ) && '' != $settings->table_headings_typography_transform ) : ?>
			text-transform: <?php echo $settings->table_headings_typography_transform; ?>;
		<?php endif; ?>

		<?php if ( isset( $settings->table_headings_letter_spacing ) && '' != $settings->table_headings_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->table_headings_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'heading_typo',
				'selector'     => ".fl-node-$id .uabb-table-wrapper .table-header-th",
			)
		);
	}
}
?>

/* Body rows typography */

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-td,
	.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-td .td-style {

		text-align: <?php echo $settings->features_align; ?>;

		<?php echo ( 'Default' !== $settings->content_typography_font_family['family'] ) ? 'font-family: ' . $settings->content_typography_font_family['family'] . ';' : ''; ?>

		<?php echo ( 'default' !== $settings->content_typography_font_family['weight'] ) ? 'font-weight: ' . $settings->content_typography_font_family['weight'] . ';' : ''; ?>

		<?php if ( isset( $settings->content_typography_font_size_unit ) && '' !== $settings->content_typography_font_size_unit ) : ?>
				font-size: <?php echo $settings->content_typography_font_size_unit; ?>px;
		<?php endif; ?>

		<?php if ( isset( $settings->content_typography_line_height_unit ) && '' !== $settings->content_typography_line_height_unit ) : ?>
				line-height: <?php echo $settings->content_typography_line_height_unit; ?>em;
		<?php endif; ?>

		<?php if ( '' !== $settings->table_rows_typography_transform ) : ?>
			text-transform: <?php echo $settings->table_rows_typography_transform; ?>;
		<?php endif; ?>

		<?php if ( '' !== $settings->table_rows_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->table_rows_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'content_typo',
				'selector'     => ".fl-node-$id .uabb-table-wrapper .table-body-td",
			)
		);
	}
}
?>

/* Filter count typography */

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .entries-wrapper .lbl-entries,
	.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter,
	.fl-node-<?php echo $id; ?> .search-wrapper,
	.fl-node-<?php echo $id; ?> .search-wrapper .search-input {

		<?php echo ( 'Default' !== $settings->filter_typography_font_family['family'] ) ? 'font-family: ' . $settings->filter_typography_font_family['family'] . ';' : ''; ?>

		<?php echo ( 'default' !== $settings->filter_typography_font_family['weight'] ) ? 'font-weight: ' . $settings->filter_typography_font_family['weight'] . ';' : ''; ?>

		<?php if ( isset( $settings->filter_typography_font_size_unit ) && '' !== $settings->filter_typography_font_size_unit ) : ?>
				font-size: <?php echo $settings->filter_typography_font_size_unit; ?>px;
		<?php endif; ?>

		<?php if ( isset( $settings->filter_typography_line_height_unit ) && '' !== $settings->filter_typography_line_height_unit ) : ?>
				line-height: <?php echo $settings->filter_typography_line_height_unit; ?>em;
		<?php endif; ?>

		<?php if ( isset( $settings->table_filters_typography_transform ) && '' !== $settings->table_filters_typography_transform ) : ?>
			text-transform: <?php echo $settings->table_filters_typography_transform; ?>;
		<?php endif; ?>

		<?php if ( isset( $settings->table_filters_letter_spacing ) && '' !== $settings->table_filters_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->table_filters_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'filter_typo',
				'selector'     => ".fl-node-$id .entries-wrapper .lbl-entries, .fl-node-$id .entries-wrapper .select-filter, .fl-node-$id .search-input",
			)
		);
	}
}
?>

<?php if ( $global_settings->responsive_enabled ) { // Responsive Typography. ?>

	@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

		.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th {

			<?php if ( isset( $settings->heading_typography_font_size_unit_medium ) && '' !== $settings->heading_typography_font_size_unit_medium ) : ?>
				font-size: <?php echo $settings->heading_typography_font_size_unit_medium; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->heading_typography_line_height_unit_medium ) && '' !== $settings->heading_typography_line_height_unit_medium ) : ?>
				line-height: <?php echo $settings->heading_typography_line_height_unit_medium; ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-td {

			<?php if ( isset( $settings->content_typography_font_size_unit_medium ) && '' !== $settings->content_typography_font_size_unit_medium ) : ?>
				font-size: <?php echo $settings->content_typography_font_size_unit_medium; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->content_typography_line_height_unit_medium ) && '' !== $settings->content_typography_line_height_unit_medium ) : ?>
				line-height: <?php echo $settings->content_typography_line_height_unit_medium; ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .entries-wrapper .lbl-entries,
		.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter,
		.fl-node-<?php echo $id; ?> .search-wrapper,
		.fl-node-<?php echo $id; ?> .search-wrapper .search-input {

			<?php if ( isset( $settings->filter_typography_font_size_unit_medium ) && '' !== $settings->filter_typography_font_size_unit_medium ) : ?>
					font-size: <?php echo $settings->filter_typography_font_size_unit_medium; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->filter_typography_line_height_unit_medium ) && '' !== $settings->filter_typography_line_height_unit_medium ) : ?>
					line-height: <?php echo $settings->filter_typography_line_height_unit_medium; ?>em;
			<?php endif; ?>
		}
	}

	@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

		.fl-node-<?php echo $id; ?> .uabb-table {
			overflow-x:auto;
		}

		.fl-node-<?php echo $id; ?> .table-data {
			flex-direction: column;
			display: flex;
		}

		.fl-node-<?php echo $id; ?> .entries-wrapper,
		.fl-node-<?php echo $id; ?> .entries-wrapper .lbl-entries,
		.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter,
		.fl-node-<?php echo $id; ?> .search-wrapper,
		.fl-node-<?php echo $id; ?> .search-wrapper .search-input {
			display: block;
			width:100%;
			margin-bottom: 10px;
		}

		.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter,
		.fl-node-<?php echo $id; ?> .search-wrapper .search-input {
			margin-left: 0;
		}

		.fl-builder-content .fl-node-<?php echo $id; ?> .uabb-table-header .table-header-th {

			<?php if ( isset( $settings->heading_typography_font_size_unit_responsive ) && '' !== $settings->heading_typography_font_size_unit_responsive ) : ?>
					font-size: <?php echo $settings->heading_typography_font_size_unit_responsive; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->heading_typography_line_height_unit_responsive ) && '' !== $settings->heading_typography_line_height_unit_responsive ) : ?>
					line-height: <?php echo $settings->heading_typography_line_height_unit_responsive; ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .uabb-table-features .table-body-td {

			<?php if ( isset( $settings->content_typography_font_size_unit_responsive ) && '' !== $settings->content_typography_font_size_unit_responsive ) : ?>
					font-size: <?php echo $settings->content_typography_font_size_unit_responsive; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->content_typography_line_height_unit_responsive ) && '' !== $settings->content_typography_line_height_unit_responsive ) : ?>
					line-height: <?php echo $settings->content_typography_line_height_unit_responsive; ?>em;
			<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .entries-wrapper .lbl-entries,
		.fl-node-<?php echo $id; ?> .entries-wrapper .select-filter,
		.fl-node-<?php echo $id; ?> .search-wrapper,
		.fl-node-<?php echo $id; ?> .search-wrapper .search-input {

			<?php if ( isset( $settings->filter_typography_font_size_unit_responsive ) && '' !== $settings->filter_typography_font_size_unit_responsive ) : ?>
					font-size: <?php echo $settings->filter_typography_font_size_unit_responsive; ?>px;
			<?php endif; ?>

			<?php if ( isset( $settings->filter_typography_line_height_unit_responsive ) && '' !== $settings->filter_typography_line_height_unit_responsive ) : ?>
					line-height: <?php echo $settings->filter_typography_line_height_unit_responsive; ?>em;
			<?php endif; ?>
		}
	}
	<?php
}
?>
.fl-node-<?php echo $id; ?> .uabb-table {
	overflow-x:auto;
}


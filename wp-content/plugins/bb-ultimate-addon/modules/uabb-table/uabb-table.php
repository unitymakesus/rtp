<?php
/**
 *  UABB Table Module file
 *
 *  @package UABB Table Module
 */

/**
 * Function that initializes UABB Table Module
 *
 * @class UABBTable
 */
class UABBTable extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Table module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Table', 'uabb' ),
				'description'     => __( 'A simple Table.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$content_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-table/',
				'partial_refresh' => true,
				'icon'            => 'uabb-table.svg',
			)
		);

		add_filter( 'wp_handle_upload_prefilter', array( $this, 'uabb_csv_file_handle' ), 10, 1 );
	}
	/**
	 * Function to check CSV file extension in uabb-file type
	 *
	 * @since 1.12.0
	 * @method uabb_csv_file_handle
	 * @param string $file fetches the file.
	 */
	public function uabb_csv_file_handle( $file ) {

		if ( ! function_exists( 'get_current_screen()' ) ) {
			return $file;
		} else {
			if ( 'async-upload' === get_current_screen()->base ) {
				$type = isset( $_POST['uabb_upload_type'] ) ? $_POST['uabb_upload_type'] : false;

				$ext = pathinfo( $file['name'], PATHINFO_EXTENSION );

				$regex['uabb-file'] = '#(csv)#i';

				if ( 'uabb-file' === $type ) {
					if ( ! preg_match( $regex[ $type ], $ext ) ) {
						$file['error'] = sprintf( __( 'The uploaded file is not a valid CSV extension.', 'uabb' ), $type );
					}
				}
				return $file;
			}
		}
	}

	/**
	 * Function to get the icon for the Table
	 *
	 * @since 1.12.0
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// check if $icon is referencing an included icon.
		if ( '' != $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			$remove_icon = apply_filters( 'uabb_remove_svg_icon', false, 10, 1 );
			if ( true === $remove_icon ) {
				return;
			} else {
				return file_get_contents( $path );
			}
		} else {
			return '';
		}
	}

	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Compatibility::check_bb_version();
		$page_migrated           = UABB_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			// Headings link settings.
			foreach ( $settings->thead_row as $heading ) {

				if ( isset( $heading->head_link_nofollow ) ) {

					if ( '1' == $heading->head_link_nofollow || 'yes' == $heading->head_link_nofollow ) {
						$heading->head_link_nofollow = 'yes';
					}
				}
			}

			// Content link settings.
			foreach ( $settings->tbody_row as $content ) {

				if ( isset( $content->body_link_nofollow ) ) {
					if ( '1' == $content->body_link_nofollow || 'yes' == $content->body_link_nofollow ) {
						$content->body_link_nofollow = 'yes';
					}
				}
			}

			// compatibility for headings typography.
			if ( ! isset( $settings->heading_typo ) || ! is_array( $settings->heading_typo ) ) {

				$settings->heading_typo            = array();
				$settings->heading_typo_medium     = array();
				$settings->heading_typo_responsive = array();
			}
			if ( isset( $settings->heading_typography_font_family ) ) {

				if ( isset( $settings->heading_typography_font_family['family'] ) ) {

					$settings->heading_typo['font_family'] = $settings->heading_typography_font_family['family'];
					unset( $settings->heading_typography_font_family['family'] );
				}
				if ( isset( $settings->heading_typography_font_family['weight'] ) ) {

					if ( 'regular' == $settings->heading_typography_font_family['weight'] ) {
						$settings->heading_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_typo['font_weight'] = $settings->heading_typography_font_family['weight'];
					}
					unset( $settings->heading_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_typography_font_size_unit ) ) {

				$settings->heading_typo['font_size'] = array(
					'length' => $settings->heading_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->heading_typography_font_size_unit );
			}
			if ( isset( $settings->heading_typography_font_size_unit_medium ) ) {
				$settings->heading_typo_medium['font_size'] = array(
					'length' => $settings->heading_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->heading_typography_font_size_unit_medium );
			}
			if ( isset( $settings->heading_typography_font_size_unit_responsive ) ) {
				$settings->heading_typo_responsive['font_size'] = array(
					'length' => $settings->heading_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->heading_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->heading_typography_line_height_unit ) ) {

				$settings->heading_typo['line_height'] = array(
					'length' => $settings->heading_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->heading_typography_line_height_unit );
			}
			if ( isset( $settings->heading_typography_line_height_unit_medium ) ) {
				$settings->heading_typo_medium['line_height'] = array(
					'length' => $settings->heading_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->heading_typography_line_height_unit_medium );
			}
			if ( isset( $settings->heading_typography_line_height_unit_responsive ) ) {
				$settings->heading_typo_responsive['line_height'] = array(
					'length' => $settings->heading_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->heading_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->table_headings_typography_transform ) ) {

				$settings->heading_typo['text_transform'] = $settings->table_headings_typography_transform;
				unset( $settings->table_headings_typography_transform );
			}
			if ( isset( $settings->headings_align ) ) {

				$settings->heading_typo['text_align'] = $settings->headings_align;
				unset( $settings->headings_align );
			}
			if ( isset( $settings->table_headings_letter_spacing ) ) {

				$settings->heading_typo['letter_spacing'] = array(
					'length' => $settings->table_headings_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->table_headings_letter_spacing );
			}

			// For Content Typo.
			if ( ! isset( $settings->content_typo ) || ! is_array( $settings->content_typo ) ) {

				$settings->content_typo            = array();
				$settings->content_typo_medium     = array();
				$settings->content_typo_responsive = array();
			}
			if ( isset( $settings->content_typography_font_family ) ) {

				if ( isset( $settings->content_typography_font_family['family'] ) ) {

					$settings->content_typo['font_family'] = $settings->content_typography_font_family['family'];
					unset( $settings->content_typography_font_family['family'] );
				}
				if ( isset( $settings->content_typography_font_family['weight'] ) ) {

					if ( 'regular' == $settings->content_typography_font_family['weight'] ) {
						$settings->content_typo['font_weight'] = 'normal';
					} else {
						$settings->content_typo['font_weight'] = $settings->content_typography_font_family['weight'];
					}
					unset( $settings->content_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->content_typography_font_size_unit ) ) {

				$settings->content_typo['font_size'] = array(
					'length' => $settings->content_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->content_typography_font_size_unit );
			}
			if ( isset( $settings->content_typography_font_size_unit_medium ) ) {
				$settings->content_typo_medium['font_size'] = array(
					'length' => $settings->content_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->content_typography_font_size_unit_medium );
			}
			if ( isset( $settings->content_typography_font_size_unit_responsive ) ) {
				$settings->content_typo_responsive['font_size'] = array(
					'length' => $settings->content_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->content_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->content_typography_line_height_unit ) ) {

				$settings->content_typo['line_height'] = array(
					'length' => $settings->content_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->content_typography_line_height_unit );
			}
			if ( isset( $settings->content_typography_line_height_unit_medium ) ) {
				$settings->content_typo_medium['line_height'] = array(
					'length' => $settings->content_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->content_typography_line_height_unit_medium );
			}
			if ( isset( $settings->content_typography_line_height_unit_responsive ) ) {
				$settings->content_typo_responsive['line_height'] = array(
					'length' => $settings->content_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->content_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->table_rows_typography_transform ) ) {

				$settings->content_typo['text_transform'] = $settings->table_rows_typography_transform;
				unset( $settings->table_rows_typography_transform );
			}
			if ( isset( $settings->features_align ) ) {

				$settings->content_typo['text_align'] = $settings->features_align;
				unset( $settings->features_align );
			}
			if ( isset( $settings->table_rows_letter_spacing ) ) {

				$settings->content_typo['letter_spacing'] = array(
					'length' => $settings->table_rows_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->table_rows_letter_spacing );
			}

			// For Filter Typography.
			if ( ! isset( $settings->filter_typo ) || ! is_array( $settings->filter_typo ) ) {

				$settings->filter_typo            = array();
				$settings->filter_typo_medium     = array();
				$settings->filter_typo_responsive = array();
			}
			if ( isset( $settings->filter_typography_font_family ) ) {

				if ( isset( $settings->filter_typography_font_family['family'] ) ) {

					$settings->filter_typo['font_family'] = $settings->filter_typography_font_family['family'];
					unset( $settings->filter_typography_font_family['family'] );
				}
				if ( isset( $settings->filter_typography_font_family['weight'] ) ) {

					if ( 'regular' == $settings->filter_typography_font_family['weight'] ) {
						$settings->filter_typo['font_weight'] = 'normal';
					} else {
						$settings->filter_typo['font_weight'] = $settings->filter_typography_font_family['weight'];
					}
					unset( $settings->filter_typography_font_family['weight'] );
				}
			}
			if ( isset( $settings->filter_typography_font_size_unit ) ) {

				$settings->filter_typo['font_size'] = array(
					'length' => $settings->filter_typography_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->filter_typography_font_size_unit );
			}
			if ( isset( $settings->filter_typography_font_size_unit_medium ) ) {
				$settings->filter_typo_medium['font_size'] = array(
					'length' => $settings->filter_typography_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->filter_typography_font_size_unit_medium );
			}
			if ( isset( $settings->filter_typography_font_size_unit_responsive ) ) {
				$settings->filter_typo_responsive['font_size'] = array(
					'length' => $settings->filter_typography_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->filter_typography_font_size_unit_responsive );
			}
			if ( isset( $settings->filter_typography_line_height_unit ) ) {

				$settings->filter_typo['line_height'] = array(
					'length' => $settings->filter_typography_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->filter_typography_line_height_unit );
			}
			if ( isset( $settings->filter_typography_line_height_unit_medium ) ) {
				$settings->filter_typo_medium['line_height'] = array(
					'length' => $settings->filter_typography_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->filter_typography_line_height_unit_medium );
			}
			if ( isset( $settings->filter_typography_line_height_unit_responsive ) ) {
				$settings->filter_typo_responsive['line_height'] = array(
					'length' => $settings->filter_typography_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->filter_typography_line_height_unit_responsive );
			}
			if ( isset( $settings->table_filters_typography_transform ) ) {

				$settings->filter_typo['text_transform'] = $settings->table_filters_typography_transform;
				unset( $settings->table_filters_typography_transform );
			}
			if ( isset( $settings->table_filters_letter_spacing ) ) {

				$settings->filter_typo['letter_spacing'] = array(
					'length' => $settings->table_filters_letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->table_filters_letter_spacing );
			}
		}

		return $settings;
	}

	/**
	 * Parse table CSV file.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.12.0
	 * @access public
	 */
	public function parse_csv_file() {

		$csv_file_src = wp_get_attachment_url( $this->settings->file_src );

		if ( isset( $csv_file_src ) && '.csv' !== substr( $csv_file_src, -4 ) ) {

			$html = __( 'Please provide a valid CSV file.', 'uabb' );
			return $html;
		}

		$row        = array();
		$rows_count = array();
		$upload_dir = wp_upload_dir();
		$file_url   = str_replace( $upload_dir['baseurl'], '', $csv_file_src );

		$file = $upload_dir['basedir'] . $file_url;

		// Attempt to change permissions if not readable.
		if ( ! is_readable( $file ) ) {
			chmod( $file, 0744 );
		}

		// Check if file is writable, then open it in 'read only' mode.
		if ( is_readable( $file ) ) {

			$_file = fopen( $file, 'r' );

			if ( ! $_file ) {

				$html = __( "File could not be opened. Check the file's permissions to make sure it's readable by your server.", 'uabb' );

				return $html;
			}

			// To sum this part up, all it really does is go row by row.
			// Column by column, saving all the data.
			$file_data = array();

			// Get first row in CSV, which is of course the headers.
			$header = fgetcsv( $_file );

			while ( $row = fgetcsv( $_file ) ) {

				foreach ( $header as $i => $key ) {
					$file_data[ $key ] = $row[ $i ];
				}

				$data[] = $file_data;
			}

			fclose( $_file );

		} else {

			$html = __( "File could not be opened. Check the file's permissions to make sure it's readable by your server.", 'uabb' );

			return $html;
		}

		if ( is_array( $data ) ) {

			foreach ( $data as $key => $value ) {
				$rows[ $key ]       = $value;
				$rows_count[ $key ] = count( $value );
			}
		}

		$header_val = array_keys( $rows[0] );

		ob_start(); ?>

		<?php
		$counter           = 1;
		$cell_counter      = 0;
		$cell_inline_count = 0;
		$total_rows        = 0;
		?>

		<?php foreach ( $rows as $row_key => $row ) { ?>
			<tr>
				<?php $total_rows = $total_rows + 1; ?>
			</tr>
		<?php } ?>

		<div class="table-data">
			<?php if ( 'yes' === $this->settings->show_entries ) : ?>
				<div class="entries-wrapper">
					<label class="lbl-entries"><?php echo $this->settings->show_entries_label; ?> </label>
					<select class="select-filter">
						<option class="filter-entry"><?php echo $this->settings->show_entries_all_label; ?></option>
						<?php for ( $cnt = 1; $cnt < $total_rows; $cnt++ ) { ?>
							<option class="filter-entry"> <?php echo $cnt; ?> </option>
						<?php } ?>
					</select>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' === $this->settings->show_search ) : ?>
				<div class="search-wrapper">
					<input class="search-input" type="text" placeholder="<?php echo $this->settings->search_label; ?>" name="toSearch" id="searchHere"/>
				</div>
			<?php endif ?>
		</div>
		<div class="uabb-table-module-content uabb-table">
			<div class="uabb-table-element-box">
				<div class="uabb-table-wrapper">
					<div class="uabb-table">
						<table class="uabb-table-inner-wrap">
							<thead class="uabb-table-header">
								<?php
								if ( $header_val ) {
									?>
									<tr class="table-header-tr">
									<?php
									foreach ( $header_val as $hkey => $head ) {
										?>
										<th class="table-header-th table-heading-<?php echo $hkey; ?>">
											<label class="th-style"> <?php echo $head; ?> </label>
											<?php if ( 'yes' === $this->settings->show_sort ) { ?>
													<i class="uabb-sort-icon fa fa-sort"> </i>
												<?php } ?>
										</th>
										<?php
									}
								}
								?>
							</thead>
							<tbody class="uabb-table-features">
								<?php
									$counter           = 1;
									$cell_counter      = 0;
									$cell_inline_count = 0;
								?>
								<?php foreach ( $rows as $row_key => $row ) { ?>
									<tr class="tbody-row">
										<?php foreach ( $row as $bkey => $col ) { ?>
											<td class="table-body-td">
												<span class="content-text"> <?php echo $col; ?> </span>
											</td>
											<?php
												$cell_counter++;
												$counter++;
												$cell_inline_count++;
											?>
										<?php } ?>
									</tr>
								<?php } ?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php
		$html   = ob_get_clean();
		$return = $html;
		return $return;
	}

	/**
	 * Render table CSV file output.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.12.0
	 * @access public
	 */
	public function render() {
		$output = $this->parse_csv_file();
		echo $output;
	}

	/**
	 * Get help descriptions.
	 *
	 * @since 1.14.0
	 * @access public
	 * @param string $field get the field name.
	 */
	public static function get_description( $field ) {

		$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
		$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

		if ( empty( $branding_name ) && empty( $branding_short_name ) ) {

			if ( 'head_row_span' === $field ) {

				$heading_rowspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of rows this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple rows to see the result. Click <a href="https://www.ultimatebeaver.com/docs/how-to-merge-columns-and-rows-in-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to read article for more. </div>', 'uabb' )
				);

				return $heading_rowspan_description;
			}

			if ( 'head_col_span' === $field ) {

				$heading_colspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of columns this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple column cells to see the result. Click <a href="https://www.ultimatebeaver.com/docs/how-to-merge-columns-and-rows-in-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to read article for more. </div>', 'uabb' )
				);

				return $heading_colspan_description;
			}

			if ( 'custom_header_col_width' === $field ) {

				$custom_column_width = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> This width will be adopted by all the columns below this header cell. </div> <div class="uabb-table-description"> <b>Note: </b>Get more information about <a href="https://www.ultimatebeaver.com/docs/how-to-add-table-header/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> How custom width option works. </strong> </a> </div>', 'uabb' )
				);

				return $custom_column_width;
			}

			if ( 'body_row_span' === $field ) {

				$body_rowspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of rows this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple rows to see the result.  Click <a href="https://www.ultimatebeaver.com/docs/how-to-merge-columns-and-rows-in-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to read article for more. </div>', 'uabb' )
				);

				return $body_rowspan_description;
			}

			if ( 'body_col_span' === $field ) {

				$body_colspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of columns this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple column cells to see the result. Click <a href="https://www.ultimatebeaver.com/docs/how-to-merge-columns-and-rows-in-table/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> here</strong> </a> to read article for more. </div>', 'uabb' )
				);

				return $body_colspan_description;
			}

			if ( 'file_src' === $field ) {

				$csv_file_issue = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> <b>Note: </b> Facing issue with CSV importer? Please read this article for <a href="https://www.ultimatebeaver.com/docs/facing-issues-with-csv-import/?utm_source=uabb-pro-backend&utm_medium=module-editor-screen&utm_campaign=table-module" target="_blank" rel="noopener"> <strong> troubleshooting steps.</strong> </a> </div>', 'uabb' )
				);

				return $csv_file_issue;
			}
		} else {

			if ( 'head_row_span' === $field ) {

				$heading_rowspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of rows this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple rows to see the result. </div>', 'uabb' )
				);

				return $heading_rowspan_description;
			}

			if ( 'head_col_span' === $field ) {

				$heading_colspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of columns this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple column cells to see the result. </div>', 'uabb' )
				);

				return $heading_colspan_description;
			}

			if ( 'custom_header_col_width' === $field ) {

				$custom_column_width = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> This width will be adopted by all the columns below this header cell. </div>', 'uabb' )
				);

				return $custom_column_width;
			}

			if ( 'body_row_span' === $field ) {

				$body_rowspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of rows this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple rows to see the result. </div>', 'uabb' )
				);

				return $body_rowspan_description;
			}

			if ( 'body_col_span' === $field ) {

				$body_colspan_description = sprintf( /* translators: %s: search term */
					__( '<div class="uabb-table-description"> Specify the number of columns this cell should merge. </div> <div class="uabb-table-description"> <b>Note: </b> Add multiple column cells to see the result. </div>', 'uabb' )
				);

				return $body_colspan_description;
			}

			if ( 'file_src' === $field ) {

				$csv_file_issue = '';

				return $csv_file_issue;
			}
		}

		if ( 'show_sort' === $field ) {

			$sorting_description = sprintf( /* translators: %s: search term */
				__( '<div class="uabb-table-description"> <b>Note: </b>Sorting feature will not work with Rowspan or Colspan structure. It will misalign table layout.</div>', 'uabb' )
			);

			return $sorting_description;
		}
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table/uabb-table-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-table/uabb-table-bb-less-than-2-2-compatibility.php';
}


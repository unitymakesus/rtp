<?php
/**
 *  UABB Before After Slider Module front-end CSS php file
 *
 *  @package UABB Before After Slider Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

if ( isset( $settings->before_label_text ) && '' != $settings->before_label_text ) { ?>
	.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label:before
	{
		content: "<?php echo $settings->before_label_text; ?>";
	}
<?php } ?>

<?php if ( isset( $settings->after_label_text ) && '' != $settings->after_label_text ) { ?>
	.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label:before
	{
		content: "<?php echo $settings->after_label_text; ?>";
	}
<?php } ?>

<?php
$settings->handle_color          = UABB_Helper::uabb_colorpicker( $settings, 'handle_color' );
$settings->handle_triangle_color = UABB_Helper::uabb_colorpicker( $settings, 'handle_triangle_color' );
$settings->handle_color          = ( '' != $settings->handle_color ) ? $settings->handle_color : '#fff';
$settings->handle_triangle_color = ( '' != $settings->handle_triangle_color ) ? $settings->handle_triangle_color : $settings->handle_color;


$settings->slider_label_back_color = UABB_Helper::uabb_colorpicker( $settings, 'slider_label_back_color' );
$settings->slider_color            = UABB_Helper::uabb_colorpicker( $settings, 'slider_color' );
$settings->handle_back_overlay     = UABB_Helper::uabb_colorpicker( $settings, 'handle_back_overlay', true );
if ( isset( $settings->handle_shadow_color ) ) {
	$settings->handle_shadow_color = UABB_Helper::uabb_colorpicker( $settings, 'handle_shadow_color' );
}

?>

.fl-node-<?php echo $id; ?> .uabb-ba-container {
<?php
if ( 'center' == $settings->overall_alignment ) {
	?>
	margin: auto;
	<?php
} elseif ( 'left' == $settings->overall_alignment ) {
	?>
	margin-right: auto;
	<?php
} else {
	?>
	margin-left: auto;
	<?php
}
?>
}

<?php
if ( '' == $settings->handle_thickness ) {
	$settings->handle_thickness = 5; }
?>
<?php
if ( '' == $settings->handle_circle_width || '' == $settings->advance_opt ) {
	$settings->handle_circle_width = 40; }
?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle {
	border-color: <?php echo $settings->handle_color; ?>;
	<?php if ( '' != $settings->handle_thickness ) { ?>

	border-width:<?php echo $settings->handle_thickness; ?>px;
	<?php } ?>

	<?php
	if ( 'Y' == $settings->advance_opt && isset( $settings->handle_radius ) && '' == $settings->handle_radius ) {
		$settings->handle_radius = 100;
	}
	if ( 'Y' == $settings->advance_opt && '' != $settings->handle_radius ) {
		?>
	border-radius: <?php echo $settings->handle_radius; ?>px;
	<?php } ?>
	<?php
	if ( 'Y' == $settings->advance_opt && 'Y' == $settings->shadow_opt ) {
		if ( '' == $settings->handle_shadow ) {
			$settings->handle_shadow = 5;
		}
		if ( '' == $settings->handle_shadow_color ) {
			$settings->handle_shadow_color = '#fcfcfc';
		}
		?>
		webkit-box-shadow: 0px 0px <?php echo $settings->handle_shadow; ?>px <?php echo $settings->handle_shadow_color; ?>;
		-moz-box-shadow: 0px 0px <?php echo $settings->handle_shadow; ?>px <?php echo $settings->handle_shadow_color; ?>;
		box-shadow: 0px 0px <?php echo $settings->handle_shadow; ?>px <?php echo $settings->handle_shadow_color; ?>;
	<?php } ?>

	<?php if ( '' != $settings->handle_circle_width ) { ?>
	height: <?php echo $settings->handle_circle_width; ?>px;
	width: <?php echo $settings->handle_circle_width; ?>px;
	margin-left:-<?php echo $settings->handle_circle_width / 2; ?>px;
	margin-top:-<?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle:before{
	<?php if ( 'vertical' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>
		<?php if ( 45 != $settings->handle_circle_width ) { ?>
	margin-left: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } else { ?>
	margin-left: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color; ?>;
	<?php } ?>
	<?php if ( 'horizontal' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>

		<?php if ( 45 != $settings->handle_circle_width ) { ?>
	margin-bottom: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } else { ?>
	margin-bottom: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color; ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle:after{

	<?php if ( 'vertical' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>
		<?php if ( 45 != $settings->handle_circle_width ) { ?>
	margin-right: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } else { ?>
	margin-right: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color; ?>;
	<?php } ?>

	<?php if ( 'horizontal' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>

		<?php if ( 45 != $settings->handle_circle_width ) { ?>
	margin-top: <?php echo $settings->handle_circle_width / 2; ?>px;
	<?php } else { ?>
	margin-top: <?php echo $settings->handle_thickness + 10; ?>px;
	<?php } ?>

	box-shadow: 0 0 0 <?php echo $settings->handle_color; ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle:before,
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle:after {
	background: <?php echo $settings->handle_color; ?>;

	<?php if ( 'vertical' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>
	height: <?php echo $settings->handle_thickness; ?>px;
	margin-top: -<?php echo $settings->handle_thickness / 2; ?>px;
	<?php } ?>
	<?php if ( 'horizontal' == $settings->before_after_orientation && '' != $settings->handle_thickness ) { ?>
	width: <?php echo $settings->handle_thickness; ?>px;
	margin-left: -<?php echo $settings->handle_thickness / 2; ?>px;
	<?php } ?>
}
<?php
if ( 'false' == $settings->move_on_hover ) {
	?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-overlay:hover {
	background: <?php echo $settings->handle_back_overlay; ?>;
}
	<?php
}
?>

<?php
if ( 'Y' == $settings->advance_opt && 'vertical' == $settings->before_after_orientation ) {
	if ( '' != $settings->handle_triangle_size ) {
		$triangle_size = $settings->handle_triangle_size;
	} else {
		$triangle_size = 6; }
	?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-up-arrow {
	border-bottom: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_triangle_color; ?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-down-arrow {
	border-top: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_triangle_color; ?>;
}
	<?php
}
if ( 'Y' == $settings->advance_opt && 'horizontal' == $settings->before_after_orientation ) {
	if ( '' != $settings->handle_triangle_size ) {
		$triangle_size = $settings->handle_triangle_size;
	} else {
		$triangle_size = 6; }
	?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-left-arrow {
	border-right: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_triangle_color; ?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-right-arrow {
	border-left: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_triangle_color; ?>;
}
	<?php
}

if ( 'Y' == $settings->advance_opt ) {
	?>
.fl-node-<?php echo $id; ?> .twentytwenty-left-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-right-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-up-arrow,
.fl-node-<?php echo $id; ?> .twentytwenty-down-arrow {
	border: <?php echo $triangle_size; ?>px inset transparent;
}
	<?php
}

if ( '' == $settings->advance_opt && 'vertical' == $settings->before_after_orientation ) {
	$triangle_size = 6;
	?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-up-arrow {
	border-bottom: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_color; ?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-down-arrow {
	border-top: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_color; ?>;
}
	<?php
}
if ( '' == $settings->advance_opt && 'horizontal' == $settings->before_after_orientation ) {
	$triangle_size = 6;
	?>
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-left-arrow {
	border-right: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_color; ?>;
}
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-handle .twentytwenty-right-arrow {
	border-left: <?php echo $triangle_size; ?>px solid <?php echo $settings->handle_color; ?>;
}
<?php } ?>

.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label,
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label {
	<?php
	if ( 'horizontal' == $settings->before_after_orientation ) :
		if ( isset( $settings->slider_label_position ) && 'center' == $settings->slider_label_position ) :
			?>
			-webkit-box-align:center;
			-ms-flex-align:center;
			-ms-grid-row-align:center;
			align-items:center;
		<?php endif; ?>
		<?php if ( isset( $settings->slider_label_position ) && 'top' == $settings->slider_label_position ) : ?>
			-webkit-box-align:start;
			-ms-flex-align:start;
			-ms-grid-row-align:flex-start;
			align-items:flex-start;
			margin-top:10px;
		<?php endif; ?>
		<?php if ( isset( $settings->slider_label_position ) && 'bottom' == $settings->slider_label_position ) : ?>
			-webkit-box-align:end;
			-ms-flex-align:end;
			-ms-grid-row-align:flex-end;
			align-items:flex-end;
			padding-bottom:10px;
		<?php endif; ?>
	<?php endif; ?>

	<?php
	if ( 'vertical' == $settings->before_after_orientation ) :
		if ( isset( $settings->slider_vertical_label_position ) && 'center' == $settings->slider_vertical_label_position ) :
			?>
			justify-content:center;
		<?php endif; ?>
		<?php if ( isset( $settings->slider_vertical_label_position ) && 'left' == $settings->slider_vertical_label_position ) : ?>
			justify-content:flex-start;
			padding-left:10px;
		<?php endif; ?>
		<?php if ( isset( $settings->slider_vertical_label_position ) && 'right' == $settings->slider_vertical_label_position ) : ?>
			justify-content:flex-end;
			padding-right:10px;
		<?php endif; ?>
	<?php endif; ?>
}

<?php
if ( isset( $settings->slider_label_padding ) && '' == $settings->slider_label_padding ) {
	$settings->slider_label_padding = 10; }
if ( isset( $settings->slider_label_letter_spacing ) && '' == $settings->slider_label_letter_spacing ) {
	$settings->slider_label_letter_spacing = 1; }
/* Typography style */

if ( ! $version_bb_check ) {

	if ( ( isset( $settings->slider_font_family['family'] ) && 'Default' != $settings->slider_font_family['family'] ) || isset( $settings->slider_font_size['desktop'] ) || isset( $settings->slider_line_height['desktop'] ) || ( isset( $settings->slider_font_size_unit ) ) || ( isset( $settings->slider_line_height_unit ) ) || ( isset( $settings->slider_color ) && '' != $settings->slider_color ) || ( isset( $settings->slider_label_back_color ) && '' != $settings->slider_label_back_color ) || ( isset( $settings->slider_label_padding ) && '' != $settings->slider_label_padding ) || ( isset( $settings->slider_label_letter_spacing ) && '' != $settings->slider_label_letter_spacing ) ) {
		?>

.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label:before,
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label:before {
		<?php if ( isset( $settings->slider_font_family['family'] ) && 'Default' != $settings->slider_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->slider_font_family ); ?>
	<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->slider_font_size_unit ) && '' != $settings->slider_font_size_unit ) { ?>
		font-size: <?php echo $settings->slider_font_size_unit; ?>px;
	<?php } elseif ( isset( $settings->slider_font_size_unit ) && '' == $settings->slider_font_size_unit && isset( $settings->slider_font_size['desktop'] ) && '' != $settings->slider_font_size['desktop'] ) { ?>
		font-size: <?php echo $settings->slider_font_size['desktop']; ?>px;
	<?php } ?>

		<?php if ( isset( $settings->slider_font_size['desktop'] ) && '' == $settings->slider_font_size['desktop'] && isset( $settings->slider_line_height['desktop'] ) && '' != $settings->slider_line_height['desktop'] && '' == $settings->slider_line_height_unit ) { ?>
		line-height: <?php echo $settings->slider_line_height['desktop']; ?>px;
	<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->slider_line_height_unit ) && '' != $settings->slider_line_height_unit ) { ?>
		line-height: <?php echo $settings->slider_line_height_unit; ?>em;
	<?php } elseif ( isset( $settings->slider_line_height_unit ) && '' == $settings->slider_line_height_unit && isset( $settings->slider_line_height['desktop'] ) && '' != $settings->slider_line_height['desktop'] ) { ?>
		line-height: <?php echo $settings->slider_line_height['desktop']; ?>px;
	<?php } ?>
		<?php if ( isset( $settings->slider_label_letter_spacing ) && '' != $settings->slider_label_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->slider_label_letter_spacing; ?>px;
	<?php endif; ?>
		<?php if ( 'none' != $settings->slider_transform ) : ?>
		text-transform: <?php echo $settings->slider_transform; ?>;
	<?php endif; ?>
}
	<?php } ?>
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'slider_typo',
				'selector'     => ".fl-node-$id .baslider-$module->node .twentytwenty-before-label:before,.fl-node-$id .baslider-$module->node .twentytwenty-after-label:before",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label:before,
.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label:before {
	<?php if ( isset( $settings->slider_color ) && '' != $settings->slider_color ) : ?>
		color: <?php echo $settings->slider_color; ?>;
	<?php endif; ?>
	<?php if ( isset( $settings->slider_label_back_color ) && '' != $settings->slider_label_back_color ) : ?>
		background: <?php echo $settings->slider_label_back_color; ?>;
	<?php endif; ?>
	<?php if ( 'horizontal' == $settings->before_after_orientation ) { ?>
		max-width: calc( 100% / 2 - 30px );
	<?php } elseif ( 'vertical' == $settings->before_after_orientation ) { ?>
		max-width: calc( 100% - 30px );
	<?php } ?>
	width: auto;
	<?php if ( isset( $settings->slider_label_padding ) && '' != $settings->slider_label_padding ) : ?>
		padding: <?php echo $settings->slider_label_padding; ?>px;
	<?php endif; ?>
}
/* Typography responsive layout starts here */
<?php if ( ! $version_bb_check ) { ?>
	<?php
	if ( $global_settings->responsive_enabled ) { // Global Setting If started.
		if ( isset( $settings->slider_font_size['medium'] ) || isset( $settings->slider_line_height['medium'] ) || isset( $settings->slider_font_size_unit_medium ) || isset( $settings->slider_line_height_unit_medium ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

					.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label:before,
					.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label:before {

						<?php if ( 'yes' === $converted || isset( $settings->slider_font_size_unit_medium ) && '' != $settings->slider_font_size_unit_medium ) { ?>
							font-size: <?php echo $settings->slider_font_size_unit_medium; ?>px;
						<?php } elseif ( isset( $settings->slider_font_size_unit_medium ) && '' == $settings->slider_font_size_unit_medium && isset( $settings->slider_font_size['medium'] ) && '' != $settings->slider_font_size['medium'] ) { ?>
							font-size: <?php echo $settings->slider_font_size['medium']; ?>px;
						<?php } ?>

						<?php if ( isset( $settings->slider_font_size['medium'] ) && '' == $settings->slider_font_size['medium'] && isset( $settings->slider_line_height['medium'] ) && '' != $settings->slider_line_height['medium'] && '' == $settings->slider_line_height_unit_medium && '' == $settings->slider_line_height_unit ) { ?>
							line-height: <?php echo $settings->slider_line_height['medium']; ?>px;
						<?php } ?>

						<?php if ( 'yes' === $converted || isset( $settings->slider_line_height_unit_medium ) && '' != $settings->slider_line_height_unit_medium ) { ?>
							line-height: <?php echo $settings->slider_line_height_unit_medium; ?>em;
						<?php } elseif ( isset( $settings->slider_line_height_unit_medium ) && '' == $settings->slider_line_height_unit_medium && isset( $settings->slider_line_height['medium'] ) && '' != $settings->slider_line_height['medium'] ) { ?>
							line-height: <?php echo $settings->slider_line_height['medium']; ?>px;
						<?php } ?>
					}
			}
			<?php
		}

		if ( isset( $settings->slider_font_size['small'] ) || isset( $settings->slider_line_height['small'] ) || isset( $settings->slider_font_size_unit_responsive ) || isset( $settings->slider_line_height_unit_responsive ) || ( isset( $settings->mobile_view ) && 'stack' == $settings->mobile_view ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-before-label:before,
				.fl-node-<?php echo $id; ?> .baslider-<?php echo $module->node; ?> .twentytwenty-after-label:before {

					<?php if ( 'yes' === $converted || isset( $settings->slider_font_size_unit_responsive ) && '' != $settings->slider_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->slider_font_size_unit_responsive; ?>px;
					<?php } elseif ( isset( $settings->slider_font_size_unit_responsive ) && '' == $settings->slider_font_size_unit_responsive && isset( $settings->slider_font_size['small'] ) && '' != $settings->slider_font_size['small'] ) { ?>
						font-size: <?php echo $settings->slider_font_size['small']; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->slider_font_size['small'] ) && '' == $settings->slider_font_size['small'] && isset( $settings->slider_line_height['small'] ) && '' != $settings->slider_line_height['small'] && '' == $settings->slider_line_height_unit_responsive && '' == $settings->slider_line_height_unit_medium && '' == $settings->slider_line_height_unit ) { ?>
						line-height: <?php echo $settings->slider_line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->slider_line_height_unit_responsive ) && '' != $settings->slider_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->slider_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->slider_line_height_unit_responsive ) && '' == $settings->slider_line_height_unit_responsive && isset( $settings->slider_line_height['small'] ) && '' != $settings->slider_line_height['small'] ) { ?>
						line-height: <?php echo $settings->slider_line_height['small']; ?>px;
					<?php } ?>
				}
			}
			<?php
		}
	}
}
?>
/* Typography responsive layout Ends here */

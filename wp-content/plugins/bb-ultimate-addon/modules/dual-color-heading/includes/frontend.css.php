<?php
/**
 * Register the module's CSS file for Dual Color Heading module
 *
 * @package UABB Dual Color Heading Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->first_heading_color  = UABB_Helper::uabb_colorpicker( $settings, 'first_heading_color' );
$settings->second_heading_color = UABB_Helper::uabb_colorpicker( $settings, 'second_heading_color' );
?>
/* First heading styling */
<?php if ( '' != $settings->first_heading_color || 'yes' == $settings->add_spacing_option ) { ?>

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-first-heading-text {
	<?php if ( ! empty( $settings->first_heading_color ) ) { ?>
		color: <?php echo $settings->first_heading_color; ?>;
	<?php } ?>
	<?php
	if ( 'yes' === $settings->add_spacing_option ) {
		?>
		margin-right:<?php echo ( isset( $settings->heading_margin ) && '' != $settings->heading_margin ) ? $settings->heading_margin . 'px' : '10px'; ?>;
		<?php
	}
	?>
}
<?php } ?>

<?php if ( 'yes' === $settings->add_spacing_option ) { ?>
	[dir="rtl"] .fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-first-heading-text {
		margin-left:<?php echo ( isset( $settings->heading_margin ) && '' != $settings->heading_margin ) ? $settings->heading_margin . 'px' : '10px'; ?>;
		margin-right: 0;
	}
<?php } ?>

<?php if ( 'yes' === $settings->add_spacing_option ) { ?>
	[dir="ltr"] .fl-node-<?php echo $id; ?> .uabb-dual-color-heading .uabb-first-heading-text {
		margin-right:<?php echo ( isset( $settings->heading_margin ) && '' != $settings->heading_margin ) ? $settings->heading_margin . 'px' : '10px'; ?>;
		margin-left: 0;
	}
<?php } ?>


/* Second heading styling */
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-module-content.uabb-dual-color-heading .uabb-second-heading-text {
	color: <?php echo uabb_theme_base_color( $settings->second_heading_color ); ?>;
}

/* Alignment styling */
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.left {	text-align: left; }
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.right { text-align: right; }
.fl-node-<?php echo $id; ?> .uabb-dual-color-heading.center { text-align: center; }


/* Typography styling for desktop */


<?php
if ( ! $version_bb_check ) {
	if ( 'Default' != $settings->dual_font_family['family'] || isset( $settings->dual_font_size['desktop'] ) || isset( $settings->dual_line_height['desktop'] ) || isset( $settings->dual_font_size_unit ) || isset( $settings->dual_line_height_unit ) || isset( $settings->dual_transform ) || isset( $settings->dual_letter_spacing ) ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {
				<?php if ( 'Default' != $settings->dual_font_family['family'] ) : ?>
					<?php UABB_Helper::uabb_font_css( $settings->dual_font_family ); ?>
				<?php endif; ?>
			<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit ) && '' != $settings->dual_font_size_unit ) { ?>
				font-size: <?php echo $settings->dual_font_size_unit; ?>px;		
			<?php } elseif ( isset( $settings->dual_font_size_unit ) && '' == $settings->dual_font_size_unit && isset( $settings->dual_font_size['desktop'] ) && '' != $settings->dual_font_size['desktop'] ) { ?>
				font-size: <?php echo $settings->dual_font_size['desktop']; ?>px;
			<?php } ?>

			<?php if ( isset( $settings->dual_font_size['desktop'] ) && '' == $settings->dual_font_size['desktop'] && isset( $settings->dual_line_height['desktop'] ) && '' != $settings->dual_line_height['desktop'] && '' == $settings->dual_line_height_unit ) { ?>
				line-height: <?php echo $settings->dual_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit ) && '' != $settings->dual_line_height_unit ) { ?>
				line-height: <?php echo $settings->dual_line_height_unit; ?>em;	
			<?php } elseif ( isset( $settings->dual_line_height_unit ) && '' == $settings->dual_line_height_unit && isset( $settings->dual_line_height['desktop'] ) && '' != $settings->dual_line_height['desktop'] ) { ?>
				line-height: <?php echo $settings->dual_line_height['desktop']; ?>px;
			<?php } ?>

			<?php if ( 'none' != $settings->dual_transform ) : ?>
				text-transform: <?php echo $settings->dual_transform; ?>;
			<?php endif; ?>

			<?php if ( '' != $settings->dual_letter_spacing ) : ?>
				letter-spacing: <?php echo $settings->dual_letter_spacing; ?>px;
			<?php endif; ?>
		}
		<?php
	}
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'dual_typo',
				'selector'     => ".fl-node-$id .uabb-dual-color-heading *",
			)
		);
	}
}
?>
/* Typography responsive layout starts here */ 


<?php
if ( $global_settings->responsive_enabled ) { // Global Setting If started.
	if ( ! $version_bb_check ) {
		if ( isset( $settings->dual_font_size['medium'] ) || isset( $settings->dual_line_height['medium'] ) || isset( $settings->dual_font_size_unit_medium ) || isset( $settings->dual_line_height_unit_medium ) || 'uabb-responsive-medsmall' == $settings->responsive_compatibility || isset( $settings->dual_line_height_unit ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
				.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {

				<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit_medium ) && '' != $settings->dual_font_size_unit_medium ) { ?>
					font-size: <?php echo $settings->dual_font_size_unit_medium; ?>px;
				<?php } elseif ( isset( $settings->dual_font_size_unit_medium ) && '' == $settings->dual_font_size_unit_medium && isset( $settings->dual_font_size['medium'] ) && '' != $settings->dual_font_size['medium'] ) { ?>
					font-size: <?php echo $settings->dual_font_size['medium']; ?>px;
				<?php } ?>

				<?php if ( isset( $settings->dual_font_size['medium'] ) && '' == $settings->dual_font_size['medium'] && isset( $settings->dual_line_height['medium'] ) && '' != $settings->dual_line_height['medium'] && '' == $settings->dual_line_height_unit_medium && '' == $settings->dual_line_height_unit ) { ?>
					line-height: <?php echo $settings->dual_line_height['medium']; ?>px;
				<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit_medium ) && '' != $settings->dual_line_height_unit_medium ) { ?>
					line-height: <?php echo $settings->dual_line_height_unit_medium; ?>em;	
				<?php } elseif ( isset( $settings->dual_line_height_unit_medium ) && '' == $settings->dual_line_height_unit_medium && isset( $settings->dual_line_height['medium'] ) && '' != $settings->dual_line_height['medium'] ) { ?>
					line-height: <?php echo $settings->dual_line_height['medium']; ?>px;
				<?php } ?>
				}
			}
			<?php
		}
	} else {
		?>
	@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {
		<?php if ( 'uabb-responsive-medsmall' == $settings->responsive_compatibility ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-first-heading-text,
			.fl-node-<?php echo $id; ?> .uabb-responsive-medsmall .uabb-second-heading-text {
				display: inline-block;
			}
		<?php } ?>
	}
<?php } ?>
	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->dual_font_size['small'] ) || isset( $settings->dual_line_height['small'] ) || isset( $settings->dual_font_size_unit_responsive ) || isset( $settings->dual_line_height_unit_responsive ) || isset( $settings->dual_line_height_unit_medium ) || isset( $settings->dual_line_height_unit ) || 'uabb-responsive-mobile' == $settings->responsive_compatibility ) {
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				.fl-node-<?php echo $id; ?> .uabb-dual-color-heading * {

			<?php if ( 'yes' === $converted || isset( $settings->dual_font_size_unit_responsive ) && '' != $settings->dual_font_size_unit_responsive ) { ?>
					font-size: <?php echo $settings->dual_font_size_unit_responsive; ?>px;	
				<?php } elseif ( $settings->dual_font_size_unit_responsive && '' == $settings->dual_font_size_unit_responsive && isset( $settings->dual_font_size['small'] ) && '' != $settings->dual_font_size['small'] ) { ?>
					font-size: <?php echo $settings->dual_font_size['small']; ?>px;
				<?php } ?>  

			<?php if ( isset( $settings->dual_font_size['small'] ) && '' == $settings->dual_font_size['small'] && isset( $settings->dual_line_height['small'] ) && '' != $settings->dual_line_height['small'] && '' == $settings->dual_line_height_unit_responsive && '' == $settings->dual_line_height_unit_medium && '' == $settings->dual_line_height_unit ) : ?>
					line-height: <?php echo $settings->dual_line_height['small']; ?>px;
				<?php endif; ?>

			<?php if ( 'yes' === $converted || isset( $settings->dual_line_height_unit_responsive ) && '' != $settings->dual_line_height_unit_responsive ) { ?>
					line-height: <?php echo $settings->dual_line_height_unit_responsive; ?>em;
				<?php } elseif ( isset( $settings->dual_line_height_unit_responsive ) && '' == $settings->dual_line_height_unit_responsive && isset( $settings->dual_line_height['small'] ) && '' != $settings->dual_line_height['small'] ) { ?>
					line-height: <?php echo $settings->dual_line_height['small']; ?>px;
				<?php } ?>

			}
				.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-first-heading-text,
				.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-second-heading-text {
					display: inline-block;
				}
			}
			<?php
		}
	} else {
		?>
		@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
			<?php if ( 'uabb-responsive-mobile' == $settings->responsive_compatibility ) { ?>
				fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-first-heading-text,
				.fl-node-<?php echo $id; ?> .uabb-responsive-mobile .uabb-second-heading-text {
					display: inline-block;
				}
			<?php } ?>
		}
		<?php } ?>
	<?php
}
?>

/* Typography responsive layout Ends here */

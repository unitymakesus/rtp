<?php
/**
 *  UABB Fancy Text Module front-end CSS php file
 *
 *  @package UABB Fancy Text Module
 */

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

$settings->color       = UABB_Helper::uabb_colorpicker( $settings, 'color' );
$settings->fancy_color = UABB_Helper::uabb_colorpicker( $settings, 'fancy_color' );

?>

.fl-node-<?php echo $id; ?> .uabb-fancy-text-wrap {
	text-align: <?php echo $settings->alignment; ?>;
	<?php if ( 'type' == $settings->effect_type ) { ?>
	min-height: <?php echo $settings->min_height; ?>px;
	<?php } ?>
}

<?php if ( ! empty( $settings->prefix ) ) { ?>
.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix {
	margin-right:<?php echo $settings->space_prefix; ?>px;
}
<?php } ?>

<?php if ( ! empty( $settings->suffix ) ) { ?>
.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix {
	margin-left:<?php echo $settings->space_suffix; ?>px;
}
<?php } ?>
/* Prefix - Suffix Typography */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
	.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix {
		<?php if ( 'Default' != $settings->font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->font_size_unit ) && '' != $settings->font_size_unit ) { ?>
			font-size: <?php echo $settings->font_size_unit; ?>px;
			<?php if ( '' == $settings->line_height_unit && '' != $settings->font_size_unit ) { ?>
				line-height: <?php echo $settings->font_size_unit + 2; ?>px;
			<?php } ?>		
		<?php } elseif ( isset( $settings->font_size_unit ) && '' == $settings->font_size_unit && isset( $settings->font_size['desktop'] ) && '' != $settings->font_size['desktop'] ) { ?>
			font-size: <?php echo $settings->font_size['desktop']; ?>px;
			line-height: <?php echo $settings->font_size['desktop'] + 2; ?>px;
		<?php } ?>

		<?php if ( isset( $settings->font_size['desktop'] ) && '' == $settings->font_size['desktop'] && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] && '' == $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->line_height_unit ) && '' != $settings->line_height_unit ) { ?>
			line-height: <?php echo $settings->line_height_unit; ?>em;	
		<?php } elseif ( isset( $settings->line_height_unit ) && '' == $settings->line_height_unit && isset( $settings->line_height['desktop'] ) && '' != $settings->line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( '' != $settings->color ) : ?>
		color: <?php echo $settings->color; ?>;
		<?php endif; ?>

		<?php if ( 'none' != $settings->transform ) : ?>
			text-transform: <?php echo $settings->transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'static_text_typo',
				'selector'     => ".fl-node-$id .uabb-fancy-text-prefix,.fl-node-$id .uabb-fancy-text-suffix",
			)
		);
	}
	?>
	.fl-node-<?php echo $id; ?> .uabb-module-content .uabb-fancy-text-wrap .uabb-fancy-text-prefix,
	.fl-node-<?php echo $id; ?> .uabb-module-content .uabb-fancy-text-wrap .uabb-fancy-text-suffix {
		color: <?php echo $settings->color; ?>;
	}
<?php } ?>
/* Fancy Text Typography */
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {
		<?php if ( 'Default' != $settings->fancy_font_family['family'] ) : ?>
			<?php UABB_Helper::uabb_font_css( $settings->fancy_font_family ); ?>
		<?php endif; ?>

		<?php if ( 'yes' === $converted || isset( $settings->fancy_font_size_unit ) && '' != $settings->fancy_font_size_unit ) { ?>
			font-size: <?php echo $settings->fancy_font_size_unit; ?>px;
			<?php if ( '' == $settings->fancy_line_height_unit && '' != $settings->fancy_font_size_unit ) { ?>
				line-height: <?php echo $settings->fancy_font_size_unit + 2; ?>px;
			<?php } ?>	
		<?php } elseif ( isset( $settings->fancy_font_size_unit ) && '' == $settings->fancy_font_size_unit && isset( $settings->fancy_font_size['desktop'] ) && '' != $settings->fancy_font_size['desktop'] ) { ?> 
			font-size: <?php echo $settings->fancy_font_size['desktop']; ?>px;
			line-height: <?php echo $settings->fancy_font_size['desktop'] + 2; ?>px;
		<?php } ?> 

		<?php if ( isset( $settings->fancy_font_size['desktop'] ) && '' == $settings->fancy_font_size['desktop'] && isset( $settings->fancy_line_height['desktop'] ) && '' != $settings->fancy_line_height['desktop'] && '' == $settings->fancy_line_height_unit ) { ?>
			line-height: <?php echo $settings->fancy_line_height['desktop']; ?>px;
		<?php } ?>

		<?php if ( 'yes' === $converted || isset( $settings->fancy_line_height_unit ) && '' != $settings->fancy_line_height_unit ) { ?>
			line-height: <?php echo $settings->fancy_line_height_unit; ?>em;
		<?php } elseif ( isset( $settings->fancy_line_height_unit ) && '' == $settings->fancy_line_height_unit && isset( $settings->fancy_line_height['desktop'] ) && '' != $settings->fancy_line_height['desktop'] ) { ?>
			line-height: <?php echo $settings->fancy_line_height['desktop']; ?>px;
		<?php } ?> 
		<?php if ( 'none' != $settings->fancy_transform ) : ?>
			text-transform: <?php echo $settings->fancy_transform; ?>;
		<?php endif; ?>

		<?php if ( '' != $settings->fancy_letter_spacing ) : ?>
			letter-spacing: <?php echo $settings->fancy_letter_spacing; ?>px;
		<?php endif; ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		FLBuilderCSS::typography_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'fancy_text_typo',
				'selector'     => ".fl-node-$id .uabb-fancy-text-main",
			)
		);
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-fancy-text-wrap .uabb-fancy-text-main .uabb-slide_text,
.fl-node-<?php echo $id; ?> .uabb-fancy-text-wrap .uabb-fancy-text-main .uabb-typed-main,
.fl-node-<?php echo $id; ?> .uabb-module-content .uabb-fancy-text-wrap .uabb-fancy-text-main {
	<?php if ( '' != $settings->fancy_color ) : ?>
		color: <?php echo $settings->fancy_color; ?>;
	<?php endif; ?>
}
<?php
if ( 'type' == $settings->effect_type && 'yes' == $settings->show_cursor && 'yes' == $settings->cursor_blink ) {
	?>
	.uabb-fancy-text-wrap .typed-cursor{
		opacity: 1;
		-webkit-animation: blink-cursor 0.7s infinite;
		-moz-animation: blink-cursor 0.7s infinite;
		animation: blink-cursor 0.7s infinite;
	}
	@keyframes blink-cursor{
		0% { opacity:1; }
		50% { opacity:0; }
		100% { opacity:1; }
	}
	@-webkit-keyframes blink-cursor{
		0% { opacity:1; }
		50% { opacity:0; }
		100% { opacity:1; }
	}
	@-moz-keyframes blink-cursor{
		0% { opacity:1; }
		50% { opacity:0; }
		100% { opacity:1; }
	}
<?php } ?>

/* Typography responsive layout starts here */

<?php if ( $global_settings->responsive_enabled ) { // Global Setting If started. ?>

	@media ( min-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
		.fl-node-<?php echo $id; ?> span.uabb-slide_text {
			white-space: nowrap;
		}
	}

	<?php
	if ( ! $version_bb_check ) {
		if ( isset( $settings->fancy_font_size['medium'] ) || isset( $settings->fancy_line_height['medium'] ) || isset( $settings->font_size['medium'] ) || isset( $settings->line_height['medium'] ) ||
			isset( $settings->fancy_font_size_unit_medium ) || isset( $settings->fancy_line_height_unit_medium ) || isset( $settings->font_size_unit_medium ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height_unit ) || isset( $settings->fancy_line_height_unit ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->medium_breakpoint . 'px'; ?> ) {

				.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
				.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix{

				<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_medium ) && '' != $settings->font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->line_height_unit_medium && '' != $settings->font_size_unit_medium ) { ?>
							line-height: <?php $settings->font_size_unit_medium + 2; ?>px;
						<?php } ?>	
					<?php } elseif ( isset( $settings->font_size_unit_medium ) && '' == $settings->font_size_unit_medium && isset( $settings->font_size['medium'] ) && '' != $settings->font_size['medium'] ) { ?>
						font-size: <?php echo $settings->font_size['medium']; ?>px;
						line-height: <?php $settings->font_size['medium'] + 2; ?>px;
					<?php } ?> 

				   
				<?php if ( isset( $settings->font_size['medium'] ) && '' == $settings->font_size['medium'] && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_medium ) && '' != $settings->line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->line_height_unit_medium; ?>em;	
					<?php } elseif ( isset( $settings->line_height_unit_medium ) && '' == $settings->line_height_unit_medium && isset( $settings->line_height['medium'] ) && '' != $settings->line_height['medium'] ) { ?>
						line-height: <?php echo $settings->line_height['medium']; ?>px;
					<?php } ?>
				}

				.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {

				<?php if ( 'yes' === $converted || isset( $settings->fancy_font_size_unit_medium ) && '' != $settings->fancy_font_size_unit_medium ) { ?>
						font-size: <?php echo $settings->fancy_font_size_unit_medium; ?>px;
						<?php if ( '' == $settings->fancy_line_height_unit_medium && '' != $settings->fancy_font_size_unit_medium ) { ?>
							line-height: <?php $settings->fancy_font_size_unit_medium + 2; ?>px;
						<?php } ?>	
					<?php } elseif ( isset( $settings->fancy_font_size_unit_medium ) && '' == $settings->fancy_font_size_unit_medium && isset( $settings->fancy_font_size['medium'] ) && '' != $settings->fancy_font_size['medium'] ) { ?>
						font-size: <?php echo $settings->fancy_font_size['medium']; ?>px;
						line-height: <?php $settings->fancy_font_size['medium'] + 2; ?>px;
					<?php } ?>

				<?php if ( isset( $settings->fancy_font_size['medium'] ) && '' == $settings->fancy_font_size['medium'] && isset( $settings->fancy_line_height['medium'] ) && '' != $settings->fancy_line_height['medium'] && '' == $settings->fancy_line_height_unit_medium && '' == $settings->fancy_line_height_unit ) { ?>
						line-height: <?php echo $settings->fancy_line_height['medium']; ?>px;
					<?php } ?>

				<?php if ( 'yes' === $converted || isset( $settings->fancy_line_height_unit_medium ) && '' != $settings->fancy_line_height_unit_medium ) { ?>
						line-height: <?php echo $settings->fancy_line_height_unit_medium; ?>em;	
					<?php } elseif ( isset( $settings->fancy_line_height_unit_medium ) && '' == $settings->fancy_line_height_unit_medium && isset( $settings->fancy_line_height['medium'] ) && '' != $settings->fancy_line_height['medium'] ) { ?>
						line-height: <?php echo $settings->fancy_line_height['medium']; ?>px;
					<?php } ?>

				}
			}
			<?php
		}
	}
	if ( ! $version_bb_check ) {
		if ( isset( $settings->fancy_font_size['small'] ) || isset( $settings->fancy_line_height['small'] ) || isset( $settings->font_size['small'] ) || isset( $settings->line_height['small'] ) ||
		isset( $settings->fancy_font_size_unit_responsive ) || isset( $settings->fancy_line_height_unit_responsive ) || isset( $settings->fancy_line_height_unit_medium ) || isset( $settings->font_size_unit_responsive ) || isset( $settings->line_height_unit_responsive ) || isset( $settings->line_height_unit_medium ) || isset( $settings->line_height_unit ) || isset( $settings->fancy_line_height_unit ) ) {
			?>
			@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
				.fl-node-<?php echo $id; ?> .uabb-fancy-text-prefix,
				.fl-node-<?php echo $id; ?> .uabb-fancy-text-suffix{

					<?php if ( 'yes' === $converted || isset( $settings->font_size_unit_responsive ) && '' != $settings->font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->font_size_unit_responsive; ?>px;
						<?php if ( '' == $settings->line_height_unit_responsive && '' != $settings->font_size_unit_responsive ) { ?>
							line-height: <?php echo $settings->font_size_unit_responsive + 2; ?>px;
						<?php } ?>		
					<?php } elseif ( isset( $settings->font_size_unit_responsive ) && '' == $settings->font_size_unit_responsive && isset( $settings->font_size['small'] ) && '' != $settings->font_size['small'] ) { ?>
						font-size: <?php echo $settings->font_size['small']; ?>px;
						line-height: <?php echo $settings->font_size['small'] + 2; ?>px;
					<?php } ?>  

					<?php if ( isset( $settings->font_size['small'] ) && '' == $settings->font_size['small'] && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] && '' == $settings->line_height_unit_responsive && '' == $settings->line_height_unit_medium && '' == $settings->line_height_unit ) { ?>
						line-height: <?php echo $settings->line_height['small']; ?>px;
					<?php } ?>

					<?php if ( 'yes' === $converted || isset( $settings->line_height_unit_responsive ) && '' != $settings->line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->line_height_unit_responsive ) && '' == $settings->line_height_unit_responsive && isset( $settings->line_height['small'] ) && '' != $settings->line_height['small'] ) { ?>
						line-height: <?php echo $settings->line_height['small']; ?>px;
					<?php } ?>
				}
				.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {

					<?php if ( 'yes' === $converted || isset( $settings->fancy_font_size_unit_responsive ) && '' != $settings->fancy_font_size_unit_responsive ) { ?>
						font-size: <?php echo $settings->fancy_font_size_unit_responsive; ?>px;
						<?php if ( '' == $settings->fancy_line_height_unit_responsive && '' != $settings->fancy_font_size_unit_responsive ) { ?>
							line-height: <?php echo $settings->fancy_font_size_unit_responsive + 2; ?>px;
						<?php } ?>
					<?php } elseif ( isset( $settings->fancy_font_size_unit_responsive ) && '' == $settings->fancy_font_size_unit_responsive && isset( $settings->fancy_font_size['small'] ) && '' != $settings->fancy_font_size['small'] ) { ?>
						font-size: <?php echo $settings->fancy_font_size['small']; ?>px;
						line-height: <?php echo $settings->fancy_font_size['small'] + 2; ?>px;
					<?php } ?>

					<?php if ( isset( $settings->fancy_font_size['small'] ) && '' == $settings->fancy_font_size['small'] && isset( $settings->fancy_line_height['small'] ) && '' != $settings->fancy_line_height['small'] && '' == $settings->fancy_line_height_unit_responsive && '' == $settings->fancy_line_height_unit_medium && '' == $settings->fancy_line_height_unit ) : ?>
						line-height: <?php echo $settings->fancy_line_height['small']; ?>px;
					<?php endif; ?>

					<?php if ( 'yes' === $converted || isset( $settings->fancy_line_height_unit_responsive ) && '' != $settings->fancy_line_height_unit_responsive ) { ?>
						line-height: <?php echo $settings->fancy_line_height_unit_responsive; ?>em;
					<?php } elseif ( isset( $settings->fancy_line_height_unit_responsive ) && '' == $settings->fancy_line_height_unit_responsive && isset( $settings->fancy_line_height['small'] ) && '' != $settings->fancy_line_height['small'] ) { ?>
						line-height: <?php echo $settings->fancy_line_height['small']; ?>px;
					<?php } ?>		

					width: auto !important;
				}
			}
			<?php
		}
	}
	?>
	@media ( max-width: <?php echo $global_settings->responsive_breakpoint . 'px'; ?> ) {
		.fl-node-<?php echo $id; ?> .uabb-fancy-text-main {
			width: auto !important;
		}
	}
	<?php
}
?>

/* Typography responsive layout Ends here */

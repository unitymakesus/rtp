<?php
/**
 * UABB Creative Menu front-end CSS php file
 *
 *  @package UABB Creative Menu
 */

?>

<?php

$version_bb_check = UABB_Compatibility::check_bb_version();
$converted        = UABB_Compatibility::check_old_page_migration();

if ( isset( $settings->creative_submenu_shadow_color_opc ) && '' == $settings->creative_submenu_shadow_color_opc ) {
	$settings->creative_submenu_shadow_color_opc = '100';
}
if ( isset( $settings->creative_submenu_separator_size ) && '' == $settings->creative_submenu_separator_size ) {
	$settings->creative_submenu_separator_size = '1';
}
if ( isset( $settings->creative_menu_close_icon_size ) && '' == $settings->creative_menu_close_icon_size ) {
	$settings->creative_menu_close_icon_size = '30';
}

?>
<?php if ( 'off-canvas' == $settings->creative_mobile_menu_type ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( isset( $settings->creative_menu_link_spacing ) && '' != $settings->creative_menu_link_spacing && isset( $settings->creative_menu_link_spacing_dimension_top ) && ( '' == $settings->creative_menu_link_spacing_dimension_top || '0' == $settings->creative_menu_link_spacing_dimension_top ) && isset( $settings->creative_menu_link_spacing_dimension_bottom ) && ( '' == $settings->creative_menu_link_spacing_dimension_bottom || '0' == $settings->creative_menu_link_spacing_dimension_bottom ) && isset( $settings->creative_menu_link_spacing_dimension_left ) && ( '' == $settings->creative_menu_link_spacing_dimension_left || '0' == $settings->creative_menu_link_spacing_dimension_left ) && isset( $settings->creative_menu_link_spacing_dimension_right ) && ( '' == $settings->creative_menu_link_spacing_dimension_right || '0' == $settings->creative_menu_link_spacing_dimension_right ) ) {
				echo $settings->creative_menu_link_spacing;
				?>
				;
			<?php } else { ?>
				<?php
				if ( isset( $settings->creative_menu_link_spacing_dimension_top ) ) {
					echo ( '' != $settings->creative_menu_link_spacing_dimension_top ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top . 'px;' : 'padding-top: 10px;';
				}
				if ( isset( $settings->creative_menu_link_spacing_dimension_bottom ) ) {
					echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
				}
				if ( isset( $settings->creative_menu_link_spacing_dimension_left ) ) {
					echo ( '' != $settings->creative_menu_link_spacing_dimension_left ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left . 'px;' : 'padding-left: 10px;';
				}
				if ( isset( $settings->creative_menu_link_spacing_dimension_right ) ) {
					echo ( '' != $settings->creative_menu_link_spacing_dimension_right ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right . 'px;' : 'padding-right: 10px;';
				}
}
	?>
		}
<?php } ?>
/* Menu alignment */

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
	text-align: <?php echo $settings->creative_menu_alignment; ?>;
}
<?php if ( 'left' == $settings->creative_menu_alignment ) { ?>

	.uabb-creative-menu-expanded ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li .uabb-has-submenu-container a {
		text-indent: 20px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li .uabb-has-submenu-container a  {
		text-indent: 30px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li .uabb-has-submenu-container a  {
		text-indent: 40px;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li li .uabb-has-submenu-container a  {
		text-indent: 50px;
	}

<?php } elseif ( 'right' == $settings->creative_menu_alignment ) { ?>

	.uabb-creative-menu-expanded ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li a,
	.uabb-creative-menu-accordion ul.sub-menu li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li .uabb-has-submenu-container a {
		text-indent: 20px;
		direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li .uabb-has-submenu-container a {
		text-indent: 30px;
		direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li .uabb-has-submenu-container a {
		text-indent: 40px;
		direction: rtl;
	}
	.uabb-creative-menu-expanded ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li a,
	.uabb-creative-menu-accordion ul.sub-menu li li li li .uabb-has-submenu-container a,
	.uabb-creative-menu-expanded ul.sub-menu li li li li .uabb-has-submenu-container a {
		text-indent: 50px;
		direction: rtl;
	}

<?php } ?>

<?php
if ( 'left' == $settings->creative_menu_alignment ) {

	if ( 'horizontal' == $settings->creative_menu_layout ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

	<?php if ( 'vertical' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

	<?php if ( 'accordion' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

<?php } ?>

<?php
if ( 'center' == $settings->creative_menu_alignment ) {

	if ( 'horizontal' == $settings->creative_menu_layout ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

	<?php if ( 'vertical' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

	<?php if ( 'accordion' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

<?php } ?>

<?php
if ( 'right' == $settings->creative_menu_alignment ) {

	if ( 'horizontal' == $settings->creative_menu_layout ) {
		?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-horizontal .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
	<?php } ?>

	<?php if ( 'vertical' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-right: 10px;
			float: left;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-vertical .uabb-menu-toggle {
			padding-right: 10px;
			float: left;
		}
	<?php } ?>

	<?php if ( 'accordion' == $settings->creative_menu_layout ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion > li > .uabb-has-submenu-container a span.uabb-menu-toggle {
			padding-right: 10px;
			float: left;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-accordion .uabb-menu-toggle {
			padding-right: 10px;
			float: left;
		}
	<?php } ?>

<?php } ?>

/**
* Overall menu styling
*/

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {

	<?php
	if ( 'yes' === $converted || isset( $settings->creative_menu_link_margin_dimension_top ) && isset( $settings->creative_menu_link_margin_dimension_bottom ) && isset( $settings->creative_menu_link_margin_dimension_left ) && isset( $settings->creative_menu_link_margin_dimension_right ) ) {
		if ( isset( $settings->creative_menu_link_margin_dimension_top ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_top ) ? 'margin-top:' . $settings->creative_menu_link_margin_dimension_top . 'px;' : 'margin-top: 5px;';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_bottom ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_bottom ) ? 'margin-bottom:' . $settings->creative_menu_link_margin_dimension_bottom . 'px;' : 'margin-bottom: 5px;';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_left ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_left ) ? 'margin-left:' . $settings->creative_menu_link_margin_dimension_left . 'px;' : 'margin-left: 5px;';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_right ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_right ) ? 'margin-right:' . $settings->creative_menu_link_margin_dimension_right . 'px;' : 'margin-right: 5px;';
		}
	} elseif ( isset( $settings->creative_menu_link_margin ) && '' != $settings->creative_menu_link_margin && isset( $settings->creative_menu_link_margin_dimension_top ) && '' == $settings->creative_menu_link_margin_dimension_top && isset( $settings->creative_menu_link_margin_dimension_bottom ) && '' == $settings->creative_menu_link_margin_dimension_bottom && isset( $settings->creative_menu_link_margin_dimension_left ) && '' == $settings->creative_menu_link_margin_dimension_left && isset( $settings->creative_menu_link_margin_dimension_right ) && '' == $settings->creative_menu_link_margin_dimension_right ) {
		echo $settings->creative_menu_link_margin;
		?>
		;
		<?php } ?>
}

<?php if ( 'arrows' == $settings->creative_menu_responsive_toggle ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .sub-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .sub-menu .uabb-menu-toggle:before {
		content: '\f107';
		font-family: 'Font Awesome 5 Free';
		z-index: 1;
		font-size: inherit;
		line-height: 0;
		font-weight: 900;
		<?php
		if ( $settings->creative_menu_responsive_link_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}
<?php } elseif ( 'plus' == $settings->creative_menu_responsive_toggle ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu .sub-menu .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .sub-menu .uabb-menu-toggle:before {
		content: '\f067';
		font-family: 'Font Awesome 5 Free';
		font-size: 0.7em;
		z-index: 1;
		font-weight: 900;
		<?php
		if ( $settings->creative_menu_responsive_link_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}
<?php } ?>

<?php
/* Toggle - Arrows */
if ( ( ( 'horizontal' == $settings->creative_menu_layout || 'vertical' == $settings->creative_menu_layout ) && 'arrows' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle:before {
		content: '\f107';
		font-family: 'Font Awesome 5 Free';
		z-index: 1;
		font-size: inherit;
		line-height: 0;
		font-weight: 900;
	}
	<?php

	/* Toggle - Plus */
} elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle:before {
		content: '\f067';
		font-family: 'Font Awesome 5 Free';
		font-size: 0.7em;
		z-index: 1;
		font-weight: 900;
	}
	<?php
}

/* Responsive */
if ( $global_settings->responsive_enabled ) {
	?>

	<?php if ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>
		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
			display: none;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu li:first-child {
		border-top: none;
	}

	<?php if ( isset( $settings->creative_menu_mobile_toggle ) && in_array( $settings->creative_menu_mobile_toggle, array( 'hamburger', 'hamburger-label' ) ) ) { ?>
		<?php if ( 'always' != $module->media_breakpoint() ) : ?>
			@media only screen and ( max-width: <?php echo $module->media_breakpoint(); ?>px ) {
		<?php endif; ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
				margin-top: 20px;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn {
				display: block;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
				text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
				margin-left: 0 !important;
				margin-right: 0 !important;
			}
			<?php if ( 'left' == $settings->creative_menu_responsive_alignment ) { ?>

				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
					padding-left: 10px;
					float: right;
				}
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
					padding-left: 10px;
					float: right;
				}

			<?php } ?>

			<?php if ( 'center' == $settings->creative_menu_responsive_alignment ) { ?>

					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
						padding-left: 10px;
						float: right;
					}
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
						padding-left: 10px;
						float: right;
					}

			<?php } ?>

			<?php if ( 'right' == $settings->creative_menu_responsive_alignment ) { ?>

					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
						padding-right: 10px;
						float: left;
					}
					.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
						padding-right: 10px;
						float: left;
					}

			<?php } ?>

		<?php if ( 'always' != $module->media_breakpoint() ) : ?>
		}
		<?php endif; ?>
	<?php } ?>

	<?php /* Below Row Layout CSS starts here */ ?>

	<?php if ( isset( $settings->creative_mobile_menu_type ) && 'below-row' == $settings->creative_mobile_menu_type ) : ?>

		<?php if ( 'below-row' == $settings->creative_mobile_menu_type ) : ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
				margin: unset;
			}
			.fl-node-<?php echo $id; ?> .fl-module.fl-module-uabb-advanced-menu:before,
			.fl-node-<?php echo $id; ?> .fl-module-content:before {
				content: none;
			}
		<?php endif; ?>

	<?php endif; ?>

	<?php /* Below Row Layout CSS ends here */ ?>

	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		@media only screen and ( min-width: <?php echo ( $module->media_breakpoint() ) + 1; ?>px ) {

		<?php // Horizontal Menu. ?>
		<?php if ( 'horizontal' == $settings->creative_menu_layout ) { ?>
			.fl-node-<?php echo $id; ?> .menu > li {
				display: inline-block;
			}

			.fl-node-<?php echo $id; ?> .menu li {
				border-left: none;
				border-top: none;
			}
			.fl-node-<?php echo $id; ?> .menu li li {
				border-top: none;
				border-left: none;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
				position: absolute;
				top: 100%;
				left: 0;
				z-index: 16;
				visibility: hidden;
				opacity: 0;
				text-align:left;
				transition: all 300ms ease-in;
			}

			.fl-node-<?php echo $id; ?> .uabb-has-submenu .uabb-has-submenu .sub-menu {
				top:  0;
				left: 100%;
			}

			<?php // if menu is vertical. ?>
		<?php } elseif ( 'vertical' == $settings->creative_menu_layout ) { ?>

			.fl-node-<?php echo $id; ?> .menu .uabb-wp-has-submenu .sub-menu {
				position: absolute;
				top: 0;
				left: 100%;
				z-index: 10;
				visibility: hidden;
				opacity: 0;
			}

		<?php } ?>

		<?php // Horizontal Or Vertical Menu. ?>
		<?php if ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:focus > .sub-menu {
				display: block;
			}

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:focus > .sub-menu {
				visibility: visible;
				opacity: 1;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu.uabb-menu-submenu-right .sub-menu {
				top: 100%;
				left: inherit;
				right: 0;
			}

			.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .uabb-has-submenu.uabb-menu-submenu-right .sub-menu {
				top: 0;
				left: inherit;
				right: 100%;
			}

			<?php if ( 'none' == $settings->creative_submenu_hover_toggle ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu-container a span.menu-item-text {
					color: #<?php echo $settings->creative_menu_link_color; ?>;
				}
				.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-toggle {
					display: none;
				}
			<?php } ?>

			<?php } ?>

			<?php if ( 'expanded' != $settings->creative_menu_mobile_toggle ) { ?>
				.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
					display: none;
				}
			<?php } ?>

				}

		<?php
}
		/* Not Responsive */
} else {
	?>

	<?php // Horizontal Menu. ?>
	<?php if ( 'horizontal' == $settings->creative_menu_layout ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
			float: left;
		}

		.fl-node-<?php echo $id; ?> .menu li {
			border-left: 1px solid transparent;
		}

		.fl-node-<?php echo $id; ?> .menu li:first-child {
			border: none;
		}

		.fl-node-<?php echo $id; ?> .menu li li {
			border-top: 1px solid transparent;
			border-left: none;
		}

	<?php } ?>

	<?php if ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) ) { ?>

		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .sub-menu {
			position: absolute;
			top: 100%;
			left: 0;
			z-index: 16;
			visibility: hidden;
			opacity: 0;
		}

		.fl-node-<?php echo $id; ?> .menu .uabb-has-submenu .uabb-has-submenu .sub-menu {
			top: 0;
			left: 100%;
		}

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu.focus > .sub-menu {
			display: block;
		}

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu:hover > .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu.focus > .sub-menu {
			visibility: visible;
			opacity: 1;
			transition: all 300ms ease-out;
		}

		<?php if ( 'none' == $settings->creative_submenu_hover_toggle ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-has-submenu-container a span.menu-item-text {
				color: <?php echo $settings->creative_menu_link_color; ?>;
			}
			.uabb-creative-menu .uabb-menu-toggle {
				display: none;
			}
		<?php } ?>

	<?php } ?>

	<?php if ( 'expanded' != $settings->creative_menu_mobile_toggle ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
			display: none;
		}
	<?php } ?>

<?php } ?>
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
	<?php if ( 'Default' != $settings->creative_menu_link_font_family['family'] ) { ?>
		<?php FLBuilderFonts::font_css( $settings->creative_menu_link_font_family ); ?>
	<?php } ?>
	<?php
	if ( 'custom' == $settings->creative_menu_link_font_size && $settings->creative_menu_link_font_size_custom ) {
		?>
		font-size: <?php echo $settings->creative_menu_link_font_size_custom; ?>px;<?php } ?>
	<?php
	if ( 'custom' == $settings->creative_menu_link_line_height && $settings->creative_menu_link_line_height_custom ) {
		?>
		line-height: <?php echo $settings->creative_menu_link_line_height_custom; ?>;<?php } ?>
	text-transform: <?php echo $settings->creative_menu_link_text_transform; ?>;
	letter-spacing: <?php echo $settings->creative_menu_link_letter_spacing; ?>px;
}
	<?php
} else {
	if ( 'custom' == $settings->creative_menu_link_typo ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'creative_menu_link_font_typo',
					'selector'     => ".fl-node-$id .uabb-creative-menu .menu > li > a,.fl-node-$id .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a",
				)
			);
		}
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container > a {
	<?php
	if ( 'yes' === $converted || isset( $settings->creative_menu_link_spacing_dimension_top ) && isset( $settings->creative_menu_link_spacing_dimension_bottom ) && isset( $settings->creative_menu_link_spacing_dimension_left ) && isset( $settings->creative_menu_link_spacing_dimension_right ) ) {
		if ( isset( $settings->creative_menu_link_spacing_dimension_top ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top . 'px;' : 'padding-top: 10px;';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left . 'px;' : 'padding-left: 10px;';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right . 'px;' : 'padding-right: 10px;';
		}
	} elseif ( isset( $settings->creative_menu_link_spacing ) && '' != $settings->creative_menu_link_spacing && isset( $settings->creative_menu_link_spacing_dimension_top ) && '' == $settings->creative_menu_link_spacing_dimension_top && isset( $settings->creative_menu_link_spacing_dimension_bottom ) && '' == $settings->creative_menu_link_spacing_dimension_bottom && isset( $settings->creative_menu_link_spacing_dimension_left ) && '' == $settings->creative_menu_link_spacing_dimension_left && isset( $settings->creative_menu_link_spacing_dimension_right ) && '' == $settings->creative_menu_link_spacing_dimension_right ) {
		echo $settings->creative_menu_link_spacing;
		?>
			;
		<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
	<?php if ( '' != $settings->creative_menu_background_color ) { ?>
		transition: background-color 300ms ease;
		background-color:<?php echo ( false === strpos( $settings->creative_menu_background_color, 'rgb' ) ) ? '#' . $settings->creative_menu_background_color : $settings->creative_menu_background_color; ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {

	<?php
	if ( ! $version_bb_check ) {
		if ( 'none' != $settings->creative_menu_border_style ) {
			?>
			<?php if ( '' != $settings->creative_menu_border_style ) { ?>
				border-style:<?php echo $settings->creative_menu_border_style; ?>;
			<?php } ?>

			<?php
			if ( 'yes' === $converted || isset( $settings->creative_menu_border_width_dimension_top ) && isset( $settings->creative_menu_border_width_dimension_bottom ) && isset( $settings->creative_menu_border_width_dimension_left ) && isset( $settings->creative_menu_border_width_dimension_right ) ) {
				if ( isset( $settings->creative_menu_border_width_dimension_top ) ) {
					echo ( '' != $settings->creative_menu_border_width_dimension_top ) ? 'border-top-width:' . $settings->creative_menu_border_width_dimension_top . 'px;' : 'border-top-width: 0;';
				}
				if ( isset( $settings->creative_menu_border_width_dimension_bottom ) ) {
					echo ( '' != $settings->creative_menu_border_width_dimension_bottom ) ? 'border-bottom-width:' . $settings->creative_menu_border_width_dimension_bottom . 'px;' : 'border-bottom-width: 0;';
				}
				if ( isset( $settings->creative_menu_border_width_dimension_left ) ) {
					echo ( '' != $settings->creative_menu_border_width_dimension_left ) ? 'border-left-width:' . $settings->creative_menu_border_width_dimension_left . 'px;' : 'border-left-width: 0;';
				}
				if ( isset( $settings->creative_menu_border_width_dimension_right ) ) {
					echo ( '' != $settings->creative_menu_border_width_dimension_right ) ? 'border-right-width:' . $settings->creative_menu_border_width_dimension_right . 'px;' : 'border-right-width: 0;';
				}
			} elseif ( isset( $settings->uabb_creative_menu_border_width ) && '' != $settings->uabb_creative_menu_border_width && isset( $settings->uabb_creative_menu_border_width_dimension_top ) && '' == $settings->uabb_creative_menu_border_width_dimension_top && isset( $settings->uabb_creative_menu_border_width_dimension_bottom ) && '' == $settings->uabb_creative_menu_border_width_dimension_bottom && isset( $settings->uabb_creative_menu_border_width_dimension_left ) && '' == $settings->uabb_creative_menu_border_width_dimension_left && isset( $settings->uabb_creative_menu_border_width_dimension_right ) && '' == $settings->uabb_creative_menu_border_width_dimension_right ) {
				$str = '1px;';
				if ( isset( $settings->uabb_creative_menu_border_width ) ) {
					if ( is_array( $settings->uabb_creative_menu_border_width ) ) {
						if ( 'collapse' == $settings->uabb_creative_menu_border_width['simplify'] ) {
							$str = ( '' != $settings->uabb_creative_menu_border_width['all'] ) ? $settings->uabb_creative_menu_border_width['all'] . 'px;' : '0;';
						} else {
							$str  = ( '' != $settings->uabb_creative_menu_border_width['top'] ) ? $settings->uabb_creative_menu_border_width['top'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_menu_border_width['right'] ) ? $settings->uabb_creative_menu_border_width['right'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_menu_border_width['bottom'] ) ? $settings->uabb_creative_menu_border_width['bottom'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_menu_border_width['left'] ) ? $settings->uabb_creative_menu_border_width['left'] . 'px;' : '0;';
						}
					}
				}
				?>
				border-width: <?php echo $str; ?>
			<?php } ?>

			<?php if ( '' != $settings->creative_menu_border_color ) { ?>
				border-color: <?php echo ( false === strpos( $settings->creative_menu_border_color, 'rgb' ) ) ? '#' . $settings->creative_menu_border_color : $settings->creative_menu_border_color; ?>;
			<?php } ?>
		<?php } else { ?>
			<?php if ( '' != $settings->creative_menu_border_style ) { ?>
				border-style:<?php echo $settings->creative_menu_border_style; ?>;
			<?php } ?>
			<?php
}
	} else {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'menu_border',
					'selector'     => ".fl-node-$id .uabb-creative-menu .menu > li > a, .fl-node-$id .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a",
				)
			);
		}
	}
	?>
}

.fl-node-<?php echo $id; ?> .fl-module-content .uabb-creative-menu .menu > li > a span.menu-item-text,
.fl-node-<?php echo $id; ?> .fl-module-content .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a span.menu-item-text {
	width: 100%;
	<?php if ( '' != $settings->creative_menu_link_color ) { ?>
		color:#<?php echo $settings->creative_menu_link_color; ?>;
	<?php } ?>
}

<?php if ( ! empty( $settings->creative_menu_link_color ) ) { ?>

		<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_color; ?>;
		}
		<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_color; ?>;
		}
		<?php } ?>
<?php } ?>

<?php if ( ! empty( $settings->creative_menu_link_hover_color ) ) { ?>

		<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
		<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
		<?php } ?>
	<?php
}


/* Links - hover or active */
if ( ! empty( $settings->creative_menu_background_hover_color ) || $settings->creative_menu_link_hover_color || $settings->creative_menu_border_hover_color ) {
	?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:hover > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:focus > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > .uabb-has-submenu-container > a {
		<?php if ( '' != $settings->creative_menu_background_hover_color ) { ?>
			background-color: <?php echo ( false === strpos( $settings->creative_menu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_menu_background_hover_color : $settings->creative_menu_background_hover_color; ?>;
			<?php
}
if ( '' != $settings->creative_menu_border_hover_color ) {
	?>
			border-color: <?php echo ( false === strpos( $settings->creative_menu_border_hover_color, 'rgb' ) ) ? '#' . $settings->creative_menu_border_hover_color : $settings->creative_menu_border_hover_color; ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a {
		<?php if ( '' != $settings->creative_submenu_background_hover_color ) { ?>
			background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_hover_color : $settings->creative_submenu_background_hover_color; ?>;
		<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php
		if ( '' != $settings->creative_menu_link_hover_color ) {
			echo 'color: #' . $settings->creative_menu_link_hover_color . ';';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php
		if ( '' != $settings->creative_submenu_link_hover_color ) {
			echo 'color: #' . $settings->creative_submenu_link_hover_color . ';';
		}
		?>
	}
<?php } ?>

<?php if ( ! empty( $settings->creative_menu_link_hover_color ) ) { ?>
	<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows li.current-menu-item >.uabb-has-submenu-container > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none li.current-menu-item >.uabb-has-submenu-container > .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
		<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-has-submenu-container:hover > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .uabb-has-submenu-container.focus > .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus li.current-menu-item > .uabb-has-submenu-container > .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_link_hover_color; ?>;
		}
	<?php } ?>

<?php } ?>

/* Sub-menu */
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
	<?php if ( 'Default' != $settings->creative_submenu_link_font_family['family'] ) { ?>
		<?php FLBuilderFonts::font_css( $settings->creative_submenu_link_font_family ); ?>
	<?php } ?>
	<?php
	if ( 'custom' == $settings->creative_submenu_link_font_size && $settings->creative_submenu_link_font_size_custom ) {
		?>
		font-size: <?php echo $settings->creative_submenu_link_font_size_custom; ?>px;<?php } ?>
	<?php
	if ( 'custom' == $settings->creative_submenu_link_line_height && $settings->creative_submenu_link_line_height_custom ) {
		?>
		line-height: <?php echo $settings->creative_submenu_link_line_height_custom; ?>;<?php } ?>
	<?php if ( 'none' != $settings->creative_submenu_link_text_transform ) : ?>
		<?php echo 'text-transform:' . $settings->creative_submenu_link_text_transform; ?>;
	<?php endif; ?>

	<?php if ( '' != $settings->creative_submenu_link_letter_spacing ) : ?>
		letter-spacing: <?php echo $settings->creative_submenu_link_letter_spacing; ?>px;
	<?php endif; ?>
}
	<?php
} else {
	if ( 'custom' == $settings->creative_submenu_link_typogarphy ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'creative_submenu_link_font_typo',
					'selector'     => ".fl-node-$id .uabb-creative-menu .sub-menu > li > a,.fl-node-$id .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a",
				)
			);
		}
	}
}
?>
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
	<?php
	if ( 'yes' === $converted || isset( $settings->creative_submenu_link_padding_dimension_top ) && isset( $settings->creative_submenu_link_padding_dimension_bottom ) && isset( $settings->creative_submenu_link_padding_dimension_left ) && isset( $settings->creative_submenu_link_padding_dimension_right ) ) {
		if ( isset( $settings->creative_submenu_link_padding_dimension_top ) ) {
			echo ( '' != $settings->creative_submenu_link_padding_dimension_top ) ? 'padding-top:' . $settings->creative_submenu_link_padding_dimension_top . 'px;' : 'padding-top: 15px;';
		}
		if ( isset( $settings->creative_submenu_link_padding_dimension_bottom ) ) {
			echo ( '' != $settings->creative_submenu_link_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->creative_submenu_link_padding_dimension_bottom . 'px;' : 'padding-bottom: 15px;';
		}
		if ( isset( $settings->creative_submenu_link_padding_dimension_left ) ) {
			echo ( '' != $settings->creative_submenu_link_padding_dimension_left ) ? 'padding-left:' . $settings->creative_submenu_link_padding_dimension_left . 'px;' : 'padding-left: 15px;';
		}
		if ( isset( $settings->creative_submenu_link_padding_dimension_right ) ) {
			echo ( '' != $settings->creative_submenu_link_padding_dimension_right ) ? 'padding-right:' . $settings->creative_submenu_link_padding_dimension_right . 'px;' : 'padding-right: 15px;';
		}
	} elseif ( isset( $settings->creative_submenu_link_padding ) && '' != $settings->creative_submenu_link_padding && isset( $settings->creative_submenu_link_padding_dimension_top ) && '' == $settings->creative_submenu_link_padding_dimension_top && isset( $settings->creative_submenu_link_padding_dimension_bottom ) && '' == $settings->creative_submenu_link_padding_dimension_bottom && isset( $settings->creative_submenu_link_padding_dimension_left ) && '' == $settings->creative_submenu_link_padding_dimension_left && isset( $settings->creative_submenu_link_padding_dimension_right ) && '' == $settings->creative_submenu_link_padding_dimension_right ) {
		echo $settings->creative_submenu_link_padding;
		?>
		;
	<?php } ?>

	background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_color : $settings->creative_submenu_background_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu:not(.off-canvas):not(.full-screen):not(.menu-item) .uabb-creative-menu .sub-menu {
	min-width: <?php echo ( isset( $settings->submenu_width ) ? $settings->submenu_width : '' ); ?>px;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.uabb-creative-menu > a > span,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a > span {
	color: <?php echo '#' . $settings->creative_submenu_link_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li {
	<?php if ( isset( $settings->creative_submenu_separator_settings_option ) && 'yes' == $settings->creative_submenu_separator_settings_option ) { ?>
		border-bottom-style: <?php echo $settings->creative_submenu_separator_style; ?>;
		<?php if ( '' != $settings->creative_submenu_separator_size ) { ?>
		border-bottom-width: <?php echo $settings->creative_submenu_separator_size; ?>px;
		<?php } ?>
		<?php if ( '' != $settings->creative_submenu_separator_color ) { ?>
		border-bottom-color: <?php echo ( false === strpos( $settings->creative_submenu_separator_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_separator_color : $settings->creative_submenu_separator_color; ?>;
		<?php } ?>
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child {
	border-bottom: none;
}
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.uabb-creative-menu.uabb-has-submenu li:first-child,
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.uabb-creative-menu.uabb-has-submenu li li:first-child {
	border-top: none;
}
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li.uabb-active > .sub-menu > li:first-child,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu.uabb-creative-menu-expanded .sub-menu > li > .sub-menu > li:first-child {
	<?php if ( isset( $settings->creative_submenu_separator_settings_option ) && 'yes' == $settings->creative_submenu_separator_settings_option ) { ?>
		border-top-style: <?php echo $settings->creative_submenu_separator_style; ?>;
		<?php if ( '' != $settings->creative_submenu_separator_size ) { ?>
		border-top-width: <?php echo $settings->creative_submenu_separator_size; ?>px;
		<?php } ?>
		<?php if ( '' != $settings->creative_submenu_separator_color ) { ?>
		border-top-color: <?php echo ( false === strpos( $settings->creative_submenu_separator_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_separator_color : $settings->creative_submenu_separator_color; ?>;
		<?php } ?>
	<?php } ?>
}




.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu {
	<?php if ( 'yes' == $settings->creative_submenu_drop_shadow ) { ?>
		-webkit-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#' . $settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		-moz-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#' . $settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		-o-box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#' . $settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
		box-shadow: <?php echo $settings->creative_submenu_shadow_color_hor; ?>px <?php echo $settings->creative_submenu_shadow_color_ver; ?>px <?php echo $settings->creative_submenu_shadow_color_blur; ?>px <?php echo $settings->creative_submenu_shadow_color_spr; ?>px <?php echo UABB_Helper::uabb_hex2rgba( '#' . $settings->creative_submenu_shadow_color, $settings->creative_submenu_shadow_color_opc / 100 ); ?>;
	<?php } ?>
}

<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-vertical .sub-menu,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-horizontal .sub-menu {
		<?php if ( isset( $settings->creative_submenu_border_settings_option ) && 'yes' == $settings->creative_submenu_border_settings_option ) { ?>
			border-style: <?php echo $settings->creative_submenu_border_style; ?>;

			<?php
			if ( 'yes' === $converted || isset( $settings->creative_submenu_border_width_dimension_top ) && isset( $settings->creative_submenu_border_width_dimension_bottom ) && isset( $settings->creative_submenu_border_width_dimension_left ) && isset( $settings->creative_submenu_border_width_dimension_right ) ) {
				if ( isset( $settings->creative_submenu_border_width_dimension_top ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_top ) ? 'border-top-width:' . $settings->creative_submenu_border_width_dimension_top . 'px;' : 'border-top-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_bottom ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_bottom ) ? 'border-bottom-width:' . $settings->creative_submenu_border_width_dimension_bottom . 'px;' : 'border-bottom-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_left ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_left ) ? 'border-left-width:' . $settings->creative_submenu_border_width_dimension_left . 'px;' : 'border-left-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_right ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_right ) ? 'border-right-width:' . $settings->creative_submenu_border_width_dimension_right . 'px;' : 'border-right-width: 1px;';
				}
			} elseif ( isset( $settings->uabb_creative_submenu_border_width ) && '' != $settings->uabb_creative_submenu_border_width && isset( $settings->creative_submenu_border_width_dimension_top ) && '' == $settings->creative_submenu_border_width_dimension_top && isset( $settings->creative_submenu_border_width_dimension_bottom ) && '' == $settings->creative_submenu_border_width_dimension_bottom && isset( $settings->creative_submenu_border_width_dimension_left ) && '' == $settings->creative_submenu_border_width_dimension_left && isset( $settings->creative_submenu_border_width_dimension_right ) && '' == $settings->creative_submenu_border_width_dimension_right ) {
				$str = '1px;';
				if ( isset( $settings->uabb_creative_submenu_border_width ) ) {
					if ( is_array( $settings->uabb_creative_submenu_border_width ) ) {
						if ( 'collapse' == $settings->uabb_creative_submenu_border_width['simplify'] ) {
							$str = ( '' != $settings->uabb_creative_submenu_border_width['all'] ) ? $settings->uabb_creative_submenu_border_width['all'] . 'px;' : '0;';
						} else {
							$str  = ( '' != $settings->uabb_creative_submenu_border_width['top'] ) ? $settings->uabb_creative_submenu_border_width['top'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['right'] ) ? $settings->uabb_creative_submenu_border_width['right'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['bottom'] ) ? $settings->uabb_creative_submenu_border_width['bottom'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['left'] ) ? $settings->uabb_creative_submenu_border_width['left'] . 'px ' : '0;';
						}
					}
				}
				?>
				border-width: <?php echo $str; ?>
			<?php } ?>

			border-color: <?php echo ( false === strpos( $settings->creative_submenu_border_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_border_color : $settings->creative_submenu_border_color; ?>;
		<?php } ?>
	}
	<?php
} else {
	if ( isset( $settings->creative_submenu_border_settings_option ) && 'yes' == $settings->creative_submenu_border_settings_option ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			// Border - Settings.
			FLBuilderCSS::border_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'submenu_border',
					'selector'     => ".fl-node-$id .uabb-creative-menu .uabb-creative-menu-vertical .sub-menu, .fl-node-$id .uabb-creative-menu .uabb-creative-menu-horizontal .sub-menu",
				)
			);
		}
	}
}

if ( ! $version_bb_check ) {
	?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-expanded.menu > .uabb-has-submenu > .sub-menu,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-accordion.menu > .uabb-has-submenu > .sub-menu {
		<?php if ( isset( $settings->creative_submenu_border_settings_option ) && 'yes' == $settings->creative_submenu_border_settings_option ) { ?>
			border-style: <?php echo $settings->creative_submenu_border_style; ?>;

			<?php
			if ( 'yes' === $converted || isset( $settings->creative_submenu_border_width_dimension_top ) && isset( $settings->creative_submenu_border_width_dimension_bottom ) && isset( $settings->creative_submenu_border_width_dimension_left ) && isset( $settings->creative_submenu_border_width_dimension_right ) ) {
				if ( isset( $settings->creative_submenu_border_width_dimension_top ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_top ) ? 'border-top-width:' . $settings->creative_submenu_border_width_dimension_top . 'px;' : 'border-top-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_bottom ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_bottom ) ? 'border-bottom-width:' . $settings->creative_submenu_border_width_dimension_bottom . 'px;' : 'border-bottom-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_left ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_left ) ? 'border-left-width:' . $settings->creative_submenu_border_width_dimension_left . 'px;' : 'border-left-width: 1px;';
				}
				if ( isset( $settings->creative_submenu_border_width_dimension_right ) ) {
					echo ( '' != $settings->creative_submenu_border_width_dimension_right ) ? 'border-right-width:' . $settings->creative_submenu_border_width_dimension_right . 'px;' : 'border-right-width: 1px;';
				}
			} elseif ( isset( $settings->uabb_creative_submenu_border_width ) && is_array( $settings->uabb_creative_submenu_border_width ) && isset( $settings->creative_submenu_border_width_dimension_top ) && ( '' == $settings->creative_submenu_border_width_dimension_top || '0' == $settings->creative_submenu_border_width_dimension_top ) && isset( $settings->creative_submenu_border_width_dimension_bottom ) && ( '' == $settings->creative_submenu_border_width_dimension_bottom || '0' == $settings->creative_submenu_border_width_dimension_bottom ) && isset( $settings->creative_submenu_border_width_dimension_left ) && ( '' == $settings->creative_submenu_border_width_dimension_left || '0' == $settings->creative_submenu_border_width_dimension_left ) && isset( $settings->creative_submenu_border_width_dimension_right ) && ( '' == $settings->creative_submenu_border_width_dimension_right || '0' == $settings->creative_submenu_border_width_dimension_right ) ) {
				$str = '1px;';
				if ( isset( $settings->uabb_creative_submenu_border_width ) ) {
					if ( is_array( $settings->uabb_creative_submenu_border_width ) ) {
						if ( 'collapse' == $settings->uabb_creative_submenu_border_width['simplify'] ) {
							$str = ( '' != $settings->uabb_creative_submenu_border_width['all'] ) ? $settings->uabb_creative_submenu_border_width['all'] . 'px;' : '0;';
						} else {
							$str  = ( '' != $settings->uabb_creative_submenu_border_width['top'] ) ? $settings->uabb_creative_submenu_border_width['top'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['right'] ) ? $settings->uabb_creative_submenu_border_width['right'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['bottom'] ) ? $settings->uabb_creative_submenu_border_width['bottom'] . 'px ' : '0 ';
							$str .= ( '' != $settings->uabb_creative_submenu_border_width['left'] ) ? $settings->uabb_creative_submenu_border_width['left'] . 'px ' : '0;';
						}
					}
				}
				?>
				border-width: <?php echo $str; ?>
			<?php } ?>

			border-color: <?php echo ( false === strpos( $settings->creative_submenu_border_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_border_color : $settings->creative_submenu_border_color; ?>;
		<?php } ?>
	}
	<?php
} else {
	if ( class_exists( 'FLBuilderCSS' ) ) {
		// Border - Settings.
		FLBuilderCSS::border_field_rule(
			array(
				'settings'     => $settings,
				'setting_name' => 'submenu_border',
				'selector'     => ".fl-node-$id .uabb-creative-menu .uabb-creative-menu-expanded.menu > .uabb-has-submenu > .sub-menu, .fl-node-$id .uabb-creative-menu .uabb-creative-menu-accordion.menu > .uabb-has-submenu > .sub-menu",
			)
		);
	}
}
?>

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child > a,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li:last-child > .uabb-has-submenu-container > a {
	border: 0;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.menu-item.uabb-creative-menu > a:hover span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.menu-item.uabb-creative-menu > a:focus span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.menu-item.uabb-creative-menu > .uabb-has-submenu-container > a:hover span.menu-item-text,
.fl-node-<?php echo $id; ?> .uabb-creative-menu ul.sub-menu > li.menu-item.uabb-creative-menu > .uabb-has-submenu-container > a:focus span.menu-item-text {
	color: <?php echo '#' . $settings->creative_submenu_link_hover_color; ?>;
}

.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:hover,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a:focus,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:hover,
.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a:focus {
	background-color: <?php echo ( false === strpos( $settings->creative_submenu_background_hover_color, 'rgb' ) ) ? '#' . $settings->creative_submenu_background_hover_color : $settings->creative_submenu_background_hover_color; ?>;
}

<?php if ( ! empty( $settings->creative_submenu_link_color ) ) { ?>

		<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .sub-menu li .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .sub-menu li .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_color; ?>;
		}
		<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .sub-menu li .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_color; ?>;
		}
		<?php } ?>
<?php } ?>

<?php if ( ! empty( $settings->creative_submenu_link_hover_color ) ) { ?>

		<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-arrows .sub-menu li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-none .sub-menu li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_hover_color; ?>;
		}
		<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-toggle-plus .sub-menu li:hover .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_submenu_link_hover_color; ?>;
		}
		<?php } ?>
<?php } ?>

/* Toggle button */
<?php if ( isset( $settings->creative_menu_mobile_toggle ) && 'expanded' != $settings->creative_menu_mobile_toggle ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
		<?php
		if ( ! empty( $settings->creative_menu_mobile_toggle_color ) ) {
			echo 'color: #' . $settings->creative_menu_mobile_toggle_color . ';';
		}
		?>
	}
<?php if ( ! $version_bb_check ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle {
		<?php
		if ( isset( $settings->creative_menu_link_text_transform ) ) {
			echo 'text-transform: ' . $settings->creative_menu_link_text_transform . ';';
		}
		if ( 'Default' != $settings->creative_menu_link_font_family['family'] ) {
			?>
			<?php FLBuilderFonts::font_css( $settings->creative_menu_link_font_family ); ?>
		<?php } ?>
		<?php if ( 'custom' == $settings->creative_menu_link_font_size && $settings->creative_menu_link_font_size_custom ) { ?>
			font-size: <?php echo $settings->creative_menu_link_font_size_custom; ?>px;
		<?php
}
		?>
	}
<?php
} else {
	if ( 'custom' == $settings->creative_menu_link_typo ) {
		if ( class_exists( 'FLBuilderCSS' ) ) {
			FLBuilderCSS::typography_field_rule(
				array(
					'settings'     => $settings,
					'setting_name' => 'creative_menu_link_font_typo',
					'selector'     => ".fl-node-$id .uabb-creative-menu-mobile-toggle",
				)
			);
		}
	}
}
?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container > .uabb-creative-menu-mobile-toggle.text {
		text-align: <?php echo $settings->creative_menu_navigation_alignment; ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle rect {
		<?php
		if ( ! empty( $settings->creative_menu_link_color ) ) {
			echo 'fill: #' . $settings->creative_menu_link_color . ';';
		}
		?>
	}
<?php } ?>

<?php if ( isset( $settings->mobile_button_label ) && 'no' == $settings->mobile_button_label ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle.hamburger .uabb-menu-mobile-toggle-label {
		display: none;
	}
<?php } ?>

<?php if ( 'always' != $module->media_breakpoint() ) : ?>
		@media only screen and ( max-width: <?php echo $module->media_breakpoint(); ?>px ) {
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .menu {
		margin-top: 40px;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	<?php if ( 'left' == $settings->creative_menu_responsive_alignment ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}

	<?php } ?>

	<?php if ( 'center' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>

	<?php if ( 'right' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		}
	<?php } ?>

@media only screen and (max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {

	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container > .uabb-creative-menu-mobile-toggle.text {
		text-align: <?php echo ( isset( $settings->creative_menu_navigation_alignment_medium ) ? $settings->creative_menu_navigation_alignment_medium : '' ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
			<?php
			if ( isset( $settings->creative_menu_link_margin_dimension_top_medium ) ) {
				echo ( '' != $settings->creative_menu_link_margin_dimension_top_medium ) ? 'margin-top:' . $settings->creative_menu_link_margin_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_link_margin_dimension_bottom_medium ) ) {
				echo ( '' != $settings->creative_menu_link_margin_dimension_bottom_medium ) ? 'margin-bottom:' . $settings->creative_menu_link_margin_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_link_margin_dimension_left_medium ) ) {
				echo ( '' != $settings->creative_menu_link_margin_dimension_left_medium ) ? 'margin-left:' . $settings->creative_menu_link_margin_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_link_margin_dimension_right_medium ) ) {
				echo ( '' != $settings->creative_menu_link_margin_dimension_right_medium ) ? 'margin-right:' . $settings->creative_menu_link_margin_dimension_right_medium . 'px;' : '';
			}
			?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_medium . 'px;' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_medium . 'px;' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_medium ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_medium ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_medium ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_medium ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_medium . 'px;' : '';
		}
		?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( isset( $settings->creative_menu_border_width_dimension_top_medium ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_top_medium ) ? 'border-top-width:' . $settings->creative_menu_border_width_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_bottom_medium ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_bottom_medium ) ? 'border-bottom-width:' . $settings->creative_menu_border_width_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_left_medium ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_left_medium ) ? 'border-left-width:' . $settings->creative_menu_border_width_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_right_medium ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_right_medium ) ? 'border-right-width:' . $settings->creative_menu_border_width_dimension_right_medium . 'px;' : '';
			}
			?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {

			<?php
			if ( isset( $settings->creative_submenu_link_padding_dimension_top_medium ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_top_medium ) ? 'padding-top:' . $settings->creative_submenu_link_padding_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_bottom_medium ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->creative_submenu_link_padding_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_left_medium ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_left_medium ) ? 'padding-left:' . $settings->creative_submenu_link_padding_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_right_medium ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_right_medium ) ? 'padding-right:' . $settings->creative_submenu_link_padding_dimension_right_medium . 'px;' : '';
			}
			?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-vertical .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-horizontal .sub-menu {
			<?php
			if ( isset( $settings->creative_submenu_border_width_dimension_top_medium ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_top_medium ) ? 'border-top-width:' . $settings->creative_submenu_border_width_dimension_top_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_bottom_medium ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_bottom_medium ) ? 'border-bottom-width:' . $settings->creative_submenu_border_width_dimension_bottom_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_left_medium ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_left_medium ) ? 'border-left-width:' . $settings->creative_submenu_border_width_dimension_left_medium . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_right_medium ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_right_medium ) ? 'border-right-width:' . $settings->creative_submenu_border_width_dimension_right_medium . 'px;' : '';
			}
			?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu {
		<?php
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_top_medium ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_top_medium ) ? 'padding-top:' . $settings->creative_menu_responsive_overlay_padding_dimension_top_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom_medium ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_bottom_medium ) ? 'padding-bottom:' . $settings->creative_menu_responsive_overlay_padding_dimension_bottom_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_left_medium ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_left_medium ) ? 'padding-left:' . $settings->creative_menu_responsive_overlay_padding_dimension_left_medium . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_right_medium ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_right_medium ) ? 'padding-right:' . $settings->creative_menu_responsive_overlay_padding_dimension_right_medium . 'px;' : '';
		}
		?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( 'custom' == $settings->creative_menu_link_font_size && $settings->creative_menu_link_font_size_custom_medium ) {
				?>
				font-size: <?php echo $settings->creative_menu_link_font_size_custom_medium; ?>px;<?php } ?>
			<?php
			if ( 'custom' == $settings->creative_menu_link_line_height && $settings->creative_menu_link_line_height_custom_medium ) {
				?>
				line-height: <?php echo $settings->creative_menu_link_line_height_custom_medium; ?>;<?php } ?>
		}
	<?php } ?>

	<?php if ( 'left' == $settings->creative_menu_responsive_alignment ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}

	<?php } ?>

	<?php if ( 'center' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>

	<?php if ( 'right' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {

	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu-mobile-toggle-container > .uabb-creative-menu-mobile-toggle.text {
		text-align: <?php echo ( isset( $settings->creative_menu_navigation_alignment_responsive ) ? $settings->creative_menu_navigation_alignment_responsive : '' ); ?>;
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li {
		<?php
		if ( isset( $settings->creative_menu_link_margin_dimension_top_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_top_responsive ) ? 'margin-top:' . $settings->creative_menu_link_margin_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_bottom_responsive ) ? 'margin-bottom:' . $settings->creative_menu_link_margin_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_left_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_left_responsive ) ? 'margin-left:' . $settings->creative_menu_link_margin_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_margin_dimension_right_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_margin_dimension_right_responsive ) ? 'margin-right:' . $settings->creative_menu_link_margin_dimension_right_responsive . 'px;' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_responsive . 'px;' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_responsive . 'px;' : '';
		}
		?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a {
		<?php
		if ( isset( $settings->creative_menu_link_spacing_dimension_top_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_top_responsive ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_left_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_left_responsive ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_link_spacing_dimension_right_responsive ) ) {
			echo ( '' != $settings->creative_menu_link_spacing_dimension_right_responsive ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right_responsive . 'px;' : '';
		}
		?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( isset( $settings->creative_menu_border_width_dimension_top_responsive ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_top_responsive ) ? 'border-top-width:' . $settings->creative_menu_border_width_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_bottom_responsive ) ? 'border-bottom-width:' . $settings->creative_menu_border_width_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_left_responsive ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_left_responsive ) ? 'border-left-width:' . $settings->creative_menu_border_width_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_menu_border_width_dimension_right_responsive ) ) {
				echo ( '' != $settings->creative_menu_border_width_dimension_right_responsive ) ? 'border-right-width:' . $settings->creative_menu_border_width_dimension_right_responsive . 'px;' : '';
			}
			?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {

			<?php
			if ( isset( $settings->creative_submenu_link_padding_dimension_top_responsive ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_top_responsive ) ? 'padding-top:' . $settings->creative_submenu_link_padding_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->creative_submenu_link_padding_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_left_responsive ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_left_responsive ) ? 'padding-left:' . $settings->creative_submenu_link_padding_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_link_padding_dimension_right_responsive ) ) {
				echo ( '' != $settings->creative_submenu_link_padding_dimension_right_responsive ) ? 'padding-right:' . $settings->creative_submenu_link_padding_dimension_right_responsive . 'px;' : '';
			}
			?>
	}

	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-vertical .sub-menu,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-creative-menu-horizontal .sub-menu {
			<?php
			if ( isset( $settings->creative_submenu_border_width_dimension_top_responsive ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_top_responsive ) ? 'border-top-width:' . $settings->creative_submenu_border_width_dimension_top_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_bottom_responsive ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_bottom_responsive ) ? 'border-bottom-width:' . $settings->creative_submenu_border_width_dimension_bottom_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_left_responsive ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_left_responsive ) ? 'border-left-width:' . $settings->creative_submenu_border_width_dimension_left_responsive . 'px;' : '';
			}
			if ( isset( $settings->creative_submenu_border_width_dimension_right_responsive ) ) {
				echo ( '' != $settings->creative_submenu_border_width_dimension_right_responsive ) ? 'border-right-width:' . $settings->creative_submenu_border_width_dimension_right_responsive . 'px;' : '';
			}
			?>
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu {
		<?php
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_top_responsive ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_top_responsive ) ? 'padding-top:' . $settings->creative_menu_responsive_overlay_padding_dimension_top_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom_responsive ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_bottom_responsive ) ? 'padding-bottom:' . $settings->creative_menu_responsive_overlay_padding_dimension_bottom_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_left_responsive ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_left_responsive ) ? 'padding-left:' . $settings->creative_menu_responsive_overlay_padding_dimension_left_responsive . 'px;' : '';
		}
		if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_right_responsive ) ) {
			echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_right_responsive ) ? 'padding-right:' . $settings->creative_menu_responsive_overlay_padding_dimension_right_responsive . 'px;' : '';
		}
		?>
	}
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( 'custom' == $settings->creative_menu_link_font_size && $settings->creative_menu_link_font_size_custom_responsive ) {
				?>
				font-size: <?php echo $settings->creative_menu_link_font_size_custom_responsive; ?>px;<?php } ?>
			<?php
			if ( 'custom' == $settings->creative_menu_link_line_height && $settings->creative_menu_link_line_height_custom_responsive ) {
				?>
				line-height: <?php echo $settings->creative_menu_link_line_height_custom_responsive; ?>;<?php } ?>
		}
	<?php } ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	<?php if ( 'left' == $settings->creative_menu_responsive_alignment ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}

	<?php } ?>

	<?php if ( 'center' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				float: right;
			}

	<?php } ?>

	<?php if ( 'right' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu .menu .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->medium_breakpoint; ?>px) {
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( 'custom' == $settings->creative_submenu_link_font_size && $settings->creative_submenu_link_font_size_custom_medium ) {
				?>
				font-size: <?php echo $settings->creative_submenu_link_font_size_custom_medium; ?>px;<?php } ?>
			<?php
			if ( 'custom' == $settings->creative_submenu_link_line_height && $settings->creative_submenu_link_line_height_custom_medium ) {
				?>
				line-height: <?php echo $settings->creative_submenu_link_line_height_custom_medium; ?>;<?php } ?>
		}
	<?php } ?>
}

@media only screen and (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
	<?php if ( ! $version_bb_check ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > a,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .sub-menu > li > .uabb-has-submenu-container > a {
			<?php
			if ( 'custom' == $settings->creative_submenu_link_font_size && $settings->creative_submenu_link_font_size_custom_responsive ) {
				?>
				font-size: <?php echo $settings->creative_submenu_link_font_size_custom_responsive; ?>px;<?php } ?>
			<?php
			if ( 'custom' == $settings->creative_submenu_link_line_height && $settings->creative_submenu_link_line_height_custom_responsive ) {
				?>
				line-height: <?php echo $settings->creative_submenu_link_line_height_custom_responsive; ?>;<?php } ?>
		}
	<?php } ?>
}

/***************************** Overlay *********************************/

<?php if ( 'full-screen' == $settings->creative_mobile_menu_type ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay {
		background-color: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_bg_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_bg_color : $settings->creative_menu_responsive_overlay_bg_color; ?>;
	}

	/* Links */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a {

		<?php
		if ( 'yes' === $converted || isset( $settings->creative_menu_link_spacing_dimension_top ) && isset( $settings->creative_menu_link_spacing_dimension_bottom ) && isset( $settings->creative_menu_link_spacing_dimension_left ) && isset( $settings->creative_menu_link_spacing_dimension_right ) ) {
			if ( isset( $settings->creative_menu_link_spacing_dimension_top ) ) {
				echo ( '' != $settings->creative_menu_link_spacing_dimension_top ) ? 'padding-top:' . $settings->creative_menu_link_spacing_dimension_top . 'px;' : 'padding-top: 10px;';
			}
			if ( isset( $settings->creative_menu_link_spacing_dimension_bottom ) ) {
				echo ( '' != $settings->creative_menu_link_spacing_dimension_bottom ) ? 'padding-bottom:' . $settings->creative_menu_link_spacing_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
			}
			if ( isset( $settings->creative_menu_link_spacing_dimension_left ) ) {
				echo ( '' != $settings->creative_menu_link_spacing_dimension_left ) ? 'padding-left:' . $settings->creative_menu_link_spacing_dimension_left . 'px;' : 'padding-left: 10px;';
			}
			if ( isset( $settings->creative_menu_link_spacing_dimension_right ) ) {
				echo ( '' != $settings->creative_menu_link_spacing_dimension_right ) ? 'padding-right:' . $settings->creative_menu_link_spacing_dimension_right . 'px;' : 'padding-right: 10px;';
			}
		} elseif ( isset( $settings->creative_menu_link_spacing ) && '' != $settings->creative_menu_link_spacing && isset( $settings->creative_menu_link_spacing_dimension_top ) && ( '' == $settings->creative_menu_link_spacing_dimension_top || '0' == $settings->creative_menu_link_spacing_dimension_top ) && isset( $settings->creative_menu_link_spacing_dimension_bottom ) && ( '' == $settings->creative_menu_link_spacing_dimension_bottom || '0' == $settings->creative_menu_link_spacing_dimension_bottom ) && isset( $settings->creative_menu_link_spacing_dimension_left ) && ( '' == $settings->creative_menu_link_spacing_dimension_left || '0' == $settings->creative_menu_link_spacing_dimension_left ) && isset( $settings->creative_menu_link_spacing_dimension_right ) && ( '' == $settings->creative_menu_link_spacing_dimension_right || '0' == $settings->creative_menu_link_spacing_dimension_right ) ) {
			echo $settings->creative_menu_link_spacing;
			?>
			;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu {
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}


	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li {
		clear: both;
		display: block;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu {
		width: 100%;
	}


	<?php if ( 'left' == $settings->creative_menu_responsive_alignment ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
			padding-left: 10px;
			float: right;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .sub-menu {
			float: right;
		}

	<?php } ?>

	<?php if ( 'center' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
				padding-left: 10px;
				float: right;
			}

	<?php } ?>

	<?php if ( 'right' == $settings->creative_menu_responsive_alignment ) { ?>

			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > a span.uabb-menu-toggle,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows > li > .uabb-has-submenu-container a span.menu-item-text > span.uabb-menu-toggle {
				padding-right: 10px;
				float: left;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu > li > a,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu > li > .uabb-has-submenu-container a {
				text-align: right;
			}
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu.uabb-toggle-arrows .uabb-menu-toggle {
				padding-right: 10px;
				float: left;
			}

	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a span.menu-item-text {
		width: 100%;
		<?php
		if ( $settings->creative_menu_responsive_link_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > .uabb-has-submenu-container > a:focus {
		background-color: transparent;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu li {
		<?php if ( $settings->creative_menu_responsive_link_border_color ) { ?>
			border-bottom-width: 1px;
			border-bottom-style: solid;
			border-bottom-color: #<?php echo $settings->creative_menu_responsive_link_border_color; ?>;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu li:last-child {
		border-bottom: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:hover > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:hover > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu >  li:focus > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu li .uabb-has-submenu-container a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text > i {
		<?php
		if ( $settings->creative_menu_responsive_link_hover_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text i {
		<?php
		if ( $settings->creative_menu_responsive_link_hover_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-menu-overlay .uabb-menu-close-btn {
		<?php if ( $settings->creative_menu_close_icon_size ) { ?>
			width: <?php echo  $settings->creative_menu_close_icon_size; ?>px;
			height: <?php echo  $settings->creative_menu_close_icon_size; ?>px;
		<?php } ?>
	}

	<?php if ( '' != $settings->creative_menu_animation_speed ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-fade,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-fade,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-corner,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-corner,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-slide-down,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-slide-down,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-scale,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-scale,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.menu-open .uabb-overlay-door,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door > ul,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-overlay-door .uabb-menu-close-btn {
			transition-duration: <?php echo ( $settings->creative_menu_animation_speed / 1000 ) . 's'; ?>;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-close-btn:before,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay .uabb-menu-close-btn:after {
		<?php if ( $settings->creative_menu_close_icon_size ) { ?>
			height: <?php echo  $settings->creative_menu_close_icon_size; ?>px;
		<?php } ?>
		<?php if ( '' != $settings->creative_menu_close_icon_color ) { ?>
			background-color: #<?php echo $settings->creative_menu_close_icon_color; ?>;
		<?php } ?>
	}

	<?php if ( ! empty( $settings->creative_menu_responsive_link_color ) ) { ?>
			<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-none .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-none .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } ?>
	<?php } ?>

	<?php if ( ! empty( $settings->creative_menu_responsive_link_hover_color ) ) { ?>

		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
	<?php } ?>

	<?php if ( $module->media_breakpoint() ) { ?>
			@media only screen and ( max-width: <?php echo $module->media_breakpoint(); ?>px ) {
		<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default {
				display: none;
			}
		<?php if ( $module->media_breakpoint() ) { ?>
			}
	<?php } ?>

	@media only screen and ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

		.fl-node-<?php echo $id; ?> .uabb-creative-menu.full-screen .uabb-menu-overlay ul.menu {
			width: 80%;
		}
	}
<?php } ?>


/***************************** Off Canvas **********************************/
<?php if ( 'off-canvas' == $settings->creative_mobile_menu_type ) { ?>
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		@media only screen and ( max-width: <?php echo $module->media_breakpoint(); ?>px ) {
	<?php } ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.uabb-menu-default {
				display: none;
			}
	<?php if ( 'always' != $module->media_breakpoint() ) { ?>
		}
	<?php } ?>

	/* Container */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu {
		background-color: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_bg_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_bg_color : $settings->creative_menu_responsive_overlay_bg_color; ?>;

		<?php
		if ( 'yes' === $converted || isset( $settings->creative_menu_responsive_overlay_padding_dimension_top ) && isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) && isset( $settings->creative_menu_responsive_overlay_padding_dimension_left ) && isset( $settings->creative_menu_responsive_overlay_padding_dimension_right ) ) {
			if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_top ) ) {
				echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_top ) ? 'padding-top:' . $settings->creative_menu_responsive_overlay_padding_dimension_top . 'px;' : 'padding-top: 10px;';
			}
			if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) ) {
				echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) ? 'padding-bottom:' . $settings->creative_menu_responsive_overlay_padding_dimension_bottom . 'px;' : 'padding-bottom: 10px;';
			}
			if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_left ) ) {
				echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_left ) ? 'padding-left:' . $settings->creative_menu_responsive_overlay_padding_dimension_left . 'px;' : 'padding-left: 10px;';
			}
			if ( isset( $settings->creative_menu_responsive_overlay_padding_dimension_right ) ) {
				echo ( '' != $settings->creative_menu_responsive_overlay_padding_dimension_right ) ? 'padding-right:' . $settings->creative_menu_responsive_overlay_padding_dimension_right . 'px;' : 'padding-right: 10px;';
			}
		} elseif ( isset( $settings->creative_menu_responsive_overlay_padding ) && '' != $settings->creative_menu_responsive_overlay_padding && isset( $settings->creative_menu_responsive_overlay_padding_dimension_top ) && '' == $settings->creative_menu_responsive_overlay_padding_dimension_top && isset( $settings->creative_menu_responsive_overlay_padding_dimension_bottom ) && '' == $settings->creative_menu_responsive_overlay_padding_dimension_bottom && isset( $settings->creative_menu_responsive_overlay_padding_dimension_left ) && '' == $settings->creative_menu_responsive_overlay_padding_dimension_left && isset( $settings->creative_menu_responsive_overlay_padding_dimension_right ) && '' == $settings->creative_menu_responsive_overlay_padding_dimension_right ) {
			echo $settings->creative_menu_responsive_overlay_padding;
			?>
			;
		<?php } ?>

	}

	<?php
	if ( 'yes' == $settings->creative_menu_off_canvas_shadow ) {
		if ( '' != $settings->creative_menu_off_canvas_shadow_color ) {
			?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-off-canvas-menu {
				-webkit-box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
				-moz-box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
				box-shadow:  0 0 15px 1px <?php echo ( false === strpos( $settings->creative_menu_off_canvas_shadow_color, 'rgb' ) ) ? '#' . $settings->creative_menu_off_canvas_shadow_color : $settings->creative_menu_off_canvas_shadow_color; ?>;
			}
			<?php
		}
	}
	?>

	/* Close Button */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn {
		font-size:  <?php echo  $settings->creative_menu_close_icon_size; ?>px;
		background: none;
		<?php
		if ( $settings->creative_menu_close_icon_color ) {
			?>
			color: #<?php echo $settings->creative_menu_close_icon_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu .uabb-menu-close-btn::selection {
		font-size:  <?php echo  $settings->creative_menu_close_icon_size; ?>px;
		background: none;
		<?php
		if ( $settings->creative_menu_close_icon_color ) {
			?>
			color: #<?php echo $settings->creative_menu_close_icon_color; ?>;<?php } ?>
	}

	/* Menu */
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu {
		margin-top: 60px;
		text-align: <?php echo $settings->creative_menu_responsive_alignment; ?>;
	}

	/* Links */

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li {
		display: block;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu {
		width: 100%;
	}

	<?php if ( 'right' != $settings->creative_menu_alignment ) { ?>
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-has-submenu-container > a > span,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-has-submenu-container > a > span {
		padding-right: 0;
	}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a:hover,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > .uabb-has-submenu-container > a:focus {
		background-color: transparent;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-tem-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li a span.menu-item-text i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a span.menu-tem-text i {
		width: 100%;
		<?php
		if ( $settings->creative_menu_responsive_link_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu li {
		border-bottom-width: 1px;
		border-bottom-style: solid;
		border-bottom-color: <?php echo ( $settings->creative_menu_responsive_link_border_color ) ? '#' . $settings->creative_menu_responsive_link_border_color : ''; ?>;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu li:last-child {
		border-bottom: none;
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:hover > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:focus > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:hover > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu >  li:focus > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu li .uabb-has-submenu-container a:focus span.menu-item-text > i {
		<?php
		if ( $settings->creative_menu_responsive_link_hover_color ) {
			?>
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;<?php } ?>
	}

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:hover span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:focus span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:hover span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li > a:focus span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:hover > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li:focus > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-item > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > a span.menu-item-text > i,
	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .sub-menu > li.current-menu-ancestor > .uabb-has-submenu-container > a span.menu-item-text i {
		<?php
		if ( '' != $settings->creative_menu_responsive_link_hover_color ) {
			echo 'color: #' . $settings->creative_menu_responsive_link_hover_color . ';';
		}
		?>
	}

	<?php if ( '' != $settings->creative_menu_animation_speed ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-left,
		.fl-node-<?php echo $id; ?> .menu-open.uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-left,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-right,
		.fl-node-<?php echo $id; ?> .menu-open.uabb-creative-menu .uabb-off-canvas-menu.uabb-menu-right {
			transition-duration: <?php echo ( $settings->creative_menu_animation_speed / 1000 ) . 's'; ?>;
		}
	<?php } ?>

	<?php if ( ! empty( $settings->creative_menu_responsive_link_color ) ) { ?>
			<?php if ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->creative_submenu_hover_toggle, array( 'arrows' ) ) ) || ( 'accordion' == $settings->creative_menu_layout && 'arrows' == $settings->creative_submenu_click_toggle ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-none .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .sub-menu .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-none .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } elseif ( ( in_array( $settings->creative_menu_layout, array( 'horizontal', 'vertical' ) ) && 'plus' == $settings->creative_submenu_hover_toggle ) || ( 'accordion' == $settings->creative_menu_layout && 'plus' == $settings->creative_submenu_click_toggle ) ) { ?>
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-menu-toggle:before,
			.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .sub-menu .uabb-menu-toggle:before {
				color: #<?php echo $settings->creative_menu_responsive_link_color; ?>;
			}
			<?php } ?>
	<?php } ?>

	<?php if ( ! empty( $settings->creative_menu_responsive_link_color ) ) { ?>
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-arrows .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:hover .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:focus .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:hover .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus li:focus .uabb-has-submenu-container .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-creative-menu.current-menu-item .uabb-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-toggle-plus .uabb-creative-menu.current-menu-ancestor .uabb-menu-toggle:before {
			color: #<?php echo $settings->creative_menu_responsive_link_hover_color; ?>;
		}
	<?php } ?>

	.fl-node-<?php echo $id; ?> .uabb-creative-menu.off-canvas .uabb-clear {
		background: <?php echo ( false === strpos( $settings->creative_menu_responsive_overlay_color, 'rgb' ) ) ? '#' . $settings->creative_menu_responsive_overlay_color : $settings->creative_menu_responsive_overlay_color; ?>;
	}
<?php } ?>

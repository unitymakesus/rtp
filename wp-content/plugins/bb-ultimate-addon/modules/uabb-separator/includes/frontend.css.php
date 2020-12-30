<?php
/**
 *  UABB Separator Module front-end CSS php file
 *
 *  @package UABB Separator Module
 */

?>

<?php
	$version_bb_check = UABB_Compatibility::$version_bb_check;
	$settings->color  = uabb_theme_base_color( UABB_Helper::uabb_colorpicker( $settings, 'color' ) );
	$settings->height = ( '' !== trim( $settings->height ) ) ? $settings->height : '1';
	$settings->width  = ( '' !== trim( $settings->width ) ) ? $settings->width : '100';
?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-separator {
	border-top:<?php echo esc_attr( $settings->height ); ?>px <?php echo esc_attr( $settings->style ); ?> <?php echo esc_attr( $settings->color ); ?>;
	<?php if ( ! $version_bb_check ) { ?>
		width: <?php echo esc_attr( $settings->width ); ?>%;
	<?php } else { ?>
		width: <?php echo esc_attr( $settings->width ) . esc_attr( $settings->width_unit ); ?>;
	<?php } ?>
	display: inline-block;
}
<?php if ( ! $version_bb_check ) { ?>
.fl-node-<?php echo esc_attr( $id ); ?> .uabb-separator-parent {
	text-align: <?php echo esc_attr( $settings->alignment ); ?>;
}
	<?php
} else {
	FLBuilderCSS::responsive_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'alignment',
			'selector'     => ".fl-node-$id .uabb-separator-parent",
			'prop'         => 'text-align',
		)
	);
}
?>

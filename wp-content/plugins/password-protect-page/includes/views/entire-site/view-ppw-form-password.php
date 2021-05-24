<?php
$page_title          = ppw_get_page_title();
$password_label      = _x( 'Password:', PPW_Constants::CONTEXT_SITEWIDE_PASSWORD_FORM, 'password-protect-page' );
$password_placehoder = wp_kses_post( get_theme_mod( 'ppwp_pro_form_instructions_placeholder' ) );
$btn_label           = get_theme_mod( 'ppwp_pro_form_button_label', PPW_Constants::DEFAULT_SHORTCODE_BUTTON );
$disable_logo        = get_theme_mod( 'ppwp_pro_logo_disable', 0 ) ? 'none' : 'block';
$form_transparency   = get_theme_mod( 'ppwp_pro_form_enable_transparency' ) ? 'style="background: none!important; box-shadow: initial;"' : '';
$is_wrong_password   = isset( $_GET['action'] ) && $_GET['action'] === 'ppw_postpass' && isset( $_POST['input_wp_protect_password'] );
$internal_css        = '<link rel="stylesheet" href="' . PPW_VIEW_URL . 'dist/ppw-form-entire-site.css" type="text/css">' . PHP_EOL;
$form_action         = apply_filters( 'ppw_sitewide_form_action', '?action=ppw_postpass' );
$err_msg             = apply_filters( 'ppw_sitewide_error_message', esc_html__( 'Please enter the correct password!', 'password-protect-page' ) );

?>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="description" content=""/>
	<meta name="viewport" content="width=device-width"/>
	<link rel="icon" href="<?php echo esc_attr( get_site_icon_url() ); ?>"/>
	<?php echo apply_filters( 'ppw_sitewide_external_css', $internal_css ); ?>
	<title><?php echo esc_attr( $page_title ); ?></title>
	<?php do_action( PPW_Constants::HOOK_CUSTOM_HEADER_FORM_ENTIRE_SITE ); ?>
	<style>
		<?php
			do_action( 'ppw_sitewide_custom_internal_css' );
			do_action( PPW_Constants::HOOK_CUSTOM_STYLE_FORM_ENTIRE_SITE );
		?>
	</style>
	<?php wp_custom_css_cb(); ?>
</head>
<body class="ppwp-sitewide-protection">
	<div class="pda-form-login ppw-swp-form-container">
		<h1>
			<a style="display: <?php echo $disable_logo ?>" title="<?php echo esc_attr__( 'This site is password protected by PPWP plugin', 'password-protect-page') ?>" class="ppw-swp-logo">Password Protect WordPress plugin</a>
		</h1>
		<?php
		do_action( 'ppw_sitewide_above_password_form_container' );
		?>
		<form <?php echo $form_transparency ?> class="ppw-swp-form" action="<?php echo $form_action; ?>" method="post">
			<?php do_action( 'ppw_sitewide_above_password_form' ); ?>
			<label for="input_wp_protect_password"><?php echo $password_label ?></label>
			<input class="input_wp_protect_password" type="password" id="input_wp_protect_password"
				name="input_wp_protect_password" placeholder="<?php echo $password_placehoder ?>"/>
			<?php
				if ( $is_wrong_password ) {
					?>
						<div id="ppw_entire_site_wrong_password" class="ppw-entire-site-password-error">
							<?php echo $err_msg; ?>
						</div>
					<?php
				}
				do_action( 'ppw_sitewide_above_submit_button' );
			?>
			<input type="submit" class="button button-primary button-login" value="<?php echo $btn_label ?>">
			<?php do_action( 'ppw_sitewide_below_password_form' ); ?>
		</form>
	</div>
	<?php do_action( PPW_Constants::HOOK_CUSTOM_FOOTER_FORM_ENTIRE_SITE ); ?>
</body>

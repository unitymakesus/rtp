<?php
$page_title = ppw_get_page_title();

$password_label = _x( 'Password', PPW_Constants::CONTEXT_SITEWIDE_PASSWORD_FORM, 'password-protect-page' );
$btn_label      = _x( 'Login', PPW_Constants::CONTEXT_SITEWIDE_PASSWORD_FORM, 'password-protect-page' );
?>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="description" content=""/>
	<meta name="viewport" content="width=device-width"/>
	<link rel="icon" href="<?php echo esc_attr( get_site_icon_url() ); ?>"/>
	<title><?php echo esc_attr( $page_title ); ?></title>
	<link rel="stylesheet" href="<?php echo PPW_VIEW_URL; ?>dist/ppw-form-entire-site.css" type="text/css">
</head>
<div class="pda-form-login ppw-swp-form-container">
	<h1>
		<a title="<?php echo esc_attr__( 'This site is password protected by PPWP plugin', 'password-protect-page') ?>" class="ppw-swp-logo">Password Protect WordPress plugin</a>
	</h1>
	<form class="ppw-swp-form" action="?action=ppw_postpass" method="post">
		<label for=""><?php echo $password_label ?></label>
		<input class="input_wp_protect_password" type="password" id="input_wp_protect_password"
		       name="input_wp_protect_password">
		<input type="submit" class="button button-primary button-login" value="<?php echo $btn_label ?>">
	</form>
</div>

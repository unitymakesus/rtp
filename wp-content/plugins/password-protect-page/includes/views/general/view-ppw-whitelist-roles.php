<?php
$roles = get_editable_roles();
?>
<tr class="ppwp_free_version">
	<td class="feature-input"><span class="feature-input"></span></td>
	<td>
		<p>
			<label><?php echo esc_html__( 'Whitelisted Roles', PPW_Constants::DOMAIN ) ?></label>
			<?php echo _e( 'Select user roles who can access all protected content without having to enter passwords.<em> Available in Pro version only.</em>', PPW_Constants::DOMAIN ) ?>
		</p>
		<select id="wpp_free_whitelist_roles">
			<option value="blank"><?php echo esc_html__( 'No one', PPW_Constants::DOMAIN ) ?></option>
			<option value="admin_users"><?php echo esc_html__( 'Admin users', PPW_Constants::DOMAIN ) ?></option>
			<option value="author"><?php echo esc_html__( 'The post\'s author', PPW_Constants::DOMAIN ) ?></option>
			<option value="logged_users"><?php echo esc_html__( 'Logged-in users', PPW_Constants::DOMAIN ) ?></option>
			<option value="custom_roles"><?php echo esc_html__( 'Choose custom roles', PPW_Constants::DOMAIN ) ?></option>
		</select>
	</td>
</tr>
<tr id="wpp_free_roles_access" class="wpp_hide_role_access ppwp_free_version">
	<td></td>
	<td><p><?php echo esc_html__( 'Grant access to these user roles only', PPW_Constants::DOMAIN ) ?></p>
		<select multiple="multiple" class="wpp_roles_select ppwp_select2">
			<?php foreach ( $roles as $role_name => $role_info ) { ?>
				<option><?php echo $role_name ?></option>
			<?php } ?>
		</select>
	</td>
</tr>

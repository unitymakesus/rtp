<?php
$post_types = ppw_core_get_all_post_types();
?>
<tr class="ppwp_free_version">
	<td class="feature-input"><span class="feature-input"></span></td>
	<td>
		<p>
			<label><?php echo esc_html__( 'Post Type Protection', PPW_Constants::DOMAIN ); ?></label>
			<?php echo _e( '<a target="_blank" rel="noopener noreferrer" href="https://passwordprotectwp.com/docs/settings/#cpt">Select which custom post types</a> you want to password protect. Default: Pages & Posts.<em> Available in Pro version only.</em>', PPW_Constants::DOMAIN ); ?>
		</p>
		<select multiple="multiple" class="ppwp_select2">
			<?php foreach ( $post_types as $post_type ): ?>
				<option <?php echo 'post' === $post_type->name || 'page' === $post_type->name ? 'selected="selected"' : '' ?>
						value="<?php echo esc_attr( $post_type->name ) ?>"><?php echo esc_html__( $post_type->label ); ?></option>
			<?php endforeach; ?>
		</select>
	</td>
</tr>

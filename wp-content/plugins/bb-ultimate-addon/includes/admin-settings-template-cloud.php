<?php
/**
 * Template Cloud Page backend
 *
 * @package Render UABB Template cloud
 */

?>
<div id="fl-uabb-cloud-templates-form" class="fl-settings-form uabb-cloud-templates-fl-settings-form">


	<div class="fl-settings-form-header">
		<h3><?php esc_attr_e( 'Template Cloud', 'uabb' ); ?></h3>
		<a target="_blank" rel="noopener" href="https://www.ultimatebeaver.com/docs/use-template-cloud/?utm_source=uabb-pro-dashboard&utm_medium=template-cloud-screen&utm_campaign=template-cloud" data-count="118" style="float: right;"><?php esc_attr_e( 'How to use Page Templates?', 'uabb' ); ?></a>
	</div>

	<form id="uabb-cloud-templates-form" action="<?php UABBBuilderAdminSettings::render_form_action( 'uabb-cloud-templates' ); ?>" method="post" data-uabb-cloud-nonce="<?php echo esc_attr( wp_create_nonce( 'uabb_cloud_nonce' ) ); ?>">

		<?php if ( FLBuilderAdminSettings::multisite_support() && ! is_network_admin() ) : ?>
		<label>
			<input class="fl-override-ms-cb" type="checkbox" name="fl-override-ms" value="1" 
			<?php
			if ( get_option( '_fl_builder_uabb_cloud_templates' ) ) {
				echo 'checked="checked"';}
			?>
			/>
			<?php esc_attr_e( 'Override network settings?', 'uabb' ); ?>
		</label>
		<?php endif; ?>

		<div class="fl-settings-form-content">

			<!-- Append all templates -->
			<div id="uabb-cloud-templates-tabs">

				<div id="uabb-cloud-templates-inner" class="wp-filter">

					<div class="filter-count">
						<span class="count"><?php echo wp_kses_post( UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ) ); ?></span>
					</div>
					<ul class="uabb-filter-links">
						<li><a href="#uabb-cloud-templates-page-templates" data-count="<?php echo wp_kses_post( UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ) ); ?>"> <?php esc_attr_e( 'Page Templates', 'uabb' ); ?> </a></li>
						<li><a href="#uabb-cloud-templates-sections" data-count="<?php echo wp_kses_post( UABB_Cloud_Templates::get_cloud_templates_count( 'sections' ) ); ?>"> <?php esc_attr_e( 'Sections', 'uabb' ); ?> </a></li>
					</ul>
					<!-- <a class="drawer-toggle" href="#">Feature Filter</a>
					<input type="text" value="Search templates" style="width: 100px;" /> -->

					<div class="uabb-fetch-templates">
						<?php
							// Print Templates Buttons.
							do_action( 'uabb_cloud_template_buttons' );
						?>
					</div>

				</div>
				<div class="uabb-cloud-templates-tabs-container">
					<div id="uabb-cloud-templates-page-templates">
						<?php
							// Print Templates HTML.
							UABB_Cloud_Templates::template_html( 'page-templates' );
						?>
					</div>
					<div id="uabb-cloud-templates-sections">
						<?php
							// Print Templates HTML.
							UABB_Cloud_Templates::template_html( 'sections' );
						?>
					</div>
				</div>
			</div>


			<br/>

		</div>
	</form>
</div>

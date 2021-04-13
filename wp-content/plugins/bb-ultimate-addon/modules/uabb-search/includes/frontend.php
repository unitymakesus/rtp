<?php
/**
 *  UABB Search Module front-end file
 *
 *  @package UABB Search Module
 */

$form_classes = $module->get_form_classes();
?>

<div class="<?php echo esc_attr( apply_filters( 'uabb_search_form_classes', $form_classes ) ); ?>"
	<?php
	if ( isset( $module->template_id ) ) {
		echo 'data-template-id="' . esc_attr( $module->template_id ) . '" data-template-node-id="' . esc_attr( $module->template_node_id ) . '"';}
	?>
>
	<div class="uabb-search-form-wrap">
		<div class="uabb-search-form-fields">
			<div class="uabb-search-form-input-wrap">
				<form role="search" aria-label="Search form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-nonce=<?php echo wp_kses_post( wp_create_nonce( 'uabb-search-nonce' ) ); ?>>
					<div class="uabb-form-field">
					<?php if ( 'button' === $settings->display && 'fullscreen' === $settings->btn_action && 'show' === $settings->fs_close_button ) { ?>
						<i class="uabb-search-close fa fa-times"></i>
					<?php } ?>
					<?php if ( 'input' === $settings->display ) { ?>
						<i class="fa fa-search icon" aria-hidden="true"></i>
					<?php } ?>
						<input type="search" aria-label="Search input" class="uabb-search-text" placeholder="<?php echo esc_attr( $settings->placeholder ); ?>" value="<?php get_search_query(); ?>" name="s" />
							<?php if ( 'yes' === $settings->enable_ajax ) : ?>
								<div class="uabb-search-loader-wrap">
									<div class="uabb-search-loader">
										<svg class="spinner" viewBox="0 0 50 50">
											<circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
										</svg>
									</div>
								</div>
							<?php endif; ?>
					</div>
					<?php if ( 'yes' === $settings->enable_ajax ) : ?>
						<div class="uabb-search-results-content"></div>
					<?php endif; ?>
				</form>
			</div>
			<?php
			if ( 'input' !== $settings->display ) {
				$module->render_button( $id );
			}
			?>
		</div>
	</div>
	<div class="uabb-search-overlay"></div>
</div>

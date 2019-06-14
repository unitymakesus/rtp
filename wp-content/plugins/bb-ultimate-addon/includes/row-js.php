<?php
/**
 * Intializes row's js files
 *
 * @package Row settings
 */

/**
 * Function that renders row's javascript file
 *
 * @since 1.4.6
 */
function uabb_row_render_js() {
	add_filter( 'fl_builder_render_js', 'uabb_row_dependency_js', 10, 3 );
}

/**
 * Function that renders row's javascript file
 *
 * @since 1.4.6
 * @param string $js gets the javascript for the row.
 * @param array  $nodes an array to get the nodes of the row.
 * @param object $global_settings an object to get various settings.
 */
function uabb_row_dependency_js( $js, $nodes, $global_settings ) {
	ob_start();

	?>
		;(function($){
			var form = $('.fl-builder-settings'),
				gradient_type = form.find( 'input[name=uabb_row_gradient_type]' );

			$( document ).on( 'change', 'input[name=uabb_row_radial_advance_options], input[name=uabb_row_linear_advance_options], input[name=uabb_row_gradient_type], select[name=bg_type]', function() {
				var form        = $('.fl-builder-settings'),
					background_type       = form.find( 'select[name=bg_type]' ).val(),
					linear_direction      = form.find( 'select[name=uabb_row_uabb_direction]' ).val(),
					linear_advance_option = form.find( 'input[name=uabb_row_linear_advance_options]:checked' ).val(),
					radial_advance_option = form.find( 'input[name=uabb_row_radial_advance_options]:checked' ).val(),
					gradient_type         = form.find( 'input[name=uabb_row_gradient_type]:checked' ).val();				
				if( background_type == 'uabb_gradient' ) {

					if( gradient_type == 'radial' ) {

						setTimeout( function() { 
							form.find('#fl-field-uabb_row_linear_direction').hide();
							form.find('#fl-field-uabb_row_linear_gradient_primary_loc').hide();
							form.find('#fl-field-uabb_row_linear_gradient_secondary_loc').hide();
						}, 1);

						if( radial_advance_option == 'yes' ) {
							form.find('#fl-field-uabb_row_radial_gradient_primary_loc').show();
							form.find('#fl-field-uabb_row_radial_gradient_secondary_loc').show();
						}
					}

					if( gradient_type == 'linear' ) {

						setTimeout( function() { 
							form.find('#fl-field-uabb_row_radial_gradient_primary_loc').hide();
							form.find('#fl-field-uabb_row_radial_gradient_secondary_loc').hide();
						}, 1);

						if( linear_direction == 'custom' ) {
							form.find('#fl-field-uabb_row_linear_direction').show();
						}

						if( linear_advance_option == 'yes' ) {
							form.find('#fl-field-uabb_row_linear_gradient_primary_loc').show();
							form.find('#fl-field-uabb_row_linear_gradient_secondary_loc').show();
						}
					}   
				}
			});

		})(jQuery);		
	<?php
	$js .= ob_get_clean();
	return $js;
}

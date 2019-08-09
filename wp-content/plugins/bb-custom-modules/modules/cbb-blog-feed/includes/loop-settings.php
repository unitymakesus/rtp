<?php
/**
 * Render the Loop Settings for Custom Posts module.
 */

// Set up defaults
FLBuilderModel::default_settings(
  $settings, array(
    'data_source' => 'custom_query',
    'post_type' => 'post',
    'order_by' => 'date',
    'order' => 'DESC',
		'posts_per_page' => '3',
  )
);
$settings = apply_filters( 'fl_builder_loop_settings', $settings );

// Ouput settings fields
?>
<div id="fl-builder-settings-section-source" class="fl-loop-data-source-select fl-builder-settings-section">
	<table class="fl-form-table">
  	<?php

  	FLBuilder::render_settings_field(
  		'posts_per_page', array(
  			'type'        => 'text',
  			'label'       => __( 'Post Count', 'uabb' ),
  			'help'        => __( 'Enter the total number of posts you want to display in module.', 'cbb' ),
  			'default'     => '3',
  			'size'        => '8',
  			'placeholder' => '3',
  		), $settings
  	);

    ?>
	</table>
</div>

<div id="fl-builder-settings-section-filter" class="uabb-settings-section">
  <h3 class="fl-builder-settings-title"><span class="fl-builder-settings-title-text-wrap"><?php _e( 'Filter', 'cbb' ); ?></span></h3>
	<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-blog-filter">
		<?php

    FLBuilder::render_settings_field(
    	'tax_post_category_matching', array(
    		'type'    => 'select',
    		'label'   => 'Blog Category',
    		'help'    => __( 'Enter a comma separated list of categories. Only posts with these categories will be shown.', 'cbb' ),
    		'options' => array(
    			'1' => __( 'Match these categories', 'cbb' ),
    			'0' => __( 'Do not match these categories', 'cbb' ),

    		),
    	), $settings
    );
    FLBuilder::render_settings_field(
    	'tax_post_category', array(
    		'type'   => 'suggest',
    		'action' => 'fl_as_terms',
    		'data'   => 'category',
    		'label'  => '&nbsp',
    	), $settings
    );

	  ?>
	</table>
</div>

<?php
/**
 * Render the Loop Settings for Custom Posts module.
 */

// Set up defaults
FLBuilderModel::default_settings(
  $settings, array(
		'posts_per_page' => '3',
    'today' => '0'
  )
);
$settings = apply_filters( 'fl_builder_loop_settings', $settings );

// Ouput settings fields
?>
<div id="fl-builder-settings-section-source" class="fl-loop-data-source-select fl-builder-settings-section">
	<table class="fl-form-table">
  	<?php

    FLBuilder::render_settings_field(
      'today', array(
        'type'        => 'select',
        'label'       => __( 'Date Range', 'cbb'),
        'options'     => array(
          '1'         => 'Today',
          '0'         => 'All Upcoming'
        ),
        'toggle'      => array(
          '1'         => array(),
          '0'         => array(
            'fields'  => array(
              'tax_post_category_matching',
              'tax_post_category'
            )
          )
        )
      ), $settings
    );

  	FLBuilder::render_settings_field(
  		'posts_per_page', array(
  			'type'        => 'text',
  			'label'       => __( 'Post Count', 'uabb' ),
  			'help'        => __( 'Enter the total number of events you want to display in module.', 'cbb' ),
  			'default'     => '3',
  			'size'        => '8',
  			'placeholder' => '3',
  		), $settings
  	);

    ?>
	</table>
</div>

<div id="fl-builder-settings-section-filter" class="uabb-settings-section">
	<table class="fl-form-table fl-loop-builder-filter fl-loop-builder-blog-filter">
		<?php

    FLBuilder::render_settings_field(
    	'tax_post_category_matching', array(
    		'type'    => 'select',
    		'label'   => 'Event Category',
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
    		'data'   => 'mec_category',
    		'label'  => '&nbsp',
    	), $settings
    );

	  ?>
	</table>
</div>

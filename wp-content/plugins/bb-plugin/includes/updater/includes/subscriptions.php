<hr />
<?php
// first check we have a download for the current version.
$plugin_data = get_plugin_data( FL_BUILDER_FILE );
$plugin_name = $plugin_data['Name'];

if ( ! in_array( $plugin_name, $subscription->downloads, true ) ) {

	$header_txt = __( 'Beaver Builder updates issue!!' );
	// translators: %s: Product name
	$txt = sprintf( __( 'Updates for Beaver Builder will not work as you appear to have %s activated but it is not in your available downloads.', 'fl-builder' ), $plugin_name );
	printf(
		'<div class="notice notice-error"><p><strong>%s</strong></p><p>%s</p></div>',
		$header_txt,
		$txt
	);
}
?>
<h3><?php _e( 'Available Downloads', 'fl-builder' ); ?></h3>
<p><?php _e( 'The following downloads are currently available for remote update with the subscription(s) associated with this license.', 'fl-builder' ); ?></p>
<ul>
	<?php
	foreach ( $subscription->downloads as $download ) {

		if ( stristr( $download, 'child theme' ) ) {
			continue;
		}
		echo '<li>' . $download . '</li>';
	}
	?>
</ul>

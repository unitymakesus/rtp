<?php
/**
 *  Param file uabb-file
 *
 *  @package UABB_File
 */

if ( ! class_exists( 'UABB_File' ) ) {
	/**
	 * This class initializes UABB-File field
	 *
	 * @class UABB-File field
	 */
	class UABB_File {
		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.12.0
		 */
		function __construct() {

			add_action( 'fl_builder_control_uabb-file', array( $this, 'uabb_file' ), 1, 4 );
			add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}

		/**
		 * Function that renders UI fields' files
		 *
		 * @since 1.12.0
		 * @param array $fields gets an array of fields.
		 */
		function ui_fields( $fields ) {
			$fields['uabb-file'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-file/ui-field-file.php';

			return $fields;
		}

		/**
		 * Function that renders row's CSS
		 *
		 * @since 1.12.0
		 * @param var    $name gets the name for the file field.
		 * @param array  $value gets an array of file values.
		 * @param array  $field gets an array of field values.
		 * @param object $settings gets the object of respective fields.
		 */
		function uabb_file( $name, $value, $field, $settings ) {

			$name_new = 'uabb-' . $name;

			$custom_class = isset( $field['class'] ) ? $field['class'] : 'fl-file-empty';

			$file = FLBuilderPhoto::get_attachment_data( $value ); ?>

			<div class="fl-file-field fl-builder-custom-field
			<?php
			if ( empty( $custom_class ) ) {
				echo ' fl-file-empty';
			} if ( isset( $field['class'] ) ) {
				echo ' ' . $field['class'];}
			?>
			">
				<a class="fl-file-select" href="javascript:void(0);" onclick="return false;"><?php _e( 'Select File', 'uabb' ); ?></a>
				<div class="fl-file-preview">
					<?php if ( ! empty( $value ) && $file ) : ?>
					<div class="fl-file-preview-img">
					</div>
					<span class="fl-file-preview-filename"><?php echo $file->filename; ?></span>
					<?php else : ?>
					<div class="fl-file-preview-img">
					</div>
					<span class="fl-file-preview-filename"></span>
					<?php endif; ?>
					<br />
					<a class="fl-file-replace" href="javascript:void(0);" onclick="return false;"><?php _e( 'Replace File', 'uabb' ); ?></a>
					<div class="fl-clear"></div>
				</div>
				<input name="<?php echo $name; ?>" type="hidden" value='<?php echo $value; ?>' />
			</div> 
			<?php
		}
	}

	new UABB_File();
}

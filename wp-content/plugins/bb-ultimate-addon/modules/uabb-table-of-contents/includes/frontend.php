<?php
/**
 *  UABB Table Of Contents Module front-end file
 *
 *  @package UABB Table Of Contents Module
 */

?>

<?php if ( 'yes' === $settings->scroll_top ) { ?>
<div id="uabb-scroll-button" class="uabb-toc-scroll-icon">
	<i class="fas fa-chevron-up"></i>
</div>
<?php } ?>
<div class="uabb-parent-wrapper-toc">
	<div class="uabb-toc-container">
	<?php $module->render_separator( 'top' ); ?>
	<div class ="uabb-heading-block">
		<span class="uabb-toc-heading"><?php echo $settings->heading_title; ?></span>
	<div id="uabb-toc-toggle" class="uabb-toggle-toc" >
		<span class="uabb-icon">
			<i class="<?php echo $settings->icon; ?>"></i>
		</span>
	</div>
</div>
	<?php $module->render_separator( 'center' ); ?>
	<div id="uabb-toc-togglecontents">
		<div class="uabb-toc-content-heading">
		<?php
		$selected_list = $settings->bullet_icon;
		if ( 'unordered_list' === $selected_list ) {
			?>
			<ul id="uabb-toc-wrapper" class="toc-lists toc-ul"></ul>
		<?php } elseif ( 'ordered_list' === $selected_list ) { ?>
			<ol id="uabb-toc-wrapper" class="toc-lists toc-ol"></ol>
		<?php } else { ?>
			<ul id="uabb-toc-wrapper" class="toc-lists toc_none_bullet" ></ul>
			<?php
}
		?>
		</div>
	</div>
	<div class="uabb-toc-empty-note">
		<span><?php echo __( 'Add a header to begin generating the table of contents', 'uabb' ); ?></span>
	</div>
	<?php $module->render_separator( 'bottom' ); ?>
	</div>
	</div>

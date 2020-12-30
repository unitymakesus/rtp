<?php
/**
 * UABB Advanced Menu Walker File
 *
 * Helper functions, actions & filter hooks etc.
 *
 * @package UABB Advanced Menu Walker
 */

/**
 * This class initializes Creative Menu walker
 *
 * @class Creative_Menu_Walker
 */
class Creative_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Constructor function that initializes required sections
	 *
	 * @since x.x.x
	 * @param array $settings gets the param settings.
	 */
	public function __construct( $settings ) {
		$this->param = $settings;
	}

	/**
	 * Function for the Creative Menu Walker
	 *
	 * @since x.x.x
	 * @param var    $output gets the output for the Menu's HTML.
	 * @param array  $item an array to get the nodes of the row.
	 * @param object $depth an object to get depth of the menu settings.
	 * @param array  $args an array to get the args.
	 * @param int    $id gets the id.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$args   = (object) $args;

		$class_names = '';
		$value       = '';
		$rel_xfn     = '';
		$rel_blank   = '';

		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$submenu     = $args->has_children ? ' uabb-has-submenu' : '';
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = ' class="' . esc_attr( $class_names ) . $submenu . ' uabb-creative-menu uabb-cm-style"';

		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && strpos( $item->xfn, 'noopener' ) === false ) {
			$rel_xfn = ' noopener';
		}
		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && empty( $item->xfn ) ) {
			$rel_blank = 'rel="noopener"';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . $rel_xfn . '"' : '' . $rel_blank;
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$item_output  = $args->has_children ? '<div class="uabb-has-submenu-container">' : '';
		$item_output .= $args->before;
		$item_output .= '<a' . $attributes . '><span class="menu-item-text">';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if ( $args->has_children ) {
			$item_output .= '<span class="uabb-menu-toggle"></span>';
		}
		$item_output .= '</span></a>';

		$item_output .= $args->after;
		$item_output .= $args->has_children ? '</div>' : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	/**
	 * Function that renders the display element.
	 *
	 * @since x.x.x
	 * @param var   $element gets the element for the Menu.
	 * @param array $children_elements gets the children elements.
	 * @param var   $max_depth gets the max depth of the menu.
	 * @param var   $depth gets the depth of the Menu.
	 * @param var   $args gets the arguments for the elements.
	 * @param var   $output gets the output for the element.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

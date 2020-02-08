<?php
// Register menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'jointswp' ),   // Main nav in header
		'top-nav-bar' => __( 'Панель навигации', 'jointswp' ),   // Main nav in header
		'footer-menu-1' => __( 'Подвал - Первое меню', 'jointswp' ), // Secondary nav in footer
		'footer-menu-2' => __( 'Подвал - Второе меню', 'jointswp' ), // Secondary nav in footer
		'shop-category-links' => __( 'Меню с категориями товаров', 'jointswp' ), // Secondary nav in footer
		'blog-category-links' => __( 'Меню с категориями блога', 'jointswp' ) // Secondary nav in footer
	)
);

// The Footer Menu
function joints_top_nav_bar() {
	wp_nav_menu(array(
		'container' => 'false',                         // Remove nav container
		'menu' => __( 'Панель навигации', 'jointswp' ),   	// Nav name
		'menu_class' => 'menu',      					// Adding custom nav class
		'menu_id' => 'top-nav-bar',      					// Adding custom nav class
		'theme_location' => 'top-nav-bar',             // Where it's located in the theme
		'depth' => 0,                                   // Limit the depth of the nav
		'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */

// The Top Menu
function joints_top_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
		 'menu_id'  => 'main-menu',
        'menu_class' => 'menu dropdown horizontal expanded',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu data-close-on-click-inside="false">%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Mega_Menu_Walker()
    ));
}

// The Mobile Top Menu
function joints_mobile_top_nav() {
	wp_nav_menu(array(
		'container' => false,                           // Remove nav container
		'menu_id'  => 'mobile-main-menu',
		'menu_class' => 'main-nav-menu vertical menu',       // Adding custom nav class
		'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion" data-close-on-click-inside="false" data-multi-open="false">%3$s</ul>',
		'theme_location' => 'main-nav',        			// Where it's located in the theme
		'depth' => 5,                                   // Limit the depth of the nav
		'fallback_cb' => false,                         // Fallback function (see below)
	));
}

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}

class Topbar_Mega_Menu_Walker extends Walker_Nav_Menu {
	public $isMegaMenu;
	public $endMegaMenu;
	public $count;

	public function __construct()
	{
		$this->isMegaMenu = 0;
		$this->endMegaMenu = 0;
		$this->count = 0;
	}

	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"menu\">\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		$output .= "$indent</ul>{$n}";
	}

	/**
	 * Starts the element output.
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$this->count++;

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		if (array_search('mega-menu', $classes) !== false) {
			$this->isMegaMenu = $item->ID;
		}

		$classes[] = 'mm-'.$this->isMegaMenu.' menu-count-'.$this->count.' menu-item-' . $item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of page. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @access public
	 * @param mixed $element Data object.
	 * @param mixed $children_elements List of elements to continue traversing.
	 * @param mixed $max_depth Max depth to traverse.
	 * @param mixed $depth Depth of current element.
	 * @param mixed $args Arguments.
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return; }
		$id_field = $this->db_fields['id'];
		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

// The Off Canvas Menu
function joints_off_canvas_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Off_Canvas_Menu_Walker()
    ));
} 

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}

// The Footer Menu
function joints_footer_widget_1() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Подвал - Первое меню', 'jointswp' ),   	// Nav name
    	'menu_class' => 'vertical menu',      					// Adding custom nav class
    	'menu_id' => 'footer-menu-1',      					// Adding custom nav class
    	'theme_location' => 'footer-menu-1',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */
function joints_footer_widget_2() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Подвал - Второе меню', 'jointswp' ),   	// Nav name
    	'menu_class' => 'vertical menu',      					// Adding custom nav class
    	'menu_id' => 'footer-menu-2',      					// Adding custom nav class
    	'theme_location' => 'footer-menu-2',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */

// Sidebars Menu
function joints_shop_category_links() {
	wp_nav_menu(array(
		'menu_id' => 'shop-category-links',
		'container' => 'false',                         // Remove nav container
		'menu' => __( 'Меню с категориями товаров', 'jointswp' ),   	// Nav name
		'menu_class' => 'menu vertical sidebar-menu',      					// Adding custom nav class
		'theme_location' => 'shop-category-links',             // Where it's located in the theme
		'depth' => 3,                                   // Limit the depth of the nav
		'fallback_cb' => '',  							// Fallback function
        'walker' => new Sidebar_Menu_Walker()
	));
} /* Shop Category */
function joints_blog_category_links() {
	wp_nav_menu(array(
		'menu_id' => 'blog-category-links',
		'container' => 'false',                         // Remove nav container
		'menu' => __( 'Меню с категориями блога', 'jointswp' ),   	// Nav name
		'menu_class' => 'menu vertical sidebar-menu',      					// Adding custom nav class
		'theme_location' => 'blog-category-links',             // Where it's located in the theme
		'depth' => 3,                                   // Limit the depth of the nav
		'fallback_cb' => '',  							// Fallback function
        'walker' => new Sidebar_Menu_Walker()
	));
} /* Blog Category */

class Sidebar_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Starts the element output.
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$is_menu_title = false;
		$is_menu_section = false;

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		if (array_search('menu-title', $classes) !== false) {
			$is_menu_title = true;
		} elseif (array_search('menu-section-title', $classes) !== false) {
			$is_menu_section = true;
		}

		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		if (!$is_menu_section && !$is_menu_title) {
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			$attributes = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;

		if (!$is_menu_section && !$is_menu_title) {
			$item_output .= '<a'. $attributes .'>';
		} else {
			if ($is_menu_title) {
				$item_output .= '<h3>';
			} elseif ($is_menu_section) {
				$item_output .= '<h4>';
			}
		}

		$item_output .= $args->link_before . $title . $args->link_after;

		if (!$is_menu_section && !$is_menu_title) {
			$item_output .= '</a>';
		} else {
			if ($is_menu_title) {
				$item_output .= '</h3>';
			} elseif ($is_menu_section) {
				$item_output .= '</h4>';
			}
		}

		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of page. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @access public
	 * @param mixed $element Data object.
	 * @param mixed $children_elements List of elements to continue traversing.
	 * @param mixed $max_depth Max depth to traverse.
	 * @param mixed $depth Depth of current element.
	 * @param mixed $args Arguments.
	 * @param mixed $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element ) {
			return; }
		$id_field = $this->db_fields['id'];
		// Display this element.
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

// Header Fallback Menu
function joints_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => '',      						// Adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                           // Before each link
        'link_after' => ''                             // After each link
	) );
}

// Footer Fallback Menu
function joints_footer_links_fallback() {
	/* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );

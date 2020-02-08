<?php

// Register Post Type Slider
function post_type_slider() {
	$post_type_slider_labels = array(
		'name'               => _x( 'Slides', 'post type general name', 'jointswp' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'jointswp' ),
		'add_new'            => _x( 'Add New', 'slide', 'jointswp' ),
		'add_new_item'       => __( 'Add New', 'jointswp' ),
		'edit_item'          => __( 'Edit', 'jointswp' ),
		'new_item'           => __( 'New ', 'jointswp' ),
		'all_items'          => __( 'All', 'jointswp' ),
		'view_item'          => __( 'View', 'jointswp' ),
		'search_items'       => __( 'Search for a slide', 'jointswp' ),
		'not_found'          => __( 'No slides found', 'jointswp' ),
		'not_found_in_trash' => __( 'No slides found in the Trash', 'jointswp' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Slider'
	);
	$post_type_slider_args   = array(
		'labels'        => $post_type_slider_labels,
		'description'   => __( 'Display Slider', 'jointswp' ),
		'public'        => true,
		'menu_icon'     => 'dashicons-format-gallery',
		'menu_position' => 5,
		'supports'      => array(
			'title',
			'thumbnail',
			'page-attributes',
			'editor'
		),
		'has_archive'   => true,
		'hierarchical'  => true
	);
	register_post_type( 'joints_slider', $post_type_slider_args );
}

add_action( 'init', 'post_type_slider' );

// now let's add custom categories (these act like categories)
register_taxonomy( 'custom_cat',
	array('joints_slider'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
	      'labels' => array(
		      'name' => __( 'Sliders', 'jointswp' ), /* name of the custom taxonomy */
		      'singular_name' => __( 'Slider', 'jointswp' ), /* single taxonomy name */
		      'search_items' =>  __( 'Search Sliders', 'jointswp' ), /* search title for taxomony */
		      'all_items' => __( 'All Sliders', 'jointswp' ), /* all title for taxonomies */
		      'parent_item' => __( 'Parent Slider', 'jointswp' ), /* parent title for taxonomy */
		      'parent_item_colon' => __( 'Parent Slider:', 'jointswp' ), /* parent taxonomy title */
		      'edit_item' => __( 'Edit Slider', 'jointswp' ), /* edit custom taxonomy title */
		      'update_item' => __( 'Update Slider', 'jointswp' ), /* update title for taxonomy */
		      'add_new_item' => __( 'Add New Slider', 'jointswp' ), /* add new title for taxonomy */
		      'new_item_name' => __( 'New Slider Name', 'jointswp' ), /* name title for taxonomy */
		      'not_found' => __( 'No Sliders Found', 'jointswp' ) /* name title for taxonomy */
	      ),
	      'show_admin_column' => true,
	      'show_ui' => true,
	      'query_var' => true,
	      'rewrite' => array( 'slug' => 'slider' ),
	)
);
<?php
define('JOINTS_VER', '0.0.11');

// Helper library
require_once(get_template_directory().'/assets/functions/helpers.php');

// Extras
require_once(get_template_directory().'/assets/functions/extras.php');

// Content
require_once(get_template_directory().'/assets/functions/content.php');

// Shortcodes
require_once(get_template_directory().'/assets/functions/shortcodes.php');

// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php');

// Media options
require_once(get_template_directory().'/assets/functions/media.php');

// Add customizer options
require_once(get_template_directory().'/assets/functions/customizer.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); 

// ACF Options page
require_once(get_template_directory().'/assets/functions/options.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// User functions
require_once(get_template_directory().'/assets/functions/user.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

// Get the share button code for any site
require_once(get_template_directory().'/assets/functions/social-sharing.php');


// Remove 4.2 Emoji Support
require_once(get_template_directory().'/assets/functions/disable-emoji.php');

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Create slider post type
// require_once(get_template_directory().'/assets/functions/slider-cpt.php');

// Customize the WordPress login menu
require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/admin.php');
// Customize the WordPress admin
require_once(get_template_directory().'/assets/functions/metaboxes.php');

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once(get_template_directory().'/assets/functions/woo.php');
}

//add_action( 'shutdown', function(){
//	print '<pre>';
//	print_r( _get_all_image_sizes() );
//	print '</pre>';
//});
function _get_all_image_sizes() {
	global $_wp_additional_image_sizes;
	$default_image_sizes = array( 'thumbnail', 'medium', 'large' );
	foreach ( $default_image_sizes as $size ) {
		$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
		$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
		$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
	}
	if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
		$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
	}
	return $image_sizes;
}
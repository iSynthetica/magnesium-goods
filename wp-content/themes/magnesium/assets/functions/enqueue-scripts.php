<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	$query_args = array(
		'family' => 'Roboto:400,400i,700,700i',
		'subset' => 'cyrillic'
	);

//	wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
//	wp_enqueue_style('google_fonts');

    // Load What-Input files in footer
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/dist/what-input.min.js', array(), '', true );
    
    // Adding Foundation scripts file in the footer
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery' ), '6.2.3', true );
    
    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), JOINTS_VER, true );
   
    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), JOINTS_VER, 'all' );

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

	// Google Map
	if ( is_page_template( 'page-templates/contacts.php' ) ) {
		wp_enqueue_script('gmap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDBeGNjLt_srVFXjDjduGyHtGu-fzn_Pt4');
		wp_enqueue_script( 'infobox', get_template_directory_uri() . '/assets/js/infobox.js', array( 'gmap' ), '', true );
		wp_enqueue_script( 'map', get_template_directory_uri() . '/assets/js/map.js', array( 'gmap' ), JOINTS_VER, true );

		$location = joints_get_location();
		$marker = get_template_directory_uri() . '/assets/images/marker.svg';

		wp_localize_script('map', 'jointsMapObj', array(
			'accomodations' =>  $location,
			'marker' =>  $marker,
		));
	}

//	wp_localize_script( 'global', 'jointsObj', array(
//		'url'          => admin_url( 'admin-ajax.php' ),
//		'nonce'        => wp_create_nonce( 'joints_nonce' ),
//	) );

//	if (is_page_template( 'page-templates/landingpage.php' ) || is_page_template( 'page-templates/homepage.php' )) {
//		joints_inline_styles();
//		joints_inline_scripts();
//	}
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

if ( !function_exists( 'joints_inline_styles' ) ) {
	function joints_inline_styles() {
		$style = '';
		// wp_add_inline_style( 'site-css', $style );
	}
}

if ( !function_exists( 'joints_inline_scripts' ) ) {
	function joints_inline_scripts() {
		$script = '';
		// wp_add_inline_script( 'understrap-scripts', $script );
	}
}
<?php
/**
 * Display use content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$id = $product->get_id();

$content = get_post_meta($id, 'product_use' , true );
$content = wpautop($content);
echo '<h2>'.joints_get_current_language_string( 'use' ).'</h2>';
echo __(do_shortcode($content));
?>
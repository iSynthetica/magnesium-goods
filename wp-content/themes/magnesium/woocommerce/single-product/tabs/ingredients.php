<?php
/**
 * Display ingredients content
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$id = $product->get_id();

$content = get_post_meta($id, 'product_ingredients' , true );
echo '<h2>'.joints_get_current_language_string( 'ingredients' ).'</h2>';
echo __(wpautop($content));
?>
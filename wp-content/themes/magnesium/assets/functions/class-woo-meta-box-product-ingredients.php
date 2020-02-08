<?php
/**
 * Product Short Description
 *
 * Replaces the standard excerpt box.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin/Meta Boxes
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Meta_Box_Product_Ingredients Class.
 */
class WC_Meta_Box_Product_Ingredients {

	public static function output ( $post ) {
		$settings = array(
			'textarea_name' => 'product_ingredients',
		);
		wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'product_ingredients' , true ) ), 'productIngredients', $settings );
	}

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function outputold( $post ) {

		$settings = array(
			'textarea_name' => 'product_ingredients',
			'quicktags'     => array( 'buttons' => 'em,strong,link' ),
			'tinymce'       => array(
				'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
				'theme_advanced_buttons2' => '',
			),
			'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
		);

		wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'product_ingredients' , true ) ), 'productingredients', $settings );
	}

	public static function save( $post_id, $post ) {
		if (!empty($_POST['product_ingredients'])) {
			$datta = htmlspecialchars( $_POST['product_ingredients'] );
			update_post_meta( $post_id, 'product_ingredients', $datta );
		}
	}
}

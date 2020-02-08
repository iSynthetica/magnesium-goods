<?php
/**
 * Single variation cart button
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php

	/**
	 * joint_woo_variation_add_to_cart_group_open hook
	 *
	 * @hooked joints_add_to_cart_group_open - 10
	 */
    do_action('joint_woo_variation_add_to_cart_group_open');

    /**
     * @since 3.0.0.
     */
    do_action( 'woocommerce_before_add_to_cart_quantity' );

    woocommerce_quantity_input( array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
    ) );

    /**
     * @since 3.0.0.
     */
    do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<button type="submit" class="single_add_to_cart_button add_to_cart_button button alt success"><?php echo joints_get_current_language_string('add_to_cart_single'); ?></button>
	<button type="button" class="single_buy_one_click_button add_to_cart_button button alt warning" data-product-type="variable"><?php echo joints_get_current_language_string('buy_one_click_single'); ?></button>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
    <?php
    /**
     * joint_woo_variation_add_to_cart_group_close hook
     *
     * @hooked joints_add_to_cart_group_close - 10
     */
    do_action('joint_woo_variation_add_to_cart_group_close');
    ?>
</div>

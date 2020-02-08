<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

// echo wc_get_stock_html( $product );

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php
        /**
         * @since 2.1.0.
         */
        do_action( 'woocommerce_before_add_to_cart_button' );

        /**
         * @hooked joints_woo_template_price_attributes_container_open - 5
         * @hooked woocommerce_template_single_price - 10
         * @hooked joints_woo_template_price_attributes_container_close - 15
         */
        do_action( 'joints_woo_before_add_to_cart_button' );

		/**
		 * joint_woo_simple_add_to_cart_group_open hook
		 *
		 * @hooked joints_add_to_cart_group_open - 10
		 */
		do_action('joint_woo_simple_add_to_cart_group_open');

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

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button add_to_cart_button button alt success"><?php echo joints_get_current_language_string('add_to_cart_single'); ?></button>
        <button type="button" class="single_buy_one_click_button add_to_cart_button button alt warning" data-product-type="simple" value="<?php echo esc_attr( $product->get_id() ); ?>"><?php echo joints_get_current_language_string('buy_one_click_single'); ?></button>

		<?php
		/**
		 * joint_woo_simple_add_to_cart_group_close hook
		 *
		 * @hooked joints_add_to_cart_group_close - 10
		 */
		do_action('joint_woo_simple_add_to_cart_group_close');

        /**
         * @since 2.1.0.
         */
        do_action( 'woocommerce_after_add_to_cart_button' );
		?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>

<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="inline-product-item">
    <div class="archive-product-item__inner">
        <div <?php post_class(); ?>>
            <div class="row">
                <div class="columns lmedium-4 smedium-6">
                    <div class="inline-product-item-thumbnail__container" data-mh="inline-product-item">
	                    <?php

	                    /**
	                     * woocommerce_before_shop_loop_item hook.
	                     */
	                    do_action( 'woocommerce_before_shop_loop_item' );

	                    /**
	                     * joints_woo_before_shop_loop_item_thumbnail hook.
	                     *
	                     * @hooked woocommerce_template_loop_product_link_open - 5
	                     */
	                    do_action( 'joints_woo_before_shop_loop_item_thumbnail' );

	                    /**
	                     * joints_woo_shop_loop_item_thumbnail hook.
	                     *
	                     * @hooked woocommerce_template_loop_product_thumbnail - 10
	                     */
	                    echo "<div class='attachment-shop_catalog__holder'>";
	                    do_action( 'joints_woo_shop_loop_item_thumbnail' );
	                    echo "</div>";

	                    /**
	                     * joints_woo_after_shop_loop_item_thumbnail hook.
	                     *
	                     * @hooked woocommerce_template_loop_product_link_close - 5
	                     * @hooked woocommerce_template_loop_rating - 10
	                     * @hooked joints_woo_template_loop_comments - 15
	                     * @hooked joints_woo_template_loop_sale_percentage - 20
	                     */
	                    do_action( 'joints_woo_after_shop_loop_item_thumbnail' );

	                    /**
	                     * woocommerce_before_shop_loop_item_title hook.
	                     *
	                     * @hooked woocommerce_template_loop_price - 5
	                     * @hooked woocommerce_template_loop_add_to_cart - 5
	                     */
	                    do_action( 'woocommerce_before_shop_loop_item_title' );
	                    ?>
                    </div>
                </div>

                <div class="columns lmedium-8 smedium-6">
                    <div class="inline-product-item-details__container" data-mh="inline-product-item">
                        <div class="inline-product-item-details__holder">
	                        <?php
	                        /**
	                         * woocommerce_shop_loop_item_title hook.
	                         *
	                         * @hooked woocommerce_template_loop_product_link_open - 5
	                         * @hooked joints_woo_template_loop_product_title - 10
	                         */
	                        do_action( 'woocommerce_shop_loop_item_title' );

	                        /**
	                         * woocommerce_after_shop_loop_item_title hook.
	                         *
	                         * @hooked woocommerce_template_loop_product_link_close - 10
	                         */
	                        do_action( 'woocommerce_after_shop_loop_item_title' );

	                        /**
	                         * joints_woo_after_inline_shop_loop_item_title
	                         *
	                         * @hooked woocommerce_template_single_excerpt - 20
	                         * @hooked joints_woo_template_loop_product_read_more - 30
	                         */
	                        do_action('joints_woo_after_inline_shop_loop_item_title');

	                        /**
	                         * woocommerce_after_shop_loop_item hook.
	                         */
	                        do_action( 'woocommerce_after_shop_loop_item' );

	                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- post_class(); -->
    </div> <!-- .product-item__inner -->
</div> <!-- .product-item -->

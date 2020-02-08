<?php
/**
 * Custom WooCommerce Template Hooks
 *
 * wp-content/plugins/woocommerce/includes/wc-template-hooks.php
 */

/**
 * =====================================
 *  Products Archive
 * =====================================
 */

add_filter( 'woocommerce_default_catalog_orderby_options', 'joints_woo_sort_by_title' );  // Add options to WooCommerce/Settings/Products/Display
add_filter( 'woocommerce_catalog_orderby', 'joints_woo_sort_by_title' );  // Add options to sort dropdown on category page.

/**
 * Products Loop.
 *
 * @see joints_woo_page_navi()
 */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

add_action( 'woocommerce_after_shop_loop', 'joints_woo_page_navi', 10 );

/**
 * =====================================
 * Product Loop Items.
 * =====================================
 *
 * @see joints_woo_template_loop_rating_discount_reviews()
 * @see joints_woo_template_loop_product_title()
 * @see joints_woo_template_loop_rating_reviews_open()
 * @see joints_woo_template_loop_product_read_more()
 * @see ()
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'joints_woo_before_shop_loop_item_thumbnail', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'joints_woo_shop_loop_item_thumbnail', 'woocommerce_template_loop_product_thumbnail', 5 );
add_action( 'joints_woo_after_shop_loop_item_thumbnail', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'joints_woo_after_shop_loop_item_thumbnail', 'joints_woo_template_loop_rating_discount_reviews', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'joints_woo_template_loop_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 );
add_action( 'joints_woo_after_inline_shop_loop_item_title', 'woocommerce_template_single_excerpt', 20 );
add_action( 'joints_woo_after_inline_shop_loop_item_title', 'joints_woo_template_loop_product_read_more', 30 );

add_action( 'joints_woo_loop_rating_discount_reviews', 'joints_woo_template_loop_rating_reviews_open', 3 );
add_action( 'joints_woo_loop_rating_discount_reviews', 'woocommerce_template_loop_rating', 5 );
add_action( 'joints_woo_loop_rating_discount_reviews', 'joints_woo_template_loop_comments', 10 );
add_action( 'joints_woo_loop_rating_discount_reviews', 'joints_woo_template_loop_rating_reviews_close', 12 );
add_action( 'joints_woo_loop_rating_discount_reviews', 'joints_woo_template_loop_sale_percentage', 15 );

/**
 * =====================================
 *  Single Product
 * =====================================
 *
 * Hooks
 * -------------------------------------
 * woocommerce_before_single_product
 * woocommerce_before_single_product_summary
 * woocommerce_single_product_summary
 * woocommerce_after_single_product_summary
 * woocommerce_after_single_product
 * -------------------------------------
 *
 * Hooked
 * @see joints_woo_single_images_container_open()
 * @see woocommerce_show_product_images()
 * @see joints_woo_single_images_container_close()
 * @see joints_woo_single_summary_container_open()
 * @see joints_woo_single_header_container_close()
 * @see joints_share_buttons()
 * @see woocommerce_template_single_add_to_cart()
 * @see joints_woo_single_summary_container_open()
 * @see joints_woo_single_summary_container_close()
 * @see joints_woo_single_tab_container_close()
 * @see comments_template()
 * @see joints_woo_single_reviews_container_close()
 * @see joints_woo_single_buy_one_click_form()
 */

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_before_single_product_summary', 'joints_woo_single_images_container_open', 10 );
add_action( 'woocommerce_before_single_product_summary', 'joints_woo_single_images_container_close', 30 );
add_action( 'woocommerce_before_single_product_summary', 'joints_woo_single_summary_container_open', 40 );

add_action( 'woocommerce_single_product_summary', 'joints_woo_single_header_container_open', 3 );
add_action( 'woocommerce_single_product_summary', 'joints_woo_single_header_container_close', 13 );
add_action( 'woocommerce_single_product_summary', 'joints_woo_single_effect_icons', 15 );
add_action( 'woocommerce_single_product_summary', 'joints_share_buttons', 50 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

add_action( 'woocommerce_after_single_product_summary', 'joints_woo_single_summary_container_close', 5 );
add_action( 'woocommerce_after_single_product_summary', 'joints_woo_single_tab_container_close', 12 );
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 13 );
add_action( 'woocommerce_after_single_product_summary', 'joints_woo_single_reviews_container_close', 14 );
add_action( 'woocommerce_after_single_product_summary', 'joints_products_shortcode', 30 );

add_action( 'woocommerce_after_single_product', 'joints_woo_single_buy_one_click_form', 10 );

/**
 * =====================================
 *  Single Product - Add to Cart - Simple
 * =====================================
 *
 * Hooks
 * -------------------------------------
 * woocommerce_before_add_to_cart_form
 * woocommerce_before_add_to_cart_button
 * joints_woo_before_add_to_cart_button
 * woocommerce_before_add_to_cart_quantity
 * woocommerce_after_add_to_cart_quantity
 * woocommerce_after_add_to_cart_button
 * woocommerce_after_add_to_cart_form
 * -------------------------------------
 *
 * Hooked
 * @see joints_woo_template_price_attributes_container_open()
 * @see woocommerce_template_single_price()
 * @see joints_woo_template_price_attributes_container_close()
 */

remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );

add_action( 'joints_woo_before_add_to_cart_button', 'joints_woo_template_price_attributes_container_open', 5 );
add_action( 'joints_woo_before_add_to_cart_button', 'woocommerce_template_single_price', 10 );
add_action( 'joints_woo_before_add_to_cart_button', 'joints_woo_template_price_attributes_container_close', 15 );

add_action( 'joints_woo_single_variation', 'woocommerce_single_variation', 10 );

add_filter( 'woocommerce_get_price_html', 'joints_woo_get_price_html' );

/**
 * =====================================
 *  Single Product Review
 * =====================================
 *
 * Hooks
 * -------------------------------------
 * woocommerce_review_before
 * woocommerce_review_before_comment_meta
 * woocommerce_review_meta
 * woocommerce_review_before_comment_text
 * woocommerce_review_comment_text
 * woocommerce_review_after_comment_text
 * -------------------------------------
 *
 * Hooked
 * @see joints_woo_single_images_container_open()
 */
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
remove_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );

add_action( 'woocommerce_review_after_comment_text', 'woocommerce_review_display_meta', 10 );
add_action( 'joints_woo_review_meta', 'woocommerce_review_display_rating', 10 );


/**
 * =====================================
 *  Single Product Simple Add to Cart
 * /woocommerce/single-product/add-to-cart/simple.php
 * =====================================
 *
 * Hooks
 * -------------------------------------
 * woocommerce_before_add_to_cart_form
 * woocommerce_before_add_to_cart_button
 * joints_woo_before_add_to_cart_button
 * joint_woo_simple_add_to_cart_group_open
 * woocommerce_before_add_to_cart_quantity
 * woocommerce_after_add_to_cart_quantity
 * joint_woo_simple_add_to_cart_group_close
 * woocommerce_after_add_to_cart_button
 * woocommerce_after_add_to_cart_form
 * -------------------------------------
 *
 * Hooked
 * @see joints_add_to_cart_group_open()
 * @see joints_add_to_cart_group_open()
 */
add_action('joint_woo_simple_add_to_cart_group_open', 'joints_add_to_cart_group_open', 10);
add_action('joint_woo_simple_add_to_cart_group_close', 'joints_add_to_cart_group_close', 10);


/**
 * =====================================
 *  Single Product Variable Add to Cart
 * /woocommerce/single-product/add-to-cart/variation-add-to-cart-button.php
 * =====================================
 *
 * Hooks
 * -------------------------------------
 * joint_woo_variation_add_to_cart_group_open
 * woocommerce_before_add_to_cart_quantity
 * woocommerce_after_add_to_cart_quantity
 * joint_woo_variation_add_to_cart_group_close
 * -------------------------------------
 *
 * Hooked
 * @see joints_add_to_cart_group_open()
 * @see joints_add_to_cart_group_open()
 */
add_action('joint_woo_variation_add_to_cart_group_open', 'joints_add_to_cart_group_open', 10);
add_action('joint_woo_variation_add_to_cart_group_close', 'joints_add_to_cart_group_close', 10);

/**
 * Product tabs
 *
 * @see joints_woo_custom_product_tabs()
 */
add_filter( 'woocommerce_product_tabs', 'joints_woo_custom_product_tabs' );


/**
 * Cart widget
 */
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

add_action( 'woocommerce_widget_shopping_cart_buttons', 'joints_woo_widget_shopping_cart_button_view_cart', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'joints_woo_widget_shopping_cart_proceed_to_checkout', 20 );

/**
 * =====================================
 *  My Account
 * =====================================
 *
 * Hooked
 *
 * form-login.php
 * @see joints_woo_avatar_field
 */

remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' );
add_action( 'joints_woo_account_navigation', 'woocommerce_account_navigation' );

// form-login.php

add_action( 'woocommerce_register_form_start', 'joints_woo_extra_register_fields' );
add_filter( 'woocommerce_process_registration_errors', 'joints_woo_validate_extra_register_fields', 10, 4 );
add_action( 'woocommerce_created_customer', 'joints_woo_save_extra_register_fields' );

add_action( 'woocommerce_register_form', 'joints_woo_avatar_account_registration', 10 );
add_filter( 'woocommerce_process_registration_errors', 'joints_woo_validate_avatar_field', 10, 4 );
add_action( 'woocommerce_created_customer', 'joints_woo_save_avatar_fields' );
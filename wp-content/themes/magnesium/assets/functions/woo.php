<?php

/**
 * Add Woocommerce support to theme
 */
function woocommerce_support()
{
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'woocommerce_support' );

/**
 * Switched off Woocommerce styling
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter( 'woocommerce_enqueue_styles', 'joints_woo_dequeue_styles' );

function joints_woo_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

/**
 * Output WooCommerce content.
 *
 * This function is only used in the optional 'woocommerce.php' template.
 * which people can add to their themes to add basic woocommerce support.
 * without hooks or modifying core templates.
 */
function joints_woo_content() {
	if ( is_singular( 'product' ) ) {
		while ( have_posts() ) : the_post();
			wc_get_template_part( 'single', 'product' );
		endwhile;
	} else {
		wc_get_template_part( 'archive', 'products' );
	}
}

require_once(get_template_directory().'/assets/functions/woo-template-hooks.php');
require_once(get_template_directory().'/assets/functions/woo-template-functions.php');

if ( joints_is_request( 'admin' ) ) {
	require_once(get_template_directory().'/assets/functions/woo-admin.php');
}

add_action( 'add_meta_boxes', 'joints_woo_add_meta_boxes', 40 );
add_action( 'save_post', 'joints_woo_save_meta_boxes', 1, 2 );

function joints_woo_add_meta_boxes()
{
	add_meta_box( 'product_use_mb', __( 'Применение', 'woocommerce' ), 'joints_woo_product_use_mb', 'product', 'normal' );
	add_meta_box( 'product_ingredients_mb', __( 'Состав', 'woocommerce' ), 'joints_woo_product_ingredients_mb', 'product', 'normal' );
}

/**
 * Output the metabox.
 *
 * @param WP_Post $post
 */
function joints_woo_product_ingredients_mb( $post ) {
    $settings = array(
	    'textarea_name' => 'product_ingredients',
	    'editor_css'    => '<style>#wp-productingredients-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
    );
	wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'product_ingredients' , true ) ), 'productingredients', $settings );
}

/**
 * Output the metabox.
 *
 * @param WP_Post $post
 */
function joints_woo_product_use_mb( $post ) {
    $settings = array(
	    'textarea_name' => 'product_use',
    );
	wp_editor( htmlspecialchars_decode( get_post_meta($post->ID, 'product_use' , true ) ), 'productuse', $settings );
}

/**
 * Save Use and Ingredients metaboxes data
 *
 * @param $post_id
 * @param $post
 */
function joints_woo_save_meta_boxes( $post_id, $post )
{
	// $post_id and $post are required
	if ( empty( $post_id ) || empty( $post ) ) {
		return;
	}

	// Dont' save meta boxes for revisions or autosaves
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
		return;
	}

	// Check the nonce
	if ( empty( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( $_POST['woocommerce_meta_nonce'], 'woocommerce_save_data' ) ) {
		return;
	}

	// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
	if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
		return;
	}

	// Check user has permission to edit
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if (!empty($_POST['product_ingredients'])) {
		$datta = wp_kses_post( $_POST['product_ingredients'] );
		update_post_meta( $post_id, 'product_ingredients', $datta );
	}

	if (!empty($_POST['product_use'])) {
		$datta = wp_kses_post( $_POST['product_use'] );
		update_post_meta( $post_id, 'product_use', $datta );
	}
}

/**
 * Change default currency symbol to custom one
 *
 * @param $currency_symbol
 * @param $currency
 *
 * @return mixed|null|string|void
 */
function joints_woo_change_currency_symbol( $currency_symbol, $currency )
{
    $currency_symbol = joints_get_current_language_string( 'currency_uah' );
	switch( $currency ) {
		case 'UAH': $currency_symbol = __($currency_symbol); break;
	}
	return $currency_symbol;
}

add_filter('woocommerce_currency_symbol', 'joints_woo_change_currency_symbol', 10, 2);

/**
 * Display cart icon with total on main menu bar
 */
function joints_woo_show_cart_icon () {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		?>
		<a class="mini-cart-contents"
           href="<?php echo esc_url( wc_get_cart_url() ); ?>"
           title="<?php _e( 'View your shopping cart' ); ?>"
        >
            <span class="mini-cart-contents__icon">
                <i class="fa fa-shopping-cart"></i>
            </span>
            <span class="mini-cart-contents__count">
                <?php echo wp_kses_data(  WC()->cart->get_cart_contents_count()  );?>
            </span>
            <span class="mini-cart-contents__amount">
                <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
            </span>
		</a>
		<?php
	}
}

/**
 * Output the view cart button.
 *
 * @subpackage	Cart
 */
function joints_woo_widget_shopping_cart_button_view_cart() {
	echo '<div>';
	echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button warning wc-forward">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
	echo '</div>';
}

/**
 * Output the proceed to checkout button.
 *
 * @subpackage	Cart
 */
function joints_woo_widget_shopping_cart_proceed_to_checkout() {
	echo '<div>';
	echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout warning wc-forward">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
	echo '</div>';
}

/**
 * Cart Fragments
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 * @param  array $fragments Fragments to refresh via AJAX.
 * @return array            Fragments to refresh via AJAX
 */
function joints_woo_cart_link_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	joints_woo_show_cart_icon();
	$fragments['a.mini-cart-contents'] = ob_get_clean();

	return $fragments;
}

/**
 * Cart fragment
 *
 * @see storefront_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'joints_woo_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'joints_woo_cart_link_fragment' );
}

/**
 * Get price for single simple product
 *
 * @param $product
 *
 * @return array
 */
function joints_get_simple_prices( $product )
{
	if ( '' === $product->get_price() ) {
		$prices_array = array(
			'right' => '',
			'left'  => ''
		);
	} elseif ( $product->is_on_sale() ) {
		$prices_array = array(
			'right' => '<ins>' . wc_price( wc_get_price_to_display( $product ) ) . '</ins>',
			'left'  => '<del>' . wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ) ) . '</del>'
		);
	} else {
		$prices_array = array(
			'right' => wc_price( wc_get_price_to_display( $product ) ),
			'left'  => ''
		);
	}

	return $prices_array;
}

/**
 * Get price for single variable product
 *
 * @param $product
 *
 * @return array
 */
function joints_get_variable_prices( $product )
{
	$prices = $product->get_variation_prices( true );

	if ( empty( $prices['price'] ) ) {
		$prices_array = array(
			'right' => '',
			'left'  => ''
		);
	} else {
		$min_price     = current( $prices['price'] );
		$max_price     = end( $prices['price'] );
		$min_reg_price = current( $prices['regular_price'] );
		$max_reg_price = end( $prices['regular_price'] );

		if ( $min_price !== $max_price ) {
			$prices_array = array(
				'right' => wc_price( $max_price ),
				'left'  => wc_price( $min_price ),
                'divider' => ' <span class="woocommerce-Price-divider">-</span> '
			);
		} elseif ( $this->is_on_sale() && $min_reg_price === $max_reg_price ) {
			$prices_array = array(
				'right' => '<del>' . wc_price( $min_price ) . '</del>',
				'left'  => '<ins>' . wc_price( $max_reg_price ) . '</ins>'
			);
		} else {
			$prices_array = array(
				'right' => wc_price( $min_price ),
				'left'  => ''
			);
		}
	}

	return $prices_array;
}
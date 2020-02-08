<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 28.12.2017
 * Time: 14:46
 */


function joints_woo_sort_by_title($orderby_array)
{
	$orderby_array[ 'title' ] = joints_get_current_language_string('product_sort_by_title_asc');
	$orderby_array[ 'title-desc' ] = joints_get_current_language_string('product_sort_by_title_desc');
	return $orderby_array;
}

/**
 * Output the pagination after shop loops.
 */
function joints_woo_page_navi()
{
	joints_page_navi();
}

/**
 * Show the product title in the product loop.
 */
function joints_woo_template_loop_product_title() {
	echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
	echo '<h3 class="woocommerce-loop-product__subtitle">' . get_field('sub_title', get_the_ID()) . '</h3>';
}

/**
 * Show the product read more in the product loop.
 */
function joints_woo_template_loop_product_read_more() {
	wc_get_template( 'loop/read-more.php' );
}

/**
 * Show the product read more in the product loop.
 */
function joints_woo_single_effect_icons() {
	wc_get_template( 'single-product/effects-icons.php' );
}

/**
 * Display the comments count in the loop.
 */
function joints_woo_template_loop_rating_discount_reviews() {
	wc_get_template( 'loop/rating-discount-reviews.php' );
}

/**
 * Display the sale percentage in the loop.
 *
 * @subpackage	Loop
 */
function joints_woo_template_loop_sale_percentage() {
	wc_get_template( 'loop/sale-discount.php' );
}

/**
 * Display the comments count in the loop.
 *
 * @subpackage	Loop
 */
function joints_woo_template_loop_comments() {
	wc_get_template( 'loop/comments.php' );
}

/**
 * Open rating reviews container
 */
function joints_woo_template_loop_rating_reviews_open()
{
	?>
	<div class="rating-reviews__container">
	<?php
}

/**
 * Close rating reviews container
 */
function joints_woo_template_loop_rating_reviews_close()
{
	?>
	</div>
	<?php
}

/**
 * Open container for single product image gallery
 */
function joints_woo_single_images_container_open(){
    ?>
    <div class="row product-main-content__container">
        <div class="lmedium-4 columns">
    <?php
}

/**
 * Close container for single product image gallery
 */
function joints_woo_single_images_container_close(){
    ?>
    </div><!-- .lmedium-4.columns -->
    <?php
}

/**
 * Close container for single product header
 */
function joints_woo_single_header_container_open(){
    ?>
    <div class="woocommerce-product-details__header">
    <?php
}

/**
 * Close container for single product header
 */
function joints_woo_single_header_container_close(){
    ?>
    </div><!-- .woocommerce-product-details__header -->
    <?php
}
/**
 * Close container for single product header
 */
function joints_woo_template_price_attributes_container_open(){
    ?>
    <div class="woocommerce-product-details__price-attributes">
        <div class="woocommerce-product-details__price-attributes__holder">
    <?php
}

/**
 * Close container for single product header
 */
function joints_woo_template_price_attributes_container_close(){
    ?>
        </div><!-- .woocommerce-product-details__price-attributes__holder -->
    </div><!-- .woocommerce-product-details__price-attributes -->
    <?php
}



/**
 * Close container for single product summary
 */
function joints_woo_single_summary_container_open(){
	?>
    <div class="lmedium-8 columns">
    <?php
}

/**
 * Close container for single product summary
 */
function joints_woo_single_summary_container_close(){
    ?>
        </div><!-- .lmedium-8.columns -->
    </div><!-- .row -->

    <div class="row product-meta-content__container">
        <div class="lmedium-8 columns">
    <?php
}

/**
 * Close container for single product summary
 */
function joints_woo_single_tab_container_close(){
    ?>
        </div><!-- .lmedium-8.columns -->

        <div class="lmedium-4 columns">
    <?php
}

/**
 * Close container for single product summary
 */
function joints_woo_single_reviews_container_close(){
	?>
        </div><!-- .lmedium-4.columns -->
    </div><!-- .row -->
	<?php
}

/**
 * @param $price
 *
 * @return string
 */
function joints_woo_get_price_html( $price ) {
	if ( is_product() && is_main_query() ) {
		$price = '<span class="woocommerce-Price-label">' . joints_get_current_language_string( 'price' ) . ': </span>' . $price;
	}
	return $price;
}

/**
 *
 */
function joints_add_to_cart_group_open()
{
    ?>
    <div class="add-to-cart-group__container">
        <div class="add-to-cart-group__inner">
    <?php
}

/**
 *
 */
function joints_add_to_cart_group_close()
{
	?>
        </div>
    </div>
	<?php
}

function joints_woo_single_buy_one_click_form()
{
    ?>
    <div class="reveal" id="buy_one_click_form" data-reveal>
        <h1>Awesome. I Have It.</h1>
        <form class="buy_one_click_form" method="post" enctype='multipart/form-data'>
            <div class="row">
                <div class="columns lmedium-6">
                    <label><?php echo __( 'First name', 'woocommerce' ); ?>
                        <input type="text" name="first_name">
                    </label>
                </div>
                <div class="columns lmedium-6">
                    <label><?php echo __( 'Last name', 'woocommerce' ); ?>
                        <input type="text" name="last_name">
                    </label>
                </div>
                <div class="columns lmedium-6">
                    <label><?php echo __( 'Email address', 'woocommerce' ); ?>
                        <input type="email" name="email">
                    </label>
                </div>
                <div class="columns lmedium-6">
                    <label><?php echo __( 'Phone', 'woocommerce' ); ?>
                        <input type="tel" name="phone">
                    </label>
                </div>
            </div>
        </form>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}

/**
 * Add custom tabs: Use & Ingredients
 * Remove Reviews tab
 *
 * @param $tabs
 *
 * @return mixed
 *
 * @see joints_woo_use_product_tab()
 * @see joints_woo_ingredients_product_tab()
 */
function joints_woo_custom_product_tabs( $tabs )
{
	$tabs['use_tab'] = array(
		'title' 	=> joints_get_current_language_string( 'use' ),
		'priority' 	=> 50,
		'callback' 	=> 'joints_woo_use_product_tab'
	);

	$tabs['ingredients_tab'] = array(
		'title' 	=> joints_get_current_language_string( 'ingredients' ),
		'priority' 	=> 60,
		'callback' 	=> 'joints_woo_ingredients_product_tab'
	);

	unset( $tabs['reviews'] ); 			// Remove the reviews tab

	return $tabs;
}

function joints_woo_use_product_tab()
{
	wc_get_template( 'single-product/tabs/use.php' );
}

function joints_woo_ingredients_product_tab()
{
	wc_get_template( 'single-product/tabs/ingredients.php' );
}

/**
 * Display Woocommerce product rating
 *
 * @param $rating int min 0 max 5
 * @param string $size (sm | lg)
 */
function joints_woo_rating($rating, $size = 'md')
{
	if ( !$rating ) {
		$rating_percentage = 0;
	} else {
		$rating_percentage = ($rating / 5) * 100;
	}
	?>
    <div class="rating__container rating-<?php echo $size; ?>">
        <div class="rating__holder">
            <div class="rating-top__holder" style="width:<?php echo $rating_percentage ?>%">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
            <div class="rating-bottom__holder">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>
	<?php
}

function joints_woo_comments() {
    echo '</div>';
}

/**
 * Add Extra fields
 */
function joints_woo_extra_register_fields() {
	?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p class="form-row form-row-wide">
            <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
        </p>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p class="form-row form-row-wide">
            <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text form-control" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
        </p>
    </div>

    <div class="clear"></div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p class="form-row form-row-wide">
            <label for="reg_billing_city"><?php _e( 'City', 'woocommerce' ); ?></label>
            <input type="text" class="input-text form-control" name="billing_city" id="reg_billing_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
        </p>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <p class="form-row form-row-wide">
            <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
            <input type="text" class="input-text ua-phone form-control" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" placeholder="+380XXXXXXXXX" />
        </p>
    </div>

    <div class="clear"></div>
	<?php
}

function joints_woo_validate_extra_register_fields( $validation_errors, $username, $password, $email ) {
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
		$validation_errors->add( 'billing_first_name_error', joints_get_current_language_string( 'error_required_first_name' ) );
	}

	if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		$validation_errors->add( 'billing_last_name_error', joints_get_current_language_string( 'error_required_last_name' ) );
	}

	return $validation_errors;
}

function joints_woo_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['billing_first_name'] ) ) {
		// WordPress default first name field.
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

		// WooCommerce billing first name.
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}

	if ( isset( $_POST['billing_last_name'] ) ) {
		// WordPress default last name field.
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

		// WooCommerce billing last name.
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}

	if ( isset( $_POST['billing_phone'] ) ) {
		// WooCommerce billing phone
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}

	if ( isset( $_POST['billing_city'] ) ) {
		// WooCommerce billing phone
		update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
	}
}

/**
 * Add Avatar field in register form
 */
function joints_woo_avatar_account_registration()
{
	?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="basic-local-avatar"><?php _e( 'Avatar', 'woocommerce' ); ?></label>
        <input type="file" name="basic-user-avatar" id="basic-local-avatar" />
    </p>

    <script type="text/javascript">
        var form = document.getElementById('register-form');
        form.encoding = 'multipart/form-data';
        form.setAttribute('enctype', 'multipart/form-data');
    </script>
	<?php
}

function joints_woo_validate_avatar_field( $validation_errors, $username, $password, $email )
{
	if ( ! empty( $_FILES['basic-user-avatar']['name'] ) ) {
		if ( strstr( $_FILES['basic-user-avatar']['name'], '.php' ) ) {
			$validation_errors->add( 'basic_user_avatar_error', __( '<strong>Error</strong>: For security reasons, the extension ".php" cannot be in your file name.', 'woocommerce' ) );
		}

		$check = getimagesize($_FILES["basic-user-avatar"]["tmp_name"]);

		if(!$check) {
			$validation_errors->add( 'basic_user_avatar_image_error', __( '<strong>Error</strong>: File is not an image.', 'woocommerce' ) );
		}
	}
	return $validation_errors;
}

function joints_woo_save_avatar_fields( $customer_id )
{
	if ( ! empty( $_FILES['basic-user-avatar']['name'] ) ) {
		// Allowed file extensions/types
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
		);
		// Front end support - shortcode, bbPress, etc
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Make user_id known to unique_filename_callback function
		$avatar = wp_handle_upload( $_FILES['basic-user-avatar'], array( 'mimes' => $mimes, 'test_form' => false ) );

		// Save user information (overwriting previous)
		update_user_meta( $customer_id, 'basic_user_avatar', array( 'full' => $avatar['url'] ) );
	}
}
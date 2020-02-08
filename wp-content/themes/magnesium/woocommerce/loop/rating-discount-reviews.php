<?php
/**
 * Loop Rating, Discount, Reviews
 *
 * @version     1.0.0
 */
?>

<div class="rating-discount-reviews__container">
	<?php
	/**
	 * joints_woo_loop_rating_discount_reviews
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked joints_woo_template_loop_comments - 10
	 * @hooked joints_woo_template_loop_sale_percentage - 15
	 */
	do_action('joints_woo_loop_rating_discount_reviews');
	?>
</div>
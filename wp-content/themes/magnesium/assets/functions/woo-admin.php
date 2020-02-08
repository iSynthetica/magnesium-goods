<?php

add_action('admin_head', 'joints_woo_admin_style');

function joints_woo_admin_style() {
	?>
	<style>
		.woocommerce_variable_attributes .form-row.options label:nth-child(2),
		.woocommerce_variable_attributes .form-row.options label:nth-child(3)
		{
			display: none !important;
		}
	</style>
	<?php
}

/**
 * Remove useless product types
 *
 * @param $types
 * @return mixed
 */
function joints_product_type_selector( $types )
{
	unset($types['grouped']);
	unset($types['external']);

	return $types;
}
add_filter('product_type_selector', 'joints_product_type_selector');

/**
 * Tweak product type options
 *
 * @param  array $options
 * @return array
 */
function joints_product_type_options( $options )
{
	$options['virtual']['wrapper_class'] = 'hide_if_variable hide_if_simple';
	$options['downloadable']['wrapper_class'] = 'hide_if_variable hide_if_simple';

	return $options;
}
add_filter('product_type_options', 'joints_product_type_options');

/**
 * Managing product tabs in admin
 *
 * @param $tabs
 * @return mixed
 */

function joints_woo_product_data_tabs( $tabs )
{
	// Other default values for 'attribute' are; general, inventory, shipping, linked_product, variations, advanced
	$tabs['attribute']['class'][] = 'hide_if_simple';
	$tabs['advanced']['class'][] = 'hide_if_simple hide_if_variable';

	return $tabs;
}
add_filter('woocommerce_product_data_tabs', 'joints_woo_product_data_tabs');

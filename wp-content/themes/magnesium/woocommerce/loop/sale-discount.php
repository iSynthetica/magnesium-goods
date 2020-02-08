<?php

global $product;

if ( $product->is_on_sale() && ! $product->is_type( 'grouped' ) ) {
	if ( ! $product->is_type( 'variable' ) ) {
		$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
	} else {
		$max_percentage = 0;

		foreach ( $product->get_children() as $child_id ) {
			$variation = wc_get_product( $child_id );
			$price = $variation->get_regular_price();
			$sale = $variation->get_sale_price();
			if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
			if ( $percentage > $max_percentage ) {
				$max_percentage = $percentage;
			}
		}
	}
	?>
    <div class="sale-discount__container">
        <div class='sale-discount__holder'>
		    <?php echo joints_get_current_language_string( 'sale' ); ?> <span><?php echo round($max_percentage) ?>%</span>
        </div>
    </div>
	<?php
}
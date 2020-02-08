<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<div class="price__container">
    <div class="price__holder">
        <?php
        if ( $product->is_type( 'variable' ) ) {
            $prices =  joints_get_variable_prices( $product );
            //var_dump( $prices );
            if ( $price_html = $product->get_price_html() ) {
                if (!empty( $prices['left'] )) {
                    ?>
                    <span class="price__holder-left">
                        <span class="price"><?php echo $prices['left']; ?></span>
                    </span>
                    <?php
                }

                if (!empty( $prices['divider'] )) {
	                ?>
                    <span class="price__holder-divider">
                        <span class="price"><?php echo $prices['divider']; ?></span>
                    </span>
	                <?php
                }

                if (!empty( $prices['right'] )) {
	                ?>
                    <span class="price__holder-right">
                        <span class="price"><?php echo $prices['right']; ?></span>
                    </span>
	                <?php
                }
            }
        } else {
	        $prices =  joints_get_simple_prices( $product );
            //var_dump( $prices );

            if ( $price_html = $product->get_price_html() ) {
	            if (!empty( $prices['left'] )) {
		            ?>
                    <span class="price__holder-left">
                        <span class="price"><?php echo $prices['left']; ?></span>
                    </span>
		            <?php
	            }

	            if (!empty( $prices['right'] )) {
		            ?>
                    <span class="price__holder-right">
                        <span class="price"><?php echo $prices['right']; ?></span>
                    </span>
		            <?php
	            }
            }
        }
        ?>
    </div>
</div>

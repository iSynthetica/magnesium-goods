<?php
/**
 * Single Product tabs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist" data-tabs id="wc-single-tabs">
            <?php
            $i = 1;
            foreach ( $tabs as $key => $tab ) :
                ?>
				<li class="tabs-title<?php echo 1 === $i ? ' is-active' : '' ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
				<?php
				$i++;
			endforeach;
			?>
		</ul>

        <div class="tabs-content" data-tabs-content="wc-single-tabs">
	        <?php
	        $i = 1;
	        foreach ( $tabs as $key => $tab ) :
                ?>
                <div class="tabs-panel<?php echo 1 === $i ? ' is-active' : '' ?>" id="tab-<?php echo esc_attr( $key ); ?>">
			        <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                </div>
		        <?php
		        $i++;
            endforeach;
	        ?>
        </div>
	</div>
<?php endif; ?>

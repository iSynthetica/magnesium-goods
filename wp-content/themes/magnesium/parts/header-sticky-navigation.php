<?php
/**
 * Displaying sticky menu on desktop sizes
 */

$sticky_logo = get_theme_mod( 'custom_sticky_logo' );
?>

<div class="sticky-navigation-header show-for-lmedium">
    <div class="row">
        <div class="header-inner__container">
            <div class="branding__column">
                <div class="branding-inner__container">
                    <div class="logo__container">
                        <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
                            <img src="<?php echo $sticky_logo ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="columns header-links__column">
                <div class="header-links-inner__container">
					<?php get_template_part( 'parts/nav', 'topbar' ); ?>
                </div>
            </div>
            <div class="cart__column">
                <div class="cart-inner__container">
                    <?php joints_woo_show_cart_icon (); ?>
                </div>
            </div>
        </div>
    </div>
</div>
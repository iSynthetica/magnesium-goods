<?php
/**
 *
 */
$mobile_logo = get_theme_mod( 'custom_mobile_logo' );
?>

<div class="mobile-header__container hide-for-lmedium">
	<div class="row">
        <div class="mobile-header-inner__container">
            <div class="navigation-control__container">
                <div class="branding__column">
                    <div class="branding-inner__container">
                        <div class="logo__container">
                            <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
                                <img src="<?php echo $mobile_logo ?>" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="columns control-links__column">
                    <div class="control-links-inner__container">
                        <span class="icon-styled-1 toOverlay" data-overlay-id="cart-summary">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
	                    <?php
                        if ( is_user_logged_in() ) {
                            ?>
                            <a
                                href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                                title="<?php _e('My Account','woothemes'); ?>"
                                class="icon-styled-1"
                            >
                                <i class="fa fa-user"></i>
                            </a>
	                        <?php
                        }
	                    else {
                            ?>
                            <a
                                href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                                title="<?php _e('Login / Register','woothemes'); ?>"
                                class="icon-styled-1"
                            >
                                <i class="fa fa-user"></i>
                            </a>
	                    <?php
                        }
                        ?>
                        <span class="icon-styled-1 toOverlay" data-overlay-id="mobile-main-menu">
                            <i class="fa fa-bars"></i>
                        </span>
			            <?php //get_template_part( 'parts/nav', 'topbar' ); ?>
                    </div>
                </div>
            </div>
            <div id="mobile-main-menu" style="display: none">
                <div class="mobile-main-menu__container">
                    <div class="mobile-main-menu-content__container content__container">
                        <?php joints_mobile_top_nav(); ?>
                    </div>
                </div>
            </div>
            <div id="cart-summary" class="cart-summary__container" style="display: none">
                <div class="cart-summary-content__container">
	                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </div>
            </div>
        </div>
	</div>
</div>
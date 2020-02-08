<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_array = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
$custom_logo_img = '<img src="'.$custom_logo_array[0].'">';

$contacts = get_field('footer_contact_info', 'option');
?>

<div class="header__container show-for-lmedium">
	<div class="row">
        <div class="header-inner__container">
            <div class="branding__column">
                <div class="branding-inner__container">
                    <div class="logo__container">
                        <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
                            <?php echo $custom_logo_img; ?>
                        </a>
                    </div>

                    <div class="contacts__container">
                        <?php
                        foreach ( $contacts as $slug => $info ) {
                            ?>
                            <div class="contact-widget__<?php echo $slug; ?>">
                                <?php
                                $items = explode( ',', $info );
                                $i = 1;
                                $items_count = count($items);
                                foreach ( $items as $item ) {
                                    ?>
                                    <?php echo trim( $item ); ?><?php echo $i < $items_count ? '<br>' : ''; ?>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="large-9 xlarge-8 columns header-links__column">
                <div class="header-links-inner__container">
                    <div id="preheader-bar" class="preheader-bar__container">
                        <?php joints_top_nav_bar(); ?>
                    </div>

                    <div id="cart-search" class="cart-search__container">
                        <div class="search__container">
                            <div class="search__holder">
                                <?php get_template_part( 'searchform' ); ?>
                            </div>
                        </div>
                        <div class="cart__container">
                            <?php
                            if( function_exists( 'joints_woo_show_cart_icon' ) ) {
                                joints_woo_show_cart_icon();
                            }
                            ?>
                        </div>
                    </div>

                    <?php get_template_part( 'parts/nav', 'topbar' ); ?>

                    <div id="header-select-lang" class="select-lang__container select-gray">
                        <?php echo joints_qtranxf_generateLanguageSelectCode('dropdown', 'header'); ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
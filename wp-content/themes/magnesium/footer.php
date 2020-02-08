<?php
$footer_logo = get_theme_mod( 'custom_footer_logo' );
$mailchimp_form = get_field('form_subscribe_mailchimp', 'options');
$cb_form = get_field('form_callback', 'options');
?>
            <footer class="footer" role="contentinfo">
                <div class="footer-inner__container">
                    <div class="footer__row">
                        <div class="feedback-form__column">
                            <div class="feedback-form-inner__container">
                                <div class="form__container">
	                                <?php joints_multilanguage_form_shortcode($mailchimp_form); ?>
                                </div>
                            </div>
                        </div>

                        <div class="footer-links__column">
                            <div class="footer-links-inner__container">
                                <div class="logo__container show-for-medium">
                                    <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
                                        <img src="<?php echo $footer_logo ?>" alt="">
                                    </a>
                                </div>

                                <div class="footer-links__container">
                                    <div class="row">
                                        <div class="xlarge-6 large-12 lmedium-6 columns first-link__column" data-mh="menu-widget">
                                            <div class="menu-widget__container columns__inner">
				                                <?php joints_footer_widget_1(); ?>
                                            </div>
                                        </div>
                                        <div class="xlarge-6 large-12 lmedium-6 columns end second-link__column show-for-medium" data-mh="menu-widget">
                                            <div class="menu-widget__container columns__inner">
				                                <?php joints_footer_widget_2(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="contacts__column">
                            <div class="contacts-inner__container">
	                            <?php joints_show_template( 'block-contact-widget.php' ); ?>
                            </div>
                        </div>

                        <div id="header-select-lang" class="select-lang__container select-white">
		                    <?php echo joints_qtranxf_generateLanguageSelectCode('dropdown', 'footer'); ?>
                        </div>

                        <div class="footer-scroll-to-top__container">
                            <span class="scroll-to-top">
                                <i class="fa fa-angle-up"></i>
                            </span>
                        </div>
                    </div> <!-- .footer__row -->
                </div>
            </footer> <!-- end .footer -->

            <div class="footer-callback-form__container">
                <div class="footer-callback-form-btn__holder">
                    <span class="footer-callback-form-btn" data-open="footerCallback">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="reveal" id="footerCallback" data-reveal>
                    <?php joints_multilanguage_form_shortcode($cb_form); ?>
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <?php get_template_part( 'parts/overlay', 'container' ); ?>

		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->
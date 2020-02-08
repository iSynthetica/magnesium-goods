<?php
/**
 * Get the share button code for any site.
 *
 * @see https://www.addtoany.com/buttons/for/website
 */

function joints_share_buttons()
{
	?>
	<?php do_action( 'joints_before_social_sharing_container' ) ?>
    <div class="social-sharing__container">
        <?php do_action( 'joints_before_social_sharing_kit' ) ?>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
	        <?php do_action( 'joints_before_social_sharing_row' ) ?>
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_telegram"></a>
            <a class="a2a_button_vk"></a>
            <a class="a2a_button_facebook_messenger"></a>
	        <?php do_action( 'joints_after_social_sharing_row' ) ?>
        </div>
	    <?php do_action( 'joints_after_social_sharing_kit' ) ?>
    </div>
	<?php do_action( 'joints_after_social_sharing_container' ) ?>

	<script async src="https://static.addtoany.com/menu/page.js"></script>
	<?php
}

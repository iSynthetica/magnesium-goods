<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
    <div class="row">
	    <?php
	    if (! is_user_logged_in()) {
		    joints_products_categories_overlay_btn();
	    }
	    ?>
        <div class="lmedium-8 lmedium-push-4 columns">
            <?php joints_the_breadcrumbs(); ?>
            <header class="article-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header> <!-- end article header -->
        </div>

        <div class="lmedium-8 lmedium-push-4 columns">
            <section class="entry-content" itemprop="articleBody">
			    <?php the_content(); ?>
			    <?php wp_link_pages(); ?>
            </section> <!-- end article section -->

            <footer class="article-footer">

            </footer> <!-- end article footer -->
        </div>

	    <?php
	    if ( ! is_user_logged_in() ) {
		     joints_products_categories_overlay_content();
	    } else {
		    ?>
            <div class="lmedium-4 lmedium-pull-8 columns">
                <div class="styled-sidebar">
                    <div class="sidebar-menu__container my-account-sidebar__container">
                        <div class="my-account-sidebar-avatar__holder">
						    <?php echo do_shortcode('[basic-user-avatars]'); ?>
                        </div>
                        <h3 class="my-account-sidebar-title"><?php the_title(); ?></h3>
                        <div class="my-account-sidebar-navigation__holder">
						    <?php do_action( 'joints_woo_account_navigation' ); ?>
                        </div>
                    </div>
                </div>
            </div>
		    <?php
	    }
	    ?>
    </div>
</article> <!-- end article -->
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
    <div class="row">
	    <?php joints_products_categories_overlay_btn(); ?>
    </div>
    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
	        <?php joints_the_breadcrumbs(); ?>
            <header class="article-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header> <!-- end article header -->
        </div>
    </div>

    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
            <section class="entry-content" itemprop="articleBody">
	            <?php joints_show_template( 'section-faq-accordion.php' ); ?>
            </section> <!-- end article section -->

            <footer class="article-footer"></footer> <!-- end article footer -->
        </div>

        <?php joints_products_categories_overlay_content(); ?>
    </div>
</article> <!-- end article -->
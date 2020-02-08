<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
	        <?php joints_the_breadcrumbs(); ?>
            <header class="article-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header> <!-- end article header -->
        </div>

        <div class="columns">
            <section class="entry-content" itemprop="articleBody">
                <div class="fullwidth__container">
                    <div class="fullwidth-inner__container">
	                    <?php the_content(); ?>
	                    <?php wp_link_pages(); ?>
                    </div>
                </div>
            </section> <!-- end article section -->

            <footer class="article-footer">

            </footer> <!-- end article footer -->
        </div>
    </div>
</article> <!-- end article -->
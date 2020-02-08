<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
	        <?php joints_the_breadcrumbs(); ?>
            <header class="article-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header> <!-- end article header -->
        </div>

        <div class="lmedium-8 lmedium-push-4 columns">
            <div class="row">
                <div class="lmedium-5 columns">
                    <section class="entry-content" itemprop="articleBody">
		                <?php the_content(); ?>
		                <?php wp_link_pages(); ?>
                    </section> <!-- end article section -->

                    <footer class="article-footer">

                    </footer> <!-- end article footer -->
                </div>
                <div class="lmedium-7 columns">
                    <div class="container-styled-1 contact-form__container">
	                    <?php
	                    $cf = get_field('contact_form');
	                    echo do_shortcode($cf);
	                    ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lmedium-4 lmedium-pull-8 columns">
            <div class="acf-map"></div>
        </div>
    </div>
</article> <!-- end article -->
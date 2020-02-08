<?php
$author = get_field('author', get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="row">
		<?php joints_products_categories_overlay_btn(); ?>
    </div>

    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
            <?php joints_the_breadcrumbs(); ?>

            <header class="article-header">
                <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
		        <?php
		        if ( !empty($author ) && is_object( $author ) ) {
			        ?>
                    <div class="entry-meta-author-name">
				        <?php echo joints_get_current_language_string('author'); ?>: <?php echo __($author->post_title); ?>
                    </div>
			        <?php
		        }
		        ?>
            </header> <!-- end article header -->
        </div>
    </div>

    <div class="row">
        <div class="lmedium-8 lmedium-push-4 columns">
            <div class="row">
                <div class="columns">
                    <section class="entry-content" itemprop="articleBody">
                        <?php the_content(); ?>

                        <?php //var_dump(joints_qtranxf_isAvailableInCurrent()); ?>
                    </section> <!-- end article section -->

                    <footer class="article-footer">
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
                    </footer> <!-- end article footer -->

                    <?php joints_show_template( 'section-post-author.php', array( 'author' => $author ) ); ?>

                    <?php
                    if (joints_qtranxf_isAvailableInCurrent()) {
                        ?>
                        <div class="date__holder" style="text-align: right;margin-bottom: 15px">
                            <?php the_time('d.m.Y') ?>
                        </div>
                        <?php
                        joints_share_buttons();
                    }
                    ?>

                    <?php // comments_template(); ?>
                </div>
            </div>
        </div>

	    <?php joints_products_categories_overlay_content(); ?>
    </div>

</article> <!-- end article -->
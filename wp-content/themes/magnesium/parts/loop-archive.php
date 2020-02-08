<?php
$thumb = joints_post_thumbnail( get_the_ID(), $size = 'post-archive' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
    <div class="row">

        <?php
        if ($thumb) {
            ?>
            <div class="columns large-4 lmedium-5 smedium-5">
                <section class="featured-image" itemprop="articleBody">
                    <?php echo $thumb; ?>
                </section> <!-- end article section -->
            </div>

            <div class="columns large-8 lmedium-7 smedium-7">
            <?php
        } else {
            ?>
            <div class="columns">
            <?php
        }
        ?>
            <header class="article-header">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </header> <!-- end article header -->

            <section class="entry-content" itemprop="articleBody">
		        <?php the_excerpt(); ?>
            </section> <!-- end article section -->

            <footer class="article-footer">
                <?php joints_read_more(); ?>
            </footer> <!-- end article footer -->
        </div>
    </div>
</article> <!-- end article -->
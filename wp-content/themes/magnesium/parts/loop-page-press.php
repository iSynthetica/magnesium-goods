<?php
$thumb_size = 'post-archive';
$categories =  get_categories();
?>

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
                <div class="categories-list__container row">
                    <div class="categories-list-inner__container">
                        <?php
                        foreach ( $categories as $category ) {
	                        $isThumb = false;
	                        $cat_thumb = get_field('tax_thumbnail', 'category_'.$category->term_id);

	                        if ( !$cat_thumb ) {
		                        $cat_thumb = get_field('default_archive_thumbnail', 'option');
                            }

                            if ( $cat_thumb ) {
	                            $thumb = wp_get_attachment_image( $cat_thumb['ID'], $thumb_size);
	                            $isThumb = true;
                            }
                            ?>
                            <div class="columns large-3 smedium-6 column-block">
                                <div class="categories-item__container" data-mh="categories-item">
                                    <?php
                                    if ( $isThumb ) {
                                        ?>
                                        <div class="categories-item__thumbnail">
	                                        <?php echo $thumb; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <h4 class="categories-item__title text-center">
	                                    <?php echo $category->name; ?>
                                    </h4>
                                    <p class="categories-item__btn text-center">
                                        <a class="button success " href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo sprintf( __( "View all posts in %s" ), $category->name ); ?>"><?php echo __('Просмотр статей'); ?></a>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section> <!-- end article section -->

            <footer class="article-footer">

            </footer> <!-- end article footer -->
        </div>
    </div>
</article> <!-- end article -->
<div class="row">
	<?php joints_products_categories_overlay_btn(); ?>
</div>

<div class="row">
    <div class="lmedium-8 lmedium-push-4 columns">
		<?php joints_the_breadcrumbs(); ?>
    </div>

    <div class="lmedium-8 lmedium-push-4 columns">
        <header>
            <h1 class="page-title"><?php the_archive_title();?></h1>
        </header>
    </div>

    <div class="lmedium-8 lmedium-push-4 columns">
        <div class="row">
            <div class="columns">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part( 'parts/loop', 'archive' ); ?>
                <?php endwhile; ?>

                    <?php joints_page_navi(); ?>

                <?php else : ?>
                    <?php get_template_part( 'parts/content', 'missing' ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

	<?php joints_products_categories_overlay_content(); ?>
</div>
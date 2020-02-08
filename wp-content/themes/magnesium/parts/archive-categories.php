<div class="row">
    <div class="columns">
        <?php joints_the_breadcrumbs(); ?>

        <header>
            <h1 class="page-title"><?php the_archive_title();?></h1>
        </header>
    </div>

    <div class="columns">
        <div class="row">
            <div class="columns">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <!-- To see additional archive styles, visit the /parts directory -->
                    <?php get_template_part( 'parts/loop', 'archive' ); ?>

                <?php endwhile; ?>

                    <?php joints_page_navi(); ?>

                <?php else : ?>

                    <?php get_template_part( 'parts/content', 'missing' ); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
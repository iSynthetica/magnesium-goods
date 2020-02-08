<?php
/**
 * Template Name: About Us Page Template
 *
 * Template for displaying a about us page.
 */
?>

<?php get_header(); ?>

<div id="content">
	<div id="inner-content" class="row">
		<main id="main" class="columns" role="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/content', 'page-about' ); ?>

			<?php endwhile; endif; ?>
		</main> <!-- end #main -->

		<?php joints_products_shortcode(); ?>
	</div> <!-- end #inner-content -->
</div> <!-- end #content -->

<?php get_footer(); ?>

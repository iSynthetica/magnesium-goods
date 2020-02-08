<?php
/**
 * Template Name: Home Page Template
 *
 * Template for displaying a home page.
 */
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content">

		<main id="main" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/content', 'page-home' ); ?>

			<?php endwhile; endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>

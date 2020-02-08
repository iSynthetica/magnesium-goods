<?php get_header(); ?>
	<div id="content">
		<div id="inner-content" class="row">
		    <main id="main" class="columns" role="main">
                <?php get_template_part( 'parts/content', 'archive' ); ?>
			</main> <!-- end #main -->

			<?php joints_products_shortcode(); ?>
	    </div> <!-- end #inner-content -->
	</div> <!-- end #content -->
<?php get_footer(); ?>
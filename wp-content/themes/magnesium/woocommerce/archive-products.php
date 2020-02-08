<div class="row">
	<?php joints_products_categories_overlay_btn(); ?>

	<div class="lmedium-8 lmedium-push-4 columns">
		<header class="article-header">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<?php endif; ?>
		</header> <!-- end article header -->
	</div>

	<div class="lmedium-8 lmedium-push-4 columns">
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php do_action( 'woocommerce_before_shop_loop' ); ?>
				<?php woocommerce_product_loop_start(); ?>
					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>
				<?php woocommerce_product_loop_end(); ?>
			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php do_action( 'woocommerce_no_products_found' ); ?>

		<?php endif; ?>
	</div>

    <?php joints_products_categories_overlay_content(); ?>
</div><!-- .row -->
<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="images-inner__container">
    <div class="images slick-enabled">
        <div id="product-images-slider">
			<?php
			// Single Image
			if ( has_post_thumbnail( $post->ID ) ) {
				$media_id = get_post_thumbnail_id( $post->ID );
				$image_title = esc_attr( get_the_title( $media_id ) );

				$attachment_count = count( $product->get_gallery_image_ids() );
				$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id( $post->ID ), $post );
				$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	 			=> $props['title'],
					'alt'    			=> $props['alt'],
					'data-zoom-image'	=> $props['url'],
				) );
				echo apply_filters(
					'woocommerce_single_product_image_html',
					sprintf(
						'<div><a href="%s" itemprop="image" class="woocommerce-main-image woocommerce-start-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a></div>',
						esc_url( $props['url'] ),
						esc_attr( $props['caption'] ),
						$gallery,
						$image
					),
					$post->ID
				);
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}

			// Gallery Images
			$attachment_ids = $product->get_gallery_image_ids();

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link ) {
						continue;
					}

					$image_title = esc_attr( get_the_title( $attachment_id ) );

					$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, array(
						'alt' => $image_title,
						'data-zoom-image'	=> $image_link,
					) );

					echo apply_filters(
						'woocommerce_single_product_image_html',
						sprintf(
							'<div><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a></div>',
							$image_link = wp_get_attachment_url( $attachment_id ),
							$image_title,
							$gallery,
							$image
						),
						$post->ID
					);
				}
			}
			?>
        </div><!-- #product-images-slider -->
		<?php

		$attachment_ids = $product->get_gallery_image_ids();

		if ( has_post_thumbnail( $post->ID ) ) {
			$media_id = get_post_thumbnail_id( $post->ID );
			array_unshift($attachment_ids, $media_id);
		}

		if ( $attachment_ids ) {
			$loop 		= 0;
			$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
			?>
            <div class="thumbnails">
                <div id="product-thumbnails-slider">
					<?php
					foreach ( $attachment_ids as $attachment_id ) {

						$classes = array( 'zoom' );

						$classDiv = '';
						if ($loop === 0) {
							$classDiv = 'first current-slide';
						}

						$image_class = implode( ' ', $classes );
						$props       = wc_get_product_attachment_props( $attachment_id, $post );

						if ( ! $props['url'] ) {
							continue;
						}

						echo apply_filters(
							'woocommerce_single_product_image_thumbnail_html',
							sprintf(
								'<div class="' . $classDiv . '"><div class="inner">%s</div></div>',
								wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props )
							),
							$attachment_id,
							$post->ID,
							esc_attr( $image_class )
						);

						$loop++;
					}
					?>
                </div><!-- #snth-product-thumbnails-slider -->
            </div><!-- .thumbnails -->
			<?php
		}
		?>
    </div>
</div>

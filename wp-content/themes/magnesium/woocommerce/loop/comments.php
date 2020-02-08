<?php
/**
 * Loop Rating
 *
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( !comments_open() ) {
	return;
}

$lang = joints_get_language();
$review_count = $product->get_review_count();

$num = $review_count % 100;
if ($num > 19) {
	$num = $num % 10;
}

$word = '';

if ( 'ru' == $lang ) {
	switch ($num) {
		case 1: {
			$word = 'отзыв';
			break;
		}
		case 2: case 3: case 4: {
		$word = 'отзыва';
		break;
	}
		default: {
			$word = 'отзывов';
		}
	}
} elseif ( 'ua' == $lang ) {
	switch ($num) {
		case 1: {
			$word = 'відгук';
			break;
		}
		case 2: case 3: case 4: {
			$word = 'відгуки';
			break;
		}
		default: {
			$word = 'відгуків';
		}
	}
} else {
	if ( $review_count > 1 ) {
		$word = 'reviews';
	} else {
		$word = 'review';
	}
}
?>
<div class="reviews__container">
	<div class="reviews__holder">
		<a href="<?php echo get_permalink() ?>#reviews" class="woocommerce-review-link" rel="nofollow">
			<span class="count"><?php echo esc_html( $review_count ) . ' ' . $word; ?></span>
		</a>
	</div>
</div>
<?php

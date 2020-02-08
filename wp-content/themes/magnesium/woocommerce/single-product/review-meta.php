<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

<?php } else { ?>
    <div class="meta-date">
        <time class="woocommerce-review__published-date" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
    </div>
<?php }

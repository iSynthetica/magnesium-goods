<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( empty( $author ) ) {
	return;
}

$author_social = get_field('follow_up', $author->ID);
?>

<div class="entry-author__section">
	<div class="entry-author__inner">
		<div class="row">
			<div class="columns lmedium-4 large-3">
				<div class="author-thumbnail">
					<?php echo get_the_post_thumbnail( $author->ID, 'shop_thumbnail' ); ?>
				</div>
			</div>
			<div class="columns lmedium-8 large-9">
				<h4 class="author-name">
					<?php echo joints_get_current_language_string('author'); ?>: <?php echo __($author->post_title); ?>
				</h4>
				<div class="author-info">
					<?php echo wpautop($author->post_content); ?>
				</div>
				<div class="author-meta">
					<?php
					if ( !empty( $author_social ) ) {
						?>
						<div class="social-icons">
							<span>
							<?php echo joints_get_current_language_string('author_follow'); ?> <?php echo __($author->post_title); ?>
					        </span>
							<?php
							foreach ($author_social as $network => $url) {
								?><a href="<?php echo $url ?>" class="social-icon <?php echo $network ?>"></a><?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
<!--	<pre>-->
<!--	--><?php //var_dump( $author ) ?>
<!--	</pre>-->
</div>
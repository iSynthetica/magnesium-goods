<?php
$faqs = get_posts(
	array(
		'post_type' => array('faq'),
		'numberposts' => -1,
		'orderby'     => 'menu_order',
		'order'       => 'ASC',
		'post_status' => 'publish',
	)
);
?>

<div class="faqs-archive__container">
    <div class="faqs-archive-inner__container">
		<?php
		foreach ( $faqs as $faq ) {
			$article_link = false;
			$use_article = get_field('use_article', $faq->ID);
			$faq_article = get_field('faq_article', $faq->ID);
			if ( $use_article && $faq_article ) {
				$article_link = $url = get_the_permalink( $faq_article );
			}
			?>
            <div class="faqs-archive-item__container">
                <div class="faqs-archive-item-inner__container">
					<?php
					if ( $article_link ) {
						?>
                        <button onclick="location.href='<?php echo $article_link ?>';"><?php echo $faq->post_title; ?></button>
						<?php
					} else {
						?>
                        <button data-open="faqModal-<?php echo $faq->ID; ?>"><?php echo $faq->post_title; ?></button>
						<?php
					}
					?>
                </div>

				<?php
				if ( !$article_link ) {
					?>
                    <div class="reveal" id="faqModal-<?php echo $faq->ID; ?>" data-reveal>
                        <h3><?php echo $faq->post_title; ?></h3>
						<?php echo wpautop($faq->post_content); ?>
                        <button class="close-button" data-close aria-label="Close modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<?php
				}
				?>
            </div>
			<?php
		}
		?>
    </div>
</div>
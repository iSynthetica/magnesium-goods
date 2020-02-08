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

<ul class="accordion faqs-accordion" data-accordion>
	<?php
	$i = 1;
	foreach ( $faqs as $faq ) {
		?>
        <li class="accordion-item<?php echo 1 === $i ? ' is-active' : '' ?>" data-accordion-item>
            <!-- Accordion tab title -->
            <a href="#" class="accordion-title"><?php echo $faq->post_title; ?></a>

            <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
            <div class="accordion-content" data-tab-content>
				<?php echo wpautop($faq->post_content); ?>
            </div>
        </li>
		<?php
		$i++;
	}
	?>
</ul>
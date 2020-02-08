<?php
global $post;
$id = $post->ID;
$lang = joints_get_language();
$intro_text = get_field('intro_text');
$intro_text_lang = $intro_text[$lang];
$intro_icons = get_field('intro_icons');

?>
<div id="section-promo" class="section">
	<div class="section__inner">
		<div class="row section__row">
			<div class="section-inner__container">
				<div class="columns lmedium-8 large-9 lmedium-push-4 large-push-3">
                    <div class="woo-slider__container">
                        <div class="slide-header">
                            <h3 class="section-title text-center">ТОП-продаж</h3>
                        </div>
	                    <?php echo do_shortcode('[best_selling_products]'); ?>
                    </div>
				</div>
				<div class="columns lmedium-4 large-3 lmedium-pull-8 large-pull-9">
					<h3 class="section-title text-center">ТЕСТ</h3>
				</div>
			</div>
		</div>
	</div>
</div>

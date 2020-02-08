<?php
global $post;
$id = $post->ID;
$lang = joints_get_language();
$icons = get_field('standards_icons');
?>
<div id="section-sliders" class="section">
	<div class="section__inner">
		<div class="row section__row">
			<div class="section-inner__container">
				<div class="columns lmedium-6 slider__column slider-first__column">
					<?php
					$first_slider = get_field('first_slider');
					joints_show_template( 'block-slider.php', array('slider' => $first_slider) );
					?>
				</div>

				<div class="columns standarts__column">
					<div class="standarts__container">
						<?php foreach ( $icons as $key => $ico ) {
							?>
							<div class="<?php echo $key ?>-icon__container standarts-icon__container">
								<img src="<?php echo $ico['icon'] ?>">
								<div class="standarts__text">
									<?php echo $ico['text'][$lang] ?>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>

				<div class="columns lmedium-6 slider__column slider-second__column">
					<?php
					$second_slider = get_field('second_slider');
					joints_show_template( 'block-slider.php', array('slider' => $second_slider) );
					?>
				</div>
			</div>
		</div>
	</div>
</div>

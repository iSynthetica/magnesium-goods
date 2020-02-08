<?php
/**
 * Display product effect icons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $post;

$effects = get_field('effect_icons', $post->ID);
$count = count($effects);
$lang = joints_get_language();

if ($count > 0) {
	?>
	<div class="effects-icons__container">
		<div class="effects-icons-inner__container">
			<div class="row">
				<div class="columns medium-4 lmedium-3 large-2 xlarge-1">
					<div class="effects-icons-label__container" data-mh="effects-icons-group">
						<div class="effects-icons-label__holder">
							<?php echo joints_get_current_language_string('products_effects_label'); ?>
						</div>
					</div>
				</div>

				<div class="columns medium-8 lmedium-9 large-10 xlarge-11">
					<div class="effects-icons__holder" data-mh="effects-icons-group">
						<?php
						foreach ($effects as $effect) {
							$item = $effect['item'];

							?>
							<?php
							if ($item['link']) {
								?><a href="<?php echo $item['link'] ?>"><?php
							}
							?>
							<span
								data-tooltip aria-haspopup="true"
								class="has-tip top"
								data-disable-hover="false"
								tabindex="1"
								title="<?php echo htmlentities($item['text'][$lang], ENT_COMPAT) ?>"
							>
                                        <i class="mg-label-icon icon-mg-<?php echo $item['icon'] ?>"></i>
                                    </span>
							<?php
							if ($item['link']) {
								?></a><?php
							}
							?>
							<?php

							//var_dump($item);
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
}
?>


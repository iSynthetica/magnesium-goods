<?php
global $post;
$id = $post->ID;
$lang = joints_get_language();
$intro_text = get_field('intro_text');
$intro_text_lang = $intro_text[$lang];
$label_icons = get_field('label_icons');

?>
<div id="section-intro" class="section">
	<div class="section__inner">
		<div class="row section__row">
			<div class="section-inner__container">
				<div class="columns lmedium-5 intro-text__column show-for-lmedium">
					<div class="intro-text__container" data-mh="intro-group">
						<p><?php echo $intro_text_lang; ?></p>
					</div>
				</div><!-- .intro-text__column -->

				<div class="columns lmedium-7 intro-icons__column">
					<div class="intro-icons__container" data-mh="intro-group">
						<?php
                        $count = count($label_icons);
                        if ( 6 < $count ) {
                            $count = 7;
                        }

                        $width = 100 / $count;
                        foreach ($label_icons as $icon) {
                            $icon_data = $icon['item'];
                            ?>
                            <?php // var_dump($icon_data); ?>
                            <div class="label-icon__holder" style="width: <?php echo $width ?>%">
                                <?php
                                if ($icon_data['link']) {
                                    ?><a href="<?php echo $icon_data['link'] ?>"><?php
                                }
                                    ?>
                                    <span
                                        data-tooltip aria-haspopup="true"
                                        class="has-tip top"
                                        data-disable-hover="false"
                                        tabindex="1"
                                        title="<?php echo htmlentities($icon_data['text'][$lang], ENT_COMPAT) ?>"
                                    >
                                        <i class="mg-label-icon icon-mg-<?php echo $icon_data['icon'] ?>"></i>
                                    </span>
	                                <?php
                                if ($icon_data['link']) {
                                    ?></a><?php
	                            } ?>
                            </div>
                            <?php
                        }
						?>
					</div>
				</div><!-- .intro-icons__column -->
			</div><!-- .section-inner__container -->
		</div><!-- .row.section__row -->
	</div><!-- .section__inner -->
</div><!-- #section-intro.section -->

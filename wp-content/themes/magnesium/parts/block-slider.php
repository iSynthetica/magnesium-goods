<?php
/**
 * Template for Picture slider on home page
 */
$slides = false;
$allowed_types = array('pics', 'videos');
$slider_type = get_field('slider_type', $slider);

if ( in_array($slider_type, $allowed_types) ) {
	$slides = get_field('slider_'.$slider_type, $slider);
	$lang = joints_get_language();
}

if ( !empty( $slides ) ) {
    if ( 'pics' == $slider_type ) {
	    ?>
        <div class="slider-pics">
		    <?php
		    $i = 1;
		    foreach ( $slides as $slide ) {
			    ?>
                <div>
                    <div id="slide-header-<?php echo $i; ?>" class="slide-header">
                        <h3 class="section-title text-center"><?php echo $slide['title'][$lang] ?></h3>
                    </div>
                    <div class="slide-content <?php echo $slide['text_position']; ?>-content" style="background-image: url('<?php echo $slide['background_image'] ?>')">
                        <div class="slide-content__overlay show-for-smedium">
                            <div class="orange"></div>
                            <div class="green middle"></div>
                            <div class="black"></div>
                        </div>
                        <p class="h4 slide-content__title"><?php echo $slide['content_title'][$lang] ?></p>
                        <div class="slide-content__img show-for-smedium">
                            <img src="<?php echo $slide['product_image']; ?>">
                        </div>
                        <div class="slide-content__text">
						    <?php echo wpautop($slide['content'][$lang]); ?>
                        </div>
                    </div>
                    <div class="slide-footer"></div>
                </div>
			    <?php
			    $i++;
		    }
		    ?>
        </div>
	    <?php
    } elseif ( 'videos' == $slider_type ) {
	    ?>
        <div class="slider-videos">
		    <?php
		    $i = 1;
		    foreach ( $slides as $slide ) {
			    ?>
                <div>
                    <div id="slide-header-<?php echo $i; ?>" class="slide-header">
                        <h3 class="section-title text-center"><?php echo $slide['title'][$lang] ?></h3>
                    </div>
                    <div class="slide-content">
                        <div class="embed-container">
		                    <?php
		                    $iframe = $slide['video'];

		                    // use preg_match to find iframe src
		                    preg_match('/src="(.+?)"/', $iframe, $matches);
		                    $src = $matches[1];


		                    // add extra params to iframe src
		                    $params = array(
			                    'controls'    => 0,
			                    'hd'        => 1,
			                    'autohide'    => 1,
			                    'showinfo' => 0,
                                'modestbranding' => 1
		                    );

		                    $new_src = add_query_arg($params, $src);

		                    $iframe = str_replace($src, $new_src, $iframe);


		                    // add extra attributes to iframe html
		                    $attributes = 'frameborder="0"';

		                    $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);


		                    // echo $iframe
		                    echo $iframe;
                            ?>
                        </div>
                        <div class="slide-content__text">
						    <?php echo wpautop($slide['content'][$lang]); ?>
                        </div>
                    </div>
                    <div class="slide-footer"></div>
                </div>
			    <?php
			    $i++;
		    }
		    ?>
        </div>
	    <?php
    }
}
?>
<?php

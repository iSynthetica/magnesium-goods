<?php
/**
 * Get Map coordinates for Contact Page
 * @return array
 */
function joints_get_location()
{
	global $post;
	$post_id = $post->ID;
	$location = get_field('map', $post_id);

	ob_start();
	?>INFO<?php
	$info = ob_get_clean();

	$location_array = array(
		array(
			'location' => $location,
			'info' => $info,
		)
	);

	return $location_array;
}

/**
 * Display breadcrumbs
 *
 * @param bool $expanded class for row
 */
function joints_the_breadcrumbs($expanded = false)
{
    $divider = ' <i class="fa fa-caret-right"></i> ';
    $last_divider = ' <i class="fa fa-caret-right"></i> ';
	if ( is_front_page() && is_home() ) {
		// Default homepage
	} elseif ( is_front_page() ) {
		$output = $last_divider . 'Startseite';
	} elseif ( is_home() || is_tag() || is_author() ) {
		$output = $last_divider . 'Blog';
	} elseif ( is_category() ){
		$category = get_category( get_query_var( 'cat' ) );
		$output = $divider . 'Blog' . $last_divider .  $category->name;
	} elseif ( is_page() ) {
		global $post;
		$title = $post->post_title;
		$output = $last_divider .  $title;
	} elseif ( is_single() ) {
		global $post;
		$id = $post->ID;
		$post_type = get_post_type( $id );

		if( 'post' == $post_type ) {
			$output = $divider . 'Blog' . $last_divider . $post->post_title;
		}
	}

	?>
    <p class="breadcrumbs__content show-for-lmedium">
        <a href="<?php echo home_url(); ?>">Главная</a><?php echo $output ?>
    </p>
	<?php
}

function joints_blog_sidebar_to_overlay()
{
    ?>
    <div class="columns hide-for-lmedium">
        <button type="button"
                class="toOverlay hollow button expanded"
                data-overlay-id="sidebar-menu-toOverlay"
                data-overlay-title="<?php echo joints_get_current_language_string( 'mobile_post_sidebar_btn' ); ?>"
        >
			<?php echo joints_get_current_language_string( 'mobile_post_sidebar_btn' ); ?>
        </button>
    </div>
    <?php
}

/**
 * Language Select Code for non-Widget users
 */
function joints_qtranxf_generateLanguageSelectCode($args = 'dropdown', $id='') {
	global $q_config;
	if(is_string($args)) $type = $args;

	if(empty($id)) $id = 'qtranslate';
	$id .= '-chooser';
	if(is_404()) $url = get_option('home'); else $url = '';
	$flag_location = qtranxf_flag_location();
	echo PHP_EOL.'<ul class="language-chooser language-chooser-'.$type.' qtranxs_language_chooser" id="'.$id.'">'.PHP_EOL;

    foreach(qtranxf_getSortedLanguages() as $language) {
        $alt = $q_config['language_name'][$language].' ('.$language.')';
        $classes = array('lang-'.$language);
        if($language == $q_config['language']) $classes[] = 'active';
        echo '<li class="'. implode(' ', $classes) .'"><a href="'.qtranxf_convertURL($url, $language, false, true).'"';
        // set hreflang
        echo ' hreflang="'.$language.'"';
        echo ' title="'.$alt.'"';
        if($type=='image')
            echo ' class="qtranxs_image qtranxs_image_'.$language.'"';
        //	echo ' class="qtranxs_flag qtranxs_flag_'.$language.'"';
        elseif($type=='text')
            echo ' class="qtranxs_text qtranxs_text_'.$language.'"';
        elseif($type=='css_only')// to be removed
            echo ' class="qtranxs_css qtranxs_css_'.$language.'"';
        echo '>';
        if($type=='image') echo '<img src="'.$flag_location.$q_config['flag'][$language].'" alt="'.$alt.'" />';
        echo '<span';
        if($type=='image' || $type=='css_only') echo ' style="display:none"';
        echo '>'.$q_config['language_name'][$language].'</span>';
        echo '</a></li>'.PHP_EOL;
    }

    //echo '</ul><div class="qtranxs_widget_end"></div>'.PHP_EOL;
    if($type=='dropdown') {
        echo '<script type="text/javascript">'.PHP_EOL.'// <![CDATA['.PHP_EOL;
        echo "var lc = document.getElementById('".$id."');".PHP_EOL;
        echo "var s = document.createElement('select');".PHP_EOL;
        echo "s.id = 'qtranxs_select_".$id."';".PHP_EOL;
        echo "lc.parentNode.insertBefore(s,lc);".PHP_EOL;
        // create dropdown fields for each language
        foreach(qtranxf_getSortedLanguages() as $language) {
            echo joints_qtranxf_insertDropDownElement($language, qtranxf_convertURL($url, $language, false, true), $id);
        }
        // hide html language chooser text
        echo "s.onchange = function() { document.location.href = this.value;}".PHP_EOL;
        echo "lc.style.display='none';".PHP_EOL;
        echo '// ]]>'.PHP_EOL.'</script>'.PHP_EOL;
    }

	echo '</ul><div class="qtranxs_widget_end"></div>'.PHP_EOL;
}

function joints_qtranxf_insertDropDownElement($language, $url, $id){
	global $q_config;
	$html ="
		var sb = document.getElementById('qtranxs_select_".$id."');
		var o = document.createElement('option');
		var l = document.createTextNode('".$language."');
		";
	if($q_config['language']==$language)
		$html .= "o.selected = 'selected';";
	$html .= "
		o.value = '".addslashes(htmlspecialchars_decode($url, ENT_NOQUOTES))."';
		o.appendChild(l);
		sb.appendChild(o);
		";
	return $html;
}

function joints_qtranxf_isAvailableInCurrent()
{
    global $post;
	$lang = joints_get_language();

	return qtranxf_isAvailableIn($post->ID, $lang);
}

function joints_read_more() {
	global $post;
	$label = get_field('read_more_label', 'option');
	$lang = joints_get_language();

	?>
    <div class="read-more__container">
        <a class="excerpt-read-more" href="<?php echo get_permalink($post->ID); ?>" title=""><?php echo $label[$lang] ?></a>
    </div>
    <?php
}

function joints_products_shortcode( $title = false, $shortcode = false )
{
	if ( is_page() || is_single() ) {
		global $post;

		$id = $post->ID;
	}

    if ( !$shortcode || !is_string( $shortcode ) ) {
        $shortcode = get_field('default_product_shortcode', 'option');
    }

    if ($shortcode) {
        $lang = joints_get_language();

        if ( !$title ) {
	        $title = get_field('default_product_shortcode_title', 'option');
	        $title = $title[$lang];
        }

        ?>
        <div class="columns">
            <div class="prefooter-slider-column">
                <div class="slider__container slider-arrows-right woo-interesting-products-slider__container">
                    <div class="slider__inner">
                        <div class="slide-header">
                            <h3 class="section-title text-center"><?php echo $title ?></h3>
                        </div>
			            <?php echo do_shortcode( $shortcode ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function joints_products_categories_overlay_btn()
{
    ?>
	<div class="columns hide-for-lmedium">
        <button type="button"
                class="toOverlay hollow button expanded"
                data-overlay-id="sidebar-menu-toOverlay"
                data-overlay-title="<?php echo joints_get_current_language_string( 'products_categories_btn' ); ?>"
        >
            <?php echo joints_get_current_language_string( 'products_categories_btn' ); ?>
        </button>
    </div>
    <?php
}

function joints_products_categories_overlay_content()
{
    ?>
    <div id="product-navigation" class="lmedium-4 lmedium-pull-8 columns show-for-lmedium">
        <div data-sticky-container>
            <div class="sticky" data-sticky data-anchor="product-navigation">
                <div class="container-styled-1 styled-sidebar">
                    <div id="sidebar-menu-toOverlay">
                        <div class="sidebar-menu__container">
					        <?php joints_shop_category_links(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function joints_get_current_language_string( $string )
{
	$lang = joints_get_language();

	$products_categories_btn_string = array(
		'ru' => 'Категории товаров',
		'en' => "Product's categories",
		'ua' => 'Категорії товарів',
	);

	$products_effects_label_string = array(
		'ru' => 'Эффекты',
		'en' => "Effects",
		'ua' => 'Ефекти',
	);

	$error_required_first_name_string = array(
		'ru' => 'Необходимо ввести Имя',
		'en' => "First name is required!",
		'ua' => "Необхідно ввести Ім'я",
	);

	$error_required_last_name_string = array(
		'ru' => 'Необходимо ввести Фамилию',
		'en' => "Last name is required!",
		'ua' => "Необхідно ввести Прізвище",
	);

	$signup_popup_btn_string = array(
		'ru' => 'Подписаться',
		'en' => "Signup",
		'ua' => 'Підписатися',
	);

	$mobile_post_sidebar_btn_string = array(
		'ru' => 'Категории статей',
		'en' => "Article's categories",
		'ua' => 'Категорії статей',
	);

	$use_string = array(
		'ru' => 'Применение',
		'ua' => 'Застосування',
		'en' => 'Use',
	);

	$ingredients_string = array(
		'ru' => 'Состав',
		'ua' => 'Склад',
		'en' => 'Ingredients',
	);

	$price_string = array(
		'ru' => 'Цена',
		'ua' => 'Ціна',
		'en' => 'Price',
	);

	$product_sort_by_title_asc_string = array(
		'ru' => 'По названию (А-Я)',
		'ua' => 'По назві (А-Я)',
		'en' => 'By title (A-Z)',
	);

	$product_sort_by_title_desc_string = array(
		'ru' => 'По названию (Я-А)',
		'ua' => 'По назві (Я-А)',
		'en' => 'By title (Z-A)',
	);

	$product_social_row_string = array(
		'ru' => 'Пусть друзья знают, что вы в тренде',
		'ua' => 'Пусть друзья знают, что вы в тренде',
		'en' => 'Пусть друзья знают, что вы в тренде',
	);

	$post_social_row_string = array(
		'ru' => 'Чтобы не потерять статью',
		'ua' => 'Щоб не загубити статтю',
		'en' => 'Prevent loosing article',
	);

	$product_read_more_string = array(
		'ru' => 'подробнее',
		'ua' => 'докладніше',
		'en' => 'details',
	);

	$author_string = array(
		'ru' => 'Автор',
		'ua' => 'Автор',
		'en' => 'Author',
	);

	$author_follow_string = array(
		'ru' => 'Следить за',
		'ua' => 'Слідкувати за',
		'en' => 'Follow',
	);

	$product_slider_title_string = array(
		'ru' => 'Продукты, которые Вам также могут понравится',
		'ua' => 'Продукти, що Вам також можуть сподобатися',
		'en' => 'Products you can also like',
	);

	$currency_uah_string = array(
		'ru' => 'грн.',
		'ua' => 'грн.',
		'en' => 'uah',
    );

	$sale_string = array(
		'ru' => 'Скидка',
		'ua' => 'Знижка',
		'en' => 'Sale',
    );

	$add_to_cart_string = array(
		'ru' => 'Купить',
		'ua' => 'Купити',
		'en' => 'Buy',
    );

	$add_to_cart_single_string = array(
		'ru' => "<span>Добавить</span><br>в корзину",
		'ua' => "<span>Додати</span><br>до кошика",
		'en' => "<span>Add</span><br>to cart",
    );

	$buy_one_click_single_string = array(
		'ru' => "<span>Купить</span><br>в один клик",
		'ua' => "<span>Купити</span><br>в один клік",
		'en' => "<span>Buy</span><br>with one click",
    );

	$array_to_return = $string . '_string';
	$array_to_return = $$array_to_return;

	return $array_to_return[$lang];
}

/**
 * @param bool $id
 * @param string $size
 *
 * @return bool|string
 */
function joints_post_thumbnail( $id = false, $size = 'post-archive' )
{
	if ( !$id ) {
		global $post;
		$id = $post->ID;
	}

	$isThumb = has_post_thumbnail( $id );

	if ( $isThumb ) {
		$thumb = get_the_post_thumbnail( $id, $size);

		return $thumb;
	} else {
		$post_thumb = get_field('default_single_thumbnail', 'option');

		if ( $post_thumb ) {
			$thumb = wp_get_attachment_image( $post_thumb['ID'], $size);

			return $thumb;
		}

		return false;
	}
}

/**
 * Display multilanguage form
 * @param $form array
 */
function joints_multilanguage_form_shortcode ( $form )
{
    if ( !is_array( $form ) ) {
        return;
    }

	$lang = joints_get_language();

    echo do_shortcode($form[$lang]);
}

function joints_after_social_sharing_row()
{
    if ( is_product() ) {
	    ?>
        <span class="social-sharing-after-buttons-label show-for-smedium">
            <?php echo joints_get_current_language_string( 'product_social_row' ) ?>
        </span>
	    <?php
    } elseif ( is_single() ) {
	    ?>
        <span class="social-sharing-after-buttons-label show-for-smedium">
            <?php echo joints_get_current_language_string( 'post_social_row' ) ?>
        </span>
	    <?php
    }
}
add_action('joints_after_social_sharing_row', 'joints_after_social_sharing_row');

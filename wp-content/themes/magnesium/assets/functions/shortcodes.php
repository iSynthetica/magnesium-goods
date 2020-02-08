<?php
/**
 * Shortcodes
 */

//define('FILTERPRIORITY', 10);
//add_filter('the_content', 'do_shortcode', FILTERPRIORITY);
//add_filter('widget_text', 'do_shortcode', FILTERPRIORITY);

function joints_paragraph_br_fix( $content, $paragraph_tag=false, $br_tag=false )
{
    $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);

    $content = preg_replace('#<br \/>#', '', $content);

    if ( $paragraph_tag ) $content = preg_replace('#<p>|</p>#', '', $content);

    return trim($content);
}

function joints_content_helper( $content, $paragraph_tag=false, $br_tag=false )
{
    return joints_paragraph_br_fix( do_shortcode(shortcode_unautop($content)), $paragraph_tag, $br_tag );
}

$allowed_shortcodes = array(
	'jwp_post-header' => array(
		'title' => __('Цитата с главным изображением'),
		'closed' => true,
	),
	'jwp_newsletter-popup' => array(
		'title' => __('Всплывающая форма подписки'),
		'closed' => true,
	),
	'jwp_section-background' => array(
		'title' => __('Текстовый блок с фоном'),
		'closed' => true,
	),
	'jwp_section-border' => array(
		'title' => __('Текстовый блок с границей'),
		'closed' => true,
	),
	'jwp_section-padding-left' => array(
		'title' => __('Текстовый блок с отступом'),
		'closed' => true,
	),
	'jwp_list-dots' => array(
		'title' => __('Список с точками'),
		'closed' => true,
	),
	'jwp_list-check' => array(
		'title' => __('Список с галочками'),
		'closed' => true,
	),
	'jwp_list-underline' => array(
		'title' => __('Список с разделителями'),
		'closed' => true,
	),
	'jwp_references' => array(
		'title' => __('Примечания, ссылки, источники'),
		'closed' => true,
	),
	'jwp_divider-green' => array(
		'title' => __('Разделитель зеленый'),
	),
	'jwp_divider-orange' => array(
		'title' => __('Разделитель оранжевый'),
	),
	'jwp_divider-transparent' => array(
		'title' => __('Разделитель прозрачный'),
		'atts' => array(
			'height' => 1,
		),
	),
	'jwp_column-group' => array(
		'title' => __('Группа колонок'),
		'closed' => true,
	),
	'jwp_column' => array(
		'title' => __('Колонка'),
		'closed' => true,
		'atts' => array(
			'mobile' => '',
			'mobile-l' => '',
			'tablet' => '',
			'tablet-l' => '',
			'desktop' => '',
			'desktop-l' => '',
		),
	),
	'jwp_accordion-group' => array(
		'title' => __('Аккордеон обертка'),
		'closed' => true
	),
	'jwp_accordion-link' => array(
		'title' => __('Аккордеон ссылка'),
		'closed' => true
	),
	'jwp_accordion-content' => array(
		'title' => __('Аккордеон контент'),
		'closed' => true
	),
);

class Joints_Content_Shortcodes {
	public $current_shrtcd = 0;

	function __construct()
	{
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init()
	{
		add_shortcode( 'jwp_post-header', array( $this, 'post_header' ) );
		add_shortcode( 'jwp_newsletter-popup', array( $this, 'newsletter_popup' ) );
		add_shortcode( 'jwp_section-background', array( $this, 'section_background' ) );
		add_shortcode( 'jwp_section-border', array( $this, 'section_border' ) );
		add_shortcode( 'jwp_section-padding-left', array( $this, 'section_padding_left' ) );
		add_shortcode( 'jwp_accordion-group', array( $this, 'accordion_group' ) );
		add_shortcode( 'jwp_accordion-link', array( $this, 'accordion_link' ) );
		add_shortcode( 'jwp_accordion-content', array( $this, 'accordion_content' ) );
		add_shortcode( 'jwp_column', array( $this, 'column' ) );
		add_shortcode( 'jwp_column-group', array( $this, 'group' ) );
		add_shortcode( 'jwp_list-dots', array( $this, 'list_dots' ) );
		add_shortcode( 'jwp_list-check', array( $this, 'list_check' ) );
		add_shortcode( 'jwp_list-underline', array( $this, 'list_underline' ) );
		add_shortcode( 'jwp_references', array( $this, 'references' ) );
		add_shortcode( 'jwp_divider-green', array( $this, 'divider_green' ) );
		add_shortcode( 'jwp_divider-orange', array( $this, 'divider_orange' ) );
		add_shortcode( 'jwp_divider-transparent', array( $this, 'divider_transparent' ) );
	}

	public function accordion_group( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		return '<ul class="accordion cc-simple-accordion" data-accordion data-allow-all-closed="true">'.$content.'</ul>';
	}

	public function accordion_link( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		$output  = '<li class="accordion-item" data-accordion-item>';
		$output .= '<a href="#" class="accordion-title">' . $content . '</a>';

		return $output;
	}

	public function accordion_content( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		$output  = '<div class="accordion-content" data-tab-content>' . $content . '</div>';
		$output .= '</li>';

		return $output;
	}

	public function newsletter_popup( $attr, $content )
    {
	    $this->current_shrtcd++;

	    $content = wpautop( $content );
	    $content = joints_content_helper( $content );

	    ob_start();
	    ?>
	    <div class="cc-newsletter-popup">
            <div class="cc-newsletter-popup-inner">
                <div class="row">
                    <div class="cc-newsletter-popup-content-holder columns medium-9 xlarge-10">
		                <?php echo $content; ?>
                    </div>
                    <div class="cc-newsletter-popup-button-holder columns medium-3 xlarge-2">
                        <button class="button success expanded" data-open="exampleModal1">
			                <?php echo joints_get_current_language_string( 'signup_popup_btn' ); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="reveal" id="exampleModal1" data-reveal>
            <?php echo do_shortcode('[mc4wp_form id="1953"]'); ?>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
	    return ob_get_clean();
    }

	public function post_header( $attr, $content )
	{
	    global $post;
	    $id = $post->ID;

		$thumb = joints_post_thumbnail( $id = false, $size = 'post-single' );

		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		ob_start();
		?>
        <div class="cc-entry-header">
            <div class="cc-entry-header-inner">
                <header class="entry-header<?php echo $thumb ? ' hasThumbnail' : '' ?>">
                    <div class="row">
			            <?php
			            if ( $thumb && $content ) {
				            ?>
                            <div class="columns lmedium-7">
                                <div class="entry-thumbnail__container" data-mh="entry-header">
						            <?php echo $thumb; ?>
                                </div>

					            <?php joints_share_buttons(); ?>
                            </div>
                            <div class="columns lmedium-5">
                                <div class="entry-blockquote__container" data-mh="entry-header">
                                    <div class="entry-blockquote__holder">
							            <?php echo wpautop(
								            apply_filters( 'joints_post_text_to_translate', $content )
							            ); ?>
                                    </div>
                                </div>
                            </div>
				            <?php
			            } elseif ( $thumb && !$content ) {
				            ?>
                            <div class="columns lmedium-7">
                                <div class="entry-thumbnail__container">
						            <?php echo $thumb; ?>
                                </div>

					            <?php joints_share_buttons(); ?>
                            </div>
				            <?php
			            } elseif ( !$thumb && $content ) {
				            ?>
                            <div class="columns">
                                <div class="entry-blockquote__container">
						            <?php echo wpautop( $content ); ?>
                                </div>
					            <?php joints_share_buttons(); ?>
                            </div>
				            <?php
			            }
			            ?>
                    </div>
                </header>
            </div>
        </div>
        <?php
		return ob_get_clean();
	}

	public function section_background( $attr, $content )
    {
	    $content = wpautop( $content );
	    $content = joints_content_helper( $content );

	    return '<div class="cc-blockquote cc-blockquote-bg"><div class="cc-blockquote-inner">'.$content.'</div></div>';
    }

	public function section_border( $attr, $content )
    {
	    $content = wpautop( $content );
	    $content = joints_content_helper( $content );

	    return '<div class="cc-blockquote cc-blockquote-border"><div class="cc-blockquote-inner">'.$content.'</div></div>';
    }

	public function section_padding_left( $attr, $content )
    {
	    $content = wpautop( $content );
	    $content = joints_content_helper( $content );

	    return '<div class="cc-blockquote cc-blockquote-padding-left"><div class="cc-blockquote-inner">'.$content.'</div></div>';
    }

	public function column( $attr, $content )
	{
		$attr = shortcode_atts( array(
			'id' => '',
			'class' => '',
			'mobile' => '',
			'mobile-l' => '',
			'tablet' => '',
			'tablet-l' => '',
			'desktop' => '',
			'desktop-l' => '',
		), $attr );

		$sizes = array(
			'mb'    => 'mobile',
			'mbl'   => 'mobile-l',
			'tb'    => 'tablet',
			'tbl'   => 'tablet-l',
			'dt'    => 'desktop',
			'dtl'   => 'desktop-l'
		);
		$columns = array('1', '2', '3', '4', '5', '6');

		$class = 'cc-col';

		foreach ( $sizes as $k => $size ) {
			if ('' !== $attr[$size] && in_array($attr[$size], $columns)) {
				$class .= ' cc-'.$k.'-'.$attr[$size];
			}
		}

		if ('' !== $attr['class']) {
			$class .= ' '.$attr['class'];
		}

		$class_attr = ' class="'.$class.'"';
		$content = wpautop( $content );
        $content = joints_content_helper( $content );

		return '<div'.$class_attr.'><div class="cc-col-inner" data-mh="cc-col">'.$content.'</div></div>';
	}

	public function group( $attr, $content )
	{
		$attr = shortcode_atts( array(
			'id' => '',
			'class' => '',
		), $attr );

		$class = 'cc-row';

		if ('' !== $attr['class']) {
			$class .= ' '.$attr['class'];
		}

		$class_attr = ' class="'.$class.'"';
		$content = joints_content_helper( $content );

		return '<div'.$class_attr.'><div class="cc-row-inner">'.$content.'</div></div>';
	}

	public function list_dots( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		return '<div class="cc-list cc-list-dots"><div class="cc-list-inner">'.$content.'</div></div>';
	}

	public function list_check( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		return '<div class="cc-list cc-list-check"><div class="cc-list-inner">'.$content.'</div></div>';
	}

	public function list_underline( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		return '<div class="cc-list cc-list-underline"><div class="cc-list-inner">'.$content.'</div></div>';
	}

	public function references( $attr, $content )
	{
		$content = wpautop( $content );
		$content = joints_content_helper( $content );

		return '<div class="cc-references"><div class="cc-references-inner">'.$content.'</div></div>';
	}

	public function divider_green( $attr )
	{
		return '<div class="cc-divider cc-divider-green"><div class="cc-divider-inner"></div></div>';
	}

	public function divider_orange( $attr )
	{
		return '<div class="cc-divider cc-divider-orange"><div class="cc-divider-inner"></div></div>';
	}

	public function divider_transparent( $attr )
	{
		$attr = shortcode_atts( array(
			'height' => 1,
		), $attr );
		return '<div class="cc-divider cc-divider-divider_green"><div class="cc-divider-inner" style="height: '.$attr['height'].'px"></div></div>';
	}
}

new Joints_Content_Shortcodes;

add_shortcode( 'jwp_woo_product' , 'joinst_woo_product' );

function joinst_woo_product( $atts )
{
	if ( empty( $atts['id'] ) ) {
		return '';
	}

	$query_args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'posts_per_page'      => 1,
		'fields'              => 'ids',
		'p'                   => $atts['id']
	);

	$products = new WP_Query( $query_args );

	$products_ids = wp_parse_id_list( $products->posts );

	ob_start();

	if ( $products_ids ) {
		// Prime meta cache to reduce future queries.
		update_meta_cache( 'post', $products_ids );
		update_object_term_cache( $products_ids, 'product' );

		$original_post = $GLOBALS['post'];

		woocommerce_product_loop_start();

		foreach ( $products_ids as $product_id ) {
			$post_object = get_post( $product_id );
			$GLOBALS['post'] =& $post_object; // WPCS: override ok.
			setup_postdata( $post_object );

			// Render product template.
			wc_get_template_part( 'content', 'inline-product' );
		}

		$GLOBALS['post'] = $original_post; // WPCS: override ok.
		woocommerce_product_loop_end();

		wp_reset_postdata();
	} else {
		echo '';
	}

	woocommerce_reset_loop();

	return '<div class="inline-product__container">' . ob_get_clean() . '</div>';
}

new Joinst_Shortcode_Tinymce($allowed_shortcodes);

class Joinst_Shortcode_Tinymce
{
	public $allowed_shortcodes = array();

	public function __construct($allowed_shortcodes)
	{
		$this->allowed_shortcodes = $allowed_shortcodes;

		add_action('admin_init', array($this, 'shortcode_button'));
		add_action('admin_footer', array($this, 'get_shortcodes'));
	}

	public function shortcode_button()
	{
		if( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
		{
			add_filter( 'mce_external_plugins', array($this, 'add_buttons' ));
			add_filter( 'mce_buttons', array($this, 'register_buttons' ));
		}
	}

	public function add_buttons( $plugin_array )
	{
		$plugin_array['pushortcodes'] = get_template_directory_uri() . '/assets/js/shortcode-tinymce-button.js';

		return $plugin_array;
	}

	public function register_buttons( $buttons )
	{
		array_push( $buttons, 'separator', 'pushortcodes' );
		return $buttons;
	}

	public function get_shortcodes()
	{
//		foreach ($this->allowed_shortcodes as $tag => $shortcode) {
//		$open_tag = '';
//		$close_tag = '';
//
//		if ( !empty( $shortcode['atts'] ) && is_array($shortcode['atts'] ) ) {
//
//		}
//
//		if ( !empty($shortcode['closed']) ) {
//			$close_tag = '[/'.$tag.']';
//		}
//	}

		?>
		<script type="text/javascript">
            var shortcodes_button = <?php echo json_encode($this->allowed_shortcodes); ?>
		</script>;
		<?php
//		echo 'var shortcodes_button = new Array();';
//
//		$count = 0;
//
//		foreach($this->allowed_shortcodes as $tag => $code)
//		{
//			echo "shortcodes_button[{$count}] = '{$tag}';";
//			$count++;
//		}
	}
}
?>
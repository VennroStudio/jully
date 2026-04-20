<?php
/* Custom functions code goes here. */

/* Удаляем из меню ненужное */
function remove_from_admin_bar($wp_admin_bar) {
    //  #wp-admin-bar-si_menu
    $wp_admin_bar->remove_node('si_menu');
    $wp_admin_bar->remove_node('btn-wcabe-admin-bar');
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('comments');
    $wp_admin_bar->remove_node('new-content');
    $wp_admin_bar->remove_node('edit_us_builder');
    $wp_admin_bar->remove_node('popup-maker');
    $wp_admin_bar->remove_node('customize');
    $wp_admin_bar->remove_node('us-maintenance-notice');
    $wp_admin_bar->remove_node('vc_inline-admin-bar-link');  
    $wp_admin_bar->remove_node('search');	// поиск (справа лупа)
    $wp_admin_bar->remove_node('wp-logo');	// логотип

}
add_action('admin_bar_menu', 'remove_from_admin_bar', 999);

/**
 * Убираем кастомные поля из админки
 * Это избавляет нас от медленного запроса в админке (админка быстрее работает)
 */
function s9_remove_post_custom_fields_metabox() {
    foreach ( get_post_types( '', 'names' ) as $post_type ) {
        remove_meta_box( 'postcustom' , $post_type , 'normal' );   
    }
}
add_action( 'admin_menu' , 's9_remove_post_custom_fields_metabox' );

// ШОРТКОД: ПОДСТАНОВКА ТЕКУЩЕГО МЕСЯЦА
function month_shortcode() {
	$month_now = date('m');
	if ($month_now == "01") {
		return "январе";
	} else if ($month_now == "02") {
		return "феврале";
	} else if ($month_now == "03") {
		return "марте";
	} else if ($month_now == "04") {
		return "апреле";
	} else if ($month_now == "05") {
		return "мае";
	} else if ($month_now == "06") {
		return "июне";
	} else if ($month_now == "07") {
		return "июле";
	} else if ($month_now == "08") {
		return "августе";
	} else if ($month_now == "09") {
		return "сентябре";
	} else if ($month_now == "10") {
		return "октябре";
	} else if ($month_now == "11") {
		return "ноябре";
	} else {
		return "декабре";
	}
}
add_shortcode('month_genitive', 'month_shortcode');


// ШОРТКОД: COPYRIGHT ПОДСТАНОВКА ТЕКУЩЕГО ГОДА
function year_shortcode() {
	$year_now = date('Y'); // 2023 // y - 23
    return $year_now;
}
add_shortcode('current_year', 'year_shortcode');


/* Меняем канониклы для фильтров */
remove_action('wp_head', 'rel_canonical');
//add_action('wp_head', 'my_rel_canonical');


// Или как тут переделать https://developer.yoast.com/features/seo-tags/canonical-urls/api/
function my_rel_canonical() {
	global $post;

	if (sizeof ($_GET) == 1 ) {
		
		// Атрибут 
		if (isset($_GET['filter_pa_silhouette'])) { //filter_pa_silhouette=a-line
			
			if ($_GET['filter_pa_silhouette'] === 'a-line') {
				$link = "https://zltr.ru/a/silhouette/a-line/";
			} else {
				$link = "https://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
			}
		
		// Корсет — таксономия
		} elseif (isset($_GET['filter_corset'])) { //filter_pa_silhouette=a-line
			
			if ($_GET['filter_corset'] === 'with') {
				$link = "https://zltr.ru/corset/with/";
			} elseif ($_GET['filter_corset'] === 'without') {
				$link = "https://zltr.ru/corset/without/";
			} else {
				$link = "https://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
			}
		
		// Длина - таксономия
		} elseif (isset($_GET['filter_length'])) { //
			
			if ($_GET['filter_length'] === 'midi') {
				$link = "https://zltr.ru/length/midi/";
			} elseif ($_GET['filter_length'] === 'mini') {
				$link = "https://zltr.ru/length/mini/";
			} elseif ($_GET['filter_length'] === 'long') {
				$link = "https://zltr.ru/length/long/";
			} elseif ($_GET['filter_length'] === 'short-in-front') {
				$link = "https://zltr.ru/length/short-in-front/";
			} else {
				$link = "https://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
			}
			
		} else {

			$link = "https://" . $_SERVER['HTTP_HOST'] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

		}

	}

	
	/*
	Атрибуты
	echo wp_get_canonical_url()."\n";  //  → https://zltr.ru/p/alesta/
	echo get_permalink()."\n"; //  → https://zltr.ru/p/alesta/
	echo $_SERVER['REQUEST_URI']."\n"; //  → /c/wedding/?filter_pa_silhouette=a-line,empire&filter_pa_features=v-cutout
	echo home_url( $wp->request )."\n"; // → https://zltr.ru
	echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."\n"; // →  /c/wedding/
	echo strtok ($_SERVER["REQUEST_URI"],'?')."\n"; // →  /c/wedding/
	*/
	
	echo "<link rel='canonical' href='".$link."' />\n";

}













/* ************** Recently viewed products ************** */
// Этот add_action перезапускает сбор кукизов "woocommerce_recently_viewed", которые используются WooCOmmerce для отслеживания просмотренных продуктов
add_action( 'template_redirect', function() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
    }

    // Unset if already in viewed products list.
    $keys = array_flip( $viewed_products );

    if ( isset( $keys[ $post->ID ] ) ) {
        unset( $viewed_products[ $keys[ $post->ID ] ] );
    }

    $viewed_products[] = $post->ID;

    if ( count( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    // Store for session only.
    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}, 20 );

/*
Plugin Name: WooCommerce - Recently Viewed Products
Plugin URL: http://remicorson.com/
Description: Adds a "recently viewed products" shortcode
Version: 1.0
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
Text Domain: rc_wc_rvp
Domain Path: languages
*/

/**
 * Register the [woocommerce_recently_viewed_products per_page="5"] shortcode
 *
 * This shortcode displays recently viewed products using WooCommerce default cookie
 * It only has one parameter "per_page" to choose number of items to show
 *
 * @access      public
 * @since       1.0 
 * @return      $content
*/
function rc_woocommerce_recently_viewed_products( $atts, $content = null ) {

	// Get shortcode parameters
	extract(shortcode_atts(array(
		"per_page" => '5'
	), $atts));

	// Get WooCommerce Global
	global $woocommerce;

	// Get recently viewed product cookies data
	$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
	$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

	// If no data, quit
	if ( empty( $viewed_products ) )
		return __( 'You have not viewed any product yet!', 'rc_wc_rvp' );

	// Create the object
	ob_start();

	// Get products per page
	if( !isset( $per_page ) ? $number = 5 : $number = $per_page )

	// Create query arguments array
    $query_args = array(
    				'posts_per_page' => $number, 
    				'no_found_rows'  => 1, 
    				'post_status'    => 'publish', 
    				'post_type'      => 'product', 
    				'post__in'       => $viewed_products, 
    				'orderby'        => 'rand'
    				);

	// Add meta_query to query args
	$query_args['meta_query'] = array();

    // Check products stock status
    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();

	// Create a new query
	$r = new WP_Query($query_args);

	// If query return results
	if ( $r->have_posts() ) {

		$content = '<div class="w-grid type_carousel layout_6 cols_3">
						<div class="w-grid-list owl-carousel navstyle_circle navpos_outside with_dots owl-loaded owl-drag">	
							<div class="owl-stage-outer">
								<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 4220px;">
									';

		// Start the loop
		while ( $r->have_posts()) {
			$r->the_post();
			global $product;

			$content .= '';
			
			$content .='<div class="owl-item active" style="width: 468.793px;"><article class="w-grid-item post-'.$r->post->ID.' product type-product status-publish has-post-thumbnail instock sale purchasable product-type-simple" data-id="'.$r->post->ID.'">
		<div class="w-grid-item-h">
						<div class="w-post-elm post_image usg_post_image_1 stretched"><a href="' . get_permalink() . '" aria-label="Длинное свадебное платье Цирцея">'.get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ).'</a></div><div class="w-post-elm product_field sale_badge usg_product_field_1 sale_tag has_text_color onsale">SALE</div><div class="w-post-elm product_field stock usg_product_field_2 nalichie_tag has_text_color">В наличии <span style="display:none;">1</span></div><div class="w-html usg_html_1">
 <button class="woosw-btn woosw-btn-'.$r->post->ID.' woosw-btn-has-icon woosw-btn-icon-only" data-id="2042" data-product_name="' . get_the_title() . '" data-product_image="'.get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ).'"><span class="woosw-btn-icon woosw-icon-5"></span></button> </div><a class="w-btn us-btn-style_1 usg_btn_1 icon_atleft text_none" aria-label="Button" href="' . get_permalink() . '"><i class="fal fa-shopping-basket"></i></a><div class="w-post-elm post_custom_field usg_post_custom_field_1 type_text tip_tovara color_link_inherit has_height"><span class="w-post-elm-value"></span></div><div class="w-post-elm post_title usg_post_title_1 overflow_ellipsis woocommerce-loop-product__title color_link_inherit"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>' . $product->get_price_html() . '		</div>
	</article></div>';
		}

		$content .= '</div></div></div></div>';

	}

	// Get clean object
	$content .= ob_get_clean();
	
	// Return whole content
	return $content;
}

// Register the shortcode
add_shortcode("woocommerce_recently_viewed_products", "rc_woocommerce_recently_viewed_products");



/* Шоткод для кнопочки WishList в плитках листинга */
function wishlist_function () {
	$id = get_the_ID();
	
	$content = '
	<a href="#add-to-wishlist" class="fw-button fw-button--after w-btn us-btn-style_3" data-product-id="'.$id.'">
	<span class="fw-button-icon fw-button-icon--heart"></span>
</a>';
		
	/*
	 $content = '
	<a href="#add-to-wishlist" style="    text-align: center!important;
    font-size: 18px!important;
    line-height: 0!important;
    letter-spacing: 0!important;
    font-weight: 200!important;
    width: 46px!important;
    height: 46px!important;
    border-radius: 25px!important;
    position: absolute!important;
    left: 42%!important;
    padding: 23px 0px 0px 0px!important;
    margin: -23px 0px 0px -23px!important;" class="fw-button fw-button--after w-btn us-btn-style_3 icon_atleft text_none" data-product-id="'.$id.'" aria-label="Button">
	<span class="fw-button-icon fw-button-icon--heart"></span>
</a>';
	*/
    
	return $content;
}

add_shortcode("wishlist_shortcode", "wishlist_function");


/* Yith Wishlist для вставки в карточках листинга */
if ( ! function_exists( 'yith_wishlist' ) ) {
	
   function yith_wishlist( $atts ) {
      $id = get_the_ID();
      $output = '';

      if ( $id ) {
         $output = do_shortcode( ' [yith_wcwl_add_to_wishlist  product_id="' . $id . '"] ' );
      }

      return $output;
   }

   add_shortcode( 'yith_wishlist', 'yith_wishlist' );
}

/* WPC Wishlist для вставки в карточках листинга */
if ( ! function_exists( 'wpc_wishlist' ) ) {
	
   function wpc_wishlist( $atts ) {
      $id = get_the_ID();
      $output = '';

      if ( $id ) {
         $output = do_shortcode( ' [woosw id="' . $id . '"] ' );
      }

      return $output;
   }

   add_shortcode( 'wpc_wishlist', 'wpc_wishlist' );
}


/* Сохраняем сортировку при переходе в другую категорию */
add_filter('term_link', 'truemisha_ne_sbrasyvat_filtr', 10, 3);
function truemisha_ne_sbrasyvat_filtr( $url, $term, $taxonomy ) {
	// сначала мы проверяем, присутствует у нас в данный момент сортировка
	$orderby = ! empty( $_GET[ 'orderby' ] ) ? $_GET[ 'orderby' ]  : '';
	// если присутствует, то добавляем её в конечный урл
	if( $orderby ) {
		return add_query_arg( 'orderby', $orderby, $url );
	} else {
		return $url;
	}
}






				/* Недавно просмотренные товары */
				//add_shortcode( 'recently_viewed_products', 'truemisha_recently_viewed_products' );
				function truemisha_recently_viewed_products() {
					if( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
						$viewed_products = array();
					} else {
						$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
					}
					if ( empty( $viewed_products ) ) {
						return;
					}
					// надо ведь сначала отображать последние просмотренные
					$viewed_products = array_reverse( array_map( 'absint', $viewed_products ) );
					$title = '<h3>Вы уже смотрели</h3>';
					$product_ids = join( ",", $viewed_products );
					return $title . do_shortcode( "[products ids='$product_ids']" );
				}




add_action( 'woocommerce_update_product', 'on_product_save', 10, 1 );
function on_product_save( $product_id ) {

	if (empty($product_id)) return;

	$taxonomy_mapping = array( 
        'instock' => 715, 		// 715 В наличии
        'outofstock' => 731, 	// 731 Нет в наличии
        'onbackorder' => 739 	// 739 Под заказ
    );
    
	$stock_status = get_post_meta($product_id, '_stock_status', true); // _stock
    	// error_log ('product_id='.$product_id);
		// error_log ($stock_status);

		// Работает
		// wp_set_post_terms($product_id, ['тестовый тег', 'teg2'], 'product_tag', true); // Добавляет метку в товар
		// wp_remove_object_terms( $product_id, 'тестовый тег', 'product_tag' ); // удаляет метку из товара
		// wp_delete_object_term_relationships( $product_id, 'product_tag' ); // удаляет все метки у товара
		// wp_delete_object_term_relationships( $product_id, 'in_stock_custom' ); // Удаляет все таксономии "в наличии" у товара
		// wp_set_post_terms($product_id, 715, 'in_stock_custom', true); // Записывает таксономию "в наличии" по id значения таксономии

	wp_delete_object_term_relationships( $product_id, 'in_stock_custom' ); // удаляем все значения

	if (isset($taxonomy_mapping[$stock_status])) { 
		wp_delete_object_term_relationships( $product_id, 'in_stock_custom' );
        wp_set_post_terms($product_id, $taxonomy_mapping[$stock_status], 'in_stock_custom', true); 
    } 

}

// Видео для товара - шорткод
function vwg_product_video_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'aspect_ratio' => '16:9', // Пропорция по умолчанию
            'width' => '100%', // Ширина по умолчанию
            'height' => '100%', // Высота по умолчанию (опционально)
        ), $atts, 'product_video'
    );

    $aspect_ratio = $atts['aspect_ratio'];
    $width = $atts['width'];
    $height = $atts['height'];

    ob_start();
    $id = get_the_ID();
    $video_data = get_post_meta($id, 'vwg_video_url', true);

    // Проверка, что $video_data является массивом и не пустой
    if (!is_array($video_data) || empty($video_data)) {
        $video_url = ''; // Пустой URL если значение не массив или пустое
    } else {
        // Получаем первый элемент массива
        $first_video = reset($video_data);
        // Получаем URL первого видео
        $video_url = isset($first_video['video_url']) ? $first_video['video_url'] : '';
    }

    // Получаем ссылку на товар
    $product_link = get_permalink($id);

    // Вычисляем padding-bottom для пропорции
    list($ratio_width, $ratio_height) = explode(':', $aspect_ratio);
    $padding_bottom = ($ratio_height / $ratio_width) * 100;
    ?>
	<div style="position: relative; padding-bottom: <?php echo esc_attr($padding_bottom); ?>%;"> 
    <div class="product-video-container" data-product-id="<?php echo esc_attr($id); ?>" style="position: absolute;width: 100%;height: 100%;top: 0;left: 0;">
        <div>
            <?php if ($video_url): ?>
                <a href="<?php echo esc_url($product_link); ?>">
                    <video style="position: absolute;width: 100%;height: 100%;object-fit: none;" autoplay muted loop>
                        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </a>
            <?php else: ?>
                <p>No video available for this product.</p>
            <?php endif; ?>
        </div>
    </div>
		</div>
    <?php
    return ob_get_clean();
}

// Регистрируем шорткод
add_shortcode('product_video', 'vwg_product_video_shortcode');


// Добавляем JavaScript для автозапуска видео после фильтрации AJAX и воспроизведения при наведении
add_action('wp_footer', 'vwg_autoplay_video_js');
function vwg_autoplay_video_js() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            // Функция для автозапуска видео
            function autoplayVideo() {
                $('.product-video-container video').each(function() {
                    this.play();
                });
            }

            // Функция для установки событий на видео
            function setVideoEvents() {
                $('body').on('mouseenter', '.product-video-container video', function() {
                    this.play();
                });

                $('body').on('mouseleave', '.product-video-container video', function() {
                    this.pause();
                });
            }

            // Функция для паузы всех видео
            function pauseAllVideos() {
                $('.product-video-container video').each(function() {
                    this.pause();
                });
            }

            // Вызываем функции автозапуска и установки событий после загрузки страницы
            autoplayVideo();
            setVideoEvents();

            // Вызываем функции автозапуска после фильтрации AJAX
            $(document).ajaxComplete(function() {
                autoplayVideo();
            });

            // Автозапуск при добавлении новых элементов в DOM
            $('body').on('DOMNodeInserted', '.product-video-container', function() {
                autoplayVideo();
            });

            // Ставим видео на паузу при клике вне его
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.product-video-container video').length) {
                    pauseAllVideos();
                }
            });
        });
		




    </script>
    <?php
}



/////// КАРУСЕЛЬ - ВЫ СМОТРЕЛИ

function track_recently_viewed_products() {
    if ( ! is_singular('product') ) {
        return;
    }

    global $post;

    $viewed_products = ! empty( $_COOKIE['recently_viewed_products'] ) ? explode( '|', $_COOKIE['recently_viewed_products'] ) : array();

    if ( ( $key = array_search( $post->ID, $viewed_products ) ) !== false ) {
        unset( $viewed_products[$key] );
    }

    $viewed_products[] = $post->ID;

    if ( count( $viewed_products ) > 10 ) {
        array_shift( $viewed_products );
    }

    setcookie( 'recently_viewed_products', implode( '|', $viewed_products ), time() + 3600 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN, false, false );
}

add_action( 'template_redirect', 'track_recently_viewed_products', 20 );


// Функция для шорткода recently_viewed_carousel
function recently_viewed_carousel_shortcode( $atts ) {
    // Получаем массив идентификаторов просмотренных продуктов из куки
    $viewed_products = ! empty( $_COOKIE['recently_viewed_products'] ) ? explode( '|', $_COOKIE['recently_viewed_products'] ) : array();

    // Проверяем, что куки не пусты
    if (empty($viewed_products)) {
        return '';
    }

    // Формируем атрибуты для шорткода us_carousel
    $default_atts = array(
        'post_type' => 'ids',
        'ids' => implode( ',', $viewed_products ),
        'items_layout' => '',
        'columns' => '3',
        'items_quantity'=> '15',
        'items_gap' => '0.2rem',
        'overriding_link' => '%7B%22url%22%3A%22%22%7D',
        'carousel_dots' => '1',
		'h_rec_text' => 'Вы смотрели', // Добавлен новый атрибут h_rec_text по умолчанию
    );

    // Парсим атрибуты шорткода и объединяем с дефолтными
    $atts = shortcode_atts( $default_atts, $atts, 'recently_viewed_carousel' );

    // Генерируем шорткод us_carousel с заданными атрибутами
    $shortcode_content = '[us_separator] [us_text text="' . esc_attr( $atts['h_rec_text'] ) . '" link="%7B%22url%22%3A%22%22%7D" tag="h2" css="%7B%22default%22%3A%7B%22font-size%22%3A%2237px%22%2C%22line-height%22%3A%221em%22%2C%22font-family%22%3A%22Kosko%22%2C%22margin-top%22%3A%2220px%22%7D%7D"] [us_separator] [us_carousel';
    foreach ( $atts as $key => $value ) {
        $shortcode_content .= ' ' . $key . '="' . $value . '"';
    }
    $shortcode_content .= ']';

    // Возвращаем сгенерированный шорткод
    return do_shortcode( $shortcode_content );
}

// Регистрируем шорткод recently_viewed_carousel
add_shortcode( 'vc_recently_viewed_carousel', 'recently_viewed_carousel_shortcode' );

// Require new custom Element
class VcRecentlyViewedCarousel extends WPBakeryShortCode {
 
    function __construct() {
        add_action('init', array($this, 'create_shortcode'), 999);           
    }       
 
    public function create_shortcode() {
        // Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }

        // Map recently viewed carousel with vc_map()
        vc_map(array(
            'name' => __('Карусель "Вы смотрели"', ''),
            'base' => 'vc_recently_viewed_carousel',
            'category' => __('Custom Modules', ''),               
            'params' => array(
				array(
                    'type' => 'textfield',
                    'heading' => __('Заголовок перед списком', ''),
                    'param_name' => 'h_rec_text',
                    'value' => 'Вы смотрели',
                    'description' => __('Текст, который отображается перед списком просмотренных элементов.', ''),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Макет сетки', ''),
                    'param_name' => 'items_layout',
                    'value' => $this->get_grid_layout_options(), // Call function to fetch options dynamically
                    'description' => __('Выберите макет сетки для отображения', ''),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Количество колонок', ''),
                    'param_name' => 'columns',
                    'value' => '3',
                    'description' => __('Укажите количество колонок в карусели.', ''),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Количество элементов', ''),
                    'param_name' => 'items_quantity',
                    'value' => '15',
                    'description' => __('Укажите количество элементов, отображаемых в карусели.', ''),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Промежуток между элементами', ''),
                    'param_name' => 'items_gap',
                    'value' => '0.2rem',
                    'description' => __('Укажите промежуток между элементами в карусели.', ''),
                ),
            ),
        ));            
    }

    // Function to fetch grid layout options dynamically
    private function get_grid_layout_options() {
        $layouts = array(
            __('Default Layout', '') => 'default', // Default option
        );

        // Fetch additional layouts from us_grid_layout posts
        $args = array(
            'post_type' => 'us_grid_layout',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $layout_title = get_the_title();
                $layout_id = get_the_id();
                $layouts[$layout_title] = $layout_id; // Use title as display name and ID as value
            }
        }

        wp_reset_postdata();

        return $layouts;
    }
}

new VcRecentlyViewedCarousel();




function custom_sort_by_stock_status($args) {
    // Сначала товары в наличии
    $args['orderby'] = 'meta_value_num'; // Сортировка по наличию и дате добавления
    $args['order'] = 'ASC'; // ASC означает "в наличии" сверху

    // Присваиваем значение мета-полям
    $args['meta_key'] = '_stock_status'; // Ключ мета-поля WooCommerce, который хранит статус наличия

    return $args;
}
add_filter('woocommerce_get_catalog_ordering_args', 'custom_sort_by_stock_status');

function custom_posts_clauses_stock_status($clauses, $query) {
    global $wpdb;

    // Добавляем сортировку по наличию
    $clauses['join'] .= " LEFT JOIN {$wpdb->postmeta} AS stock_status_meta ON ({$wpdb->posts}.ID = stock_status_meta.post_id AND stock_status_meta.meta_key = '_stock_status')";

    // Изменяем запрос на сортировку в первую очередь по статусу наличия
    $clauses['orderby'] = "stock_status_meta.meta_value ASC, {$clauses['orderby']}";

    return $clauses;
}
add_filter('posts_clauses', 'custom_posts_clauses_stock_status', 2000, 2);







function sale_countdown() {
    
    $out = "

    <div class='countdown'>
        <div class='block'><span id='ddd'></span ><div class='labels'>дней</div></div>
        <div class='block' style='padding:0 15px;'> : </div>
        <div class='block'><span id='hhh'></span ><div class='labels'>часов</div></div>
        <div class='block' style='padding:0 15px;'> : </div>
        <div class='block'><span id='mmm'></span ><div class='labels'>минут</div></div>
    </div>

    
    <script>
        function updateCountdown() {
            const targetDate = new Date(new Date().getFullYear(), 1, 15, 24, 0, 0); // 15 февраля 24:00
            const now = new Date();
            
            if (now > targetDate) {
                targetDate.setFullYear(targetDate.getFullYear() + 1); // Если дата прошла, берем следующий год
            }

            const diff = targetDate - now;
            const days = String(Math.floor(diff / (1000 * 60 * 60 * 24))).padStart(2, '0');
            const hours = String(Math.floor((diff / (1000 * 60 * 60)) % 24)).padStart(2, '0');
            const minutes = String(Math.floor((diff / (1000 * 60)) % 60)).padStart(2, '0');
            
            document.getElementById('ddd').textContent = `${days}`;
            document.getElementById('hhh').textContent = `${hours}`;
            document.getElementById('mmm').textContent = `${minutes}`;
        }
        
        updateCountdown();
        setInterval(updateCountdown, 60000); // Обновление каждую минуту
    </script>";

    return $out;
}
add_shortcode('sale_countdown', 'sale_countdown');




function my_custom_page_styles() {
    
// Подключаем скрипты, если:
    // 1. Это главная страница (ID 59177)
    // 2. ИЛИ это страница WooCommerce с ?template=custom
    $is_home = is_page(59177);
    $is_woo_custom = (is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product())
                     && isset($_GET['template']) && $_GET['template'] === 'custom';

    if (!$is_home && !$is_woo_custom) {
        return;
    }

    // 1. Bootstrap 5 из CDN
    wp_enqueue_style(
        'bootstrap-cdn',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css',
        array(),
        '5.3.8'
    );

    // 2. Fancybox из CDN
    wp_enqueue_style(
        'fancybox-cdn',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css',
        array(),
        '6.1'
    );

    // 5. Ваш кастомный стиль
    wp_enqueue_style(
        'custom-page-style',
        get_stylesheet_directory_uri() . '/css/app.min.css',
        array('bootstrap-cdn', 'fancybox-cdn'),
        '1.0.2'
    );
}
add_action('wp_enqueue_scripts', 'my_custom_page_styles', 20);

function my_custom_page_scripts() {

    // Подключаем скрипты, если:
    // 1. Это главная страница (ID 59177)
    // 2. ИЛИ это страница WooCommerce с ?template=custom

    $is_home = is_page(59177);
    $is_woo_custom = (is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product()) && isset($_GET['template']) && $_GET['template'] === 'custom';

    if (!$is_home && !$is_woo_custom) {
        return;
    }

    // 1. Bootstrap Bundle из CDN (включает Popper)
    wp_enqueue_script(
        'bootstrap-cdn-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
        array(), // зависимости
        '5.3.8',
        true // загружать в футере (перед </body>)
    );

    // 2. Fancybox из CDN
    wp_enqueue_script(
        'fancybox-cdn-js',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js',
        array(),
        '6.1',
        true
    );

    // 3. Owl Carousel (локальный файл из дочерней темы)
    wp_enqueue_script(
        'owl-carousel-js',
        get_stylesheet_directory_uri() . '/js/owl.carousel.min.js',
        array('jquery'), // Owl зависит от jQuery
        '2.3.4',
        true
    );

    // 4. Ваш кастомный скрипт
    wp_enqueue_script(
        'custom-page-js',
        get_stylesheet_directory_uri() . '/js/app.min.js',
        array('bootstrap-cdn-js', 'owl-carousel-js', 'fancybox-cdn-js'),
        '1.0.2',
        true
    );

    // 5. Похожие товары (карусель как у аксессуаров)
    wp_enqueue_script(
        'similar-products-js',
        get_stylesheet_directory_uri() . '/js/similar-products.js',
        array('custom-page-js'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'my_custom_page_scripts');


// Загрузка кастомного шаблона WooCommerce по параметру ?template=custom
add_filter('template_include', 'maybe_load_custom_woocommerce_template', 99);
function maybe_load_custom_woocommerce_template($template) {
    // Работаем только на страницах WooCommerce
    if (!is_woocommerce() && !is_shop() && !is_product_category() && !is_product_tag()) {
        return $template;
    }

    // Проверяем параметр ?template=custom
    if (isset($_GET['template']) && $_GET['template'] === 'custom') {
        $custom_template = get_stylesheet_directory() . '/woocommerce-custom.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
}


// Загрузка кастомного шаблона для страницы товара по ?template=custom
add_filter('template_include', 'maybe_load_custom_single_product_template', 99);
function maybe_load_custom_single_product_template($template) {
    // Работаем только на странице отдельного товара
    if (!is_product()) {
        return $template;
    }

    // Проверяем параметр ?template=custom
    if (isset($_GET['template']) && $_GET['template'] === 'custom') {
        $custom_template = get_stylesheet_directory() . '/woocommerce-single-custom.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
}



/**
 * Всё что касаемо сортировки в кастомном шаблоне
 */
add_action('woocommerce_product_query', 'my_custom_orderby');
function my_custom_orderby($q) {
    if (!is_admin() && is_main_query()) {
        $q->set('orderby', 'ID');
        $q->set('order', 'DESC');
    }
}

// 1. Устанавливаем нашу сортировку как "по умолчанию"
add_filter('woocommerce_default_catalog_orderby', 'my_custom_default_orderby');
function my_custom_default_orderby() {
    return 'id_desc';
}

// 2. Добавляем её в список опций (если нужно)
add_filter('woocommerce_catalog_orderby', 'my_custom_catalog_orderby');
function my_custom_catalog_orderby($sort_options) {
    $sort_options['id_desc'] = 'По ID (новые первыми)';
    return $sort_options;
}

// 3. Обрабатываем нашу кастомную сортировку
add_filter('woocommerce_get_catalog_ordering_args', 'my_custom_get_catalog_ordering_args');
function my_custom_get_catalog_ordering_args($args) {
    if (isset($_GET['orderby']) && $_GET['orderby'] === 'id_desc') {
        $args['orderby'] = 'ID';
        $args['order'] = 'DESC';
        $args['meta_key'] = ''; // критически важно!
    }
    return $args;
}

// 4. Принудительно устанавливаем orderby=id_desc на страницах магазина
add_action('wp_loaded', 'my_force_orderby_id_desc');
function my_force_orderby_id_desc() {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $_GET['orderby'] = 'id_desc';
    }
}




//количество товаров в каталоге
add_filter( 'loop_shop_per_page', function ( $cols ) {
    if(!empty($_GET['template']) && $_GET['template'] == 'custom'){
        return 29;
    }
}, 20 );


// Регистрируем новый размер изображения для карточки товара
add_action('after_setup_theme', 'my_custom_image_sizes');
function my_custom_image_sizes() {
    // Название размера => ширина, высота, обрезка
    add_image_size('product_detail', 573, 860, true); // жёсткая обрезка
    add_image_size('blog_carousel', 456, 300, true); // true = обрезка (hard crop)      
    add_image_size('carousel-story', 350, 630, true);       
    add_image_size('gallery-couture', 960, 1080, true);       
}






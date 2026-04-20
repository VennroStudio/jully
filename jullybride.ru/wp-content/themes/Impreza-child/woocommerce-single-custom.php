<?php
// woocommerce-custom.php
get_header('page-59177');

//Получаем поля с новой главной страницы
$box_important  = get_field( 'box_important', 59177 );
$video_important  = get_field( 'video_important', 59177 );
$text_stroke  = get_field( 'text_stroke', 59177 );

global $product;
$current_product_id = $product ? $product->get_id() : 0;
?>

<a href="javascript:void(0)" class="app-overlay-close"></a>
<div class="app-overlay-overlay"></div>

<?php if (have_rows('carusel-added-owl', 59177)): ?>

    <?php while (have_rows('carusel-added-owl', 59177)): the_row(); ?>

        <div class="carusel-added-story" data-active="open-carusel-added-story_<?= esc_attr(get_row_index())?>">
            <ul class="owl-carusel-added-story owl-carousel owl-theme" id="owl-carusel-added-story_<?= esc_attr(get_row_index()) ?>">
                <?php if (have_rows('karusel')): ?>
                    <?php while (have_rows('karusel')): the_row(); 
                        // Проверяем, есть ли фото
                        $foto = get_sub_field('foto');
                        // Проверяем, есть ли видео
                        $video = get_sub_field('video');
                    ?>
                        <li>
                            <?php if ($video): ?>
                                <video data-src="<?= esc_url($video) ?>" autoplay muted playsinline class="lazy-video">
                                    Ваш браузер не поддерживает видео.
                                </video>
                            <?php elseif ($foto && !empty($foto['id'])): 
                                $image = wp_get_attachment_image_src($foto['id'], 'carousel-story');
                                $img_url = $image[0] ?? $foto['url'];
                            ?>
                                <img 
                                             src="<?= esc_url($img_url) ?>" 
                                            alt="<?= esc_attr($foto['alt'] ?? '') ?>"
                                        />
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>

    <?php endwhile; ?>

<?php endif; ?>

<main class="main-page content">

    <?php if (have_rows('carusel-added-owl', 59177)): ?>
            <section class="product-top">
                <div class="carusel-added container">
                    <div class="row">
                        <div class="col-1 d-md-flex d-none align-items-center">
                            <a href="javascript:void(0)" class="arrow-prev carusel-nav" id="carusel-added-prev"></a>
                        </div>
                        <div class="col-12 col-md-10">
                            <ul class="carusel-added-owl owl-carousel owl-theme" id="carusel-added-owl">
                                <?php while (have_rows('carusel-added-owl', 59177)): the_row(); 
                                    $id = 'open-carusel-added-story_' . get_row_index();
                                    $img = get_sub_field('img');
                                    $title = get_sub_field('title');
                                ?>
                                    <li id="<?=$id?>">
                                        <a href="javascript:void(0)">
                                            <img src="<?= esc_url($img) ?>" alt="<?= esc_attr($title) ?>" />
                                            <span><?= esc_html($title) ?></span>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                        <div class="col-1 d-md-flex d-none justify-content-end align-items-center">
                            <a href="javascript:void(0)" class="arrow-next carusel-nav" id="carusel-added-next"></a>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <section class="breadcrubs-custom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="product-header position-relative">
        <img src="<?=get_stylesheet_directory_uri(); ?>/images/nashey-atmosfere-zaviduyut-1.svg" class="product-header_svg1" alt="" />
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                    <?

                    // Получаем ID главного изображения
                    $main_image_id = $product->get_image_id();

                    // Получаем галерею (без главного)
                    $gallery_ids = $product->get_gallery_image_ids();

                    // Формируем полный массив: главное + галерея
                    $attachment_ids = array_filter(array_merge(
                        $main_image_id ? [$main_image_id] : [],
                        $gallery_ids ?: []
                    ));

                    // Если нет изображений — не выводим блок
                    if (empty($attachment_ids)) return;
                    ?>

                    <div class="product-header-left_column">
                        <!-- Основная карусель -->
                        <ul class="owl-list owl-carousel owl-theme product-header_img" id="product-header_img">
                            <?php foreach ($attachment_ids as $index => $attachment_id): ?>
                                <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                    <a href="<?php echo wp_get_attachment_image_url($attachment_id, array(1920, 1080)); ?>" 
                                    class="product-header-main_foto fancybox" data-fancybox="product-gallery">
                                        <?php echo wp_get_attachment_image($attachment_id, 'product_detail', false, [
                                            'alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true),
                                            'loading' => 'lazy'
                                        ]); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Миниатюры -->
                        <ul class="owl-list product-header_prev-img">
                            <?php foreach ($attachment_ids as $index => $attachment_id): ?>
                                <li class="<?php echo $index === 0 ? 'active' : ''; ?>">
                                    <a href="javascript:void(0)" data-index="<?php echo $index; ?>">
                                        <?php echo wp_get_attachment_image($attachment_id, array(150, 150), false, [
                                            'alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true),
                                            'loading' => 'lazy'
                                        ]); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6 product-header_right">



                    <?
                    $output = '';

                    // === Дизайнер (таксономия 'designer') ===
                    $designers = get_the_terms($product->get_id(), 'designer');
                    if ($designers && !is_wp_error($designers)) {
                        $term = reset($designers); // берем первый термин
                        $output .= '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                    }

                    // === Коллекция / Год (предположим, таксономия 'collection') ===
                    $collections = get_the_terms($product->get_id(), 'collection');
                    if ($collections && !is_wp_error($collections)) {
                        $term = reset($collections);
                        if ($output) $output .= ' '; // добавляем пробел между ссылками
                        $output .= '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                    }

                    // Выводим блок, только если есть хотя бы один термин
                    if ($output):
                    ?>
                        <span class="product-header_collect d-block">
                            <?= $output ?>
                        </span>
                    <?php endif; ?>


                    
                    <div class="product-header_right-item1 row">
                        <div class="col-md-6">
                            <?php if (have_posts()) : the_post(); ?>
                                <h1 class="product-header_name d-block"><?php the_title(); ?></h1>
                            <?php endif; ?>
                            <span class="product-header_cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                        </div>
                        <div class="col-md-6 position-relative">
                            <?if($product->is_in_stock()):?>
                                <span class="d-md-none product-header_stock d-block header_stock-mobile">В наличии</span>
                             <?endif?>
                            <?if(!empty($product->get_price())):?>
                                <span class="product-header_price d-block"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                            <?endif?>
                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                <span class="product-header_oldprice d-block"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                             <?endif?>
                        </div>
                    </div> 
                    <?if($product->is_in_stock()):?>
                        <span class="d-block product-header_stock d-none d-md-block">В наличии</span>
                    <?endif?>

                    <?
                    if ($product && $product->is_type('variable')) {
                        // Получаем атрибут "размер"
                        $attribute_name = 'pa_razmer'; // ← убедитесь, что это правильный slug
                        $available_sizes = wc_get_product_terms($product->get_id(), $attribute_name, ['fields' => 'slugs']);
                        $available_variations = $product->get_available_variations();

                        // Собираем данные о размерах: доступен ли, SKU, в наличии
                        $sizes_info = [];
                        foreach ($available_sizes as $size_slug) {
                            $term = get_term_by('slug', $size_slug, $attribute_name);
                            if (!$term) continue;

                            $size_name = $term->name;
                            $is_available = false;
                            $is_in_stock = false;

                            // Ищем вариацию с этим размером
                            foreach ($available_variations as $variation) {
                                if (!empty($variation['attributes']['attribute_' . $attribute_name]) &&
                                    $variation['attributes']['attribute_' . $attribute_name] === $size_slug) {
                                    $is_available = true;
                                    $variation_obj = wc_get_product($variation['variation_id']);
                                    $is_in_stock = $variation_obj && $variation_obj->is_in_stock();
                                    break;
                                }
                            }

                            $sizes_info[] = [
                                'name' => $size_name,
                                'slug' => $size_slug,
                                'available' => $is_available,
                                'in_stock' => $is_in_stock
                            ];
                        }

                        // Находим первый доступный размер для активного состояния
                        $active_size = null;
                        foreach ($sizes_info as $size) {
                            if ($size['available'] && $size['in_stock']) {
                                $active_size = $size['slug'];
                                break;
                            }
                        }
                    }
                    ?>

                    <?if ($product && $product->is_type('variable')):?>
                        <div class="d-flex product-header_size">
                            <span>Размер:</span>
                            <ul class="d-flex owl-list product-header_size-list">
                                <?php foreach ($sizes_info as $size): ?>
                                    <li>
                                        <?php if ($size['available'] && $size['in_stock']): ?>
                                            <a href="#" 
                                            data-size="<?= esc_attr($size['slug']) ?>"
                                            class="<?= $size['slug'] === $active_size ? 'active' : '' ?>">
                                                <?= esc_html($size['name']) ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="#" class="disables" aria-disabled="true">
                                                <?= esc_html($size['name']) ?>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?endif?>


                    <?
                    $variations_data = [];

                    if ($product && $product->is_type('variable')) {
                        $available_variations = $product->get_available_variations();
                        foreach ($available_variations as $variation) {
                            $variation_id = $variation['variation_id'];
                            $sku = wc_get_product($variation_id)->get_sku();
                            $size = ''; // попробуем из атрибута 'pa_razmer'

                            // Ищем значение атрибута "размер"
                            if (!empty($variation['attributes']['attribute_pa_razmer'])) {
                                $size = $variation['attributes']['attribute_pa_razmer'];
                            } elseif (!empty($variation['attributes']['attribute_razmer'])) {
                                $size = $variation['attributes']['attribute_razmer'];
                            }

                            if ($size) {
                                $variations_data[$size] = [
                                    'id' => $variation_id,
                                    'sku' => $sku,
                                    'size' => $size
                                ];
                            }
                        }
                    }
                    ?>
                    <script>
                    const variationMap = <?php echo json_encode($variations_data); ?>;

                    document.addEventListener('DOMContentLoaded', function () {
                    const sizeLinks = document.querySelectorAll('.product-header_size-list a');
                    const skuElement = document.querySelector('.product-sku'); // или где у вас выводится артикул

                    sizeLinks.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();

                            const size = this.textContent.trim();
                            const data = variationMap[size];

                            if (data) {
                                // Устанавливаем активный класс
                                sizeLinks.forEach(el => el.classList.remove('active'));
                                this.classList.add('active');

                                // Обновляем артикул
                                if (skuElement) {
                                    const skuText = skuElement.innerHTML;
                                    // Заменяем только SKU (предположим, что формат: "Артикул: #61158")
                                    skuElement.innerHTML = data.sku;
                                }

                                // Опционально: обновить цену/изображение
                                // window.location.href = '?add-to-cart=' + data.id; // если нужно переключить вариацию
                            }
                        });
                    });
                });
                    </script>
                
                    <?
                    if ($product && $product->get_sku()) {
                        echo '<span class="d-block product-header_article">Артикул: <span class="product-sku">' . esc_html($product->get_sku()) . '</span></span>';
                    }
                    ?>

                    <div class="d-grid product-header_btn">
                        <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                        <a href="javascript:void(0)" class="theme-button button-main ms_booking">Записаться на примерку</a>
                        <span class="font-cursive d-none d-md-block">или звони:</span>
                        <img src="<?=get_stylesheet_directory_uri(); ?>/images/ili-zvoni.svg" class="d-md-none d-block" alt="" />
                        <a href="tel:+78129291699" class="product-header_phone">+7 (812) 929-16-99</a>
                    </div>
                    <div class="d-md-block product-header_decor d-none d-md-block">
                        <img src="<?=get_stylesheet_directory_uri(); ?>/images/nadpisi.svg" alt="" />
                    </div>
                    <div class="d-md-none product-header_decor d-block">
                        <img src="<?=get_stylesheet_directory_uri(); ?>/images/nadpisi-1.svg" alt="" />
                    </div>
                    
                    <?php
             
                        $description = $product->get_post_data()->post_content;

                        // Удаляем ВСЕ шорткоды WPBakery (включая [/vc_...])
                        $description = preg_replace('/\[[\/]?vc_[^\]]*\]/', '', $description);

                        // Удаляем остальные шорткоды (на всякий случай)
                        $description = strip_shortcodes($description);

                        // Очищаем от лишних пробелов и HTML-комментариев
                        $description = trim(wp_strip_all_tags($description));

                        // Показываем блок ТОЛЬКО если есть текст
                        if (!empty($description)) :
                    ?>
                            <div class="product-header_prevtext">
                                <?=$description?>
                            </div>
                    <?php
                        endif;
                    ?>

                </div>
            </div>
        </div>


        <?php
        global $product;
        if (!$product) return;

        // Получаем текущую категорию (для формирования URL)
        $category_slug = 'wedding'; // fallback
        if (is_product_category()) {
            $term = get_queried_object();
            $category_slug = $term->slug;
        } else {
            // Ищем первую категорию товара
            $terms = wp_get_post_terms($product->get_id(), 'product_cat', ['fields' => 'slugs']);
            if (!empty($terms)) {
                $category_slug = reset($terms);
            }
        }

        // Базовый URL категории
        $base_url = home_url("/c/{$category_slug}/");

        // === Цвет (таксономия: pa_czvet) ===
        $colors = get_the_terms($product->get_id(), 'pa_czvet');
        $color_html = '';
        if ($colors && !is_wp_error($colors)) {
            foreach ($colors as $term) {
                $url = add_query_arg(['_f' => '1', '_color' => $term->slug], $base_url);
                $color_html .= '<a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
            }
        }

        // === Силуэт (таксономия: silhouette) ===
        $silhouettes = get_the_terms($product->get_id(), 'silhouette');
        $silhouette_html = '';
        if ($silhouettes && !is_wp_error($silhouettes)) {
            foreach ($silhouettes as $term) {
                $url = add_query_arg(['_f' => '1', '_silhouette' => $term->slug], $base_url);
                $silhouette_html .= '<a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
            }
        }

        // === Стиль (таксономия: style) ===
        $styles = get_the_terms($product->get_id(), 'style');
        $style_html = '';
        if ($styles && !is_wp_error($styles)) {
            foreach ($styles as $term) {
                $url = add_query_arg(['_f' => '1', '_style' => $term->slug], $base_url);
                $style_html .= '<a href="' . esc_url($url) . '">' . esc_html($term->name) . '</a>';
            }
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="fast-categories">
                        <?php if ($color_html): ?>
                        <div>                      
                            <span>Цвет:</span>
                            <?= $color_html ?>
                        </div>
                         <?php endif; ?>
                         <?php if ($silhouette_html): ?>
                        <div>                      
                            <span>Силуэт:</span>
                            <?= $silhouette_html ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($style_html): ?>
                        <div>                      
                            <span>Стиль:</span>
                            <?= $style_html ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </section>


     <?php
    // Определяем категории и их заголовки
    $categories = [
        'accessories' => 'Аксессуары',
        'outerwear'   => 'Верхняя одежда',
        'veils'       => 'Фаты',
        'cosmetics'   => 'Косметика'
    ];

    $all_products = [];

    // Собираем до 3 товаров из каждой категории
    foreach ($categories as $slug => $label) {
        $products = wc_get_products([
            'category' => [$slug],
            'limit'    => 3,
            'status'   => 'publish',
            'orderby'  => 'date',
            'order'    => 'DESC'
        ]);

        if (!empty($products)) {
            foreach ($products as $product) {
                $all_products[] = $product;
            }
        }
    }

    // Показываем блок, только если есть хотя бы один товар
    if (!empty($all_products)):
    ?>
        <section class="only-have position-relative bg-main">
            <a href="">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rozovyy-merch.svg" class="custom-rozovyy-merch" alt="">
            </a>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <span class="section-subtitle d-block text-center">подойдет к этому товару</span>
                        <h2 class="section-title text-center font-title">аксессуары</h2>
                    </div>
                </div>
                <div class="row margin-bottom-80">
                    <div class="col-12">
                        <div class="new-in-salon-carusel">
                            <ul class="owl-carousel owl-theme owl-list" id="only-have-carusel">
                                <?php foreach ($all_products as $product): ?>
                                    <li>
                                        <div class="tabs-carusel_image-wrap">
                                            <div class="tabs-carusel_image">
                                                <?php
                                                $image_id = $product->get_image_id();
                                                if ($image_id) {
                                                    echo wp_get_attachment_image($image_id, [400, 600], false, [
                                                        'class' => 'product-gallery-image',
                                                        'loading' => 'lazy'
                                                    ]);
                                                } else {
                                                    echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="Нет изображения" />';
                                                }
                                                ?>
                                                <div class="tabs-carusel_image-btn justify-content-around">
                                                    <a href="javascript:void(0)" 
                                                    class="add-favorite woosw-btn" 
                                                    data-id="<?= esc_attr($product->get_id()) ?>" 
                                                    data-product_name="<?= esc_attr($product->get_name()) ?>" 
                                                    aria-label="Добавить в избранное"></a>
                                                    <a href="<?= esc_url($product->get_permalink()) ?>"class="theme-button button-main">Хочу примерить</a>
                                                </div>
                                                <?php if ($product->is_in_stock()): ?>
                                                    <span class="in-sklad">в наличии</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="tabs-carusel_data">
                                            <span class="tabs-carusel_data-cat d-block">
                                                <?= esc_html(get_field('tip_tovara', $product->get_id()) ?: '') ?>
                                            </span>
                                            <a href="<?= esc_url($product->get_permalink()) ?>" class="tabs-carusel_data-name d-table" style="color:#181818">
                                                <?= esc_html($product->get_name()) ?>
                                            </a>
                                        </div>
                                        <div class="tabs-carusel_price text-center">
                                            <?php if (!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()): ?>
                                                <span class="tabs-carusel_data-old-price">
                                                    <?= number_format((float)$product->get_regular_price(), 0, ',', ' ') ?>₽
                                                </span>
                                            <?php endif; ?>
                                            <?php if (!empty($product->get_price())): ?>
                                                <span class="tabs-carusel_data-price">
                                                    <?= number_format((float)$product->get_price(), 0, ',', ' ') ?>₽
                                                </span>
                                            <?php endif; ?>
                                            <a href="<?= esc_url($product->get_permalink()) ?>" class="link-item"></a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tabs-carusel_dot new-in-salon-carusel_dot d-md-table d-none">
                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="only-have_prev"></a>
                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="only-have_next"></a>
                            </div>
                        </div>    
                    </div>
                    <div class="mobile-dots d-flex d-md-none justify-content-between">
                        <a href="javascript:void(0)" id="only-have-carusel_prev1"></a>
                        <a href="javascript:void(0)" id="only-have-carusel_next1"></a>
                    </div>
                </div>
            </div>
            <div class="lenta-stroke2 z-index-0">
                <svg width="100%" height="180" viewBox="0 0 1920 180" preserveAspectRatio="none">
                    <path d="M0,40 C250,-20 500,100 750,40 C1000,-20 1250,100 1500,40 C1700,-20 1850,100 1920,40 L1920,80 C1850,140 1700,20 1500,80 C1250,140 1000,20 750,80 C500,140 250,20 0,80 Z" fill="rgba(24, 24, 24, 1)" />
                    <path id="text-path" d="M0,60 C250,0 500,120 750,60 C1000,0 1250,120 1500,60 C1700,0 1850,120 1920,60" stroke="none" fill="none" />
                    <text font-size="14" fill="#fde5ec" text-anchor="middle" letter-spacing="1" id="svg_text_3" dy="5">
                        <textPath href="#text-path" startOffset="50%"><?=$text_stroke?><animate attributeName="startOffset" from="100%" to="-100%" dur="120s" repeatCount="indefinite" />
                        </textPath>
                    </text>
                </svg>
            </div>  
        </section>
    <?php endif; ?>

    <?php
    if ($current_product_id) {
        include __DIR__ . '/custom-blocks/similar-products.php';
    }
    ?>

    <section class="blog-list">
        <div class="your-turn_righ_top">
            <img class="your-turn-svg2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/spletni.svg" alt="">
            <ul>
                <li><a href="https://t.me/jullybridesalon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-telegram.svg" alt=""></a></li>
                <li><a href="https://vk.com/jullybride"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-vkontakte.svg" alt=""></a></li>
                <li><a href="https://instagram.com/jullybride"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-instagram.svg" alt=""></a></li>
                <li><a href="https://www.youtube.com/channel/UCo_Zo2x9fyN19uuxkWO_v-g"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-youtube.svg" alt=""></a></li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="section-subtitle d-block text-center">Советы стилистов</span>
                    <h2 class="section-title text-center font-title">Немного полезностей</h2>
                </div>
            </div>
        </div>
        <?php
// Запрашиваем 6 последних записей из рубрики "blog" (если она есть)
// Или просто 6 последних постов типа "post"
$blog_posts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
]);

if ($blog_posts->have_posts()):
?>
    <ul class="owl-list blog-list_carusel owl-carousel owl-theme autoheight" id="blog-list_carusel">
        <?php while ($blog_posts->have_posts()): $blog_posts->the_post(); ?>
            <li>
                <div class="blog-list_img">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('blog_carousel', ['alt' => get_the_title()]); ?>
                    <?php endif; ?>
                </div>
                <div class="blog-list_data">
                    <span><?php echo esc_html(get_the_title()); ?></span>
                </div>
                <div class="blog-list_meta d-flex">
                    <span><?php echo get_the_date('d.m.Y'); ?></span>
                    <a href="<?php echo esc_url(get_permalink()); ?>">Читать статью</a>
                </div>
            </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </ul>
<?php endif; ?>
        <div class="tabs-carusel_dot new-in-salon-carusel_dot reviews-carusel_dot d-none d-md-table">
            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="blog-list_carusel_prev"></a>
            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="blog-list_carusel_next"></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center position-relative">
                    <a href="/blog/" class="theme-button button-main custom_main_btn">читать больше</a>
                </div>
            </div>
        </div>
    </section>

     <section class="box-important position-relative">
                <div class="container position-relative z-index-1">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                        <? if ($box_important): ?>
                            <?php foreach ($box_important as $item): 
                                    $title = $item['title'] ?? '';
                                    $text = $item['text'] ?? '';
                                ?>
                                <div class="box-important_item1 text-center">
                                    <span class="box-important_item1-title font-cursive d-block text-center"><?=$title?></span>
                                    <span class="box-important_item1-desc"><?=$text?></span>
                                    <div>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vector-11.svg" alt="" />
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?endif?>    
                        </div>
                        <div class="col-md-4">
                            <div class="box-important_item2">
                                <video 
                                    data-src="<?=$video_important?>" 
                                    poster="<?php echo get_stylesheet_directory_uri(); ?>/images/galereya1.png"
                                    autoplay
                                    muted 
                                    playsinline 
                                    loop 
                                    class="bg-video lazy-video">
                                    Ваш браузер не поддерживает видео.
                                </video>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box-important_item3 d-flex justify-content-center align-items-center">
                                <div class="position-relative">
                                    <span class="box-important_item3-cursive font-cursive d-block">“то самое”</span>
                                    <span class="box-important_item3-title font-title d-block">совсем близко</span>
                                </div>
                                <span class="box-important_item3-desc">Ты находишься в одном шаге<br> от знакомства с платьем мечты!</span>
                                <a href="javascript:void(0)" class="button-main-main-bg theme-button d-table ms_booking">Записаться на примерку</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lenta-stroke2 z-index-0">
                    <svg width="100%" height="180" viewBox="0 0 1920 180" preserveAspectRatio="none">
                        <path
                            d="M0,40 C250,-20 500,100 750,40 C1000,-20 1250,100 1500,40 C1700,-20 1850,100 1920,40 L1920,80 C1850,140 1700,20 1500,80 C1250,140 1000,20 750,80 C500,140 250,20 0,80 Z"
                            fill="rgba(24, 24, 24, 1)" />
                    
                        <path id="text-path" d="M0,60 C250,0 500,120 750,60 C1000,0 1250,120 1500,60 C1700,0 1850,120 1920,60" stroke="none"
                            fill="none" />
                    
                        <text font-size="14" fill="#fde5ec" text-anchor="middle" letter-spacing="1" id="svg_text_4" dy="5">
                            <textPath href="#text-path" startOffset="50%"><?=$text_stroke?><animate attributeName="startOffset" from="100%" to="-100%" dur="120s" repeatCount="indefinite" />
                            </textPath>
                        </text>
                    </svg>
                </div>
                <img class="box-important-svg1 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/2000.svg" alt="" />
            </section>

</main>

<?php get_footer(); ?>
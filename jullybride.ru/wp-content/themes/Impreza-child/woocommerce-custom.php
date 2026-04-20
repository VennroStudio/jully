<?php
// woocommerce-custom.php
get_header('page-59177');

//Получаем поля с новой главной страницы
$box_important  = get_field( 'box_important', 59177 );
$video_important  = get_field( 'video_important', 59177 );
$text_stroke  = get_field( 'text_stroke', 59177 );
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

<main class="main-page content products">

        <?php if (have_rows('carusel-added-owl', 59177)): ?>
            <section class="product-top">
                <div class="carusel-added container">
                    <div class="row">
                        <div class="col-1 d-md-flex d-none align-items-center">
                            <a href="javascript:void(0)" class="arrow-prev carusel-nav disabled" id="carusel-added-prev"></a>
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
                            <a href="javascript:void(0)" class="arrow-next carusel-nav disabled" id="carusel-added-next"></a>
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
    
        <section class="top-products">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                            if (is_product_category()) {
                                $term = get_queried_object();
                                $h1 = get_field('h1', 'product_cat_' . $term->term_id);
                                
                                if ($h1) {
                                    echo '<h1 class="font-title">' . esc_html($h1) . '</h1>';
                                } else {
                                    echo '<h1 class="font-title">' . esc_html($term->name) . '</h1>';
                                }
                            }
                        ?>       
                    </div>
                </div>
            </div>
        </section>

        
        <section class="top-filters">
            <div class="container position-relative">

                <div class="filter-box">
                    <div class="filter-wrap">
                        <button class="w-filter-list-closer" type="button" title="Закрыть" aria-label="Закрыть"></button>
                        <span class="filter-box_title d-block">Фильтр</span>
                        <?php echo do_shortcode('[fe_widget]');?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <a href="javascript:void(0)" class="left-filter-btn">Фильтр</a>
                        <?php echo do_shortcode('[fe_sort id="2"]'); ?>
                    </div>
                </div>
            </div>
        </section>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Обновляем select на основе текущего URL
            const syncSelectFromUrl = (selectId, paramName) => {
                const select = document.getElementById(selectId);
                if (!select) return;

                const current = new URLSearchParams(window.location.search).get(paramName);
                select.value = current || '';
            };

            // Обработчик изменения
            const attachChangeHandler = (selectId, paramName) => {
                const select = document.getElementById(selectId);
                if (!select) return;

                select.onchange = function () {
                    const params = new URLSearchParams(window.location.search);

                    if (this.value) {
                        params.set(paramName, this.value);
                    } else {
                        params.delete(paramName);
                    }

                    // Удаляем пагинацию
                    params.delete('paged');

                    // Переход
                    window.location.href = window.location.pathname + '?' + params.toString();
                };
            };

            // Инициализация
            syncSelectFromUrl('filter-length', '_length');
            syncSelectFromUrl('filter-silhouette', '_silhouette');

            attachChangeHandler('filter-length', '_length');
            attachChangeHandler('filter-silhouette', '_silhouette');
        });
        </script>
        <section class="last-filter" id="custom-filters" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex">


                        <select id="filter-length" class="filter-length">
                            <option value="">Длина</option>
                            <option value="mini" <?php echo isset($_GET['_length']) && $_GET['_length'] === 'mini' ? 'selected' : ''; ?>>Мини</option>
                            <option value="midi" <?php echo isset($_GET['_length']) && $_GET['_length'] === 'midi' ? 'selected' : ''; ?>>Миди</option>
                            <option value="short-in-front" <?php echo isset($_GET['_length']) && $_GET['_length'] === 'short-in-front' ? 'selected' : ''; ?>>Короткие спереди</option>
                            <option value="dlinnoe" <?php echo isset($_GET['_length']) && $_GET['_length'] === 'dlinnoe' ? 'selected' : ''; ?>>Длинное</option>
                        </select>
                        
                        <select id="filter-silhouette" class="filter-silhouette">
                            <option value="">Силуэт</option>
                            <option value="a-line" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'a-line' ? 'selected' : ''; ?>>А-силуэт</option>
                            <option value="mermaid" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'mermaid' ? 'selected' : ''; ?>>Рыбка</option>
                            <option value="empire" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'empire' ? 'selected' : ''; ?>>Ампир</option>
                            <option value="straight" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'straight' ? 'selected' : ''; ?>>Прямое</option>
                            <option value="sheath" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'sheath' ? 'selected' : ''; ?>>Футляр</option>
                            <option value="lush" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'lush' ? 'selected' : ''; ?>>Пышное</option>
                            <option value="transformer" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'transformer' ? 'selected' : ''; ?>>Трансформер</option>
                            <option value="suit" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'suit' ? 'selected' : ''; ?>>Комбинезон/костюм</option>
                            <option value="princess" <?php echo isset($_GET['_silhouette']) && $_GET['_silhouette'] === 'princess' ? 'selected' : ''; ?>>Принцесса</option>
                        </select>
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const checkFilters = () => {
                                const $block = document.getElementById('custom-filters');
                                if (!$block) return;

                                // Проверяем наличие терминов в WPC-фильтре
                                const hasLength = !document.querySelector('.wpc-filter-length.wpc-filter-terms-count-0');
                                const hasSilhouette = !document.querySelector('.wpc-filter-silhouette.wpc-filter-terms-count-0');

                                // Находим select'ы
                                const $length = $block.querySelector('.nice-select.filter-length');
                                const $silhouette = $block.querySelector('.nice-select.filter-silhouette');

                                // Скрываем/показываем
                                $length.style.display = hasLength ? 'block' : 'none';
                                $silhouette.style.display = hasSilhouette ? 'block' : 'none';

                                // Показываем блок, если хотя бы один select виден (цена всегда есть)
                                $block.style.display = 'block';
                            };

                            // Запускаем сразу
                            checkFilters();

                            // На случай AJAX-загрузки фильтра
                            setTimeout(checkFilters, 1000);
                        });
                        </script>

                        <!-- Цена (всегда видна) -->
                        <!-- Выпадающий блок "Цена" -->
                         <?php
                        // Получаем аргументы для запроса с учётом фильтров
                        $args = [
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'fields' => 'ids',
                        ];

                        // Категория
                        if (is_product_category()) {
                            $term = get_queried_object();
                            if ($term) {
                                $args['product_cat'] = $term->slug;
                            }
                        }

                        // Фильтры WPC
                        $filters = ['_length', '_silhouette', '_color', '_style', '_pa_razmer'];
                        foreach ($filters as $key) {
                            if (!empty($_GET[$key])) {
                                $value = $_GET[$key];
                                if ($key === '_color') {
                                    $taxonomy = 'pa_czvet';
                                } elseif (strpos($key, '_pa_') === 0) {
                                    $taxonomy = substr($key, 1);
                                } else {
                                    $taxonomy = ltrim($key, '_');
                                }
                                $args['tax_query'][] = [
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => $value
                                ];
                            }
                        }

                        // Запрос
                        $products = new WP_Query($args);
                        $product_ids = $products->posts;

                        $min_price = 0;
                        $max_price = 100000;

                        if (!empty($product_ids)) {
                            global $wpdb;
                            $ids_str = implode(',', array_map('intval', $product_ids));
                            $min_price = (int) $wpdb->get_var("SELECT MIN(meta_value+0) FROM {$wpdb->postmeta} WHERE meta_key = '_price' AND post_id IN ({$ids_str})");
                            $max_price = (int) $wpdb->get_var("SELECT MAX(meta_value+0) FROM {$wpdb->postmeta} WHERE meta_key = '_price' AND post_id IN ({$ids_str})");
                            $min_price = $min_price ?: 0;
                            $max_price = $max_price ?: 100000;
                        }
                        ?>

                        <script>
                        window.priceData = {
                            min: <?php echo (int)$min_price; ?>,
                            max: <?php echo (int)$max_price; ?>
                        };
                        </script>
                        <!-- Выпадающий блок "Цена" -->
                        <div class="filter-price-dropdown" id="price-dropdown-root">
                            <div class="filter-price-trigger" tabindex="0">
                                Цена
                            </div>
                        </div>

<style>
.filter-price-dropdown {
    position: relative;
    display: inline-block;
    cursor: pointer;
}
.filter-price-trigger {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
    user-select: none;
}
.filter-price-content {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    width: 280px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 10000;
}
.filter-price-range {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
}
.filter-price-range input {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
#price-slider {
    height: 4px;
    background: #eee;
    border-radius: 2px;
    margin-bottom: 16px;
    position: relative;
}
#price-slider .ui-slider-range {
    background: #fde5ec;
    border-radius: 2px;
    position: absolute;
    top: 0;
    height: 100%;
}
#price-slider .ui-slider-handle {
    width: 16px;
    height: 16px;
    background: #fde5ec;
    border: 2px solid #f5cdcb;
    border-radius: 50%;
    position: absolute;
    top: -6px;
    cursor: pointer;
    outline: none;
}
.filter-price-actions {
    display: flex;
    gap: 10px;
}
.filter-price-actions .btn {
    flex: 1;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
}
.btn-apply { background: #fde5ec; color: #181818; }
.btn-reset { background: #eee; color: #181818; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const root = document.getElementById('price-dropdown-root');
    if (!root) return;

    const trigger = root.querySelector('.filter-price-trigger');
    if (!trigger) return;

    // Создаём портал в body
    const portal = document.createElement('div');
    portal.className = 'filter-price-portal';
    portal.style.cssText = 'top: 0; left: 0; z-index: 10000; pointer-events: none;';
    document.body.appendChild(portal);

    // Создаём контент выпадашки
    const content = document.createElement('div');
    content.className = 'filter-price-content';
    content.innerHTML = `
        <div class="filter-price-range">
            <input type="number" id="min-price" placeholder="От" min="0">
            <input type="number" id="max-price" placeholder="До" min="0">
        </div>
        <div id="price-slider"></div>
        <div class="filter-price-actions">
            <button type="button" class="btn btn-apply">Применить</button>
            <button type="button" class="btn btn-reset">Сбросить</button>
        </div>
    `;
    portal.appendChild(content);

    // Позиционирование
    function updatePosition() {
        const rect = trigger.getBoundingClientRect();
        content.style.cssText = `
            position: absolute;
            top: ${rect.bottom + window.scrollY}px;
            left: ${rect.left - window.scrollX -160}px;
            display: ${root.classList.contains('active') ? 'block' : 'none'};
            pointer-events: auto;
            width: 280px;
        `;
    }

    // Открытие/закрытие
    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        root.classList.toggle('active');
        updatePosition();
    });

    document.addEventListener('click', function (e) {
        if (!root.contains(e.target) && !content.contains(e.target)) {
            root.classList.remove('active');
            updatePosition();
        }
    });

    window.addEventListener('scroll', updatePosition);
    window.addEventListener('resize', updatePosition);

    // Элементы
    const minInput = content.querySelector('#min-price');
    const maxInput = content.querySelector('#max-price');
    const applyBtn = content.querySelector('.btn-apply');
    const resetBtn = content.querySelector('.btn-reset');

    if (!minInput || !maxInput || !applyBtn || !resetBtn) return;

    // Установка значений
    const realMin = window.priceData?.min || 0;
    const realMax = window.priceData?.max || 100000;

    minInput.placeholder = `${realMin}`;
    maxInput.placeholder = `${realMax}`;

    const urlParams = new URLSearchParams(window.location.search);
    const currentMin = parseInt(urlParams.get('min__price')) || '';
    const currentMax = parseInt(urlParams.get('max__price')) || '';

    minInput.value = currentMin;
    maxInput.value = currentMax;

    // Применить
    applyBtn.addEventListener('click', function () {
        const min = minInput.value.trim();
        const max = maxInput.value.trim();
        const params = new URLSearchParams(window.location.search);
        if (min !== '') params.set('min__price', min);
        else params.delete('min__price');
        if (max !== '') params.set('max__price', max);
        else params.delete('max__price');
        window.location.href = window.location.pathname + '?' + params.toString().replace(/%3B/g, ';');
    });

    // Сбросить
    resetBtn.addEventListener('click', function () {
        minInput.value = '';
        maxInput.value = '';
        const params = new URLSearchParams(window.location.search);
        params.delete('min__price');
        params.delete('max__price');
        window.location.href = window.location.pathname + '?' + params.toString().replace(/%3B/g, ';');
    });

    // jQuery UI Slider
    if (typeof jQuery !== 'undefined' && jQuery.ui?.slider) {
        const minVal = currentMin !== '' ? currentMin : realMin;
        const maxVal = currentMax !== '' ? currentMax : realMax;

        jQuery(content.querySelector('#price-slider')).slider({
            range: true,
            min: realMin,
            max: realMax,
            values: [minVal, maxVal],
            slide: function(event, ui) {
                minInput.value = ui.values[0];
                maxInput.value = ui.values[1];
            }
        });
    }
});
</script>
                        

                    </div>
                </div>
            </div>
        </section>
        <script>
        //показ фильтров
        document.addEventListener('DOMContentLoaded', function () {
            const updateCustomFilters = () => {
                const hasLengthTerms = !document.querySelector('.wpc-filter-length.wpc-filter-terms-count-0');
                const hasSilhouetteTerms = !document.querySelector('.wpc-filter-silhouette.wpc-filter-terms-count-0');

                const $length = document.getElementById('filter-length');
                const $silhouette = document.getElementById('filter-silhouette');
                const $block = document.getElementById('custom-filters');

                if ($length) {
                    //$length.style.setProperty('display', hasLengthTerms ? 'block' : 'none', 'important');
                }
                if ($silhouette) {
                    //$silhouette.style.setProperty('display', hasSilhouetteTerms ? 'block' : 'none', 'important');
                }
                if ($block) {
                    $block.style.display = 'block'; // цена всегда есть
                }
            };

            updateCustomFilters();
            document.addEventListener('wpc_filters_loaded', updateCustomFilters);
            setTimeout(updateCustomFilters, 1000);
        });
        </script>
            


        <?if (have_posts()) :?>
        <section class="products-list-box position-relative">

            <div class="container products-list">
                <div class="row" id="products-row">

                    <?php $i = 0; while (have_posts()) : the_post(); global $product; $i++; ?>                      
                        
                        <div class="col-md-4 col-6 products-list-item">
                            <div class="position-relative product-carousel-wrapper">

                                <?php
                                // Товар считается новинкой, если опубликован менее 30 дней назад
                                $post_date = strtotime($product->get_date_created());
                                $days_ago = (time() - $post_date) / (60 * 60 * 24);
                                ?>
                                <?php if ($days_ago <= 30): ?>
                                    <div class="products-list-item_shild products-list-item_shild-two"></div>
                                <?php endif; ?>

                                <?php if (!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()): ?>
                                    <div class="products-list-item_shild products-list-item_shild-three"></div>
                                <?php endif; ?>    
                                
                                <?php
                                // Получаем изображения товара
                                $main_image_id = $product->get_image_id();
                                $gallery_ids = $product->get_gallery_image_ids();
                                $attachment_ids = array();

                                if ($main_image_id) {
                                    $attachment_ids[] = $main_image_id;
                                }

                                if (!empty($gallery_ids)) {
                                    $attachment_ids = array_merge($attachment_ids, $gallery_ids);
                                }

                                $attachment_ids = array_filter($attachment_ids);
                                ?>

                                <a href="<?= esc_url($product->get_permalink()) ?>">
                                    <ul class="owl-list products-list-carusel owl-carousel owl-theme">
                                        <?php foreach ($attachment_ids as $index => $attachment_id): ?>
                                            <li>
                                                <div class="products-list_img-row">
                                                    <?php
                                                    $image_attributes = wp_get_attachment_image_src( $attachment_id, [400, 600], $icon = false);
                                                    ?>
                                                    <?if ($i <= 3):?>
                                                        <img data-src="<?=$image_attributes[0] ?>" data-critical="true" alt="<?= get_the_title() ?>" rel="preload">
                                                    <?else:?>
                                                        <img src="<?=$image_attributes[0] ?>" alt="<?= get_the_title() ?>">
                                                    <?endif?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </a>    

                                <?php if (count($attachment_ids) > 1): ?>
                                    <a href="javascript:void(0)" class="products-nav products-nav-prev"></a>
                                    <a href="javascript:void(0)" class="products-nav products-nav-next"></a>
                                <?php endif; ?> 

                                <?php if ($product->is_in_stock()): ?>
                                    <span class="products-list-item_istock">в наличии</span>
                                <?php endif; ?>       
                                <div class="products-list-item_btn"> 
                                    <a href="javascript:void(0)" class="products-list_favorite woosw-btn" data-id="<?= $product->id ?>" data-product_name="<?= esc_attr($product->get_name()) ?>" aria-label=" "></a>
                                    <a href="<?= esc_url($product->get_permalink()) ?>" class="products-list_btn">Хочу примерить</a>
                                </div> 
                                <div class="products-list_overlay"></div>
                            </div>
                            <div class="text-center products-list_data">
                                <span class="d-block products-list_name"><?= get_field('tip_tovara', $product->id) ?></span>
                                <a href="<?= esc_url($product->get_permalink()) ?>" class="d-table products-list_cat"><?= get_the_title() ?></a>
                            </div>
                            <div class="products-list_price position-relative">
                                <?php if (!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()): ?>
                                    <span class="products-list_price-old"><?= number_format((float)$product->get_regular_price(), 0, ',', ' ') ?>₽</span>
                                <?php endif; ?>
                                <?php if (!empty($product->get_price())): ?>
                                    <span class="products-list_price-new">&nbsp;<?= number_format((float)$product->get_price(), 0, ',', ' ') ?>₽</span>
                                <?php endif; ?>
                                <a href="<?= esc_url($product->get_permalink()) ?>" class="products-list_link"></a>
                            </div>
                        </div>

                        <?php if ($i == 4): ?>
                            <div class="col-md-4 col-6 products-list-item products-list-item_custom">
                                <div class="position-relative">
                                    <span class="d-block font-cursive products-list-item1 text-center">хочешь испытать удачу?</span>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/korset-1.png" class="products-list-item2" alt="" />
                                    <span class="d-block products-list-item3 text-center">крути колесо и выиграй<br>вечернее платье!</span>
                                    <a href="" class="theme-button button-main d-block">Играть сейчас!</a>
                                    <span class="d-none d-md-block products-list-item4 text-center">больше интересного</span>
                                    <span class="d-none d-md-block font-cursive products-list-item5 text-center">в нашем телеграм!</span>
                                </div>
                            </div>
                        <?php endif; ?>
                                            
                    <?php endwhile; ?>        

                </div>
            </div>

            <?php if ($wp_query->max_num_pages > 1) : ?>
                <div class="container products-list_more">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="theme-button button-main d-block load-more-products"
                            data-page="2"
                            data-max-pages="<?php echo $wp_query->max_num_pages; ?>">Показать больше</a>
                        </div>
                    </div>
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const $ = jQuery;

                    // === Скрыть кнопку при загрузке, если нет следующей страницы ===
                    const checkAndHideLoadMore = () => {
                        const nextLink = document.getElementById('load-more-link');
                        const loadMoreBlock = document.querySelector('.products-list_more');
                        if (loadMoreBlock && (!nextLink || !nextLink.href || nextLink.href.includes('#'))) {
                            loadMoreBlock.style.display = 'none';
                        }
                    };

                    checkAndHideLoadMore();

                    // === Подгрузка по клику ===
                    let isLoading = false;

                    $(document).on('click', '.load-more-products', function (e) {
                        e.preventDefault();
                        if (isLoading) return;

                        const nextLink = document.getElementById('load-more-link');
                        const nextPageUrl = nextLink ? nextLink.href : null;

                        if (!nextPageUrl || nextPageUrl.includes('#')) {
                            $('.products-list_more').fadeOut();
                            return;
                        }

                        isLoading = true;
                        $('.load-more-products').text('Загрузка...');

                        $.get(nextPageUrl, function (data) {
                            const $newHtml = $(data);

                            // Добавляем товары
                            const $newItems = $newHtml.find('#products-row .products-list-item');
                            if ($newItems.length) {
                                $('#products-row').append($newItems);

                                document.querySelectorAll('img[data-src]').forEach(img => {
                                    // Копируем значение из data-src в src
                                    img.src = img.dataset.src;
                                    
                                    // Опционально: удаляем атрибут, чтобы избежать повторной обработки
                                    img.removeAttribute('data-src');
                                });

                                // Инициализация каруселей
                                $newItems.find('.products-list-carusel').each(function () {
                                    if (!$(this).hasClass('owl-loaded')) {
                                        $(this).addClass('owl-loaded').owlCarousel({
                                            loop: false,
                                            nav: false,
                                            dots: false,
                                            margin: 0,
                                            smartSpeed: 450,
                                            mouseDrag: true,
                                            touchDrag: true,
                                            items: 1
                                        });
                                    }
                                });

                                // Навигация
                                $newItems.find('.products-nav-prev').off('click').on('click', function () {
                                    $(this).closest('.product-carousel-wrapper')
                                        .find('.products-list-carusel')
                                        .trigger('prev.owl.carousel');
                                });
                                $newItems.find('.products-nav-next').off('click').on('click', function () {
                                    $(this).closest('.product-carousel-wrapper')
                                        .find('.products-list-carusel')
                                        .trigger('next.owl.carousel');
                                });
                            }

                            // Обновляем пагинацию
                            const $newPagination = $newHtml.find('.box-pagination');
                            if ($newPagination.length) {
                                $('.box-pagination').replaceWith($newPagination);
                            } else {
                                $('.products-list_more').fadeOut();
                            }

                            // Проверяем наличие следующей страницы
                            checkAndHideLoadMore();

                            $('.load-more-products').text('Показать больше');
                            isLoading = false;
                        }).fail(function () {
                            $('.load-more-products').text('Ошибка загрузки');
                            $('.products-list_more').fadeOut();
                            isLoading = false;
                        });
                    });
                });
                </script>
            <?php endif; ?>


            <?php
            global $wp_query;

            $total = $wp_query->max_num_pages;
            $current = max(1, get_query_var('paged'));

            if ($total > 1) :
            ?>
                <div class="container box-pagination">
                    <div class="row">
                        <div class="col-12">
                            <ul class="owl-list d-flex justify-content-center">

                                <?php
                                // === 1. Первая страница (всегда) ===
                                if ($current == 1) {
                                    echo '<li class="selected"><span>1</span></li>';
                                } else {
                                    echo '<li><a href="' . esc_url(get_pagenum_link(1)) . '">1</a></li>';
                                }

                                // === 2. Многоточие слева ===
                                if ($current - 2 > 2) { // т.е. если текущая >= 5
                                    echo '<li><span>...</span></li>';
                                }

                                // === 3. Страницы рядом с текущей (кроме 1 и последней) ===
                                $start = max(2, $current - 2);
                                $end = min($total - 1, $current + 2);

                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $current) {
                                        echo '<li class="selected"><span>' . $i . '</span></li>';
                                    } else {
                                        echo '<li><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
                                    }
                                }

                                // === 4. Многоточие справа ===
                                if ($current + 2 < $total - 1) {
                                    echo '<li><span>...</span></li>';
                                }

                                // === 5. Последняя страница (если больше 1) ===
                                if ($total > 1) {
                                    if ($current == $total) {
                                        echo '<li class="selected"><span>' . $total . '</span></li>';
                                    } else {
                                        echo '<li><a href="' . esc_url(get_pagenum_link($total)) . '">' . $total . '</a></li>';
                                    }
                                }

                                // === 6. Стрелка "вперёд" ===
                                if ($current < $total) {
                                    echo '<li><a href="' . esc_url(get_pagenum_link($current + 1)) . '" id="load-more-link"><img src="' . get_stylesheet_directory_uri() . '/images/icon-5.svg" alt="Следующая"></a></li>';
                                } else {
                                    echo '<li class="disabled"><span><img src="' . get_stylesheet_directory_uri() . '/images/icon-5.svg" alt="Следующая"></span></li>';
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </section>
        <?else:?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><b>Нет соответствующих товаров!</b></p><br><br>
                    </div>
                </div>
        </div>
        <?endif?>

        <?if(!empty(wp_kses_post(category_description()))):?>
            <section class="cat-desc">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="cat-desc_text text-ellipsis-multiline">
                                <?=wp_kses_post(category_description()); ?>
                            </div>
                            <a href="javascript:void()" class="cat-desc_more">Читать дальше</a>
                        </div>
                    </div>
                </div>
            </section>
        <?endif?>
 
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

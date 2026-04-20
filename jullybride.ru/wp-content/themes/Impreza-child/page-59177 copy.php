<?get_header('page-59177'); ?>

    <main class="main-page content">

        <a href="javascript:void(0)" class="app-overlay-close"></a>
        <div class="app-overlay-overlay"></div>

        <?php if (have_rows('carusel-added-owl')): ?>

            <?php while (have_rows('carusel-added-owl')): the_row(); ?>

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
                                        <video data-src="<?= esc_url($video) ?>" poster="<?php echo get_stylesheet_directory_uri(); ?>/images/galereya1.png" autoplay muted playsinline class="lazy-video">
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

            <section class="padding-bottom-80">
                <div class="main-slide">
                    <div class="slide-duration">
                        <div class="slide-duration_indicator"></div>
                    </div>

                    <? if (have_rows('banners')): ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="main-slide_list owl-carousel owl-theme" id="main-slide-carusel">

                                        <?php 
                                        $index = 0; // Счётчик итераций
                                        while (have_rows('banners')): the_row(); 
                                            $image = get_sub_field('image');
                                            $title = get_sub_field('title');
                                            $subtitle = get_sub_field('subtitle');
                                            $text_left = get_sub_field('text_left');
                                            $text_right = get_sub_field('text_right');
                                            $link = get_sub_field('link');
                                            $button_text = get_sub_field('button_text');
                                        ?>
                                            <li class="row align-items-center">
                                                <div class="main-slide_top col-12">
                                                    <span class="font-title d-block main-slide_title text-center"><?=$title?></span>
                                                    <span class="font-cursive d-block main-slide_cursive text-center"><?=$subtitle?></span>
                                                </div>
                                                <div class="col d-none d-md-block">
                                                    <span class="font-arsenica-regular main-slide_left d-block"><?=$text_left?></span>
                                                    <a href="<?=$link?>" class="theme-button button-main d-table"><?=$button_text?></a>
                                                </div>
                                                <div class="col main-slide_img">
                                                    <div class="main-slide_img-wrap">
                                                        <span class="main-slide_img-text d-block d-md-none"><?=$text_left?></span>
                                                        <a href="<?=$link?>" class="main-slide_img-btn d-block d-md-none">Вау! Можно к вам?</a>
                                                        
                                                        <?php if ($index === 0): ?>
                                                            <img data-src="<?=$image?>" alt="<?=$title?>" data-critical="true" rel="preload" />
                                                        <?php else: ?>
                                                            <img data-src="<?=$image?>" alt="<?=$title?>" />
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col d-none d-md-block">
                                                    <a href="/blog/" class="secret-link d-block"></a>
                                                    <span class="main-slide_right d-block text-end"><?=$text_right?></span>
                                                </div>
                                            </li>
                                        <?php 
                                            $index++; // Увеличиваем счётчик
                                        endwhile; 
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    <? endif;?>

                    <div class="lenta-stroke">
                        <svg width="100%" height="180" viewBox="0 0 1920 180" preserveAspectRatio="none">
                    
                            <rect x="0" y="60" width="1920" height="120" fill="#f9e5e9" />

                            <path d="M0,40 C250,-20 500,100 750,40 C1000,-20 1250,100 1500,40 C1700,-20 1850,100 1920,40 L1920,80 C1850,140 1700,20 1500,80 C1250,140 1000,20 750,80 C500,140 250,20 0,80 Z" fill="rgba(24, 24, 24, 1)" />

                            <path id="text-path" d="M0,60 C250,0 500,120 750,60 C1000,0 1250,120 1500,60 C1700,0 1850,120 1920,60" stroke="none" fill="none" />

                            <text font-size="14" fill="#fde5ec" text-anchor="middle" letter-spacing="1" id="svg_text" dy="5">
                                <textPath href="#text-path" startOffset="50%"><?=get_field('text_stroke')?><animate 
                                    attributeName="startOffset" 
                                    from="100%" 
                                    to="-100%" 
                                    dur="120s" /></textPath>
                            </text>
                        </svg>
                    </div>

                </div>

                <?php if (have_rows('carusel-added-owl')): ?>
                <div class="carusel-added container">
                    <div class="row">
                        <div class="col-1 d-md-flex d-none align-items-center">
                            <a href="javascript:void(0)" class="arrow-prev carusel-nav" id="carusel-added-prev"></a>
                        </div>
                        <div class="col-12 col-md-10">
                            <ul class="carusel-added-owl owl-carousel owl-theme" id="carusel-added-owl">
                                <?php while (have_rows('carusel-added-owl')): the_row(); 
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
                <?php endif; ?>

            </section>

            <section class="tabs-box">
                <a href="#" class="tabs-box-svg1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/kak-vybratь-to-samoe.svg" alt="Как выбрать то самое?" />
                </a>
                <img class="tabs-box-svg2 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/nashey-atmosfere-zaviduyut.svg" alt="" />

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <span class="section-subtitle d-block text-center">Выбери свое идеальное</span>
                            <h2 class="section-title text-center font-title">свадебное платье</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <ul class="tabs-list d-md-flex d-none align-items-center">
                        <li class="active">Силуэт</li>
                        <li>Длина</li>
                        <li>Стиль</li>
                        <li>Особенности</li>
                        <li>Вечерние</li>
                    </ul>
                </div>
                <div class="slides-tabs">

                    <!-- таб 1 -->
                    <span class="d-md-none d-block mobile-tab-wrap active">
                        <span class="mobile-tab">Силуэт</span>
                    </span>
                    <div class="container taab">
                        <div class="row mobile-direction">
                            <div class="col-md-10">
                                <div class="tabs-content">
                                    <div class="tabs-carusel">

                                        <div class="tab-content active">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev1"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next1"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_1">
                                                <? //Свадебные - Рыбка
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'mermaid',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                     'order'         => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_1"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_1"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev2"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next2"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_2">
                                                <? //Свадебные - А-силуэт
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'a-line',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_2"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_2"></a>
                                            </div>        
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev3"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next3"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_3">
                                                <? //Свадебные - Пышные
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'lush',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_3"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_3"></a>
                                            </div>        
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev4"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next4"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_4">
                                                <? //Свадебные - Прямые
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'straight',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_4"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_4"></a>
                                            </div>        
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev5"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next5"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_5">
                                                <? //Свадебные - Трансформер
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'transformers',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_5"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_5"></a>
                                            </div>        
                                        </div>
                                    
                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev6"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next6"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_6">
                                                <? //Свадебные - Трансформер
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'transformers',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_6"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_6"></a>
                                            </div>        
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev7"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next7"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_7">
                                                <? //Свадебные - Трансформер
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'empire',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?= wp_get_attachment_image($product->get_image_id(), [300, 450]) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_7"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_7"></a>
                                            </div>        
                                        </div>

                                        <?/*<div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev8"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next8"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_8">
                                                <? //Свадебные - Кроп-топ
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'crop-top',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_8"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_8"></a>
                                            </div>        
                                        </div>*/?>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev9"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next9"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_9">
                                                <? //Свадебные - Футляр
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'sheath',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_9"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_9"></a>
                                            </div>        
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative">
                                <ul class="categories-list">
                                    <li class="active tab-trigger"><a href="javascript:void(0)">Рыбка</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">А-силуэт</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Пышные</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Прямые</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Трансформер</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Костюм</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Ампир</a></li>
                                    <?/*<li class="tab-trigger"><a href="javascript:void(0)">Кроп-топ</a></li>*/?>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Футляр</a></li>
                                    <li class="d-md-none d-block"><a href="/c/wedding/?_f=1&_silhouette=a-line%2Cempire%2Csuit%2Cprincess%2Cstraight%2Clush%2Cmermaid%2Ctransformer%2Csheath">Смотреть все</a></li>
                                </ul>
                                <a href="/c/wedding/?_f=1&_silhouette=a-line%2Cempire%2Csuit%2Cprincess%2Cstraight%2Clush%2Cmermaid%2Ctransformer%2Csheath" class="button-main-main-bg theme-button d-md-block d-none text-center custom-btn">Перейти в каталог</a> 
                            </div>
                        </div>
                    </div>
                    
                    <!-- таб 2 -->
                    <span class="d-md-none d-block mobile-tab-wrap">
                        <span class="mobile-tab">Длина</span>
                    </span>
                    <div class="container taab">
                        <div class="row mobile-direction">
                            <div class="col-md-10">
                                <div class="tabs-content">
                                    <div class="tabs-carusel">

                                        <div class="tab-content active">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev10"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next10"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_10">
                                                <? //Свадебные - Длинные
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'long',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_10"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_10"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev11"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next11"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_11">
                                                <? //Свадебные - Миди
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'midi',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_11"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_11"></a>
                                            </div>        
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev12"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next12"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_12">
                                                <? //Свадебные - Мини
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'mini',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_12"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_12"></a>
                                            </div>        
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative">
                                <ul class="categories-list">
                                    <li class="active tab-trigger"><a href="javascript:void(0)">Длинные</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Миди</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Мини</a></li>
                                    <li class="d-md-none d-block"><a href="/c/wedding/?_length=dlinnoe%2Cmidi%2Cmini&_f=1">Смотреть все</a></li>
                                </ul>
                                <a href="/c/wedding/?_length=dlinnoe%2Cmidi%2Cmini&_f=1" class="button-main-main-bg theme-button d-md-block d-none text-center custom-btn">Перейти в каталог</a> 
                            </div>
                        </div>
                    </div>


                    <!-- таб 3 -->
                    <span class="d-md-none d-block mobile-tab-wrap">
                        <span class="mobile-tab">Стиль</span>
                    </span>
                    <div class="container taab">
                        <div class="row mobile-direction">
                            <div class="col-md-10">
                                <div class="tabs-content">
                                    <div class="tabs-carusel">

                                        <div class="tab-content active">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev13"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next13"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_13">
                                                <? //Свадебные - Бохо
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'boho',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_13"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_13"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev17"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next17"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_17">
                                                <? //Свадебные - Минимальзм
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'minimalism',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_17"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_17"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev14"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next14"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_14">
                                                <? //Свадебные - Простые
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'simple',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_14"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_14"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev15"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next15"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_15">
                                                <? //Свадебные - Кружевные
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'lace',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_15"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_15"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev16"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next16"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_16">
                                                <? //Свадебные - Блестящие
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'sparkle',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_16"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_16"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev18"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next18"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_18">
                                                <? //Свадебные - Винтажные
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'vintage',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_18"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_18"></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative">
                                <ul class="categories-list">
                                    <li class="active tab-trigger"><a href="javascript:void(0)">Бохо</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Минимализм</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Простые</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Кружевные</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Блестящие</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Винтажные</a></li>
                                    <li class="d-md-none d-block"><a href="/c/wedding/?_style=boho%2Cvintage%2Clace%2Csparkle%2Cminimalism%2Csimple&_f=1">Смотреть все</a></li>
                                </ul>
                                <a href="/c/wedding/?_style=boho%2Cvintage%2Clace%2Csparkle%2Cminimalism%2Csimple&_f=1" class="button-main-main-bg theme-button d-md-block d-none text-center custom-btn">Перейти в каталог</a> 
                            </div>
                        </div>
                    </div>

                    <!-- таб 4 -->
                    <span class="d-md-none d-block mobile-tab-wrap">
                        <span class="mobile-tab">Особенности</span>
                    </span>
                    <div class="container taab">
                        <div class="row mobile-direction">
                            <div class="col-md-10">
                                <div class="tabs-content">
                                    <div class="tabs-carusel">

                                        <div class="tab-content active">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev19"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next19"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_19">
                                                <? //Свадебные - С открытой спиной
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'open-back',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                           <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_19"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_19"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev20"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next20"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_20">
                                                <? //Свадебные - С закрытой спиной
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'back-closed',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_20"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_20"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev21"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next21"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_21">
                                                <? //Свадебные - С декольте
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'neckline',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_21"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_21"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev22"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next22"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_22">
                                                <? //Свадебные - С V-вырезом
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'v-cut',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_22"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_22"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev23"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next23"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_23">
                                                <? //Свадебные - С разрезом
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'slit',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_23"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_23"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev24"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next24"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_24">
                                                <? //Свадебные - С корсетом
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'corset',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_24"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_24"></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2 position-relative">
                                <ul class="categories-list">
                                    <li class="active tab-trigger"><a href="javascript:void(0)">С открытой спиной</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">С закрытой спиной</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">С декольте</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">С V-вырезом</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">С разрезом</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">С корсетом</a></li>
                                    <li class="d-md-none d-block"><a href="/c/wedding/open-back/?_backdress=closed%2Copen&_f=1&_decollete=s-v-vyrezom%2Clow-necked&_corset=corset&_slit=slit">Смотреть все</a></li>
                                </ul>
                                <a href="/c/wedding/open-back/?_backdress=closed%2Copen&_f=1&_decollete=s-v-vyrezom%2Clow-necked&_corset=corset&_slit=slit" class="button-main-main-bg theme-button d-md-block d-none text-center custom-btn">Перейти в каталог</a> 
                            </div>
                        </div>
                    </div>

                    <!-- таб 5 -->
                    <span class="d-md-none d-block mobile-tab-wrap">
                        <span class="mobile-tab">Вечерние</span>
                    </span>
                    <div class="container taab">
                        <div class="row mobile-direction">
                            <div class="col-md-10">
                                <div class="tabs-content">
                                    <div class="tabs-carusel">
                                            
                                        <div class="tab-content active">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev25"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next25"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_25">
                                                <? //Вечерние - Ампир
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'empire_',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_25"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_25"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev26"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next26"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_26">
                                                <? //Вечерние - Комбинезон/костюм
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'suit_',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_26"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_26"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev27"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next27"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_27">
                                                <? //Вечерние - Рыбка
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'mermaid_',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_27"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_27"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev28"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next28"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_28">
                                                <? //Вечерние - Пышные
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'lush_',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_28"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_28"></a>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                                <a href="javascript:void(0)" id="mobile-dots-prev29"></a>
                                                <a href="javascript:void(0)" id="mobile-dots-next29"></a>
                                            </div>
                                            <ul class="owl-carousel owl-theme tabs-carusel_list" id="tabs-carusel_29">
                                                <? //Вечерние - Прямые
                                                $args = array(
                                                    'post_type'      => 'product',
                                                    'posts_per_page' => 10,          // ← ровно 15 товаров
                                                    'product_cat'    => 'straight_',
                                                    'orderby'        => 'date',      // ← сортировка по дате
                                                    'order'          => 'DESC',      // ← новые первыми
                                                    'post_status'    => 'publish',   // ← только опубликованные (без черновиков)
                                                );
                                                $products = new WP_Query($args);
                                                if ($products->have_posts()):
                                                    while ($products->have_posts()):
                                                    $products->the_post();
                                                    global $product;
                                                ?>
                                                <li>
                                                    <div class="tabs-carusel_image-wrap">
                                                        <div class="tabs-carusel_image">
                                                            <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                                <div class="nameplate-sale"></div>
                                                            <?endif?>
                                                            <?=wp_get_attachment_image(
                                                                $product->get_image_id(), 
                                                                [300, 450], 
                                                                false, 
                                                                ['loading' => 'lazy'] 
                                                            ) ?>
                                                            <div class="tabs-carusel_image-btn justify-content-around">
                                                                <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                                <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                            </div>
                                                            <?if($product->is_in_stock()):?>
                                                                <span class="in-sklad">в наличии</span>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="tabs-carusel_data">
                                                        <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-block"><?=get_the_title()?></a>
                                                    </div>
                                                    <div class="tabs-carusel_price text-center">
                                                        <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                            <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <?if(!empty($product->get_price())):?>
                                                            <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                        <?endif?>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                    </div>
                                                </li>
                                            <?
                                                endwhile;
                                                wp_reset_postdata();
                                                endif;
                                                ?>
                                            </ul>
                                            <div class="tabs-carusel_dot d-none d-md-table">
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="tabs-carusel_prev_29"></a>
                                                <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="tabs-carusel_next_29"></a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <ul class="categories-list">
                                    <li class="active tab-trigger"><a href="javascript:void(0)">Ампир</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Комбинезон/костюм</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Рыбка</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Пышные</a></li>
                                    <li class="tab-trigger"><a href="javascript:void(0)">Прямые</a></li>
                                    <li class="d-md-none d-block"><a href="/c/evening/?_silhouette=a-line%2Cempire%2Csuit%2Cstraight%2Clush%2Cmermaid&_f=1">Смотреть все</a></li>
                                </ul>
                                <a href="/c/evening/?_silhouette=a-line%2Cempire%2Csuit%2Cstraight%2Clush%2Cmermaid&_f=1" class="button-main-main-bg theme-button d-md-block d-none text-center custom-btn">Перейти в каталог</a> 
                            </div>
                        </div>
                    </div>

                </div>
                <a href="#" class="tabs-box-svg3 d-none d-md-block">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/branchi-1.svg" alt="" />
                </a>
            </section>

            <section class="video-box">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <span class="section-subtitle d-block text-center">Салон, в который хочется возвращаться</span>
                            <h2 class="section-title text-center font-title">даже после свадьбы</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a class="vk-video-link" 
                                href="<?=get_field('video')?>" 
                                data-fancybox 
                                data-type="iframe"
                                data-width="1024"
                                data-height="768"
                                >
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/video.png" alt="Салон, в который хочется возвращаться" loading="lazy" />
                            </a>
                        </div>
                        <div class="col-12 text-center d-none d-md-block">
                            <span>Ты видишь это видео, потому что фото нашего<br>салона есть на твоей доске в пинтерест</span>
                        </div>
                    </div>
                </div>
                <div class="lenta-stroke2">
                    <svg width="100%" height="180" viewBox="0 0 1920 180" preserveAspectRatio="none">
                        <path
                            d="M0,40 C250,-20 500,100 750,40 C1000,-20 1250,100 1500,40 C1700,-20 1850,100 1920,40 L1920,80 C1850,140 1700,20 1500,80 C1250,140 1000,20 750,80 C500,140 250,20 0,80 Z"
                            fill="rgba(24, 24, 24, 1)" />
                    
                        <path id="text-path" d="M0,60 C250,0 500,120 750,60 C1000,0 1250,120 1500,60 C1700,0 1850,120 1920,60" stroke="none"
                            fill="none" />
                    
                        <text font-size="14" fill="#fde5ec" text-anchor="middle" letter-spacing="1" id="svg_text_2" dy="5">
                            <textPath href="#text-path" startOffset="50%"><?=get_field('text_stroke')?><animate attributeName="startOffset" from="100%" to="-100%" dur="120s" repeatCount="indefinite" />
                            </textPath>
                        </text>
                    </svg>
                </div>   
                <img class="d-md-none d-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/nashey-atmosfere-zaviduyut.svg" alt="" />      
            </section>

            <section class="calendar-box">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end position-relative">
                            <div class="calendar-box_content justify-content-center d-flex flex-column align-items-center">
                                <img class="d-block d-md-none" src="<?php echo get_stylesheet_directory_uri(); ?>/images/molniya-s-platьem-1.svg" alt="" />
                                <span class="calendar-box_content-title text-center d-none d-md-block">Чтобы твой календарь<br> выглядел также, не забудь,<br> что примерка по записи!</span>
                                <span class="calendar-box_content-title text-center d-block d-md-none">Ищешь свое идеальное платье?<br> Не забудь, что примерка по записи!</span>
                                <a href="javascript:void(0)" class="button-main-main-bg theme-button ms_booking">Записаться на примерку</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <? if (have_rows('new')): ?>
            <section class="new-in-salon new-in-salon2 new-in-salon3 position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <span class="section-subtitle d-block text-center">самые ожидаемые и трендовые</span>
                            <h2 class="section-title text-center font-title">новинки в салоне</h2>
                        </div>
                    </div>
                    <div class="row margin-bottom-80">
                        <div class="col-12">
                            <div class="new-in-salon-carusel">
                                <ul class="owl-carousel owl-theme owl-list" id="new-in-salon-carusel">
                                    <? while (have_rows('new')): the_row(); 
                                        $id = get_sub_field('id');
                                        $product = wc_get_product($id);
                                    ?>
                                        <li>
                                            <div class="tabs-carusel_image-wrap">
                                                <div class="tabs-carusel_image">
                                                    <?if (get_sub_field('shildik')):?>
                                                        <div class="nameplate-sale nameplate-sale2"></div>
                                                    <?endif?>
                                                    <?= wp_get_attachment_image(
                                                        $product->get_image_id(), 
                                                        [400, 600], 
                                                        false
                                                    ) ?>
                                                    <div class="tabs-carusel_image-btn justify-content-around">
                                                        <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                    </div>
                                                    <?if($product->is_in_stock()):?>
                                                        <span class="in-sklad">в наличии</span>
                                                    <?endif?>
                                                </div>
                                            </div>
                                            <div class="tabs-carusel_data">
                                                <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-table" style="color:#181818"><?=$product->get_name()?></a>
                                            </div>
                                            <div class="tabs-carusel_price text-center">
                                                <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                    <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                <?endif?>
                                                <?if(!empty($product->get_price())):?>
                                                    <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                <?endif?>
                                                <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                            </div>
                                        </li>
                                    <?endwhile?>
                                </ul>
                                <div class="tabs-carusel_dot new-in-salon-carusel_dot d-none d-md-table">
                                    <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="new-in-salon-carusel_prev_1"></a>
                                    <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="new-in-salon-carusel_next_1"></a>
                                </div>
                            </div>  
                        </div>
                        <div class="mobile-dots d-flex d-md-none justify-content-between">
                            <a href="javascript:void(0)" id="new-in-salon-carusel-prev1"></a>
                            <a href="javascript:void(0)" id="new-in-salon-carusel-next1"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center position-relative">
                            <a href="/c/wedding/" class="theme-button button-main custom_main_btn">перейти в каталог</a>
                        </div>
                    </div>
                </div>
                <a href="" class="new-in-salon-svg1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/branchi-i-platьya.svg" alt="" />
                </a>
            </section>
            <?endif?>

            <!-- Блок не виден в мобиле -->
            <? if (have_rows('zashla_prosto_na_kofe')): ?>
                <section class="wanted-stay d-none d-md-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 position-relative">
                                <span class="section-subtitle d-block text-center">зашла “просто на кофе” — </span>
                                <h2 class="section-title text-center font-title">захотела остаться</h2>
                                <span class="sub-text">желательно навсегда</span>
                            </div>
                        </div>
                    </div>

                    <?php
                        $all_items = [];

                        // 1. Добавляем динамические элементы из Repeater'а
                        if (have_rows('zashla_prosto_na_kofe')) {
                            while (have_rows('zashla_prosto_na_kofe')) {
                                the_row();
                                $all_items[] = [
                                    'type' => 'dynamic',
                                    'img' => get_sub_field('img'),
                                    'sort' => (int) get_sub_field('sort') // приводим к числу!
                                ];
                            }
                        }

                        // 2. Добавляем статичные элементы с их "виртуальными" sort-значениями
                        $all_items[] = [
                            'type' => 'static_1',
                            'sort' => 2 // ← задайте нужное значение сортировки
                        ];

                        $all_items[] = [
                            'type' => 'static_4',
                            'sort' => 7 // ← задайте нужное значение
                        ];

                        $all_items[] = [
                            'type' => 'static_carousel',
                            'sort' => 5 // ← задайте нужное значение
                        ];
                        usort($all_items, function($a, $b) {
                            return $a['sort'] - $b['sort'];
                        });
                    ?>

                        <div class="wanted-stay-grid wanted-stay-grid1">

                            <?foreach ($all_items as $item): ?>
                                <? if ($item['type'] === 'dynamic'): ?>
                                    <div class="item" rel="<?=$item['sort']?>">
                                        <img src="<?= esc_url($item['img']); ?>" alt="" loading="lazy">
                                    </div>

                                <? elseif ($item['type'] === 'static_1'): ?>
                                    <div class="item" rel="<?=$item['sort']?>">
                                        <a href="/c/pink-merch/">
                                            <img src="<?= get_stylesheet_directory_uri(); ?>/images/rozovyy-merch.svg" alt="" loading="lazy">
                                        </a>
                                    </div>

                                <? elseif ($item['type'] === 'static_carousel'): ?>
                                    <? if (have_rows('carusel_v_galeree_izobrazhenij')): ?>
                                        <div class="item" rel="<?=$item['sort']?>">
                                            <div class="owl-wrapper">
                                                <ul class="owl-list owl-carousel owl-theme wanted-stay-owl" id="wanted-stay-owl">
                                                    <? while (have_rows('carusel_v_galeree_izobrazhenij')): the_row(); ?>
                                                        <li><img src="<?=get_sub_field('img')?>" alt=""></li>
                                                    <?endwhile?>
                                                </ul>
                                            </div> 
                                        </div>
                                    <? endif; ?>
                                <? elseif ($item['type'] === 'static_4'): ?>
                                    <div class="item" rel="<?=$item['sort']?>">
                                        <img src="<?= get_stylesheet_directory_uri(); ?>/images/luchshaya-primerka.svg" alt="" loading="lazy">
                                    </div>
                                <? endif; ?>
                            <? endforeach; ?>

                        </div>
                </section>
            <?endif?>

            <!-- Этот блок виден только в мобиле -->
            <section class="wanted-stay-mobile d-block d-md-none">
                <div class="container">
                    <div class="row">
                        <div class="col-12 position-relative">
                            <span class="section-subtitle d-block text-center">зашла “просто на кофе” — </span>
                            <h2 class="section-title text-center font-title">захотела остаться</h2>
                            <span class="sub-text">желательно навсегда</span>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12 position-relative wanted-stay-mobile-bg">
                            <ul class="owl-list wanted-stay-mobile-carusel owl-carousel owl-theme autoheight" id="wanted-stay-mobile-carusel"></ul>
                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                <a href="javascript:void(0)" id="wanted-stay-mobile-carusel-prev"></a>
                                <a href="javascript:void(0)" id="wanted-stay-mobile-carusel-next"></a>
                            </div>
                        </div>
                        <div class="col-12 d-block d-md-none">
                            <a href="" class="wanted-stay-mobile-svg1 d-table"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/rozovyy-merch.svg" alt="" loading="lazy"></a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sect-couture">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 sect-couture_left-colunn">
                            <img class="sect-couture-img order-md-0 order-1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/group-1230.svg" alt="" />
                            <div class="order-md-1 order-0">
                                <span class="sect-couture-subtitle d-block">свадебные платья</span>
                                <span class="sect-couture-title d-block font-title">от кутюр</span>
                            </div>
                            <div class="sect-couture-desc order-2">

                                <div class="sect-couture-text">
                                    <?=get_field('text_couture')?>
                                </div>
                                
                                <?php if (have_rows('couture_brand_gallery')): ?>
                                    <div class="row sect-couture-carusel">
                                        <div class="col-1 d-none align-items-center d-md-flex flex-column justify-content-center">
                                            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="sect-couture-owl-prev"></a>
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <ul class="owl-list sect-couture-owl owl-carousel owl-theme" id="sect-couture-owl">
                                                <?php if (have_rows('couture_brand_gallery')): ?>
                                                    <?php while (have_rows('couture_brand_gallery')): the_row(); 
                                                        $link_brand = get_sub_field('link_brand');
                                                        $img_brand = get_sub_field('img_brand');
                                                    ?>
                                                    <li>
                                                        <a href="<?=$link_brand?>">
                                                            <img data-src="<?=$img_brand?>" class="owl-lazy" alt="" />
                                                        </a>
                                                    </li>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <div class="col-1 d-none align-items-center d-md-flex flex-column justify-content-center">
                                            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="sect-couture-owl-next"></a>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center d-md-none tabs-carusel_nav-mobile">
                                            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn"></a>
                                            <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn"></a>
                                        </div>
                                    </div>
                               <?php endif; ?> 

                            </div>
                            <img class="sect-couture-img2 order-3 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/group-1231.svg" alt="" />
                        </div>

                        <?php if (have_rows('gallery_photo_couture')): ?>
                            <div class="col-12 col-md-6 sect-couture_right-colunn">
                                <a href="javascript:void(0)" class="sect-couture-nav sect-couture-owl2-prev" id="sect-couture-owl2-prev"></a>
                                <a href="javascript:void(0)" class="sect-couture-nav sect-couture-owl2-next" id="sect-couture-owl2-next"></a>
                                <ul class="owl-list sect-couture-owl2 owl-theme owl-carousel" id="sect-couture_right-colunn">
                                    <?php if (have_rows('gallery_photo_couture')): ?>
                                        <?php while (have_rows('gallery_photo_couture')): the_row(); 
                                            $img = get_sub_field('img');
                                            
                                            // Определяем ID изображения (универсально для всех форматов ACF)
                                            $attachment_id = 0;
                                            
                                            if (is_array($img) && !empty($img['ID'])) {
                                                // Формат "Image Array" (рекомендуется в ACF)
                                                $attachment_id = $img['ID'];
                                            } elseif (is_numeric($img)) {
                                                // Формат "Image ID"
                                                $attachment_id = (int) $img;
                                            } elseif (is_string($img)) {
                                                // Формат "Image URL" — конвертируем в ID
                                                $attachment_id = attachment_url_to_postid($img);
                                            }
                                            
                                            // Получаем миниатюру размера gallery-couture
                                            if ($attachment_id) {
                                                $image = wp_get_attachment_image_src($attachment_id, 'gallery-couture');
                                                $img_url = $image[0] ?? $img; // fallback на оригинал, если миниатюра не сгенерирована
                                                $alt = !empty($img['alt']) ? $img['alt'] : get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                                            } else {
                                                // Fallback: используем оригинальный URL (если не удалось получить ID)
                                                $img_url = is_array($img) ? ($img['url'] ?? '') : $img;
                                                $alt = is_array($img) ? ($img['alt'] ?? '') : '';
                                            }
                                        ?>
                                            <li>
                                                <img 
                                                    data-src="<?= esc_url($img_url) ?>" 
                                                    class="owl-lazy" 
                                                    alt="<?= esc_attr($alt) ?>"
                                                />
                                            </li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?> 

                    </div>
                </div>
            </section>

            <? if (have_rows('only_have')): ?>
                <section class="only-have position-relative couture-only-have">
                    <div class="container">
                            <div class="row margin-bottom-80">
                                <div class="col-12">
                                    <img class="d-md-none d-block couture-only-have-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/group-1233.svg" alt="" />
                                    <div class="new-in-salon-carusel">
                                        <ul class="owl-carousel owl-theme owl-list" id="only-have-carusel">
                                            <? while (have_rows('only_have')): the_row(); 
                                                $id = get_sub_field('id');
                                                $product = wc_get_product($id);
                                            ?>
                                            <li>
                                                <div class="tabs-carusel_image-wrap">
                                                    <div class="tabs-carusel_image">
                                                        <?if (get_sub_field('shildik')):?>
                                                            <div class="nameplate-sale nameplate-sale2 nameplate-sale3"></div>
                                                        <?endif?>
                                                        <?=wp_get_attachment_image(
                                                            $product->get_image_id(), 
                                                            [400, 600], 
                                                            false
                                                        ) ?>
                                                        <div class="tabs-carusel_image-btn justify-content-around">
                                                            <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                            <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                        </div>
                                                        <?if($product->is_in_stock()):?>
                                                            <span class="in-sklad">в наличии</span>
                                                        <?endif?>
                                                    </div>
                                                </div>
                                                <div class="tabs-carusel_data">
                                                    <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-table" style="color:#f5cdcb"><?=$product->get_name()?></a>
                                                </div>
                                                <div class="tabs-carusel_price text-center">
                                                    <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                        <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                    <?endif?>
                                                    <?if(!empty($product->get_price())):?>
                                                        <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                    <?endif?>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                </div>
                                            </li>
                                    <?endwhile?>
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
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center position-relative">
                                    <a href="/c/wedding/" class="theme-button button-main custom_main_btn">перейти в каталог</a>
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
                        
                            <text font-size="14" fill="#fde5ec" text-anchor="middle" letter-spacing="1" id="svg_text_3" dy="5">
                                <textPath href="#text-path" startOffset="50%"><?=get_field('text_stroke')?><animate attributeName="startOffset" from="100%" to="-100%" dur="120s" repeatCount="indefinite" />
                                </textPath>
                            </text>
                        </svg>
                    </div>  
                </section>
            <?endif?>

            <section class="zapis-box position-relative">
                <span class="zapis-box-before">экспертный</span>
                <span class="zapis-box-after">сервис</span>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <span class="zapis-box-title d-block">Влюбилась в эксклюзивное<br>платье? Назначь ему свидание!</span>
                            <a href="javascript:void(0)" class="button-main-main-bg theme-button d-table ms_booking">Записаться на примерку</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="roulet-box position-relative">
                <a href="" class="roulet-box-svg1 d-none d-md-block">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/perelink-na-telegram.svg" alt="" />
                </a>
                <img class="roulet-box-svg2 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/nashey-atmosfere-zaviduyut-1.svg" alt="" />
                <div class="roulet-box-bant"></div>
                <div class="overflow-hidden">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span class="section-subtitle d-block text-center">20+ горячих призов:</span>
                                <h2 class="section-title text-center font-title">выиграй вечернее платье!</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 position-relative">
                                <div class="rotate-container-button">
                                    <div class="rotate-trigger" aria-hidden="true"></div>
                                    <div class="arrow"></div>
                                    <a href="https://app.leadteh.ru/w/cZXug" class="theme-button button-main playButton" target="_blank">играть сейчас!</a>
                                </div>
                                <div class="rotating-items-section" id="rotate-section">
                                    
                                    <div class="rotate-container">
                                        <div class="rotate-container_item rotate-container_item-1">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/parfyum.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-2">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/konvert.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-3">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/svecha.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-4">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/korset.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-5">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/klyuch.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-6">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/makaruns.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-7">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/morozhennoe.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-8">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/konvert.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-9">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/svecha.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-10">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/korset.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-11">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/klyuch.png" alt="">
                                        </div>
                                        <div class="rotate-container_item rotate-container_item-12">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/makaruns.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <? if (have_rows('bestsellers')): ?>
            <section class="new-in-salon position-relative new-in-salon-custom">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <span class="section-subtitle d-block text-center">выбор невест</span>
                            <h2 class="section-title text-center font-title">бестселлеры</h2>
                        </div>
                    </div>
                    <div class="row margin-bottom-80">
                        <div class="col-12">
                            <div class="new-in-salon-carusel">
                                <ul class="owl-carousel owl-theme owl-list" id="bestsellers">
                                    <? while (have_rows('bestsellers')): the_row(); 
                                        $id = get_sub_field('id');
                                        $product = wc_get_product($id);
                                    ?>
                                        <li>
                                            <div class="tabs-carusel_image-wrap">
                                                <div class="tabs-carusel_image">
                                                    <?if (get_sub_field('shildik')):?>
                                                        <div class="nameplate-sale nameplate-sale2 nameplate-sale3"></div>
                                                    <?endif?>
                                                    <?=wp_get_attachment_image(
                                                        $product->get_image_id(), 
                                                        [400, 600], 
                                                        false
                                                    ) ?>
                                                    <div class="tabs-carusel_image-btn justify-content-around">
                                                        <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                        <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                    </div>
                                                    <?if($product->is_in_stock()):?>
                                                        <span class="in-sklad">в наличии</span>
                                                    <?endif?>
                                                </div>
                                            </div>
                                            <div class="tabs-carusel_data">
                                                <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-table" style="color:#181818"><?=$product->get_name()?></a>
                                            </div>
                                            <div class="tabs-carusel_price text-center">
                                                <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                    <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                <?endif?>
                                                <?if(!empty($product->get_price())):?>
                                                    <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                <?endif?>
                                                <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                            </div>
                                        </li>
                                    <?endwhile?>
                                </ul>
                                <div class="tabs-carusel_dot new-in-salon-carusel_dot d-none d-md-table">
                                    <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="bestsellers_prev"></a>
                                    <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="bestsellers_next"></a>
                                </div>
                            </div>    
                        </div>
                        <div class="mobile-dots d-flex d-md-none justify-content-between">
                            <a href="javascript:void(0)" id="bestsellers_prev1"></a>
                            <a href="javascript:void(0)" id="bestsellers_next1"></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center position-relative">
                            <a href="/c/wedding/" class="theme-button button-main custom_main_btn">перейти в каталог</a>
                        </div>
                    </div>
                </div>
                <img class="new-in-salon1 d-block d-md-none" src="<?php echo get_stylesheet_directory_uri(); ?>/images/schastliva.svg" alt="">
            </section>
            <?endif?>

            <!-- Блок не виден в мобиле -->
            <? if (have_rows('grid_slide')): ?>
                <section class="grid-slide position-relative d-none d-md-block">
                    <span class="font-cursive">атмосфера</span>
                    <img class="item-info-svg2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/vlyubilasь-v-platьe.svg" alt="" loading="lazy">
                   
                    <?php
                    $items = [];
                    // Собираем все элементы в массив
                    while (have_rows('grid_slide')) {
                        the_row();
                        if(!empty(get_sub_field('product_id'))){
                            $items[] = [
                                'title' => get_sub_field('title'),
                                'sub_title' => get_sub_field('sub_title'),
                                'product_name' => get_sub_field('product_name'),
                                'product_id' => get_sub_field('product_id'),
                                'img' => get_sub_field('img'),
                            ];
                        }
                    }

                    // Группируем по 9 элементов на слайд
                    $slides = array_chunk($items, 9);
                    ?>

                    <ul class="owl-list grid-slide-list owl-carousel owl-theme" id="adv-slide_carusel">
                        <?php foreach ($slides as $slide_items): ?>
                            <li>
                                <!-- Первая строка: первые 5 элементов -->
                                <div class="grid-slide-row">
                                    <?php for ($i = 0; $i < 5 && isset($slide_items[$i]); $i++): ?>
                                        <? 
                                        $product = wc_get_product($slide_items[$i]['product_id']);
                                        ?>
                                        <div class="item" rel="<?=$i?>">
                                            <div class="wrap">
                                                <div class="item-info">
                                                    <a href="javascript:void(0)" class="add-fav woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                    <div class="item-info-first">
                                                        <span><?=$slide_items[$i]['title']?></span>
                                                        <span><?=$slide_items[$i]['sub_title']?></span>
                                                    </div>
                                                    <span class="item-info-two"><?=$slide_items[$i]['product_name']?></span>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="item-info-btn">хочу примерить</a>
                                                </div>
                                                <?php if (!empty($slide_items[$i]['img'])): ?>
                                                    <img src="<?php echo esc_url($slide_items[$i]['img']); ?>" alt="" loading="lazy">
                                                <?php endif; ?>
                                            </div>
                                        </div>         
                                    <?php endfor; ?>
                                </div>

                                <!-- Вторая строка: следующие 4 элемента -->
                                <div class="grid-slide-row">
                                    <?php for ($i = 5; $i < 9 && isset($slide_items[$i]); $i++): ?>
                                        <? 
                                        $product = wc_get_product($slide_items[$i]['product_id']);
                                        ?>
                                        <div class="item" rel="<?=$i?>">
                                            <?if($i == 6):?>
                                                <img class="item-info-svg1 owl-lazy" data-src="<?=get_stylesheet_directory_uri(); ?>/images/schastliva.svg" alt="" />
                                            <?endif?>
                                            <div class="wrap">
                                                <div class="item-info">
                                                    <a href="javascript:void(0)" class="add-fav woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                    <div class="item-info-first">
                                                        <span><?=$slide_items[$i]['title']?></span>
                                                        <span><?=$slide_items[$i]['sub_title']?></span>
                                                    </div>
                                                    <span class="item-info-two"><?=$slide_items[$i]['product_name']?></span>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="item-info-btn">хочу примерить</a>
                                                </div>
                                                <?php if (!empty($slide_items[$i]['img'])): ?>
                                                    <img src="<?php echo esc_url($slide_items[$i]['img']); ?>" alt="" loading="lazy">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
        
                    <span class="font-cursive">эмоции</span>
                </section>
            <?endif?>

            <!-- Этот блок виден только в мобиле -->
            <? if (have_rows('grid_slide')): ?>
                <section class="grid-slide-mobile d-md-none d-block position-relative">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 position-relative">
                                <ul class="owl-list grid-slide-mobile-list owl-carousel owl-theme autoheight" id="grid-slide-mobile-list">
                                    <? while (have_rows('grid_slide')): the_row(); 
                                        if(!empty(get_sub_field('product_id'))){
                                            $title = get_sub_field('title');
                                            $sub_title = get_sub_field('sub_title');
                                            $product_name = get_sub_field('product_name');
                                            $product_id = get_sub_field('product_id');
                                            $img = get_sub_field('img');
                                            $product = wc_get_product($product_id);    
                                        }
                                    ?>
                                        <li>
                                            <div class="wrap">
                                                <div class="item-info">
                                                    <a href="javascript:void(0)" class="add-fav woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                    <div class="item-info-first">
                                                        <span><?=$title?></span>
                                                        <span><?=$sub_title?></span>
                                                    </div>
                                                    <span class="item-info-two"><?=$product_name?></span>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="item-info-btn">хочу примерить</a>
                                                </div>
                                                <img src="<?=esc_url($img);?>" alt="<?=$title." ".$sub_title." ".$product_name?>">
                                            </div>
                                        </li>
                                    <?endwhile?>
                                </ul>
                                <div class="mobile-dots d-flex d-md-none justify-content-between">
                                    <a href="javascript:void(0)" id="grid-slide-mobile-prev"></a>
                                    <a href="javascript:void(0)" id="grid-slide-mobile-next"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="grid-slide-mobile-svg1 d-block d-md-none" src="<?php echo get_stylesheet_directory_uri(); ?>/images/vlyubilasь-v-platьe.svg" alt="" loading="lazy">
                </section>
            <?endif?>

            <? if (have_rows('carusel_atmosfera')): ?> 
                <section class="atm-pint">
                    <span class="font-cursive d-block atm-pint-left">Вау!</span>
                    <img class="atm-pint-svg1 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/uyutno.svg" alt="" loading="lazy" />
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span class="section-subtitle d-block text-center">атмосфера как в pinterest</span>
                                <h2 class="section-title text-center font-title">только в реальности</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 position-relative">
                                <ul class="carousel-pint owl-list owl-carousel owl-theme autoheight" id="carousel-pint">
                                    <? while (have_rows('carusel_atmosfera')): the_row(); 
                                        $video = get_sub_field('video');
                                    ?>
                                        <li>
                                            <video data-src="<?=$video?>" poster="<?php echo get_stylesheet_directory_uri(); ?>/images/galereya1.png" muted playsinline class="lazy-video">Ваш браузер не поддерживает видео.</video>
                                        </li> 
                                    <?endwhile?>                                                       
                                </ul>
                                <div class="carousel-pint-nav">
                                    <a href="javascript:void(0)" class="carousel-pint-prev" id="carousel-pint-prev"></a>
                                    <a href="javascript:void(0)" class="carousel-pint-next" id="carousel-pint-next"></a>
                                </div>
                            </div>
                        </div>   
                    </div>
                </section>
            <?endif?>
            
            <? if (have_rows('new_in_salon_two')): ?>
                <section class="new-in-salon new-in-salon-two position-relative">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span class="section-subtitle d-block text-center">самый большой выбор</span>
                                <h2 class="section-title text-center font-title">вечерних платьев</h2>
                            </div>
                        </div>
                        <div class="row margin-bottom-80">
                            <div class="col-12">
                                <div class="new-in-salon-carusel">
                                    <ul class="owl-carousel owl-theme owl-list" id="new-in-salon-two">
                                        <? while (have_rows('new_in_salon_two')): the_row(); 
                                            $id = get_sub_field('id');
                                            $product = wc_get_product($id);
                                        ?>
                                            <li>
                                                <div class="tabs-carusel_image-wrap">
                                                    <div class="tabs-carusel_image">
                                                        <?if (get_sub_field('shildik')):?>
                                                            <div class="nameplate-sale nameplate-sale2"></div>
                                                        <?endif?>
                                                        <?=wp_get_attachment_image(
                                                            $product->get_image_id(), 
                                                            [400, 600], 
                                                            false
                                                        ) ?>
                                                        <div class="tabs-carusel_image-btn justify-content-around">
                                                            <a href="javascript:void(0)" class="add-favorite woosw-btn" data-id="<?=$product->id?>" data-product_name="<?=$product->get_name()?>" aria-label=" "></a>
                                                            <a href="<?=esc_url($product->get_permalink())?>" class="theme-button button-main">Хочу примерить</a>
                                                        </div>
                                                        <?if($product->is_in_stock()):?>
                                                            <span class="in-sklad">в наличии</span>
                                                        <?endif?>
                                                    </div>
                                                </div>
                                                <div class="tabs-carusel_data">
                                                    <span class="tabs-carusel_data-cat d-block"><?=get_field('tip_tovara', $product->id)?></span>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="tabs-carusel_data-name d-table" style="color:#181818"><?=$product->get_name()?></a>
                                                </div>
                                                <div class="tabs-carusel_price text-center">
                                                    <?if(!empty($product->get_regular_price()) && $product->get_regular_price() > $product->get_price()):?>
                                                        <span class="tabs-carusel_data-old-price"><?=number_format((float)$product->get_regular_price(), 0, ',', ' ')?>₽</span>
                                                    <?endif?>
                                                    <?if(!empty($product->get_price())):?>
                                                        <span class="tabs-carusel_data-price"><?=number_format((float)$product->get_price(), 0, ',', ' ')?>₽</span>
                                                    <?endif?>
                                                    <a href="<?=esc_url($product->get_permalink())?>" class="link-item"></a>
                                                </div>
                                            </li>
                                        <?endwhile?>
                                    </ul>
                                    <div class="tabs-carusel_dot new-in-salon-carusel_dot d-none d-md-table">
                                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev" id="new-in-salon-two-prev"></a>
                                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next" id="new-in-salon-two-next"></a>
                                    </div>
                                </div>    
                            </div>
                            <div class="mobile-dots d-flex d-md-none justify-content-between">
                                <a href="javascript:void(0)" id="new-in-salon-two_prev1"></a>
                                <a href="javascript:void(0)" id="new-in-salon-two_next1"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center position-relative">
                                <a href="/c/evening/" class="theme-button button-main custom_main_btn">перейти в каталог</a>
                            </div>
                        </div>
                    </div>
                </section>
            <?endif?>


            <section class="your-turn">
                <div class="your-turn_righ_top">
                    <img class="your-turn-svg2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/spletni.svg" alt="" />
                    <ul>
                        <li><a href="https://t.me/jullybridesalon" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-telegram.svg" alt=""/></a></li>
                        <li><a href="https://vk.com/jullybride" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-vkontakte.svg" alt=""/></a></li>
                        <li><a href="https://instagram.com/jullybride" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-instagram.svg" alt=""/></a></li>
                        <li><a href="https://www.youtube.com/channel/UCo_Zo2x9fyN19uuxkWO_v-g" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link-youtube.svg" alt=""/></a></li>
                    </ul>
                </div>

                <? if (have_rows('reviews')): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span class="section-subtitle d-block text-center">эти невесты выбрали быть счастливыми</span>
                                <h2 class="section-title text-center font-title">теперь твоя очередь!</h2>
                            </div>
                        </div>
                    </div>
                    <ul class="owl-list reviews-carusel owl-carousel owl-theme center_item" id="reviews-carusel">
                        <? while (have_rows('reviews')): the_row(); 
                            $foto = get_sub_field('foto');
                            $fio = get_sub_field('fio');
                            $tekst = get_sub_field('tekst');
                            $link = get_sub_field('link');
                            $date = get_sub_field('date');
                        ?>
                            <li>
                                <div class="reviews_item_wrap">
                                    <div class="reviews_item-boximg d-flex justify-content-center align-items-center">
                                        <?if(!empty($foto)):?>
                                            <img class="reviews_item-img" src="<?=$foto?>" alt="<?=$fio?>" />
                                        <?else:?>
                                            <img class="reviews_item-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-foto.png" alt="<?=$fio?>" />
                                        <?endif?>
                                    </div>
                                    <span class="reviews_item-name d-block"><?=$fio?></span>
                                    <span class="reviews_item-desc d-block"><?= mb_strlen($tekst) > 120 ? mb_substr($tekst, 0, 120, 'UTF-8') . '...' : $tekst; ?></span>
                                </div>
                                <a href="<?=$link?>" class="reviews_item-more" target="_blank">Читать отзыв полностью</a>
                                <span class="reviews_item-date d-block"><?=$date?></span>
                            </li>
                        <?endwhile?>
                    </ul>
                    <div class="tabs-carusel_dot new-in-salon-carusel_dot reviews-carusel_dot d-none d-md-table">
                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="reviews-carusel_prev"></a>
                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="reviews-carusel_next"></a>
                    </div>
                <?endif?>

                <div class="site-data d-flex justify-content-center align-items-center">
                    <span class="font-cursive">Оценка 5.0</span>
                    <a href="https://yandex.ru/maps/-/CDF0mUZg" target="_blank" class="text-decoration-none">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/subtraction-2.svg" alt="яндекс" />
                        <span>1200+ отзывов</span>
                    </a>
                    <div class="logos-row d-flex">
                        <a href="https://maps.app.goo.gl/g4cstST3aWEhCi5k9" target="_blank">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/gegl.svg" alt="google">
                        </a>
                        <a href="https://2gis.ru/spb/firm/5348553838718306" target="_blank">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tugis.svg" alt="2gis">
                        </a>
                    </div>
                </div>
                <img class="your-turn-svg1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/nevesty-vybirayut.svg" alt="" />
            </section>

            <section class="box-important position-relative">
                <div class="container position-relative z-index-1">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                        <? if (have_rows('box_important')): ?>
                            <? while (have_rows('box_important')): the_row(); 
                                $title = get_sub_field('title');
                                $text = get_sub_field('text');
                            ?>
                                <div class="box-important_item1 text-center">
                                    <span class="box-important_item1-title font-cursive d-block text-center"><?=$title?></span>
                                    <span class="box-important_item1-desc"><?=$text?></span>
                                    <div>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/vector-11.svg" alt="" />
                                    </div>
                                </div>
                            <?endwhile?>
                        <?endif?>    
                        </div>
                        <div class="col-md-4">
                            <div class="box-important_item2">
                                <video 
                                    data-src="<?=get_field('video_important')?>" 
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
                            <textPath href="#text-path" startOffset="50%"><?=get_field('text_stroke')?><animate attributeName="startOffset" from="100%" to="-100%" dur="120s" repeatCount="indefinite" />
                            </textPath>
                        </text>
                    </svg>
                </div>
                <img class="box-important-svg1 d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/images/2000.svg" alt="" />
            </section>

        </main>

<?php get_footer();?>


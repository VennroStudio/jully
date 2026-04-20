<?php
$tip_tovara = get_field('tip_tovara', $current_product_id);

$similar_products = [];
if (!empty($tip_tovara)) {
    $similar_query = new WP_Query([
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'post__not_in'   => [$current_product_id],
        'orderby'        => 'rand',
        'fields'         => 'ids',
        'meta_query'     => [
            [
                'key'     => 'tip_tovara',
                'value'   => $tip_tovara,
                'compare' => '=',
            ],
        ],
    ]);
    if (!empty($similar_query->posts)) {
        foreach ($similar_query->posts as $post_id) {
            $p = wc_get_product($post_id);
            if ($p && $p->is_visible()) {
                $similar_products[] = $p;
            }
        }
    }
    wp_reset_postdata();
}

if (empty($similar_products)) {
    return;
}

?>
<section class="new-in-salon new-in-salon2 new-in-salon3 position-relative product-new-in-salon">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="section-subtitle d-block text-center">рекомендуем</span>
                <h2 class="section-title text-center font-title">Похожие товары</h2>
            </div>
        </div>
        <div class="row margin-bottom-80">
            <div class="col-12">
                <div class="new-in-salon-carusel">
                    <ul class="owl-carousel owl-theme owl-list" id="similar-products-carusel">
                        <?php foreach ($similar_products as $similar_product): ?>
                            <li>
                                <div class="tabs-carusel_image-wrap">
                                    <div class="tabs-carusel_image">
                                        <?php
                                        $image_id = $similar_product->get_image_id();
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
                                            data-id="<?= esc_attr($similar_product->get_id()) ?>"
                                            data-product_name="<?= esc_attr($similar_product->get_name()) ?>"
                                            aria-label="Добавить в избранное"></a>
                                            <a href="<?= esc_url($similar_product->get_permalink()) ?>"
                                            class="theme-button button-main">Хочу примерить</a>
                                        </div>
                                        <?php if ($similar_product->is_in_stock()): ?>
                                            <span class="in-sklad">в наличии</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="tabs-carusel_data">
                                    <span class="tabs-carusel_data-cat d-block">
                                        <?= esc_html(get_field('tip_tovara', $similar_product->get_id()) ?: '') ?>
                                    </span>
                                    <a class="tabs-carusel_data-name d-table" href="<?= esc_url($similar_product->get_permalink()) ?>" style="color:#181818">
                                        <?= esc_html($similar_product->get_name()) ?>
                                    </a>
                                </div>
                                <div class="tabs-carusel_price text-center">
                                    <?php if (!empty($similar_product->get_regular_price()) && $similar_product->get_regular_price() > $similar_product->get_price()): ?>
                                        <span class="tabs-carusel_data-old-price">
                                            <?= number_format((float)$similar_product->get_regular_price(), 0, ',', ' ') ?>₽
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($similar_product->get_price())): ?>
                                        <span class="tabs-carusel_data-price">
                                            <?= number_format((float)$similar_product->get_price(), 0, ',', ' ') ?>₽
                                        </span>
                                    <?php endif; ?>
                                    <a href="<?= esc_url($similar_product->get_permalink()) ?>" class="link-item"></a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tabs-carusel_dot new-in-salon-carusel_dot d-md-table d-none">
                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_prev custom_btn" id="similar-products_prev"></a>
                        <a href="javascript:void(0)" class="tabs-carusel_nav tabs-carusel_next custom_btn" id="similar-products_next"></a>
                    </div>
                </div>
            </div>
            <div class="mobile-dots d-flex d-md-none justify-content-between">
                <a href="javascript:void(0)" id="similar-products-carusel_prev1"></a>
                <a href="javascript:void(0)" id="similar-products-carusel_next1"></a>
            </div>
        </div>
    </div>
</section>

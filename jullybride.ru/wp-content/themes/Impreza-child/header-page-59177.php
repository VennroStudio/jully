<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * The template for displaying website header
 *
 * Do not overload this file directly. Instead have a look at templates/header.php file in us-core plugin folder:
 * you should find all the needed hooks there.
 */

if ( function_exists( 'us_load_template' ) ) {

	us_load_template( 'templates/header' );
    ?>

<style>
/* Прелоадер */
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fff; /* фон прелоадера (можно поменять) */
    z-index: 10001;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(0,0,0,0.1);
    border-left-color: #681f2a; /* цвет спиннера */
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<div id="preloader">
    <div class="spinner"></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Находим все изображения с data-src
    document.querySelectorAll('.products-list-carusel img[data-src]').forEach(img => {
        // Копируем значение из data-src в src
        img.src = img.dataset.src;
        
        // Опционально: удаляем атрибут, чтобы избежать повторной обработки
        img.removeAttribute('data-src');
    });

    document.querySelectorAll('.main-slide_img img[data-src]').forEach(img => {
        // Копируем значение из data-src в src
        img.src = img.dataset.src;
        
        // Опционально: удаляем атрибут, чтобы избежать повторной обработки
        img.removeAttribute('data-src');
    });

    // 1. Находим критические изображения (первый экран)
    const selectors = [
        '[data-critical="true"]',
    ];
    const criticalImages = document.querySelectorAll(selectors.join(','));

    // 2. Если критических изображений нет — сразу убираем прелоадер
    if (criticalImages.length === 0) {
        removePreloader();
        loadVideos();
        return;
    }

    // 3. Ждём загрузки всех критических изображений
    const promises = Array.from(criticalImages).map(img => {
        // Если изображение уже загружено (из кэша)
        if (img.complete && img.naturalWidth !== 0) {
            return Promise.resolve();
        }
        // Ждём загрузки
        return new Promise(resolve => {
            img.addEventListener('load', resolve, { once: true });
            img.addEventListener('error', resolve, { once: true }); // на случай ошибки
        });
    });

    // 4. После загрузки — убираем прелоадер и грузим видео
    Promise.all(promises).then(() => {
        //removePreloader();
        setTimeout(removePreloader);
        setTimeout(loadVideos);
    });

    /* // Страховка + минимальная задержка
    const timeout = new Promise(resolve => setTimeout(resolve, 6000)); 

    Promise.race([
        Promise.all(promises),
        timeout
    ]).then(() => {
        removePreloader();
        loadVideos();
    }); */

});

function removePreloader() {
    const preloader = document.getElementById('preloader');
    if (preloader) preloader.remove();
}

function loadVideos() {
    document.querySelectorAll('video[data-src]').forEach(video => {
        if (video.src || video.children.length > 0) return; // уже загружено
        video.src = video.dataset.src;
        video.load();
    });
}
</script>
<?
} else {
	?>
	<!DOCTYPE HTML>
	<html class="no-touch" <?php language_attributes( 'html' ) ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( 'l-body header_hor state_default NO_US_CORE' ); ?>>
	<?php wp_body_open(); ?>
		<div class="l-canvas">
			<header class="l-header pos_static">
				<div class="l-subheader at_middle">
					<div class="l-subheader-h">
						<div class="l-subheader-cell at_left">
							<div class="w-text">
								<a class="w-text-h" href="/">
									<span class="w-text-value"><?php bloginfo( 'name' ); ?></span>
								</a>
							</div>
						</div>
						<div class="l-subheader-cell at_center"></div>
						<div class="l-subheader-cell at_right">
							<nav class="w-nav height_full dropdown_opacity type_desktop">
								<ul class="w-nav-list level_1">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'us_main_menu',
											'container' => FALSE,
											'walker' => new US_Walker_Nav_Menu,
											'items_wrap' => '%3$s',
											'fallback_cb' => FALSE,
										)
									);
									?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</header>
	<?php
}

<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */

$jb_primary_desktop = [
    'theme_location'  => 'primary',
    'container'       => false,
    'menu_id'         => 'jb-primary-desktop',
    'menu_class'      => 'jb-desktop-menu flex flex-wrap items-center gap-x-6 text-[12px] font-medium uppercase tracking-wider text-gray-800 list-none m-0 p-0',
    'li_class'        => 'nav-item flex items-center gap-1',
    'fallback_cb'     => false,
];
$jb_primary_mobile = [
    'theme_location'  => 'primary',
    'container'       => false,
    'menu_id'         => 'jb-primary-mobile',
    'menu_class'      => 'mt-8 space-y-6 text-xl uppercase tracking-widest font-light text-gray-800 list-none m-0 p-0 [&_a]:block [&_a]:border-b [&_a]:border-gray-200 [&_a]:pb-2 [&_a]:text-gray-800 [&_a]:no-underline',
    'li_class'        => '',
    'fallback_cb'     => false,
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('main-font bg-white text-gray-900 antialiased'); ?>>
<?php do_action('tailpress_site_before'); ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('tailpress_header'); ?>

    <header class="main-font w-full">
        <!-- Верхняя черная панель -->
        <div class="bg-black text-white text-[11px] md:text-[12px] py-2 px-4">
            <div class="max-w-7xl mx-auto flex justify-center md:justify-between items-center">
                <div class="flex items-center cursor-pointer">
                    <span>Санкт-Петербург</span>
                    <svg class="w-3 h-3 ml-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="hidden md:flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span>Петроградская наб., 18, ПН-ВС — 11:00-21:00</span>
                    </div>
                    <div class="flex items-center gap-1 font-medium">
                        <a href="tel:+78129291699">+7 (812) 929-16-99</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Основная панель -->
        <div class="bg-[#f8dada] md:bg-[#fdf2f2] py-4 md:py-6 px-4 border-b border-pink-100">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="hidden md:block text-[11px] tracking-widest uppercase text-gray-700 font-light leading-tight">
                        СВАДЕБНЫЙ САЛОН <span class="italic text-sm">&amp;</span> КАФЕ ДЛЯ НЕВЕСТ
                    </div>
                </div>

                <div class="flex-shrink-0 flex justify-center text-center">
                    <?php
                    $jb_logo_src = get_theme_file_uri('resources/images/logo-jully-bride.png');
                    $jb_logo_alt = get_bloginfo('name', 'display');
                    ?>
                    <?php if (has_custom_logo()) : ?>
                        <div class="jb-header-logo [&_img]:max-h-14 md:[&_img]:max-h-20 [&_a]:inline-block">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php elseif (is_front_page()) : ?>
                        <h1 class="m-0 leading-none">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-300 rounded">
                                <img src="<?php echo esc_url($jb_logo_src); ?>" alt="<?php echo esc_attr($jb_logo_alt); ?>" class="h-12 w-auto max-h-16 md:h-16 md:max-h-20 object-contain object-center" width="320" height="90" decoding="async" fetchpriority="high">
                            </a>
                        </h1>
                    <?php else : ?>
                        <p class="m-0 leading-none">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-300 rounded">
                                <img src="<?php echo esc_url($jb_logo_src); ?>" alt="<?php echo esc_attr($jb_logo_alt); ?>" class="h-12 w-auto max-h-16 md:h-16 md:max-h-20 object-contain object-center" width="320" height="90" decoding="async">
                            </a>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="flex-1 flex justify-end min-w-0">
                    <?php if (has_nav_menu('primary')) : ?>
                        <button type="button" id="jb-burger-btn" class="md:hidden text-gray-800" aria-expanded="false" aria-controls="jb-mobile-menu" aria-label="Открыть меню">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    <?php endif; ?>
                    <div class="hidden md:block text-[11px] tracking-widest uppercase text-gray-700 font-light text-right leading-tight">
                        КАЖДАЯ ПРИМЕРКА КАК СЦЕНА ИЗ ФИЛЬМА!
                    </div>
                </div>
            </div>
        </div>

        <!-- Десктопная навигация -->
        <?php if (has_nav_menu('primary')) : ?>
            <nav class="hidden md:block bg-[#f8dada] py-3 px-4 shadow-sm" aria-label="Основное меню">
                <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
                    <?php wp_nav_menu($jb_primary_desktop); ?>
                    <div class="flex items-center gap-4 shrink-0">
                        <button type="button" class="nav-item text-gray-800" aria-label="Избранное">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
                        </button>
                        <a href="<?php echo esc_url(home_url('/?s=')); ?>" class="nav-item text-gray-800" aria-label="Поиск">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </a>
                    </div>
                </div>
            </nav>
        <?php elseif (current_user_can('edit_theme_options')) : ?>
            <div class="bg-amber-50 border-b border-amber-200 py-2 px-4 text-center text-sm">
                <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-amber-900 underline">Создайте меню «Primary» и назначьте его в области «Primary Menu».</a>
            </div>
        <?php endif; ?>

        <?php if (has_nav_menu('primary')) : ?>
            <!-- Мобильное меню -->
            <div id="jb-mobile-menu" class="fixed inset-0 bg-white z-[999] hidden p-6 transform translate-x-full transition-transform duration-300 md:hidden" role="dialog" aria-modal="true" aria-label="Мобильное меню">
                <div class="flex justify-end">
                    <button type="button" id="jb-close-menu" class="text-gray-800" aria-label="Закрыть меню">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <?php wp_nav_menu($jb_primary_mobile); ?>
            </div>
        <?php endif; ?>
    </header>

    <div id="content" class="site-content grow">

        <?php do_action('tailpress_content_start'); ?>
        <main>

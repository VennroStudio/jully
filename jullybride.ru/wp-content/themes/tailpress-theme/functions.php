<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}


function tailpress_vite_dev_server_url(): string
{
    if (defined('VITE_DEV_SERVER_URL') && VITE_DEV_SERVER_URL) {
        return (string) VITE_DEV_SERVER_URL;
    }
    $env = getenv('VITE_DEV_SERVER_URL');

    return $env !== false && $env !== '' ? $env : 'http://localhost:3000';
}

/**
 * TailPress подставляет в HTML тот же URL, по которому PHP проверяет Vite.
 * Из контейнера это часто host.docker.internal — браузер на Mac не подгружает CSS/JS с этого хоста.
 * Указываем для страниц отдельный «публичный» origin (по умолчанию localhost:3000).
 */
function tailpress_vite_public_origin(): string
{
    if (defined('VITE_DEV_PUBLIC_URL') && VITE_DEV_PUBLIC_URL) {
        return rtrim((string) VITE_DEV_PUBLIC_URL, '/');
    }
    $env = getenv('VITE_DEV_PUBLIC_URL');

    return $env !== false && $env !== '' ? rtrim($env, '/') : 'http://localhost:3000';
}

function tailpress_vite_rewrite_asset_src($src)
{
    if (! is_string($src) || $src === '') {
        return $src;
    }
    $internal = rtrim(tailpress_vite_dev_server_url(), '/');
    $public = tailpress_vite_public_origin();
    if ($internal === $public) {
        return $src;
    }
    if (str_starts_with($src, $internal)) {
        return $public.substr($src, strlen($internal));
    }

    return $src;
}

add_filter('style_loader_src', 'tailpress_vite_rewrite_asset_src', 20);
add_filter('script_loader_src', 'tailpress_vite_rewrite_asset_src', 20);

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler(tailpress_vite_dev_server_url()), fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

tailpress();

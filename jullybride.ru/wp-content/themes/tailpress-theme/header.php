<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page">
    <header>
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'fallback_cb'    => false,
        ]);
        ?>
    </header>

    <div id="content" class="site-content grow">
        <?php do_action('tailpress_content_start'); ?>
        <main>

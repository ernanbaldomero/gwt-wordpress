<?php
/**
 * Initialize theme setup and core functionality for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

// Define content width.
if (!isset($content_width)) {
    $content_width = 640; // Default content width in pixels.
}

if (!function_exists('gwt_setup')) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function gwt_setup() {
    // Load theme text domain for translations.
    load_theme_textdomain('gwt-wordpress', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable title tag support.
    add_theme_support('title-tag');

    // Enable custom logo support.
    add_theme_support('custom-logo', [
        'height'      => 240,
        'width'       => 240,
        'flex-height' => true,
    ]);

    // Enable post thumbnails.
    add_theme_support('post-thumbnails');

    // Switch default core markup to HTML5.
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // Enable selective refresh for widgets in the Customizer.
    add_theme_support('customize-selective-refresh-widgets');

    // Add editor styles.
    add_editor_style();

    // Register navigation menu walkers.
    require_once get_template_directory() . '/inc/class-off-canvas-menu.php';
    require_once get_template_directory() . '/inc/class-topbar-nav-menu.php';
}
endif; // gwt_setup
add_action('after_setup_theme', 'gwt_setup');

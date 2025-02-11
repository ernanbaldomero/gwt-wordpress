<?php
/**
 * Enqueue styles and scripts for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Enqueue theme styles and scripts.
 */
function gwt_enqueue_scripts() {
    // Define theme version for cache busting.
    $theme_version = wp_get_theme()->get('Version');

    /** Styles **/
    // Foundation CSS.
    wp_enqueue_style(
        'gwt-foundation',
        get_template_directory_uri() . '/foundation/css/foundation.min.css',
        [],
        $theme_version
    );

    // Font Awesome CSS.
    wp_enqueue_style(
        'gwt-fontawesome',
        get_template_directory_uri() . '/css/font-awesome.min.css',
        [],
        $theme_version
    );

    // Genericons CSS.
    wp_enqueue_style(
        'gwt-genericons',
        get_template_directory_uri() . '/genericons/genericons.css',
        [],
        '3.4.1'
    );

    // Main theme stylesheet.
    wp_enqueue_style(
        'gwt-style',
        get_template_directory_uri() . '/theme.css',
        [],
        $theme_version
    );

    // Child theme stylesheet (if applicable).
    wp_enqueue_style(
        'gwt-user-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    /** Scripts **/
    // Skip link focus fix for accessibility.
    wp_enqueue_script(
        'gwt-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        [],
        $theme_version,
        true
    );

    // Main theme JavaScript.
    wp_enqueue_script(
        'gwt-theme-js',
        get_template_directory_uri() . '/js/theme.js',
        ['jquery'],
        $theme_version,
        true
    );

    // Comment reply script for threaded comments.
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Keyboard image navigation for image attachments.
    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script(
            'gwt-keyboard-image-navigation',
            get_template_directory_uri() . '/js/keyboard-image-navigation.js',
            ['jquery'],
            $theme_version,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'gwt_enqueue_scripts');

<?php
/**
 * Theme Customizer enhancements for GWT-WordPress.
 *
 * Adds postMessage support for site title, description, and header text color.
 * Binds JavaScript handlers for live preview updates.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Add postMessage support for site title, description, and header text color.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gwt_customize_register($wp_customize) {
    // Enable live preview for site title and description.
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // Enable live preview for header text color.
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
    }
}
add_action('customize_register', 'gwt_customize_register');

/**
 * Enqueue JavaScript for live preview in the Theme Customizer.
 */
function gwt_customize_preview_js() {
    wp_enqueue_script(
        'gwt-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        ['customize-preview'],
        GWT_THEME_VERSION, // Use a constant for versioning.
        true // Load in footer.
    );
}
add_action('customize_preview_init', 'gwt_customize_preview_js');

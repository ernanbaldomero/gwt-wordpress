<?php
/**
 * Backward compatibility functionality for GWT.
 *
 * Prevents the theme from running on WordPress versions prior to 4.4,
 * as this theme relies on newer features introduced in WordPress 4.4.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

// Define the minimum required WordPress version.
define('GWT_MIN_WP_VERSION', '4.4');

/**
 * Prevent switching to GWT on unsupported WordPress versions.
 *
 * Switches to the default theme and displays an admin notice.
 *
 * @since 26.0.0
 */
function gwt_switch_theme() {
    switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'gwt_upgrade_notice');
}
add_action('after_switch_theme', 'gwt_switch_theme');

/**
 * Display an admin notice for unsupported WordPress versions.
 *
 * @since 26.0.0
 */
function gwt_upgrade_notice() {
    $current_version = $GLOBALS['wp_version'];
    $message = sprintf(
        /* translators: 1: Current WordPress version, 2: Minimum required WordPress version. */
        esc_html__('GWT requires at least WordPress version %2$s. You are running version %1$s. Please upgrade WordPress to use this theme.', 'gwt-wordpress'),
        esc_html($current_version),
        esc_html(GWT_MIN_WP_VERSION)
    );
    printf('<div class="gwt-error"><p>%s</p></div>', $message);
}

/**
 * Prevent loading the Customizer on unsupported WordPress versions.
 *
 * @since 26.0.0
 */
function gwt_customize() {
    $current_version = $GLOBALS['wp_version'];
    wp_die(
        sprintf(
            /* translators: 1: Current WordPress version, 2: Minimum required WordPress version. */
            esc_html__('GWT requires at least WordPress version %2$s. You are running version %1$s. Please upgrade WordPress to use this theme.', 'gwt-wordpress'),
            esc_html($current_version),
            esc_html(GWT_MIN_WP_VERSION)
        ),
        '',
        ['back_link' => true]
    );
}
add_action('load-customize.php', 'gwt_customize');

/**
 * Prevent loading the Theme Preview on unsupported WordPress versions.
 *
 * @since 26.0.0
 */
function gwt_preview() {
    if (isset($_GET['preview'])) {
        $current_version = $GLOBALS['wp_version'];
        wp_die(
            sprintf(
                /* translators: 1: Current WordPress version, 2: Minimum required WordPress version. */
                esc_html__('GWT requires at least WordPress version %2$s. You are running version %1$s. Please upgrade WordPress to use this theme.', 'gwt-wordpress'),
                esc_html($current_version),
                esc_html(GWT_MIN_WP_VERSION)
            )
        );
    }
}
add_action('template_redirect', 'gwt_preview');

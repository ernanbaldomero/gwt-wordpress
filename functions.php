<?php
/**
 * gwt_wp functions and definitions
 *
 * @package gwt_wp
 */

/**
 * Core Features
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

/**
 * Security Enhancements
 */
function block_frames() {
    header( 'X-FRAME-OPTIONS: SAMEORIGIN' );
}
add_action( 'send_headers', 'block_frames', 10 );

function add_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: no-referrer-when-downgrade' );
}
add_action( 'send_headers', 'add_security_headers', 10 );

/**
 * Widgets and Sidebars
 */
require get_template_directory() . '/inc/function-widget.php'; // Register widgetized areas
require get_template_directory() . '/inc/sidebar.php'; // Default sidebar contents

/**
 * Scripts and Styles
 */
require get_template_directory() . '/inc/function-enqueue_scripts.php'; // Enqueue scripts and styles

/**
 * Template Tags and Extras
 */
require get_template_directory() . '/inc/template-tags.php'; // Custom template tags
require get_template_directory() . '/inc/extras.php'; // Custom functions independent of templates

/**
 * Breadcrumbs and Excerpts
 */
require get_template_directory() . '/inc/function-breadcrumbs.php'; // Breadcrumbs functionality
require get_template_directory() . '/inc/function-excerpt.php'; // Custom excerpt handling

/**
 * Disable Features
 */
require get_template_directory() . '/inc/function-disable_comments.php'; // Disable comment functions
require get_template_directory() . '/inc/function-disable_api.php'; // Disable REST API for users

/**
 * Classic Editor Support
 */
require get_template_directory() . '/inc/function-enable-classic-widgets.php'; // Enable classic widgets
require get_template_directory() . '/inc/function-enable-classic-posts.php'; // Enable classic posts

/**
 * GovPH Widgets
 */
require get_template_directory() . '/inc/govph-widget.php'; // GovPH default widgets

/**
 * Theme Options
 */
require get_template_directory() . '/inc/function-options.php'; // Theme options page

/**
 * Customizer
 */
require get_template_directory() . '/inc/customizer.php'; // Customizer additions

/**
 * Vendors
 */
require get_template_directory() . '/inc/vendors/envato-flex-slider/envato-flex-slider.php'; // Envato Flexslider

/**
 * Template Initialize
 */
require get_template_directory() . '/inc/function-initialize.php'; // Template initialization

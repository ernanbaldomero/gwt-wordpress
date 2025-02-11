<?php
/**
 * Completely disable comments and related functionalities.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Disable support for comments and trackbacks in all post types.
 */
function gwt_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'gwt_disable_comments_post_types_support');

/**
 * Close comments on the front-end.
 *
 * @return bool Always returns false to close comments.
 */
function gwt_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'gwt_disable_comments_status', 20, 2);
add_filter('pings_open', 'gwt_disable_comments_status', 20, 2);

/**
 * Hide existing comments from the front-end.
 *
 * @param array $comments Array of comments.
 * @return array Empty array to hide comments.
 */
function gwt_disable_comments_hide_existing_comments($comments) {
    return [];
}
add_filter('comments_array', 'gwt_disable_comments_hide_existing_comments', 10, 2);

/**
 * Remove the "Comments" page from the admin menu.
 */
function gwt_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'gwt_disable_comments_admin_menu');

/**
 * Redirect users trying to access the "Comments" page.
 */
function gwt_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url()); // Use wp_safe_redirect for security.
        exit;
    }
}
add_action('admin_init', 'gwt_disable_comments_admin_menu_redirect');

/**
 * Remove the "Recent Comments" metabox from the dashboard.
 */
function gwt_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'gwt_disable_comments_dashboard');

/**
 * Remove the "Comments" link from the admin bar.
 */
function gwt_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'gwt_disable_comments_admin_bar');

<?php
/**
 * Custom Post Type for Slider Images.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

// Define constants for the custom post type.
define('EFS_CPT_NAME', __('Slider Images', 'gwt-wordpress'));
define('EFS_CPT_SINGLE', __('Slider Image', 'gwt-wordpress'));
define('EFS_CPT_TYPE', 'slider-image');
define('EFS_CPT_THUMB_SIZE', 500);

// Add support for post thumbnails.
add_theme_support('post-thumbnails', [EFS_CPT_TYPE]);

/**
 * Register the custom post type.
 */
function efs_register() {
    $args = [
        'label' => EFS_CPT_NAME,
        'singular_label' => EFS_CPT_SINGLE,
        'public' => false, // Not publicly accessible.
        'show_ui' => true, // Show in admin UI.
        'exclude_from_search' => true, // Exclude from search results.
        'show_in_nav_menus' => false, // Do not allow adding to menus.
        'has_archive' => false, // No archive page.
        'rewrite' => false, // No rewrite rules.
        'supports' => ['title', 'thumbnail'], // Support title and thumbnail only.
    ];

    register_post_type(EFS_CPT_TYPE, $args);
    set_post_thumbnail_size(EFS_CPT_THUMB_SIZE);
}
add_action('init', 'efs_register');

/**
 * Disable the editor for the custom post type.
 */
function efs_disable_editor() {
    remove_post_type_support(EFS_CPT_TYPE, 'editor');
}
add_action('init', 'efs_disable_editor');

/**
 * Add a meta box for slider links.
 *
 * @param WP_Post $post The post object.
 */
function efs_add_meta_boxes($post) {
    add_meta_box(
        'efs-slider-link-meta-box',
        __('Slider Link', 'gwt-wordpress'),
        'efs_build_meta_box',
        EFS_CPT_TYPE,
        'normal',
        'low'
    );
}
add_action('add_meta_boxes_' . EFS_CPT_TYPE, 'efs_add_meta_boxes');

/**
 * Build the meta box content.
 *
 * @param WP_Post $post The post object.
 */
function efs_build_meta_box($post) {
    // Add nonce field for security.
    wp_nonce_field(basename(__FILE__), 'efs_slider_link_meta_box_nonce');

    // Retrieve the current slider link value.
    $slider_link = get_post_meta($post->ID, '_slider_link', true);
    ?>
    <div class="inside">
        <div>
            <input type="text" name="slider_link" value="<?php echo esc_attr($slider_link); ?>" style="width: 100%;" />
            <p><?php _e('Enter the URL linked to the slider image, if any.', 'gwt-wordpress'); ?><br/>
            <?php _e('To link internal paths, copy the permalink without the base URL. Example:', 'gwt-wordpress'); ?> <strong>/2017/10/03/article-link</strong><br/>
            <?php _e('To link external paths, add http:// or https:// at the beginning of the URL. Example:', 'gwt-wordpress'); ?> <strong>http://example.com</strong></p>
        </div>
    </div>
    <?php
}

/**
 * Save the meta box data.
 *
 * @param int $post_id The post ID.
 */
function efs_save_meta_box_data($post_id) {
    // Verify nonce for security.
    if (!isset($_POST['efs_slider_link_meta_box_nonce']) || !wp_verify_nonce($_POST['efs_slider_link_meta_box_nonce'], basename(__FILE__))) {
        return;
    }

    // Return if autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save the slider link.
    if (isset($_REQUEST['slider_link'])) {
        update_post_meta($post_id, '_slider_link', sanitize_text_field($_REQUEST['slider_link']));
    }
}
add_action('save_post_' . EFS_CPT_TYPE, 'efs_save_meta_box_data');

/**
 * Retrieve and format the slider link.
 *
 * @param int $post_id The post ID.
 * @return string The formatted slider link.
 */
function efs_get_meta_box_data($post_id) {
    $slider_link = get_post_meta($post_id, '_slider_link', true);

    // Default fallback.
    if (empty($slider_link)) {
        return '#';
    }

    // Handle external URLs.
    if (strpos($slider_link, 'http://') === 0 || strpos($slider_link, 'https://') === 0) {
        return esc_url($slider_link);
    }

    // Handle internal paths.
    if (strpos($slider_link, '/') !== 0) {
        $slider_link = '/' . $slider_link;
    }

    return esc_url(home_url($slider_link));
}

<?php
/**
 * Disable the Gutenberg block editor for posts and enable the classic editor.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Check if the classic editor should be enabled for posts.
 *
 * @return bool True if the classic editor is enabled, false otherwise.
 */
function gwt_should_enable_classic_editor() {
    // Replace `govph_displayoptions()` with a more descriptive function or constant if possible.
    return !govph_displayoptions('govph_enable_post_classic_editor');
}

/**
 * Disable the block editor for posts if the classic editor is enabled.
 */
function gwt_disable_block_editor_for_posts() {
    if (gwt_should_enable_classic_editor()) {
        add_filter('use_block_editor_for_post', '__return_false');
    }
}
add_action('init', 'gwt_disable_block_editor_for_posts');

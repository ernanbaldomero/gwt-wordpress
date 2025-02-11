<?php
/**
 * Disable the Gutenberg block editor for widgets and enable the classic widget editor.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Check if the classic widget editor should be enabled.
 *
 * @return bool True if the classic widget editor is enabled, false otherwise.
 */
function gwt_should_enable_classic_widgets() {
    // Replace `govph_displayoptions()` with a more descriptive function or constant if possible.
    return !govph_displayoptions('govph_enable_widget_classic_editor');
}

/**
 * Disable the block editor for widgets if the classic widget editor is enabled.
 */
function gwt_disable_block_editor_for_widgets() {
    if (gwt_should_enable_classic_widgets()) {
        add_filter('use_widgets_block_editor', '__return_false');
    }
}
add_action('init', 'gwt_disable_block_editor_for_widgets');

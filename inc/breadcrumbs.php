<?php
/**
 * Breadcrumbs template part for displaying breadcrumb navigation.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

// Check if breadcrumbs are enabled or available.
if (!function_exists('gwt_wp_breadcrumb') || !gwt_wp_breadcrumb()) {
    return; // Exit early if no breadcrumbs are available.
}
?>
<nav id="gwt-breadcrumbs" class="gwt-anchor" aria-label="<?php esc_attr_e('Breadcrumb Navigation', 'gwt-wordpress'); ?>">
    <div class="gwt-row">
        <div class="gwt-large-12 gwt-columns">
            <?php
            // Display the breadcrumb navigation.
            gwt_wp_breadcrumb();
            ?>
        </div>
    </div>
</nav>

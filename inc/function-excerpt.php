<?php
/**
 * Customize the excerpt "Read More" link for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Replace the default excerpt "more" text with a custom link.
 *
 * @param string $more The default "more" text.
 * @return string The modified "more" text with a custom link.
 */
function gwt_custom_excerpt_more($more) {
    // Get the current post ID.
    $post_id = get_the_ID();

    // Generate the "Read More" link with proper escaping.
    return sprintf(
        '<a class="gwt-moretag" href="%s">%s: %s</a>',
        esc_url(get_permalink($post_id)),
        esc_html__('Continue reading', 'gwt-wordpress'),
        esc_html(get_the_title($post_id))
    );
}
add_filter('excerpt_more', 'gwt_custom_excerpt_more');

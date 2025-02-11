<?php
/**
 * Generate breadcrumb navigation for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
function gwt_breadcrumb() {
    global $post;

    // Retrieve breadcrumb options.
    $options = get_option('govph_options');
    if (!isset($options['govph_breadcrumbs_enable']) || $options['govph_breadcrumbs_enable'] !== 'true') {
        return false; // Exit early if breadcrumbs are disabled.
    }

    // Define separator and classes.
    $separator = isset($options['govph_breadcrumbs_separator']) ? esc_html($options['govph_breadcrumbs_separator']) : ' / ';
    $separator_block = '<span class="gwt-separator">' . $separator . '</span>';
    $show_home = isset($options['govph_breadcrumbs_show_home']) && $options['govph_breadcrumbs_show_home'] === 'true';

    // Start breadcrumb output.
    echo '<ul class="gwt-breadcrumbs" aria-label="' . esc_attr__('Breadcrumb Navigation', 'gwt-wordpress') . '">';

    // Add "You are here:" label.
    echo '<li>' . esc_html__('You are here:', 'gwt-wordpress') . '</li>';

    // Add "Home" link if enabled.
    if ($show_home) {
        echo '<li><a class="gwt-pathway" href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'gwt-wordpress') . '</a>' . $separator_block . '</li>';
    }

    // Handle different contexts.
    if (is_category() || is_single()) {
        echo '<li>';
        if (is_category()) {
            single_cat_title();
        }
        if (is_single()) {
            the_category('</li><li>');
            echo $separator_block . '<li><span class="gwt-current show-for-sr">' . esc_html__('Current:', 'gwt-wordpress') . '</span>';
            the_title();
            echo '</li>';
        }
        echo '</li>';
    } elseif (is_page()) {
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            foreach (array_reverse($ancestors) as $ancestor) {
                echo '<li><a class="gwt-pathway" href="' . esc_url(get_permalink($ancestor)) . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a>' . $separator_block . '</li>';
            }
        }
        echo '<li><span class="gwt-current show-for-sr">' . esc_html__('Current:', 'gwt-wordpress') . '</span>' . esc_html(get_the_title()) . '</li>';
    } elseif (is_archive()) {
        echo '<li>';
        if (is_day()) {
            echo esc_html(get_the_date());
        } elseif (is_month()) {
            echo esc_html(get_the_date('F Y'));
        } elseif (is_year()) {
            echo esc_html(get_the_date('Y'));
        } elseif (is_author()) {
            echo esc_html__('Author Archive', 'gwt-wordpress');
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            echo esc_html__('Blog Archives', 'gwt-wordpress');
        } elseif (is_search()) {
            echo esc_html__('Search Results', 'gwt-wordpress');
        }
        echo '</li>';
    }

    // Close breadcrumb list.
    echo '</ul>';
}

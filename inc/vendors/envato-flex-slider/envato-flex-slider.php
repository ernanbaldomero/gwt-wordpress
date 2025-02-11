<?php
/*
Plugin Name: Envato FlexSlider
Plugin URI:
Description: A simple plugin that integrates FlexSlider (http://flex.madebymufffin.com/) with WordPress using custom post types!
Author: Joe Casabona
Version: 0.5
Author URI: http://www.casabona.org
Text Domain: envato-flexslider
*/

// Define constants for plugin paths and settings.
define('EFS_PATH', get_template_directory_uri() . '/inc/vendors/' . basename(dirname(__FILE__)) . '/');
define('EFS_NAME', 'Envato FlexSlider');
define('EFS_VERSION', '0.5');

// Include necessary files.
require_once 'slider-img-type.php';

/**
 * Retrieve the slider HTML.
 *
 * @return string The slider HTML.
 */
function efs_get_slider() {
    // Query slider images using WP_Query.
    $slider_query = new WP_Query([
        'post_type' => 'slider-image',
        'posts_per_page' => -1,
    ]);

    if (!$slider_query->have_posts()) {
        return ''; // Return empty string if no slider images exist.
    }

    $slider = '<div class="efs-orbit" role="region" aria-label="' . esc_attr__('Banner Slider', 'envato-flexslider') . '" data-orbit>';
    $slider .= '<ul class="efs-orbit-container">';

    $count = $slider_query->post_count;
    $x = 1;

    while ($slider_query->have_posts()) : $slider_query->the_post();
        $img = get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'efs-orbit-image']);
        $slide_link = slider_link_get_meta_box_data(get_the_ID());
        $caption = get_the_title();

        $is_active = ($x === 1) ? 'is-active' : '';
        $slider .= sprintf(
            '<li class="efs-orbit-slide %s">
                <div class="efs-orbit-slide-number"><span>%d</span> ' . esc_html__('of', 'envato-flexslider') . ' <span>%d</span></div>
                <a href="%s">%s</a>
                <figcaption class="efs-orbit-caption">%s</figcaption>
            </li>',
            esc_attr($is_active),
            $x,
            $count,
            esc_url($slide_link),
            $img,
            esc_html($caption)
        );

        $x++;
    endwhile;

    wp_reset_postdata(); // Reset the global post data.

    if ($count > 1) {
        $slider .= '<button class="efs-orbit-previous" aria-label="' . esc_attr__('Previous Slide', 'envato-flexslider') . '">&#9664;&#xFE0E;</button>';
        $slider .= '<button class="efs-orbit-next" aria-label="' . esc_attr__('Next Slide', 'envato-flexslider') . '">&#9654;&#xFE0E;</button>';
    }

    $slider .= '</ul>';

    if ($count > 1) {
        $slider .= '<nav class="efs-orbit-bullets">';
        for ($i = 0; $i < $count; $i++) {
            $is_active = ($i === 0) ? 'is-active' : '';
            $slider .= sprintf(
                '<button class="%s" data-slide="%d" aria-label="' . esc_attr__('Slide', 'envato-flexslider') . ' %d"></button>',
                esc_attr($is_active),
                $i,
                $i + 1
            );
        }
        $slider .= '</nav>';
    }

    $slider .= '</div>';

    return $slider;
}

/**
 * Shortcode to insert the slider into posts/pages.
 *
 * @param array $atts Shortcode attributes.
 * @return string The slider HTML.
 */
function efs_insert_slider($atts, $content = null) {
    return efs_get_slider();
}
add_shortcode('ef_slider', 'efs_insert_slider');

/**
 * Template tag to display the slider in themes.
 */
function efs_slider() {
    echo efs_get_slider();
}

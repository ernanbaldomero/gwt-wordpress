<?php
/**
 * Register widgetized areas and navigation menus for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Register widgetized areas and navigation menus.
 */
function gwt_widgets_init() {
    // Register navigation menus.
    register_nav_menus([
        'aux_nav'      => esc_html__('Auxiliary Menu', 'gwt-wordpress'),
        'topbar_left'  => esc_html__('Left Menu Top Bar', 'gwt-wordpress'),
        'topbar_right' => esc_html__('Right Menu Top Bar', 'gwt-wordpress'),
    ]);

    // Define sidebar configurations.
    $sidebars = [
        'left-sidebar'   => ['name' => __('Left Sidebar', 'gwt-wordpress'), 'class' => 'gwt-widget callout secondary'],
        'right-sidebar'  => ['name' => __('Right Sidebar', 'gwt-wordpress'), 'class' => 'gwt-widget callout secondary'],
        'banner-section-1' => ['name' => __('Banner Section 1', 'gwt-wordpress'), 'class' => 'gwt-widget banner-content anchor'],
        'banner-section-2' => ['name' => __('Banner Section 2', 'gwt-wordpress'), 'class' => 'gwt-widget banner-content anchor'],
        'ear-content-1' => ['name' => __('Ear Content 1', 'gwt-wordpress'), 'class' => 'gwt-widget ear-content anchor'],
        'ear-content-2' => ['name' => __('Ear Content 2', 'gwt-wordpress'), 'class' => 'gwt-widget ear-content anchor'],
    ];

    // Add panel top and bottom sidebars dynamically.
    foreach (['panel-top', 'panel-bottom'] as $section) {
        for ($i = 1; $i <= 4; $i++) {
            $sidebars["$section-$i"] = [
                'name' => sprintf(__('Panel %s %d', 'gwt-wordpress'), ucfirst(str_replace('-', ' ', $section)), $i),
                'class' => 'gwt-widget',
            ];
        }
    }

    // Add agency footer sidebars dynamically.
    foreach (range(1, 4) as $i) {
        $sidebars["footer-$i"] = [
            'name' => sprintf(__('Agency Footer %d', 'gwt-wordpress'), $i),
            'class' => 'gwt-widget',
        ];
    }

    // Register all sidebars.
    foreach ($sidebars as $id => $config) {
        register_sidebar([
            'name'          => $config['name'],
            'id'            => $id,
            'before_widget' => '<div id="%1$s" class="' . esc_attr($config['class']) . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="gwt-widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'gwt_widgets_init');

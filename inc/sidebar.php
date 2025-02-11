<?php
/**
 * Insert default widgets into sidebars on theme activation.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

function gwt_default_widgets() {
    $template_directory = esc_url(get_template_directory_uri());

    // Define default widget content.
    $default_widgets = [
        'text-1' => [
            'title' => '',
            'text' => sprintf(
                '<a href="%s"><img id="gwt-tp-seal" src="%s/images/transparency-seal-160x160.png" alt="%s" title="%s"></a>',
                esc_url('#'),
                $template_directory,
                esc_attr__('Transparency Seal', 'gwt-wordpress'),
                esc_attr__('Transparency Seal', 'gwt-wordpress')
            ),
        ],
        'text-2' => [
            'title' => '',
            'text' => sprintf(
                '<a href="%s"><img id="gwt-foi-logo" src="%s/images/foi-logo-160x160.png" alt="%s" title="%s"></a>',
                esc_url('https://www.foi.gov.ph/'),
                $template_directory,
                esc_attr__('Freedom of Information', 'gwt-wordpress'),
                esc_attr__('Freedom of Information', 'gwt-wordpress')
            ),
        ],
        'text-3' => [
            'title' => '',
            'text' => sprintf(
                '<div id="gwt-pst-container">
                    <div>%s</div>
                    <div id="gwt-pst-time"></div>
                </div>',
                esc_html__('Philippine Standard Time:', 'gwt-wordpress')
            ),
        ],
    ];

    // Define default active widgets for sidebars.
    $active_widgets = [
        'left-sidebar'   => ['text-1', 'text-2'],
        'ear-content-2'  => ['text-3'],
    ];

    // Update widget options.
    update_option('widget_text', $default_widgets);

    // Update sidebar widget assignments.
    update_option('sidebars_widgets', $active_widgets);
}
add_action('after_switch_theme', 'gwt_default_widgets');

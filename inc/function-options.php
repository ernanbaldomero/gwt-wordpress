<?php
/**
 * Theme options functionality for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

class GOVPH {
    private $_default_options = [];
    private $options;

    public function __construct() {
        // Define default options dynamically.
        $this->_default_options = [
            'govph_disable_search' => '',
            'govph_enable_widget_classic_editor' => '',
            'govph_enable_post_classic_editor' => '',
            'govph_logo_position' => '',
            'govph_logo' => '',
            'govph_logo_enable' => '',
            'govph_agency_name' => '',
            'govph_agency_tagline' => '',
            'govph_headercolor' => '',
            'govph_header_font_color' => '',
            'govph_headerimage' => '',
            'govph_background_header_size' => '',
            'govph_slidercolor' => '',
            'govph_sliderimage' => '',
            'govph_slider_fullwidth' => '',
            'govph_breadcrumbs_enable' => '',
            'govph_breadcrumbs_separator' => '',
            'govph_breadcrumbs_show_home' => '',
            'govph_custom_pst' => '',
            'govph_custom_anchorcolor' => '',
            'govph_custom_anchorcolor_hover' => '',
            'govph_custom_panel_top' => '',
            'govph_custom_border_color' => '',
            'govph_custom_panel_bottom' => '',
            'govph_custom_border_width' => '',
            'govph_custom_border_radius' => '',
            'govph_custom_background_color' => '',
            'govph_custom_headings_text' => '',
            'govph_custom_headings_inner_page_size' => '',
            'govph_custom_footer_background_color' => '',
            'govph_content_show_pub_date' => '',
            'govph_content_pub_date_lbl' => '',
            'govph_content_show_author' => '',
            'govph_content_pub_author_lbl' => '',
            'govph_acc_link_statement' => '',
            'govph_acc_link_home' => '',
            'govph_acc_link_main_content' => '',
            'govph_acc_link_contact' => '',
            'govph_acc_link_feedback' => '',
            'govph_acc_link_faq' => '',
            'govph_acc_link_sitemap' => '',
            'govph_acc_link_search' => '',
        ];

        // Load saved options and merge with defaults.
        $this->options = get_option('govph_options', []);
        $this->options = array_merge($this->_default_options, $this->options);

        // Register settings fields.
        $this->register_settings_fields();
    }

    /**
     * Add the theme options page to the WordPress admin menu.
     */
    public static function add_menu_page() {
        add_theme_page(
            esc_html__('Theme Options', 'gwt-wordpress'),
            esc_html__('Theme Options', 'gwt-wordpress'),
            'administrator',
            'govph-options',
            [__CLASS__, 'govph_options_page']
        );
    }

    /**
     * Render the theme options page.
     */
    public static function govph_options_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Theme Options', 'gwt-wordpress'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('govph_options_group');
                do_settings_sections(__FILE__);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register settings fields for the theme options page.
     */
    public function register_settings_fields() {
        register_setting('govph_options_group', 'govph_options');

        // General Section
        add_settings_section('govph_main_section', esc_html__('General Options', 'gwt-wordpress'), [$this, 'govph_main_section_cb'], __FILE__);

        add_settings_field('govph_disable_search', esc_html__('Disable Search Field', 'gwt-wordpress'), [$this, 'govph_disable_search'], __FILE__, 'govph_main_section');
        add_settings_field('govph_enable_widget_classic_editor', esc_html__('Enable Classic Editor on Widgets', 'gwt-wordpress'), [$this, 'govph_enable_widget_classic_editor'], __FILE__, 'govph_main_section');
        add_settings_field('govph_enable_post_classic_editor', esc_html__('Enable Classic Editor on Posts', 'gwt-wordpress'), [$this, 'govph_enable_post_classic_editor'], __FILE__, 'govph_main_section');

        // Add more settings fields here...
    }

    /**
     * Callback for the general section description.
     */
    public function govph_main_section_cb() {
        echo '<p>' . esc_html__('Configure general settings for the theme.', 'gwt-wordpress') . '</p>';
    }

    /**
     * Render the "Disable Search Field" checkbox.
     */
    public function govph_disable_search() {
        $checked = isset($this->options['govph_disable_search']) && $this->options['govph_disable_search'] === 'true' ? 'checked' : '';
        echo '<label><input type="checkbox" name="govph_options[govph_disable_search]" value="true" ' . esc_attr($checked) . '> ' . esc_html__('Disable the search field.', 'gwt-wordpress') . '</label>';
    }

    /**
     * Render the "Enable Classic Editor on Widgets" checkbox.
     */
    public function govph_enable_widget_classic_editor() {
        $checked = isset($this->options['govph_enable_widget_classic_editor']) && $this->options['govph_enable_widget_classic_editor'] === 'true' ? 'checked' : '';
        echo '<label><input type="checkbox" name="govph_options[govph_enable_widget_classic_editor]" value="true" ' . esc_attr($checked) . '> ' . esc_html__('Enable the classic editor for widgets.', 'gwt-wordpress') . '</label>';
    }

    /**
     * Render the "Enable Classic Editor on Posts" checkbox.
     */
    public function govph_enable_post_classic_editor() {
        $checked = isset($this->options['govph_enable_post_classic_editor']) && $this->options['govph_enable_post_classic_editor'] === 'true' ? 'checked' : '';
        echo '<label><input type="checkbox" name="govph_options[govph_enable_post_classic_editor]" value="true" ' . esc_attr($checked) . '> ' . esc_html__('Enable the classic editor for posts.', 'gwt-wordpress') . '</label>';
    }

    // Add more methods for rendering other settings fields...
}

// Initialize the theme options functionality.
add_action('admin_menu', ['GOVPH', 'add_menu_page']);

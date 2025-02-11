<?php
/**
 * Custom widgets for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Base widget class to reduce redundancy.
 */
abstract class GWT_Base_Widget extends WP_Widget {
    protected $default_url;
    protected $image_path;
    protected $image_alt;

    public function __construct($id_base, $name, $widget_ops, $default_url, $image_path, $image_alt) {
        parent::__construct($id_base, $name, $widget_ops);
        $this->default_url = $default_url;
        $this->image_path = $image_path;
        $this->image_alt = $image_alt;
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $url = !empty($instance['url']) ? esc_url($instance['url']) : esc_url($this->default_url);
        echo '<a href="' . $url . '">';
        echo '<img src="' . esc_url(get_template_directory_uri() . $this->image_path) . '" alt="' . esc_attr($this->image_alt) . '" title="' . esc_attr($this->image_alt) . '">';
        echo '</a>';
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['url'] = !empty($new_instance['url']) ? esc_url_raw($new_instance['url']) : $this->default_url;
        return $instance;
    }

    public function form($instance) {
        $url = !empty($instance['url']) ? esc_url($instance['url']) : esc_url($this->default_url);
        ?>
        <p style="text-align:center;">
            <img src="<?php echo esc_url(get_template_directory_uri() . $this->image_path); ?>" 
                 alt="<?php echo esc_attr($this->image_alt); ?>" 
                 title="<?php echo esc_attr($this->image_alt); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('URL:', 'gwt-wordpress'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" 
                   value="<?php echo esc_attr($url); ?>">
            <span class="description"><em><?php esc_html_e('Insert the URL of the page.', 'gwt-wordpress'); ?></em></span>
        </p>
        <?php
    }
}

/**
 * Philippine Standard Time Widget.
 */
class GWT_Widget_PST extends WP_Widget {
    public function __construct() {
        $widget_ops = [
            'classname' => 'gwt-pst-widget',
            'description' => esc_html__('A widget for displaying Philippine Standard Time.', 'gwt-wordpress'),
        ];
        parent::__construct('gwt_widget_pst', esc_html__('Philippine Standard Time', 'gwt-wordpress'), $widget_ops);
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div id="pst-container">';
        echo '<div>' . esc_html__('Philippine Standard Time:', 'gwt-wordpress') . '</div>';
        echo '<div id="pst-time"></div>';
        echo '</div>';
        echo $args['after_widget'];
    }
}

/**
 * Transparency Seal Widget.
 */
class GWT_Widget_Transparency extends GWT_Base_Widget {
    public function __construct() {
        $widget_ops = [
            'classname' => 'gwt-transparency-widget',
            'description' => esc_html__('A widget for displaying the Transparency Seal logo.', 'gwt-wordpress'),
        ];
        parent::__construct(
            'gwt_widget_transparency',
            esc_html__('Transparency Seal', 'gwt-wordpress'),
            $widget_ops,
            'http://domain.gov.ph/transparency',
            '/images/transparency-seal-160x160.png',
            esc_html__('Transparency Seal', 'gwt-wordpress')
        );
    }
}

/**
 * Freedom of Information Widget.
 */
class GWT_Widget_FOI extends GWT_Base_Widget {
    public function __construct() {
        $widget_ops = [
            'classname' => 'gwt-foi-widget',
            'description' => esc_html__('A widget for displaying the Freedom of Information logo.', 'gwt-wordpress'),
        ];
        parent::__construct(
            'gwt_widget_foi',
            esc_html__('Freedom of Information', 'gwt-wordpress'),
            $widget_ops,
            'https://www.foi.gov.ph/',
            '/images/foi-logo-160x160.png',
            esc_html__('Freedom of Information', 'gwt-wordpress')
        );
    }
}

/**
 * Register all custom widgets.
 */
function gwt_register_widgets() {
    register_widget('GWT_Widget_PST');
    register_widget('GWT_Widget_Transparency');
    register_widget('GWT_Widget_FOI');
}
add_action('widgets_init', 'gwt_register_widgets');

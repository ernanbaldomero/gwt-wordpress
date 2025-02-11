<?php
/**
 * The header for the theme.
 *
 * @package GWT
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#main-content"><?php _e('Skip to Content', 'gwt_wp'); ?></a>
    <a class="skip-link screen-reader-text" href="#footer"><?php _e('Skip to Footer', 'gwt_wp'); ?></a>

    <header id="site-header" role="banner">
        <div class="site-branding">
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <p class="site-description"><?php bloginfo('description'); ?></p>
        </div>

        <nav id="site-navigation" role="navigation" aria-label="<?php esc_attr_e('Main Menu', 'gwt_wp'); ?>">
            <?php
            if (has_nav_menu('topbar_left')) {
                wp_nav_menu(array(
                    'theme_location' => 'topbar_left',
                    'items_wrap' => '%3$s',
                    'container' => false,
                    'fallback_cb' => false,
                    'walker' => new Off_Canvass_Menu(),
                ));
            }
            if (has_nav_menu('topbar_right')) {
                wp_nav_menu(array(
                    'theme_location' => 'topbar_right',
                    'items_wrap' => '%3$s',
                    'container' => false,
                    'fallback_cb' => false,
                    'walker' => new Topbar_Nav_Menu(),
                ));
            }
            ?>
        </nav>

        <div class="accessibility-controls">
            <button id="toggle-accessibility" aria-expanded="false" aria-controls="accessibility-dialog">
                <?php _e('Accessibility Statement', 'gwt_wp'); ?>
            </button>
            <button id="toggle-contrast" aria-pressed="false">
                <?php _e('High Contrast', 'gwt_wp'); ?>
            </button>
            <button id="reset-text-size" aria-pressed="false">
                <?php _e('Default Text Size', 'gwt_wp'); ?>
            </button>
            <button id="reduce-text-size" aria-pressed="false">
                <?php _e('Reduce Text Size', 'gwt_wp'); ?>
            </button>
            <button id="enlarge-text-size" aria-pressed="false">
                <?php _e('Enlarge Text Size', 'gwt_wp'); ?>
            </button>
        </div>
    </header>

    <div id="accessibility-dialog" role="dialog" aria-labelledby="accessibility-dialog-title" hidden>
        <h2 id="accessibility-dialog-title"><?php _e('Accessibility Features', 'gwt_wp'); ?></h2>
        <p><?php _e('Use the following shortcut keys for navigation:', 'gwt_wp'); ?></p>
        <ul>
            <li><strong>Combination + 0:</strong> <?php _e('Accessibility Statement', 'gwt_wp'); ?></li>
            <li><strong>Combination + H:</strong> <?php _e('Home Page', 'gwt_wp'); ?></li>
            <li><strong>Combination + R:</strong> <?php _e('Main Content', 'gwt_wp'); ?></li>
            <li><strong>Combination + Q:</strong> <?php _e('FAQ', 'gwt_wp'); ?></li>
            <li><strong>Combination + C:</strong> <?php _e('Contact', 'gwt_wp'); ?></li>
            <li><strong>Combination + K:</strong> <?php _e('Feedback', 'gwt_wp'); ?></li>
            <li><strong>Combination + M:</strong> <?php _e('Site Map', 'gwt_wp'); ?></li>
            <li><strong>Combination + S:</strong> <?php _e('Search', 'gwt_wp'); ?></li>
        </ul>
        <button id="close-dialog" aria-label="<?php esc_attr_e('Close Dialog', 'gwt_wp'); ?>">
            <?php _e('Close', 'gwt_wp'); ?>
        </button>
    </div>

    <main id="main-content" role="main">

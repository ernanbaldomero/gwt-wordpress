<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gwt_wp
 */

$panel_top_areas = array('panel-top-1', 'panel-top-2', 'panel-top-3', 'panel-top-4');
$has_active_sidebar = false;

foreach ($panel_top_areas as $panel) {
    if (is_active_sidebar($panel)) {
        $has_active_sidebar = true;
        break;
    }
}

if ($has_active_sidebar) : ?>
    <div id="panel-top" class="anchor" role="complementary">
        <div class="row">
            <?php foreach ($panel_top_areas as $panel) : ?>
                <?php if (is_active_sidebar($panel)) : ?>
                    <aside id="<?php echo esc_attr($panel); ?>" 
                           class="<?php echo function_exists('govph_displayoptions') ? govph_displayoptions('govph_position_panel_top') : ''; ?>" 
                           role="complementary" 
                           aria-label="<?php esc_attr_e('Top Panel ' . substr($panel, -1), 'gwt_wp'); ?>" 
                           itemscope itemtype="https://schema.org/WPSideBar">
                        <?php do_action('before_sidebar'); ?>
                        <?php dynamic_sidebar($panel); ?>
                    </aside>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <div id="panel-top" class="anchor" role="complementary">
        <p><?php _e('No widgets added to the top panels.', 'gwt_wp'); ?></p>
    </div>
<?php endif; ?>

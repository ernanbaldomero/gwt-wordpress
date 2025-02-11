<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gwt_wp
 */

if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
    <aside id="sidebar-left" 
           class="<?php echo function_exists( 'govph_displayoptions' ) ? govph_displayoptions( 'govph_sidebar_position_left' ) : ''; ?> columns" 
           role="complementary" 
           aria-label="<?php esc_attr_e( 'Left Sidebar', 'gwt_wp' ); ?>" 
           itemscope itemtype="https://schema.org/WPSideBar">
        <?php do_action( 'before_sidebar' ); ?>
        <?php dynamic_sidebar( 'left-sidebar' ); ?>
    </aside>
<?php else : ?>
    <aside id="sidebar-left" class="columns" role="complementary" aria-label="<?php esc_attr_e( 'Left Sidebar', 'gwt_wp' ); ?>">
        <p><?php _e( 'No widgets added to the left sidebar.', 'gwt_wp' ); ?></p>
    </aside>
<?php endif; ?>

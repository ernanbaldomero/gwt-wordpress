<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gwt_wp
 */

if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
    <aside id="sidebar-right" 
           class="<?php echo function_exists( 'govph_displayoptions' ) ? govph_displayoptions( 'govph_sidebar_position_right' ) : ''; ?> columns" 
           role="complementary" 
           aria-label="<?php esc_attr_e( 'Right Sidebar', 'gwt_wp' ); ?>" 
           itemscope itemtype="https://schema.org/WPSideBar">
        <?php do_action( 'before_sidebar' ); ?>
        <?php dynamic_sidebar( 'right-sidebar' ); ?>
    </aside>
<?php else : ?>
    <aside id="sidebar-right" class="columns" role="complementary" aria-label="<?php esc_attr_e( 'Right Sidebar', 'gwt_wp' ); ?>">
        <p><?php _e( 'No widgets added to the right sidebar.', 'gwt_wp' ); ?></p>
    </aside>
<?php endif; ?>

<?php
/**
 * The template for displaying search forms in gwt_wp
 *
 * @package GWT
 * @since Government Website Template 2.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Site Search', 'gwt_wp' ); ?>" itemscope itemtype="https://schema.org/SearchAction">
    <meta itemprop="target" content="<?php echo esc_url( home_url( '/?s={s}' ) ); ?>">
    <input type="search" class="search-field" itemprop="query-input"
        placeholder="<?php echo esc_attr_x( 'Enter your search term...', 'placeholder', 'gwt_wp' ); ?>"
        value="<?php echo esc_attr( get_search_query() ); ?>" name="s"
        title="<?php _ex( 'Search for:', 'label', 'gwt_wp' ); ?>">
    <button type="submit" class="search-submit" itemprop="action">
        <?php echo esc_html__( 'Search', 'gwt_wp' ); ?>
    </button>
</form>

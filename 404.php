<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

get_header();
?>

<div id="main-content" class="row container-main" role="main">
    <div class="large-12 medium-12 columns">
        <div class="notfound" role="region" aria-labelledby="notfound-title">
            <!-- Page Title -->
            <h1 id="notfound-title" class="page-title">
                <?php _e( 'Sorry, the page you are looking for cannot be found', 'gwt_wp' ); ?>
            </h1>

            <!-- Page Content -->
            <div class="page-content notfound">
                <p>
                    <?php _e( 'The page you requested may have been moved to a new location or removed from the site.', 'gwt_wp' ); ?>
                    <br>
                    <?php _e( 'You can go back to the', 'gwt_wp' ); ?> 
                    <a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'HOME PAGE', 'gwt_wp' ); ?></a> 
                    <?php _e( 'or find what you are looking for using the search box below.', 'gwt_wp' ); ?>
                </p>

                <!-- Optional: Sitemap Link -->
                <?php if ( get_page_by_path('sitemap') ) : ?>
                    <p>
                        <?php _e( 'Alternatively, you can browse our', 'gwt_wp' ); ?> 
                        <a href="<?php echo esc_url( home_url('/sitemap') ); ?>"><?php _e( 'site map', 'gwt_wp' ); ?></a>.
                    </p>
                <?php endif; ?>

                <!-- Search Form -->
                <aside class="search-404">
                    <?php get_search_form(); ?>
                </aside>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>

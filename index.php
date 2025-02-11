<?php
/**
 * The main template file
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

get_header();
include_once('inc/banner.php');
?>

<?php
if ( function_exists( 'govph_displayoptions' ) ) {
    govph_displayoptions( 'govph_panel_top' );
}
?>

<div class="container-main" role="main" itemscope itemtype="https://schema.org/WebPage">
    <div id="main-content" class="row">
        <div id="content" class="text-justify <?php govph_displayoptions( 'govph_content_position' ); ?> columns" role="main">
            <?php if ( have_posts() ) : ?>
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );
                endwhile;

                // Pagination.
                the_posts_navigation();
                ?>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'index' ); ?>
            <?php endif; ?>
        </div><!-- #content -->

        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
            <div id="left-sidebar" class="sidebar" role="complementary">
                <?php dynamic_sidebar( 'left-sidebar' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
            <div id="right-sidebar" class="sidebar" role="complementary">
                <?php dynamic_sidebar( 'right-sidebar' ); ?>
            </div>
        <?php endif; ?>
    </div><!-- .row -->
</div><!-- .container-main -->

<?php
if ( function_exists( 'govph_displayoptions' ) ) {
    govph_displayoptions( 'govph_panel_bottom' );
}
?>

<?php get_footer(); ?>

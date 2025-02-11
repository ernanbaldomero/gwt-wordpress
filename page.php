<?php
/**
 * The template for displaying all pages.
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

<div id="main-content" class="container-main" role="main" itemscope itemtype="https://schema.org/WebPage">
    <div class="row">
        <div id="content" class="text-justify <?php govph_displayoptions( 'govph_content_position' ); ?> columns" role="main">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'page' );
            endwhile; // End of the loop.
            ?>
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
</div><!-- #main-content -->

<?php
if ( function_exists( 'govph_displayoptions' ) ) {
    govph_displayoptions( 'govph_panel_bottom' );
}
?>

<?php get_footer(); ?>

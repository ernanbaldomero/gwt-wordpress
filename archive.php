<?php
/**
 * The template for displaying archive pages.
 *
 * @package GWT
 * @since Government Website Template 2.0
 */

get_header();
include_once('inc/banner.php');
?>

<?php govph_displayoptions( 'govph_panel_top' ); ?>

<div id="container-main" class="container-main" role="document">
    <div id="main-content" class="row" role="main" itemscope itemtype="https://schema.org/CollectionPage">
        <div id="content" class="text-justify <?php govph_displayoptions( 'govph_content_position' ); ?> columns" role="main">
            <header>
                <h1 class="page-title">
                    <?php
                    if ( is_category() ) {
                        single_cat_title();
                    } elseif ( is_tag() ) {
                        single_tag_title();
                    } elseif ( is_author() ) {
                        the_post();
                        printf( __( 'Author: %s', 'gwt_wp' ), '<span class="vcard">' . get_the_author() . '</span>' );
                        rewind_posts();
                    } elseif ( is_day() ) {
                        printf( __( 'Day: %s', 'gwt_wp' ), '<span>' . get_the_date() . '</span>' );
                    } elseif ( is_month() ) {
                        printf( __( 'Month: %s', 'gwt_wp' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
                    } elseif ( is_year() ) {
                        printf( __( 'Year: %s', 'gwt_wp' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
                    } elseif ( is_tax( 'post_format' ) ) {
                        _e( ucfirst( str_replace( 'post-format-', '', get_queried_object()->slug ) ), 'gwt_wp' );
                    } else {
                        _e( 'Archives', 'gwt_wp' );
                    }
                    ?>
                </h1>

                <?php
                // Show an optional term description.
                $term_description = term_description();
                if ( ! empty( $term_description ) ) :
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                endif;
                ?>
            </header>

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                    // Include the Post-Format-specific template for the content.
                    get_template_part( 'template-parts/content', get_post_format() );
                    ?>
                <?php endwhile; ?>

                <?php the_posts_navigation(); ?>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'archive' ); ?>
            <?php endif; ?>
        </div><!-- #content -->

        <?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
            <div id="left-sidebar" class="sidebar">
                <?php dynamic_sidebar( 'left-sidebar' ); ?>
            </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
            <div id="right-sidebar" class="sidebar">
                <?php dynamic_sidebar( 'right-sidebar' ); ?>
            </div>
        <?php endif; ?>
    </div><!-- #main -->
</div><!-- #primary -->

<?php govph_displayoptions( 'govph_panel_bottom' ); ?>
<?php get_footer(); ?>

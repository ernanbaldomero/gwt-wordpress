<?php
/**
 * Template part for displaying page content.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('gwt-page'); ?> aria-labelledby="page-title-<?php the_ID(); ?>">
    <!-- Page Title -->
    <header class="gwt-page-header">
        <h1 id="page-title-<?php the_ID(); ?>" class="gwt-page-title">
            <?php the_title(); ?>
        </h1>
    </header>

    <!-- Page Content -->
    <div class="gwt-entry-content">
        <?php
        // Display the page content.
        the_content();

        // Paginate long pages.
        wp_link_pages([
            'before' => '<nav class="gwt-page-links" aria-label="' . esc_attr__('Page Navigation', 'gwt-wordpress') . '">' . __('Pages:', 'gwt-wordpress'),
            'after'  => '</nav>',
            'link_before' => '<span class="gwt-page-link">',
            'link_after'  => '</span>',
        ]);
        ?>
    </div>
</article>

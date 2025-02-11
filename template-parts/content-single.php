<?php
/**
 * Template part for displaying single post content.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('gwt-single-post'); ?> aria-labelledby="single-title-<?php the_ID(); ?>">
    <!-- Entry Header -->
    <header class="gwt-entry-header">
        <h1 id="single-title-<?php the_ID(); ?>" class="gwt-entry-title">
            <?php the_title(); ?>
        </h1>
        <div class="gwt-entry-meta" role="note">
            <?php gwt_wp_posted_on(); ?>
        </div>
    </header>

    <!-- Entry Content -->
    <div class="gwt-entry-content">
        <?php
        // Display the post content.
        the_content();

        // Paginate long posts.
        wp_link_pages([
            'before' => '<nav class="gwt-page-links" aria-label="' . esc_attr__('Page Navigation', 'gwt-wordpress') . '">' . __('Pages:', 'gwt-wordpress'),
            'after'  => '</nav>',
            'link_before' => '<span class="gwt-page-link">',
            'link_after'  => '</span>',
        ]);
        ?>
    </div>

    <!-- Entry Footer -->
    <footer class="gwt-entry-footer">
        <?php if ('post' === get_post_type()) : ?>
            <div class="gwt-entry-meta">
                <?php
                // Display categories and tags for posts.
                $categories_list = get_the_category_list(esc_html__(', ', 'gwt-wordpress'));
                if ($categories_list) {
                    printf('<span class="gwt-categories">%s: %s</span>', esc_html__('Categories', 'gwt-wordpress'), $categories_list);
                }

                $tags_list = get_the_tag_list('', esc_html__(', ', 'gwt-wordpress'));
                if ($tags_list) {
                    printf('<span class="gwt-tags">%s: %s</span>', esc_html__('Tags', 'gwt-wordpress'), $tags_list);
                }
                ?>
            </div>
        <?php endif; ?>
    </footer>
</article>

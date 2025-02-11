<?php
/**
 * Template part for displaying posts in archives, search results, and blog pages.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
?>
<div class="gwt-post-box">
    <article id="post-<?php the_ID(); ?>" <?php post_class('gwt-callout gwt-secondary'); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
        <!-- Post Thumbnail -->
        <div class="gwt-post-thumbnail">
            <?php
            // Determine thumbnail size based on sidebar configuration.
            $thumbnail_size = 'full';
            if (has_post_thumbnail()) {
                if (is_active_sidebar('left-sidebar') && is_active_sidebar('right-sidebar')) {
                    $thumbnail_size = 'large';
                }
                the_post_thumbnail($thumbnail_size, ['class' => 'gwt-thumbnail']);
            }
            ?>
        </div>

        <!-- Post Content -->
        <div class="gwt-entry-wrapper gwt-large-12 gwt-medium-12 gwt-small-12">
            <!-- Entry Header -->
            <header class="gwt-entry-header">
                <h2 id="post-title-<?php the_ID(); ?>" class="gwt-entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                <?php if ('post' === get_post_type()) : ?>
                    <div class="gwt-entry-meta" role="note">
                        <?php gwt_wp_posted_on(); ?>
                    </div>
                <?php endif; ?>
            </header>

            <!-- Entry Summary -->
            <div class="gwt-entry-summary">
                <?php
                // Display excerpt for search results or archive pages.
                the_excerpt();

                // Add "Read More" link.
                printf(
                    '<p><a href="%s" class="gwt-read-more">%s</a></p>',
                    esc_url(get_permalink()),
                    esc_html__('Read More', 'gwt-wordpress')
                );
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
        </div>
    </article>
</div>

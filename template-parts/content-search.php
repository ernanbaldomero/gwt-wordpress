<?php
/**
 * Template part for displaying search results.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
?>
<div class="gwt-post-box">
    <article id="post-<?php the_ID(); ?>" <?php post_class('gwt-callout gwt-secondary'); ?> aria-labelledby="search-title-<?php the_ID(); ?>">
        <?php
        // Determine content width based on thumbnail and sidebars.
        $has_thumbnail = has_post_thumbnail();
        $content_class = 'gwt-large-12';
        if ($has_thumbnail) {
            $content_class = 'gwt-large-9';
        }
        if ($has_thumbnail && is_active_sidebar('left-sidebar') && is_active_sidebar('right-sidebar')) {
            $content_class = 'gwt-large-12';
        }

        // Display post thumbnail if available.
        if ($has_thumbnail) :
            the_post_thumbnail('large', ['class' => 'gwt-thumbnail']);
        endif;
        ?>
        <div class="gwt-entry-wrapper <?php echo esc_attr($content_class); ?> gwt-medium-12 gwt-small-12">
            <!-- Entry Header -->
            <header class="gwt-entry-header">
                <h2 id="search-title-<?php the_ID(); ?>" class="gwt-entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                <div class="gwt-entry-meta" role="note">
                    <?php gwt_wp_posted_on(); ?>
                </div>
            </header>

            <!-- Entry Summary -->
            <div class="gwt-entry-summary">
                <?php
                // Display excerpt for search results.
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

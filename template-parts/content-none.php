<?php
/**
 * Template part for displaying a message when no posts or content are found.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */
?>
<section class="gwt-no-results not-found" aria-label="<?php esc_attr_e('No Results Found', 'gwt-wordpress'); ?>">
    <header class="gwt-page-header">
        <h1 class="gwt-page-title"><?php esc_html_e('No Results Found', 'gwt-wordpress'); ?></h1>
    </header>

    <div class="gwt-page-content">
        <?php if (is_home() && current_user_can('publish_posts')) : ?>
            <p>
                <?php
                printf(
                    /* translators: %s: URL to create a new post. */
                    esc_html__('Ready to publish your first post? <a href="%s">Get started here</a>.', 'gwt-wordpress'),
                    esc_url(admin_url('post-new.php'))
                );
                ?>
            </p>
        <?php elseif (is_search()) : ?>
            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gwt-wordpress'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('It seems we can’t find what you’re looking for. Perhaps searching can help.', 'gwt-wordpress'); ?></p>
            <?php if (function_exists('get_search_form')) : ?>
                <?php get_search_form(); ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

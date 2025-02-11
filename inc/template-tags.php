<?php
/**
 * Custom template tags for GWT-WordPress.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

if (!function_exists('gwt_content_nav')) :
/**
 * Display navigation to next/previous pages when applicable.
 */
function gwt_content_nav($nav_id) {
    global $wp_query, $post;

    // Don't print empty markup on single pages if there's nowhere to navigate.
    if (is_single()) {
        $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);
        if (!$next && !$previous) {
            return;
        }
    }

    // Don't print empty markup in archives if there's only one page.
    if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search())) {
        return;
    }

    $nav_class = (is_single()) ? 'gwt-post-navigation' : 'gwt-paging-navigation';
    ?>
    <nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo esc_attr($nav_class); ?>">
        <h4><?php esc_html_e('Post navigation', 'gwt-wordpress'); ?></h4>
        <label class="show-for-sr"><?php esc_html_e('Post navigation', 'gwt-wordpress'); ?></label>
        <?php if (is_single()) : // Navigation links for single posts ?>
            <?php previous_post_link('<div class="gwt-nav-previous">%link</div>', '<span class="meta-nav">' . esc_html_x('&larr;', 'Previous post link', 'gwt-wordpress') . '</span> %title'); ?>
            <?php next_post_link('<div class="gwt-nav-next">%link</div>', '%title <span class="meta-nav">' . esc_html_x('&rarr;', 'Next post link', 'gwt-wordpress') . '</span>'); ?>
        <?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // Navigation links for home, archive, and search pages ?>
            <?php if (get_next_posts_link()) : ?>
                <div class="gwt-nav-previous">
                    <?php next_posts_link(esc_html__('Older posts <span class="meta-nav">&larr;</span>', 'gwt-wordpress')); ?>
                </div>
            <?php endif; ?>
            <?php if (get_previous_posts_link()) : ?>
                <div class="gwt-nav-next">
                    <?php previous_posts_link(esc_html__('Newer posts <span class="meta-nav">&rarr;</span>', 'gwt-wordpress')); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </nav><!-- #<?php echo esc_html($nav_id); ?> -->
<?php
}
endif; // gwt_content_nav

if (!function_exists('gwt_comment')) :
/**
 * Template for comments and pingbacks.
 */
function gwt_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <div class="gwt-comment-body">
                <?php esc_html_e('Pingback:', 'gwt-wordpress'); ?> <?php comment_author_link(); ?>
                <?php edit_comment_link(esc_html__('Edit', 'gwt-wordpress'), '<span class="edit-link">', '</span>'); ?>
            </div>
    <?php else : ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="gwt-comment-body">
                <footer class="gwt-comment-meta">
                    <div class="gwt-comment-author">
                        <?php if (0 !== $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                        <?php printf(esc_html__('%s <span class="says">says:</span>', 'gwt-wordpress'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
                    </div><!-- .gwt-comment-author -->
                    <div class="gwt-comment-metadata">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php printf(esc_html_x('%1$s at %2$s', '1: date, 2: time', 'gwt-wordpress'), get_comment_date(), get_comment_time()); ?>
                            </time>
                        </a>
                        <?php edit_comment_link(esc_html__('Edit', 'gwt-wordpress'), '<span class="edit-link">', '</span>'); ?>
                    </div><!-- .gwt-comment-metadata -->
                    <?php if ('0' === $comment->comment_approved) : ?>
                        <p class="gwt-comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'gwt-wordpress'); ?></p>
                    <?php endif; ?>
                </footer><!-- .gwt-comment-meta -->
                <div class="gwt-comment-content">
                    <?php comment_text(); ?>
                </div><!-- .gwt-comment-content -->
                <div class="gwt-reply">
                    <?php comment_reply_link(array_merge($args, ['add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']])); ?>
                </div><!-- .gwt-reply -->
            </article><!-- .gwt-comment-body -->
    <?php endif;
}
endif; // gwt_comment

if (!function_exists('gwt_the_attached_image')) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function gwt_the_attached_image() {
    $post = get_post();
    $attachment_size = apply_filters('gwt_attachment_size', [1200, 1200]);
    $next_attachment_url = wp_get_attachment_url();

    // Get all image attachments in a gallery.
    $attachment_ids = get_posts([
        'post_parent'    => $post->post_parent,
        'fields'         => 'ids',
        'numberposts'    => -1,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID',
    ]);

    // If there is more than 1 attachment in a gallery...
    if (count($attachment_ids) > 1) {
        foreach ($attachment_ids as $attachment_id) {
            if ($attachment_id === $post->ID) {
                $next_id = current($attachment_ids);
                break;
            }
        }
        // Get the URL of the next image attachment or the first image.
        $next_attachment_url = $next_id ? get_attachment_link($next_id) : get_attachment_link(array_shift($attachment_ids));
    }

    printf(
        '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
        esc_url($next_attachment_url),
        esc_attr(get_the_title()),
        wp_get_attachment_image($post->ID, $attachment_size)
    );
}
endif;

if (!function_exists('gwt_posted_on')) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gwt_posted_on() {
    $published_date = '';
    $author = '';

    if (govph_displayoptions('govph_content_show_pub_date') === 'true') {
        $default_publish_label = govph_displayoptions('govph_content_pub_date_lbl') ?: esc_html__('Posted on', 'gwt-wordpress');
        $published_date = sprintf(
            '%4$s <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published" datetime="%3$s">%3$s</time></a>',
            esc_url(get_permalink()),
            esc_attr(get_the_time()),
            esc_html(get_the_date()),
            esc_html($default_publish_label)
        );
    }

    if (govph_displayoptions('govph_content_show_author') === 'true') {
        $default_author_label = govph_displayoptions('govph_content_pub_author_lbl') ?: esc_html__('by', 'gwt-wordpress');
        $author = sprintf(
            '%4$s <span class="author"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_attr(sprintf(__('View all posts by %s', 'gwt-wordpress'), get_the_author())),
            esc_html(get_the_author()),
            esc_html($default_author_label)
        );
    }

    printf(
        '<span class="gwt-posted-on">%1$s</span><span class="gwt-byline">%2$s</span>',
        $published_date,
        $author
    );
}
endif;

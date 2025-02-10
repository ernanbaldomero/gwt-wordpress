<?php
/**
 * The template for displaying Comments.
 *
 * @package gwt_wp
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" role="region" aria-labelledby="comments-title">

    <?php if ( have_comments() ) : ?>
        <h2 id="comments-title" class="comments-title">
            <?php
            printf(
                _nx(
                    'One thought on &ldquo;%2$s&rdquo;',
                    '%1$s thoughts on &ldquo;%2$s&rdquo;',
                    get_comments_number(),
                    'comments title',
                    'gwt_wp'
                ),
                number_format_i18n( get_comments_number() ),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'gwt_wp' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gwt_wp' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gwt_wp' ) ); ?></div>
            </nav>
        <?php endif; ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'callback' => 'gwt_wp_comment',
                )
            );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'gwt_wp' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gwt_wp' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gwt_wp' ) ); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'gwt_wp' ); ?></p>
    <?php endif; ?>

    <?php
    $comment_form_args = array(
        'title_reply'         => __( 'Leave a Reply', 'gwt_wp' ),
        'label_submit'        => __( 'Post Comment', 'gwt_wp' ),
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
    );
    comment_form( $comment_form_args );
    ?>

</div><!-- #comments -->

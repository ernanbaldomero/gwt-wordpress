<?php
/**
 * Restrict access to the WordPress REST API to logged-in users only.
 *
 * @package GWT-WordPress
 * @since 26.0.0
 */

/**
 * Filter REST API authentication errors to require login.
 *
 * @param WP_Error|mixed $result The result of the REST API authentication.
 * @return WP_Error|mixed The modified result or an error if the user is not logged in.
 */
function gwt_restrict_rest_api($result) {
    // If there's already an error, return it.
    if (!empty($result)) {
        return $result;
    }

    // Allow access only to logged-in users.
    if (!is_user_logged_in()) {
        return new WP_Error(
            'gwt_rest_restricted',
            esc_html__('Sorry, you must be logged in to make a request.', 'gwt-wordpress'),
            ['status' => 401]
        );
    }

    return $result;
}
add_filter('rest_authentication_errors', 'gwt_restrict_rest_api');

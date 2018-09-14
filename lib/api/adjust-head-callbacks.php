<?php
/**
 * Adjusts the registered callbacks that output code into the <head> tag.
 * Primarily, adjusts callbacks to the `wp-head` event.
 *
 * @package Beans\Framework\API
 *
 * @since   1.6.0
 */
add_action( 'get_header', 'beans_adjust_head_callbacks', 150 );
/**
 * Adjust the callbacks outputting code into the `<head>` tag.
 *
 * The configuration array requires the first element to be the callback to be removed.
 * A priority can be passed as second element.
 * If the callback is not registered to `wp_head`, the hook can be passed as third element.
 *
 * @since 1.0.0
 *
 * @return void
 */
function beans_adjust_head_callbacks() {
	$callbacks_to_remove = array(
		array( 'adjacent_posts_rel_link_wp_head' ),
		array( 'print_emoji_detection_script', 7 ),
		array( 'print_emoji_styles', null, 'wp_print_styles' ),
		array( 'rsd_link' ),
		array( 'wlwmanifest_link' ),
		array( 'wp_generator' ),
		array( 'wp_shortlink_wp_head' ),
	);
	if ( ( is_single() && get_option( 'beans_post_comments_disabled', false ) )
	     || ( is_page() && get_option( 'beans_page_comments_disabled', false ) ) ) {
		$callbacks_to_remove[] = array( 'feed_links_extra', 3 );
	}
	/**
	 * Filter for adjusting the callbacks that are going to be removed.
	 *
	 * Return an empty array or pass `__return_false` to the filter to prevent changes to the output.
	 *
	 * @since 1.0.0
	 *
	 * @param array $callback_to_remove Array of callbacks to unregister.
	 */
	$callbacks_to_remove = (array) apply_filters( 'beans_adjust_head_callbacks', $callbacks_to_remove );
	foreach ( $callbacks_to_remove as $remove_callback ) {
		remove_action( isset( $remove_callback[2] ) ? $remove_callback[2] : 'wp_head', $remove_callback[0], isset( $remove_callback[1] ) ? $remove_callback[1] : 10 );
	}
}

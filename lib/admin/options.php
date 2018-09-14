<?php
/**
 * Add Theseus admin options.
 *
 * @package PrometheusDigital\Theseus\Admin
 *
 * @since   1.0.0
 */

beans_add_smart_action( 'admin_init', 'beans_do_register_term_meta' );
/**
 * Add Theseus term meta.
 *
 * @since 1.0.0
 *
 * @return void
 */
function beans_do_register_term_meta() {
	// Get layout option without default for the count.
	$options = beans_get_layouts_for_options();

	// Stop here if there is less than two layouts options.
	if ( count( $options ) < 2 ) {
		return;
	}

	$fields = [
		[
			'id'      => 'beans_layout',
			'label'   => _x( 'Layout', 'term meta', 'tm-beans' ),
			'type'    => 'radio',
			'default' => 'default_fallback',
			'options' => beans_get_layouts_for_options( true ),
		],
	];

	beans_register_term_meta( $fields, [ 'category', 'post_tag' ], 'tm-beans' );
}

beans_add_smart_action( 'admin_init', 'beans_do_register_post_meta' );
/**
 * Add Theseus post meta.
 *
 * @since 1.0.0
 *
 * @return void
 */
function beans_do_register_post_meta() {
	// Get layout option without default for the count.
	$options = beans_get_layouts_for_options();

	// Stop here if there are less than two layout options.
	if ( count( $options ) < 2 ) {
		return;
	}

	$fields = [
		[
			'id'      => 'beans_layout',
			'label'   => _x( 'Layout', 'post meta', 'tm-beans' ),
			'type'    => 'radio',
			'default' => 'default_fallback',
			'options' => beans_get_layouts_for_options( true ),
		],
	];

	beans_register_post_meta( $fields, [ 'post', 'page' ], 'tm-beans', [ 'title' => __( 'Post Options', 'tm-beans' ) ] );
}

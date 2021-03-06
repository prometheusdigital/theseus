<?php
/**
 * Echo the posts loop structural markup. It also calls the loop action hooks.
 *
 * @package PrometheusDigital\Theseus\Templates\Structure
 *
 * @since   1.0.0
 */

/**
 * Fires before the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
do_action( 'beans_before_loop' );
	// phpcs:disable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup.
	if ( have_posts() && ! is_404() ) :

		/**
		 * Fires before posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'beans_before_posts_loop' );

		while ( have_posts() ) :
			the_post();

			$article_attributes = [
				'id'        => get_the_ID(), // Automatically escaped.
				'class'     => implode( ' ', get_post_class( [ 'uk-article', ( current_theme_supports( 'beans-default-styling' ) ? 'uk-panel-box' : null ) ] ) ), // Automatically escaped.
				'itemscope' => 'itemscope',
				'itemtype'  => 'https://schema.org/CreativeWork',
			];

			beans_open_markup_e( 'beans_post', 'article', $article_attributes );

				beans_open_markup_e( 'beans_post_header', 'header' );

					/**
					 * Fires in the post header.
					 *
					 * @since 1.0.0
					 */
					do_action( 'beans_post_header' );

				beans_close_markup_e( 'beans_post_header', 'header' );

				beans_open_markup_e( 'beans_post_body', 'div', [ 'itemprop' => 'articleBody' ] );

					/**
					 * Fires in the post body.
					 *
					 * @since 1.0.0
					 */
					do_action( 'beans_post_body' );

				beans_close_markup_e( 'beans_post_body', 'div' );

			beans_close_markup_e( 'beans_post', 'article' );
		endwhile;

		/**
		 * Fires after the posts loop.
		 *
		 * This hook fires if posts exist.
		 *
		 * @since 1.0.0
		 */
		do_action( 'beans_after_posts_loop' );
	else :

			/**
			 * Fires if no posts exist.
			 *
			 * @since 1.0.0
			 */
			do_action( 'beans_no_post' );
	endif;

/**
 * Fires after the loop.
 *
 * This hook fires even if no post exists.
 *
 * @since 1.0.0
 */
	do_action( 'beans_after_loop' );
// phpcs:enable Generic.WhiteSpace.ScopeIndent -- Code structure mirrors HTML markup.

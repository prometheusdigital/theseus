<?php
/**
 * Prepare and initialize the Theseus framework.
 *
 * @package PrometheusDigital\Theseus
 *
 * @since   1.0.0
 */

add_action( 'beans_init', 'beans_define_constants', -1 );
/**
 * Define constants.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function beans_define_constants() {
	// Define version.
	define( 'THESEUS_VERSION', '1.0.0' );

	// Define paths.
	if ( ! defined( 'THESEUS_THEME_PATH' ) ) {
		define( 'THESEUS_THEME_PATH', wp_normalize_path( trailingslashit( get_template_directory() ) ) );
	}

	define( 'THESEUS_PATH', THESEUS_THEME_PATH . 'lib/' );
	define( 'THESEUS_API_PATH', THESEUS_PATH . 'api/' );
	define( 'THESEUS_ASSETS_PATH', THESEUS_PATH . 'assets/' );
	define( 'THESEUS_LANGUAGES_PATH', THESEUS_PATH . 'languages/' );
	define( 'THESEUS_RENDER_PATH', THESEUS_PATH . 'render/' );
	define( 'THESEUS_TEMPLATES_PATH', THESEUS_PATH . 'templates/' );
	define( 'THESEUS_STRUCTURE_PATH', THESEUS_TEMPLATES_PATH . 'structure/' );
	define( 'THESEUS_FRAGMENTS_PATH', THESEUS_TEMPLATES_PATH . 'fragments/' );

	// Define urls.
	if ( ! defined( 'THESEUS_THEME_URL' ) ) {
		define( 'THESEUS_THEME_URL', trailingslashit( get_template_directory_uri() ) );
	}

	define( 'THESEUS_URL', THESEUS_THEME_URL . 'lib/' );
	define( 'THESEUS_API_URL', THESEUS_URL . 'api/' );
	define( 'THESEUS_ASSETS_URL', THESEUS_URL . 'assets/' );
	define( 'THESEUS_LESS_URL', THESEUS_ASSETS_URL . 'less/' );
	define( 'THESEUS_JS_URL', THESEUS_ASSETS_URL . 'js/' );
	define( 'THESEUS_IMAGE_URL', THESEUS_ASSETS_URL . 'images/' );

	// Define admin paths.
	define( 'THESEUS_ADMIN_PATH', THESEUS_PATH . 'admin/' );

	// Define admin url.
	define( 'THESEUS_ADMIN_URL', THESEUS_URL . 'admin/' );
	define( 'THESEUS_ADMIN_ASSETS_URL', THESEUS_ADMIN_URL . 'assets/' );
	define( 'THESEUS_ADMIN_JS_URL', THESEUS_ADMIN_ASSETS_URL . 'js/' );
}

add_action( 'beans_init', 'beans_load_dependencies', -1 );
/**
 * Load dependencies.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function beans_load_dependencies() {
	require_once THESEUS_API_PATH . 'init.php';

	// Load the necessary Theseus components.
	beans_load_api_components( [
		'actions',
		'html',
		'term-meta',
		'post-meta',
		'image',
		'wp-customize',
		'compiler',
		'uikit',
		'template',
		'layout',
		'widget',
	] );

	// Add third party styles and scripts compiler support.
	beans_add_api_component_support( 'wp_styles_compiler' );
	beans_add_api_component_support( 'wp_scripts_compiler' );

	/**
	 * Fires after Theseus API loads.
	 *
	 * @since 1.0.0
	 */
	do_action( 'beans_after_load_api' );
}

add_action( 'beans_init', 'beans_add_theme_support' );
/**
 * Add theme support.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function beans_add_theme_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
	add_theme_support( 'custom-header', [
		'width'       => 2000,
		'height'      => 500,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => false,
	] );

	// Theseus specific.
	add_theme_support( 'offcanvas-menu' );
	add_theme_support( 'beans-default-styling' );
}

add_action( 'beans_init', 'beans_includes' );
/**
 * Include framework files.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function beans_includes() {

	// Include admin.
	if ( is_admin() ) {
		require_once THESEUS_ADMIN_PATH . 'options.php';
		require_once THESEUS_ADMIN_PATH . 'updater.php';
	}

	// Include assets.
	require_once THESEUS_ASSETS_PATH . 'assets.php';

	// Include customizer.
	if ( is_customize_preview() ) {
		require_once THESEUS_ADMIN_PATH . 'wp-customize.php';
	}

	// Include renderers.
	require_once THESEUS_RENDER_PATH . 'template-parts.php';
	require_once THESEUS_RENDER_PATH . 'fragments.php';
	require_once THESEUS_RENDER_PATH . 'widget-area.php';
	require_once THESEUS_RENDER_PATH . 'walker.php';
	require_once THESEUS_RENDER_PATH . 'menu.php';
}

add_action( 'beans_init', 'beans_load_textdomain' );
/**
 * Load text domain.
 *
 * @since 1.0.0
 * @ignore
 *
 * @return void
 */
function beans_load_textdomain() {
	load_theme_textdomain( 'tm-beans', THESEUS_LANGUAGES_PATH );
}

/**
 * Fires before Theseus loads.
 *
 * @since 1.0.0
 */
do_action( 'beans_before_init' );

	/**
	 * Load Theseus framework.
	 *
	 * @since 1.0.0
	 */
	do_action( 'beans_init' );

/**
 * Fires after Theseus loads.
 *
 * @since 1.0.0
 */
do_action( 'beans_after_init' );

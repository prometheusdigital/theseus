<?php
/**
 *
 * Load the API components.
 *
 * @since 1.5.0
 *
 * @package PrometheusDigital\Theseus\API
 */

// Stop here if the API was already loaded.
if ( defined( 'THESEUS_API' ) ) {
	return;
}

// Declare Theseus API.
define( 'THESEUS_API', true );

// Mode.
if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', false ); // @phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- Valid use case as we need it defined.
}

// Assets.
define( 'THESEUS_MIN_CSS', SCRIPT_DEBUG ? '' : '.min' );
define( 'THESEUS_MIN_JS', SCRIPT_DEBUG ? '' : '.min' );

// Path.
if ( ! defined( 'THESEUS_API_PATH' ) ) {
	define( 'THESEUS_API_PATH', wp_normalize_path( trailingslashit( dirname( __FILE__ ) ) ) );
}

define( 'THESEUS_API_ADMIN_PATH', THESEUS_API_PATH . 'admin/' );

// Load dependencies here, as these are used further down.
require_once THESEUS_API_PATH . 'utilities/functions.php';
require_once THESEUS_API_PATH . 'adjust-head-callbacks.php';
require_once THESEUS_API_PATH . 'components.php';

// Url.
if ( ! defined( 'THESEUS_API_URL' ) ) {
	define( 'THESEUS_API_URL', beans_path_to_url( THESEUS_API_PATH ) );
}

// Backwards compatibility constants.
define( 'THESEUS_API_COMPONENTS_PATH', THESEUS_API_PATH );
define( 'THESEUS_API_COMPONENTS_ADMIN_PATH', THESEUS_API_PATH . 'admin/' );
define( 'THESEUS_API_COMPONENTS_URL', THESEUS_API_URL );

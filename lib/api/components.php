<?php
/**
 * The Theseus Component defines which API components of the framework are loaded.
 *
 * It can be different on a per page bases. This keeps Theseus as performant and lightweight as possible
 * by only loading what is needed.
 *
 * @package PrometheusDigital\Theseus\API
 *
 * @since 1.0.0
 */

/**
 * Load Theseus API components.
 *
 * This function loads Theseus API components. Components are only loaded once, even if they are called many times.
 * Admin components and functions are automatically wrapped in an is_admin() check.
 *
 * @since 1.0.0
 *
 * @param string|array $components Name of the API component(s) to include as and indexed array. The name(s) must be
 *                                 the Theseus API component folder.
 *
 * @return bool Will always return true.
 */
function beans_load_api_components( $components ) {
	static $loaded = [];

	$root = THESEUS_API_PATH;

	$common = [
		'html'         => [
			$root . 'html/functions.php',
			$root . 'html/class-beans-attribute.php',
			$root . 'html/accessibility.php',
		],
		'actions'      => $root . 'actions/functions.php',
		'filters'      => $root . 'filters/functions.php',
		'wp-customize' => $root . 'wp-customize/functions.php',
		'post-meta'    => $root . 'post-meta/functions.php',
		'term-meta'    => $root . 'term-meta/functions.php',
		'fields'       => $root . 'fields/functions.php',
		'layout'       => $root . 'layout/functions.php',
		'template'     => $root . 'template/functions.php',
		'widget'       => $root . 'widget/functions.php',
	];

	// Only load admin fragments if is_admin() is true.
	if ( is_admin() ) {
		$admin = [
			'options'     => $root . 'options/functions.php',
			'post-meta'   => $root . 'post-meta/functions-admin.php',
			'term-meta'   => $root . 'term-meta/functions-admin.php',
			'_admin_menu' => $root . 'admin-menu.php', // Internal use.
		];
	} else {
		$admin = [];
	}

	// Set dependencies.
	$dependencies = [
		'html'         => [
			'_admin_menu',
			'filters',
		],
		'fields'       => [
			'actions',
			'html',
		],
		'options'      => 'fields',
		'post-meta'    => 'fields',
		'term-meta'    => 'fields',
		'wp-customize' => 'fields',
		'layout'       => 'fields',
		'_admin_menu'  => 'options',
	];

	foreach ( (array) $components as $component ) {

		// Stop here if the component is already loaded or doesn't exist.
		if ( in_array( $component, $loaded, true ) || ( ! isset( $common[ $component ] ) && ! isset( $admin[ $component ] ) ) ) {
			continue;
		}

		// Cache loaded component before calling dependencies.
		$loaded[] = $component;

		// Load dependencies.
		if ( array_key_exists( $component, $dependencies ) ) {
			beans_load_api_components( $dependencies[ $component ] );
		}

		$_components = [];

		// Add common components.
		if ( isset( $common[ $component ] ) ) {
			$_components = (array) $common[ $component ];
		}

		// Add admin components.
		if ( isset( $admin[ $component ] ) ) {
			$_components = array_merge( (array) $_components, (array) $admin[ $component ] );
		}

		// Load components.
		foreach ( $_components as $component_path ) {
			require_once $component_path;
		}

		/**
		 * Fires when an API component is loaded.
		 *
		 * The dynamic portion of the hook name, $component, refers to the name of the API component loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'beans_loaded_api_component_' . $component );
	}

	return true;
}

/**
 * Register API component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to register.
 *
 * @return bool Will always return true.
 */
function beans_add_api_component_support( $feature ) {
	global $_beans_api_components_support;

	$args = func_get_args();

	if ( 1 === func_num_args() ) {
		$args = true;
	} else {
		$args = array_slice( $args, 1 );
	}

	$_beans_api_components_support[ $feature ] = $args;

	return true;
}

/**
 * Gets the API component support argument(s).
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to check.
 *
 * @return mixed The argument(s) passed.
 */
function beans_get_component_support( $feature ) {
	global $_beans_api_components_support;

	if ( ! isset( $_beans_api_components_support[ $feature ] ) ) {
		return false;
	}

	return $_beans_api_components_support[ $feature ];
}

/**
 * Remove API component support.
 *
 * @since 1.0.0
 *
 * @param string $feature The feature to remove.
 *
 * @return bool Will always return true.
 */
function beans_remove_api_component_support( $feature ) {
	global $_beans_api_components_support;
	unset( $_beans_api_components_support[ $feature ] );
	return true;
}

/**
 * Initialize API components support global.
 *
 * @ignore
 * @access private
 */
global $_beans_api_components_support;

if ( ! isset( $_beans_api_components_support ) ) {
	$_beans_api_components_support = [];
}

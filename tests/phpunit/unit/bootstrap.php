<?php
/**
 * Bootstraps the Theseus Unit Tests.
 *
 * @package     PrometheusDigital\Theseus\Tests\Unit
 * @since       1.5.0
 * @link        https://prometheus-digital.com/theseus
 * @license     GNU-2.0+
 */

namespace PrometheusDigital\Theseus\Tests\Unit;

use function PrometheusDigital\Theseus\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/functions.php';
init_test_suite( 'unit' );

define( 'THESEUS_TESTS_LIB_DIR', THESEUS_THEME_DIR . 'lib' . DIRECTORY_SEPARATOR );
define( 'THESEUS_API_PATH', THESEUS_TESTS_LIB_DIR . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR );

// Let's define ABSPATH as it is in WordPress, i.e. relative to the filesystem's WordPress root path.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( dirname( dirname( THESEUS_THEME_DIR ) ) ) . '/' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- Valid use case for our testing suite.
}

require_once THESEUS_TESTS_DIR . '/class-test-case.php';

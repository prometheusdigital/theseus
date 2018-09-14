<?php
/**
 * Test Case for Theseus Page Compiler integration tests.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes;

require_once __DIR__ . '/class-base-test-case.php';

/**
 * Abstract Class Page_Compiler_Test_Case
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes
 */
abstract class Page_Compiler_Test_Case extends Base_Test_Case {

	/**
	 * Set up the test before we run the test setups.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		set_current_screen( 'front' );

		require_once THESEUS_THEME_DIR . '/lib/api/compiler/class-beans-page-compiler.php';
	}
}

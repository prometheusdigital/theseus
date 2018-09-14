<?php
/**
 * Test Case for Theseus Image API Options unit tests.
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Image\Includes
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Image\Includes;

require_once __DIR__ . '/class-base-test-case.php';

/**
 * Abstract Class Options_Test_Case
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Image\Includes
 */
abstract class Options_Test_Case extends Base_Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		$this->load_original_functions( [
			'api/image/class-beans-image-options.php',
			'api/options/functions.php',
		] );
	}
}

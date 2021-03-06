<?php
/**
 * Test Case for Theseus' Post_Meta API unit tests.
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Post_Meta\Includes
 *
 * @since 1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Post_Meta\Includes;

use PrometheusDigital\Theseus\Tests\Unit\Test_Case;

/**
 * Abstract Class Post_Meta_Test_Case
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Post_Meta\Includes
 */
abstract class Post_Meta_Test_Case extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		$this->load_original_functions( [
			'api/post-meta/class-beans-post-meta.php',
			'api/post-meta/functions.php',
			'api/post-meta/functions-admin.php',
			'api/fields/functions.php',
			'api/utilities/functions.php',
		] );

		$this->setup_common_wp_stubs();
	}

}

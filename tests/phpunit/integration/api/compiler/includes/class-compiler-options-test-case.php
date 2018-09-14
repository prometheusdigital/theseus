<?php
/**
 * Test Case for Theseus Compiler API Options integration tests.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes;

require_once __DIR__ . '/class-base-test-case.php';

/**
 * Abstract Class Compiler_Options_Test_Case
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes
 */
abstract class Compiler_Options_Test_Case extends Base_Test_Case {

	/**
	 * Flag is in admin area (back-end).
	 *
	 * @var bool
	 */
	protected $is_admin = true;

	/**
	 * Set up the test before we run the test setups.
	 */
	public static function setUpBeforeClass() {
		parent::setUpBeforeClass();

		set_current_screen( 'themes.php' );

		require_once THESEUS_THEME_DIR . '/lib/api/compiler/class-beans-compiler-options.php';
	}

	/**
	 * Go to the Settings Page.
	 */
	protected function go_to_settings_page() {
		set_current_screen( 'themes.php?page=beans_settings' );
		$_GET['page'] = 'beans_settings';

		$this->assertTrue( is_admin() );
	}
}

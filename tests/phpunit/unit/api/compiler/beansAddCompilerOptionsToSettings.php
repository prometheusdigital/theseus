<?php
/**
 * Tests for beans_add_compiler_options_to_settings()
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Compiler
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Compiler;

use _Beans_Compiler_Options;
use PrometheusDigital\Theseus\Tests\Unit\API\Compiler\Includes\Compiler_Options_Test_Case;

require_once __DIR__ . '/includes/class-compiler-options-test-case.php';

/**
 * Class Tests_BeansAddCompilerOptionsToSettings
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Compiler
 * @group   api
 * @group   api-compiler
 */
class Tests_BeansAddCompilerOptionsToSettings extends Compiler_Options_Test_Case {

	/**
	 * Test beans_add_compiler_options_to_settings() should return instance of _Beans_Compiler_Options().
	 */
	public function test_should_return_instance_of_beans_compiler_options() {
		$this->assertInstanceOf( _Beans_Compiler_Options::class, beans_add_compiler_options_to_settings() );
	}
}

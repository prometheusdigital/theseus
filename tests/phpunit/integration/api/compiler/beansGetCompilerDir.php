<?php
/**
 * Tests for beans_get_compiler_dir()
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Compiler;

use PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes\Compiler_Test_Case;
use org\bovigo\vfs\vfsStream;

require_once __DIR__ . '/includes/class-compiler-test-case.php';

/**
 * Class Test_BeansGetCompilerDir
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler
 * @group   api
 * @group   api-compiler
 */
class Test_BeansGetCompilerDir extends Compiler_Test_Case {

	/**
	 * Test beans_get_compiler_dir() should return the absolute path to the Theseus' uploads compiler folder.
	 */
	public function test_should_return_absolute_path_to_compiler_folder() {
		$this->assertSame(
			vfsStream::url( 'compiled/beans/compiler/' ),
			beans_get_compiler_dir()
		);
	}

	/**
	 * Test beans_get_compiler_dir() should return the absolute path to the Theseus' uploads admin compiler folder.
	 */
	public function test_should_return_absolute_path_to_compiler_admin_folder() {
		$this->assertSame(
			vfsStream::url( 'compiled/beans/admin-compiler/' ),
			beans_get_compiler_dir( true )
		);
	}
}

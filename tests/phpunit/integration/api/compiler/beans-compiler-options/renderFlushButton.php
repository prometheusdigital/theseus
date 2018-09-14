<?php
/**
 * Tests for the render_flush_button() method of _Beans_Compiler_Options.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Compiler;

use _Beans_Compiler_Options;
use PrometheusDigital\Theseus\Tests\Integration\API\Compiler\Includes\Compiler_Options_Test_Case;
use Brain\Monkey;

require_once dirname( __DIR__ ) . '/includes/class-compiler-options-test-case.php';

/**
 * Class Tests_BeansCompilerOptions_RenderFlushButton
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Compiler
 * @group   api
 * @group   api-compiler
 */
class Tests_BeansCompilerOptions_RenderFlushButton extends Compiler_Options_Test_Case {

	/**
	 * Test _Beans_Compiler_Options::render_flush_button() should not render when the field is not for compiler options.
	 */
	public function test_should_not_render_when_field_is_not_compiler_options() {
		$_POST = [];

		ob_start();
		( new _Beans_Compiler_Options() )->render_flush_button( [ 'id' => 'foo' ] );

		$this->assertEmpty( ob_get_clean() );
	}

	/**
	 * Test _Beans_Compiler_Options::render_flush_button() should render when the field is for compiler options.
	 */
	public function test_should_render_when_field_is_compiler_items_options() {
		$this->go_to_settings_page();
		$_POST = [ 'beans_flush_compiler_cache' => 1 ];

		ob_start();
		( new _Beans_Compiler_Options() )->render_flush_button( [ 'id' => 'beans_compiler_items' ] );
		$actual = ob_get_clean();

		$expected = <<<EOB
<input type="submit" name="beans_flush_compiler_cache" value="Flush assets cache" class="button-secondary" />
EOB;
		$this->assertSame( $this->format_the_html( $expected ), $this->format_the_html( $actual ) );
	}
}

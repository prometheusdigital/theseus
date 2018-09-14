<?php
/**
 * Tests for _beans_build_action_array()
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Actions;

use PrometheusDigital\Theseus\Tests\Unit\Test_Case;
use Brain\Monkey;

/**
 * Class Tests_BeansBuildActionArray
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 * @group   api
 * @group   api-actions
 */
class Tests_BeansBuildActionArray extends Test_Case {

	/**
	 * Prepares the test environment before each test.
	 */
	protected function setUp() {
		parent::setUp();

		require_once THESEUS_TESTS_LIB_DIR . 'api/actions/functions.php';
	}

	/**
	 * Test _beans_build_action_array() should return an empty array when all of the arguments are invalid.
	 */
	public function test_should_return_empty_array_when_invalid_arguments() {
		$this->assertEmpty( _beans_build_action_array() );
		$this->assertEmpty( _beans_build_action_array( '', '' ) );
		$this->assertEmpty( _beans_build_action_array( null, false, '', [ 1 ] ) );
	}

	/**
	 * Test _beans_build_action_array() should return only the "hook" parameter.
	 */
	public function test_should_return_only_hook() {
		$hooks = [ 'foo', 'bar', 'baz', 'beans' ];

		foreach ( $hooks as $hook ) {
			$this->assertEquals( [ 'hook' => $hook ], _beans_build_action_array( $hook ) );
		}
	}

	/**
	 * Test _beans_build_action_array() should return only the "callback" parameter.
	 */
	public function test_should_return_only_callback() {
		$callbacks = [ 'foo_callback', 'my_callback', 'Foo::cb', [ $this, __FUNCTION__ ] ];

		foreach ( $callbacks as $callback ) {
			$this->assertEquals(
				[ 'callback' => $callback ],
				_beans_build_action_array( null, $callback )
			);
		}
	}

	/**
	 * Test _beans_build_action_array() should return only the "priority" parameter.
	 */
	public function test_should_return_only_priority() {
		$priorities = [ 10, 0, 50, '20' ];

		foreach ( $priorities as $priority ) {
			$this->assertEquals(
				[ 'priority' => (int) $priority ],
				_beans_build_action_array( null, null, $priority )
			);
		}
	}

	/**
	 * Test _beans_build_action_array() should return only the "args" parameter.
	 */
	public function test_should_return_only_args() {

		foreach ( [ 0, 1, 2, '3', '4.1' ] as $args ) {
			$this->assertEquals(
				[ 'args' => (int) $args ],
				_beans_build_action_array( null, null, null, $args )
			);
		}
	}

	/**
	 * Test _beans_build_action_array() should return only the valid arguments.
	 */
	public function test_should_return_valid_arguments() {
		$this->assertEquals(
			[
				'hook'     => 'foo',
				'callback' => 'cb',
			],
			_beans_build_action_array( 'foo', 'cb', '', false )
		);

		$this->assertEquals(
			[
				'hook'     => 'foo',
				'callback' => 'cb',
				'args'     => 1,
			],
			_beans_build_action_array( 'foo', 'cb', '', 1 )
		);

		$this->assertEquals(
			[
				'hook'     => 'foo',
				'priority' => 50,
			],
			_beans_build_action_array( 'foo', '', '50' )
		);

		$this->assertEquals(
			[
				'hook'     => 'foo',
				'callback' => 'my_callback',
				'priority' => 0,
				'args'     => 0,
			],
			_beans_build_action_array( 'foo', 'my_callback', 0, '0.0' )
		);

		$this->assertEquals(
			[
				'hook'     => 'baz',
				'callback' => 'baz_cb',
				'priority' => 20,
				'args'     => 2,
			],
			_beans_build_action_array( 'baz', 'baz_cb', 20, 2 )
		);
	}
}

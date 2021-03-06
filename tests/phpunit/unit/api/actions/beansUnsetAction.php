<?php
/**
 * Tests for _beans_unset_action()
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Actions;

use PrometheusDigital\Theseus\Tests\Unit\API\Actions\Includes\Actions_Test_Case;
use Brain\Monkey;

require_once __DIR__ . '/includes/class-actions-test-case.php';

/**
 * Class Tests_BeansUnsetAction
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 * @group   api
 * @group   api-actions
 */
class Tests_BeansUnsetAction extends Actions_Test_Case {

	/**
	 * The registered actions' status.
	 *
	 * @var array
	 */
	protected $statuses = [ 'added', 'modified', 'removed', 'replaced' ];

	/**
	 * Test _beans_unset_action() should return false when action is not registered.
	 */
	public function test_should_return_false_when_action_not_registered() {
		global $_beans_registered_actions;

		foreach ( static::$test_actions as $beans_id => $action ) {

			// Test each status.
			foreach ( $this->statuses as $status ) {
				Monkey\Functions\expect( '_beans_get_action' )
					->once()
					->with( $beans_id, $status )
					->andReturn( false );

				$this->assertFalse( _beans_unset_action( $beans_id, $status ) );
				$this->assertArrayNotHasKey( $beans_id, $_beans_registered_actions[ $status ] );
			}
		}
	}

	/**
	 * Test _beans_unset_action() should unset the registered action.
	 */
	public function test_should_unset_registered_action() {
		global $_beans_registered_actions;

		foreach ( static::$test_actions as $beans_id => $action ) {

			// Test each status.
			foreach ( $this->statuses as $status ) {
				// Register the action first.
				_beans_set_action( $beans_id, $action, $status );
				$this->assertArrayHasKey( $beans_id, $_beans_registered_actions[ $status ] );

				// Simulate getting the registered action.
				Monkey\Functions\expect( '_beans_get_action' )
					->once()
					->with( $beans_id, $status )
					->andReturn( $action );

				// Test that it unsets the action.
				$this->assertTrue( _beans_unset_action( $beans_id, $status ) );
				$this->assertArrayNotHasKey( $beans_id, $_beans_registered_actions[ $status ] );
			}
		}
	}

	/**
	 * Test _beans_unset_action() should return false when the status is invalid.
	 */
	public function test_should_return_false_when_status_is_invalid() {
		Monkey\Functions\when( '_beans_get_action' )->justReturn( false );

		foreach ( static::$test_actions as $beans_id => $action ) {
			$this->assertFalse( _beans_unset_action( $beans_id, 'invalid_status' ) );
			$this->assertFalse( _beans_unset_action( $beans_id, 'foo' ) );
			$this->assertFalse( _beans_unset_action( $beans_id, 'not_valid_either' ) );

			// Now store the action in each status.
			foreach ( $this->statuses as $status ) {
				_beans_set_action( $beans_id, $action, $status );
			}

			// Run the tests again.
			$this->assertFalse( _beans_unset_action( $beans_id, 'invalid_status' ) );
			$this->assertFalse( _beans_unset_action( $beans_id, 'foo' ) );
			$this->assertFalse( _beans_unset_action( $beans_id, 'not_valid_either' ) );
		}
	}
}

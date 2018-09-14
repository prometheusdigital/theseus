<?php
/**
 * Tests for beans_replace_action_priority().
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\Actions;

use PrometheusDigital\Theseus\Tests\Unit\API\Actions\Includes\Replace_Action_Test_Case;
use Brain\Monkey;

require_once __DIR__ . '/includes/class-replace-action-test-case.php';

/**
 * Class Tests_BeansReplaceActionPriority
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\Actions
 * @group   api
 * @group   api-actions
 */
class Tests_BeansReplaceActionPriority extends Replace_Action_Test_Case {

	/**
	 * Test beans_replace_action_priority() should invoke beans_replace_action().
	 */
	public function test_should_invoke_beans_replace_action() {

		foreach ( static::$test_actions as $beans_id => $action ) {
			Monkey\Functions\expect( 'beans_replace_action' )
				->once()
				->with( $beans_id, null, null, $action['priority'] )
				->andReturn( true );

			$this->assertTrue( beans_replace_action_priority( $beans_id, $action['priority'] ) );
		}
	}
}

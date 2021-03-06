<?php
/**
 * Tests for beans_wrap_markup().
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\HTML
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\HTML;

use PrometheusDigital\Theseus\Tests\Integration\API\HTML\Includes\HTML_Test_Case;

require_once __DIR__ . '/includes/class-html-test-case.php';

/**
 * Class Tests_BeansWrapMarkup
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\HTML
 * @group   api
 * @group   api-html
 */
class Tests_BeansWrapMarkup extends HTML_Test_Case {

	/**
	 * Since we do not have direct access to the instance, we need to get it from WordPress.
	 *
	 * @since 1.5.0
	 *
	 * @param string $hook     To given hook's event name.
	 * @param int    $priority The priority number for the callback.
	 *
	 * @return \_Beans_Anonymous_Action
	 */
	protected function get_instance_from_wp( $hook, $priority ) {
		global $wp_filter;

		return end( $wp_filter[ $hook ]->callbacks[ $priority ] )['function'][0];
	}

	/**
	 * Test beans_wrap_markup() should register beans_open_markup() to the given ID's '_before_markup' hook.
	 */
	public function test_should_register_beans_open_markup_to_given_id_before_markup_hook() {
		$this->assertTrue( beans_wrap_markup( 'foo', 'new_foo', 'div', [ 'class' => 'test-wrap' ] ) );

		// Check that it did register a callback to the hook.
		$this->assertTrue( has_action( 'foo_before_markup' ) );
		global $wp_filter;
		$this->assertArrayHasKey( 'foo_before_markup', $wp_filter );
		$this->assertArrayHasKey( 9999, $wp_filter['foo_before_markup'] );

		// Check that the correct arguments were stored in the instance.
		$anonymous_action = $this->get_instance_from_wp( 'foo_before_markup', 9999 );
		$this->assertSame(
			[
				'beans_open_markup',
				[
					1 => 'new_foo',
					2 => 'div',
					3 => [ 'class' => 'test-wrap' ],
				],
			],
			$anonymous_action->callback
		);

		// Clean up.
		remove_action( 'foo_before_markup', [ $anonymous_action, 'callback' ], 9999 );
	}

	/**
	 * Test beans_wrap_markup() should register beans_close_markup() to the given ID's '_after_markup' hook.
	 */
	public function test_should_register_beans_close_markup_to_given_id_after_markup_hook() {
		$this->assertTrue( beans_wrap_markup( 'foo', 'new_foo', 'div', [ 'class' => 'test-wrap' ] ) );

		// Check that it did register a callback to the hook.
		$this->assertTrue( has_action( 'foo_after_markup' ) );
		global $wp_filter;
		$this->assertArrayHasKey( 'foo_after_markup', $wp_filter );
		$this->assertArrayHasKey( 1, $wp_filter['foo_after_markup'] );

		// Check that the correct arguments were stored in the instance.
		$anonymous_action = $this->get_instance_from_wp( 'foo_after_markup', 1 );
		$this->assertSame(
			[
				'beans_close_markup',
				[
					1 => 'new_foo',
					2 => 'div',
				],
			],
			$anonymous_action->callback
		);

		// Clean up.
		remove_action( 'foo_after_markup', [ $anonymous_action, 'callback' ], 1 );
	}

	/**
	 * Test beans_wrap_markup() should not pass the given attributes to anonymous action.
	 */
	public function test_should_not_pass_attributes_for_after_markup_hook() {
		beans_wrap_markup( 'no_atts', '', 'div', [ 'class' => 'test-wrap' ] );

		// Check that the attributes do not exist.
		$anonymous_action = $this->get_instance_from_wp( 'no_atts_after_markup', 1 );
		$this->assertNotContains( [ 'class' => 'test-wrap' ], $anonymous_action->callback[1] );

		// Clean up.
		remove_action( 'no_atts_after_markup', [ $anonymous_action, 'callback' ], 1 );
	}

	/**
	 * Test beans_wrap_markup() should pass the extra arguments to the anonymous action for the given ID's
	 * '_before_markup' hook.
	 */
	public function test_should_pass_extra_arguments_for_before_markup_hook() {
		beans_wrap_markup( 'extra_args', '', 'div', [ 'class' => 'test-wrap' ], 47, 'Theseus Rocks!' );

		// Check that the correct arguments were stored in the instance.
		$anonymous_action = $this->get_instance_from_wp( 'extra_args_before_markup', 9999 );
		$this->assertSame(
			[
				'beans_open_markup',
				[
					1 => '',
					2 => 'div',
					3 => [ 'class' => 'test-wrap' ],
					4 => 47,
					5 => 'Theseus Rocks!',
				],
			],
			$anonymous_action->callback
		);

		// Clean up.
		remove_action( 'extra_args_before_markup', [ $anonymous_action, 'callback' ], 9999 );
	}

	/**
	 * Test beans_wrap_markup() should pass the extra arguments to the anonymous action for the given ID's
	 * '_after_markup' hook.
	 */
	public function test_should_pass_extra_arguments_for_after_markup_hook() {
		beans_wrap_markup( 'extra_args', '', 'div', [ 'class' => 'test-wrap' ], 'Theseus Rocks!', 47 );

		// Check that the correct arguments were stored in the instance.
		$anonymous_action = $this->get_instance_from_wp( 'extra_args_after_markup', 1 );
		$this->assertSame(
			[
				'beans_close_markup',
				[
					1 => '',
					2 => 'div',
					4 => 'Theseus Rocks!',
					5 => 47,
				],
			],
			$anonymous_action->callback
		);

		// Clean up.
		remove_action( 'extra_args_after_markup', [ $anonymous_action, 'callback' ], 1 );
	}
}

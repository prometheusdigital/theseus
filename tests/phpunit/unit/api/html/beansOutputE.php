<?php
/**
 * Tests for beans_output_e().
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\HTML
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Unit\API\HTML;

use PrometheusDigital\Theseus\Tests\Unit\API\HTML\Includes\HTML_Test_Case;
use Brain\Monkey;

require_once __DIR__ . '/includes/class-html-test-case.php';

/**
 * Class Tests_BeansOutputE
 *
 * @package PrometheusDigital\Theseus\Tests\Unit\API\HTML
 * @group   api
 * @group   api-html
 */
class Tests_BeansOutputE extends HTML_Test_Case {

	/**
	 * Test beans_output_e() should echo an empty string when the output is empty.
	 */
	public function test_should_echo_empty_string_when_output_is_empty() {
		Monkey\Functions\expect( 'beans_output' )->times( 3 )->andReturnUsing( function( $id, $output ) {
			return $output;
		} );

		$ids = [
			'beans_post_meta_item_date'     => null,
			'beans_post_meta_item_author'   => '',
			'beans_post_meta_item_comments' => false,
		];

		foreach ( $ids as $id => $output ) {
			ob_start();
			beans_output_e( $id, $output );
			$this->assertEmpty( ob_get_clean() );
		}
	}

	/**
	 * Test beans_output_e() should echo the filtered output.
	 */
	public function test_should_echo_the_filtered_output() {
		Monkey\Functions\expect( 'beans_output' )
			->once()
			->with( 'beans_archive_title_text', 'Theseus rocks!' )
			->andReturn( 'WooHoo, I fired!' );

		// Run the tests.
		ob_start();
		beans_output_e( 'beans_archive_title_text', 'Theseus rocks!' );
		$this->assertSame( 'WooHoo, I fired!', ob_get_clean() );
	}

	/**
	 * Test beans_output_e() should echo the output when not in HTML dev mode.
	 */
	public function test_should_echo_output_when_not_in_html_dev_mode() {
		Monkey\Functions\expect( 'beans_output' )
			->once()
			->with( 'beans_archive_title_text', 'Theseus rocks!' )
			->andReturnUsing( function( $id, $output ) {
				return $output;
			} );

		ob_start();
		beans_output_e( 'beans_archive_title_text', 'Theseus rocks!' );
		$this->assertSame( 'Theseus rocks!', ob_get_clean() );
	}

	/**
	 * Test beans_output_e() should echo the "comment wrapped" HTML when in HTML dev mode.
	 */
	public function test_should_echo_comment_wrapped_html_when_in_html_dev_mode() {
		Monkey\Functions\expect( 'beans_output' )
			->once()
			->with( 'beans_archive_title_text', 'Theseus rocks!' )
			->andReturnUsing( function( $id, $output ) {
				return "<!-- open output: $id -->" . $output . "<!-- close output: $id -->";
			} );

		ob_start();
		beans_output_e( 'beans_archive_title_text', 'Theseus rocks!' );
		$actual = ob_get_clean();

		$expected = <<<EOB
<!-- open output: beans_archive_title_text -->Theseus rocks!<!-- close output: beans_archive_title_text -->
EOB;
		$this->assertSame( $expected, $actual );
	}

	/**
	 * Test beans_output_e() should pass the additional arguments when firing the filter hook.
	 */
	public function test_should_pass_additional_args() {
		Monkey\Functions\expect( 'beans_output' )
			->once()
			->with( 'beans_breadcrumb_item_text', 'Theseus rocks!', 47, 'Hello' )
			->andReturnUsing( function( $id, $output, $arg1, $arg2 ) {
				return $arg2;
			} );

		ob_start();
		beans_output_e( 'beans_breadcrumb_item_text', 'Theseus rocks!', 47, 'Hello' );
		$this->assertSame( 'Hello', ob_get_clean() );
	}
}

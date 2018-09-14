<?php
/**
 * Tests for the register_metabox() method of _Beans_Post_Meta.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Post_Meta
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Post_Meta;

use PrometheusDigital\Theseus\Tests\Integration\API\Post_Meta\Includes\Post_Meta_Test_Case;
use _Beans_Post_Meta;

require_once THESEUS_THEME_DIR . '/lib/api/post-meta/class-beans-post-meta.php';
require_once dirname( __DIR__ ) . '/includes/class-post-meta-test-case.php';

/**
 * Class Tests_BeansPostMeta_RegisterMetabox.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Post_Meta
 * @group   api
 * @group   api-post-meta
 */
class Tests_BeansPostMeta_RegisterMetabox extends Post_Meta_Test_Case {

	/**
	 * Test _Beans_Post_Meta::register_metabox() should register an appropriate metabox when called.
	 */
	public function test_register_metabox_should_register_metabox() {
		global $wp_meta_boxes;

		$post_meta = new _Beans_Post_Meta( 'tm-beans', [ 'title' => 'Post Options' ] );
		$post_meta->register_metabox( 'post' );

		$this->assertArrayHasKey( 'tm-beans', $wp_meta_boxes['post']['normal']['high'] );
	}
}

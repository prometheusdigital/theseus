<?php
/**
 * Tests for beans_get_images_dir()
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Image
 *
 * @since   1.5.0
 */

namespace PrometheusDigital\Theseus\Tests\Integration\API\Image;

use PrometheusDigital\Theseus\Tests\Integration\API\Image\Includes\Image_Test_Case;
use Brain\Monkey;
use org\bovigo\vfs\vfsStream;

require_once __DIR__ . '/includes/class-image-test-case.php';

/**
 * Class Tests_BeansGetImagesDir
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\Image
 * @group   api
 * @group   api-image
 */
class Tests_BeansGetImagesDir extends Image_Test_Case {

	/**
	 * Test beans_get_images_dir() should return the images' directory.
	 */
	public function test_should_return_images_dir() {
		$this->assertStringEndsWith( 'uploads/beans/images/', beans_get_images_dir() );
	}

	/**
	 * Test beans_get_images_dir() should return the filtered images' directory.
	 */
	public function test_should_return_filtered_images_dir() {
		Monkey\Functions\expect( 'test_filter_beans_images_dir' )
			->once()
			->with( vfsStream::url( 'uploads/beans/images/' ) )
			->andReturn( 'foo' );

		add_filter( 'beans_images_dir', 'test_filter_beans_images_dir' );

		$this->assertSame( 'foo/', beans_get_images_dir() );

		remove_filter( 'beans_images_dir', 'test_filter_beans_images_dir' );
	}
}

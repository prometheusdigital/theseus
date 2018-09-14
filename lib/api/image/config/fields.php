<?php
/**
 * Runtime fields configuration parameters.
 *
 * @package PrometheusDigital\Theseus\API\Image
 *
 * @since   1.5.0
 */

return [
	'beans_edited_images_directories' => [
		'id'          => 'beans_edited_images_directories',
		'type'        => 'flush_edited_images',
		'description' => __( 'Clear all edited images. New images will be created on page load.', 'tm-beans' ),
	],
];

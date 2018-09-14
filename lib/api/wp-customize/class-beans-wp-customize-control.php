<?php
/**
 * This class controls the rendering of the Theseus fields for WP Customize.
 *
 * @package PrometheusDigital\Theseus\API\WP_Customize
 *
 * @since   1.5.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Render Theseus fields content for WP Customize.
 *
 * @since   1.0.0
 *
 * @ignore
 * @access  private
 *
 * @package PrometheusDigital\Theseus\API\WP_Customize
 */
class _Beans_WP_Customize_Control extends WP_Customize_Control {

	/**
	 * Field data.
	 *
	 * @var string
	 */
	private $beans_field;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$args = func_get_args();
		call_user_func_array( [ 'parent', '__construct' ], $args );
		$this->beans_field = end( $args );
	}

	/**
	 * Field content.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function render_content() {
		beans_field( $this->beans_field );
	}
}

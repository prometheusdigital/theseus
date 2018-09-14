<?php
/**
 * This class build the Theseus admin page.
 *
 * @package PrometheusDigital\Theseus\API
 *
 * @since 1.0.0
 */

/**
 * Theseus admin page.
 *
 * @since   1.0.0
 * @ignore
 * @access  private
 *
 * @package PrometheusDigital\Theseus\API
 */
final class _Beans_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 150 );
		add_action( 'admin_init', [ $this, 'register' ], 20 );
	}

	/**
	 * Add Theseus' menu.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_theme_page( __( 'Settings', 'tm-beans' ), __( 'Settings', 'tm-beans' ), 'manage_options', 'beans_settings', [ $this, 'display_screen' ] );
	}

	/**
	 * Theseus options page content.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function display_screen() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Theseus Settings', 'tm-beans' ); ?><span style="float: right; font-size: 12px; color: #555;"><?php esc_html_e( 'Version ', 'tm-beans' ); ?><?php echo esc_attr( THESEUS_VERSION ); ?></span></h1>
			<?php beans_options( 'beans_settings' ); ?>
		</div>
		<?php
	}

	/**
	 * Register options.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() {
		global $wp_meta_boxes;

		$fields = [
			[
				'id'             => 'beans_dev_mode',
				'label'          => __( 'Enable development mode', 'tm-beans' ),
				'checkbox_label' => __( 'Select to activate development mode.', 'tm-beans' ),
				'type'           => 'checkbox',
				'description'    => __( 'This option should be enabled while your website is in development.', 'tm-beans' ),
			],
		];

		beans_register_options(
			$fields,
			'beans_settings',
			'mode_options',
			[
				'title'   => __( 'Mode options', 'tm-beans' ),
				'context' => beans_get( 'beans_settings', $wp_meta_boxes ) ? 'column' : 'normal', // Check for other beans boxes.
			]
		);
	}
}

new _Beans_Admin();

<?php
/**
 * Test data for the Theseus WP Customize API integration tests.
 *
 * @package PrometheusDigital\Theseus\Tests\Integration\API\WP_Customize\Fixtures
 *
 * @since   1.5.0
 */

return [
	// Single fields.
	'single_fields' => [
		'fields'  => [
			[
				'id'      => 'beans_customizer_layout',
				'label'   => 'Layout',
				'type'    => 'radio',
				'default' => 'default_fallback',
				'options' => [
					'default_fallback' => 'Use Default Layout',
					'c'                => THESEUS_THEME_DIR . 'lib/admin/assets/images/layouts/c.png',
					'c_sp'             => THESEUS_THEME_DIR . 'lib/admin/assets/images/layouts/c_sp.png',
					'sp_c'             => THESEUS_THEME_DIR . 'lib/admin/assets/images/layouts/sp_c.png',
				],
			],
			[
				'id'             => 'beans_customizer_checkbox',
				'label'          => false,
				'checkbox_label' => 'Enable the checkbox test',
				'type'           => 'checkbox',
				'default'        => false,
			],
			[
				'id'      => 'beans_customizer_text',
				'type'    => 'text',
				'default' => 'Testing the text field.',
			],
		],
		'context' => 'beans-test',
		'section' => 'tm-beans-test-customizer',
		'args'    => [
			'title'       => 'Theseus Customizer Section',
			'priority'    => 250,
			'description' => 'Customizer Theseus Section',
		],
	],

	// Group of fields.
	'group'         => [
		'fields'  => [
			[
				'id'          => 'beans_group_test',
				'label'       => 'Group of fields',
				'description' => 'This is a group of fields.',
				'type'        => 'group',
				'fields'      => [
					[
						'id'      => 'beans_compile_all_scripts',
						'type'    => 'activation',
						'default' => false,
					],
					[
						'id'         => 'beans_compile_all_scripts_mode',
						'type'       => 'select',
						'default'    => 'aggressive',
						'attributes' => [ 'style' => 'margin: -3px 0 0 -8px;' ],
						'options'    => [
							'aggressive' => 'Aggressive',
							'standard'   => 'Standard',
						],
					],
					[
						'id'             => 'beans_checkbox_test',
						'label'          => false,
						'checkbox_label' => 'Enable the checkbox test',
						'type'           => 'checkbox',
						'default'        => false,
					],
				],
			],
		],
		'context' => 'group_tests',
		'section' => 'tm-beans-group-test-customizer',
		'args'    => [
			'title'       => 'Theseus Customizer Group Section',
			'priority'    => 250,
			'description' => 'Customizer Theseus Group Section',
		],
	],
];

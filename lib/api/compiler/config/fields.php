<?php
/**
 * Runtime fields configuration parameters.
 *
 * @package PrometheusDigital\Theseus\API\Compiler
 *
 * @since   1.5.0
 */

return [
	'beans_compiler_items'            => [
		'id'          => 'beans_compiler_items',
		'type'        => 'flush_cache',
		'description' => __( 'Clear CSS and Javascript cached files. New cached versions will be compiled on page load.', 'tm-beans' ),
	],
	'beans_compile_all_styles'        => [
		'id'             => 'beans_compile_all_styles',
		'label'          => __( 'Compile all WordPress styles', 'tm-beans' ),
		'checkbox_label' => __( 'Select to compile styles.', 'tm-beans' ),
		'type'           => 'checkbox',
		'default'        => false,
		'description'    => __( 'Compile and cache all the CSS files that have been enqueued to the WordPress head.', 'tm-beans' ),
	],
	'beans_compile_all_scripts_group' => [
		'id'          => 'beans_compile_all_scripts_group',
		'label'       => __( 'Compile all WordPress scripts', 'tm-beans' ),
		'type'        => 'group',
		'fields'      => [
			[
				'id'      => 'beans_compile_all_scripts',
				'type'    => 'activation',
				'label'   => __( 'Select to compile scripts.', 'tm-beans' ),
				'default' => false,
			],
			[
				'id'      => 'beans_compile_all_scripts_mode',
				'type'    => 'select',
				'label'   => __( 'Choose the level of compilation.', 'tm-beans' ),
				'default' => 'aggressive',
				'options' => [
					'aggressive' => __( 'Aggressive', 'tm-beans' ),
					'standard'   => __( 'Standard', 'tm-beans' ),
				],
			],
		],
		'description' => __( 'Compile and cache all the JavaScript files that have been enqueued to the WordPress head. <br/> JavaScript is outputted in the footer if the level is set to <strong>Aggressive</strong> and might conflict with some third-party plugins which are not following WordPress standards.', 'tm-beans' ),
	],
];

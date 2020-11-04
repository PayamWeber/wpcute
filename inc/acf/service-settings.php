<?php
return [
	'key' => 'service_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'service_single_image',
			'label' => __( 'Side Image', 'artist' ),
			'name' => 'service_single_image',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'service',
			],
		],
	],
];
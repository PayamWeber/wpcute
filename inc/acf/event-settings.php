<?php

return [
	'key' => 'event_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'event_location',
			'name' => 'event_location',
			'label' => __( 'Event Location', 'artist' ),
			'type' => 'text',
			'default_value' => 'تهران'
		],
		[
			'key' => 'large_image',
			'label' => __( 'Large', 'artist' ) . ' ' . __( 'Image', 'artist' ),
			'name' => 'large_image',
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
				'value' => 'event',
			],
		],
	],
];
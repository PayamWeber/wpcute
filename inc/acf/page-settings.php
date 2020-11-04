<?php

return [
	'key' => 'page_global_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'page_top_caption_background_image',
			'label' => __( 'Caption Image', 'artist' ),
			'name' => 'page_top_caption_background_image',
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
				'value' => 'page',
			],
		],
	],
];
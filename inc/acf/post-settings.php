<?php

return [
	'key' => 'post_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'visual_type',
			'label' => __( 'Type', 'artist' ),
			'name' => 'visual_type',
			'type' => 'radio',
			'required' => true,
			'choices' => \PMW\Post::get_types(),
		],
		[
			'key' => 'large_image',
			'label' => __( 'Large', 'artist' ) . ' ' . __( 'Image', 'artist' ),
			'name' => 'large_image',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
//			'conditional_logic' => [
//				[
//					[
//						'field' => 'visual_type',
//						'operator' => '==',
//						'value' => \PMW\Post::TYPE_DEFAULT,
//					],
//				],
//			],
		],
		[
			'key' => 'post_video_url',
			'label' => __( 'Video', 'artist' ),
			'name' => 'post_video_url',
			'type' => 'url',
			'conditional_logic' => [
				[
					[
						'field' => 'visual_type',
						'operator' => '==',
						'value' => \PMW\Post::TYPE_VIDEO,
					],
				],
			],
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			],
		],
	],
];
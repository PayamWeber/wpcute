<?php

return [
	'key' => 'discount_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'discount_single_intro_title',
			'name' => 'discount_single_intro_title',
			'label' => __( 'Title', 'artist' ),
			'type' => 'text',
			'default_value' => 'معرفی کلینیک آفرند'
		],
		[
			'key' => 'discount_single_intro_subtitle',
			'name' => 'discount_single_intro_subtitle',
			'label' => __( 'Sub Title', 'artist' ),
			'type' => 'text',
			'default_value' => 'ارائه بهترین خدمات زیبایی با جدیدترین متدهای روز دنیا'
		],
		[
			'key' => 'discount_single_description',
			'name' => 'discount_single_description',
			'label' => __( 'Description', 'artist' ),
			'type' => 'wysiwyg',
		],
		[
			'key' => 'discount_single_intro_video_url',
			'label' => __( 'Video Url', 'artist' ),
			'name' => 'discount_single_intro_video_url',
			'type' => 'url',
			'default_value' => ''
		],
		[
			'key' => 'discount_single_intro_video_poster',
			'label' => __( 'Video Poster', 'artist' ),
			'name' => 'discount_single_intro_video_poster',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
		[
			'key' => 'discount_single_discount_features',
			'name' => 'discount_single_discount_features',
			'label' => __( 'Features', 'artist' ),
			'type' => 'repeater',
			'sub_fields' => [
				[
					'key' => 'title',
					'label' => __( 'Title', 'artist' ),
					'name' => 'title',
					'type' => 'text',
				],
			],
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'discount',
			],
		],
	],
];
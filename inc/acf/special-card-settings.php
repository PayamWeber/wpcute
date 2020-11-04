<?php

return [
	'key' => 'special_card_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'special_card_first_tab',
			'name' => 'special_card_first_tab',
			'label' => __( 'Description', 'artist' ),
			'type' => 'tab',
		],
		[
			'key' => 'special_card_single_intro_title',
			'name' => 'special_card_single_intro_title',
			'label' => __( 'Title', 'artist' ),
			'type' => 'text',
			'default_value' => 'معرفی کلینیک آفرند'
		],
		[
			'key' => 'special_card_single_intro_subtitle',
			'name' => 'special_card_single_intro_subtitle',
			'label' => __( 'Sub Title', 'artist' ),
			'type' => 'text',
			'default_value' => 'ارائه بهترین خدمات زیبایی با جدیدترین متدهای روز دنیا'
		],
		[
			'key' => 'special_card_single_description',
			'name' => 'special_card_single_description',
			'label' => __( 'Description', 'artist' ),
			'type' => 'wysiwyg',
		],
		[
			'key' => 'special_card_single_intro_video_url',
			'label' => __( 'Video Url', 'artist' ),
			'name' => 'special_card_single_intro_video_url',
			'type' => 'url',
			'default_value' => ''
		],
		[
			'key' => 'special_card_single_intro_video_poster',
			'label' => __( 'Video Poster', 'artist' ),
			'name' => 'special_card_single_intro_video_poster',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
		[
			'key' => 'special_card_single_special_card_features',
			'name' => 'special_card_single_special_card_features',
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
		[
			'key' => 'special_card_sec_tab',
			'name' => 'special_card_sec_tab',
			'label' => __( 'Extra Details', 'artist' ),
			'type' => 'tab',
		],
		[
			'key' => 'special_card_show_tag',
			'name' => 'special_card_show_tag',
			'label' => __( 'Tag', 'artist' ),
			'type' => 'text',
		],
		[
			'key' => 'special_card_show_text_1',
			'name' => 'special_card_show_text_1',
			'label' => __( 'First Text', 'artist' ),
			'type' => 'text',
		],
		[
			'key' => 'special_card_show_text_2',
			'name' => 'special_card_show_text_2',
			'label' => __( 'Second Text', 'artist' ),
			'type' => 'text',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'special_card',
			],
		],
	],
];
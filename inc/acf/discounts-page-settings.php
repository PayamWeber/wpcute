<?php

return [
    'key' => 'discounts_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'discounts_page_intro_title',
			'name' => 'discounts_page_intro_title',
			'label' => __( 'Title', 'artist' ),
			'type' => 'text',
			'default_value' => ' پیشنهادها و تخفیف‌ها '
		],
		[
			'key' => 'discounts_page_intro_subtitle',
			'name' => 'discounts_page_intro_subtitle',
			'label' => __( 'Sub Title', 'artist' ),
			'type' => 'text',
			'default_value' => ' ارائه بهترین خدمات زیبایی با جدیدترین متدهای روز دنیا '
		],
		[
			'key' => 'discounts_page_description',
			'name' => 'discounts_page_description',
			'label' => __( 'Description', 'artist' ),
			'type' => 'wysiwyg',
		],
		[
			'key' => 'discounts_page_intro_video_url',
			'label' => __( 'Video Url', 'artist' ),
			'name' => 'discounts_page_intro_video_url',
			'type' => 'url',
			'default_value' => ''
		],
		[
			'key' => 'discounts_page_intro_video_poster',
			'label' => __( 'Video Poster', 'artist' ),
			'name' => 'discounts_page_intro_video_poster',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
		[
			'key' => 'discounts_page_cards',
			'name' => 'discounts_page_cards',
			'label' => __( 'Cards', 'artist' ),
			'type' => 'repeater',
			'sub_fields' => [
				[
					'key' => 'discount_title',
					'label' => __( 'Title', 'artist' ),
					'name' => 'discount_title',
					'type' => 'text',
				],
				[
					'key' => 'discount_description',
					'label' => __( 'Description', 'artist' ),
					'name' => 'discount_description',
					'type' => 'textarea',
				],
				[
					'key' => 'discount_button_text',
					'label' => __( 'Button Text', 'artist' ),
					'name' => 'discount_button_text',
					'type' => 'text',
				],
				[
					'key' => 'discount_url',
					'label' => __( 'Url', 'artist' ),
					'name' => 'discount_url',
					'type' => 'url',
				],
				[
					'key' => 'discount_image',
					'label' => __( 'Image', 'artist' ),
					'name' => 'discount_image',
					'type' => 'image',
					'preview_size' => 'thumbnail',
					'return_format' => 'id',
				],
			],
		],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-discounts.php',
            ],
        ],
    ],
];
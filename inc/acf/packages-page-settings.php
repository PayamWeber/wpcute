<?php

return [
    'key' => 'packages_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'packages_page_intro_title',
			'name' => 'packages_page_intro_title',
			'label' => __( 'Title', 'artist' ),
			'type' => 'text',
			'default_value' => ' پیشنهادها و تخفیف‌ها '
		],
		[
			'key' => 'packages_page_intro_subtitle',
			'name' => 'packages_page_intro_subtitle',
			'label' => __( 'Sub Title', 'artist' ),
			'type' => 'text',
			'default_value' => ' ارائه بهترین خدمات زیبایی با جدیدترین متدهای روز دنیا '
		],
		[
			'key' => 'packages_page_description',
			'name' => 'packages_page_description',
			'label' => __( 'Description', 'artist' ),
			'type' => 'wysiwyg',
		],
		[
			'key' => 'packages_page_intro_video_url',
			'label' => __( 'Video Url', 'artist' ),
			'name' => 'packages_page_intro_video_url',
			'type' => 'url',
			'default_value' => ''
		],
		[
			'key' => 'packages_page_intro_video_poster',
			'label' => __( 'Video Poster', 'artist' ),
			'name' => 'packages_page_intro_video_poster',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-packages.php',
            ],
        ],
    ],
];
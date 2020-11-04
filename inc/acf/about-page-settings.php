<?php

return [
    'key' => 'about_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'about_page_intro_tab',
			'label' => __( 'Introduction', 'artist' ),
			'name' => 'about_page_intro_tab',
			'type' => 'tab',
		],
        [
            'key' => 'about_page_intro_title',
            'label' => __( 'Title', 'artist' ),
            'name' => 'about_page_intro_title',
            'type' => 'text',
            'default_value' => ''
        ],
        [
            'key' => 'about_page_intro_desc',
            'label' => __( 'Description', 'artist' ),
            'name' => 'about_page_intro_desc',
            'type' => 'textarea',
            'default_value' => ''
        ],
		[
			'key' => 'about_page_intro_video_poster',
			'label' => __( 'Image', 'artist' ),
			'name' => 'about_page_intro_video_poster',
			'type' => 'image',
			'preview_size' => 'medium',
			'return_format' => 'id',
		],
		[
			'key' => 'about_page_intro2_tab',
			'label' => __( 'Image Introduction', 'artist' ),
			'name' => 'about_page_intro2_tab',
			'type' => 'tab',
		],
        [
            'key' => 'about_page_intro2_title',
            'label' => __( 'Title', 'artist' ),
            'name' => 'about_page_intro2_title',
            'type' => 'text',
            'default_value' => ''
        ],
        [
            'key' => 'about_page_intro2_desc',
            'label' => __( 'Description', 'artist' ),
            'name' => 'about_page_intro2_desc',
            'type' => 'textarea',
            'default_value' => ''
        ],
        [
            'key' => 'about_page_intro2_desc2',
            'label' => __( 'Second Description', 'artist' ),
            'name' => 'about_page_intro2_desc2',
            'type' => 'textarea',
            'default_value' => ''
        ],
		[
			'key' => 'about_page_intro2_doctor_name',
			'label' => __( 'Doctor Name', 'artist' ),
			'name' => 'about_page_intro2_doctor_name',
			'type' => 'text',
			'default_value' => ''
		],
		[
			'key' => 'about_page_intro2_doctor_level',
			'label' => __( 'Doctor Level', 'artist' ),
			'name' => 'about_page_intro2_doctor_level',
			'type' => 'text',
			'default_value' => ''
		],
		[
			'key' => 'about_page_intro2_sign_image',
			'label' => __( 'Sign Image', 'artist' ),
			'name' => 'about_page_intro2_sign_image',
			'type' => 'image',
			'return_format' => 'id',
			'default_value' => ''
		],
		[
			'key' => 'about_page_intro2_image',
			'label' => __( 'Image', 'artist' ),
			'name' => 'about_page_intro2_image',
			'type' => 'image',
			'return_format' => 'id',
			'default_value' => ''
		],
		[
			'key' => 'about_page_services_tab',
			'label' => __( 'Services', 'artist' ),
			'name' => 'about_page_services_tab',
			'type' => 'tab',
		],
        [
            'key' => 'about_page_services_title',
            'label' => __( 'Title', 'artist' ),
            'name' => 'about_page_services_title',
            'type' => 'text',
            'default_value' => 'بخشی از خدمات ما'
        ],
        [
            'key' => 'about_page_services_subtitle',
            'label' => __( 'Sub Title', 'artist' ),
            'name' => 'about_page_services_subtitle',
            'type' => 'textarea',
            'default_value' => ''
        ],
		[
			'key' => 'about_page_services',
			'label' => __( 'Services', 'artist' ),
			'name' => 'about_page_services',
			'type' => 'repeater',
			'sub_fields' => [
				[
					'key' => 'about_page_service_title',
					'label' => __( 'Title', 'artist' ),
					'name' => 'about_page_service_title',
					'type' => 'text',
				],
				[
					'key' => 'about_page_service_description',
					'label' => __( 'Description', 'artist' ),
					'name' => 'about_page_service_description',
					'type' => 'textarea',
				],
				[
					'key' => 'about_page_service_image',
					'label' => __( 'Image', 'artist' ),
					'name' => 'about_page_service_image',
					'type' => 'image',
					'return_format' => 'id',
				],
				[
					'key' => 'about_page_service_post',
					'label' => __( 'Service', 'artist' ),
					'name' => 'about_page_service_post',
					'type' => 'post_object',
					'post_type' => 'service',
				],
			],
		],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-about.php',
            ],
        ],
    ],
];
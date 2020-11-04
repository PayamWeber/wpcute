<?php

return [
    'key' => 'gallery_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'intro_tab',
			'label' => __( 'Introduction', 'artist' ),
			'name' => 'intro_tab',
			'type' => 'tab',
		],
        [
            'key' => 'gallery_page_intro_title',
            'label' => __( 'Title', 'artist' ),
            'name' => 'gallery_page_intro_title',
            'type' => 'text',
            'default_value' => ''
        ],
        [
            'key' => 'gallery_page_intro_subtitle',
            'label' => __( 'Sub Title', 'artist' ),
            'name' => 'gallery_page_intro_subtitle',
            'type' => 'textarea',
            'default_value' => ''
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-gallery.php',
            ],
        ],
    ],
];
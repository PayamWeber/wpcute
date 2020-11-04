<?php

return [
    'key' => 'photo_album_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'introduction_album_title',
			'name' => 'introduction_album_title',
			'label' => __( 'Introduction Title', 'artist' ),
			'type' => 'text',
		],
		[
			'key' => 'introduction_album_subtitle',
			'name' => 'introduction_album_subtitle',
			'label' => __( 'Introduction Sub Title', 'artist' ),
			'type' => 'text',
		],
        [
            'key' => 'image',
            'label' => __( 'Image', 'artist' ),
            'name' => 'image',
            'type' => 'image',
            'preview_size' => 'medium',
            'return_format' => 'id',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'photo_album',
            ],
        ],
    ],
];
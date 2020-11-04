<?php

return [
    'key' => 'shop_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		/*[
			'key' => 'slider_images',
			'label' => __( 'Slider Items', 'artist' ),
			'name' => 'slider_images',
			'type' => 'repeater',
			'sub_fields' => [
				[
					'key' => 'title',
					'label' => __( 'Title', 'artist' ),
					'name' => 'title',
					'type' => 'text',
				],
				[
					'key' => 'subtitle',
					'label' => __( 'Sub Title', 'artist' ),
					'name' => 'subtitle',
					'type' => 'text',
				],
				[
					'key' => 'desc1',
					'label' => __( 'First Description', 'artist' ),
					'name' => 'desc1',
					'type' => 'text',
				],
				[
					'key' => 'desc2',
					'label' => __( 'Second Description', 'artist' ),
					'name' => 'desc2',
					'type' => 'text',
					'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
				],
				[
					'key' => 'button_text',
					'label' => __( 'Button Text', 'artist' ),
					'name' => 'button_text',
					'type' => 'text',
				],
				[
					'key' => 'button_url',
					'label' => __( 'Button Url', 'artist' ),
					'name' => 'button_url',
					'type' => 'url',
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
		],*/
    ],
    'location' => [
        [
			[
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'woo-shop-page',
			],
        ],
    ],
];
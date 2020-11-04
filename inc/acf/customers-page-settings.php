<?php

return [
	'key' => 'customers_page_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'general',
			'label' => __( 'General', 'artist' ),
			'name' => 'general',
			'type' => 'tab',
		],
		[
			'key' => 'subtitle',
			'label' => __( 'Main Sub Title', 'artist' ),
			'name' => 'subtitle',
			'type' => 'text',
			'default' => 'مطالب به روز و خواندنی در مورد هر آنچه که با آن زندگی می‌کنید',
		],
		[
			'key' => 'image',
			'label' => __( 'Image', 'artist' ),
			'name' => 'image',
			'type' => 'image',
			'return_format' => 'id'
		],
		[
			'key' => 'image_parts',
			'label' => __( 'Image Parts', 'artist' ),
			'name' => 'image_parts',
			'type' => 'tab',
		],
		[
			'key' => 'cards',
			'label' => __( 'Cards', 'artist' ),
			'name' => 'cards',
			'type' => 'repeater',
			'sub_fields' => [
				[
					'key' => 'title',
					'label' => __( 'Title', 'artist' ),
					'name' => 'title',
					'type' => 'text',
				],
				[
					'key' => 'customer_subtitle',
					'label' => __( 'Sub Title', 'artist' ),
					'name' => 'subtitle',
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
		],
		[
			'key' => 'text_part',
			'label' => __( 'Text Part', 'artist' ),
			'name' => 'text_part',
			'type' => 'tab',
		],
		[
			'key' => 'text1',
			'label' => __( 'First Text', 'artist' ),
			'name' => 'text1',
			'type' => 'textarea',
		],
		[
			'key' => 'text2',
			'label' => __( 'Second Text', 'artist' ),
			'name' => 'text2',
			'type' => 'wysiwyg',
			'media_upload' => false
		],
	],
	'location' => [
		[
			[
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'templates/tpl-customers.php',
			],
		],
	],
];
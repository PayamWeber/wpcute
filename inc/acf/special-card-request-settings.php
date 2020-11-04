<?php

return [
	'key' => 'special_card_request_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'special_card_request_username',
			'label' => __( 'Name', 'artist' ),
			'name' => 'special_card_request_username',
			'type' => 'text',
		],
		[
			'key' => 'special_card_request_user_mobile',
			'label' => __( 'Mobile', 'artist' ),
			'name' => 'special_card_request_user_mobile',
			'type' => 'text',
		],
		[
			'key' => 'special_card_request_city',
			'label' => __( 'City', 'artist' ),
			'name' => 'special_card_request_city',
			'type' => 'text',
		],
		[
			'key' => 'special_card_request_gender',
			'label' => __( 'Gender', 'artist' ),
			'name' => 'special_card_request_gender',
			'type' => 'text',
		],
		[
			'key' => 'special_card_request_package_id',
			'label' => __( 'Package', 'artist' ),
			'name' => 'special_card_request_package_id',
			'type' => 'post_object',
			'post_type' => 'special_card',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'special_card_request',
			],
		],
	],
];
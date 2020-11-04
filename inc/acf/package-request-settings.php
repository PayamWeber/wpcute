<?php

return [
	'key' => 'package_request_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'package_request_username',
			'label' => __( 'Name', 'artist' ),
			'name' => 'package_request_username',
			'type' => 'text',
		],
		[
			'key' => 'package_request_user_mobile',
			'label' => __( 'Mobile', 'artist' ),
			'name' => 'package_request_user_mobile',
			'type' => 'text',
		],
		[
			'key' => 'package_request_city',
			'label' => __( 'City', 'artist' ),
			'name' => 'package_request_city',
			'type' => 'text',
		],
		[
			'key' => 'package_request_gender',
			'label' => __( 'Gender', 'artist' ),
			'name' => 'package_request_gender',
			'type' => 'text',
		],
		[
			'key' => 'package_request_package_id',
			'label' => __( 'Package', 'artist' ),
			'name' => 'package_request_package_id',
			'type' => 'post_object',
			'post_type' => 'package',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'package_request',
			],
		],
	],
];
<?php

return [
	'key' => 'contactpost_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'contact_username',
			'label' => __( 'Name', 'artist' ),
			'name' => 'contact_username',
			'type' => 'text',
		],
		[
			'key' => 'contact_user_mobile',
			'label' => __( 'Mobile', 'artist' ),
			'name' => 'contact_user_mobile',
			'type' => 'text',
		],
		[
			'key' => 'contact_message_text',
			'label' => __( 'Message', 'artist' ),
			'name' => 'contact_message_text',
			'type' => 'textarea',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'contact',
			],
		],
	],
];
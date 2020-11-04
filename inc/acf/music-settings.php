<?php

return [
	'key' => 'music_group_settings',
	'title' => __( 'Settings', 'artist' ),
	'fields' => [
		[
			'key' => 'lyrics',
			'label' => __( 'Lyrics', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'lyrics',
			'type' => 'text',
		],
		[
			'key' => 'arrangement',
			'label' => __( 'Arrangement', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'arrangement',
			'type' => 'text',
		],
		[
			'key' => 'mix_mastering',
			'label' => __( 'Mix & Mastering', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'mix_mastering',
			'type' => 'text',
		],
		[
			'key' => 'guitar',
			'label' => __( 'Guitar', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'guitar',
			'type' => 'text',
		],
		[
			'key' => 'producer',
			'label' => __( 'Producer', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'producer',
			'type' => 'text',
		],
		[
			'key' => 'cover_art',
			'label' => __( 'Cover Art', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'cover_art',
			'type' => 'text',
		],
		[
			'key' => 'music_file_url',
			'label' => __( 'File Url', 'artist' ),
			//			'instructions' => __( 'For Special Words you can enter your text into [] brackets', 'artist' ),
			'name' => 'music_file_url',
			'type' => 'url',
		],
	],
	'location' => [
		[
			[
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'music',
			],
		],
	],
];
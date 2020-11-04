<?php

return [
    'key' => 'faq_group_settings',
    'title' => __( 'Settings' ),
    'fields' => [
        [
            'key' => 'answer',
            'label' => __( 'Answer', 'artist' ),
            'name' => 'answer',
			'type' => 'wysiwyg',
			'media_upload' => false
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'faq',
            ],
        ],
    ],
];
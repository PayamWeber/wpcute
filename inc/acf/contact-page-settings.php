<?php

return [
    'key' => 'contact_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
		[
			'key' => 'intro_tab',
			'label' => __( 'Information', 'artist' ),
			'name' => 'intro_tab',
			'type' => 'tab',
		],
        [
            'key' => 'contact_page_phone_number',
            'label' => __( 'Phone Number', 'artist' ),
            'name' => 'contact_page_phone_number',
            'type' => 'wysiwyg',
            'default_value' => ''
        ],
        [
            'key' => 'contact_page_address',
            'label' => __( 'Address', 'artist' ),
            'name' => 'contact_page_address',
            'type' => 'textarea',
            'default_value' => ''
        ],
        [
            'key' => 'contact_page_email',
            'label' => __( 'Email', 'artist' ),
            'name' => 'contact_page_email',
            'type' => 'textarea',
            'default_value' => ''
        ],
        [
            'key' => 'contact_page_map_url',
            'label' => __( 'Map Url', 'artist' ),
            'name' => 'contact_page_map_url',
            'type' => 'url',
            'default_value' => ''
        ],
        [
            'key' => 'contact_page_contact_form',
            'label' => __( 'Contact Form', 'artist' ),
            'name' => 'contact_page_contact_form',
            'type' => 'tab',
        ],
        [
            'key' => 'contact_page_contact_form_title',
            'label' => __( 'Title', 'artist' ),
            'name' => 'contact_page_contact_form_title',
            'type' => 'text',
            'default_value' => 'فرم تماس'
        ],
        [
            'key' => 'contact_page_contact_form_subtitle',
            'label' => __( 'Sub Title', 'artist' ),
            'name' => 'contact_page_contact_form_subtitle',
            'type' => 'text',
            'default_value' => 'ما با دریافت بازخوردهای شما دلگرم می‌شویم؛ لطفا با استفاده از فرم تماس زیر پیام‌های خود را با ما در میان بگذارید'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-contact.php',
            ],
        ],
    ],
];
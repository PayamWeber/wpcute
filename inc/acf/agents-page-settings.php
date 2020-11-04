<?php

return [
    'key' => 'agents_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
        [
            'key' => 'subtitle',
            'label' => __( 'Main Sub Title', 'artist' ),
            'name' => 'subtitle',
            'type' => 'text',
            'default_value' => 'بیش از ۷۵۴ نمایندگی و مرکز خدمات فعال در سراسر کشور'
        ],
        [
            'key' => 'input_text',
            'label' => __( 'TextBox Description', 'artist' ),
            'name' => 'input_text',
            'type' => 'text',
            'default_value' => 'جستجو در میان نمایندگی‌های رسمی اسنوا'
        ],
        [
            'key' => 'not_found_text',
            'label' => __( 'Not Found Text', 'artist' ),
            'name' => 'not_found_text',
            'type' => 'text',
            'default_value' => 'نتیجه ای یافت نشد!'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-agents.php',
            ],
        ],
    ],
];
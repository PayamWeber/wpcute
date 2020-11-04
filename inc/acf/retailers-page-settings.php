<?php

return [
    'key' => 'retailers_page_settings',
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
            'key' => 'table_first_column_text',
            'label' => __( 'Main column text', 'artist' ),
            'name' => 'table_first_column_text',
            'type' => 'text',
            'default_value' => 'نام و مشخصات فروشگاه ها'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-retailers.php',
            ],
        ],
    ],
];
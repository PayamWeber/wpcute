<?php

return [
    'key' => 'faq_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
        [
            'key' => 'subtitle',
            'label' => __( 'Main Sub Title', 'artist' ),
            'name' => 'subtitle',
            'type' => 'text',
            'default_value' => 'پاسخ به مهم‌ترین سوالات و دغدغه‌های شما'
        ],
        [
            'key' => 'not_found_text',
            'label' => __( 'Not Found Text', 'artist' ),
            'name' => 'not_found_text',
            'type' => 'text',
            'default_value' => 'با عبارتی که جستجو کردید نتیجه‌ای یافت نشد.'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-faq.php',
            ],
        ],
    ],
];
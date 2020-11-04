<?php

return [
    'key' => 'festival_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
        [
            'key' => 'first_subtitle',
            'label' => __( 'Main Sub Title', 'artist' ),
            'name' => 'first_subtitle',
            'type' => 'text',
            'default' => 'مطالب به روز و خواندنی در مورد هر آنچه که با آن زندگی می‌کنید'
        ],
        [
            'key' => 'second_title',
            'label' => __( 'Past Festivals Title', 'artist' ),
            'name' => 'second_title',
            'type' => 'text',
            'default' => 'جشنواره‌های پیشین'
        ],
        [
            'key' => 'second_subtitle',
            'label' => __( 'Past Festivals Sub Title', 'artist' ),
            'name' => 'second_subtitle',
            'type' => 'text',
            'default' => 'مطالب به روز و خواندنی در مورد هر آنچه که با آن زندگی می‌کنید'
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-festivals.php',
            ],
        ],
    ],
];
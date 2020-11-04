<?php

return [
    'key' => 'blog_page_settings',
    'title' => __( 'Settings', 'artist' ),
    'fields' => [
        [
            'key' => 'general',
            'label' => __( 'General', 'artist' ),
            'type' => 'tab',
        ],
        [
            'key' => 'subtitle',
            'label' => __( 'Main Sub Title', 'artist' ),
            'name' => 'subtitle',
            'type' => 'text',
            'default' => 'مطالب به روز و خواندنی در مورد هر آنچه که با آن زندگی می‌کنید'
        ],
		/*[
			'key' => 'instagram',
			'label' => __( 'Instagram', 'artist' ),
			'type' => 'tab',
		],*/
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-blog.php',
            ],
        ],
    ],
];
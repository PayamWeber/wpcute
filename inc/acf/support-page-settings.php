<?php

return [
    'key' => 'support_page_settings',
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
            'key' => 'contact_us_title',
            'label' => __( 'Contact Us Title', 'artist' ),
            'name' => 'contact_us_title',
            'type' => 'text',
            'default_value' => 'فرم تماس با ما'
        ],
        [
            'key' => 'contact_us_subtitle',
            'label' => __( 'Contact Us SubTitle', 'artist' ),
            'name' => 'contact_us_subtitle',
            'type' => 'text',
            'default_value' => 'با نوشتن راحت‌ترید! هر مشکلی که داشته‌باشید سریعا پیگیری می‌کنیم.'
        ],
        [
            'key' => 'service_title',
            'label' => __( 'Service Title', 'artist' ),
            'name' => 'service_title',
            'type' => 'text',
            'default_value' => 'انتخاب سرویس حامی'
        ],
        [
            'key' => 'service_subtitle',
            'label' => __( 'Service SubTitle', 'artist' ),
            'name' => 'service_subtitle',
            'type' => 'text',
            'default_value' => 'تکمیل و ارسال فرم برای بررسی کارشناسان بخش پشتیبانی اسنوا'
        ],
        [
            'key' => 'service_url',
            'label' => __( 'Service Url', 'artist' ),
            'name' => 'service_url',
            'type' => 'url',
        ],
        [
            'key' => 'faq_title',
            'label' => __( 'FAQ Url', 'artist' ),
            'name' => 'faq_title',
            'type' => 'text',
			'default_value' => 'تعدادی از مهم‌ترین موضوعاتی که از ما می‌پرسید:'
        ],
        [
            'key' => 'faq_selection',
            'label' => __( 'FAQ Selection', 'artist' ),
            'name' => 'faq_selection',
            'type' => 'post_object',
            'post_type' => 'faq',
			'multiple' => true
        ],
        [
            'key' => 'bottom_text',
            'label' => __( 'Bottom Text', 'artist' ),
            'name' => 'bottom_text',
			'type' => 'text',
			'default_value' => 'با ۱۶۹۲ تماس بگیرید',
        ],
        [
            'key' => 'bottom_subtext',
            'label' => __( 'Bottom Sub Text', 'artist' ),
            'name' => 'bottom_subtext',
			'type' => 'text',
			'default_value' => 'روز و شب ندارد! هر زمان که بخواهید پاسخگوی‌تان هستیم.',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'templates/tpl-support.php',
            ],
        ],
    ],
];
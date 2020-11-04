<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'main_desc',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'label_block' => true,
        'default' => '',
    ]
);
$this->add_control(
    'btn_label',
    [
        'label' => __( 'Button Label', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'default' => 'بیشتر بخوانید',
    ]
);
$this->add_control(
    'btn_link',
    [
        'label' => __( 'Button Link', 'snowa' ),
        'type' => \Elementor\Controls_Manager::URL,
        'label_block' => true,
        'default' => '',
    ]
);


$this->add_control(
    'items',
    [
        'label' => __( 'Items', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'snowa' ),
                'type' => 'file_uploader',
            ],
            [
                'name' => 'value',
                'label' => __( 'Value', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '2500', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'prefix',
                'label' => __( 'Value Postfix', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Description', 'snowa' ),
                'label_block' => true,
            ],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
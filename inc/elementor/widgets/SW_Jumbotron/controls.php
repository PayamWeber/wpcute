<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'style',
    [
        'label' => __( 'Style', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => false,
        'options' => [
            'feature' => __( 'Multiple Items', 'snowa' ),
            'desc' => __( 'Single Item', 'snowa' ),
            'image_only' => __( 'Picture only', 'snowa' ),
        ],
        'default' => 'feature',
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
        'condition' => [
            'style' => 'desc',
        ],
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
        'condition' => [
            'style' => 'desc',
        ],
    ]
);
$this->add_control(
    'main_desc',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
        'condition' => [
            'style' => 'desc',
        ],
    ]
);
$this->add_control(
    'main_image',
    [
        'label' => __( 'Image', 'snowa' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'dynamic' => [
            'active' => true,
        ],
        'default' => [
            'url' => '',
        ],
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
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'desc',
                'label' => __( 'Description', 'snowa' ) . '(' . __( 'Only for second style', 'snowa' ) . ')',
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Description', 'snowa' ),
                'label_block' => true,
            ],
        ],
        'condition' => [
            'style' => 'feature',
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
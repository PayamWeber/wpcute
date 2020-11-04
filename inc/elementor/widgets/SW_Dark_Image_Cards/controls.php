<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    'show_type',
    [
        'label' => __( 'Show Type', 'snowa' ),
        'type' => Controls_Manager::SELECT,
        'multiple' => false,
        'options' => [
            'product_cats' => __( 'Product Categories', 'snowa' ),
            'custom' => __( 'Manual', 'snowa' ),
        ],
        'default' => 'product_cats',
    ]
);
$this->add_control(
    'items',
    [
        'label' => __( 'Cards', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'title',
                'label' => __( 'Title', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Card Title', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'desc',
                'label' => __( 'Description', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Card Description', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'image',
                'label' => __( 'Choose An Image', 'snowa' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
            ],
            [
                'name' => 'button_text',
                'label' => __( 'Button Text', 'snowa' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Learn more', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'button_url',
                'label' => __( 'Url', 'snowa' ),
                'type' => Controls_Manager::URL,
                'default' => '',
                'label_block' => true,
            ],
            [
                'name' => 'half_width',
                'label' => __( 'Width 50%', 'snowa' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ],
        ],
        'condition' => [
            'show_type' => 'custom'
        ]
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
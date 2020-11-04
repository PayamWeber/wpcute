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
        'default' => '',
    ]
);
$this->add_control(
    'subtitle_style',
    [
        'label' => __( 'Subtitle Style', 'snowa' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'multiple' => false,
        'options' => [
            'text' => __( 'Text', 'snowa' ),
            'image' => __( 'Image', 'snowa' ),
        ],
        'default' => 'text',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
        'condition' => [
            'subtitle_style' => 'text',
        ],
    ]
);
$this->add_control(
    'main_subtitle_image',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => 'file_uploader',
        'condition' => [
            'subtitle_style' => 'image',
        ],
    ]
);
$this->add_control(
    'main_desc',
    [
        'label' => __( 'Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
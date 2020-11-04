<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'snowa' ),
    ]
);
$this->add_control(
    "desc1",
    [
        'label' => __( 'First Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    "desc2",
    [
        'label' => __( 'Second Description', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'show_button',
    [
        'label' => __( 'Show Button', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => ''
    ]
);
$this->add_control(
    'button_text',
    [
        'label' => __( 'Button Text', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::TEXT,
        'condition' => [
            'show_button' => 'yes'
        ]
    ]
);
$this->add_control(
    'button_url',
    [
        'label' => __( 'Button Url', 'snowa' ),
        'label_block' => true,
        'type' => Controls_Manager::URL,
        'condition' => [
            'show_button' => 'yes'
        ]
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
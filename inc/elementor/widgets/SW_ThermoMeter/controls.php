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
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'snowa' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
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
$this->add_control(
    'minimum',
    [
        'label' => __( 'Minimum Temperature (In Celsius)', 'snowa' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '50',
    ]
);
$this->add_control(
    'maximum',
    [
        'label' => __( 'Maximum Temperature (In Celsius)', 'snowa' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '200',
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
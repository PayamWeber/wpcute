<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
    'content_section',
    [
        'label' => __( 'Content', 'artist' ),
    ]
);
$this->add_control(
    'main_title',
    [
        'label' => __( 'Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_subtitle',
    [
        'label' => __( 'Sub Title', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => '',
    ]
);
$this->add_control(
    'main_desc',
    [
        'label' => __( 'Description', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => '',
    ]
);
$this->add_control(
    'meter_length',
    [
        'label' => __( 'All Maximum', 'artist' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '20',
    ]
);
$this->add_control(
    'min_text',
    [
        'label' => __( 'Minimum Text', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'شستشو با نصف ظرفیت',
    ]
);
$this->add_control(
    'min_number',
    [
        'label' => __( 'Minimum Number', 'artist' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '5.5',
    ]
);
$this->add_control(
    'max_text',
    [
        'label' => __( 'Maximum Text', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'حداکثر آب مصرفی',
    ]
);
$this->add_control(
    'max_number',
    [
        'label' => __( 'Maximum Number', 'artist' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => '11',
    ]
);
$this->add_control(
    'measure',
    [
        'label' => __( 'Measure Name', 'artist' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'لیتر',
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
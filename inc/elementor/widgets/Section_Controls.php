<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
	'menu_section',
	[
		'label' => __( 'Side Menu', 'snowa' ),
	]
);
$this->add_control(
	'section_icon',
	[
		'label' => __( 'Section Icon', 'snowa' ),
		'label_block' => true,
		'type' => 'file_uploader',
	]
);
$this->add_control(
	'section_menu_title',
	[
		'label' => __( 'Section Title', 'snowa' ),
		'label_block' => true,
		'type' => Controls_Manager::TEXT,
	]
);
$this->add_control(
	'section_hashtag',
	[
		'label' => __( 'Section Hashtag', 'snowa' ),
		'label_block' => true,
		'type' => Controls_Manager::TEXT,
	]
);
$this->add_control(
	'section_hide_menu',
	[
		'label' => __( 'Hide Section side menu', 'snowa' ),
		'label_block' => true,
		'type' => Controls_Manager::SWITCHER,
	]
);
$this->end_controls_section();
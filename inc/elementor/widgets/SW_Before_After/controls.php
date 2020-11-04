<?php

use \Elementor\Controls_Manager;

$this->start_controls_section(
	'content_section',
	[
		'label' => __( 'Content', 'snowa' ),
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
				'name' => 'before_image',
				'label' => __( 'First Image', 'snowa' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			],
			[
				'name' => 'after_image',
				'label' => __( 'Second Image', 'snowa' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			],
		],
	]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
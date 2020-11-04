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
for ( $i = 1; $i <= 3; $i++ )
{
    $this->add_control(
        'text' . $i,
        [
            'label' => __( 'Text', 'snowa' ) . " $i",
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
        ]
    );
    $this->add_control(
        'measure' . $i,
        [
            'label' => __( 'Measure', 'snowa' ) . " $i",
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
        ]
    );
}
$this->add_control(
    'items',
    [
        'label' => __( 'Items', 'snowa' ),
        'type' => Controls_Manager::REPEATER,
        'prevent_empty' => false,
        'fields' => [
            [
                'name' => 'desc',
                'label' => __( 'Description', 'snowa' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Description', 'snowa' ),
                'label_block' => true,
            ],
            [
                'name' => 'value1',
                'label' => __( 'First Value', 'snowa' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '10',
            ],
            [
                'name' => 'value2',
                'label' => __( 'Second Value', 'snowa' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '10',
            ],
            [
                'name' => 'value3',
                'label' => __( 'Third Value', 'snowa' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '10',
            ],
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
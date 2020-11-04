<?php

use \Elementor\Controls_Manager;

for ( $i = 1; $i <= 2; $i++ )
{
    $this->start_controls_section(
        'box_section' . $i,
        [
            'label' => __( ( $i == 1 ? 'First' : 'Second' ) . ' Part', 'snowa' ),
        ]
    );
    $this->add_control(
        "title$i",
        [
            'label' => __( 'Title', 'snowa' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
        ]
    );
    $this->add_control(
        "desc$i",
        [
            'label' => __( 'Description', 'snowa' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => '',
        ]
    );
    $this->add_control(
        "image$i",
        [
            'label' => __( 'Image', 'snowa' ),
            'type' => 'file_uploader',
        ]
    );
    $this->add_control(
        'show_button' . $i,
        [
            'label' => __( 'Show Button', 'snowa' ),
            'label_block' => false,
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
        ]
    );
    $this->add_control(
        'button_text' . $i,
        [
            'label' => __( 'Button Text', 'snowa' ),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'condition' => [
                'show_button' . $i => 'yes'
            ]
        ]
    );
    $this->add_control(
        'button_url' . $i,
        [
            'label' => __( 'Button Url', 'snowa' ),
            'label_block' => true,
            'type' => Controls_Manager::URL,
            'condition' => [
                'show_button' . $i => 'yes'
            ]
        ]
    );
    $this->end_controls_section();
}

$this->start_controls_section(
    'items_section',
    [
        'label' => __( 'Items', 'snowa' ),
    ]
);
$this->add_control(
    'show_items',
    [
        'label' => __( 'Show Items', 'snowa' ),
        'label_block' => false,
        'type' => Controls_Manager::SWITCHER,
        'default' => 'yes'
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
            'show_items' => 'yes',
        ],
    ]
);
$this->end_controls_section();
//---------------------------------------------------------------------------------------------//
include NVM_DIR_PATH . '/inc/elementor/widgets/Section_Controls.php';
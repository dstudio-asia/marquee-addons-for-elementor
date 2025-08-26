<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait ImageAccordion_Contents {
        protected function content_controls() 
        {
            $this->start_controls_section(
                'deensimc_image_repeater_section',
                [
                    'label' => esc_html__( 'Images', 'marquee-addons-for-elementor' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );
    
            $image_repeater = new Repeater();
    
            $image_repeater->add_control(
                'deensimc_bg_image',
                [
                    'label' => esc_html__( 'Choose Image', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );
    
            $image_repeater->add_control(
                'deensimc_bg_image_title',
                [
                    'label' => esc_html__( 'Title', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'marquee-addons-for-elementor' ),
                    'placeholder' => esc_html__( 'Type your title here', 'marquee-addons-for-elementor' ),
                ]
            );

            $image_repeater->add_control(
                'deensimc_bg_image_description',
                [
                    'label' => esc_html__( 'Description', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::WYSIWYG,
                    'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                    'placeholder' => esc_html__( 'Type your description here', 'marquee-addons-for-elementor' ),
                ]
		    );
    
            $this->add_control(
                'deensimc_bg_image_repeater',
                [
                    'label' => esc_html__( 'Images', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::REPEATER,
                    'fields' => $image_repeater->get_controls(),
                    'default' => [
                        [
                            'deensimc_bg_image_title' => esc_html__( 'Set', 'marquee-addons-for-elementor' ),
                            'deensimc_bg_image_description' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                        ],
                        [
                            'deensimc_bg_image_title' => esc_html__( 'Your', 'marquee-addons-for-elementor' ),
                            'deensimc_bg_image_description' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                        ],
                        [
                            'deensimc_bg_image_title' => esc_html__( 'Journey', 'marquee-addons-for-elementor' ),
                            'deensimc_bg_image_description' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                        ],
                        [
                            'deensimc_bg_image_title' => esc_html__( 'To', 'marquee-addons-for-elementor' ),
                            'deensimc_bg_image_description' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                        ],
                        [
                            'deensimc_bg_image_title' => esc_html__( 'Success', 'marquee-addons-for-elementor' ),
                            'deensimc_bg_image_description' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'marquee-addons-for-elementor' ),
                        ],
                    ],
                    'title_field' => '{{{ deensimc_bg_image_title }}}',
                ]
            );
    
            $this->add_control(
                'deensimc_bg_image_active_behaviour',
                [
                    'label' => esc_html__( 'Active Behaviour', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::SELECT,
                    'default' => 'click',
                    'options' => [
                        'click' => esc_html__( 'Click', 'marquee-addons-for-elementor' ),
                        'hover' => esc_html__( 'Hover', 'marquee-addons-for-elementor' ),
                    ],
                    'selectors' => [],
                ]
            );
    
            $this->add_responsive_control(
                'deensimc_bg_image_title_horizontal_align',
                [
                    'label' => esc_html__( 'Title Horizontal Alignment', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Start', 'marquee-addons-for-elementor' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
                            'icon' => ' eicon-h-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'End', 'marquee-addons-for-elementor' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'center', 
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-image-panel .deensimc-panel' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'deensimc_bg_image_title_vertical_align',
                [
                    'label' => esc_html__( 'Title Vertical Alignment', 'marquee-addons-for-elementor' ),
                    'type' =>  Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Top', 'marquee-addons-for-elementor' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'end' => [
                            'title' => esc_html__( 'End', 'marquee-addons-for-elementor' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'center', 
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .deensimc-image-panel .deensimc-panel' => 'align-items: {{VALUE}};',
                        '{{WRAPPER}} .deensimc-panel-content' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
    
            $this->end_controls_section();
        }
}
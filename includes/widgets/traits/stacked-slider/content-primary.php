<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Stackedslider_Contents_Primary {
    protected function contents_primary()
    {
        $this->start_controls_section(
			'deensimc_content_section',
			[
				'label' => esc_html__( 'Content', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_responsive_control(
            'deensimc_image_postion_xy',
            [
                'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
            ]
        );
        

        $this->add_control(
			'deensimc_upload_gallery',
			[
				'label' => esc_html__( 'Choose Images', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		
        $this->add_control(
			'deensimc_content_title',
			[
				'label' => esc_html__( 'Title', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Enter your title', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your title here', 'marquee-addons-for-elementor' ),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true
                ]
			]
		);

        $this->add_control(
            'deensimc_content_title_tags',
            [
                'label' => esc_html__( 'Title HTML', 'marquee-addons-for-elementor' ),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h2' => esc_html__( 'H2', 'marquee-addons-for-elementor' ),
                    'h3' => esc_html__( 'H3', 'marquee-addons-for-elementor' ),
                    'h4'  => esc_html__( 'H4', 'marquee-addons-for-elementor' ),
                    'h5' => esc_html__( 'H5', 'marquee-addons-for-elementor' ),
                    'h6' => esc_html__( 'H6', 'marquee-addons-for-elementor' ),
                    'span' => esc_html__( 'Span', 'marquee-addons-for-elementor' ),
                    'p' => esc_html__( 'P', 'marquee-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
			'deensimc_content_description',
			[
				'label' => esc_html__( 'Description', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__( 'Enter your description here', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your description here', 'marquee-addons-for-elementor' ),
                'dynamic' => [
                    'active' => true
                ]
			]
		);

        $this->add_control(
			'deensimc_content_button_text',
			[
				'label' => esc_html__( 'Button Text', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Lets Go', 'marquee-addons-for-elementor' ),
                'separator' => '                                    ',
			]
		);

		$this->add_control(
			'deensimc_content_button_link',
			[
				'label' => esc_html__( 'Button Link', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;


trait Stackedslider_Style_Box {
    protected function style_box() 
    {
        $this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__( 'Box', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
            'deensimc_box_vertical_position_control',
            [
                'label' => esc_html__('Vertical Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-slider-main .deensimc-slider-content' => 'align-self: {{VALUE}};',
					'{{WRAPPER}} .deensimc-image-slider-main .deensimc-slider-media-wrapper' => 'align-self: {{VALUE}};',
				],
            ]
        );

		$this->add_control(
			'deensimc_box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-slider-main' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_spacing',
			[
				'label' => esc_html__( 'Space Between', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-slider-main' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
    }
}


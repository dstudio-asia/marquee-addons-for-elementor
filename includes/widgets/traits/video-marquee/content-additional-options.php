<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Videomarquee_Content_Additional_Options {
    protected function content_additional_options()
    {
        $this->start_controls_section(
			'deensimc_additional_option_section',
			[
				'label' => esc_html__( 'Additional Options',  'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_video_animation_heading',
			[
				'label' => esc_html__( 'Animation',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_video_show_animation',
			[
				'label' => esc_html__( 'Show Animation',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_video_pause_on_hover',
			[
				'label' => esc_html__( 'Pause On Hover',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_video_marquee_show_edge_shadow_switch',
			[
				'label' => esc_html__( 'Show Edge Shadow',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'deensimc_video_marquee_animation_speed',
			[
				'label' => esc_html__( 'Animation Speed',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_responsive_control(
			'deensimc_widget_height',
			[
				'label' => esc_html__( 'Slider Height', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['vh'],
				'range' => [
					'vh' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 60,
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'deensimc_slide_position',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-wrapper-vertical' => 'height: {{SIZE}}vh;',
				],
			]
		);

		$this->end_controls_section();
    }
}
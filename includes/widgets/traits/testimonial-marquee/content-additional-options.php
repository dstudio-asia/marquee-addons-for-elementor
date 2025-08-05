<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Testimonialmarquee_Content_Additional_Options {
	protected function content_additional_options() 
	{
		$this->start_controls_section(
			'deensimc_additional_option_section',
			[
				'label' => esc_html__( 'Marquee Options', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'deensimc_show_animation',
			[
				'label' => esc_html__( 'Animation', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_testimonial_reverse_section',
			[
				'label' => esc_html__( 'Reverse', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'deensimc_testimonial_pause_on_hover',
			[
				'label' => esc_html__( 'Pause On Hover', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_testimonial_marquee_animation_speed',
			[
				'label' => esc_html__( 'Speed', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_control(
			'deensimc_testimonial_show_edge_shadow_switch',
			[
				'label' => esc_html__( 'Show Edge Shadow', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->end_controls_section();
	}
}
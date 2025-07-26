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
				'label' => esc_html__( 'Additional Options', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_show_icons',
			[
				'label' => esc_html__( 'Show Icons', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_excerpt_heading',
			[
				'label' => esc_html__( 'Excerpt', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_length',
			[
				'label' => esc_html__( 'Length', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_title',
			[
				'label' => esc_html__( 'Expand Text', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Show more...', 'marquee-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_title_less',
			[
				'label' => esc_html__( 'Collapse Text', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Show less', 'marquee-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'deensimc_animation_heading',
			[
				'label' => esc_html__( 'Animation', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_show_animation',
			[
				'label' => esc_html__( 'Show Animation', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
			'deensimc_show_shadow_switch',
			[
				'label' => esc_html__( 'Show Shadow', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'deensimc_testimonial_marquee_animation_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->end_controls_section();
	}
}
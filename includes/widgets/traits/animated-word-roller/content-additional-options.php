<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Animated_Word_Roller_Content_Additional_Options {
	protected function content_additional_options() 
	{
		$this->start_controls_section(
			'deensimc_infinite_text_rotation_additional_section',
			[
				'label' => esc_html__( 'Additional Options', 'marquee-addons-for-elementor' ),
				'tab' =>  Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_infinite_text_rotation_delay',
			[
				'label' => esc_html__( 'Active Word Duration', 'marquee-addons-for-elementor' ),
				'description' => esc_html__( 'Time each word stays active (in seconds).', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'deensimc_infinite_text_rotation_visible_word',
			[
				'label' => esc_html__( 'Visible Word', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'deensimc_infinite_text_rotation_alert',
			[
				'type' => Controls_Manager::ALERT,
				'alert_type' => 'warning',
				'heading' => esc_html__( 'Visible Word Notice', 'marquee-addons-for-elementor' ),
				'content' => esc_html__( 'Please make sure to select an odd number that is less than or equal to the total number of words in your list.', 'marquee-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Stackedslider_Contents_Advance {
    protected function contents_advance()
    {
        $this->start_controls_section(
			'deensimc_advance_section',
			[
				'label' => esc_html__( 'Advance', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_show_advance_tab_dot',
			[
				'label' => esc_html__( 'Dots', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_stacked_auto_play',
			[
				'label' => esc_html__( 'Autoplay', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_stacked_animation_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 500,
				'max' => 10000,
				'step' => 1,
				'default' => 2000,
				'condition' => [
					'deensimc_stacked_auto_play' => 'yes',
				],
			]
		);

		$this->end_controls_section();
    }
}
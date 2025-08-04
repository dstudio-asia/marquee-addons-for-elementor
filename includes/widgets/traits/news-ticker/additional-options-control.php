<?php

if (! defined('ABSPATH')) {
	exit;
}
use \Elementor\Controls_Manager;



trait NewsTickerAdditionalOptionsControl {

	protected function additional_options_control(){
		$this->start_controls_section(
			'deensimc_news_ticker_additional_option_section',
			[
				'label' => esc_html__('Marquee Options', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'deensimc_news_ticker_slide_direction',
			[
				'label' => esc_html__('Show Reverse', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'deensimc_news_ticker_pause_on_hover_switch',
			[
				'label' => esc_html__('Pause On Hover', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->add_control(
			'deensimc_news_ticker_text_animation_speed',
			[
				'label' => esc_html__('Animation Speed', 'marquee-addons-for-elementor'),
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
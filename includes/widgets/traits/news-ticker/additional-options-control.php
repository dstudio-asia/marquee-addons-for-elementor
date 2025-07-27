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
				'label' => esc_html__('Additional Options', 'marquee-addons-for-elementor'),
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

		$this->add_responsive_control(
			'deensimc_news_ticker_widget_height',
			[
				'label' => esc_html__('News Ticker Height', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],

				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-marquee' => 'height: {{SIZE}}px;',
				],
			]
		);

		
		$this->add_control(
			'deensimc_seperator_type',
			[
				'label' => __('Separator Type', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'seperator_icon' => __('Icon', 'marquee-addons-for-elementor'),
					'seperator_text' => __('Text', 'marquee-addons-for-elementor'),
				],
				'default' => 'seperator_icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'deensimc_seperator_icon',
			[
				'label' => __('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'deensimc_seperator_type' => 'seperator_icon',
				],
			]
		);
		$this->add_control(
			'deensimc_seperator_text',
			[
				'label' => __('Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('|', 'marquee-addons-for-elementor'),
				'placeholder' => __('Text', 'marquee-addons-for-elementor'),
				'condition' => [
					'deensimc_seperator_type' => 'seperator_text',
				],
			]
		);
		$this->end_controls_section();
	}
		
}
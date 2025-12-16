<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Button_Marquee_Controls
{
	protected function register_button_marquee_section_controls()
	{
		$this->start_controls_section(
			'deensimc_button_marquee_option_section',
			[
				'label' => esc_html__('Marquee Options', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_button_marquee_state',
			[
				'label' => esc_html__('Marquee', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('no', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_button_marquee_direction',
			[
				'label' => esc_html__('Reverse', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('no', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'deensimc_button_marquee_state' => 'yes'
				]
			]
		);

		$this->add_control(
			'deensimc_button_marquee_on_hover',
			[
				'label' => esc_html__('Marquee On Hover', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'deensimc_button_marquee_state' => 'yes'
				]
			]
		);

		$this->add_control(
			'deensimc_button_marquee_speed',
			[
				'label' => esc_html__('Speed', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 10,
				'condition' => [
					'deensimc_button_marquee_state' => 'yes'
				]
			]
		);

		$this->end_controls_section();
	}
}

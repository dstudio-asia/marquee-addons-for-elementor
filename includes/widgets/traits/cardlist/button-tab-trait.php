<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait ButtonTabTrait
{
	protected function clw_button_control_tab($repeater, $tab_name, $prefix = '')
	{
		$repeater->start_controls_tab(
			$tab_name,
			[
				'label' => esc_html__('Button', 'elementor-addon'),
			]

		);

		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__('Text', 'elementor-addon'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Click here', 'elementor-addon'),
				'placeholder' => esc_html__('Click here', 'elementor-addon'),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__('Link', 'elementor-addon'),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
			]
		);

		$repeater->add_control(
			'button_size',
			[
				'label' => esc_html__('Size', 'elementor-addon'),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => esc_html__('Extra Small', 'elementor-addon'),
					'sm' => esc_html__('Small', 'elementor-addon'),
					'md' => esc_html__('Medium', 'elementor-addon'),
					'lg' => esc_html__('Large', 'elementor-addon'),
					'xl' => esc_html__('Extra Large', 'elementor-addon'),
				],
			]
		);


		$repeater->end_controls_tab();
	}

}
<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Textmarquee_Layout_Controls
{
	protected function register_layout_controls()
	{
		$this->start_controls_section(
			'deensimc_layout_section',
			[
				'label' => esc_html__('Layout', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'deensimc_widget_height',
			[
				'label' => esc_html__('Section Height', 'marquee-addons-for-elementor'),
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
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical.deensimc-marquee-main-container' => 'height: {{SIZE}}vh;',
				],
			]
		);
		$this->end_controls_section();
	}
}

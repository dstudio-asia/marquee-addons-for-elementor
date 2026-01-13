<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Stackedslider_Style_Color_Controls
{
	protected function style_color_controls()
	{
		$this->add_control(
			'deensimc_content_colors_heading',
			[
				'label' => esc_html__('Colors', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'deensimc_contents_colors'
		);

		$this->start_controls_tab(
			'deensimc_contents_colors_normal',
			[
				'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_content_title_color',
			[
				'label' => esc_html__('Title Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_content_description_color',
			[
				'label' => esc_html__('Description Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'deensimc_contents_colors_hover',
			[
				'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_content_title_hover_color',
			[
				'label' => esc_html__('Title Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_content_description_hover_color',
			[
				'label' => esc_html__('Description Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-description:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
}

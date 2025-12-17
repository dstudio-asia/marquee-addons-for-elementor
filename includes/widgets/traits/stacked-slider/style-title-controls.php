<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Stroke;

trait Deensimc_Stackedslider_Style_Title_Controls
{
	protected function style_title_controls()
	{
		$this->add_control(
			'deensimc_content_title_heading_style',
			[
				'label' => esc_html__('Title', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_content_title_typography_style',
				'selector' => '{{WRAPPER}} .deensimc-content-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'deensimc_content_title_stroke',
				'selector' => '{{WRAPPER}} .deensimc-content-title',
			]
		);

		$this->add_responsive_control(
			'deensimc_title_spacing',
			[
				'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}
}

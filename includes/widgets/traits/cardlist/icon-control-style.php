<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait IconControlStyleTrait
{
	function clw_icon_control_style($control)
	{
		$control->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__('Icon Style', 'textdomain'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_card_style' => 'icon',
				],
			]
		);

		$control->add_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'textdomain'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 600,
					],
				],
				'default'    => [
					'size' => 200,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$control->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'textdomain'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-wrapper svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$control->end_controls_section();
	}
}

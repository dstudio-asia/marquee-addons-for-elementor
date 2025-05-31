<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Utils;

trait ButtonControlStyleTrait
{
	function clw_button_control_style($control)
	{
		$control->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'elementor-addon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);


		$control->end_controls_tab();

		// Button text color
		$control->start_controls_tabs('button_tabs');

		// Normal state
		$control->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__('Normal', 'elementor-addon'),
			]
		);

		$control->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_control(
			'button_background_color',
			[
				'label' => esc_html__('Background Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$control->end_controls_tab();

		// Hover state
		$control->start_controls_tab(
			'button_hover',
			[
				'label' => esc_html__('Hover', 'elementor-addon'),
			]
		);

		$control->add_control(
			'button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_control(
			'button_hover_background_color',
			[
				'label' => esc_html__('Background Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$control->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$control->end_controls_tab();

		$control->end_controls_tabs();

		// Button border radius

		$control->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',

			]
		);

		$control->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Button padding
		$control->add_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$control->end_controls_section();
	}
}

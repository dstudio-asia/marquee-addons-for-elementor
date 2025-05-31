<?php
// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Text_Stroke;

trait ContentControlStyleTrait
{
	function clw_content_control_style($control)
	{
		$control->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'elementor-addon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_control(
			'card_left_padding',
			[
				'label' => esc_html__('Padding', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-left-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Number Style Section
		$control->add_control(
			'number_style_heading',
			[
				'label' => esc_html__('Number', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$control->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-number' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .deensimc-card-number',
			]
		);

		// $control->end_controls_section();

		// Heading Style
		$control->add_control(
			'heading_style_heading',
			[
				'label' => esc_html__('Heading', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$control->add_control(
			'heading_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .card-heading',
			]
		);
		$control->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .card-heading',
			]
		);

		$control->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__('Heading Spacing', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'min' => 0.1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .card-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		// $control->end_controls_section();

		// Description Style
		$control->add_control(
			'description_style_heading',
			[
				'label' => esc_html__('Description', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);



		$control->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-description' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .deensimc-card-description',
			]
		);
		$control->add_responsive_control(
			'paragraph_spacing',
			[
				'label' => esc_html__('Paragraph Spacing', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'min' => 0.1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$control->end_controls_section();
	}
}

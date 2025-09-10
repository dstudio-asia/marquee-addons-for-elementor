<?php

if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Testimonial_Marquee_Style_Review
{
	protected function style_review()
	{
		$this->start_controls_section(
			'deensimc_tesimonial_review_section',
			[
				'label' => esc_html__('Review', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_tesimonial_review_icon_heading',
			[
				'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_star_spacing',
			[
				'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-ratings span:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_review_star_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-icons i::after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .deensimc-tes-icons-half i::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_review_unmark_star_color',
			[
				'label' => esc_html__('Unmark Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-icons-none i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .deensimc-tes-icons-half i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_review_text_heading',
			[
				'label' => esc_html__('Text', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_tesimonial_review_text_typography',
				'selector' => '{{WRAPPER}} .deensimc-tes-review-text',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_review_text_color',
			[
				'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-review-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_review_global_padding',
			[
				'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-star-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

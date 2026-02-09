<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

trait Testimonial_Marquee_Style_Contents_Box
{
	protected function style_contents_box()
	{
		$this->start_controls_section(
			'deensimc_tesimonial_box_section',
			[
				'label' => esc_html__('Box', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'deensimc_tesimonial_contents_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .deensimc-tes-text',
			]
		);

		$this->add_responsive_control(
			'deensimc_testimonial_widget_box_width',
			[
				'label' => esc_html__('Width', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 220,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 370,
				],

				'selectors' => [
					'{{WRAPPER}} .deensimc-testimonial-marquee .deensimc-tes-main' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_contents_background_overlay',
			[
				'label' => esc_html__('Overlay Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-bg-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_testimonial_widget_height',
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
				'conditions' => [
					'terms' => [
						[
							'name' => 'deensimc_marquee_vertical_orientation',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical.deensimc-marquee-main-container' => 'height: {{SIZE}}vh;',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_contents_padding',
			[
				'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-main blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_testimonial_box_border',
				'selector' => '{{WRAPPER}} .deensimc-tes-main blockquote',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_testimonial_box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', 'rem'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-main blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_testimonial_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-tes-main blockquote',
			]
		);

		$this->end_controls_section();
	}
}

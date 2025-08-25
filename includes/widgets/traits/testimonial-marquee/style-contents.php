<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Testimonial_Marquee_Style_Contents
{
	protected function style_contents()
	{
		$this->start_controls_section(
			'deensimc_tesimonial_content_section',
			[
				'label' => esc_html__('Contents', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_tesimonial_content_heading',
			[
				'label' => esc_html__('Content', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_tesimonial_content_typography',
				'selector' => '{{WRAPPER}} .deensimc-tes-text .deensimc-contents',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_content_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-text .deensimc-contents' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_icon_heading',
			[
				'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_icon_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-testimonial-marquee .deensimc-tes-item blockquote i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .deensimc-testimonial-marquee .deensimc-tes-item blockquote svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_icon_size',
			[
				'label' => esc_html__('Size', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-text .contents-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-tes-text .contents-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_tesimonial_unfold_section',
			[
				'label' => esc_html__('Text Unfold', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_tesimonial_excerpt_typography',
				'selector' => '{{WRAPPER}} .deensimc-toggle',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-toggle' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'deensimc_tesimonial_excerpt_color_hover',
			[
				'label' => esc_html__('Hover Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-toggle:hover' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}
}

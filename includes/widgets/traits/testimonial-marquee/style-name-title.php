<?php

if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Testimonial_Marquee_Style_Name_Title
{
	protected function style_name_title()
	{
		$this->start_controls_section(
			'deensimc_tesimonial_name_section',
			[
				'label' => esc_html__('Name', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_tesimonial_name_typography',
				'selector' => '{{WRAPPER}} .deensimc-tes-heading .deensimc-tes-name',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_name_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-heading .deensimc-tes-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_name_spacing',
			[
				'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-heading .deensimc-tes-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_tesimonial_title_section',
			[
				'label' => esc_html__('Title', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_tesimonial_title_typography',
				'selector' => '{{WRAPPER}} .deensimc-tes-heading .deensimc-tes-title',
			]
		);

		$this->add_control(
			'deensimc_tesimonial_title_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes-heading .deensimc-tes-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}
}

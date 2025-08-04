<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

trait Imagemarquee_Style_Border_Options
{
	protected function style_border_options()
	{
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_image_global_border',
				'selector' => '{{WRAPPER}} .deensimc-marquee-group img',
			]
		);

		$this->add_responsive_control(
			'deensimc_image_global_border_radius',
			[
				'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_image_marquee_edge_shadow_color',
			[
				'label' => esc_html__('Edge SHadow Color',  'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee.deensimc-shadow' => '--edge-shadow-color: {{VALUE}};',
				],
				'condition' => [
					'deensimc_image_show_edge_shadow_switch' => 'yes',
				],
			]
		);

		$this->add_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label' => esc_html__('Edge Shadow Spread', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
					'rem' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee.deensimc-shadow' => '--edge-shadow-spread: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'deensimc_image_show_edge_shadow_switch' => 'yes',
				],
			]
		);
	}
}

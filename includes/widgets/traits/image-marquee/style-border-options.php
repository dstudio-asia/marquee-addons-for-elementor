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
				'separator' => 'before'
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
	}
}

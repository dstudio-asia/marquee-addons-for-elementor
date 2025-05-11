<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

trait Imagemarquee_Style_Border_Options {
	protected function style_border_options() 
	{
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_image_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-horizontal::before, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-horizontal::after, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-vertical::before, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-vertical::after',
				'condition' => [
					'deensimc_image_show_shadow_switch' => 'yes',
				]
			]
		);

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
				'label' => esc_html__( 'Border Radius', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}
}
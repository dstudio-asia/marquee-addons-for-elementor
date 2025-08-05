<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;


trait Testimonial_marquee_Style_Edge_Shadow {
    protected function style_edge_shadow()
    {

		$this->start_controls_section(
			'deensimc_testimonial_marquee_edge_shadow',
			[
				'label' => esc_html__( 'Edge Shadow',  'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'=>[
					'deensimc_testimonial_show_edge_shadow_switch' => 'yes'
				]
			]
		);

		$this->add_control(
			'deensimc_testimonial_marquee_edge_shadow_color',
			[
				'label' => esc_html__( 'Color',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee.deensimc-shadow' => '--edge-shadow-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_testimonial_marquee_edge_shadow_spread',
			[
				'label' => esc_html__( 'Size', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
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
			]
		);
		$this->add_responsive_control(
			'deensimc_testimonial_marquee_edge_shadow_blur',
			[
				'label' => esc_html__( 'Blur', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee.deensimc-shadow' => '--edge-shadow-blur: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
    }
}
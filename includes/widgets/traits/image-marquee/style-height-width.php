<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Imagemarquee_Style_Height_Width {
	protected function style_height_width() 
	{
		$this->add_responsive_control(
			'deensimc_image_width',
			[
				'label' => esc_html__( 'Image Width', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'deensimc_image_max_width',
			[
				'label' => esc_html__( 'Image Max Width', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-img-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_height',
			[
				'label' => esc_html__( 'Height', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);
	}
}
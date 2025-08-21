<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Imagemarquee_Style_Alignment_Spacing {
	protected function style_alignment_spacing() 
	{
		$this->add_responsive_control(
			'deensimc_horizontal_align',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical .deensimc-marquee-group' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .deensimc-marquee-group a' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'deensimc_slide_position' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_vertical_align',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-img-wrapper' => 'align-self: {{VALUE}};',
					'{{WRAPPER}} .deensimc-marquee-group a' => 'align-self: {{VALUE}};',
				],
				'condition' => [
					'deensimc_slide_position!' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_marquee_spacing',
			[
				'label' => esc_html__( 'Gap', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee' => '--deensimc-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}
}
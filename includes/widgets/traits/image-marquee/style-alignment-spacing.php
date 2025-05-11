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
				'label' => esc_html__( 'Horizontal Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-wrapper.deensimc-wrapper-vertical' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_vertical_align',
			[
				'label' => esc_html__( 'Vertical Alignment', 'marquee-addons-for-elementor' ),
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
			]
		);

		$this->add_responsive_control(
			'deensimc_image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'marquee-addons-for-elementor' ),
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
					'{{WRAPPER}} .deensimc-marquee-group' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-marquee-group:nth-child(2)' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-wrapper-vertical .deensimc-marquee-vertical .deensimc-marquee-group:nth-child(2)' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left:0px;',
				],
			]
		);
	}
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Stackedslider_Style_Dots {
    protected function style_dots() 
    {
        $this->start_controls_section(
			'deensimc_dot_style_section',
			[
				'label' => esc_html__( 'Dots', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_dot_active_color',
			[
				'label' => esc_html__( 'Dot Active Color', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_dot_distance',
			[
				'label' => esc_html__( 'Dot Distance', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_advance_tab_dot_alignment',
			[
				'label' => esc_html__( 'Text Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-swiper-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
    }
}
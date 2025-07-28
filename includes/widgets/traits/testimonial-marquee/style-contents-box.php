<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait Testimonialmarquee_Style_Contents_Box {
	protected function style_contents_box() 
	{
		$this->start_controls_section(
			'deensimc_tesimonial_box_section',
			[
				'label' => esc_html__( 'Box', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'deensimc_tesimonial_contents_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .deensimc-tes-text',
			]
		);

		$this->add_responsive_control(
			'deensimc_tesimonial_contents_gap',
			[
				'label' => esc_html__( 'Box Gap', 'marquee-addons-for-elementor' ),
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
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes .deensimc-tes-logo .deensimc-tes-content' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_tesimonial_contents_padding',
			[
				'label' => esc_html__( 'Padding', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes .deensimc-tes-main blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_testimonial_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-tes .deensimc-shadow.deensimc-tes-logo::before, 
				{{WRAPPER}} .deensimc-tes .deensimc-shadow.deensimc-tes-logo::after',
				'condition' => [
					'deensimc_show_shadow_switch' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_testimonial_box_border',
				'selector' => '{{WRAPPER}} .deensimc-tes .deensimc-tes-main blockquote',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_testimonial_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ], 
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes .deensimc-tes-main blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}
}
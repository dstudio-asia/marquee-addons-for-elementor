<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

trait Textmarquee_Style_Text_Contents {
    protected function style_text_contents()
    {
		$this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__( 'Contents', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'deensimc_icon_color',
			[
				'label' => esc_html__( 'Color', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-text-wrapper svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .deensimc-text-wrapper i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-text-wrapper svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-text-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_icon_spacing_from_content',
			[
				'label' => esc_html__( 'Icon Spacing', 'marquee-addons-for-elementor' ),
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
					'{{WRAPPER}} .deensimc-marquee .deensimc-text-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_content_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'marquee-addons-for-elementor' ),
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

		$this->add_control(
			'deensimc_text_heading',
			[
				'label' => esc_html__( 'Text', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_scroll_text_typography',
				'selector' => '{{WRAPPER}} .deensimc-scroll-text',
			]
		);

		$this->add_control(
			'deensimc_scroll_text_color',
			[
				'label' => esc_html__( 'Color', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-scroll-text' => 'color: {{VALUE}}',
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_text_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-horizontal::before, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-horizontal::after, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-vertical::before, 
				{{WRAPPER}} .deensimc-marquee.deensimc-shadow.deensimc-marquee-vertical::after',
				'condition' => [
					'deensimc_show_shadow_switch' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

trait Videomarquee_Style_Contents {
    protected function style_contents()
    {
        $this->start_controls_section(
			'deensimc_videos_style_section',
			[
				'label' => esc_html__( 'Videos',  'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_videos_aspect_ratio',
			[
				'label' => esc_html__( 'Aspect Ratio',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'16/9' => '16:9',
					'12/9' => '21:9',
					'4/3' => '4:3',
					'3/2' => '3:2',
					'1/1' => '1:1',
					'9/16' => '9:16',
				],
				'default' => '16/9',
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-main .deensimc-marquee .deensimc-video-item' => 'aspect-ratio: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_videos_gap',
			[
				'label' => esc_html__( 'Gap',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-marquee-group:nth-child(2)' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-wrapper-vertical .deensimc-marquee-vertical .deensimc-marquee-group:nth-child(2)' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left:0px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'custom_css_filters',
				'selector' => '{{WRAPPER}} .deensimc-video-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_video_box_border',
				'selector' => '{{WRAPPER}} .deensimc-marquee-group .deensimc-video-item',
			]
		);

		$this->add_control(
			'deensimc_video_marquee_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-video-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-video-item iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-video-item video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-marquee-group .deensimc-video-placeholder img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_video_marquee_edge_shadow_color',
			[
				'label' => esc_html__('Edge Shadow Color',  'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee.deensimc-shadow' => '--edge-shadow-color: {{VALUE}};',
				],
				'condition' => [
					'deensimc_video_marquee_show_edge_shadow_switch' => 'yes',
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
					'deensimc_video_marquee_show_edge_shadow_switch' => 'yes',
				],
			]
		);

		$this->end_controls_section();
    }
}
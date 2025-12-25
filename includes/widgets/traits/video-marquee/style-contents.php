<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

trait Deensimc_Videomarquee_Style_Contents
{
	protected function style_contents()
	{
		$this->start_controls_section(
			'deensimc_videos_style_section',
			[
				'label' => esc_html__('Videos',  'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_videos_aspect_ratio',
			[
				'label' => esc_html__('Aspect Ratio',  'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'16/9' => '16:9',
					'21/9' => '21:9',
					'4/3' => '4:3',
					'3/2' => '3:2',
					'1/1' => '1:1',
					'9/16' => '9:16',
				],
				'default' => '16/9',
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item' => 'aspect-ratio: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_video_width',
			[
				'label' => esc_html__('Width', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_widget_height',
			[
				'label' => esc_html__('Section Height', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['vh'],
				'range' => [
					'vh' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 60,
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'deensimc_marquee_vertical_orientation',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical.deensimc-marquee-main-container' => 'height: {{SIZE}}vh;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'deensimc_custom_css_filters',
				'selector' => '{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_video_box_border',
				'selector' => '{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item ',
			]
		);

		$this->add_control(
			'deensimc_video_marquee_border_radius',
			[
				'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-marquee .deensimc-video-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

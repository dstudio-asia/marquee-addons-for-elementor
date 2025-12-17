<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;


trait Deensimc_Stackedslider_Style_Image
{
	protected function style_image()
	{
		$this->start_controls_section(
			'deensimc_image_style_section',
			[
				'label' => esc_html__('Image', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'deensimc_image_alignment_control',
			[
				'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'auto 0 0 0' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'0 auto' => [
						'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'0 0 0 auto' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '0 auto',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-slider-media.deensimc-ds-swiper' => 'margin: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_width',
			[
				'label' => esc_html__('Width', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'size' => 600,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-slider-main .swiper' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_padding',
			[
				'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'default' => [
					'top' => 70,
					'right' => 70,
					'bottom' => 70,
					'left' => 70,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-slider-main .swiper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

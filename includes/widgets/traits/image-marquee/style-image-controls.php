<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

trait Deensimc_Image_Marquee_Image_Style
{
	protected function register_image_style_controls()
	{
		$this->start_controls_section(
			'deensimc_image_marquee_image_style_section',
			[
				'label' => esc_html__('Image', 'marquee-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'deensimc_horizontal_align',
			[
				'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors_dictionary' => [
					'left' => 'margin-left: 0; margin-right: auto;',
					'center' => 'margin-left: auto; margin-right: auto;',
					'right' => 'margin-left: auto; margin-right: 0;',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-marquee .deensimc-marquee-track-wrapper' => '{{VALUE}};',
				],
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_vertical_align',
			[
				'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-image-marquee .deensimc-marquee-track' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'deensimc_marquee_orientation!' => 'yes',
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
					'size' => 250,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_height',
			[
				'label' => esc_html__('Height', 'marquee-addons-for-elementor'),
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
					'{{WRAPPER}} .deensimc-img-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
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
			Group_Control_Border::get_type(),
			[
				'name' => 'deensimc_image_global_border',
				'selector' => '{{WRAPPER}} .deensimc-img-wrapper img',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'deensimc_image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
}

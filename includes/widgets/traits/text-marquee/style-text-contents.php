<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Textmarquee_Style_Text_Contents
{
	protected function style_text_contents()
	{
		$this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__('Texts', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_text_heading',
			[
				'label' => esc_html__('Text', 'marquee-addons-for-elementor'),
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

		$this->start_controls_tabs('deensimc_scroll_text_color_tabs');

		$this->start_controls_tab(
			'deensimc_scroll_text_color_normal',
			[
				'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_scroll_text_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-scroll-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'deensimc_scroll_text_color_hover',
			[
				'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_scroll_text_hover_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type'  => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-scroll-text:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical.deensimc-marquee-main-container' => 'height: {{SIZE}}vh;',
				],
			]
		);


		$this->add_control(
			'deensimc_icon_heading',
			[
				'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'deensimc_icon_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
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
				'label' => esc_html__('Size', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
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
				'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'{{WRAPPER}} .deensimc-text-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_icon_vertical_alignment',
			[
				'label' => esc_html__('Vertical Alignment', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .deensimc-text-wrapper svg' => 'align-self: {{VALUE}}; flex-shrink: 0;',
					'{{WRAPPER}} .deensimc-text-wrapper i' => 'align-self: {{VALUE}}; flex-shrink: 0;',
				],
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_icon_adjust_vertical_position',
			[
				'label' => esc_html__('Adjust Vertical Position', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => -16,
						'max' => 16,
						'step' => 1,
					],
					'em' => [
						'min' => -1,
						'max' => 1,
						'step' => 0.1,
					],
					'rem' => [
						'min' => -1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-text-wrapper svg' => 'margin-block: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-text-wrapper i' => 'margin-block: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
			]
		);
		// animation 
		$this->add_control(
			'deensimc_icon_animation',
			[
				'label' => esc_html__('Auto Rotation', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'deensimc_icon_rotation_speed',
			[
				'label' => esc_html__('Speed', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'condition' => [
					'deensimc_icon_animation' => 'yes'
				]
			]
		);

		$this->add_control(
			'deensimc_icon_rotation_direction',
			[
				'label' => esc_html__('Direction', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'anticlockwise' => esc_html__('Anti-Clockwise', 'marquee-addons-for-elementor'),
					'clockwise' => esc_html__('Clockwise', 'marquee-addons-for-elementor'),
				],
				'default' => 'anticlockwise',
				'condition' => [
					'deensimc_icon_animation' => 'yes'
				]
			]
		);
		$this->end_controls_section();
	}
}

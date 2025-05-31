<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait CLWImageControlStyleTrait
{
	function clw_image_control_style($control)
	{
		$control->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__('Image Style', 'elementor-addon'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_style' => 'image',
				],
			]
		);

		$control->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__('Width', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-image img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.image-position-left .clw-card-image img' => 'margin-right: auto;',
					'{{WRAPPER}}.image-position-right .clw-card-image img' => 'margin-left: auto;',
				],
			]
		);
		$control->add_responsive_control(
			'space',
			[
				'label' => esc_html__('Max Width', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$control->add_responsive_control(
			'height',
			[
				'label' => esc_html__('Height', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$control->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$control->start_controls_tabs('image_effects');

		$control->start_controls_tab(
			'normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$control->end_controls_tab();

		$control->start_controls_tab(
			'hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		$control->add_control(
			'opacity_hover',
			[
				'label' => esc_html__('Opacity', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-image:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$control->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .clw-card-image:hover img'
			]
		);

		$control->add_control(
			'background_hover_transition',
			[
				'label' => esc_html__('Transition Duration', 'elementor') . ' (s)',
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-image img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);


		$control->end_controls_tab();

		$control->end_controls_tabs();

		$control->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .clw-card-image img',
				'separator' => 'before',
			]
		);


		$control->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .clw-card-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$control->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .clw-card-image img',
			]
		);

		$control->end_controls_section();
	}
}

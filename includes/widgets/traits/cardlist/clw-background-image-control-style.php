<?php

// Elementor Classes
use \Elementor\Controls_Manager;


trait CLWBackgroundImageControlStyleTrait
{
	function clw_background_image_control_style($control)
	{
		$control->start_controls_section(
			'background_image_style',
			[
				'label' => esc_html__('Background Image Style', 'textdomain'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'card_style' => 'background_image',
				],
			]
		);

		// // Background Size
		$control->add_control(
			'background_size',
			[
				'label' => esc_html__('Size', 'textdomain'),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => esc_html__('Cover', 'textdomain'),
					'contain' => esc_html__('Contain', 'textdomain'),
					'auto' => esc_html__('Auto', 'textdomain'),
					'custom' => esc_html__('Custom', 'textdomain'),
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]' => 'background-size: {{VALUE}};',
				],
			]
		);

		$control->add_control(
			'background_custom_size',
			[
				'label' => esc_html__('Custom Size', 'textdomain'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vw', 'vh'],
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
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]' => 'background-size: {{SIZE}}{{UNIT}} auto;',
				],
				'condition' => [
					'background_size' => 'custom',
				],
			]
		);

		// Background Position
		$control->add_control(
			'background_position',
			[
				'label' => esc_html__('Position', 'textdomain'),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'top left' => esc_html__('Top Left', 'textdomain'),
					'top center' => esc_html__('Top Center', 'textdomain'),
					'top right' => esc_html__('Top Right', 'textdomain'),
					'center left' => esc_html__('Center Left', 'textdomain'),
					'center center' => esc_html__('Center Center', 'textdomain'),
					'center right' => esc_html__('Center Right', 'textdomain'),
					'bottom left' => esc_html__('Bottom Left', 'textdomain'),
					'bottom center' => esc_html__('Bottom Center', 'textdomain'),
					'bottom right' => esc_html__('Bottom Right', 'textdomain'),
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item' => 'background-position: {{VALUE}};',
				],
			]
		);

		// Background Repeat
		$control->add_control(
			'background_repeat',
			[
				'label' => esc_html__('Repeat', 'textdomain'),
				'type' => Controls_Manager::SELECT,
				'default' => 'no-repeat',
				'options' => [
					'no-repeat' => esc_html__('No Repeat', 'textdomain'),
					'repeat' => esc_html__('Repeat', 'textdomain'),
					'repeat-x' => esc_html__('Repeat X', 'textdomain'),
					'repeat-y' => esc_html__('Repeat Y', 'textdomain'),
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]' => 'background-repeat: {{VALUE}};',
				],
			]
		);

		// Background Attachment
		$control->add_control(
			'background_attachment',
			[
				'label' => esc_html__('Attachment', 'textdomain'),
				'type' => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => [
					'scroll' => esc_html__('Scroll', 'textdomain'),
					'fixed' => esc_html__('Fixed', 'textdomain'),
					'local' => esc_html__('Local', 'textdomain'),
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]' => 'background-attachment: {{VALUE}};',
				],
			]
		);

		// Background Blend Mode
		$control->add_control(
			'background_blend_mode',
			[
				'label' => esc_html__('Blend Mode', 'textdomain'),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__('Normal', 'textdomain'),
					'multiply' => esc_html__('Multiply', 'textdomain'),
					'screen' => esc_html__('Screen', 'textdomain'),
					'overlay' => esc_html__('Overlay', 'textdomain'),
					'darken' => esc_html__('Darken', 'textdomain'),
					'lighten' => esc_html__('Lighten', 'textdomain'),
					'color-dodge' => esc_html__('Color Dodge', 'textdomain'),
					'color-burn' => esc_html__('Color Burn', 'textdomain'),
					'difference' => esc_html__('Difference', 'textdomain'),
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]' => 'background-blend-mode: {{VALUE}};',
				],
			]
		);

		// Overlay Color
		$control->add_control(
			'background_overlay_color',
			[
				'label' => esc_html__('Overlay Color', 'textdomain'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]::after' => 'content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: {{VALUE}};',
				],
			]
		);

		$control->add_control(
			'background_overlay_opacity',
			[
				'label' => esc_html__('Overlay Opacity', 'textdomain'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item[style*="background-image"]::after' => 'opacity: calc({{SIZE}} / 100);',
				],
			]
		);

		$control->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$control->end_controls_section();
	}
}

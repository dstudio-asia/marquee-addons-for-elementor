<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;

trait Deensimc_Videomarquee_Style_Play_Icon
{
	protected function style_play_icon()
	{
		$this->start_controls_section(
			'deensimc_image_overlay_style_section',
			[
				'label' => esc_html__('Play Icon',  'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_image_overlay_icon_color',
			[
				'label' => esc_html__('Color',  'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-placeholder i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .deensimc-video-placeholder svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_image_overlay_icon_size',
			[
				'label' => esc_html__('Size',  'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-placeholder i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .deensimc-video-placeholder svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'deensimc_image_overlay_icon_box_shadow',
				'selector' => '{{WRAPPER}} .deensimc-video-placeholder .deensimc-play-button',
			]
		);

		$this->end_controls_section();
	}
}

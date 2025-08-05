<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

trait Imagemarquee_Style_Caption {
    protected function style_caption()
    {

		$this->start_controls_section(
			'deensimc_image_marquee_caption_style_section',
			[
				'label' => esc_html__( 'Caption',  'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'deensimc_caption_type!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'deensimc_image_marquee_caption_alignment',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption' => 'text-align: {{VALUE}};   justify-self: {{VALUE}}; white-space: normal;',
				],
			]
		);

		$this->add_control(
			'deensimc_image_marquee_caption_color',
			[
				'label' => esc_html__( 'Text Color', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'deensimc_image_marquee_caption_background_color',
			[
				'label' => esc_html__( 'Background Color', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption' => 'background-color: {{VALUE}};     width: 100%;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_image_marquee_caption_typography',
				'selector' => '{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'deensimc_image_marquee_caption_text_shadow',
				'selector' => '{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption',
			]
		);

		$this->add_responsive_control(
			'deensimc_image_marquee_caption_spacing',
			[
				'label' => esc_html__( 'Space', 'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem',  ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 15,
						'step' => 1,
					],
					'rem' => [
						'min' => 0,
						'max' => 15,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-img-wrapper .elementor-image-marquee-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
    }
}
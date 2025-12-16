<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;


trait Stackedslider_Style_Contents {

    protected function style_contents() 
    {
        $this->start_controls_section(
			'deensimc_content_style_section',
			[
				'label' => esc_html__( 'Contents', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'deensimc_box_alignment_control',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .deensimc-image-slider-main .deensimc-slider-content .deensimc-slider-des p' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .deensimc-image-slider-main .deensimc-slider-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_content_padding',
			[
				'label' => esc_html__( 'Padding', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'default' => [
					'top' => 30,
					'right' => 40,
					'bottom' => 50,
					'left' => 40,
					'unit' => 'px',
					'isLinked' => true,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .deensimc-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->style_title_controls();
		$this->style_description_controls();
		$this->style_color_controls();

		$this->add_control(
			'deensimc_content_button_heading',
			[
				'label' => esc_html__( 'Button', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
		   [
			   'name' => 'deensimc_content_button_typography',
			   'selector' => '{{WRAPPER}} .deensimc-image-slider-main .deensimc-slider-content .deensimc-content-btn',
			   'separator' => 'after'
		   ]
	   );

		$this->add_responsive_control(
			'deensimc_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .deensimc-content-btn' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->style_button_controls();

		$this->end_controls_section();
    }
}
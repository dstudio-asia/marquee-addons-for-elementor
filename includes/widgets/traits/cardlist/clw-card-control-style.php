<?php
// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait CLWCardControlStyleTrait{
	function clw_card_control_style($control) {
		$control->start_controls_section(
			'section_card_style',
			[
				'label' => esc_html__('Card Style', 'elementor-addon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_responsive_control(
			'space_between_cards',
			[
				'label' => esc_html__('Space Between Cards', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$control->add_responsive_control(
			'card_image_spacing',
			[
				'label' => esc_html__('Image Spacing', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clw-card-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$control->add_responsive_control(
			'horizontal_align',
			[
				'label' => esc_html__('Horizontal Alignment', 'elementor-addon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'elementor-addon'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'elementor-addon'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'elementor-addon'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',


				'selectors' => [
					'{{WRAPPER}} .clw-card-left-section' => 'align-items: {{VALUE}};',
					// Image Position: Top
					'{{WRAPPER}}.align-start.image-position-top .clw-card-image' => 'margin-left: 0; margin-right: auto;',
					'{{WRAPPER}}.align-center.image-position-top .clw-card-image' => 'margin-inline: auto;',
					'{{WRAPPER}}.align-end.image-position-top .clw-card-image' => 'margin-left: auto; margin-right: 0;',

					// Image Position: Bottom
					'{{WRAPPER}}.align-start.image-position-bottom .clw-card-image' => 'margin-left: 0; margin-right: auto;',
					'{{WRAPPER}}.align-center.image-position-bottom .clw-card-image' => 'margin-inline: auto;',
					'{{WRAPPER}}.align-end.image-position-bottom .clw-card-image' => 'margin-left: auto; margin-right: 0;',
				],
				'condition' => [
					'deensimc_card_style' => ['image', 'icon'],
				],

				'prefix_class' => 'align-', // 
				'separator' => 'after',
			]
		);

		$control->add_responsive_control(
			'card_horizontal_align',
			[
				'label' => esc_html__('Background Horizontal Alignment', 'elementor-addon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'elementor-addon'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'elementor-addon'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'elementor-addon'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .clw-card-left-section' => 'align-items: {{VALUE}};flex: 1;max-width: 100%;display: flex;flex-direction: column;gap: 15px;',

				],
				'condition' => [
					'deensimc_card_style' => ['background_image'],
				],
				'prefix_class' => 'align-', // 
				'separator' => 'after',
			]
		);

		// Add vertical alignment control
		$control->add_responsive_control(
			'vertical_align',
			[
				'label' => esc_html__('Vertical Alignment', 'elementor-addon'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Top', 'elementor-addon'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Middle', 'elementor-addon'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__('Bottom', 'elementor-addon'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'selectors' => [
					// Only for left/right image layouts (flex-direction: row)
					'{{WRAPPER}}.image-position-left .clw-card-content-wrapper' => 'align-items: {{VALUE}};',
					'{{WRAPPER}}.image-position-right .clw-card-content-wrapper' => 'align-items: {{VALUE}};',
				],
				'prefix_class' => 'va-', // va = vertical alignment
				'condition' => [
					'image_position' => ['left', 'right'],



				],
			]
		);


		$control->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__('Padding', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .clw-card-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$control->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__('Margin', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .clw-card-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$control->add_control(
			'card_bg_color',
			[
				'label' => esc_html__('Background Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clw-card-content-wrapper' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'deensimc_card_style' => ['image', 'icon'],
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'card_border',
				'selector' => '{{WRAPPER}} .clw-card-content-wrapper',
				'condition' => [
					'deensimc_card_style' => ['image', 'icon'],
				],
			]
		);


		$control->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .clw-card-content-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$control->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'selector' => '{{WRAPPER}} .clw-card-list-item',
			]
		);


		$control->end_controls_section();
	}
}
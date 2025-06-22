<?php
// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Text_Stroke;

trait ContentControlStyleTrait
{
	function clw_content_control_style($control)
	{
		$control->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'elementor-addon'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_control(
			'card_left_padding',
			[
				'label' => esc_html__('Padding', 'elementor-addon'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-left-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Number Style Section
		$control->add_control(
			'number_style_heading',
			[
				'label' => esc_html__('Number', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'heading_number_margin_right',
			[
				'label' => esc_html__('Number Gap', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 0,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-number' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_number_margin_right',
			[
				'label' => esc_html__('Number Margin Right', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-number' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// $this->add_responsive_control(
		// 	'heading_number_vertical_align',
		// 	[
		// 		'label' => esc_html__('Number Vertical Align', 'elementor-addon'),
		// 		'type' => \Elementor\Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'flex-start' => [
		// 				'title' => esc_html__('Top', 'elementor-addon'),
		// 				'icon' => 'eicon-v-align-top',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__('Middle', 'elementor-addon'),
		// 				'icon' => 'eicon-v-align-middle',
		// 			],
		// 			'flex-end' => [
		// 				'title' => esc_html__('Bottom', 'elementor-addon'),
		// 				'icon' => 'eicon-v-align-bottom',
		// 			],
		// 		],
		// 		'default' => 'center',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .deensimc-heading-with-number' => 'align-items: {{VALUE}};',
		// 		],
		// 	]
		// );


		$control->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-number' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .deensimc-card-number',
			]
		);

		// $control->end_controls_section();

		// Heading Style
		$control->add_control(
			'heading_style_heading',
			[
				'label' => esc_html__('Heading', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$control->add_control(
			'heading_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .card-heading',
			]
		);
		$control->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .card-heading',
			]
		);

		$control->add_responsive_control(
			'heading_spacing',
			[
				'label' => esc_html__('Heading Spacing', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'min' => 0.1,
						'max' => 20,
					],
				],
				'selectors' => [
					// '{{WRAPPER}} .card-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .deensimc-heading-with-number' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		// $control->end_controls_section();

		// Description Style
		$control->add_control(
			'description_style_heading',
			[
				'label' => esc_html__('Description', 'elementor-addon'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);



		$control->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-description' => 'color: {{VALUE}};',
				],
			]
		);

		// $control->add_group_control(
		// 	\Elementor\Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'description_typography',
		// 		'selector' => '{{WRAPPER}} .deensimc-card-description',
		// 	]
		// );

		$control->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .deensimc-card-description',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_size' => [
						'default' => [
							'size' => 18,
							'unit' => 'px',
						],
					],
				],
			]
		);

		$control->add_responsive_control(
			'paragraph_spacing',
			[
				'label' => esc_html__('Paragraph Spacing', 'elementor-addon'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'min' => 0.1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-card-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$control->end_controls_section();

		// Add this in your register_controls() method, preferably in the style section
		$this->start_controls_section(
			'read_more_style_section',
			[
				'label' => esc_html__('Read More/Less Style', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'label' => esc_html__('Typography', 'marquee-addons-for-elementor'),
				'selector' => '{{WRAPPER}} .desc-toggle',
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc-toggle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'label' => esc_html__('Hover Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc-toggle:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'read_more_spacing',
			[
				'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .desc-toggle' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'read_more_custom_text',
			[
				'label' => esc_html__('Custom Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label' => esc_html__('"More" Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('More', 'marquee-addons-for-elementor'),
				'condition' => [
					'read_more_custom_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'read_less_text',
			[
				'label' => esc_html__('"Less" Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Less', 'marquee-addons-for-elementor'),
				'condition' => [
					'read_more_custom_text' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}
}

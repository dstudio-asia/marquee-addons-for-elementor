<?php

if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Group_Control_Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;

trait Deensimc_NewsTickerStyleControl
{

	protected function style_section_control()
	{
		$this->start_controls_section(
			'deensimc_container_style',
			[
				'label' => __('Layout', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'deensimc_news_ticker_widget_height',
			[
				'label' => esc_html__('Height', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1000,
					],
					'em' => [
						'min' => 1,
						'max' => 100,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'deensimc_container_background_color',
				'types'    => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .deensimc-news-ticker',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'deensimc_container_border',
				'label'    => __('Container Border', 'marquee-addons-for-elementor'),
				'selector' => '{{WRAPPER}} .deensimc-news-ticker',
			]
		);

		// (Optional) border radius
		$this->add_control(
			'deensimc_container_border_radius',
			[
				'label'      => __('Border Radius', 'marquee-addons-for-elementor'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .deensimc-news-ticker' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'deensimc_news_ticker_label_heading',
			[
				'label' => __('Title', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'deensimc_news_ticker_label_alignment',
			[
				'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-order-start',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-order-end',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'deensimc_label_color',
			[
				'label' => __('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,

				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-label-heading' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'deensimc_label_background_color',
				'types'    => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .deensimc-news-ticker-label',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_label_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],

				'selector' => '{{WRAPPER}} .deensimc-label-heading > *'
			]
		);


		$this->add_control(
			'deensimc_title_icon_color',
			[
				'label' => __('Icon Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,

				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-icon' => 'color: {{VALUE}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'deensimc_title_icon_size',
			[
				'label' => __('Icon Size', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'deensimc_label_icon_indent',
			[
				'label' => __('Icon Spacing', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],

				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label .deensimc-news-ticker-icon' => 'margin-inline-end: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_title_style',
			[
				'label' => __('Content', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'deensimc_title_color',
			[
				'label' => __('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#1E293B',
				'selectors' => [
					'{{WRAPPER}} .deensimc-title-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'deensimc_title_hover_color',
			[
				'label' => __('Hover Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#1E293B',
				'selectors' => [
					'{{WRAPPER}} .deensimc-title-link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_title_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-title-link',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_icon_style',
			[
				'label' => __('Icon Separator', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_seperator_type' => 'seperator_icon',
				],
			]
		);
		$this->add_control(
			'deensimc_icon_color',
			[
				'label' => __('Icon Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#010813ff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-icon svg' => 'fill: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'deensimc_icon_size',
			[
				'label' => __('Icon Size', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();





		$this->start_controls_section(
			'deensimc_separator_text_style',
			[
				'label' => __('Text Separator', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_seperator_type' => 'seperator_text',
				],
			]
		);
		$this->add_control(
			'deensimc_separator_text_color',
			[
				'label' => __('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '#010813ff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_separator_text_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-seperator-text',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_seperator_date',
			[
				'label' => __('Date Separator', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_seperator_type' => 'seperator_date',
				],
			]
		);
		$this->add_control(
			'deensimc_separator_date_color',
			[
				'label' => __('Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#010813ff',
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .deensimc-seperator-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_separator_date_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-seperator-date',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_seperator_image',
			[
				'label' => __('Feature Image Separator', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'deensimc_seperator_type' => 'seperator_feature_image',
				],
			]
		);


		$this->add_control(
			'deensimc_separator_image_size',
			[
				'label' => __('Image Size', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 10,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-feature-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}
}

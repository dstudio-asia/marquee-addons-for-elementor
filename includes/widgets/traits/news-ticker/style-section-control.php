<?php

if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Group_Control_Typography;
use \Elementor\Controls_Manager;
use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;




trait NewsTickerStyleControl
{

	protected function style_section_control()
	{
		$this->start_controls_section(
			'deensimc_container_style',
			[
				'label' => __('Container', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'deensimc_container_background_color',
			[
				'label' => __('Background Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default' => '#F1F1F1',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__('Label', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_label_icon_indent',
			[
				'label' => __('Icon Spacing', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label .deensimc-news-ticker-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'deensimc_label_color',
			[
				'label' => __('Label Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .deensimc-news-ticker-label .news-ticker-icon' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'deensimc_label_background_color',
			[
				'label' => __('Background Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default' => '#666666',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'deensimc_label_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-news-ticker-label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_title_style',
			[
				'label' => __('Title', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'deensimc_title_padding',
			[
				'label'         => esc_html__('Padding', 'marquee-addons-for-elementor'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'default'       => [
					'unit'  => 'px',
					'top'   => 0,
					'right' => 20,
					'bottom' => 0,
					'left'  => 20,
				],
				'selectors'     => [
					'{{WRAPPER}} .deensimc-title-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'deensimc_title_color',
			[
				'label' => __('Title Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-title-link' => 'color: {{VALUE}};',
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
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'default' => [
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
				'label' => __('Text Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'deensimc_separator_text_bg_color',
			[
				'label' => __('Background Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default' => '#595959',
				'selectors' => [

					'{{WRAPPER}} .deensimc-seperator-text' => 'background-color: {{VALUE}};',
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
			'deensimc_separator_date_style',
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
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-date' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'deensimc_separator_date_bg_color',
			[
				'label' => __('Background Color', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default' => '#595959',
				'selectors' => [
					'{{WRAPPER}} .deensimc-seperator-date' => 'background-color: {{VALUE}};',
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
	}
}



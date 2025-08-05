<?php
if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;

trait NewsTickerLayoutControl
{

	protected function layout_control()
	{
		$this->start_controls_section(
			'deensimc_news_ticker_general_option_section',
			[
				'label' => esc_html__('Layout', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'deensimc_no_of_post',
			[
				'label' => __('Post Per Ticker', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
				'max' => 20,
				'description' => __('Maximum 20 posts can be displayed.', 'marquee-addons-for-elementor'),
			]
		);

		
		$this->add_control(
			'deensimc_label',
			[
				'label' => __('Show label', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __('Off', 'marquee-addons-for-elementor'),
				'label_on' => __('On', 'marquee-addons-for-elementor'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_label_heading',
			[
				'label' => __('Title', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Latest News', 'marquee-addons-for-elementor'),
				'placeholder' => __('Latest News', 'marquee-addons-for-elementor'),
				'condition' => [
					'deensimc_label' => 'yes',
				],

			]
		);
		$this->add_control(
			'deensimc_label_heading_tag',
			[
				'label' => __('Title HTML Tag', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'DIV',
					'span' => 'SPAN',
					'p'   => 'P',
				],
				'condition' => [
					'deensimc_label' => 'yes',
				],
			]
		);
		

		$this->add_control(
			'deensimc_label_icon',
			[
				'label' => __('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-bullhorn',
					'library' => 'fa-solid',
				],
				'condition' => [
					'deensimc_label' => 'yes',
				],
			]
		);


		$this->add_control(
			'deensimc_title_trim_enable',
			[
				'label' => __('Apply To Custom Post Title Length', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'marquee-addons-for-elementor'),
				'label_off' => __('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => '',
				'separator' => 'before',

			]
		);

		$this->add_control(
			'deensimc_title_trim_length',
			[
				'label' => __('Post Title Length', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => [
					'deensimc_title_trim_enable' => 'yes',
				],
			]
		);

		$this->add_control(
			'deensimc_open_in_new_tab',
			[
				'label'        => __('Open In New Window', 'marquee-addons-for-elementor'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Yes', 'marquee-addons-for-elementor'),
				'label_off'    => __('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);


		$this->end_controls_section();
	}

}
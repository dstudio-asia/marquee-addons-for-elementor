<?php

if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;



trait NewsTickerSeparatorControl
{

	protected function separator_control(){
		$this->start_controls_section(
			'deensimc_seperator_content',
			[
				'label' => __('Separator', 'marquee-addons-for-elementor'),
			]
		);
		$this->add_control(
			'deensimc_seperator_type',
			[
				'label' => __('Separator Type', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'seperator_icon' => __('Icon', 'marquee-addons-for-elementor'),
					'seperator_text' => __('Text', 'marquee-addons-for-elementor'),
					'seperator_date' => __('Date', 'marquee-addons-for-elementor'),

				],
				'default' => 'seperator_icon',
			]
		);
		$this->add_control( 
			'deensimc_seperator_icon',
			[
				'label' => __('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => [
					'deensimc_seperator_type' => 'seperator_icon',
				],
			]
		);
		$this->add_control(
			'deensimc_seperator_text',
			[
				'label' => __('Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('|', 'marquee-addons-for-elementor'),
				'placeholder' => __('Text', 'marquee-addons-for-elementor'),
				'condition' => [
					'deensimc_seperator_type' => 'seperator_text',
				],
			]
		);
		$this->end_controls_section();
	}

}


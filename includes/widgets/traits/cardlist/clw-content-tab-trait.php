<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait CLWContentTabTrait
{
	protected function clw_content_control_tab($repeater, $tab_name,$prefix = '')
	{
		$repeater->start_controls_tabs($tab_name);

		$repeater->start_controls_tab(
			'content_tab',
			[
				'label' => esc_html__('Content', 'elementor-addon'),
			]

		);

		$repeater->add_control(
			'heading',
			[
				'label' => esc_html__('Text', 'elementor-addon'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Card Heading', 'elementor-addon'),
				'label_block' => true,
			]
		);



		$repeater->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'elementor-addon'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Card description text goes here.', 'elementor-addon'),
				'rows' => 5,
			]
		);
		$repeater->end_controls_tab();
		
	}
}
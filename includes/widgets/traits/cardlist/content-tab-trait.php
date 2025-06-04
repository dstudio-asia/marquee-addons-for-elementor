<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait ContentTabTrait
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
				'default' => esc_html__('This is the heading', 'elementor-addon'),
				'label_block' => true,
			]
		);



		// $repeater->add_control(
		// 	'description',
		// 	[
		// 		'label' => esc_html__('Description', 'elementor-addon'),
		// 		'type' => Controls_Manager::TEXTAREA,
		// 		'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae quam vitae odio pharetra finibus tincidunt eu purus. Cras convallis accumsan tortor. Nulla facilisi.', 'elementor-addon'),
		// 		'rows' => 5,
		// 	]
		// );

		$repeater->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'textdomain'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae quam vitae odio pharetra finibus tincidunt eu purus. Cras convallis accumsan tortor. Nulla facilisi.', 'elementor-addon'),
				
			]
		);
		$repeater->end_controls_tab();
		
	}
}
<?php

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait StyleTabTrait
{
	protected function clw_style_tab($repeater, $tab_name, $prefix = '')
	{
		$repeater->start_controls_tab(
			$tab_name,
			[
				'label' => esc_html__('Style', 'elementor-addon'),
			]

		);

		$repeater->add_control(
			'card_bg_color',
			[
				'label' => esc_html__('Background Color', 'elementor-addon'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .deensimc-card-content-wrapper' => 'background-color: {{VALUE}};',

				],
				
			]
		);





		$repeater->end_controls_tab();
	}
}

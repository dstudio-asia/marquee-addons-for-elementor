<?php

if (!defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;

/**
 * Trait for adding reusable Marquee controls to any Elementor widget.
 */
trait Deensimc_Marquee_Controls
{
	/**
	 * Register reusable marquee controls.
	 *
	 * @param string $section_id     Unique section ID for Elementor controls.
	 * @param string $section_label  Section label to display in Elementor editor.
	 */
	protected function register_marquee_control($section_id = 'deensimc_marquee_options')
	{
		$this->start_controls_section(
			$section_id,
			[
				'label' => esc_html__('Marquee Options', 'marquee-addons-for-elementor'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_marquee_vertical_orientation',
			[
				'label'        => esc_html__('Show Vertical', 'marquee-addons-for-elementor'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off'    => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'deensimc_marquee_reverse_direction',
			[
				'label'        => esc_html__('Reverse', 'marquee-addons-for-elementor'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off'    => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'deensimc_pause_on_hover',
			[
				'label'        => esc_html__('Pause On Hover', 'marquee-addons-for-elementor'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'marquee-addons-for-elementor'),
				'label_off'    => esc_html__('No', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'deensimc_marquee_speed',
			[
				'label'   => esc_html__('Speed', 'marquee-addons-for-elementor'),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'deensimc_show_edge_shadow',
			[
				'label'        => esc_html__('Show Edge Shadow', 'marquee-addons-for-elementor'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off'    => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
	}
}

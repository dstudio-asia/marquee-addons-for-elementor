<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Testimonial_Marquee_Content_Text_Unfold
{
	protected function content_text_unfold()
	{
		$this->start_controls_section(
			'deensimc_text_unfold_section',
			[
				'label' => esc_html__('Text Unfold', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_length',
			[
				'label' => esc_html__('Length (word)', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 1,
				'default' => 10,
				'description' => esc_html__('If the excerpt length is greater than the total words of the original text, this setting will not have any effect.', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_title',
			[
				'label' => esc_html__('Fold Text', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__('Show more', 'marquee-addons-for-elementor'),
			]
		);

		$this->add_control(
			'deensimc_tesimonial_excerpt_title_less',
			[
				'label' => esc_html__('Unfold Text', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__('Show less', 'marquee-addons-for-elementor'),
			]
		);

		$this->end_controls_section();
	}
}

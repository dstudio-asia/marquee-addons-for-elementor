<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;

trait Animated_Word_Roller_Content_Text_Repeater {
	protected function content_text_repeater() 
	{
		$this->start_controls_section(
			'deensimc_infinite_text_rotation_content_section',
			[
				'label' => esc_html__( 'Content', 'marquee-addons-for-elementor' ),
				'tab' =>  Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_infinite_text_rotation_widget_title',
			[
				'label' => esc_html__( 'Title', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'The Perfect Choice For Any', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your title here', 'marquee-addons-for-elementor' ),
				'label_block' => true,
			]
		);

        $deensimc_scroll_text_repeater = new Repeater();

        $deensimc_scroll_text_repeater->add_control(
			'deensimc_infinite_text_rotation_text',
			[
				'label' => esc_html__( 'Word', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your title here', 'marquee-addons-for-elementor' ),
				'label_block' => true,
			]
		);

        $deensimc_scroll_text_repeater->add_control(
			'deensimc_infinite_text_rotation_icon',
			[
				'label' => esc_html__( 'Text Icon', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::ICONS,
				'label_block' => true,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
			]
		);

        $this->add_control(
			'deensimc_repeater_text_main',
			[
				'label' => esc_html__( 'Word Lists', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::REPEATER,
				'fields' => $deensimc_scroll_text_repeater->get_controls(),
				'default' => [
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Maker', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Creative', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Coffee Lover', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Developer', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Designer', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_infinite_text_rotation_text' => esc_html__( 'Creator', 'marquee-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ deensimc_infinite_text_rotation_text }}}',
			]
		);

		$this->add_control(
			'deensimc_infinite_text_rotation_html_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'marquee-addons-for-elementor' ),
					'h2' => esc_html__( 'H2', 'marquee-addons-for-elementor' ),
					'h3'  => esc_html__( 'H3', 'marquee-addons-for-elementor' ),
					'h4' => esc_html__( 'H4', 'marquee-addons-for-elementor' ),
					'h5' => esc_html__( 'H5', 'marquee-addons-for-elementor' ),
					'h6' => esc_html__( 'H6', 'marquee-addons-for-elementor' ),
					'div' => esc_html__( 'div', 'marquee-addons-for-elementor' ),
				]
			]
		);

		$this->add_control(
			'deensimc_repeater_text_main_alignment',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-infinite-rotation-container' => 'justify-content: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();
	}
}
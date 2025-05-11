<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Videomarquee_Content_Youtube_Vimeo_Options {
    protected function content_youtube_vimeo_options( $videos_repeater )
    {
        // YouTube.
		$videos_repeater->add_control(
			'deensimc_video_privacy',
			[
				'label' => esc_html__( 'Privacy Mode',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'When you turn on privacy mode, YouTube/Vimeo won\'t store information about visitors on your website unless they play the video.',  'marquee-addons-for-elementor' ),
				'condition' => [
					'deensimc_video_type' => [ 'youtube', 'vimeo' ],
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_lazy_load',
			[
				'label' => esc_html__( 'Lazy Load',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'deensimc_video_type',
							'operator' => '===',
							'value' => 'youtube',
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'deensimc_video_type',
									'operator' => '!==',
									'value' => 'hosted',
								],
							],
						],
					],
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_rel',
			[
				'label' => esc_html__( 'Suggested Videos',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Current Video Channel',  'marquee-addons-for-elementor' ),
					'yes' => esc_html__( 'Any Video',  'marquee-addons-for-elementor' ),
				],
				'condition' => [
					'deensimc_video_type' => 'youtube',
				],
			]
		);

		// Vimeo.
		$videos_repeater->add_control(
			'deensimc_video_vimeo_title',
			[
				'label' => esc_html__( 'Intro Title',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type' => 'vimeo',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_vimeo_portrait',
			[
				'label' => esc_html__( 'Intro Portrait',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type' => 'vimeo',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_vimeo_byline',
			[
				'label' => esc_html__( 'Intro Byline',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type' => 'vimeo',
				],
			]
		);
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Videomarquee_Content_Video_Options {
    protected function content_video_optoins( $videos_repeater )
    {
        $videos_repeater->add_control(
			'deensimc_video_video_options',
			[
				'label' => esc_html__( 'Video Options',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_autoplay',
			[
				'label' => esc_html__( 'Autoplay',  'marquee-addons-for-elementor' ),
				'description' => sprintf(
					/* translators: 1: `<a>` opening tag, 2: `</a>` closing tag. */
					esc_html__( 'Note: Autoplay is affected by %1$s Google’s Autoplay policy %2$s on Chrome browsers.',  'marquee-addons-for-elementor' ),
					'<a href="https://developers.google.com/web/updates/2017/09/autoplay-policy-changes" target="_blank">',
					'</a>'
				),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_mute',
			[
				'label' => esc_html__( 'Mute',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_loop',
			[
				'label' => esc_html__( 'Loop',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'deensimc_video_type!' => 'dailymotion',
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_controls',
			[
				'label' => esc_html__( 'Player Controls',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type!' => 'vimeo',
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_showinfo',
			[
				'label' => esc_html__( 'Video Info',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type' => [ 'dailymotion' ],
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_modestbranding',
			[
				'label' => esc_html__( 'Modest Branding',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'deensimc_video_type' => 'youtube' ,
					'deensimc_video_controls' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_logo',
			[
				'label' => esc_html__( 'Logo',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'default' => 'yes',
				'condition' => [
					'deensimc_video_type' => [ 'dailymotion' ],
				],
			]
		);
    }
}
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Videomarquee_Content_Hosted_Options {
    protected function content_hosted_options( $videos_repeater )
    {
        $videos_repeater->add_control(
			'deensimc_video_download_button',
			[
				'label' => esc_html__( 'Download Button',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'condition' => [
					'deensimc_video_type' => 'hosted',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_preload',
			[
				'label' => esc_html__( 'Preload',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'metadata' => esc_html__( 'Metadata',  'marquee-addons-for-elementor' ),
					'auto' => esc_html__( 'Auto',  'marquee-addons-for-elementor' ),
					'none' => esc_html__( 'None',  'marquee-addons-for-elementor' ),
				],
				'description' => sprintf(
					'%1$s <a target="_blank" href="https://go.elementor.com/preload-video/">%2$s</a>',
					esc_html__( 'Preload attribute lets you specify how the video should be loaded when the page loads.',  'marquee-addons-for-elementor' ),
					esc_html__( 'Learn more',  'marquee-addons-for-elementor' ),
				),
				'default' => 'metadata',
				'condition' => [
					'deensimc_video_type' => 'hosted',
					'autoplay' => '',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_poster',
			[
				'label' => esc_html__( 'Poster',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'deensimc_video_type' => 'hosted',
				],
			]
		);
    }
}
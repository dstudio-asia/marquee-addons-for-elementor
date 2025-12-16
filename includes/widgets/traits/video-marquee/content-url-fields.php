<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;

trait Deensimc_Videomarquee_Content_Url_Fields {
    protected function content_url_fields( $videos_repeater )
    {
        $videos_repeater->add_control(
			'deensimc_video_type',
			[
				'label' => esc_html__( 'Source',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'youtube',
				'options' => [
					'youtube' => esc_html__( 'YouTube',  'marquee-addons-for-elementor' ),
					'vimeo' => esc_html__( 'Vimeo',  'marquee-addons-for-elementor' ),
					'dailymotion' => esc_html__( 'Dailymotion',  'marquee-addons-for-elementor' ),
					'hosted' => esc_html__( 'Self Hosted',  'marquee-addons-for-elementor' ),
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_youtube_url',
			[
				'label' => esc_html__( 'Link',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL',  'marquee-addons-for-elementor' ) . ' (YouTube)',
				'default' => 'https://www.youtube.com/watch?v=G_H3j8EZCvs',
				'label_block' => true,
				'condition' => [
					'deensimc_video_type' => 'youtube',
				],
				'frontend_available' => true,
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_vimeo_url',
			[
				'label' => esc_html__( 'Link',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL',  'marquee-addons-for-elementor' ) . ' (Vimeo)',
				'default' => 'https://vimeo.com/173166268',
				'label_block' => true,
				'condition' => [
					'deensimc_video_type' => 'vimeo',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_dailymotion_url',
			[
				'label' => esc_html__( 'Link',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your URL',  'marquee-addons-for-elementor' ) . ' (Dailymotion)',
				'default' => 'https://www.dailymotion.com/video/x6qw9ac',
				'label_block' => true,
				'condition' => [
					'deensimc_video_type' => 'dailymotion',
				],
				'ai' => [
					'active' => false,
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_insert_url',
			[
				'label' => esc_html__( 'External URL',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'deensimc_video_type' => 'hosted',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_hosted_url',
			[
				'label' => esc_html__( 'Choose Video File',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::MEDIA,
				'media_types' => [
					'video',
				],
				'condition' => [
					'deensimc_video_type' => 'hosted',
					'deensimc_video_insert_url' => '',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_external_url',
			[
				'label' => esc_html__( 'URL',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::URL,
				'autocomplete' => false,
				'options' => false,
				'label_block' => true,
				'show_label' => false,
				'placeholder' => esc_html__( 'Enter your URL',  'marquee-addons-for-elementor' ),
				'condition' => [
					'deensimc_video_type' => 'hosted',
					'deensimc_video_insert_url' => 'yes',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_start',
			[
				'label' => esc_html__( 'Start Time',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Specify a start time (in seconds)',  'marquee-addons-for-elementor' ),
				'frontend_available' => true,
				'separator' => 'before',
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_end',
			[
				'label' => esc_html__( 'End Time',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Specify an end time (in seconds)',  'marquee-addons-for-elementor' ),
				'condition' => [
					'deensimc_video_type' => [ 'youtube', 'hosted' ],
				],
				'frontend_available' => true,
			]
		);
    }
}
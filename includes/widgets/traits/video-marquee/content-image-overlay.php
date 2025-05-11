<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Utils;

trait Videomarquee_Content_Image_Overlay {
    protected function content_image_overlay( $videos_repeater )
    {
        $videos_repeater->add_control(
			'deensimc_video_image_overlay',
			[
				'label' => esc_html__( 'Image Overlay',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$videos_repeater->add_control(
			'deensimc_show_video_image_overlay',
			[
				'label' => esc_html__( 'Image Overlay',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$videos_repeater->add_control(
			'deensimc_video_overlay_image',
			[
				'label' => esc_html__( 'Choose Image',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'deensimc_show_video_image_overlay' => 'yes',
				],
			]
		);

		$videos_repeater->add_control(
			'deensimc_show_image_overlay_play_icon',
			[
				'label' => esc_html__( 'Play Icon',  'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show',  'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide',  'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'deensimc_show_video_image_overlay' => 'yes',
				],
				'separator' => 'before'
			]
		);

		$videos_repeater->add_control(
			'deensimc_image_overlay_icon',
			[
				'label' => esc_html__( 'Icon',  'marquee-addons-for-elementor' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'default' => [
					'value' => 'fa fa-play-circle',
					'library' => 'fa-regular',
				],
				'condition' => [
					'deensimc_show_image_overlay_play_icon' => 'yes',
					'deensimc_show_video_image_overlay' => 'yes',
				],
			]
		);
    }
}
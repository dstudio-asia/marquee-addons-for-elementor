<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;

trait Testimonialmarquee_Contents {
	protected function content_controls() 
	{
		$deensimc_testimonial_repeater = new Repeater();

		$deensimc_testimonial_repeater->add_control(
			'deensimc_testimonial_content',
			[
				'label' => esc_html__( 'Content', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type testimonial content', 'marquee-addons-for-elementor' ),
			]
		);

		$deensimc_testimonial_repeater->add_control(
			'deensimc_testimonial_image',
			[
				'label' => esc_html__( 'Choose Image', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$deensimc_testimonial_repeater->add_control(
			'deensimc_testimonial_name',
			[
				'label' => esc_html__( 'Name', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'John Snow', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter name here', 'marquee-addons-for-elementor' ),
			]
		);
        
		$deensimc_testimonial_repeater->add_control(
			'deensimc_testimonial_title',
			[
				'label' => esc_html__( 'Title', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Engineer', 'marquee-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Enter title here', 'marquee-addons-for-elementor' ),
			]
		);

		$deensimc_testimonial_repeater->add_control(
            'deensimc_testimonial_show_rating',
            [
                'label' => esc_html__( 'Show Rating', 'marquee-addons-for-elementor' ),
                'type' =>  Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
                'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
    
        $deensimc_testimonial_repeater->add_control(
            'deensimc_testimonial_rating_num',
            [
                'label' => esc_html__( 'Rating', 'marquee-addons-for-elementor' ),
                'type' =>  Controls_Manager::NUMBER,
                'min' => 0,
                'max' =>  5,
                'step' => .5,
                'default' => 5,
                'condition' => [
                    'deensimc_testimonial_show_rating' => 'yes',
                ],
            ]
        );
        
        $deensimc_testimonial_repeater->add_control(
            'deensimc_testimonial_rating_counter',
            [
                'label' => esc_html__( 'Rating Counter', 'marquee-addons-for-elementor' ),
                'type' =>  Controls_Manager::TEXT,
                'default' => esc_html__( '3k', 'marquee-addons-for-elementor' ),
                'condition' => [
                    'deensimc_testimonial_show_rating' => 'yes',
                ],
            ]
        );

		$this->add_control(
			'deensimc_repeater_testimonial_main',
			[
				'label' => esc_html__( 'Testimonial Items', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::REPEATER,
				'fields' => $deensimc_testimonial_repeater->get_controls(),
				'default' => [
					[
						'deensimc_testimonial_name' => esc_html__( 'Steve', 'marquee-addons-for-elementor' ),
					],
					[
						'deensimc_testimonial_name' => esc_html__( 'John', 'marquee-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ deensimc_testimonial_name }}}',
			]
		);
	}
}
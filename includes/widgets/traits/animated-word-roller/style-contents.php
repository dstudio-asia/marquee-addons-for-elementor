<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;

trait Deensimc_Animated_Word_Roller_Style_Text_Contents {
    protected function style_contents() {
        $this->start_controls_section(
            'deensimc_infinite_text_rotation_content_style_section',
            [
                'label' => esc_html__( 'Content', 'marquee-addons-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $text_blocks = [
            [
                'label'    => esc_html__( 'Title', 'marquee-addons-for-elementor' ),
                'heading'  => 'deensimc_infinite_text_rotation_content_style_heading',
                'selector' => '{{WRAPPER}} .deensimc-fixed-text',
                'typography' => 'deensimc_infinite_text_rotation_content_typography',
                'color' => 'deensimc_infinite_text_rotation_content_title_color',
                'text_stroke' => 'deensimc_infinite_text_rotation_title_text_stroke',
            ],
            [
                'label'    => esc_html__( 'Animated words', 'marquee-addons-for-elementor' ),
                'heading'  => 'deensimc_infinite_text_rotation_animated_texts_heading',
                'selector' => '{{WRAPPER}} .deensimc-rotating-word',
                'typography' => 'deensimc_infinite_text_rotation_animated_words_typography',
                'color' => 'deensimc_infinite_text_rotation_animated_words_color',
                'text_stroke' => 'deensimc_infinite_text_rotation_animated_texts_text_stroke',
            ],
        ];

        foreach ( $text_blocks as $block ) {
            $this->add_control(
                $block['heading'],
                [
                    'label' => $block['label'],
                    'type'  => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => $block['typography'],
                    'selector' => $block['selector'],
                ]
            );

            $this->add_control(
                $block['color'],
                [
                    'label' => esc_html__( 'Color', 'marquee-addons-for-elementor' ),
                    'type'  => Controls_Manager::COLOR,
                    'selectors' => [
                        $block['selector'] => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),
                [
                    'name'     => $block['text_stroke'],
                    'selector' => $block['selector'],
                ]
            );
        }

        // Icon Styles
        $this->add_control(
            'deensimc_infinite_text_rotation_content_icons_heading',
            [
                'label' => esc_html__( 'Icons', 'marquee-addons-for-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'deensimc_infinite_text_rotation_content_icons_size',
            [
                'label' => esc_html__( 'Size', 'marquee-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 3, 'max' => 100, 'step' => 1 ],
                ],
                'default' => [ 'unit' => 'px', 'size' => 16 ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-rotate-text svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-rotate-text i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_infinite_text_rotation_content_gap_title_and_icons',
            [
                'label' => esc_html__( 'Gap', 'marquee-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 3, 'max' => 100, 'step' => 1 ],
                ],
                'default' => [ 'unit' => 'px', 'size' => 16 ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-rotate-text' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_infinite_text_rotation_content_icons_color',
            [
                'label' => esc_html__( 'Color', 'marquee-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-rotate-text i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deensimc-rotate-text path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Deensimc_Style_Hotspot_Controls
{
    protected function register_deensimc_style_hotspot_section_controls()
    {
        $this->start_controls_section(
            'deensimc_section_style_hotspot',
            [
                'label' => esc_html__('Hotspot', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'deensimc_style_hotspot_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-color: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'deensimc_style_hotspot_size',
            [
                'label' => esc_html__('Size', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 300,
                    ],
                    'em' => [
                        'max' => 30,
                    ],
                    'rem' => [
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_style_typography',
                'selector' => '{{WRAPPER}} .deensimc-image-hotspot__label',

            ]
        );

        $this->add_responsive_control(
            'deensimc_style_hotspot_width',
            [
                'label' => esc_html__('Min Width', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                    'rem' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-min-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_style_hotspot_height',
            [
                'label' => esc_html__('Min Height', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                    'rem' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'deensimc_style_hotspot_box_color',
            [
                'label' => esc_html__('Box Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-box-color: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'deensimc_style_hotspot_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'max' => 10,
                    ],
                    'rem' => [
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_style_hotspot_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}}' => '--hotspot-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_style_hotspot_box_shadow',
                'selector' => '
					{{WRAPPER}} .deensimc-image-hotspot:not(.deensimc-image-hotspot--circle) .deensimc-image-hotspot__button,
					{{WRAPPER}} .deensimc-image-hotspot.deensimc-image-hotspot--circle .deensimc-image-hotspot__button .deensimc-image-hotspot__outer-circle
				',
            ]
        );

        $this->end_controls_section();
    }
}

<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Deensimc_Style_Tooltip_Controls
{
    protected function register_deensimc_style_tooltip_section_controls()
    {
        $this->start_controls_section(
            'deensimc_section_style_tooltip',
            [
                'label' => esc_html__('Tooltip', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'deensimc_style_tooltip_text_color',
            [
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-text-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_style_tooltip_typography',
                'selector' => '{{WRAPPER}} .deensimc-image-hotspot__tooltip',

            ]
        );

        $this->add_responsive_control(
            'deensimc_style_tooltip_align',
            [
                'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_style_tooltip_heading',
            [
                'label' => esc_html__('Box', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'deensimc_style_tooltip_width',
            [
                'label' => esc_html__('Min Width', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 2000,
                    ],
                    'em' => [
                        'max' => 200,
                    ],
                    'rem' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-min-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_style_tooltip_max_width',
            [
                'label' => esc_html__('Max Width', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 2000,
                    ],
                    'em' => [
                        'max' => 200,
                    ],
                    'rem' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-max-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_style_tooltip_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_style_tooltip_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'deensimc_style_tooltip_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_style_tooltip_box_shadow',
                'selector' => '{{WRAPPER}} .deensimc-image-hotspot__tooltip',
            ]
        );

        $this->end_controls_section();
    }
}

<?php

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Deensimc_Tooltip_Controls
{
    protected function register_deensimc_tooltip_section_controls()
    {
        $this->start_controls_section(
            'deensimc_tooltip_section',
            [
                'label' => esc_html__('Tooltip', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_responsive_control(
            'deensimc_tooltip_position',
            [
                'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'top',
                'toggle' => false,
                'options' => [
                    'right' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'left' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'top' => [
                        'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-image-hotspot--tooltip-position' => 'right: initial;bottom: initial;left: initial;top: initial;{{VALUE}}: calc(100% + 5px );',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'deensimc_tooltip_trigger',
            [
                'label' => esc_html__('Trigger', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'mouseenter' => esc_html__('Hover', 'marquee-addons-for-elementor'),
                    'click' => esc_html__('Click', 'marquee-addons-for-elementor'),
                    'none' => esc_html__('None', 'marquee-addons-for-elementor'),
                ],
                'default' => 'click',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'deensimc_tooltip_animation',
            [
                'label' => esc_html__('Animation', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'deensimc-image-hotspot--fade-in-out' => esc_html__('Fade In/Out', 'marquee-addons-for-elementor'),
                    'deensimc-image-hotspot--fade-grow' => esc_html__('Fade Grow', 'marquee-addons-for-elementor'),
                    'deensimc-image-hotspot--fade-direction' => esc_html__('Fade By Direction', 'marquee-addons-for-elementor'),
                    'deensimc-image-hotspot--slide-direction' => esc_html__('Slide By Direction', 'marquee-addons-for-elementor'),
                ],
                'default' => 'deensimc-image-hotspot--fade-in-out',
                'placeholder' => esc_html__('Enter your image caption', 'marquee-addons-for-elementor'),
                'condition' => [
                    'deensimc_tooltip_trigger!' => 'none',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'deensimc_tooltip_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'marquee-addons-for-elementor') . ' (ms)',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--tooltip-transition-duration: {{SIZE}}ms;',
                ],
                'condition' => [
                    'deensimc_tooltip_trigger!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;

trait Deensimc_Search_Clear_Styles_Controls
{

    protected function register_search_clear_styles_control()
    {

        $this->start_controls_section(
            'deensimc_search_clear_styles_control_section',
            [
                'label' => esc_html__('Clear', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'deensimc_search_clear_icon_size',
            [
                'label' => esc_html__('Icon Size', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('deensimc_search_clear_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'deensimc_search_clear_normal_tab',
            [
                'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_clear_normal_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'deensimc_search_clear_hover_tab',
            [
                'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_clear_hover_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-clear-button:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
}

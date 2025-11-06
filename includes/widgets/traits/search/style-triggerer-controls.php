<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait Deensimc_Search_Triggerer_Styles_Controls
{

    protected function register_search_triggerer_styles_control()
    {

        $this->start_controls_section(
            'deensimc_search_triggerer_styles_control_section',
            [
                'label' => esc_html__('Triggerer', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'deensimc_search_triggerer_icon_size',
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
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('deensimc_search_triggerer_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'deensimc_search_triggerer_normal_tab',
            [
                'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_triggerer_normal_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_triggerer_normal_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_triggerer_normal_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'deensimc_search_triggerer_hover_tab',
            [
                'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_triggerer_hover_color',
            [
                'label' => esc_html__('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_triggerer_hover_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer',
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_triggerer_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'deensimc_search_triggerer_border',
                'label' => esc_html__('Border', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer',
                'separator' => 'before',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'deensimc_search_triggerer_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'deensimc_search_triggerer_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-input-triggerer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

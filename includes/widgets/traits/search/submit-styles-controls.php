<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait Deensimc_Search_Submit_Styles_Controls
{

    protected function register_search_submit_styles_control()
    {

        $this->start_controls_section(
            'deensimc_search_submit_styles_control_section',
            [
                'label' => esc_html__('Submit button', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'deensimc_search_style' => 'popup'
                ]
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_search_submit_typography',
                'label' => esc_html__('Typography', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button',
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'deensimc_search_submit_icon_size',
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
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_search_submit_button_icon[value]!' => '',
                ]
            ]
        );

        // Icon Spacing
        $this->add_responsive_control(
            'deensimc_search_submit_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_search_submit_button_icon[value]!' => '',
                ]
            ]
        );


        $this->start_controls_tabs('deensimc_search_submit_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'deensimc_search_submit_normal_tab',
            [
                'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_submit_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_submit_normal_icon_color',
            [
                'label' => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'deensimc_search_submit_button_icon[value]!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_submit_normal_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'deensimc_search_submit_normal_border',
                'label' => esc_html__('Border', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_submit_normal_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'deensimc_search_submit_hover_tab',
            [
                'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_submit_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_submit_hover_icon_color',
            [
                'label' => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'deensimc_search_submit_button_icon[value]!' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_submit_hover_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'deensimc_search_submit_hover_border',
                'label' => esc_html__('Border', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_submit_hover_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Border Radius
        $this->add_responsive_control(
            'deensimc_search_submit_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );



        // Padding
        $this->add_responsive_control(
            'deensimc_search_submit_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-search-submit-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Spacing Slider Control (Margin)
        $this->add_responsive_control(
            'deensimc_search_submit_spacing',
            [
                'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

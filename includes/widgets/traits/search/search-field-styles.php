<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;

trait Deensimc_Search_Field_Styles_Controls
{

    protected function register_search_field_styles_control()
    {

        $this->start_controls_section(
            'deensimc_search_field_styles_control_section',
            [
                'label' => esc_html__('Search Field', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'deensimc_search_field_width',
            [
                'label' => esc_html__('Width', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-left-input .deensimc-input-field-wrapper.deensimc-search-open' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_search_style' => 'expand'
                ]
            ]
        );
        $this->add_responsive_control(
            'deensimc_search_field_popup_width',
            [
                'label' => esc_html__('Width', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-popup-input .deensimc-input-field-wrapper.deensimc-search-open' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_search_style' => 'popup'
                ]
            ]
        );
        $this->add_responsive_control(
            'deensimc_search_field_alignment',
            [
                'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-popup-input .deensimc-input-field-wrapper' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_search_style' => 'popup'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_search_field_typography',
                'label' => esc_html__('Typography', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-input-field',
            ]
        );

        $this->add_control(
            'deensimc_search_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('deensimc_search_field_tabs');

        $this->start_controls_tab(
            'deensimc_search_field_normal_tab',
            [
                'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_field_normal_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-text-field-wrapper',
            ]
        );

        $this->add_control(
            'deensimc_search_field_normal_text_color',
            [
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_field_normal_icon_color',
            [
                'label' => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-placeholder-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-placeholder-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'deensimc_search_field_normal_border',
                'label' => esc_html__('Border', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-text-field-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_field_normal_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container .deensimc-text-field-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'deensimc_search_field_focus_tab',
            [
                'label' => esc_html__('Focus', 'marquee-addons-for-elementor'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_search_field_focus_background_color',
                'types'    => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-input-container:focus-within .deensimc-text-field-wrapper',

            ]
        );
        $this->add_control(
            'deensimc_search_field_focus_text_color',
            [
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-input-field:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_field_focus_icon_color',
            [
                'label' => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container:focus-within .deensimc-placeholder-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-input-container:focus-within .deensimc-placeholder-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'deensimc_search_field_focus_border',
                'label' => esc_html__('Border', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container:focus-within .deensimc-text-field-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'deensimc_search_field_focus_box_shadow',
                'label' => esc_html__('Box Shadow', 'marquee-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .deensimc-input-container:focus-within .deensimc-text-field-wrapper',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'deensimc_search_field_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-text-field-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'deensimc_search_field_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-text-field-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_search_icon_size',
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
                    '{{WRAPPER}} .deensimc-input-container .deensimc-placeholder-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-input-container .deensimc-placeholder-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'deensimc_search_icon_gap',
            [
                'label' => esc_html__('Icon Gap', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 8,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-input-container .deensimc-placeholder-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }
}

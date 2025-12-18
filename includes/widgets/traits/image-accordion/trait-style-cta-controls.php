<?php

if (! defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;

trait Deensimc_ImageAccordion_Cta_Style_Controls
{
    protected function cta_style_controls()
    {
        $this->start_controls_section(
            'deensimc_image_acc_cta_section_style',
            [
                'label' => esc_html__('CTA Style', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'deensimc_image_acc_cta_typography',
                'selector' => '{{WRAPPER}} .deensimc-acc-cta',
            ]
        );

        // Tabs for Normal & Hover
        $this->start_controls_tabs('deensimc_image_acc_cta_tabs');

        // Normal
        $this->start_controls_tab(
            'deensimc_image_acc_cta_normal',
            [
                'label' => esc_html__('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_image_acc_cta_text_color',
            [
                'label'     => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-cta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_image_acc_cta_bg',
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-acc-cta',
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'deensimc_image_acc_cta_hover',
            [
                'label' => esc_html__('Hover', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_image_acc_cta_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'marquee-addons-for-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-cta:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'deensimc_image_acc_cta_hover_bg',
                'types'    => ['classic', 'gradient'],
                'exclude'  => ['image'],
                'selector' => '{{WRAPPER}} .deensimc-acc-cta:hover',
            ]
        );

        $this->add_control(
            'deensimc_image_acc_cta_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'marquee-addons-for-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-cta:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Padding
        $this->add_responsive_control(
            'deensimc_image_acc_cta_padding',
            [
                'label'      => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .deensimc-acc-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border (after states)
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'deensimc_image_acc_cta_border',
                'selector' => '{{WRAPPER}} .deensimc-acc-cta',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'deensimc_image_acc_cta_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .deensimc-acc-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Spacing (margin-top only)
        $this->add_control(
            'deensimc_image_acc_cta_spacing',
            [
                'label' => esc_html__('Spacing', 'marquee-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-cta' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
}

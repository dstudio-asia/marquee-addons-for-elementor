<?php

if (! defined('ABSPATH')) {
    exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Css_Filter;

trait ImageAccordion_Styles
{

    protected function style_controls()
    {

        $this->start_controls_section(
            'deensimc_image_repeater_section_style',
            [
                'label' => esc_html__('Images', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'deensimc_images_height',
            [
                'label' => esc_html__('Height', 'marquee-addons-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-image-panel .deensimc-panels' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_images_gap',
            [
                'label' => esc_html__('Gap', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-image-panel .deensimc-panels' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_images_border_radius',
            [
                'label' => esc_html__('Border Radius', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-panels' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_common_overlay_color_heading',
            [
                'label' => __('Overlay Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('common_color');

        $this->start_controls_tab(
            'deensimc_common_normal',
            [
                'label' => __('Normal', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'deensimc_image_background_type_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .deensimc-image-panel .deensimc-panel::after'
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'deensimc_image_css_filter_normal',
                'selector' => '{{WRAPPER}} .deensimc-panel .deensimc-acc-bg-img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'deensimc_common_hover',
            [
                'label' => __('Hover', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'deensimc_common_overlay_color_hover',
                'label' => __('Overlay Color', 'marquee-addons-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .deensimc-panels .deensimc-panel-main.open::after, {{WRAPPER}} .deensimc-hover.deensimc-panel:hover::after'
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'deensimc_image_css_filter_hover',
                'selector' => '{{WRAPPER}} .deensimc-panel .deensimc-acc-bg-img',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'deensimc_images_title_heading',
            [
                'label' => esc_html__('Image Title', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_image_title_typography',
                'selector' => '{{WRAPPER}} .deensimc-image-panel .deensimc-panel .deensimc-panel-default-title, {{WRAPPER}} .deensimc-panel-content h2',
            ]
        );

        $this->add_control(
            'deensimc_image_title_color',
            [
                'label' => esc_html__('Image Title Color', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-image-panel .deensimc-panel .deensimc-panel-default-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deensimc-panel-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_images_title_rotating',
            [
                'label' => esc_html__('Title Position', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::SELECT,
                'default' => 'rl',
                'options' => [
                    'rl' => esc_html__('Horizontal', 'marquee-addons-for-elementor'),
                    'tb-rl'  => esc_html__('Vertical', 'marquee-addons-for-elementor'),
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_image_title_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-panel-default-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-panel-content h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'deensimc_images_description_heading',
            [
                'label' => esc_html__('Image Description', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_image_description_typography',
                'selector' => '{{WRAPPER}} .deensimc-acc-description',
            ]
        );

        $this->add_control(
            'deensimc_image_description_color',
            [
                'label' => esc_html__('Image Title Color', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'deensimc_image_description_padding',
            [
                'label' => esc_html__('Padding', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-acc-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // 🔹 CTA Style Heading
        $this->add_control(
            'deensimc_image_acc_cta_style_heading',
            [
                'label' => esc_html__('CTA Style', 'marquee-addons-for-elementor'),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
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

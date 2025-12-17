<?php

if (! defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;

trait Deensimc_ImageAccordion_Image_Style_Controls
{
    protected function image_style_controls()
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
        $this->end_controls_section();
    }
}

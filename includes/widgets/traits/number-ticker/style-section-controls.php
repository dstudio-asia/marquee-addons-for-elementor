<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;

if (! defined('ABSPATH')) {
    exit;
}

trait NumberTickerStylesControls
{

    protected function style_section_control()
    {
        $this->start_controls_section(
            'deensimc_number_ticker_content_styles',
            [
                'label' => __('Content', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'deensimc_nt_typography',
                'selector' => '{{WRAPPER}} .deensimc-number-ticker .deensimc-number',
            ]
        );

        $this->add_control(
            'deensimc_nt_text_fill_color',
            [
                'label' => __('Color', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'deensimc_nt_stroke',
                'selector' => '{{WRAPPER}} .deensimc-number-ticker .deensimc-number',
            ]
        );

        // Text Shadow
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'deensimc_nt_text_shadow',
                'selector' => '{{WRAPPER}} .deensimc-number-ticker .deensimc-number',
            ]
        );

        $this->add_control(
            'deensimc_nt_icon_style_heading',
            [
                'label' =>  __('Icon', 'marquee-addons-for-elementor'),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
            ]
        );

        // Icon Color
        $this->add_control(
            'deensimc_nt_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-ticker-icon  svg'       => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-ticker-icon  i'         => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
            ]
        );

        // Icon Size
        $this->add_responsive_control(
            'deensimc_nt__icon_size',
            [
                'label' => esc_html__('Icon Size', 'marquee-addons-for-elementor'),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 8,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-ticker-icon svg'       => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-ticker-icon i'         => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'deensimc_nt_icon_gap',
            [
                'label' => __('Gap', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'deensimc_nt_icon_alignment',
            [
                'label' => __('Vertical ALignment', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-ticker-icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

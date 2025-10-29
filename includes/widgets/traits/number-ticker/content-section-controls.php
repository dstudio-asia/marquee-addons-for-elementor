<?php

use Elementor\Controls_Manager;

if (! defined('ABSPATH')) {
    exit;
}

trait NumberTickerContentControls
{

    protected function content_section_control()
    {
        $this->start_controls_section(
            'deensimc_number_ticker_content',
            [
                'label' => __('Content', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('deensimc_nt_number', [
            'label' => __('Number', 'marquee-addons-for-elementor'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'step' => 1,
            'default' => 50,
        ]);
        $this->add_responsive_control(
            'deensimc_number_ticker_align',
            [
                'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors_dictionary' => [
                    'left' => 'justify-content: start;',
                    'center' => 'justify-content: center;',
                    'right' => 'justify-content: end;',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-wrapper' => '{{VALUE}};',
                ],
            ]
        );
        $this->add_control('deensimc_nt_duration', [
            'label' => __('Duration (Sec)', 'marquee-addons-for-elementor'),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'step' => 1,
            'default' => 2,
        ]);
        $this->add_control(
            'deensimc_nt_direction',
            [
                'label' => __('Direction', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'up',
                'options' => [
                    'up' => __('Up', 'marquee-addons-for-elementor'),
                    'down' => __('Down', 'marquee-addons-for-elementor'),
                ],
            ]
        );

        $this->add_control(
            'deensimc_nt_icon_heading',
            [
                'label' =>  __('Icon', 'marquee-addons-for-elementor'),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'deensimc_nt_icon',
            [
                'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::ICONS,
                'label_block' => false,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'deensimc_nt_icon_position',
            [
                'label' => esc_html__('Icon Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'condition' => [
                    'deensimc_nt_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-number-ticker .deensimc-number-wrapper' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
}

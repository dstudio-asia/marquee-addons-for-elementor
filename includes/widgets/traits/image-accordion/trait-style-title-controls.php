<?php

if (! defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Deensimc_ImageAccordion_Title_Style_Controls
{
    protected function title_style_controls()
    {
        $this->start_controls_section(
            'deensimc_images_title_section_style',
            [
                'label' => esc_html__('Title', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'deensimc_image_title_typography',
                'selector' => '{{WRAPPER}} .deensimc-image-panel .deensimc-panel .deensimc-panel-default-title, {{WRAPPER}} .deensimc-panel-content .deensimc-acc-title',
            ]
        );

        $this->add_control(
            'deensimc_image_title_color',
            [
                'label' => esc_html__('Image Title Color', 'marquee-addons-for-elementor'),
                'type' =>  Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deensimc-image-panel .deensimc-panel .deensimc-panel-default-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .deensimc-panel-content .deensimc-acc-title' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .deensimc-panel-content .deensimc-acc-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
}

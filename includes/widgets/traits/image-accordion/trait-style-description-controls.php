<?php

if (! defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

trait Deensimc_ImageAccordion_Description_Style_Controls
{
    protected function description_style_controls()
    {
        $this->start_controls_section(
            'deensimc_images_description_section_style',
            [
                'label' => esc_html__('Description', 'marquee-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'label' => esc_html__('Text Color', 'marquee-addons-for-elementor'),
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
        $this->end_controls_section();
    }
}

<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;


trait Deensimc_Marquee_Gap_Controls
{

    protected function register_gap_control()
    {
        $this->add_responsive_control(
            'deensimc_marquee_gap',
            [
                'label' => esc_html__('Gaps', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::GAPS,
                'size_units' => ['px', 'em', 'rem', 'vw', 'custom'],
                'placeholder' => [
                    'row' => '20',
                    'column' => '20',
                ],
                'selectors' => [
                    '{{WRAPPER}} .deensimc-marquee-main-container' => '--deensimc-container-padding: {{row}}{{UNIT}}; --deensimc-item-gap: {{column}}{{UNIT}};',
                ],
                'validators' => [
                    'Number' => [
                        'min' => 0,
                    ],
                ],
            ]
        );
    }
}

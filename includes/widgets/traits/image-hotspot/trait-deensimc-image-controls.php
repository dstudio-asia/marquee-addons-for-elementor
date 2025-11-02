<?php

use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Deensimc_Image_Controls
{
    protected function register_deensimc_image_section_controls()
    {
        parent::register_controls();

        $this->remove_control('caption_source');
        $this->remove_control('caption');
        $this->remove_control('link_to');
        $this->remove_control('link');
        $this->remove_control('open_lightbox');
        $this->remove_control('section_style_caption');
        $this->remove_control('caption_align');
        $this->remove_control('text_color');
        $this->remove_control('caption_background_color');
        $this->remove_control('caption_typography');
        $this->remove_control('caption_text_shadow');
        $this->remove_control('caption_space');
        $this->remove_control('hover_animation');

        $this->update_control('align', [
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Start', 'marquee-addons-for-elementor'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
                    'icon' => 'eicon-text-align-center',
                ],
                'flex-end' => [
                    'title' => esc_html__('End', 'marquee-addons-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => '--background-align: {{VALUE}};',
            ],
        ]);

        $this->update_control(
            'width',
            [
                'selectors' => [
                    '{{WRAPPER}}' => '--container-width: {{SIZE}}{{UNIT}}; --image-width: 100%;',
                ],
            ]
        );

        $this->update_control(
            'space',
            [
                'selectors' => [
                    '{{WRAPPER}}' => '--container-max-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->update_control(
            'height',
            [
                'selectors' => [
                    '{{WRAPPER}}' => '--container-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->update_control(
            'opacity',
            [
                'selectors' => [
                    '{{WRAPPER}}' => '--opacity: {{SIZE}};',
                ],
            ]
        );

        $this->update_control(
            'opacity_hover',
            [
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container>img:hover' => '--opacity: {{SIZE}};',
                ],
            ]
        );
    }
}

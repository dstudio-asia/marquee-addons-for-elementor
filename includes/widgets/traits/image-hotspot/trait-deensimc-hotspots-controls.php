<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

trait Deensimc_Hotspots_Controls
{
    protected function register_deensimc_hotspots_section_controls()
    {
        $this->start_controls_section(
            'deensimc_hotspot_section',
            [
                'label' => esc_html__('Hotspot', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('deensimc_hotspot_repeater');

        $repeater->start_controls_tab(
            'deensimc_hotspot_content_tab',
            [
                'label' => esc_html__('Content', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_label',
            [
                'label' => esc_html__('Label', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_link',
            [
                'label' => esc_html__('Link', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_icon',
            [
                'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $start = is_rtl() ? 'right' : 'left';
        $end = is_rtl() ? 'left' : 'right';

        $repeater->add_control(
            'deensimc_hotspot_icon_position',
            [
                'label' => esc_html__('Icon Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Start', 'marquee-addons-for-elementor'),
                        'icon' => "eicon-h-align-{$start}",
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'marquee-addons-for-elementor'),
                        'icon' => "eicon-h-align-{$end}",
                    ],
                ],
                'selectors_dictionary' => [
                    'start' => 'grid-column: 1;',
                    'end' => 'grid-column: 2;',
                ],
                'condition' => [
                    'deensimc_hotspot_icon[value]!' => '',
                    'deensimc_hotspot_label[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .deensimc-image-hotspot__icon' => '{{VALUE}}',
                ],
                'default' => 'start',
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                    'em' => [
                        'max' => 10,
                    ],
                    'rem' => [
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .deensimc-image-hotspot__button' =>
                    'grid-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'deensimc_hotspot_icon[value]!' => '',
                    'deensimc_hotspot_label[value]!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_custom_size',
            [
                'label' => esc_html__('Custom Hotspot Size', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'marquee-addons-for-elementor'),
                'label_on' => esc_html__('On', 'marquee-addons-for-elementor'),
                'default' => 'no',
                'description' => esc_html__('Set custom Hotspot size that will only affect this specific hotspot.', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_width',
            [
                'label' => esc_html__('Min Width', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                    'rem' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => '--hotspot-min-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'deensimc_hotspot_custom_size' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_height',
            [
                'label' => esc_html__('Min Height', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vh', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    'em' => [
                        'max' => 100,
                    ],
                    'rem' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => '--hotspot-min-height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'deensimc_hotspot_custom_size' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_tooltip_content',
            [
                'render_type' => 'template',
                'label' => esc_html__('Tooltip Content', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Add Your Tooltip Text Here', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'deensimc_hotspot_position_tab',
            [
                'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_horizontal',
            [
                'label' => esc_html__('Horizontal Orientation', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'default' => is_rtl() ? 'right' : 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
            ]
        );

        $repeater->add_responsive_control(
            'deensimc_hotspot_offset_x',
            [
                'label' => esc_html__('Offset', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' =>
                    '{{deensimc_hotspot_horizontal.VALUE}}: {{SIZE}}%; --hotspot-translate-x: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_vertical',
            [
                'label' => esc_html__('Vertical Orientation', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'toggle' => false,
            ]
        );

        $repeater->add_responsive_control(
            'deensimc_hotspot_offset_y',
            [
                'label' => esc_html__('Offset', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' =>
                    '{{deensimc_hotspot_vertical.VALUE}}: {{SIZE}}%; --hotspot-translate-y: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_tooltip_position',
            [
                'label' => esc_html__('Custom Tooltip Properties', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'marquee-addons-for-elementor'),
                'label_on' => esc_html__('On', 'marquee-addons-for-elementor'),
                'default' => 'no',
                'description' => esc_html__('Set custom Tooltip opening that will only affect this specific hotspot.', 'marquee-addons-for-elementor'),
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_heading',
            [
                'label' => esc_html__('Box', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'deensimc_hotspot_tooltip_position' => 'yes',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'deensimc_hotspot_position',
            [
                'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'right' => [
                        'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'left' => [
                        'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'top' => [
                        'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .deensimc-image-hotspot--tooltip-position' => 'right: initial;bottom: initial;left: initial;top: initial;{{VALUE}}: calc(100% + 5px );',
                ],
                'condition' => [
                    'deensimc_hotspot_tooltip_position' => 'yes',
                ],
                'render_type' => 'template',
            ]
        );

        $repeater->add_responsive_control(
            'deensimc_hotspot_tooltip_width',
            [
                'label' => esc_html__('Min Width', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'vw', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 2000,
                    ],
                    'em' => [
                        'max' => 200,
                    ],
                    'rem' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .deensimc-image-hotspot__tooltip' => 'min-width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'deensimc_hotspot_tooltip_position' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'deensimc_hotspot_tooltip_text_wrap',
            [
                'label' => esc_html__('Text Wrap', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'marquee-addons-for-elementor'),
                'label_on' => esc_html__('On', 'marquee-addons-for-elementor'),
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => '--white-space: normal',
                ],
                'condition' => [
                    'deensimc_hotspot_tooltip_position' => 'yes',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'deensimc_hotspot',
            [
                'label' => esc_html__('Hotspot', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ deensimc_hotspot_label }}}',
                'default' => [
                    [
                        // Default #1 circle
                    ],
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'deensimc_hotspot_animation',
            [
                'label' => esc_html__('Animation', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'deensimc-image-hotspot--soft-beat' => esc_html__('Soft Beat', 'marquee-addons-for-elementor'),
                    'deensimc-image-hotspot--expand' => esc_html__('Expand', 'marquee-addons-for-elementor'),
                    'deensimc-image-hotspot--overlay' => esc_html__('Overlay', 'marquee-addons-for-elementor'),
                    '' => esc_html__('None', 'marquee-addons-for-elementor'),
                ],
                'default' => 'deensimc-image-hotspot--expand',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'deensimc_hotspot_sequenced_animation',
            [
                'label' => esc_html__('Sequenced Animation', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'marquee-addons-for-elementor'),
                'label_on' => esc_html__('On', 'marquee-addons-for-elementor'),
                'default' => 'no',
                'frontend_available' => true,
                'render_type' => 'none',
            ]
        );

        $this->add_control(
            'deensimc_hotspot_sequenced_animation_duration',
            [
                'label' => esc_html__('Sequence Duration', 'marquee-addons-for-elementor') . ' (ms)',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20000,
                        'step' => 100,
                    ],
                ],
                'condition' => [
                    'deensimc_hotspot_sequenced_animation' => 'yes',
                ],
                'frontend_available' => true,
                'render_type' => 'ui',
            ]
        );

        $this->end_controls_section();
    }
}

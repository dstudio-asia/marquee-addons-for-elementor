<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;

trait Deensimc_Search_Field_Content_Controls
{

    protected function register_content_control()
    {
        $this->start_controls_section(
            'deensimc-search-field-control-section',
            [
                'label' => esc_html__('Search Field', 'marquee-addons-for-elementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'deensimc_search_style',
            [
                'label' => esc_html__('Input Style', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'expand',
                'options' => [
                    'expand' => esc_html__('Expand', 'marquee-addons-for-elementor'),
                    'popup' => esc_html__('Popup', 'marquee-addons-for-elementor'),
                ],
            ]
        );
        $this->add_control(
            'deensimc_search_placeholder_heading',
            [
                'label' => esc_html__('Placeholder', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'deensimc_search_placeholder_text',
            [
                'label' => esc_html__('Text', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search...', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_icon',
            [
                'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-search',
                    'library' => 'fa-solid',
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $this->add_control(
            'deensimc_search_autocomplete',
            [
                'label' => esc_html__('Autocomplete', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'marquee-addons-for-elementor'),
                'label_off' => esc_html__('Off', 'marquee-addons-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'deensimc_search_clear_button_heading',
            [
                'label' => esc_html__('Clear Button', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'deensimc_search_clear_button_icon',
            [
                'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $this->add_control(
            'deensimc_search_submit_button_heading',
            [
                'label' => esc_html__('Submit Button', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'deensimc_search_style' => 'popup',
                ],
            ]
        );
        $this->add_control(
            'deensimc_search_submit_button_text',
            [
                'label' => esc_html__('Text', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Submit', 'marquee-addons-for-elementor'),
                'condition' => [
                    'deensimc_search_style' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_submit_button_icon',
            [
                'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
                'condition' => [
                    'deensimc_search_style' => 'popup',
                ],
            ]
        );

        $this->end_controls_section();
    }
}

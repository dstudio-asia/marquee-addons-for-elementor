<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

trait Button_Style_Controls
{
  private function register_button_style_section_controls()
  {
    $this->start_controls_section(
      'deensimc_button_marquee_button_style_section',
      [
        'label' => __('Button', 'marquee-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_STYLE,
      ]
    );

    // Position (Alignment)
    $this->add_responsive_control(
      'deensimc_button_alignment',
      [
        'label'   => __('Position', 'marquee-addons-for-elementor'),
        'type'    => Controls_Manager::CHOOSE,
        'options' => [
          'left'   => [
            'title' => __('Left', 'marquee-addons-for-elementor'),
            'icon'  => 'eicon-h-align-left',
          ],
          'center' => [
            'title' => __('Center', 'marquee-addons-for-elementor'),
            'icon'  => 'eicon-h-align-center',
          ],
          'right'  => [
            'title' => __('Right', 'marquee-addons-for-elementor'),
            'icon'  => 'eicon-h-align-right',
          ],
          'full'  => [
            'title' => __('Full', 'marquee-addons-for-elementor'),
            'icon'  => 'eicon-h-align-stretch',
          ],
        ],
        'default' => 'center',
        'selectors_dictionary' => [
          'left' => 'margin-left: 0; margin-right: auto;',
          'center' => 'margin-inline: auto;',
          'right' => 'margin-left: auto; margin-right: 0;',
          'full' => 'width: 100%;',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-button-marquee-container' => '{{VALUE}};',
        ],
      ]
    );

    // Typography
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name'     => 'deensimc_button_typography',
        'selector' => '{{WRAPPER}} .deensimc-button, {{WRAPPER}} .deensimc-button-text',
      ]
    );

    // Text Shadow
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name'     => 'deensimc_button_text_shadow',
        'selector' => '{{WRAPPER}} .deensimc-button, {{WRAPPER}} .deensimc-button-text',
      ]
    );

    // Normal & Hover Tabs
    $this->start_controls_tabs('deensimc_button_style_tabs');

    // Normal Tab
    $this->start_controls_tab(
      'deensimc_button_normal',
      [
        'label' => __('Normal', 'marquee-addons-for-elementor'),
      ]
    );

    $this->add_control(
      'deensimc_button_text_color',
      [
        'label'     => __('Text Color', 'marquee-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .deensimc-button, {{WRAPPER}} .deensimc-button-text' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
        'name'     => 'deensimc_button_background',
        'types'    => ['classic', 'gradient'],
        'exclude' => ['image'],
        'selector' => '{{WRAPPER}} .deensimc-button-marquee-container',
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'     => 'deensimc_button_box_shadow',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee-container',
      ]
    );

    $this->end_controls_tab();

    // Hover Tab
    $this->start_controls_tab(
      'deensimc_button_hover',
      [
        'label' => __('Hover', 'marquee-addons-for-elementor'),
      ]
    );

    $this->add_control(
      'deensimc_button_text_color_hover',
      [
        'label'     => __('Text Color', 'marquee-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .deensimc-button-marquee-container:hover .deensimc-button, {{WRAPPER}} .deensimc-button-marquee-container:hover .deensimc-button-text' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
        'name'     => 'deensimc_button_background_hover',
        'types'    => ['classic', 'gradient'],
        'exclude' => ['image'],
        'selector' => '{{WRAPPER}} .deensimc-button-marquee-container:hover',
      ]
    );

    $this->add_control(
      'deensimc_button_border_color_hover',
      [
        'label'     => __('Border Color', 'marquee-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .deensimc-button-marquee-container:hover' => 'border-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'     => 'deensimc_button_box_shadow_hover',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee-container:hover',
      ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();


    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name'     => 'deensimc_button_border',
        'separator' => 'before',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee-container',
      ]
    );

    $this->add_responsive_control(
      'deensimc_button_border_radius',
      [
        'label'      => __('Border Radius', 'marquee-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em'],
        'selectors'  => [
          '{{WRAPPER}} .deensimc-button-marquee-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    // Padding
    $this->add_responsive_control(
      'deensimc_button_padding',
      [
        'label'      => __('Padding', 'marquee-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'separator' => 'before',
        'size_units' => ['px', '%', 'em'],
        'selectors'  => [
          '{{WRAPPER}} .deensimc-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->end_controls_section();
  }
}

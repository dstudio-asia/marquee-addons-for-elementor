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
          '{{WRAPPER}} .deensimc-button-marquee' => '{{VALUE}};',
        ],
      ]
    );

    $this->add_control('deensimc_button_text_gap', [
      'label' => __('Gap', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SLIDER,
      'condition' => [
        'deensimc_button_marquee_state' => 'yes',
      ],
      'size_units' => ['px', 'em', 'rem'],
      'range' => [
        'px' => ['min' => 0, 'max' => 150],
      ],
      'selectors' => [
        '{{WRAPPER}} .deensimc-marquee-main-container' => '--deensimc-item-gap: {{SIZE}}{{UNIT}};',
      ],
    ]);

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
        'selector' => '{{WRAPPER}} .deensimc-button-marquee',
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'     => 'deensimc_button_box_shadow',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee',
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
          '{{WRAPPER}} .deensimc-button-marquee:hover .deensimc-button, {{WRAPPER}} .deensimc-button-marquee:hover .deensimc-button-text' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
        'name'     => 'deensimc_button_background_hover',
        'types'    => ['classic', 'gradient'],
        'exclude' => ['image'],
        'selector' => '{{WRAPPER}} .deensimc-button-marquee:hover',
      ]
    );

    $this->add_control(
      'deensimc_button_border_color_hover',
      [
        'label'     => __('Border Color', 'marquee-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .deensimc-button-marquee:hover' => 'border-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_group_control(
      Group_Control_Box_Shadow::get_type(),
      [
        'name'     => 'deensimc_button_box_shadow_hover',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee:hover',
      ]
    );

    $this->end_controls_tab();
    $this->end_controls_tabs();


    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name'     => 'deensimc_button_border',
        'separator' => 'before',
        'selector' => '{{WRAPPER}} .deensimc-button-marquee',
      ]
    );

    $this->add_responsive_control(
      'deensimc_button_border_radius',
      [
        'label'      => __('Border Radius', 'marquee-addons-for-elementor'),
        'type'       => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors'  => [
          '{{WRAPPER}} .deensimc-button-marquee' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        'size_units' => ['px', 'em', 'rem'],
        'selectors'  => [
          '{{WRAPPER}} .deensimc-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'deensimc_button_icon_style_section',
      [
        'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
        'condition' => [
          'deensimc_button_icon[value]!' => '',
        ],
      ]
    );
    // Icon Color
    $this->add_control(
      'deensimc_button_icon_color',
      [
        'label'     => esc_html__('Icon Color', 'marquee-addons-for-elementor'),
        'type'      => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .deensimc-button svg'       => 'fill: {{VALUE}};',
          '{{WRAPPER}} .deensimc-button i'         => 'color: {{VALUE}};',
          '{{WRAPPER}} .deensimc-button-text svg'  => 'fill: {{VALUE}};',
          '{{WRAPPER}} .deensimc-button-text i'    => 'color: {{VALUE}};',
        ],
        'condition' => [
          'deensimc_button_icon[value]!' => '',
        ],
      ]
    );

    // Icon Size
    $this->add_responsive_control(
      'deensimc_button_icon_size',
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
          '{{WRAPPER}} .deensimc-button svg'       => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .deensimc-button i'         => 'font-size: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .deensimc-button-text svg'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .deensimc-button-text i'    => 'font-size: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'deensimc_button_icon[value]!' => '',
        ],
      ]
    );
    $this->end_controls_section();
  }
}

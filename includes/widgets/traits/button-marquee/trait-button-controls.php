<?php

use Elementor\Controls_Manager;

trait Button_Controls
{
  private function register_button_section_controls()
  {
    $this->start_controls_section(
      'deensimc_button_marquee_button_section',
      [
        'label' => __('Button', 'marquee-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    // Button Text
    $this->add_control(
      'deensimc_button_text',
      [
        'label'       => __('Text', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'default'     => __('Click here', 'marquee-addons-for-elementor'),
        'placeholder' => __('Enter button text', 'marquee-addons-for-elementor'),
        'dynamic'     => [
          'active' => 'true'
        ]
      ]
    );

    // Button Link
    $this->add_control(
      'deensimc_button_link',
      [
        'label'       => __('Link', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'placeholder' => __('https://your-link.com', 'marquee-addons-for-elementor'),
        'dynamic'     => [
          'active' => 'true'
        ],
        'default'     => [
          'url' => '#',
        ],
      ]
    );

    // Icon
    $this->add_control(
      'deensimc_button_icon',
      [
        'label' => __('Icon', 'marquee-addons-for-elementor'),
        'type'  => Controls_Manager::ICONS,
        'skin' => 'inline',
        'label_block' => false,

      ]
    );

    // Icon Position
    $this->add_control(
      'deensimc_button_icon_position',
      [
        'label' => __('Icon Position', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'row' => [
            'title' => __('Left', 'marquee-addons-for-elementor'),
            'icon' => 'eicon-h-align-left',
          ],
          'row-reverse' => [
            'title' => __('Right', 'marquee-addons-for-elementor'),
            'icon' => 'eicon-h-align-right',
          ],
        ],
        'default' => 'row',
        'toggle' => true,
        'condition' => [
          'deensimc_button_icon[value]!' => '',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-button' => 'flex-direction: {{VALUE}};',
          '{{WRAPPER}} .deensimc-button-text' => 'flex-direction: {{VALUE}};',
        ],
      ]
    );

    // Icon Spacing
    $this->add_responsive_control(
      'deensimc_button_icon_spacing',
      [
        'label' => __('Icon Spacing', 'marquee-addons-for-elementor'),
        'type'  => Controls_Manager::SLIDER,
        'size_units' => ['px', 'em', 'rem'],
        'range' => [
          'px' => ['min' => 0, 'max' => 100],
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-button' => 'gap: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .deensimc-button-text' => 'gap: {{SIZE}}{{UNIT}};',
        ],
        'condition' => [
          'deensimc_button_icon[value]!' => '',
        ],
      ]
    );

    // Button ID
    $this->add_control(
      'deensimc_button_id',
      [
        'label'       => __('Button ID', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'dynamic'     => [
          'active' => true,
        ],
        'separator'   => 'before',
        'description' => __('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows A-Z, a-z, 0-9 & underscore chars without spaces.', 'marquee-addons-for-elementor'),
      ]
    );


    $this->end_controls_section();
  }
}

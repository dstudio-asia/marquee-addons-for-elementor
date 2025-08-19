<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;

trait Title_Controls {
  private function register_title_section_controls() {
    $this->start_controls_section(
      'deensimc_title_section',
      [
        'label' => __('Title', 'marquee-addons-for-elementor'),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control('deensimc_before_text', [
      'label' => __('Before Text', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::TEXT,
      'label_block' => true,
      'default' => __('Before text', 'marquee-addons-for-elementor'),
    ]);

    $repeater = new Repeater();
    $repeater->add_control('deensimc_animated_text', [
      'label' => __('Text', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::TEXT,
      'default' => __('Animated Text', 'marquee-addons-for-elementor'),
      'label_block' => true,
    ]);

    $this->add_control('deensimc_animated_texts', [
      'label' => __('Animated Texts', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::REPEATER,
      'fields' => $repeater->get_controls(),
      'default' => [
        ['deensimc_animated_text' => 'Animated Text'],
      ],
      'title_field' => '{{{ deensimc_animated_text }}}',
    ]);

    $this->add_control('deensimc_after_text', [
      'label' => __('After Text', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::TEXT,
      'label_block' => true,
      'default' => __('After text', 'marquee-addons-for-elementor'),
    ]);

    $this->add_responsive_control('deensimc_text_alignment', [
      'label' => __('Alignment', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::CHOOSE,
      'options' => [
        'start' => [
          'title' => __('Left', 'marquee-addons-for-elementor'),
          'icon' => 'eicon-text-align-left',
        ],
        'center' => [
          'title' => __('Center', 'marquee-addons-for-elementor'),
          'icon' => 'eicon-text-align-center',
        ],
        'end' => [
          'title' => __('Right', 'marquee-addons-for-elementor'),
          'icon' => 'eicon-text-align-right',
        ],
      ],
      'default' => 'start',
      'toggle' => true,
      'selectors' => [
        '{{WRAPPER}} .deensimc-heading' => 'justify-content: {{VALUE}};',
        '{{WRAPPER}} .deensimc-texts-wrapper' => 'justify-content: {{VALUE}};',
        '{{WRAPPER}} .deensimc-before-text' => 'text-align: {{VALUE}};',
        '{{WRAPPER}} .deensimc-after-text' => 'text-align: {{VALUE}};',
      ],
    ]);

    $this->add_control('deensimc_heading_tag', [
      'label' => __('HTML Tag', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SELECT,
      'default' => 'h2',
      'options' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'div' => 'div',
        'span' => 'span',
        'p' => 'p',
      ],
    ]);

    $this->end_controls_section();
  }
}

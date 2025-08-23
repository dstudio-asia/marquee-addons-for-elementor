<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;

trait Text_Styles_Controls {

  private function add_text_style_controls($section_id, $label, $selector_prefix, $text_field_name) {
    $this->start_controls_section(
      $section_id,
      [
        'label' => esc_html( $label , 'marquee-addons-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
          $text_field_name . '!' => '',
        ],
      ]
    );

    // Font color for before/after text
    if (in_array($section_id, ['deensimc_before_text_style', 'deensimc_after_text_style'])) {
      $this->add_control(
        "{$section_id}_color",
        [
          'label' => __('Font Color', 'marquee-addons-for-elementor'),
          'type' => Controls_Manager::COLOR,
          'selectors' => [
            "{{WRAPPER}} {$selector_prefix}" => 'color: {{VALUE}};',
          ],
        ]
      );
    }

    // Typography
    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => "{$section_id}_typography",
        'label' => __('Typography', 'marquee-addons-for-elementor'),
        'selector' => "{{WRAPPER}} {$selector_prefix}",
        'condition' => [
          $text_field_name . '!' => '',
        ],
      ]
    );

    // Text Stroke (popover for before/after text)
    if (in_array($section_id, ['deensimc_before_text_style', 'deensimc_after_text_style'])) {
      $this->add_group_control(
        Group_Control_Text_Stroke::get_type(),
        [
          'name' => "{$section_id}_stroke",
          'selector' => "{{WRAPPER}} {$selector_prefix}"
        ]
      );
    }

    // Text shadow
    $this->add_group_control(
      Group_Control_Text_Shadow::get_type(),
      [
        'name' => "{$section_id}_shadow",
        'label' => __('Text Shadow', 'marquee-addons-for-elementor'),
        'selector' => "{{WRAPPER}} {$selector_prefix}",
        'condition' => [
          $text_field_name . '!' => '',
        ],
      ]
    );

    $this->end_controls_section();
  }

  private function register_text_styles_section_controls() {
    $this->add_text_style_controls(
      'deensimc_before_text_style',
      'Before Text',
      '.deensimc-heading .deensimc-before-text',
      'deensimc_before_text'
    );

    $this->add_text_style_controls(
      'animated_text_style',
      'Animated Text',
      '.deensimc-heading .deensimc-texts-wrapper span',
      'deensimc_animated_texts'
    );

    $this->add_text_style_controls(
      'deensimc_after_text_style',
      'After Text',
      '.deensimc-heading .deensimc-after-text',
      'deensimc_after_text'
    );
  }
}

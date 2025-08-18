<?php

use Elementor\Controls_Manager;

trait Animation_Controls {
  private function register_animation_section_controls() {
    $this->start_controls_section(
      'animation_section',
      [
        'label' => __('Animation Effect', 'marquee-addons-for-elementor'),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control('is_animation_on', [
      'label' => __('Animation', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SWITCHER,
      'label_on' => __('On', 'marquee-addons-for-elementor'),
      'label_off' => __('Off', 'marquee-addons-for-elementor'),
      'return_value' => 'yes',
      'default' => 'yes',
    ]);

    $this->add_control('animation_type', [
      'label' => __('Type', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SELECT,
      'condition' => ['is_animation_on' => 'yes'],
      'default' => 'slide',
      'options' => [
        'slide' => __('Slide', 'marquee-addons-for-elementor'),
        'slide-horizontal' => __('Slide Horizontal', 'marquee-addons-for-elementor'),
        'rotation-3d' => __('3D Rotation', 'marquee-addons-for-elementor'),
        'construct' => __('Construct', 'marquee-addons-for-elementor'),
        'typing' => __('Typing', 'marquee-addons-for-elementor'),
        'twist' => __('Twist', 'marquee-addons-for-elementor'),
        'line' => __('Line', 'marquee-addons-for-elementor'),
        'wave' => __('Wave', 'marquee-addons-for-elementor'),
        'swing' => __('Swing', 'marquee-addons-for-elementor'),
        'tilt' => __('Tilt', 'marquee-addons-for-elementor'),
        'lean' => __('Lean', 'marquee-addons-for-elementor'),
      ],
    ]);

    $this->add_control('animation_speed', [
      'label' => __('Speed', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::NUMBER,
      'condition' => ['is_animation_on' => 'yes'],
      'min' => 1,
      'max' => 1000,
      'step' => 1,
      'default' => 10,
    ]);

    $this->add_control('pause_between_words', [
      'label' => __('Pause Between Words (sec)', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::NUMBER,
      'condition' => [
        'is_animation_on' => 'yes', 
        'animation_type' => 'construct'
      ],
      'min' => 0.1,
      'max' => 100,
      'step' => 0.1,
      'default' => 1,
    ]);

    $this->add_control('pause_after_typed', [
      'label' => __('Pause After Typed (sec)', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::NUMBER,
      'condition' => [
        'is_animation_on' => 'yes', 
        'animation_type' => 'typing'
      ],
      'min' => 0.1,
      'max' => 100,
      'step' => 0.1,
      'default' => 1,
    ]);

    $this->add_control('delay_per_word', [
      'label' => __('Delay Per Word (sec)', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::NUMBER,
      'condition' => [
        'is_animation_on' => 'yes', 
        'animation_type' => ['slide', 'slide-horizontal']
      ],
      'min' => 0.1,
      'max' => 100,
      'step' => 0.1,
      'default' => 1.5,
    ]);

    $this->add_control('slide_vertical_direction', [
      'label' => __('Slide Direction', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SELECT,
      'condition' => [
        'is_animation_on' => 'yes',
        'animation_type' => 'slide',
      ],
      'default' => '1',
      'options' => [
        '1' => __('To Top', 'marquee-addons-for-elementor'),
        '-1' => __('To Bottom', 'marquee-addons-for-elementor'),
      ],
    ]);
    
    $this->add_control('slide_horizontal_direction', [
      'label' => __('Slide Direction', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SELECT,
      'condition' => [
        'is_animation_on' => 'yes',
        'animation_type' => 'slide-horizontal',
      ],
      'default' => '1',
      'options' => [
        '1' => __('To Left', 'marquee-addons-for-elementor'),
        '-1' => __('To Right', 'marquee-addons-for-elementor'),
      ],
    ]);

    $this->add_control('line_type', [
      'label' => __('Line Type', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SELECT,
      'condition' => [
        'is_animation_on' => 'yes',
        'animation_type' => 'line'
      ],
      'default' => 'singleUnderline',
      'options' => [
        'singleUnderline' => __('Single Underline', 'marquee-addons-for-elementor'),
        'doubleUnderline' => __('Double Underline', 'marquee-addons-for-elementor'),
        'wavyUnderline' => __('Wavy Underline', 'marquee-addons-for-elementor'),
        'underlineZigzag' => __('Zigzag Underline', 'marquee-addons-for-elementor'),
        'circle' => __('Circle', 'marquee-addons-for-elementor'),

      ],
    ]);

    $this->add_control('delay_before_erase', [
      'label' => __('Delay Before Erase (sec)', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::NUMBER,
      'condition' => [
        'is_animation_on' => 'yes', 
        'animation_type' => 'line'
      ],
      'min' => 0.1,
      'max' => 100,
      'step' => 0.1,
      'default' => 1,
    ]);

    $this->add_control('animation_pause_on_hover', [
      'label' => __('Pause on Hover', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SWITCHER,
      'condition' => [
        'is_animation_on' => 'yes',
        'animation_type!' => 'line'
      ],
      'label_on' => __('On', 'marquee-addons-for-elementor'),
      'label_off' => __('Off', 'marquee-addons-for-elementor'),
      'return_value' => 'yes',
      'default' => '',
    ]);

    $this->end_controls_section();
  }
}

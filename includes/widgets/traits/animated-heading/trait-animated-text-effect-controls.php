<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

trait Animated_Text_Effect_Controls
{

  private function register_animated_text_effect_section_controls()
  {
    $this->start_controls_section(
      'deensimc_animated_text_effect_section',
      [
        'label' => __('Animated Text Effect', 'marquee-addons-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    // Select control: effect type
    $this->add_control(
      'deensimc_animated_text_effect_type',
      [
        'label' => __('Effect Type', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::SELECT,
        'default' => 'fill',
        'options' => [
          'fill' => __('Fill', 'marquee-addons-for-elementor'),
          'outline' => __('Outline', 'marquee-addons-for-elementor'),
          'deensimc-gradient-text' => __('Gradient', 'marquee-addons-for-elementor'),
          'deensimc-masked-text' => __('Image Masking', 'marquee-addons-for-elementor'),
        ],
      ]
    );

    // Fill: Text Color
    $this->add_control(
      'deensimc_animated_text_fill_color',
      [
        'label' => __('Text Color', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::COLOR,
        'condition' => [
          'deensimc_animated_text_effect_type' => 'fill',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => 'color: {{VALUE}};',
        ],
      ]
    );

    // Outline: Stroke color and width
    $this->add_control(
      'deensimc_animated_text_outline_color',
      [
        'label' => __('Outline Color', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::COLOR,
        'condition' => [
          'deensimc_animated_text_effect_type' => 'outline',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => '-webkit-text-stroke-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'deensimc_animated_text_outline_width',
      [
        'label' => __('Outline Width (px)', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'default' => [
          'size' => 2,
          'unit' => 'px',
        ],
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 10,
          ],
        ],
        'condition' => [
          'deensimc_animated_text_effect_type' => 'outline',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}}; color: transparent;',
        ],
      ]
    );


    // Gradient text effect
    $this->add_group_control(
      Group_Control_Background::get_type(),
      [
        'name' => 'deensimc_animated_text_gradient',
        'label' => __('Gradient Text', 'marquee-addons-for-elementor'),
        'types' => ['gradient'],
        'condition' => [
          'deensimc_animated_text_effect_type' => 'deensimc-gradient-text',
        ],
        'selector' => '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span',
      ]
    );

    // Image masking effect
    $this->add_control(
      'deensimc_animated_text_image_mask',
      [
        'label' => __('Mask Image', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
          'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
        'condition' => [
          'deensimc_animated_text_effect_type' => 'deensimc-masked-text',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => 'background-image: url({{URL}});',
        ],
      ]
    );


    $this->add_control(
      'deensimc_animated_text_image_mask_size',
      [
        'label' => __('Mask Size', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::SELECT,
        'default' => 'cover',
        'options' => [
          'auto' => __('Auto', 'marquee-addons-for-elementor'),
          'cover' => __('Cover', 'marquee-addons-for-elementor'),
          'contain' => __('Contain', 'marquee-addons-for-elementor'),
        ],
        'condition' => [
          'deensimc_animated_text_effect_type' => 'deensimc-masked-text',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => 'background-size: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'deensimc_animated_text_image_mask_position',
      [
        'label' => __('Mask Position', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::SELECT,
        'default' => 'center center',
        'options' => [
          'left top' => __('Top Left', 'marquee-addons-for-elementor'),
          'center top' => __('Top Center', 'marquee-addons-for-elementor'),
          'right top' => __('Top Right', 'marquee-addons-for-elementor'),
          'left center' => __('Center Left', 'marquee-addons-for-elementor'),
          'center center' => __('Center Center', 'marquee-addons-for-elementor'),
          'right center' => __('Center Right', 'marquee-addons-for-elementor'),
          'left bottom' => __('Bottom Left', 'marquee-addons-for-elementor'),
          'center bottom' => __('Bottom Center', 'marquee-addons-for-elementor'),
          'right bottom' => __('Bottom Right', 'marquee-addons-for-elementor'),
        ],
        'condition' => [
          'deensimc_animated_text_effect_type' => 'deensimc-masked-text',
        ],
        'selectors' => [
          '{{WRAPPER}} .deensimc-heading .deensimc-texts-wrapper span' => 'background-position: {{VALUE}};',
        ],
      ]
    );

    $this->add_control('deensimc_cursor_color', [
      'label' => __('Cursor Color', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::COLOR,
      'condition' => [
        'deensimc_is_animation_on' => 'yes',
        'deensimc_animation_type' => 'typing',
      ],
      'default' => '#000000',
      'selectors' => [
        '{{WRAPPER}} .typing .deensimc-texts-wrapper' => 'border-color: {{VALUE}};',
      ],
    ]);

    $this->add_control('deensimc_cursor_width', [
      'label' => __('Cursor Width', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SLIDER,
      'condition' => [
        'deensimc_is_animation_on' => 'yes',
        'deensimc_animation_type' => 'typing',
      ],
      'size_units' => ['px'],
      'range' => [
        'px' => [
          'min' => 1,
          'max' => 10,
          'step' => 0.1,
        ],
      ],
      'default' => [
        'unit' => 'px',
        'size' => 2,
      ],
      'selectors' => [
        '{{WRAPPER}} .typing .deensimc-texts-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
      ],
    ]);

    $this->add_control('deensimc_line_color', [
      'label' => __('Line Color', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::COLOR,
      'condition' => [
        'deensimc_is_animation_on' => 'yes',
        'deensimc_animation_type' => 'line',
      ],
      'default' => '#000000',
      'selectors' => [
        '{{WRAPPER}} .line .deensimc-animated-lines path' => 'stroke: {{VALUE}};',
      ],
    ]);

    $this->add_control('deensimc_line_width', [
      'label' => __('Line Width', 'marquee-addons-for-elementor'),
      'type' => Controls_Manager::SLIDER,
      'condition' => [
        'deensimc_is_animation_on' => 'yes',
        'deensimc_animation_type' => 'line',
      ],
      'range' => [
        'px' => [
          'min' => 1,
          'max' => 100,
          'step' => 1,
        ],
      ],
      'default' => [
        'size' => 10,
      ],
      'selectors' => [
        '{{WRAPPER}} .line .deensimc-animated-lines path' => 'stroke-width: {{SIZE}};',
      ],
    ]);


    $this->end_controls_section();
  }
}

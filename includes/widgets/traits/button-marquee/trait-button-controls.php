<?php

use Elementor\Controls_Manager;

trait Deensimc_Button_Controls
{
  private function register_button_section_controls()
  {
    $this->start_controls_section(
      'deensimc_button_marquee_button_section',
      [
        'label' => esc_html__('Button', 'marquee-addons-for-elementor'),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    // Button Text
    $this->add_control(
      'deensimc_button_text',
      [
        'label'       => esc_html__('Text', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Click here', 'marquee-addons-for-elementor'),
        'placeholder' => esc_html__('Enter button text', 'marquee-addons-for-elementor'),
        'dynamic'     => [
          'active' => 'true'
        ]
      ]
    );

    $this->add_control(
      'deensimc_button_link_type',
      [
        'label' => __('Link Type', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::SELECT,
        'default' => 'custom',
        'options' => [
          'custom' => __('Custom link', 'marquee-addons-for-elementor'),
          'youtube' => __('Youtube', 'marquee-addons-for-elementor'),
          'vimeo' => __('Vimeo', 'marquee-addons-for-elementor'),
          'hosted' => __('Self hosted', 'marquee-addons-for-elementor'),
        ],
      ]
    );

    // Button Link
    $this->add_control(
      'deensimc_button_link',
      [
        'label'       => esc_html__('Link', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'marquee-addons-for-elementor'),
        'dynamic'     => [
          'active' => 'true'
        ],
        'default'     => [
          'url' => '#',
        ],
        'condition' => [
          'deensimc_button_link_type' => 'custom'
        ]
      ]
    );
    $this->add_control(
      'deensimc_button_yt_video_link',
      [
        'label' => esc_html__('Link',  'marquee-addons-for-elementor'),
        'type' => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter your URL',  'marquee-addons-for-elementor'),
        'label_block' => true,
        'condition' => [
          'deensimc_button_link_type' => ['youtube'],
        ],
      ]
    );
    $this->add_control(
      'deensimc_button_vimeo_video_link',
      [
        'label' => esc_html__('Link',  'marquee-addons-for-elementor'),
        'type' => Controls_Manager::TEXT,
        'placeholder' => esc_html__('Enter your URL',  'marquee-addons-for-elementor'),
        'label_block' => true,
        'condition' => [
          'deensimc_button_link_type' => ['vimeo'],
        ],
      ]
    );

    $this->add_control(
      'deensimc_button_hosted_video_link',
      [
        'label' => esc_html__('Choose Video File',  'marquee-addons-for-elementor'),
        'type' => Controls_Manager::MEDIA,
        'media_types' => [
          'video',
        ],
        'condition' => [
          'deensimc_button_link_type' => 'hosted',
        ],
      ]
    );

    // Icon
    $this->add_control(
      'deensimc_button_icon',
      [
        'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),
        'type'  => Controls_Manager::ICONS,
        'skin' => 'inline',
        'label_block' => false,

      ]
    );

    // Icon Position
    $this->add_control(
      'deensimc_button_icon_position',
      [
        'label' => esc_html__('Icon Position', 'marquee-addons-for-elementor'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
          'row' => [
            'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
            'icon' => 'eicon-h-align-left',
          ],
          'row-reverse' => [
            'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
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
        'label' => esc_html__('Icon Spacing', 'marquee-addons-for-elementor'),
        'type'  => Controls_Manager::SLIDER,
        'size_units' => ['px', 'em', 'rem'],
        'default' => [
          'unit' => 'px',
          'size' => 8,
        ],
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
        'label'       => esc_html__('Button ID', 'marquee-addons-for-elementor'),
        'type'        => Controls_Manager::TEXT,
        'dynamic'     => [
          'active' => true,
        ],
        'separator'   => 'before',
        'description' => esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows A-Z, a-z, 0-9 & underscore chars without spaces.', 'marquee-addons-for-elementor'),
      ]
    );


    $this->end_controls_section();
  }
}

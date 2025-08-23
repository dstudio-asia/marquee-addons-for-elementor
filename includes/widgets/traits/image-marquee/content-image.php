<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Utils;

trait Deensimc_Image_Marquee_Content_Image
{
	protected function content_image()
	{
		$this->start_controls_section(
			'deensimc_content_section',
			[
				'label' => esc_html__('Images', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'deensimc_upload_gallery',
			[
				'label' => esc_html__('Add Images', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [
					[
						'id' => 'placeholder',
						'url' => Utils::get_placeholder_image_src(),
					],
				],
			]
		);

		$this->add_control(
			'deensimc_upload_gallery_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<strong>💡 Tip:</strong> For best performance, use a maximum of <strong>20 images</strong>.',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);


		$this->add_control(
			'deensimc_link_to',
			[
				'label' => esc_html__('Link', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__('None', 'marquee-addons-for-elementor'),
					'file' => esc_html__('Media File', 'marquee-addons-for-elementor'),
					'custom' => esc_html__('Custom URL', 'marquee-addons-for-elementor'),
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'deensimc_link',
			[
				'label' => esc_html__('Link', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::URL,
				'condition' => [
					'deensimc_link_to' => 'custom',
				],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'deensimc_open_lightbox',
			[
				'label' => esc_html__('Lightbox', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'description' => sprintf(
					/* translators: 1: Link open tag, 2: Link close tag. */
					esc_html__('Manage your site’s lightbox settings in the %1$sLightbox panel%2$s.', 'marquee-addons-for-elementor'),
					'<a href="javascript: $e.run( \'panel/global/open\' ).then( () => $e.route( \'panel/global/settings-lightbox\' ) )">',
					'</a>'
				),
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'marquee-addons-for-elementor'),
					'yes' => esc_html__('Yes', 'marquee-addons-for-elementor'),
					'no' => esc_html__('No', 'marquee-addons-for-elementor'),
				],
				'condition' => [
					'deensimc_link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'deensimc_caption_type',
			[
				'label' => esc_html__('Caption', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('None', 'marquee-addons-for-elementor'),
					'title' => esc_html__('Title', 'marquee-addons-for-elementor'),
					'caption' => esc_html__('Caption', 'marquee-addons-for-elementor'),
					'description' => esc_html__('Description', 'marquee-addons-for-elementor'),
				],
			]
		);

		$this->add_control(
			'deensimc_lazy_load_switch',
			[
				'label' => esc_html__('Lazy Load', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'deensimc_image_marquee_gap',
			[
				'label' => esc_html__('Gaps', 'marquee-addons-pro-for-elementor'),
				'type' => Controls_Manager::GAPS,
				'size_units' => ['px', 'em', 'rem', 'vw', 'custom'],
				'placeholder' => [
					'row' => '20',
					'column' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-main-container' => '--deensimc-container-padding: {{row}}{{UNIT}}; --deensimc-item-gap: {{column}}{{UNIT}};',
				],
				'validators' => [
					'Number' => [
						'min' => 0,
					],
				],
			]
		);

		$this->end_controls_section();
	}
}

<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;

trait Deensimc_Image_Marquee_Content_Image
{
	use Deensimc_Marquee_Gap_Controls;
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'deensimc_image_marquee',
				'default' => 'full',
			]
		);

		$this->add_responsive_control(
			'deensimc_image_object_fit',
			[
				'label' => esc_html__('Display Size', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => esc_html__('Cover', 'marquee-addons-for-elementor'),
					'contain' => esc_html__('Contain', 'marquee-addons-for-elementor'),
					'fill' => esc_html__('Fill', 'marquee-addons-for-elementor'),
					'scale-down' => esc_html__('Scale Down', 'marquee-addons-for-elementor'),
					'none' => esc_html__('None', 'marquee-addons-for-elementor'),
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-image' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'deensimc_image_position',
			[
				'label' => esc_html__('Position', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'left top' => esc_html__('Left Top', 'marquee-addons-for-elementor'),
					'center top' => esc_html__('Center Top', 'marquee-addons-for-elementor'),
					'right top' => esc_html__('Right Top', 'marquee-addons-for-elementor'),
					'left center' => esc_html__('Left Center', 'marquee-addons-for-elementor'),
					'center center' => esc_html__('Center', 'marquee-addons-for-elementor'),
					'right center' => esc_html__('Right Center', 'marquee-addons-for-elementor'),
					'left bottom' => esc_html__('Left Bottom', 'marquee-addons-for-elementor'),
					'center bottom' => esc_html__('Center Bottom', 'marquee-addons-for-elementor'),
					'right bottom' => esc_html__('Right Bottom', 'marquee-addons-for-elementor'),
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-image' => 'object-position: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'deensimc_image_size_position_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<strong>⚠️ Note:</strong> To adjust the Display Size and Position, please set both the width and height.',
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

		$this->register_gap_control();

		$this->end_controls_section();
	}
}

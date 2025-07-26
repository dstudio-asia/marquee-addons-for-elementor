<?php
if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;

trait NewsTickerGeneralSettingsControl
{

	protected function general_settings_control()
	{
		$this->start_controls_section(
			'deensimc_news_ticker_general_option_section',
			[
				'label' => esc_html__('General Settings', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$deensimc_post_types = $this->newticker_get_post_types();
		$deensimc_taxonomies = get_taxonomies([], 'objects');
		$this->add_control(
			'deensimc_post_type',
			[
				'label'   => __('Source', 'marquee-addons-for-elementor'),
				'type'    =>    Controls_Manager::SELECT,
				'options' => $deensimc_post_types,
				'default' => key($deensimc_post_types),
			]
		);


		foreach ($deensimc_taxonomies as $taxonomy => $object) {
			if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($deensimc_post_types))) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				[
					'label' => $object->label,
					'type' => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'object_type' => $taxonomy,
					'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
					'condition' => [
						'deensimc_post_type' => $object->object_type,
					],
				]
			);
		}



		$this->add_control(
			'deensimc_no_of_post',
			[
				'label' => __('Post Number', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'default' => __('5', 'marquee-addons-for-elementor')
			]
		);

		$this->add_control(
			'deensimc_enable_custom_text',
			[
				'label' => esc_html__('Enable Custom Text', 'marquee-addons-pro-for-elementor'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'marquee-addons-pro-for-elementor'),
				'label_off' => __('No', 'marquee-addons-pro-for-elementor'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'deensimc_custom_text',
			[
				'label' => esc_html__('Custom Text', 'marquee-addons-pro-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __('Custom Text', 'marquee-addons-pro-for-elementor'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'deensimc_custom_text_url',
			[
				'label' => esc_html__('Custom Text Link', 'marquee-addons-pro-for-elementor'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'marquee-addons-pro-for-elementor'),
				'label_block' => true,
				'show_external' => false,
				'show_nofollow' => false,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'deensimc_custom_text_list',
			[
				'label' => esc_html__('Custom Text Items', 'marquee-addons-pro-for-elementor'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{ deensimc_custom_text }}',
				'condition' => [
					'deensimc_enable_custom_text' => 'yes',
				],
			]
		);






















		$this->add_control(
			'deensimc_label',
			[
				'label' => __('Show label', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __('Off', 'marquee-addons-for-elementor'),
				'label_on' => __('On', 'marquee-addons-for-elementor'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_label_heading',
			[
				'label' => __('Label', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Latest News', 'marquee-addons-for-elementor'),
				'placeholder' => __('Latest News', 'marquee-addons-for-elementor'),

			]
		);

		// $this->add_control(
		// 	'deensimcpro_custom_text',
		// 	[
		// 		'label' => esc_html__('Custom Text', 'marquee-addons-pro-for-elementor'),
		// 		'type' => Controls_Manager::TEXT,
		// 		'placeholder' => __('Custom Text', 'marquee-addons-for-elementor'),
		// 		'label_block' => true,
		// 	]
		// );

		// $this->add_control(
		// 	'deensimcpro_custom_text_url',
		// 	[
		// 		'label' => esc_html__('Custom Text Link', 'marquee-addons-pro-for-elementor'),
		// 		'type' => Controls_Manager::URL,
		// 		'placeholder' => __('https://your-link.com', 'marquee-addons-pro-for-elementor'),
		// 		'label_block' => true,
		// 		'show_external' => false, 
		// 		'show_nofollow' => false,
		// 		'default' => [
		// 			'url' => '',
		// 			'is_external' => true,
		// 			'nofollow' => true,
		// 		],
		// 	]
		// );


		$this->add_control(
			'deensimc_label_icon',
			[
				'label' => __('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-bullhorn',
					'library' => 'fa-solid',
				],
			]
		);


		$this->end_controls_section();
	}

}
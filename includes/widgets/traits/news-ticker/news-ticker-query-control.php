<?php
if (! defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;

trait NewsTickerQueryControl
{

	protected function news_ticker_query_control()
	{
		$this->start_controls_section(
			'deensimc_section_query',
			[
				'label' => esc_html__('Query', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// 2) Category select2
		$this->add_control(
			'deensimc_categories_ids',
			[
				'label'       => __('Categories', 'marquee-addons-for-elementor'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => wp_list_pluck(get_categories(), 'name', 'term_id'),
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => __('Select category', 'marquee-addons-for-elementor'),
			]
		);

		// 3) Tag select2
		$this->add_control(
			'deensimc_tags_ids',
			[
				'label'       => __('Tags', 'marquee-addons-for-elementor'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => wp_list_pluck(get_tags(), 'name', 'term_id'),
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => __('Select tag', 'marquee-addons-for-elementor'),
			]
		);

		// 4) Author select2 (all users, searchable)
		$users = get_users(['orderby' => 'display_name']);
		$author_options = [];
		foreach ($users as $user) {
			/* translators: 1: user display name */
			$author_options[$user->ID] = sprintf('%s (#%d)', $user->display_name, $user->ID);
		}

		$this->add_control(
			'deensimc_author_ids',
			[
				'label'       => __('Authors', 'marquee-addons-for-elementor'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $author_options,
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => __('Type to search users', 'marquee-addons-for-elementor'),
			]
		);

		// Order By control
		$this->add_control(
			'deensimc_orderby',
			[
				'label'   => __('Order By', 'marquee-addons-for-elementor'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date' => __('Date', 'marquee-addons-for-elementor'),
					'rand' => __('Random', 'marquee-addons-for-elementor'),
				],
				'default' => 'date',
				'separator' => 'before',
			]
		);

		// Order Direction control
		$this->add_control(
			'deensimc_order',
			[
				'label'     => __('Order', 'marquee-addons-for-elementor'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'asc'  => __('ASC', 'marquee-addons-for-elementor'),
					'desc' => __('DESC', 'marquee-addons-for-elementor'),
				],
				'default'   => 'desc',
				// hide when random, since direction doesn’t apply to rand()
				'condition' => [
					'deensimc_orderby!' => 'rand',
				],
			]
		);


		$this->add_control(
			'deensimc_seperator_type',
			[
				'label' => __('Separator Type', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'seperator_icon' => __('Icon', 'marquee-addons-for-elementor'),
					'seperator_text' => __('Text', 'marquee-addons-for-elementor'),
					'seperator_feature_image' => __('Feature Image', 'marquee-addons-for-elementor'),
					'seperator_date' => __('Date', 'marquee-addons-for-elementor'),
				],
				'default' => 'seperator_text',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'deensimc_seperator_icon',
			[
				'label' => __('Icon', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'deensimc_seperator_type' => 'seperator_icon',
				],
			]
		);
		$this->add_control(
			'deensimc_seperator_text',
			[
				'label' => __('Text', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::TEXT,
				'default' => __('|', 'marquee-addons-for-elementor'),
				'placeholder' => __('Text', 'marquee-addons-for-elementor'),
				'condition' => [
					'deensimc_seperator_type' => 'seperator_text',
				],
			]
		);



		$this->end_controls_section();
	}
}

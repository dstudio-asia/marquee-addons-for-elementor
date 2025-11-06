<?php

if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;

trait Deensimc_Search_Field_Query_Controls
{

    protected function register_content_section_query()
    {
        $this->start_controls_section(
            'deensimc_content_section_query',
            [
                'label' => esc_html__('Query', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_source',
            [
                'label' => esc_html__('Source', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__('All', 'marquee-addons-for-elementor'),
                    'product' => esc_html__('Products', 'marquee-addons-for-elementor'),
                    'post' => esc_html__('Post', 'marquee-addons-for-elementor'),
                    'page' => esc_html__('Pages', 'marquee-addons-for-elementor'),
                    'floating-elements' => esc_html__('Floating Elements', 'marquee-addons-for-elementor'),
                    'theme-builder' => esc_html__('Theme Builder', 'marquee-addons-for-elementor'),
                ],
                'default' => 'all',
            ]
        );

        // Normal & Hover Tabs
        $this->start_controls_tabs('deensimc_search_query_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'deensimc_search_include_query',
            [
                'label' => esc_html__('Include', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_include_by',
            [
                'label' => esc_html__('Include By', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'term'   => __('Term', 'marquee-addons-for-elementor'),
                    'author' => __('Author', 'marquee-addons-for-elementor'),
                ],
                'multiple' => true,
                'label_block' => true,
                'placeholder' => esc_html__('Select items to include', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_include_terms',
            [
                'label' => __('Terms', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_all_terms(), // Helper function
                'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'marquee-addons-for-elementor'),
                'condition' => [
                    'deensimc_search_include_by' => 'term',
                ],
            ]
        );

        $this->add_control(
            'deensimc_include_authors',
            [
                'label' => __('Authors', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_all_authors(), // Helper function
                'condition' => [
                    'deensimc_search_include_by' => 'author',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_date_query',
            [
                'label' => esc_html__('Date', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__('All', 'marquee-addons-for-elementor'),
                    'past_day' => esc_html__('Past Day', 'marquee-addons-for-elementor'),
                    'past_week' => esc_html__('Past Week', 'marquee-addons-for-elementor'),
                    'past_month' => esc_html__('Past Month', 'marquee-addons-for-elementor'),
                    'past_quarter' => esc_html__('Past Quarter', 'marquee-addons-for-elementor'),
                    'past_year' => esc_html__('Past Year', 'marquee-addons-for-elementor'),
                    'custom' => esc_html__('Custom', 'marquee-addons-for-elementor'),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'deensimc_search_orderby',
            [
                'label' => esc_html__('Order By', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post_date' => esc_html__('Date', 'marquee-addons-for-elementor'),
                    'post_title' => esc_html__('Title', 'marquee-addons-for-elementor'),
                    'menu_order' => esc_html__('Menu Order', 'marquee-addons-for-elementor'),
                    'modified' => esc_html__('Last Modified', 'marquee-addons-for-elementor'),
                    'comment_count' => esc_html__('Comment Count', 'marquee-addons-for-elementor'),
                    'rand' => esc_html__('Random', 'marquee-addons-for-elementor'),
                ],
                'default' => 'post_date',
            ]
        );

        $this->add_control(
            'deensimc_search_order',
            [
                'label' => esc_html__('Order', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => esc_html__('DESC', 'marquee-addons-for-elementor'),
                    'ASC' => esc_html__('ASC', 'marquee-addons-for-elementor'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'deensimc_search_query_id',
            [
                'label' => esc_html__('Query ID', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'description' => esc_html__('Give your Query a custom unique id to allow server side filtering', 'marquee-addons-for-elementor'),
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'deensimc_search_exclude_query',
            [
                'label' => esc_html__('Exclude', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_search_exclude_by',
            [
                'label' => esc_html__('Exclude By', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'term'   => __('Term', 'marquee-addons-for-elementor'),
                    'author' => __('Author', 'marquee-addons-for-elementor'),
                ],
                'multiple' => true,
                'label_block' => true,
                'placeholder' => esc_html__('Select items to exclude', 'marquee-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'deensimc_exclude_terms',
            [
                'label' => __('Terms', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_all_terms(),
                'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'marquee-addons-for-elementor'),
                'condition' => [
                    'deensimc_search_exclude_by' => 'term',
                ],
            ]
        );

        $this->add_control(
            'deensimc_exclude_authors',
            [
                'label' => __('Authors', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_all_authors(), // Helper function
                'condition' => [
                    'deensimc_search_exclude_by' => 'author',
                ],
            ]
        );

        $this->add_control(
            'deensimc_search_date_exclude_query',
            [
                'label' => esc_html__('Date', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__('All', 'marquee-addons-for-elementor'),
                    'past_day' => esc_html__('Past Day', 'marquee-addons-for-elementor'),
                    'past_week' => esc_html__('Past Week', 'marquee-addons-for-elementor'),
                    'past_month' => esc_html__('Past Month', 'marquee-addons-for-elementor'),
                    'past_quarter' => esc_html__('Past Quarter', 'marquee-addons-for-elementor'),
                    'past_year' => esc_html__('Past Year', 'marquee-addons-for-elementor'),
                    'custom' => esc_html__('Custom', 'marquee-addons-for-elementor'),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'deensimc_search_exclude_orderby',
            [
                'label' => esc_html__('Order By', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => esc_html__('Date', 'marquee-addons-for-elementor'),
                    'title' => esc_html__('Title', 'marquee-addons-for-elementor'),
                    'menu_order' => esc_html__('Menu Order', 'marquee-addons-for-elementor'),
                    'modified' => esc_html__('Last Modified', 'marquee-addons-for-elementor'),
                    'comment_count' => esc_html__('Comment Count', 'marquee-addons-for-elementor'),
                    'rand' => esc_html__('Random', 'marquee-addons-for-elementor'),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'deensimc_search_exclude_order',
            [
                'label' => esc_html__('Order', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => esc_html__('DESC', 'marquee-addons-for-elementor'),
                    'ASC' => esc_html__('ASC', 'marquee-addons-for-elementor'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'deensimc_search_exclude_query_id',
            [
                'label' => esc_html__('Query ID', 'marquee-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'description' => esc_html__('Give your Query a custom unique id to allow server side filtering', 'marquee-addons-for-elementor'),
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }
}

<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;


class Deensimc_News_Ticker extends Widget_Base
{

	use NewsTickerAdditionalOptionsControl;
	use NewsTickerGeneralSettingsControl;
	use NewsTickerStyleControl;

	public function get_name()
	{
		return 'deensimc-news-ticker';
	}

	public function get_title()
	{
		return esc_html__('News Ticker', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-form-vertical eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['slider', 'marquee', 'slide', 'deen', 'smooth', 'vertical', 'horizontal', 'scroll', 'news', 'ticker'];
	}


	public function newticker_get_post_types()
	{
		$post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
		$post_types = wp_list_pluck($post_types, 'label', 'name');
		return array_diff_key($post_types, ['elementor_library', 'attachment']);
	}

	protected function get_all_posts_for_select()
	{
		$options = [];
		$posts = get_posts([
			'post_type'      => 'post',
			'posts_per_page' => 100,
		]);

		foreach ($posts as $post) {
			$options[$post->ID] = $post->post_title;
		}

		return $options;
	}

	protected function register_controls(): void
	{

		$this->general_settings_control();


    $this->start_controls_section(
        'section_query',
        [
            'label' => esc_html__('Query', 'marquee-addons-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

		// Default: Post
		$this->add_control(
			'deensimc_post_type',
			[
				'label'   => __('Source', 'marquee-addons-for-elementor'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => get_post_types(['public' => true, '_builtin' => true], 'names'),
			]
		);

		// Include/Exclude Toggle
		$this->add_control(
			'deensimc_include_exclude',
			[
				'label'   => __('Include / Exclude', 'marquee-addons-for-elementor'),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'include' => [
						'title' => __('Include', 'marquee-addons-for-elementor'),
					],
					'exclude' => [
						'title' => __('Exclude', 'marquee-addons-for-elementor'),
					],
				],
				'default' => 'exclude',
			]
		);

		// Filter By
		$this->add_control(
			'deensimc_filter_by',
			[
				'label'       => __('Filter By', 'marquee-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'default'     => ['current_post'],
				'options'     => [
					'current_post'  => __('Current Post', 'marquee-addons-for-elementor'),
					'manual_ids'    => __('Manual Selection', 'marquee-addons-for-elementor'),
					'term'          => __('Term', 'marquee-addons-for-elementor'),
					'author'        => __('Author', 'marquee-addons-for-elementor'),
				],
			]
		);

		// Manual Post Selector
		$this->add_control(
			'deensimc_selected_posts',
			[
				'label'       => __('Search & Select', 'marquee-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_all_posts_for_select(), // Helper function
				'condition'   => [
					'deensimc_filter_by' => 'manual_ids',
				],
			]
		);

		// Term Filter
		$this->add_control(
			'deensimc_term_ids',
			[
				'label'       => __('Term', 'marquee-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __('Comma-separated term IDs', 'marquee-addons-for-elementor'),
				'condition'   => [
					'deensimc_filter_by' => 'term',
				],
			]
		);

		// Author
		$this->add_control(
			'deensimc_author_ids',
			[
				'label'       => __('Author', 'marquee-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __('Comma-separated author IDs', 'marquee-addons-for-elementor'),
				'condition'   => [
					'deensimc_filter_by' => 'author',
				],
			]
		);

		// Avoid Duplicates
		$this->add_control(
			'deensimc_avoid_duplicates',
			[
				'label'        => __('Avoid Duplicates', 'marquee-addons-for-elementor'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'description'  => __('Set to Yes to avoid duplicate posts from showing up.', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		// Offset
		$this->add_control(
			'deensimc_offset',
			[
				'label'       => __('Offset', 'marquee-addons-for-elementor'),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'default'     => 0,
				'description' => __('Skip over this many posts.', 'marquee-addons-for-elementor'),
			]
		);

		// Order By
		$this->add_control(
			'deensimc_order_by',
			[
				'label'   => __('Order By', 'marquee-addons-for-elementor'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'       => __('Date', 'marquee-addons-for-elementor'),
					'title'      => __('Title', 'marquee-addons-for-elementor'),
					'rand'       => __('Random', 'marquee-addons-for-elementor'),
					'comment_count' => __('Comment Count', 'marquee-addons-for-elementor'),
				],
			]
		);

		// Order
		$this->add_control(
			'deensimc_order',
			[
				'label'   => __('Order', 'marquee-addons-for-elementor'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC'  => __('ASC', 'marquee-addons-for-elementor'),
					'DESC' => __('DESC', 'marquee-addons-for-elementor'),
				],
			]
		);

    $this->add_control(
        'deensimc_title_trim_enable',
        [
            'label' => __('Limit Title Length?', 'marquee-addons-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'marquee-addons-for-elementor'),
            'label_off' => __('No', 'marquee-addons-for-elementor'),
            'return_value' => 'yes',
            'default' => '',
        ]
    );

    $this->add_control(
        'deensimc_title_trim_length',
        [
            'label' => __('Max Title Length', 'marquee-addons-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 5,
            'max' => 100,
            'step' => 1,
            'default' => 50,
            'condition' => [
                'deensimc_title_trim_enable' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();


		$this->additional_options_control();
		$this->style_section_control();
	}



	public function newticker_get_query_args($settings = [])
	{
		// Set default values if any key is missing in $settings
		$settings = wp_parse_args($settings, [
			'deensimc_post_type'    => 'post',
			'orderby'               => 'date',
			'order'                 => 'desc',
			'posts_per_page'        => 6,
			'deensimc_no_of_post'   => 6,
		]);

		// Base query arguments for WP_Query / get_posts
		$args = [
			'post_type'           => $settings['deensimc_post_type'],
			'post_status'         => 'publish',
			'orderby'             => $settings['orderby'],
			'order'               => $settings['order'],
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $settings['deensimc_no_of_post'],
		];

		// Only add tax_query if post type is not 'page'
		if ($settings['deensimc_post_type'] !== 'page') {
			$args['tax_query'] = [];

			// Get all registered taxonomies for the selected post type
			$taxonomies = get_object_taxonomies($settings['deensimc_post_type'], 'objects');

			foreach ($taxonomies as $taxonomy) {
				$setting_key = $taxonomy->name . '_ids';

				if (!empty($settings[$setting_key])) {
					$args['tax_query'][] = [
						'taxonomy' => $taxonomy->name,
						'field'    => 'term_id',
						'terms'    => $settings[$setting_key],
					];
				}
			}

			// If multiple taxonomy filters are added, relate them using AND
			if (!empty($args['tax_query'])) {
				$args['tax_query']['relation'] = 'AND';
			}
		}

		return $args;
	}


	protected function get_query_args($settings)
	{
		$args = [
			'post_type'      => $settings['deensimc_post_type'] ?? 'post',
			'post_status'    => 'publish',
			'posts_per_page' => intval($settings['deensimc_posts_per_page'] ?? 6),
		];

		$taxonomies = get_object_taxonomies($args['post_type'], 'names');
		foreach ($taxonomies as $tax) {
			$key = $tax . '_ids';
			if (!empty($settings[$key]) && is_array($settings[$key])) {
				$args['tax_query'][] = [
					'taxonomy' => $tax,
					'field'    => 'term_id',
					'terms'    => $settings[$key],
				];
			}
		}

		if (!empty($args['tax_query'])) {
			$args['tax_query']['relation'] = 'AND';
		}

		return $args;
	}



	protected function render_news_ticker_texts($settings, $posts = [])
	{
		if (empty($posts)) {
			$posts = [];

			for ($i = 0; $i < 10; $i++) {
				$posts[] = (object)[
					'post_title' => 'No Latest News',
					'custom_url' => '',
					'is_custom'  => true,
				];
			}
		}


		echo '<div class="deensimc-news-wrapper">';
		$posts_count = count($posts);
		$min_item = 10;
		if ($posts_count < $min_item) {
			$needed = $min_item - $posts_count;
			for ($i = 0; $i < $needed; $i++) {
				$posts[] = $posts[$i % $posts_count];
			}
		}
		foreach ($posts as $index => $post) {
				$title = isset($post->post_title) ? $post->post_title : '';

				if (!empty($settings['deensimc_title_trim_enable']) && $settings['deensimc_title_trim_enable'] === 'yes') {
					$max_len = !empty($settings['deensimc_title_trim_length']) ? intval($settings['deensimc_title_trim_length']) : 50;
					if (strlen($title) > $max_len) {
						$title = mb_substr($title, 0, $max_len) . '...';
					}
				}
			$url = isset($post->is_custom) && $post->is_custom && !empty($post->custom_url)
				? $post->custom_url
				: get_permalink($post);
?>
			<span class="deensimc-scroll-text">
				<a href="<?php echo esc_url($url); ?>" class="deensimc-title-link" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html($title); ?>
				</a>
			</span>
			<?php

			if (!empty($settings['deensimc_seperator_icon']) && $settings['deensimc_seperator_type'] == 'seperator_icon') {  ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-icon">
					<?php Icons_Manager::render_icon($settings['deensimc_seperator_icon'], ['aria-hidden' => 'true']);   ?>
				</span>
			<?php }
			if (!empty($settings['deensimc_seperator_text']) && $settings['deensimc_seperator_type'] == 'seperator_text') { ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-text"><?php echo esc_html($settings['deensimc_seperator_text']); ?></span>
			<?php
			}
			if ($settings['deensimc_seperator_type'] == 'seperator_date') { ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-date"><?php echo esc_html(get_the_date()); ?></span>
		<?php
			}
		}

		echo '</div>';
	}


	/**
	 * Renders news ticker widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$pause_on_hover = $settings['deensimc_news_ticker_pause_on_hover_switch'];
		$animation_speed = $settings['deensimc_news_ticker_text_animation_speed'];

		$marquee_orientation =  'horizontal';
		$slide_direction_class = $settings['deensimc_news_ticker_slide_direction'] === 'yes' ? ' deensimc-marquee-reverse' : '';

		$marquee_classes = $marquee_orientation . " " . $slide_direction_class;





		$is_reverse = $settings['deensimc_news_ticker_slide_direction'] === 'yes' ? 'deensimc-reverse-enabled' : '';

		$args = $this->newticker_get_query_args($settings);



		$myposts = get_posts($args);

		// if (!empty($settings['deensimc_custom_text_list']) && is_array($settings['deensimc_custom_text_list'])) {
		// 	foreach ($settings['deensimc_custom_text_list'] as $item) {
		// 		if (empty($item['deensimc_custom_text'])) {
		// 			continue;
		// 		}

		// 		$custom_post = (object)[
		// 			'ID'          => 'custom_' . uniqid(),
		// 			'post_title'  => $item['deensimc_custom_text'],
		// 			'post_type'   => 'custom_text',
		// 			'post_status' => 'custom',
		// 			'custom_url'  => esc_url($item['deensimc_custom_text_url']['url'] ?? ''),
		// 			'is_custom'   => true,
		// 		];

		// 		array_unshift($myposts, $custom_post); // prepend to the beginning
		// 	}
		// }


		?>
		<div class="deensimc-wrapper deensimc-news-ticker-wrapper">
			<div class="deensimc-marquee deensimc-marquee-<?php echo esc_attr($marquee_classes); ?> deensimc-news-ticker-marquee" data-pause-on-hover="<?php echo esc_attr($pause_on_hover) ?>" data-animation-speed="<?php echo esc_attr($animation_speed) ?>">
				<?php if ($settings['deensimc_label'] === 'yes') : ?>
					<div class="deensimc-news-ticker-label <?php echo esc_attr($is_reverse); ?>">
						<span class="deensimc-news-ticker-icon">
							<?php if (!empty($settings['deensimc_label_icon'])) : ?>
								<?php Icons_Manager::render_icon($settings['deensimc_label_icon'], ['aria-hidden' => 'true']); ?>
							<?php endif; ?>
						</span>

						<div class="deensimc-label-heading">
							<?php
							$label_tag = isset($settings['deensimc_label_heading_tag']) ? esc_attr($settings['deensimc_label_heading_tag']) : 'h4';
							?>
							<<?php echo $label_tag; ?>>
								<?php echo esc_html($settings['deensimc_label_heading']); ?>
							</<?php echo $label_tag; ?>>
						</div>

					</div>
				<?php endif; ?>
				<div class="deensimc-marquee-group deensimc-news-ticker-group">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-group deensimc-news-ticker-group">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
			</div>
		</div>
<?php
	}
}
?>
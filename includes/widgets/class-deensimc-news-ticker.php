<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;

/**
 * Class Deensimc_Text_Marquee
 * Widget for displaying a text marquee
 */

class Deensimc_News_Ticker extends Widget_Base
{

	use Textmarquee_Content_Text_Repeater;
	use Textmarquee_Content_Additional_Options;
	use Textmarquee_Style_Text_Contents;
	public function get_name()
	{
		return 'deensimc-news-ticker';
	}

	public function get_title()
	{
		return esc_html__('News Ticker Widget', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-form-vertical';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['slider', 'marquee', 'slide', 'deen', 'smooth', 'vertical', 'horizontal', 'scroll'];
	}


	public function newticker_get_post_types()
	{
		$post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
		$post_types = wp_list_pluck($post_types, 'label', 'name');
		return array_diff_key($post_types, ['elementor_library', 'attachment']);
	}

	protected function register_controls(): void
	{



		// $this->content_additional_options();


		// $this->style_text_contents();

		$this->start_controls_section(
			'deensimc_news_ticker_additional_option_section',
			[
				'label' => esc_html__('Additional Options', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$post_types1 = $this->newticker_get_post_types();
		$taxonomies = get_taxonomies([], 'objects');
		$this->add_control(
			'deensimc_post_type',
			[
				'label' => __('Source', 'elementor-news-ticker'),
				'type' => Controls_Manager::SELECT,
				'options' => $post_types1,
				'default' => key($post_types1),
			]
		);


		foreach ($taxonomies as $taxonomy => $object) {
			if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types1))) {
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
				'label' => __('Post Number', 'elementor-news-ticker'),
				'type' => Controls_Manager::NUMBER,
				'default' => __('6', 'elementor-news-ticker')
			]
		);
		$this->add_control(
			'deensimc_label',
			[
				'label' => __('Show label', 'elementor-news-ticker'),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __('Off', 'elementor-news-ticker'),
				'label_on' => __('On', 'elementor-news-ticker'),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_label_heading',
			[
				'label' => __('Label', 'elementor-news-ticker'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Latest News', 'elementor-news-ticker'),
				'placeholder' => __('Latest News', 'elementor-news-ticker'),

			]
		);
		$this->add_control(
			'deensimc_label_icon',
			[
				'label' => __('Icon', 'elementor-news-ticker'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fa fa-bolt',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'deensimc_news_ticker_slide_position',
			[
				'label' => esc_html__('Show Vertical', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'deensimc_news_ticker_slide_direction',
			[
				'label' => esc_html__('Show Reverse', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'deensimc_news_ticker_text_marquee_alignment',
			[
				'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-marquee-vertical, .deensimc-marquee-vertical .deensimc-marquee-group' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'deensimc_news_ticker_pause_on_hover_switch',
			[
				'label' => esc_html__('Pause On Hover', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'deensimc_news_ticker_show_shadow_switch',
			[
				'label' => esc_html__('Show Shadow', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'marquee-addons-for-elementor'),
				'label_off' => esc_html__('Hide', 'marquee-addons-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'deensimc_news_ticker_text_animation_speed',
			[
				'label' => esc_html__('Animation Speed', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 1000,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_responsive_control(
			'deensimc_news_ticker_widget_height',
			[
				'label' => esc_html__('Slider Height', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => ['vh'],
				'range' => [
					'vh' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 60,
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'deensimc_news_ticker_slide_position',
							'operator' => '==',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-wrapper-vertical' => 'height: {{SIZE}}vh;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_seperator_content',
			[
				'label' => __('Separator', 'elementor-news-ticker'),
			]
		);
		$this->add_control(
			'deensimc_seperator_type',
			[
				'label' => __('Separator Type', 'elementor-news-ticker'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'icon' => __('Icon', 'elementor-news-ticker'),
					'text' => __('Text', 'elementor-news-ticker'),
					'pdate' => __('Date', 'elementor-news-ticker'),

				],
				'default' => 'icon',
			]
		);
		$this->add_control( //Add control to select an icon for button1.
			'deensimc_seperator_icon',
			[
				'label' => __('Icon', 'elementor-news-ticker'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fa fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'deensimc_seperator_type' => 'icon',
				],
			]
		);
		$this->add_control(
			'deensimc_seperator_text',
			[
				'label' => __('Text', 'elementor-news-ticker'),
				'type' => Controls_Manager::TEXT,
				'default' => __('|', 'elementor-news-ticker'),
				'placeholder' => __('Text', 'elementor-news-ticker'),
				'condition' => [
					'deensimc_seperator_type' => 'text',
				],
			]
		);
		$this->end_controls_section();

		

		$this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__('Contents', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'deensimc_label_icon_indent',
			[
				'label' => __('Icon Spacing', 'elementor-news-ticker'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label .deensimc-news-ticker-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'deensimc_label_color',
			[
				'label' => __('Label Color', 'elementor-news-ticker'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label' => 'color: {{VALUE}};',
					'{{WRAPPER}} .deensimc-news-ticker-label .news-ticker-icon' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'deensimc_label_background_color',
			[
				'label' => __('Background Color', 'elementor-news-ticker'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
				],
				'default' => '#595959',
				'selectors' => [
					'{{WRAPPER}} .deensimc-news-ticker-label' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-news-ticker-label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'deensimc_title_style',
			[
				'label' => __('Title', 'elementor-news-ticker'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'deensimc_title_padding',
			[
				'label'         => esc_html__('Padding', 'elementor-news-ticker'),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'default'       => [
					'unit'  => 'px',
					'top'   => 0,
					'right' => 20,
					'bottom' => 0,
					'left'  => 20,
				],
				'selectors'     => [
					'{{WRAPPER}} .deensimc-title-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'deensimc_title_color',
			[
				'label' => __('Title Color', 'elementor-news-ticker'),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .deensimc-title-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .deensimc-title-link',
			]
		);
		$this->end_controls_section();
	}

	public function newticker_get_query_args($settings = [])
	{
		$settings = wp_parse_args($settings, [
			'deensimc_post_type' => 'post',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => 6,

		]);

		$args = [
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
			'posts_per_page' => $settings['deensimc_no_of_post'],

		];

		$args['deensimc_post_type'] = $settings['deensimc_post_type'];

		if ($args['deensimc_post_type'] !== 'page') {
			$args['tax_query'] = [];
			$taxonomies = get_object_taxonomies($settings['deensimc_post_type'], 'objects');

			foreach ($taxonomies as $object) {
				$setting_key = $object->name . '_ids';

				if (!empty($settings[$setting_key])) {
					$args['tax_query'][] = [
						'taxonomy' => $object->name,
						'field' => 'term_id',
						'terms' => $settings[$setting_key],
					];
				}
			}

			if (!empty($args['tax_query'])) {
				$args['tax_query']['relation'] = 'AND';
			}
		}



		return $args;
	}

	/**
	 * Renders each text item in the marquee, including an optional icon and text content.
	 *
	 * @param array $settings Widget settings containing the text and icon data.
	 */
	protected function render_news_ticker_texts($settings, $posts = [])
	{
		if (empty($posts)) {
			echo '<p class="deensimc-scroll-text">No posts found.</p>';
			return;
		}

		echo '<div class="deensimc-text-wrapper">';
		$posts_count = count($posts);
		$min_item = 10;
		if ($posts_count < $min_item) {
			$needed = $min_item - $posts_count;
			for ($i = 0; $i < $needed; $i++) {
				$posts[] = $posts[$i % $posts_count];
			}
		}
		foreach ($posts as $index => $post) {
			$title = get_the_title($post);
			$url = get_permalink($post);
?>
			<span class="deensimc-scroll-text">
				<a href="<?php echo esc_url($url); ?>" class="deensimc-title-link" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html($title); ?>
				</a>
			</span>
			<?php

			if (!empty($settings['deensimc_seperator_icon']) && $settings['deensimc_seperator_type'] == 'icon') {  ?>
				<span class="separator-news-item-icon news-item-<?php echo esc_attr($this->get_id()); ?> deensimc_seperator_icon">
					<?php Icons_Manager::render_icon($settings['deensimc_seperator_icon'], ['aria-hidden' => 'true']);   ?>
				</span>
			<?php }
			if (!empty($settings['deensimc_seperator_text']) && $settings['deensimc_seperator_type'] == 'text') { ?>
				<span class="news-item-<?php echo esc_attr($this->get_id()); ?> deensimc_seperator_text"><?php echo esc_html($settings['deensimc_seperator_text']); ?></span>
			<?php
			}
			if ($settings['deensimc_seperator_type'] == 'pdate') { ?>
				<span class="news-item-<?php echo esc_attr($this->get_id()); ?> sep_date"><?php echo esc_html(get_the_date()); ?></span>
		<?php
			}



		
		}

		echo '</div>';
	}


	/**
	 * Renders text marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$marquee_orientation = $settings['deensimc_news_ticker_slide_position'] === 'yes' ? 'vertical' : 'horizontal';
		$slide_direction_class = $settings['deensimc_news_ticker_slide_direction'] === 'yes' ? ' deensimc-marquee-reverse' : '';
		$pause_on_hover = $settings['deensimc_news_ticker_pause_on_hover_switch'];
		$animation_speed = $settings['deensimc_news_ticker_text_animation_speed'];
		$marquee_classes = $marquee_orientation . " " . $slide_direction_class;
		$show_shadow = $settings['deensimc_news_ticker_show_shadow_switch'] === 'yes' ? 'deensimc-shadow' : 'deensimc-no-shadow';
		$is_reverse = $settings['deensimc_news_ticker_slide_direction'] === 'yes' ? 'deensimc-reverse-enabled' : '';

		$args = $this->newticker_get_query_args($settings);
		$myposts = get_posts($args);
		?>
		<div class="deensimc-wrapper deensimc-wrapper-<?php echo esc_attr($marquee_orientation); ?> deensimc-news-ticker-wrapper">
			<div class="deensimc-marquee <?php echo esc_attr($show_shadow); ?> deensimc-marquee-<?php echo esc_attr($marquee_classes); ?> deensimc-news-ticker-marquee" data-pause-on-hover="<?php echo esc_attr($pause_on_hover) ?>" data-animation-speed="<?php echo esc_attr($animation_speed) ?>">
				<?php if ($settings['deensimc_label'] === 'yes') : ?>
					<div class="deensimc-news-ticker-label <?php echo esc_attr($is_reverse); ?>">
						<span class="deensimc-news-ticker-icon">
							<?php if (!empty($settings['deensimc_label_icon'])) : ?>
								<?php Icons_Manager::render_icon($settings['deensimc_label_icon'], ['aria-hidden' => 'true']); ?>
							<?php endif; ?>
						</span>
						<?php echo esc_html($settings['deensimc_label_heading']); ?>
					</div>
				<?php endif; ?>
				<div class="deensimc-marquee-group">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-group">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
			</div>
		</div>
<?php
	}
}
?>
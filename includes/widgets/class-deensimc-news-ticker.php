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
	use NewsTickerSeparatorControl;
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
		return 'eicon-form-vertical';
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

	protected function register_controls(): void
	{

		$this->general_settings_control();
		$this->additional_options_control();
		$this->separator_control();
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



	protected function render_news_ticker_texts($settings, $posts = [])
	{
		if (empty($posts)) {
			echo '<p class="deensimc-scroll-text">No posts found.</p>';
			return;
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

		$marquee_classes =  'horizontal';
		$is_reverse = $settings['deensimc_news_ticker_slide_direction'] === 'yes' ? 'deensimc-reverse-enabled' : '';

		$args = $this->newticker_get_query_args($settings);
		$custom_text = $settings['deensimcpro_custom_text'] ? $settings['deensimcpro_custom_text'] : '';
		$custom_url  = $settings['deensimcpro_custom_text_url']['url'] ?? '';
		$myposts = get_posts($args);
		if (!empty($custom_text)) {
			$custom_post = (object)[
				'ID' => 'custom_' . uniqid(), // Safe fake ID
				'post_title' => $custom_text,
				'post_content' => '',
				'post_excerpt' => '',
				'post_type' => 'custom_text',
				'post_status' => 'custom',
				'custom_url' => esc_url($custom_url),
				'is_custom' => true
			];

			// Add to the beginning
			array_unshift($myposts, $custom_post);
		}

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
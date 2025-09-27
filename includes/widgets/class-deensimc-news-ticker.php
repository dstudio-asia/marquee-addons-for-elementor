<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;


class Deensimc_News_Ticker extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Deensimc_Marquee_Controls;
	use NewsTickerLayoutControl;
	use NewsTickerStyleControl;
	use NewsTickerQueryControl;

	public function get_style_depends()
	{
		return ['deensimc-news-ticker-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-news-ticker-marquee-script'];
	}

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
		return 'deensimc-news-ticker-icon eicon-deensimc';
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

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-news-ticker-widget-in-elementor/';
	}

	protected function register_controls(): void
	{

		$this->layout_control();
		$this->news_ticker_query_control();

		$this->register_marquee_control(
			'deensimc_news_ticker_marquee_options',
			['orientation', 'edge_shadow'] //Exclude controls
		);

		$this->style_section_control();
	}



	public function newticker_get_query_args($settings = [])
	{
		// Merge with defaults
		$settings = wp_parse_args($settings, [
			'deensimc_post_type'  => 'post',
			'deensimc_no_of_post' => 6,
			'deensimc_categories_ids'      => [],
			'deensimc_tags_ids'            => [],
			'deensimc_author_ids'          => [],
			'deensimc_orderby'    => 'date',
			'deensimc_order'      => 'desc',
		]);

		// Base args
		$args = [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval($settings['deensimc_no_of_post']),
		];

		// Order by & order
		if ('rand' === $settings['deensimc_orderby']) {
			$args['orderby'] = 'rand';
		} else {
			// date or any other future extensions
			$args['orderby'] = $settings['deensimc_orderby'];
			$args['order']   = strtoupper($settings['deensimc_order']) === 'ASC' ? 'ASC' : 'DESC';
		}

		// Category filter
		if (! empty($settings['deensimc_categories_ids'])) {
			$args['category__in'] = array_map('intval', $settings['deensimc_categories_ids']);
		}

		// Tag filter
		if (! empty($settings['deensimc_tags_ids'])) {
			$args['tag__in'] = array_map('intval', $settings['deensimc_tags_ids']);
		}

		// Author filter
		if (! empty($settings['deensimc_author_ids'])) {
			$args['author__in'] = array_map('intval', $settings['deensimc_author_ids']);
		}

		return $args;
	}


	protected function render_label($settings)
	{
		if ($settings['deensimc_label'] === 'yes') : ?>
			<div class="deensimc-news-ticker-label">
				<span class="deensimc-news-ticker-icon">
					<?php if (!empty($settings['deensimc_label_icon'])) : ?>
						<?php Icons_Manager::render_icon($settings['deensimc_label_icon'], ['aria-hidden' => 'true']); ?>
					<?php endif; ?>
				</span>

				<div class="deensimc-label-heading">
					<?php
					$label_tag = isset($settings['deensimc_label_heading_tag']) ? esc_attr($settings['deensimc_label_heading_tag']) : 'h4';
					?>
					<<?php echo esc_html($label_tag); ?>>
						<?php echo esc_html($settings['deensimc_label_heading']); ?>
					</<?php echo esc_html($label_tag); ?>>
				</div>
			</div>
		<?php endif;
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
		// Determine link target/rel based on control
		$open_in_new_tab = (! empty($settings['deensimc_open_in_new_tab']) && 'yes' === $settings['deensimc_open_in_new_tab']);
		$link_target     = $open_in_new_tab ? '_blank' : '_self';
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
			<span class="deensimc-news-text">
				<a href="<?php echo esc_url($url); ?>" class="deensimc-title-link" target="<?php echo esc_attr($link_target); ?>" rel="noopener noreferrer">
					<?php echo esc_html($title); ?>
				</a>
			</span>
			<?php

			if ('seperator_feature_image' === $settings['deensimc_seperator_type']) {
				$post_id = is_object($post) ? intval($post->ID) : 0;
			?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-feature-image">
					<?php
					if ($post_id && has_post_thumbnail($post_id)) {
						echo get_the_post_thumbnail(
							$post_id,
							[50, 50],
							[
								'class' => 'deensimc-feature-image',
								'alt'   => esc_attr(get_the_title($post_id)),
							]
						);
					}
					?>
				</span>
			<?php
			} ?>
			<?php if (!empty($settings['deensimc_seperator_icon']) && $settings['deensimc_seperator_type'] == 'seperator_icon') {  ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-icon">
					<?php Icons_Manager::render_icon($settings['deensimc_seperator_icon'], ['aria-hidden' => 'true']);   ?>
				</span>
			<?php }
			if (!empty($settings['deensimc_seperator_text']) && $settings['deensimc_seperator_type'] == 'seperator_text') { ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-text"><?php echo esc_html($settings['deensimc_seperator_text']); ?></span>
			<?php
			}
			if ($settings['deensimc_seperator_type'] == 'seperator_date') { ?>
				<span class="deensimc-news-item-<?php echo esc_attr($this->get_id()); ?> deensimc-seperator-date"><?php echo esc_html(get_the_date()); ?>
				</span>
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
		$args = $this->newticker_get_query_args($settings);
		$myposts = get_posts($args);
		$is_reverse = $settings['deensimc_marquee_reverse_direction'] === 'yes';
		$is_pause_on_hover = $settings['deensimc_pause_on_hover'] === 'yes';
		$marquee_speed = $settings['deensimc_marquee_speed'];

		$conditional_class = [];
		if ($is_reverse) {
			$conditional_class[] = 'deensimc-marquee-reverse';
		}
		if ($is_pause_on_hover) {
			$conditional_class[] = 'deensimc-marquee-pause-on-hover';
		}

		?>
		<div class="deensimc-marquee-main-container deensimc-news-ticker <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
			<?php if (!$is_reverse) $this->render_label($settings) ?>
			<div class="deensimc-marquee-track-wrapper">
				<div class="deensimc-marquee-track">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_news_ticker_texts($settings, $myposts); ?>
				</div>
			</div>
			<?php if ($is_reverse) $this->render_label($settings) ?>
		</div>
<?php
	}
}
?>
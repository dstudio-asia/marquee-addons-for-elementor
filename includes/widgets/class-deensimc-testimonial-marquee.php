<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Testimonial_Marquee
 * Widget for displaying a testimonial marquee
 */

class Deensimc_Testimonial_Marquee extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Testimonial_Marquee_Contents;
	use Testimonial_Marquee_Content_Text_Unfold;
	use Deensimc_Marquee_Controls;
	use Testimonial_Marquee_Style_Contents_Box;
	use Testimonial_Marquee_Style_Contents;
	use Testimonial_Marquee_Style_Image;
	use Testimonial_Marquee_Style_Name_Title;
	use Testimonial_Marquee_Style_Review;
	use Deensimc_Style_Edge_Shadow;

	public function get_style_depends()
	{
		return ['deensimc-testimonial-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-testimonial-marquee-script'];
	}

	public function get_name()
	{
		return 'deensimc-testimonial';
	}

	public function get_title()
	{
		return esc_html__('Testimonial Marquee', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-deensimc deensimc-testimonial-marquee-icon';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['testimonail', 'slide', 'deen', 'slider'];
	}

	protected function register_controls()
	{
		$this->register_content_controls();
		$this->content_text_unfold();
		$this->register_marquee_control('deensimc_testimonial_marquee_options');

		$this->style_contents_box();

		$this->style_contents();

		$this->style_image();

		$this->style_name_title();

		$this->style_review();
		$this->register_style_edge_shadow('deensimc_testimonial_marquee_edge_shadow');
	}


	/**
	 * Renders the testimonial rating.
	 *
	 * This function outputs the rating stars, including full, half, and empty stars based on the rating value.
	 *
	 * @param array $testimonial The testimonial data, including the rating and rating counter.
	 */
	protected function render_ratings($testimonial)
	{
?>
		<div class="deensimc-tes-ratings deensimc-testimonial-ratings">
			<div class="deensimc-tes-star-icon fs-6">
				<?php
				$deensimc_rating = $testimonial['deensimc_testimonial_rating_num'];
				$deensimc_full_stars = floor($deensimc_rating);
				$deensimc_half_star = $deensimc_rating - $deensimc_full_stars;

				// Render full stars
				for ($k = 0; $k < $deensimc_full_stars; $k++) { ?>
					<span class="deensimc-tes-icons"><i class="fa fa-star"></i></span>
				<?php }

				// Render half star
				if ($deensimc_half_star >= 0.5) { ?>
					<span class="deensimc-tes-icons-half"><i class="fa fa-star"></i></span>
				<?php }

				// Render remaining empty stars
				for ($j = 0; $j < 5 - ceil($testimonial['deensimc_testimonial_rating_num']); $j++) { ?>
					<span class="deensimc-tes-icons-none"><i class="fa fa-star"></i></span>
				<?php } ?>
				<?php
				if ('yes' === $testimonial['deensimc_testimonial_rating_in_text']) {
				?>
					<small class="deensimc-tes-review-text">
						<?php echo esc_html__('(', 'marquee-addons-for-elementor') . esc_html($deensimc_rating) . esc_html__(')', 'marquee-addons-for-elementor'); ?>
					</small>
				<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function render_testimonial($settings, $allowed_icon_tags)
	{
		$testimonials = $settings['deensimc_repeater_testimonial_main'] ?? [];
		$count        = count($testimonials);

		// If less than 8, duplicate until at least 8
		if ($count > 0 && $count < 8) {
			$i = 0;
			while (count($testimonials) < 8) {
				$duplicate            = $testimonials[$i % $count];
				$duplicate['_is_dup'] = true; // Mark as duplicate
				$testimonials[]       = $duplicate;
				$i++;
			}
		}

		// Render left quote if available
		$quote_left = '';
		if (! empty($settings['deensimc_testimonial_quote_left_icon'])) {
			ob_start();
			Icons_Manager::render_icon(
				$settings['deensimc_testimonial_quote_left_icon'],
				['aria-hidden' => 'true']
			);
			$quote_left = ob_get_clean();
		}

		// Render right quote if available
		$quote_right = '';
		if (! empty($settings['deensimc_testimonial_quote_right_icon'])) {
			ob_start();
			Icons_Manager::render_icon(
				$settings['deensimc_testimonial_quote_right_icon'],
				['aria-hidden' => 'true']
			);
			$quote_right = ob_get_clean();
		}


		$visible_word_length = $settings['deensimc_tesimonial_excerpt_length'];
		$fold_text = $settings['deensimc_tesimonial_excerpt_title'];
		$unfold_text = $settings['deensimc_tesimonial_excerpt_title_less'];

		foreach ($testimonials as $testimonial) {
			$testimonial_text = $testimonial['deensimc_testimonial_content'];
			$author_image_url = empty($testimonial['deensimc_testimonial_image']['url']) ? 'no-image' : '';
			$is_dup           = !empty($testimonial['_is_dup']);
			$word_count = str_word_count(wp_strip_all_tags($testimonial_text));
		?>
			<li class="deensimc-tes-item deensimc-tes-wrapper" aria-hidden="<?php echo esc_attr($is_dup ? ' true' : 'false') ?>">
				<figure class="deensimc-tes-main">
					<?php if (!empty($testimonial_text)) : ?>
						<blockquote class="deensimc-tes-text">
							<div class="contents-wrapper" data-visible-word-length="<?php echo esc_attr($visible_word_length) ?>">
								<?php if ($quote_left) : ?>
									<span class="quote-left"><?php echo wp_kses($quote_left, $allowed_icon_tags); ?></span>
								<?php endif; ?> <span class="deensimc-contents">
									<?php echo esc_html($testimonial_text); ?>
								</span>
								<?php if ($word_count > $visible_word_length) : ?>
									<a href="javascript:void(0)" class="deensimc-toggle">
										<span class="fold-text"><?php echo esc_html($fold_text); ?></span>
										<span class="unfold-text"><?php echo esc_html($unfold_text); ?></span>
									</a>
								<?php endif; ?>
								<?php if ($quote_right) : ?>
									<span class="quote-right"><?php echo wp_kses($quote_right, $allowed_icon_tags); ?></span>
								<?php endif; ?>
							</div>
							<div class="deensimc-tes-bg-overlay"></div>
						</blockquote>
					<?php endif; ?>

					<div class="deensimc-tes-author <?php echo esc_attr($author_image_url); ?>">
						<?php if (!empty($testimonial['deensimc_testimonial_image']['url'])) : ?>
							<img src="<?php echo esc_url($testimonial['deensimc_testimonial_image']['url']); ?>"
								alt="<?php esc_attr_e('Author image', 'marquee-addons-for-elementor'); ?>" />
						<?php endif; ?>

						<?php if (!empty($testimonial['deensimc_testimonial_name']) || !empty($testimonial['deensimc_testimonial_title'])) : ?>
							<h5 class="deensimc-tes-heading">
								<?php if (!empty($testimonial['deensimc_testimonial_name'])) : ?>
									<span class="deensimc-tes-name">
										<?php echo esc_html($testimonial['deensimc_testimonial_name']); ?>
									</span>
								<?php endif; ?>

								<?php if (!empty($testimonial['deensimc_testimonial_title'])) : ?>
									<span class="deensimc-tes-title">
										<?php echo esc_html($testimonial['deensimc_testimonial_title']); ?>
									</span>
								<?php endif; ?>
							</h5>
						<?php endif; ?>

						<?php
						if (
							isset($testimonial['deensimc_testimonial_show_rating']) &&
							$testimonial['deensimc_testimonial_show_rating'] === 'yes' &&
							!empty($testimonial['deensimc_testimonial_rating_num'])
						) {
							$this->render_ratings($testimonial);
						}
						?>

					</div>
				</figure>
			</li>
		<?php
		}
	}

	/**
	 * Renders testimonial marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$allowed_icon_tags = [
			'i' => [
				'class' => [],
				'aria-hidden' => [],
			],
			'svg' => [
				'class'   => [],
				'width'   => [],
				'height'  => [],
				'viewbox' => [],
				'fill'    => [],
				'xmlns'   => [],
			],
			'path' => [
				'd'    => [],
				'fill' => [],
			],
		];

		$is_vertical = $settings['deensimc_marquee_vertical_orientation'] === 'yes';
		$is_reverse = $settings['deensimc_marquee_reverse_direction'] === 'yes';
		$is_pause_on_hover = $settings['deensimc_pause_on_hover'] === 'yes';
		$marquee_speed = $settings['deensimc_marquee_speed'];
		$is_show_edge_shadow = $settings['deensimc_show_edge_shadow'] === 'yes';

		$conditional_class = [];
		if ($is_vertical) {
			$conditional_class[] = 'deensimc-marquee-vertical';
		}
		if ($is_reverse) {
			$conditional_class[] = 'deensimc-marquee-reverse';
		}
		if ($is_pause_on_hover) {
			$conditional_class[] = 'deensimc-marquee-pause-on-hover';
		}
		if ($is_show_edge_shadow) {
			$conditional_class[] = 'deensimc-marquee-edge-shadow';
		}

		?>
		<div class="deensimc-marquee-main-container deensimc-testimonial-marquee <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
			<div class="deensimc-marquee-track-wrapper">
				<ul class="deensimc-marquee-track">
					<?php $this->render_testimonial($settings, $allowed_icon_tags) ?>
				</ul>
				<ul aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_testimonial($settings, $allowed_icon_tags) ?>
				</ul>
			</div>
		</div>
<?php
	}
}
?>
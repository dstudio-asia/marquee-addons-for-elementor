<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Testimonial_Marquee
 * Widget for displaying a testimonial marquee
 */

class Deensimc_Testimonial_Marquee extends Widget_Base
{

	use Testimonial_Marquee_Contents;
	use Testimonial_Marquee_Content_Text_Unfold;
	use Deensimc_Marquee_Controls;
	use Testimonial_Marquee_Style_Contents_Box;
	use Testimonial_Marquee_Style_Contents;
	use Testimonial_Marquee_Style_Image;
	use Testimonial_Marquee_Style_Name_Title;
	use Testimonial_Marquee_Style_Review;
	use Deensimc_Style_Edge_Shadow;

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

	protected function get_upsale_data(): array
	{
		return [
			'condition' => !class_exists('\Deensimcpro_Marquee\Marqueepro'),
			'image' => esc_url(ELEMENTOR_ASSETS_URL . 'images/go-pro.svg'),
			'image_alt' => esc_attr__('Upgrade', 'marquee-addons-for-elementor'),
			'title' => esc_html__('Get MarqueeAddons Pro', 'marquee-addons-for-elementor'),
			'description' => esc_html__('Get the premium version of the MarqueeAddons and grow your website capabilities.', 'marquee-addons-for-elementor'),
			'upgrade_url' => esc_url('https://marqueeaddons.com'),
			'upgrade_text' => esc_html__('Upgrade Now', 'marquee-addons-for-elementor'),
		];
	}

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-advanced-testimonial-marquee-widget-in-elementor/';
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
	 * Renders the testimonial content block.
	 *
	 * This function outputs the main content of the testimonial, including the text and "Show More" button if available.
	 *
	 * @param array $testimonial The testimonial data, including the content field.
	 * @param array $settings The widget settings, including the "Show More" button text.
	 */
	protected function render_testimonial_contents($testimonial)
	{
?>
		<blockquote class="deensimc-tes-text">
			<span>
				<?php echo esc_html($testimonial['deensimc_testimonial_content']); ?>
			</span>
		</blockquote>
	<?php
	}

	/**
	 * Renders the author information.
	 *
	 * This function displays the author's name and title within the testimonial.
	 *
	 * @param array $testimonial The testimonial data, including the author name and title fields.
	 */
	protected function render_author_info($testimonial)
	{
	?>
		<h5 class="deensimc-tes-heading">
			<span class="deensimc-tes-name">
				<?php echo esc_html($testimonial['deensimc_testimonial_name']); ?>
			</span>
			<span class="deensimc-tes-title">
				<?php echo esc_html($testimonial['deensimc_testimonial_title']); ?>
			</span>
		</h5>
	<?php
	}

	/**
	 * Renders the author profile image.
	 *
	 * This function outputs the author's profile image if provided.
	 *
	 * @param array $testimonial The testimonial data, including the profile image URL.
	 */
	protected function render_author_profile($testimonial)
	{
	?>
		<img src="<?php echo esc_url($testimonial['deensimc_testimonial_image']['url']); ?>" alt="<?php esc_attr_e('Author image', 'marquee-addons-for-elementor'); ?>" />
	<?php
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

	protected function render_testimonial($testimonials)
	{

		foreach ($testimonials as $testimonial) {
			$author_image_url = $testimonial['deensimc_testimonial_image']['url'] ? '' : 'no-image';
		?>
			<li class="deensimc-tes-item deensimc-tes-wrapper">
				<figure class="deensimc-tes-main">
					<?php
					// Render testimonial contents
					if ('' !== $testimonial['deensimc_testimonial_content']) {
						$this->render_testimonial_contents($testimonial);
					}
					?>
					<div class="deensimc-tes-author <?php echo esc_attr($author_image_url); ?>">
						<?php
						// Render author image
						$has_author_image = !empty($testimonial['deensimc_testimonial_image']['url']);
						if ($has_author_image) {
							$this->render_author_profile($testimonial);
						}

						// Render author info and ratings
						if ('' !== $testimonial['deensimc_testimonial_name'] || '' !== $testimonial['deensimc_testimonial_title']) {
							$this->render_author_info($testimonial);

							if ('yes' === $testimonial['deensimc_testimonial_show_rating'] && '' !== $testimonial['deensimc_testimonial_rating_num']) {
								$this->render_ratings($testimonial);
							}
						}
						?>
					</div>
				</figure>
			</li>
		<?php }
	}

	/**
	 * Renders testimonial marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$testimonials = $settings['deensimc_repeater_testimonial_main'];

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
					<?php $this->render_testimonial($testimonials) ?>
				</ul>
				<ul aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_testimonial($testimonials) ?>
				</ul>
			</div>
		</div>
<?php
	}
}
?>
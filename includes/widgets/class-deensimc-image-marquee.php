<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Image_Marquee
 * Widget for displaying an image marquee.
 */
class Deensimc_Image_Marquee extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Deensimc_Image_Marquee_Content_Image;
	use Deensimc_Marquee_Controls;
	use Deensimc_Image_Marquee_Image_Style;
	use Deensimc_Image_Marquee_Caption_Style;
	use Deensimc_Style_Edge_Shadow;

	public function get_style_depends()
	{
		return ['deensimc-image-marquee-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-image-marquee-script'];
	}

	public function get_name()
	{
		return 'deensimc-smooth-marquee';
	}

	public function get_title()
	{
		return esc_html__('Image Marquee', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'deensimc-image-marquee-icon eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['slider', 'marquee', 'slide', 'deen', 'smooth', 'vertical', 'horizontal', 'scroll'];
	}

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-image-marquee-widget-in-elementor/';
	}

	protected function register_controls()
	{
		$this->content_image();
		$this->register_marquee_control('deensimc_image_marquee_options');
		$this->register_image_style_controls();
		$this->register_style_caption();
		$this->register_style_edge_shadow('deensimc_image_marquee_edge_shadow');
	}

	/**
	 * Get image caption.
	 */
	protected function deensimc_get_caption($image, $caption_type)
	{
		$attachment_post = get_post($image['id']);
		if (!$attachment_post) {
			return '';
		}
		switch ($caption_type) {
			case 'caption':
				return $attachment_post->post_excerpt;
			case 'title':
				return $attachment_post->post_title;
		}
	}

	/**
	 * Renders the image gallery with a group of images.
	 */
	protected function render_image_gallery_group($settings, $link_type, $lazy_load_attr, $open_lightbox)
	{
		$images = $settings['deensimc_upload_gallery'] ?? [];
		$required = 8;
		$count    = count($images);

		if ($count > 0 && $count < $required) {
			$original = $images;
			// Duplicate full batches until we have at least $required
			while (count($images) < $required) {
				foreach ($original as $img) {
					$dup = $img;
					$dup['_is_dup'] = true;
					$images[] = $dup;
				}
			}
		}

		foreach ($images as $image) {
			if (empty($image['url']) || !preg_match('/\.(jpe?g|png|gif|webp|avif|bmp)$/i', $image['url'])) {
				continue;
			}
			$is_dup = !empty($image['_is_dup']);
			$alt = !empty($image['alt']) ? $image['alt'] : 'Image gallery marquee';

			if ($link_type !== 'none') {
				if ($link_type === 'file') {
					echo '<a data-elementor-open-lightbox="' . esc_attr($open_lightbox) . '" href="' . esc_url($image['url']) . '"' . ($is_dup ? ' aria-hidden="true" tabindex="-1"' : '') . '>';
				} elseif ($link_type === 'custom') { ?>
					<a <?php $this->print_render_attribute_string('deensimc_link'); ?> aria-hidden="<?php echo esc_attr($is_dup ? 'true' : 'false') ?>" tabindex="<?php echo esc_attr($is_dup ? '-1' : '') ?>">
			<?php
				}
			}

			echo '<figure class="deensimc-img-wrapper"' . ($is_dup ? ' aria-hidden="true"' : '') . '>';
			echo '<div class="deensimc-img"><img class="deensimc-marquee-image" src="' . esc_url($image['url']) . '" ' . esc_html($lazy_load_attr) . ' alt="' . esc_attr($alt) . '"></div>';
			echo '<figcaption class="deensimc-image-marquee-caption">'
				. esc_html($this->deensimc_get_caption($image, $settings['deensimc_caption_type']))
				. '</figcaption>';
			echo '</figure>';
			if ($link_type !== 'none') {
				echo '</a>';
			}
		}
	}

	/**
	 * Renders image marquee widget.
	 */
	protected function render()
	{
		$settings              = $this->get_settings_for_display();

		if (!empty($settings['deensimc_link']['url'])) {
			$this->add_link_attributes('deensimc_link', $settings['deensimc_link']);
		}

		$lazy_load_attr = $settings['deensimc_lazy_load_switch'] === 'yes' ? 'loading=lazy' : '';
		$link_type      = $settings['deensimc_link_to'];
		$open_lightbox  = $settings['deensimc_open_lightbox'];
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
			<div class="deensimc-marquee-main-container deensimc-image-marquee <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
				<div class="deensimc-marquee-track-wrapper">
					<div class="deensimc-marquee-track">
						<?php $this->render_image_gallery_group($settings, $link_type, $lazy_load_attr, $open_lightbox); ?>
					</div>
					<div aria-hidden="true" class="deensimc-marquee-track">
						<?php $this->render_image_gallery_group($settings, $link_type, $lazy_load_attr, $open_lightbox); ?>
					</div>
				</div>
			</div>
	<?php
	}
}

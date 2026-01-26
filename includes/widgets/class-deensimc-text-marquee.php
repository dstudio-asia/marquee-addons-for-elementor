<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;

/**
 * Class Deensimc_Text_Marquee
 * Widget for displaying a text marquee
 */

class Deensimc_Text_Marquee extends Widget_Base
{
	use Deensimc_Utils;
	use Deensimc_Promotional_Banner;
	use Deensimc_Textmarquee_Content_Text_Repeater;
	use Deensimc_Textmarquee_Layout_Controls;
	use Deensimc_Marquee_Controls;
	use Deensimc_Textmarquee_Style_Text_Contents;
	use Deensimc_Style_Edge_Shadow;

	public function get_style_depends()
	{
		return ['deensimc-text-marquee-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-text-marquee-script'];
	}

	public function get_name()
	{
		return 'deensimc-smooth-text';
	}

	public function get_title()
	{
		return esc_html__('Text Marquee', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-deensimc deensimc-text-marquee-icon';
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
		return 'https://marqueeaddons.com/how-to-use-the-advanced-text-marquee-widget-in-elementor/';
	}

	protected function register_controls(): void
	{

		$this->content_text_repeater();
		$this->register_marquee_control('deensimc_text_marquee_options');
		$this->style_text_contents();
		$this->register_layout_controls();
		$this->register_style_edge_shadow('deensimc_text_marquee_edge_shadow');
	}

	/**
	 * Renders each text item in the marquee, including an optional icon and text content.
	 *
	 * @param array $settings Widget settings containing the text and icon data.
	 */
	protected function render_marquee_texts($texts, $is_vertical, $tag, $track_id)
	{
		$required = $is_vertical ? 12 : 6;
		$count    = count($texts);
		if ($count > 0 && $count < $required) {
			$original = $texts;
			// Duplicate full batches until we have at least $required
			while (count($texts) < $required) {
				foreach ($original as $text) {
					$dup = $text;
					$dup['_is_dup'] = true;
					$texts[] = $dup;
				}
			}
		}

		foreach ($texts as $index => $text) {

			$is_dup = ! empty($text['_is_dup']);
			$link   = $text['deensimc_repeater_text_link'] ?? [];

			// Unique key per repeater item
			$link_key = 'deensimc_text_link_' . $track_id . '_' . $index;

			if (! empty($link['url'])) {
				$this->add_link_attributes($link_key, $link);
			}
?>
			<div class="deensimc-text-wrapper" aria-hidden="<?php echo esc_attr($is_dup ? 'true' : 'false') ?>">
				<?php Icons_Manager::render_icon($text['deensimc_repeater_text_icon'], ['aria-hidden' => 'true']); ?>
				<?php if (!empty($link['url'])) : ?>
					<<?php echo esc_html($tag); ?> class="deensimc-scroll-text">
						<a
							class="deensimc-scroll-text"
							<?php $this->print_render_attribute_string($link_key); ?>>
							<?php echo esc_html($text['deensimc_repeater_text']); ?>
						</a>
					</<?php echo esc_html($tag); ?>>
				<?php else : ?>
					<<?php echo esc_html($tag); ?> class="deensimc-scroll-text">
						<?php echo esc_html($text['deensimc_repeater_text']); ?>
					</<?php echo esc_html($tag); ?>>
				<?php endif; ?>
			</div>
		<?php
		}
	}

	/**
	 * Renders text marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$texts = $settings['deensimc_repeater_text_main'];
		$tag = self::validate_html_tag($settings['deensimc_text_marquee_tag']);

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
		// icon rotation 
		if (isset($settings['deensimc_icon_animation']) && $settings['deensimc_icon_animation'] === 'yes') {
			$conditional_class[] = 'deensimc-icon-rotate';

			if (isset($settings['deensimc_icon_rotation_direction']) && $settings['deensimc_icon_rotation_direction'] !== 'clockwise') {
				$conditional_class[] = 'deensimc-icon-rotate-ccw';
			}

			$speed_val = $settings['deensimc_icon_rotation_speed'];
			$duration  = $speed_val ? 20 / $speed_val : 0;
			$speed = '--icon-speed:' . round($duration, 2) . 's;';
		}

		?>
		<div class="deensimc-marquee-main-container deensimc-text-marquee
		<?php
		echo esc_attr(implode(' ', $conditional_class));
		?>"
			data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>"
			<?php echo isset($speed) && $speed ? 'style="' . esc_attr($speed) . '"' : ''; ?>>
			<div class="deensimc-marquee-track-wrapper">
				<div class="deensimc-marquee-track">
					<?php $this->render_marquee_texts($texts, $is_vertical, $tag, 'track-1') ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_marquee_texts($texts, $is_vertical, $tag, 'track-2') ?>
				</div>
			</div>
		</div>
<?php
	}
}

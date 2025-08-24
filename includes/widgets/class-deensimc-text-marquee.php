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

	use Textmarquee_Content_Text_Repeater;
	use Deensimc_Marquee_Controls;
	use Textmarquee_Style_Text_Contents;
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
		return 'https://marqueeaddons.com/how-to-use-the-advanced-text-marquee-widget-in-elementor/';
	}

	protected function register_controls(): void
	{

		$this->content_text_repeater();
		$this->register_marquee_control('deensimc_text_marquee_options',);

		$this->style_text_contents();
		$this->register_style_edge_shadow('deensimc_text_marquee_edge_shadow');
	}

	/**
	 * Renders each text item in the marquee, including an optional icon and text content.
	 *
	 * @param array $settings Widget settings containing the text and icon data.
	 */
	protected function render_marquee_texts($texts, $is_vertical)
	{
		$texts_count = count($texts);
		$min_item = $is_vertical ? 12 : 6;
		if ($texts_count < $min_item) {
			$needed = $min_item - $texts_count;
			for ($i = 0; $i < $needed; $i++) {
				$texts[] = $texts[$i % $texts_count];
			}
		}
		foreach ($texts as $text) {
?>
			<div class="deensimc-text-wrapper">
				<?php Icons_Manager::render_icon($text['deensimc_repeater_text_icon'], ['aria-hidden' => 'true']); ?>
				<p class="deensimc-scroll-text">
					<?php
					echo esc_html($text['deensimc_repeater_text']);
					?>
				</p>
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
		<div class="deensimc-marquee-main-container deensimc-text-marquee <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
			<div class="deensimc-marquee-track-wrapper">
				<div class="deensimc-marquee-track">
					<?php $this->render_marquee_texts($texts, $is_vertical) ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_marquee_texts($texts, $is_vertical) ?>
				</div>
			</div>
		</div>
<?php
	}
}

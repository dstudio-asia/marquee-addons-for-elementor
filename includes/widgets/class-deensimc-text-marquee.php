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
	use Deensimc_Promotional_Banner;

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

	protected function register_controls(): void
	{

		$this->content_text_repeater();
		$this->register_marquee_control('deensimc_text_marquee_options');

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
		$required = $is_vertical ? 12 : 6;
		$count    = count($texts);
		if ( $count > 0 && $count < $required ) {
			$original = $texts;
			// Duplicate full batches until we have at least $required
			while ( count( $texts ) < $required ) {
				foreach ( $original as $text ) {
					$dup = $text;
					$dup['_is_dup'] = true;
					$texts[] = $dup;
				}
			}
		}
		foreach ($texts as $text) {
			$is_dup = !empty($text['_is_dup']);

		?>
			<div class="deensimc-text-wrapper" aria-hidden="<?php echo esc_attr ( $is_dup ? 'true': 'false' ) ?>" >
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

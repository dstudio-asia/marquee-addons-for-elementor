<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Testimonial_Marquee
 * Widget for displaying a testimonial marquee
 */

class Deensimc_Testimonial_Marquee extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Testimonial_Marquee_Helper_Methods;
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
	 * Renders testimonial marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

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
					<?php $this->render_testimonial($settings, false) ?>
				</ul>
				<ul aria-hidden="true" class="deensimc-marquee-track">
					<?php $this->render_testimonial($settings, true) ?>
				</ul>
			</div>
		</div>
<?php
	}
}
?>
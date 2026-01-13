<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;

/**
 * Class Deensimc_Video_Marquee
 * Widget for displaying a video marquee
 */

class Deensimc_Video_Marquee extends Widget_Base
{
	use Deensimc_Promotional_Banner;
	use Deensimc_Video_Marquee_Helper_Methods;
	use Deensimc_Videomarquee_Content_Url_Fields;
	use Deensimc_Videomarquee_Content_Video_Options;
	use Deensimc_Videomarquee_Content_Youtube_Vimeo_Options;
	use Deensimc_Videomarquee_Content_Hosted_Options;
	use Deensimc_Videomarquee_Content_Image_Overlay;
	use Deensimc_Marquee_Controls;
	use Deensimc_Marquee_Gap_Controls;
	use Deensimc_Videomarquee_Style_Contents;
	use Deensimc_Videomarquee_Style_Play_Icon;
	use Deensimc_Style_Edge_Shadow;



	public function get_style_depends()
	{
		return ['deensimc-video-marquee-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-video-marquee-script'];
	}

	public function get_name()
	{
		return 'deensimc-video-marquee';
	}

	public function get_title()
	{
		return esc_html__('Video Marquee',  'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'deensimc-video-marquee-icon eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['video', 'slide', 'deen', 'slider'];
	}

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-video-marquee-widget-in-elementor/';
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'deensimc_content_section',
			[
				'label' => esc_html__('Videos',  'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$videos_repeater = new Repeater();

		$this->content_url_fields($videos_repeater);
		$this->content_video_optoins($videos_repeater);
		$this->content_youtube_vimeo_options($videos_repeater);
		$this->content_hosted_options($videos_repeater);
		$this->content_image_overlay($videos_repeater);

		$this->add_control(
			'deensimc_video_list',
			[
				'label' => esc_html__('Video List',  'marquee-addons-for-elementor'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $videos_repeater->get_controls(),
				'default' => [
					[
						'deensimc_video_type' => 'youtube',
					],
					[
						'deensimc_video_type' => 'vimeo',
					],
				],
				'title_field' => '{{{ deensimc_video_type }}}',
			]
		);

		$this->add_control(
			'deensimc_video_list_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<strong>⚠️ Note:</strong> For best performance, keep the video list under <strong>5 items</strong>.',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		$this->add_responsive_control(
			'deensimc_video_marquee_horizontal_align',
			[
				'label' => esc_html__('Alignment', 'marquee-addons-for-elementor'),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors_dictionary' => [
					'left' => 'margin-left: 0; margin-right: auto;',
					'center' => 'margin-left: auto; margin-right: auto;',
					'right' => 'margin-left: auto; margin-right: 0;',
				],
				'selectors' => [
					'{{WRAPPER}} .deensimc-video-marquee .deensimc-marquee-track-wrapper' => '{{VALUE}};',
				],
				'condition' => [
					'deensimc_marquee_vertical_orientation' => 'yes',
				],
			]
		);

		$this->register_gap_control();


		$this->end_controls_section();

		$this->register_marquee_control('deensimc_video_marquee_options');
		$this->style_contents();
		$this->style_play_icon();
		$this->register_style_edge_shadow('deensimc_video_marquee_edge_shadow');
	}



	/**
	 * Renders a video marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$video_list = $settings['deensimc_video_list'];

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

		if (!empty($video_list)) {
?>
			<div class="deensimc-marquee-main-container deensimc-video-marquee <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
				<div class="deensimc-marquee-track-wrapper">
					<div class="deensimc-marquee-track">
						<?php $this->render_video_item($video_list); ?>
					</div>
					<div aria-hidden="true" class="deensimc-marquee-track">
						<?php $this->render_video_item($video_list); ?>
					</div>
				</div>
			</div>
<?php
		}
	}
}
?>
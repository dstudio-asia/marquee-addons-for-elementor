<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;


/**
 * Class deensimc_Infinite_Text_Rotation
 * Widget for displaying a text marquee
 */

class Deensimc_Animated_Word_Roller extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Animated_Word_Roller_Content_Additional_Options;
	use Animated_Word_Roller_Content_Text_Repeater;
	use Animated_Word_Roller_Style_Text_Contents;

	public function get_style_depends()
	{
		return [
			'deensimc-animated-word-roller-style'
		];
	}

	public function get_script_depends()
	{
		return [
			'deensimc-animated-word-roller'
		];
	}

	public function get_name()
	{
		return 'deensimc-animated-word-roller';
	}

	public function get_title()
	{
		return esc_html__('Animated Word Roller', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'deensimc-word-roller-icon eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['animated word roller', 'animated word', 'animated', 'word', 'smooth', 'roller', 'rotation', 'scroll', 'marquee'];
	}

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-animated-word-roller-widget-in-elementor/';
	}

	protected function register_controls(): void
	{

		$this->content_text_repeater();
		$this->content_additional_options();
		$this->style_contents();
	}

	/**
	 * Renders text marquee widget.
	 * @return void
	 */
	protected function render()
	{
		$settings       = $this->get_settings_for_display();
		$total_text     = ! empty($settings['deensimc_repeater_text_main']) ? count($settings['deensimc_repeater_text_main']) : 0;
		$rotation_delay = ! empty($settings['deensimc_infinite_text_rotation_delay']) ? $settings['deensimc_infinite_text_rotation_delay'] : 1;
		$visible_word   = ! empty($settings['deensimc_infinite_text_rotation_visible_word']) ? $settings['deensimc_infinite_text_rotation_visible_word'] : 5;
		$html_tag       = isset($settings['deensimc_infinite_text_rotation_html_tag']) ? $settings['deensimc_infinite_text_rotation_html_tag'] : 'h2';
?>
		<div class="infinite-rotation-main-wrapper">
			<<?php echo esc_attr($html_tag); ?> class="deensimc-infinite-rotation-container">
				<?php if (! empty($settings['deensimc_infinite_text_rotation_widget_title'])) : ?>
					<span class="deensimc-fixed-text deensimc-infinite-rotation-heading">
						<?php echo esc_html($settings['deensimc_infinite_text_rotation_widget_title']); ?>
					</span>
				<?php endif; ?>

				<div class="deensimc-text-rotator-container">
					<div class="deensimc-vertical-scroll-track"
						data-total-text="<?php echo esc_attr($total_text); ?>"
						data-rotation-delay="<?php echo esc_attr($rotation_delay); ?>"
						data-visible-word="<?php echo esc_attr($visible_word); ?>">

						<?php
						if (! empty($settings['deensimc_repeater_text_main'])) :
							foreach ($settings['deensimc_repeater_text_main'] as $item) :
						?>
								<div class="deensimc-rotate-text">
									<div class="deensimc-rotating-word">
										<?php echo esc_html($item['deensimc_infinite_text_rotation_text']); ?>
									</div>
									<?php
									if (! empty($item['deensimc_infinite_text_rotation_icon']['value'])) {
										Icons_Manager::render_icon(
											$item['deensimc_infinite_text_rotation_icon'],
											['aria-hidden' => 'true']
										);
									}
									?>
								</div>
						<?php
							endforeach;
						endif;
						?>

					</div>
				</div>
			</<?php echo esc_attr($html_tag); ?>>
		</div>
	<?php
	}


	/**
	 * Renders dynamic text marquee contents in Elementor.
	 * @return void
	 */
	protected function content_template()
	{
	?>
		<#
			let total_text=settings.deensimc_repeater_text_main && settings.deensimc_repeater_text_main.length ? settings.deensimc_repeater_text_main.length : 0;
			let rotation_delay=settings.deensimc_infinite_text_rotation_delay || 1;
			let visible_word=settings.deensimc_infinite_text_rotation_visible_word || 5;
			let html_tag=settings.deensimc_infinite_text_rotation_html_tag || 'h2' ;
			#>
			<div class="infinite-rotation-main-wrapper">
				<{{ html_tag }} class="deensimc-infinite-rotation-container">
					<# if ( settings.deensimc_infinite_text_rotation_widget_title ) { #>
						<span class="deensimc-fixed-text deensimc-infinite-rotation-heading">
							{{ settings.deensimc_infinite_text_rotation_widget_title }}
						</span>
						<# } #>

							<div class="deensimc-text-rotator-container">
								<div class="deensimc-vertical-scroll-track"
									data-total-text="{{ total_text }}"
									data-rotation-delay="{{ rotation_delay }}"
									data-visible-word="{{ visible_word }}">

									<# if ( settings.deensimc_repeater_text_main && settings.deensimc_repeater_text_main.length ) { #>
										<# _.each( settings.deensimc_repeater_text_main, function( item ) { #>
											<div class="deensimc-rotate-text">
												<div class="deensimc-rotating-word">
													{{ item.deensimc_infinite_text_rotation_text }}
												</div>
												<# if ( item.deensimc_infinite_text_rotation_icon && item.deensimc_infinite_text_rotation_icon.value ) { #>
													{{{ elementor.helpers.renderIcon(
										view,
										item.deensimc_infinite_text_rotation_icon,
										{ 'aria-hidden': true },
										'i',
										'object'
									).value }}}
													<# } #>
											</div>
											<# }); #>
												<# } #>
								</div>
							</div>
				</{{ html_tag }}>
			</div>
	<?php
	}
}

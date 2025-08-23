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
	use Textmarquee_Content_Additional_Options;
	use Textmarquee_Style_Text_Contents;
	use Textmarquee_Style_Edge_shadow;

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

		$this->content_additional_options();

		$this->style_text_contents();
		$this->style_edge_shadow();
	}

	/**
	 * Renders each text item in the marquee, including an optional icon and text content.
	 *
	 * @param array $settings Widget settings containing the text and icon data.
	 */
	protected function render_marquee_texts($settings)
	{
		$is_vertical = 'yes' === $settings['deensimc_slide_position'];
		$texts = $settings['deensimc_repeater_text_main'];
		$texts_count = count($texts);
		$min_item = 10;
		if ($is_vertical && $texts_count < $min_item) {
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
		$marquee_orientation = $settings['deensimc_slide_position'] === 'yes' ? 'vertical' : 'horizontal';
		$slide_direction_class = $settings['deensimc_slide_direction'] === 'yes' ? ' deensimc-marquee-reverse' : '';
		$pause_on_hover = $settings['deensimc_pause_on_hover_switch'];
		$animation_speed = $settings['deensimc_text_animation_speed'];
		$marquee_classes = $marquee_orientation . " " . $slide_direction_class;
		$show_shadow = $settings['deensimc_text_marquee_show_edge_shadow_switch'] === 'yes' ? 'deensimc-shadow' : '';
		?>
		<div class="deensimc-wrapper deensimc-wrapper-<?php echo esc_attr($marquee_orientation); ?> deensimc-text-marquee">
			<div class="deensimc-marquee <?php echo esc_attr($show_shadow); ?> deensimc-marquee-<?php echo esc_attr($marquee_classes); ?>" data-pause-on-hover="<?php echo esc_attr($pause_on_hover) ?>" data-animation-speed="<?php echo esc_attr($animation_speed) ?>">
				<div class="deensimc-marquee-group">
					<?php $this->render_marquee_texts($settings) ?>
				</div>
				<div aria-hidden="true" class="deensimc-marquee-group">
					<?php $this->render_marquee_texts($settings) ?>
				</div>
			</div>
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
			let marquee_orientation=settings.deensimc_slide_position==='yes' ? 'vertical' : 'horizontal' ;
			let slide_direction_class=settings.deensimc_slide_direction==='yes' ? ' deensimc-marquee-reverse' : '' ;
			let pause_on_hover=settings.deensimc_pause_on_hover_switch;
			let animation_speed=settings.deensimc_text_animation_speed;
			let marquee_classes=marquee_orientation + " " + slide_direction_class;
			let show_shadow=settings.deensimc_text_marquee_show_edge_shadow_switch==='yes' ? 'deensimc-shadow' : '' ;

			let texts=[...settings.deensimc_repeater_text_main];
			let isVerticalSlide=settings.deensimc_slide_position==='yes' ;
			let texts_count=texts.length;
			let min_item=10;

			if (isVerticalSlide && texts_count> 0 && texts_count < min_item) {
				let needed=min_item - texts_count;
				for (let i=0; i < needed; i++) {
				texts.push(texts[i % texts_count]);
				}
				}
				#>
				<div class="deensimc-wrapper deensimc-wrapper-{{{ marquee_orientation }}} deensimc-text-marquee">
					<div class="deensimc-marquee {{{ show_shadow }}} deensimc-marquee-{{{ marquee_classes }}}" data-pause-on-hover="{{{ pause_on_hover }}}" data-animation-speed="{{{ animation_speed }}}">
						<div class="deensimc-marquee-group">
							<# _.each(texts, function(text) { #>
								<div class="deensimc-text-wrapper">
									<# if ( text.deensimc_repeater_text_icon ) { #>
										{{{ elementor.helpers.renderIcon( view, text.deensimc_repeater_text_icon, { 'aria-hidden': true }, 'i' , 'object' ).value }}}
										<# } #>
											<p class="deensimc-scroll-text">
												{{{ text.deensimc_repeater_text }}}
											</p>
								</div>
								<# }); #>
						</div>

						<div aria-hidden="true" class="deensimc-marquee-group">
							<# _.each(texts, function(text) { #>
								<div class="deensimc-text-wrapper">
									<# if ( text.deensimc_repeater_text_icon ) { #>
										{{{ elementor.helpers.renderIcon( view, text.deensimc_repeater_text_icon, { 'aria-hidden': true }, 'i' , 'object' ).value }}}
										<# } #>
											<p class="deensimc-scroll-text">
												{{{ text.deensimc_repeater_text }}}
											</p>
								</div>
								<# }); #>
						</div>
					</div>
				</div>
		<?php
	}
}
		?>
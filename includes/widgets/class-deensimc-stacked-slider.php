<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;

/**
 * Class Stacked Slider
 */

class Deensimc_Stacked_Slider extends Widget_Base
{
	use Deensimc_Promotional_Banner;

	use Stackedslider_Contents_Primary;
	use Stackedslider_Contents_Advance;
	use Stackedslider_Style_Box;
	use Stackedslider_Style_Contents;
	use Stackedslider_Style_Image;
	use Stackedslider_Style_Dots;

	public function get_style_depends()
	{
		return ['deensimc-swiper-bundle-min-style', 'deensimc-swiper-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-stacked-slider-script'];
	}

	public function get_name()
	{
		return 'deensimc-stacked-slider';
	}

	public function get_title()
	{
		return esc_html__('Stacked Slider', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-slider-album eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['slider', 'staked', 'slide', 'marquee'];
	}

	public function get_custom_help_url(): string
	{
		return 'https://marqueeaddons.com/how-to-use-the-stacked-slider-widget-in-elementor/';
	}

	protected function register_controls()
	{
		$this->contents_primary();
		$this->contents_advance();
		$this->style_box();
		$this->style_contents();
		$this->style_image();
		$this->style_dots();
	}

	/**
	 * Renders the contents for the stacked slider.
	 *
	 * This function handles the rendering of the slider's title, description and button text if they are set in the widget's settings.
	 * The title is displayed with the specified HTML tag (e.g., h1, h2), and the description is shown as a paragraph.
	 *
	 * @param array $settings The array containing the widget's settings, including the title, description, button text and associated tags.
	 */
	protected function render_stacked_contents($settings)
	{
?>
		<?php
		// Slider title
		if ($settings['deensimc_content_title'] !== '') {
		?>
			<div class="deensimc-slider-heading">
				<?php printf('<%1$s class="deensimc-content-title"> %2$s </%1$s>', esc_html($settings['deensimc_content_title_tags']), esc_html($settings['deensimc_content_title'])); ?>
			</div>
		<?php
		}
		?>

		<?php
		// Slider description
		if ($settings['deensimc_content_description'] !== '') {
		?>
			<div class="deensimc-slider-des">
				<p class="deensimc-content-description">
					<?php echo esc_html($settings['deensimc_content_description']) ?>
				</p>
			</div>
		<?php
		}
		?>

		<?php
		// Slider button text
		if ($settings['deensimc_content_button_text'] !== '') {
			if ( ! empty( $settings['deensimc_content_button_link']['url'] ) ) {
				$this->add_link_attributes( 'deensimc_content_button_link', $settings['deensimc_content_button_link'] );
			}
		?>
			<div class="deensimc-button-content-wraper">
				<a <?php $this->print_render_attribute_string('deensimc_content_button_link'); ?>>
					<button class="deensimc-content-btn">
						<?php echo esc_html($settings['deensimc_content_button_text']) ?>
					</button>
				</a>
			</div>
			<?php
		}
	}

	/**
	 * Renders the images for the stacked slider.
	 *
	 * This function loops through the uploaded gallery images provided in the settings and renders each one as a slide. 
	 * If no images are provided, it renders three placeholder images as fallback slides.
	 *
	 * @param array $settings The array containing the widget's settings, including the gallery images.
	 */
	protected function render_stacked_slide_images($settings)
	{

		if (!empty($settings['deensimc_upload_gallery'])) {
			foreach ($settings['deensimc_upload_gallery'] as $image) {
			?>
				<div class="swiper-slide">
					<img src="<?php echo esc_url($image['url']) ?>" />
				</div>
			<?php
			}
		} else {
			?>
			<div class="swiper-slide">
				<img src="<?php echo esc_url(Utils::get_placeholder_image_src()) ?>" />
			</div>
			<div class="swiper-slide">
				<img src="<?php echo esc_url(Utils::get_placeholder_image_src()) ?>" />
			</div>
			<div class="swiper-slide">
				<img src="<?php echo esc_url(Utils::get_placeholder_image_src()) ?>" />
			</div>
		<?php
		}
	}

	/**
	 * Renders stacked slider widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Device specific classes
		$devices = [];
		if (isset($settings['deensimc_image_postion_xy'])) {
			$devices[] = esc_attr($settings['deensimc_image_postion_xy']);
		}
		if (isset($settings['deensimc_image_postion_xy_laptop'])) {
			$devices[] = esc_attr($settings['deensimc_image_postion_xy_laptop'] . '-laptop');
		}
		if (isset($settings['deensimc_image_postion_xy_tablet'])) {
			$devices[] = esc_attr($settings['deensimc_image_postion_xy_tablet'] . '-tab');
		}
		if (isset($settings['deensimc_image_postion_xy_mobile'])) {
			$devices[] = esc_attr($settings['deensimc_image_postion_xy_mobile'] . '-mobile');
		}
		if (isset($settings['deensimc_image_postion_xy_mobile_extra'])) {
			$devices[] = esc_attr($settings['deensimc_image_postion_xy_mobile_extra'] . '-mobile-extra');
		}

		// Combine all device classes into a single string
		$devices_class = implode(' ', $devices);

		$content_class = 'deensimc-content';
		if (
			trim($settings['deensimc_content_title']) === '' &&
			trim($settings['deensimc_content_description']) === '' &&
			trim($settings['deensimc_content_button_text']) === ''
		) {
			$content_class = 'deensimc-no-contents';
		}


		?>
		<div class="deensimc-stacked-container">
			<div class="deensimc-image-slider-main <?php echo esc_attr($content_class); ?> <?php echo esc_attr($devices_class); ?>" data-autoplay="<?php echo esc_attr($settings['deensimc_stacked_auto_play']) ?>"
				data-animation-speed="<?php echo esc_attr($settings['deensimc_stacked_animation_speed']) ?>">
				<!-- Rendering slider content  -->
				<?php
				if ($content_class !== 'deensimc-no-contents') {
				?>
					<div class="deensimc-slider-content">
						<?php $this->render_stacked_contents($settings) ?>
					</div>
				<?php
				}
				?>
				<!-- Rendering slider images -->
				<div class="deensimc-slider-media-wrapper">
					<div class="deensimc-slider-media deensimc-ds-swiper swiper">
						<div class="deensimc-slider-img swiper-wrapper">
							<?php $this->render_stacked_slide_images($settings) ?>
						</div>
						<?php
						if ($settings['deensimc_show_advance_tab_dot'] === 'yes') {
						?>
							<div class="deensimc-swiper-pagination"></div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	/**
	 * Renders dynamic stacked slider contents in Elementor.
	 * @return void
	 */
	protected function content_template()
	{
	?>
		<#
			let devices=[
			settings.deensimc_image_postion_xy,
			settings.deensimc_image_postion_xy_laptop ? settings.deensimc_image_postion_xy_laptop + '-laptop' : '' ,
			settings.deensimc_image_postion_xy_tablet ? settings.deensimc_image_postion_xy_tablet + '-tab' : '' ,
			settings.deensimc_image_postion_xy_mobile ? settings.deensimc_image_postion_xy_mobile + '-mobile' : '' ,
			settings.deensimc_image_postion_xy_mobile_extra ? settings.deensimc_image_postion_xy_mobile_extra + '-mobile-extra' : ''
			].join(' ').trim();

		let title = settings.deensimc_content_title.trim();
		let description = settings.deensimc_content_description.trim();
		let buttonText = settings.deensimc_content_button_text.trim();
		let noContent = ' deensimc-contents';

			if( title==='' && description==='' && buttonText==='' ) {
			noContent='deensimc-no-contents' ;
			}


			#>
			<div class="deensimc-stacked-container">
				<div class="deensimc-image-slider-main {{ noContent }} {{ devices }}" data-autoplay="{{ settings.deensimc_stacked_auto_play }}"
					data-animation-speed="{{ settings.deensimc_stacked_animation_speed }}">
					<div class="deensimc-slider-content">
						<div class="deensimc-slider-heading">
							<#
								if ( settings.deensimc_content_title ) {
								let tag=settings.deensimc_content_title_tags;
								#>
								<{{tag}} class="deensimc-content-title">{{{ settings.deensimc_content_title }}}</{{tag}}>
								<#
									}
									#>
						</div>
						<#
							if ( settings.deensimc_content_description ) {
							#>
							<div class="deensimc-slider-des">
								<p class="deensimc-content-description">{{{ settings.deensimc_content_description }}}</p>
							</div>
							<#
								}
								#>
								<#
									if ( settings.deensimc_content_button_text ) {
									#>
									<div class="deensimc-button-content-wraper">
										<a href="{{ settings.deensimc_content_button_link.url }}">
											<button class="deensimc-content-btn">
												{{{ settings.deensimc_content_button_text }}}
											</button>
										</a>
									</div>
									<#
										}
										#>
					</div>
					<div class="deensimc-slider-media-wrapper">
						<div class="deensimc-slider-media deensimc-ds-swiper swiper">
							<div class="deensimc-slider-img swiper-wrapper">
								<#
									if(settings.deensimc_upload_gallery.length) {
									_.each( settings.deensimc_upload_gallery, function( image ) {
									#>
									<div class="swiper-slide">
										<img src="{{ image.url }}">
									</div>
									<#
										})
										}else {
										#>
										<div class="swiper-slide">
											<img src="<?php echo esc_url(Utils::get_placeholder_image_src()); ?>" />
										</div>
										<div class="swiper-slide">
											<img src="<?php echo esc_url(Utils::get_placeholder_image_src()); ?>" />
										</div>
										<div class="swiper-slide">
											<img src="<?php echo esc_url(Utils::get_placeholder_image_src()); ?>" />
										</div>
										<#
											}
											#>
							</div>
							<#
								if( 'yes'===settings.deensimc_show_advance_tab_dot ) {
								#>
								<div class="deensimc-swiper-pagination"></div>
								<#
									}
									#>
						</div>
					</div>
				</div>
			</div>
	<?php
	}
}
	?>
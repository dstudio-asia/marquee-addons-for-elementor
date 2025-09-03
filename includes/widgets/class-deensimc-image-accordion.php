<?php

if (! defined('ABSPATH')) {
	exit;
}

// Elementor Classes
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Image_Accordion
 * Widget for displaying an image accordion.
 */
class Deensimc_Image_Accordion extends Widget_Base
{

	use ImageAccordion_Contents;
	use ImageAccordion_Styles;

	public function get_name()
	{
		return 'deensimc-image-accordion';
	}

	public function get_title()
	{
		return esc_html__('Image Accordion', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-image-bold eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['image', 'image-accordion', 'accordion'];
	}

	public function get_style_depends()
	{
		return ['deensimc-accordion-style'];
	}

	public function get_script_depends()
	{
		return ['deensimc-image-accordion-script'];
	}

	protected function register_controls()
	{
		$this->content_controls();
		$this->style_controls();
	}

	/**
	 * Renders image accordion widget.
	 * @return void
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$devices = [];
		if (isset($settings['deensimc_images_title_rotating'])) {
			$devices[] = esc_attr($settings['deensimc_images_title_rotating']);
		}
		if (isset($settings['deensimc_images_title_rotating_laptop'])) {
			$devices[] = esc_attr($settings['deensimc_images_title_rotating_laptop'] . '-laptop');
		}
		if (isset($settings['deensimc_images_title_rotating_tablet'])) {
			$devices[] = esc_attr($settings['deensimc_images_title_rotating_tablet'] . '-tab');
		}
		if (isset($settings['deensimc_images_title_rotating_mobile'])) {
			$devices[] = esc_attr($settings['deensimc_images_title_rotating_mobile'] . '-mobile');
		}
		if (isset($settings['deensimc_images_title_rotating_mobile_extra'])) {
			$devices[] = esc_attr($settings['deensimc_images_title_rotating_mobile_extra'] . '-mobile-extra');
		}

		$devices_class = implode(' ', $devices);
?>
		<div class="deensimc-image-panel">
			<div class="deensimc-panels">
				<?php
				$deen_accordion_behaviour = $settings['deensimc_bg_image_active_behaviour'] === 'click' ? 'click' : 'hover';
				if ($settings['deensimc_bg_image_repeater']) {
					foreach ($settings['deensimc_bg_image_repeater'] as $images) {
				?>
						<div
							data-behaviour="<?php echo esc_attr($deen_accordion_behaviour); ?>"
							class="deensimc-panel deensimc-panel-main ">
							<p class="<?php echo esc_attr($devices_class); ?> deensimc-panel-default-title">
								<?php echo esc_html($images['deensimc_bg_image_title']) ?>
							</p>
							<div class="deensimc-panel-content">
								<h2> <?php echo esc_html($images['deensimc_bg_image_title']) ?> </h2>
								<div class="deensimc-acc-description">
									<?php echo wp_kses_post($images['deensimc_bg_image_description'] ?? ''); ?>
								</div>
								<?php if (!empty($images['deensimc_image_acc_cta_switch']) && $images['deensimc_image_acc_cta_switch'] === 'yes') : ?>
									<?php
									$cta_text     = $images['deensimc_image_acc_cta_text'] ?? '';
									$cta_url      = !empty($images['deensimc_image_acc_cta_url']['url']) ? $images['deensimc_image_acc_cta_url']['url'] : '#';
									$cta_icon     = $images['deensimc_image_acc_cta_icon'] ?? [];
									$icon_pos     = $images['deensimc_image_acc_cta_icon_position'] ?? 'left';

									$target       = !empty($images['deensimc_image_acc_cta_url']['is_external']) ? ' target="_blank"' : '';
									$nofollow     = !empty($images['deensimc_image_acc_cta_url']['nofollow']) ? ' rel="nofollow"' : '';

									$icon_html    = '';
									if (!empty($cta_icon['value'])) {
										ob_start();
										\Elementor\Icons_Manager::render_icon(
											$cta_icon,
											['aria-hidden' => 'true']
										);
										$icon_html = ob_get_clean();
									}
									?>
									<a href="<?php echo esc_url($cta_url); ?>" class="deensimc-acc-cta" <?php echo $target . $nofollow; ?>>
										<?php if ($icon_pos === 'left' && $icon_html) : ?>
											<span class="deensimc-acc-cta-icon deensimc-acc-cta-icon-left"><?php echo $icon_html; ?></span>
										<?php endif; ?>
										<span class="deensimc-acc-cta-text"><?php echo esc_html($cta_text); ?></span>
										<?php if ($icon_pos === 'right' && $icon_html) : ?>
											<span class="deensimc-acc-cta-icon deensimc-acc-cta-icon-right"><?php echo $icon_html; ?></span>
										<?php endif; ?>
									</a>
								<?php endif; ?>
							</div>
							<img src="<?php echo esc_url($images['deensimc_bg_image']['url']) ?>" alt="background image" class="deensimc-acc-bg-img">
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
<?php
	}
}

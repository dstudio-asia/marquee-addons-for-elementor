<?php

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Image;

if (!defined('ABSPATH')) {
	exit;
}

class Deensimc_Image_Hotspot extends Widget_Image
{
	use Deensimc_Image_Controls;
	use Deensimc_Hotspots_Controls;
	use Deensimc_Tooltip_Controls;
	use Deensimc_Style_Hotspot_Controls;
	use Deensimc_Style_Tooltip_Controls;

	public function get_name()
	{
		return 'deensimc-image-hotspot';
	}

	public function get_title()
	{
		return esc_html__('Image Hotspot', 'marquee-addons-for-elementor');
	}

	public function get_icon()
	{
		return 'eicon-image-hotspot eicon-deensimc';
	}

	public function get_categories()
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords()
	{
		return ['image', 'tooltip', 'CTA', 'dot', 'marquee', 'hotspot'];
	}

	public function get_style_depends(): array
	{
		return ['deensimc-image-hotspot-style'];
	}

	public function get_script_depends(): array
	{
		return ['deensimc-image-hotspot-script'];
	}

	protected function register_controls()
	{
		$this->register_deensimc_image_section_controls();
		$this->register_deensimc_hotspots_section_controls();
		$this->register_deensimc_tooltip_section_controls();
		$this->register_deensimc_style_hotspot_section_controls();
		$this->register_deensimc_style_tooltip_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if (empty($settings['image']['url'])) {
			return;
		}

		$is_tooltip_direction_animation = 'deensimc-image-hotspot--slide-direction' === $settings['deensimc_tooltip_animation'] || 'deensimc-image-hotspot--fade-direction' === $settings['deensimc_tooltip_animation'];
		$show_tooltip = 'none' === $settings['deensimc_tooltip_trigger'];
		$sequenced_animation_class = 'yes' === $settings['deensimc_hotspot_sequenced_animation'] ? 'deensimc-image-hotspot--sequenced' : '';

		// Main Image
		Group_Control_Image_Size::print_attachment_image_html($settings, 'image', 'image');

		// Hotspot
		foreach ($settings['deensimc_hotspot'] as $key => $hotspot) :
			$is_circle = !$hotspot['deensimc_hotspot_label'] && !$hotspot['deensimc_hotspot_icon']['value'];
			$is_only_icon = !$hotspot['deensimc_hotspot_label'] && $hotspot['deensimc_hotspot_icon']['value'];
			$hotspot_position_x = (isset($hotspot['deensimc_hotspot_offset_x']['unit']) && '%' === $hotspot['deensimc_hotspot_offset_x']['unit']) ? 'deensimc-image-hotspot--position-' . $hotspot['deensimc_hotspot_horizontal'] : '';
			$hotspot_position_y = (isset($hotspot['deensimc_hotspot_offset_y']['unit']) && '%' === $hotspot['deensimc_hotspot_offset_y']['unit']) ? 'deensimc-image-hotspot--position-' . $hotspot['deensimc_hotspot_vertical'] : '';
			$is_hotspot_link = !empty($hotspot['deensimc_hotspot_link']['url']);
			$hotspot_element_tag = $is_hotspot_link ? 'a' : 'div';

			// hotspot attributes
			$hotspot_repeater_setting_key = $this->get_repeater_setting_key('hotspot', 'deensimc_hotspot', $key);
			$this->add_render_attribute(
				$hotspot_repeater_setting_key,
				[
					'class' => [
						'deensimc-image-hotspot',
						'elementor-repeater-item-' . $hotspot['_id'],
						$sequenced_animation_class,
						$hotspot_position_x,
						$hotspot_position_y,
						$is_hotspot_link ? 'deensimc-image-hotspot--link' : '',
						('click' === $settings['deensimc_tooltip_trigger'] && $is_hotspot_link) ? 'deensimc-image-hotspot--no-tooltip' : '',
					],
				]
			);
			if ($is_circle) {
				$this->add_render_attribute($hotspot_repeater_setting_key, 'class', 'deensimc-image-hotspot--circle');
			}
			if ($is_only_icon) {
				$this->add_render_attribute($hotspot_repeater_setting_key, 'class', 'deensimc-image-hotspot--icon');
			}

			if ($is_hotspot_link) {
				$this->add_link_attributes($hotspot_repeater_setting_key, $hotspot['deensimc_hotspot_link']);
			}

			// hotspot trigger attributes
			$trigger_repeater_setting_key = $this->get_repeater_setting_key('trigger', 'deensimc_hotspot', $key);
			$this->add_render_attribute(
				$trigger_repeater_setting_key,
				[
					'class' => [
						'deensimc-image-hotspot__button',
						$settings['deensimc_hotspot_animation'],
					],
				]
			);

			//direction mask attributes
			$direction_mask_repeater_setting_key = $this->get_repeater_setting_key('deensimc-image-hotspot__direction-mask', 'deensimc_hotspot', $key);
			$this->add_render_attribute(
				$direction_mask_repeater_setting_key,
				[
					'class' => [
						'deensimc-image-hotspot__direction-mask',
						($is_tooltip_direction_animation) ? 'deensimc-image-hotspot--tooltip-position' : '',
					],
				]
			);

			//tooltip attributes
			$tooltip_custom_position = ($is_tooltip_direction_animation && $hotspot['deensimc_hotspot_tooltip_position'] && $hotspot['deensimc_hotspot_position']) ? 'deensimc-image-hotspot--override-tooltip-animation-from-' . $hotspot['deensimc_hotspot_position'] : '';
			$tooltip_repeater_setting_key = $this->get_repeater_setting_key('tooltip', 'deensimc_hotspot', $key);
			$this->add_render_attribute(
				$tooltip_repeater_setting_key,
				[
					'class' => [
						'deensimc-image-hotspot__tooltip',
						($show_tooltip) ? 'deensimc-image-hotspot--show-tooltip' : '',
						(!$is_tooltip_direction_animation) ? 'deensimc-image-hotspot--tooltip-position' : '',
						(!$show_tooltip) ? $settings['deensimc_tooltip_animation'] : '',
						$tooltip_custom_position,
					],
				]
			); ?>

			<<?php Utils::print_validated_html_tag($hotspot_element_tag); ?> <?php $this->print_render_attribute_string($hotspot_repeater_setting_key); ?>>

				<div <?php $this->print_render_attribute_string($trigger_repeater_setting_key); ?>>
					<?php if ($is_circle) : ?>
						<div class="deensimc-image-hotspot__outer-circle"></div>
						<div class="deensimc-image-hotspot__inner-circle"></div>
					<?php else : ?>
						<?php if ($hotspot['deensimc_hotspot_icon']['value']) : ?>
							<div class="deensimc-image-hotspot__icon"><?php Icons_Manager::render_icon($hotspot['deensimc_hotspot_icon']); ?></div>
						<?php endif; ?>
						<?php if ($hotspot['deensimc_hotspot_label']) : ?>
							<div class="deensimc-image-hotspot__label"><?php
																		echo $hotspot['deensimc_hotspot_label']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
																		?></div>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php if ($hotspot['deensimc_hotspot_tooltip_content'] && !('click' === $settings['deensimc_tooltip_trigger'] && $is_hotspot_link)) : ?>
					<?php if ($is_tooltip_direction_animation) : ?>
						<div <?php $this->print_render_attribute_string($direction_mask_repeater_setting_key); ?>>
						<?php endif; ?>
						<div <?php $this->print_render_attribute_string($tooltip_repeater_setting_key); ?>>
							<?php
							echo $hotspot['deensimc_hotspot_tooltip_content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
						<?php if ($is_tooltip_direction_animation) : ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

			</<?php Utils::print_validated_html_tag($hotspot_element_tag); ?>>

		<?php endforeach; ?>

	<?php
	}

	protected function content_template()
	{
	?>
		<#
			const image={
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
			};

			const imageUrl=elementor.imagesManager.getImageUrl(image);

			if (!imageUrl) {
			return;
			}
			#>
			<img src="{{ imageUrl }}" title="" alt="">
			<#
				const isTooltipDirectionAnimation=(settings.deensimc_tooltip_animation==='deensimc-image-hotspot--slide-direction' || settings.deensimc_tooltip_animation==='deensimc-image-hotspot--fade-direction' ) ? true : false;
				const showTooltip=(settings.deensimc_tooltip_trigger==='none' );

				_.each(settings.deensimc_hotspot, (hotspot, index)=> {
				const iconHTML = elementor.helpers.renderIcon(view, hotspot.deensimc_hotspot_icon, {}, 'i', 'object');

				const isCircle = !hotspot.deensimc_hotspot_label && !hotspot.deensimc_hotspot_icon.value;
				const isOnlyIcon = !hotspot.deensimc_hotspot_label && hotspot.deensimc_hotspot_icon.value;
				const hotspotPositionX = '%' === hotspot.deensimc_hotspot_offset_x.unit ? 'deensimc-image-hotspot--position-' + hotspot.deensimc_hotspot_horizontal : '';
				const hotspotPositionY = '%' === hotspot.deensimc_hotspot_offset_y.unit ? 'deensimc-image-hotspot--position-' + hotspot.deensimc_hotspot_vertical : '';
				const hotspotLink = hotspot.deensimc_hotspot_link.url;
				const hotspotElementTag = hotspotLink ? 'a' : 'div';

				// hotspot attributes
				const hotspotRepeaterSettingKey = view.getRepeaterSettingKey('hotspot', 'deensimc_hotspot', index);
				view.addRenderAttribute(hotspotRepeaterSettingKey, {
				'class': [
				'deensimc-image-hotspot',
				'elementor-repeater-item-' + hotspot._id,
				hotspotPositionX,
				hotspotPositionY,
				hotspotLink ? 'deensimc-image-hotspot--link' : '', ,
				]
				});

				if (isCircle) {
				view.addRenderAttribute(hotspotRepeaterSettingKey, 'class', 'deensimc-image-hotspot--circle');
				}

				if (isOnlyIcon) {
				view.addRenderAttribute(hotspotRepeaterSettingKey, 'class', 'deensimc-image-hotspot--icon');
				}

				// hotspot trigger attributes
				const triggerRepeaterSettingKey = view.getRepeaterSettingKey('trigger', 'deensimc_hotspot', index);
				view.addRenderAttribute(triggerRepeaterSettingKey, {
				'class': [
				'deensimc-image-hotspot__button',
				settings.deensimc_hotspot_animation,
				]
				});

				//direction mask attributes
				const directionMaskRepeaterSettingKey = view.getRepeaterSettingKey('deensimc-image-hotspot__direction-mask', 'deensimc_hotspot', index);
				view.addRenderAttribute(directionMaskRepeaterSettingKey, {
				'class': [
				'deensimc-image-hotspot__direction-mask',
				(isTooltipDirectionAnimation) ? 'deensimc-image-hotspot--tooltip-position' : ''
				]
				});

				//tooltip attributes
				const tooltipCustomPosition = (isTooltipDirectionAnimation && hotspot.deensimc_hotspot_tooltip_position && hotspot.deensimc_hotspot_position) ? 'deensimc-image-hotspot--override-tooltip-animation-from-' + hotspot.deensimc_hotspot_position : '';
				const tooltipRepeaterSettingKey = view.getRepeaterSettingKey('tooltip', 'deensimc_hotspot', index);
				view.addRenderAttribute(tooltipRepeaterSettingKey, {
				'class': [
				'deensimc-image-hotspot__tooltip',
				(showTooltip) ? 'deensimc-image-hotspot--show-tooltip' : '',
				(!isTooltipDirectionAnimation) ? 'deensimc-image-hotspot--tooltip-position' : '',
				(!showTooltip) ? settings.deensimc_tooltip_animation : '',
				tooltipCustomPosition
				],
				});

				#>
				<{{{ hotspotElementTag }}} {{{ view.getRenderAttributeString( hotspotRepeaterSettingKey ) }}}>

					<div {{{ view.getRenderAttributeString( triggerRepeaterSettingKey ) }}}>
						<# if ( isCircle ) { #>
							<div class="deensimc-image-hotspot__outer-circle"></div>
							<div class="deensimc-image-hotspot__inner-circle"></div>
							<# } else { #>
								<# if (hotspot.deensimc_hotspot_icon.value){ #>
									<div class="deensimc-image-hotspot__icon">{{{ iconHTML.value }}}</div>
									<# } #>
										<# if ( hotspot.deensimc_hotspot_label ){ #>
											<div class="deensimc-image-hotspot__label">{{{ hotspot.deensimc_hotspot_label }}}</div>
											<# } #>
												<# } #>
					</div>

					<# if( hotspot.deensimc_hotspot_tooltip_content && ! ( 'click'===settings.deensimc_tooltip_trigger && hotspotLink ) ){ #>
						<# if( isTooltipDirectionAnimation ){ #>
							<div {{{ view.getRenderAttributeString( directionMaskRepeaterSettingKey ) }}}>
								<# } #>
									<div {{{ view.getRenderAttributeString( tooltipRepeaterSettingKey ) }}}>
										{{{ hotspot.deensimc_hotspot_tooltip_content }}}
									</div>
									<# if( isTooltipDirectionAnimation ){ #>
							</div>
							<# } #>
								<# } #>

				</{{{ hotspotElementTag }}}>
				<# }); #>
			<?php
		}
	}

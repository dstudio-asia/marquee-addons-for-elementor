<?php


	use Elementor\Group_Control_Image_Size;
?>
<div class="deensimc-card-list-wrapper">

	<?php foreach ($card_settings as $index => $item) :
		$deensimc_heading_tag =  $global_deensimc_heading_tag;
	?>
	

		<div class="deensimc-card-list-item"
			
			<?php if ($settings['deensimc_card_style'] == 'background_image' && !empty($item['image']['url'])) : ?>
			style="background-image: url('<?php echo esc_url($item['image']['url']); ?>')"
			<?php endif; ?>>


			<?php if ($settings['deensimc_card_number_style'] === 'top') : ?>
				<div class="deensimc-card-number position-top">
					<?php
					$cardNumber = isset($item['card_number']) && trim($item['card_number']) !== ''
						? esc_html($item['card_number']) . '.'
						: ($index + 1) . '.';
					echo $cardNumber;
					?>
				</div>
			<?php endif; ?>

			<div class="deensimc-card-content-wrapper">


				<div class="deensimc-card-left-section">

					<!-- $deensimc_heading_tag = !empty($item['deensimc_heading_tag']) ? $item['deensimc_heading_tag'] : 'h3'; -->

					<div class="deensimc-heading-with-number">
						<<?php echo esc_attr($deensimc_heading_tag); ?> class="card-heading">

							<?php $number_style = $settings['deensimc_card_number_style'];

							if ($number_style !== 'none') :
							?>
								<span class="deensimc-card-number">
									<?php
									if (!empty($item['card_number'])) {
										$value = esc_html($item['card_number']);
									} else {
										$value = $index + 1;
									}

									switch ($number_style) {
										case 'bullet':
											echo '•';
											break;
										case 'arrow':
											echo '→';
											break;
										case 'check':
											echo '✓';
											break;
										case 'number':
										default:
											echo $value . '.';
											break;
									}
									?>
								</span>
							<?php endif; ?>



							<?php echo esc_html($item['heading']); ?>
						</<?php echo esc_attr($deensimc_heading_tag); ?>>
					</div>


					<div class="deensimc-card-description">Demo Descrition Manekjdskfjdkj <?php echo wp_kses_post($item['description']); ?></div>

					<?php if (!empty($item['button_text'])) : ?>
						<div class="deensimc-card-button-wrapper">
							<a href="<?php echo esc_url($item['button_link']['url']); ?>"
								class="elementor-button elementor-size-<?php echo esc_attr($item['button_size']); ?>"
								<?php echo ($this->get_render_attribute_string('button')); ?>>

								<span class="elementor-button-text"><?php echo esc_html($item['button_text']); ?></span>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<?php if (($settings['deensimc_card_style'] == 'image' || $settings['deensimc_card_style'] == 'marquee' || $settings['deensimc_card_style'] == 'card_stacked') && isset($item['image']) && !empty($item['image']['url'])) { ?>
					<div class="deensimc-card-image">
						<?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'image'); ?>
					</div>
				<?php } elseif ($settings['deensimc_card_style'] == 'icon') { ?>
					<div class="deensimc-card-image">
						<?php
						if (!empty($item['icon'])) { ?>

							<div class="elementor-icon-wrapper">
								<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php }
						?>
					</div>
				<?php }; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
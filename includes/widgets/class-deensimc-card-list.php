<?php

if (! defined('ABSPATH')) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;


class Deensimc_Card_List_Widget extends Widget_Base
{
	use ContentTabTrait, ButtonTabTrait, CardControlStyleTrait, ContentControlStyleTrait, ButtonControlStyleTrait, ImageControlStyleTrait, IconControlStyleTrait, BackgroundImageControlStyleTrait;

	public function get_name(): string
	{
		return 'deensimc-card-list';
	}

	public function get_title(): string
	{
		return esc_html__('Card List', 'marquee-addons-for-elementor');
	}

	public function get_icon(): string
	{
		return 'eicon-bullet-list'; // Use the free bullet list icon from Elementor's icon set
	}

	public function get_categories(): array
	{
		return ['smooth_marquee'];
	}

	public function get_keywords(): array
	{
		return ['card', 'list'];
	}

	protected function register_controls()
	{
		// Card List Section
		$this->start_controls_section(
			'section_card_list',
			[
				'label' => esc_html__('Card List', 'marquee-addons-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'card_style',
			[
				'label' => esc_html__('Card Style', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'image' => esc_html__('Image', 'marquee-addons-for-elementor'),
					'icon' => esc_html__('Icon', 'marquee-addons-for-elementor'),
					'background_image' => esc_html__('Overlay Image', 'marquee-addons-for-elementor'),

				],
				'default' => 'image',

			]
		);



		$this->add_control(
			'card_number_style',
			[
				'label' => esc_html__('Card Number Format', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'marquee-addons-for-elementor'),
					'number' => esc_html__('Numbered (1, 2, 3)', 'marquee-addons-for-elementor'),
					'bullet' => esc_html__('Bullet Point (•)', 'marquee-addons-for-elementor'),
					'arrow' => esc_html__('Arrow (→)', 'marquee-addons-for-elementor'),
					'check' => esc_html__('Checkmark (✓)', 'marquee-addons-for-elementor'),
				],
				'default' => 'number',
				'separator' => 'before',
			]
		);


		$this->add_control(
			'image_position',
			[
				'label' => esc_html__('Image Position', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => esc_html__('Left', 'marquee-addons-for-elementor'),

						'icon' => 'eicon-h-align-left',
					],
					'left' => [
						'title' => esc_html__('Right', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],

					'top' => [
						'title' => esc_html__('Top', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__('Bottom', 'marquee-addons-for-elementor'),
						'icon' => 'eicon-v-align-bottom', // Correct icon for bottom
					],

				],
				'condition' => [
					'card_style' => ['image', 'icon'],
				],
				'default' => 'left',
				'toggle' => false,
				'prefix_class' => 'image-position-',
				'separator' => 'before',
			]
		);

		$repeater = new \Elementor\Repeater();
		// Main Tabs Container
		//Content Tabs control start
		$this->clw_content_control_tab($repeater, 'card_content_tabs');
		//Content Tabs control end


		//image control tab
		$repeater->start_controls_tab(
			'image_tab',
			[
				'label' => esc_html__('Image', 'marquee-addons-for-elementor'),

			],

		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::MEDIA,

				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],

			]
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'medium_large',
				'separator' => 'none',

			]
		);

		$repeater->end_controls_tab();
		//image control tab end

		// Button Controls in Repeater Start
		$this->clw_button_control_tab($repeater, 'button_tab');
		// Button Controls in Repeater End


		$this->add_control(
			'cards',
			[
				'label' => esc_html__('Cards', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'condition' => [
					'card_style' => ['image', 'background_image'],
				],
				'default' => [
					[
						'description' => esc_html__('Card description text goes here', 'marquee-addons-for-elementor'),
					],
					[
						'description' => esc_html__('Card description text goes here', 'marquee-addons-for-elementor'),
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);


		$icon_repeater = new \Elementor\Repeater();

		//Content Control in repeater Trait start
		$this->clw_content_control_tab($icon_repeater, 'icon_card_content_tabs');
		//Content Control in repeater Trait end

		$icon_repeater->start_controls_tab(
			'icon_tab',
			[
				'label' => esc_html__('Icon', 'marquee-addons-for-elementor'),

			],

		);

		$icon_repeater->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'textdomain'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

		$icon_repeater->end_controls_tab();

		// Button Tab Control Trait start
		$this->clw_button_control_tab($icon_repeater, 'button_tab');
		// Button Tab Control Trait end


		$this->add_control(
			'icon_cards',
			[
				'label' => esc_html__('Cards', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $icon_repeater->get_controls(),

				'default' => [
					[
						'description' => esc_html__('Card description text goes here', 'marquee-addons-for-elementor'),
					],
					[
						'description' => esc_html__('Card description text goes here', 'marquee-addons-for-elementor'),
					],
				],
				'condition' => [
					'card_style' => 'icon',
				],
				'title_field' => '{{{ heading }}}',
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label' => esc_html__('HTML Tag', 'marquee-addons-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		// Card Style Section Start
		$this->clw_card_control_style($this);
		// Card Style Section End


		// Content Style Section Start
		$this->clw_content_control_style($this);
		// Content Style Section End



		// Button Style Section Start
		$this->clw_button_control_style($this);
		// Button Style Section End


		// Image Style Section Start
		$this->clw_image_control_style($this);
		// Image Style Section End





		// Icon Style Section Start
		$this->clw_icon_control_style($this);
		// Icon Style Section End


		// Background Image Style
		$this->clw_background_image_control_style($this);
		// Background Image Style

	}



	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$global_heading_tag = $settings['heading_tag'];
		$card_settings = $settings['card_style'] == 'icon' ? $settings['icon_cards'] : $settings['cards'];

		if (empty($card_settings)) {
			return;
		}

?>
		<div class="deensimc-card-list-wrapper">

			<?php foreach ($card_settings as $index => $item) :
				$heading_tag =  $global_heading_tag;
			?>

				<div class="deensimc-card-list-item"

					<?php if ($settings['card_style'] == 'background_image' && !empty($item['image']['url'])) : ?>
					style="background-image: url('<?php echo esc_url($item['image']['url']); ?>')"
					<?php endif; ?>>


					<?php if ($settings['card_number_style'] === 'top') : ?>
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

							<!-- $heading_tag = !empty($item['heading_tag']) ? $item['heading_tag'] : 'h3'; -->

							<div class="deensimc-heading-with-number">
								<<?php echo esc_attr($heading_tag); ?> class="card-heading">

									<?php $number_style = $settings['card_number_style'];

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
								</<?php echo esc_attr($heading_tag); ?>>
							</div>


							<div class="deensimc-card-description"><?php echo wp_kses_post($item['description']); ?></div>

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

						<?php if ($settings['card_style'] == 'image' && isset($item['image']) && !empty($item['image']['url'])) { ?>
							<div class="deensimc-card-image">
								<?php echo Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'image'); ?>
							</div>
						<?php } elseif ($settings['card_style'] == 'icon') { ?>
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



	<?php
	}



	protected function content_template()
	{
	?>
		<div class="deensimc-card-list-wrapper">
			<#
				var cardSettings=settings.card_style==='icon' ? settings.icon_cards : settings.cards;

				_.each(cardSettings, function(item, index) {
				var image={
				id: item.image?.id ?? '' ,
				url: item.image?.url ?? '' ,
				size: item.thumbnail_size ?? '' ,
				dimension: item.thumbnail_custom_dimension ?? '' ,
				model: view.getEditModel() ?? null
				};
				var imageUrl=image.url ? elementor.imagesManager.getImageUrl(image) : '' ;
				var headingTag=settings.heading_tag || 'h3' ;
				var hasBgImage=settings.card_style==='background_image' && imageUrl;
				#>
				<div class="deensimc-card-list-item"
					<# if (hasBgImage) { #>
					style="background-image: url('{{{ imageUrl }}}')"
					<# } #>>

						<# if (settings.card_number_style==='top' ) { #>
							<div class="deensimc-card-number position-top">
								{{ item.card_number && item.card_number.trim() !== '' ? item.card_number + '.' : (index + 1) + '.' }}
							</div>
							<# } #>

								<div class="deensimc-card-content-wrapper">

									<# if (settings.card_style==='image' && settings.image_position==='top' && item.image.url) { #>
										<!-- <div class="deensimc-card-image">
											<img src="{{ imageUrl }}" alt="">
										</div> -->
										<# } #>

											<div class="deensimc-card-left-section">
												<div class="deensimc-heading-with-number">
													<{{ headingTag }} class="card-heading">
														<# if (settings.card_number_style !=='none' ) { #>
															<span class="deensimc-card-number">
																<#
																	var value=item.card_number && item.card_number.trim() !=='' ? item.card_number : (index + 1);
																	switch (settings.card_number_style) {
																	case 'bullet' :
																	print('•');
																	break;
																	case 'arrow' :
																	print('→');
																	break;
																	case 'check' :
																	print('✓');
																	break;
																	default:
																	print(value + '.' );
																	}
																	#>
															</span>
															<# } #>

																{{{ item.heading }}}
													</{{ headingTag }}>
												</div>

												<div class="deensimc-card-description">{{{ item.description }}}</div>

												<# if (item.button_text) { #>
													<div class="deensimc-card-button-wrapper">
														<a href="{{ item.button_link.url }}"
															class="elementor-button elementor-size-{{ item.button_size }}"
															<# if (item.button_link.is_external) { #> target="_blank" <# } #>
																<# if (item.button_link.nofollow) { #> rel="nofollow" <# } #>>
																		<span class="elementor-button-text">{{{ item.button_text }}}</span>
														</a>
													</div>
													<# } #>
											</div>

											<# if (settings.card_style==='image' && item.image.url) { #>
												<div class="deensimc-card-image">
													<img src="{{ imageUrl }}" alt="">
												</div>
												<# } else if (settings.card_style==='icon' && item.icon) { #>
													<div class="deensimc-card-image">
														<# if (item.icon.value) { #>
															<div class="elementor-icon-wrapper">
																<#
																	var iconHTML=elementor.helpers.renderIcon(view, item.icon, { 'aria-hidden' : true, 'class' : 'elementor-icon'
																	}, 'i' , 'object' );

																	if (iconHTML.rendered) { #>
																	{{{ iconHTML.value }}}
																	<# }
																		#>
															</div>
															<# } #>
													</div>
													<# } #>
								</div>
				</div>
				<# }); #>
		</div>
<?php
	}
}

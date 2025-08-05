<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Image_Marquee
 * Widget for displaying an image marquee.
*/
class Deensimc_Image_Marquee extends Widget_Base {

	use Imagemarquee_Content_Image;
	use Imagemarquee_Content_Additional_Options;
	use Imagemarquee_Style_Alignment_Spacing;
	use Imagemarquee_Style_Height_Width;
	use Imagemarquee_Style_Border_Options;
	use Imagemarquee_Style_Caption;
	use Imagemarquee_Style_Edge_Shadow;

	public function get_name() 
	{
		return 'deensimc-smooth-marquee';
	}

	public function get_title() 
	{
		return esc_html__( 'Image Marquee', 'marquee-addons-for-elementor' );
	}

	public function get_icon() 
	{
		return 'eicon-slider-push eicon-deensimc';
	}

	public function get_categories() 
	{
		return ['deensimc_smooth_marquee'];
	}

	public function get_keywords() 
	{
		return [ 'slider', 'marquee', 'slide', 'deen', 'smooth', 'vertical', 'horizontal', 'scroll' ];
	}

	protected function get_upsale_data(): array {
		return [
			'condition' => !class_exists( '\Deensimcpro_Marquee\Marqueepro' ),
			'image' => esc_url( ELEMENTOR_ASSETS_URL . 'images/go-pro.svg' ),
			'image_alt' => esc_attr__( 'Upgrade', 'marquee-addons-for-elementor' ),
			'title' => esc_html__( 'Get MarqueeAddons Pro', 'marquee-addons-for-elementor' ),
			'description' => esc_html__( 'Get the premium version of the MarqueeAddons and grow your website capabilities.', 'marquee-addons-for-elementor' ),
			'upgrade_url' => esc_url( 'https://marqueeaddons.com' ),
			'upgrade_text' => esc_html__( 'Upgrade Now', 'marquee-addons-for-elementor' ),
		];
	}

	protected function register_controls() 
	{
		
		$this->content_image();

		$this->content_additional_options();

		$this->start_controls_section(
			'deensimc_style_section',
			[
				'label' => esc_html__( 'Image', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->style_alignment_spacing();

		$this->style_height_width();

		$this->style_border_options();
		
		$this->end_controls_section();

		$this->style_caption();
		$this->style_edge_shadow();
		
	}

	/**
	 * Renders the image gallery with a group of images, including links, lazy loading, and captions.
	 *
	 * This function iterates through the uploaded gallery images, renders each image inside a div wrapper, 
	 * and optionally wraps each image in a link. The link can either open the image in a lightbox or 
	 * redirect to a custom URL. Lazy loading is applied based on user settings.
	 *
	 * @param array   $settings      	The settings array containing gallery options and image details.
	 * @param string  $link_type     	Defines the type of link ('none', 'file', or 'custom').
	 * @param string  $lazy_load_attr   Controls lazy loading ('loading=lazy' or an empty string).
	 * @param boolean $open_lightbox 	Determines whether to open the image in a lightbox.
 	*/
	protected function deensimc_get_caption( $image, $caption_type ) 
	{
		$attachment_post = get_post( $image['id'] );
    
		if ( !$attachment_post ) {
			return '';
		}

		switch ( $caption_type ) {
			case 'caption':
				return $attachment_post->post_excerpt;
			
			case 'title':
				return $attachment_post->post_title;
		}
	}

	/**
	 * Renders the image gallery with a group of images, including links, lazy loading, and captions.
	*/
	protected function render_image_gallery_group( $settings, $link_type, $lazy_load_attr, $open_lightbox ) {
		foreach ( $settings['deensimc_upload_gallery'] as $image ) {
			if ( $link_type !== 'none' ) {
				if ( $link_type === 'file' ) {
					echo '<a data-elementor-open-lightbox="' . esc_attr( $open_lightbox ) . '" href="' . esc_url( $image['url'] ) . '">';
				} elseif ( $link_type === 'custom' ) {
				?>
					<a <?php $this->print_render_attribute_string( 'deensimc_link' ) ?>>
				<?php
				}
			}
			echo '<div class="deensimc-img-wrapper">';
				echo '<img src="' . esc_url( $image['url'] ) . '" ' . esc_html( $lazy_load_attr ) . '>';
				echo '<figcaption class="elementor-image-marquee-caption">' . esc_html( $this->deensimc_get_caption( $image, $settings['deensimc_caption_type'] ) ) . '</figcaption>';
			echo '</div>';
			if ( $link_type !== 'none' ) {
				echo '</a>';
			}
		}
	}

	/**
	 * Renders image marquee widget.
	 * @return void
 	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$marquee_orientation = $settings['deensimc_slide_position'] === 'yes' ? 'vertical' : 'horizontal';
		$slide_direction_class = $settings['deensimc_slide_direction'] === 'yes' ? 'deensimc-marquee-reverse' : '';
		if ( ! empty( $settings['deensimc_link']['url'] ) ) {
			$this->add_link_attributes( 'deensimc_link', $settings['deensimc_link'] );
		}
		$lazy_load_attr = $settings['deensimc_lazy_load_switch'] === 'yes' ? 'loading=lazy' : '';
		$link_type = $settings['deensimc_link_to'];
		$open_lightbox = $settings['deensimc_open_lightbox'];
		$pause_on_hover = $settings['deensimc_pause_on_hover_switch'];
		$animation_speed = $settings['deensimc_image_animation_speed'];
		$marquee_classes = $marquee_orientation . " " . $slide_direction_class;
		$show_shadow = $settings['deensimc_image_show_edge_shadow_switch'] === 'yes' ? 'deensimc-shadow' : '';
	?>
		<div class="deensimc-wrapper deensimc-wrapper-<?php echo esc_attr( $marquee_orientation ); ?>">
			<div class="deensimc-marquee <?php echo esc_attr( $show_shadow ) ?> deensimc-marquee-<?php echo esc_attr( $marquee_classes ); ?>" data-pause-on-hover="<?php echo esc_attr( $pause_on_hover ) ?>" data-animation-speed="<?php echo esc_attr( $animation_speed ) ?>" >
				<div class="deensimc-marquee-group">
					<?php
						$this->render_image_gallery_group( $settings, $link_type, $lazy_load_attr, $open_lightbox );
					?>
				</div>				
				<div aria-hidden="true" class="deensimc-marquee-group">
					<?php
						$this->render_image_gallery_group( $settings, $link_type, $lazy_load_attr, $open_lightbox );
					?>
				</div>
			</div>
		</div>
	<?php
	}
}
?>
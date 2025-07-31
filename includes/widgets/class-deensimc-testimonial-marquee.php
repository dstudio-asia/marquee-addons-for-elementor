<?php
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor Classes
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Testimonial_Marquee
 * Widget for displaying a testimonial marquee
*/

class Deensimc_Testimonial_Marquee extends Widget_Base {

	use Testimonialmarquee_Contents;
	use Testimonialmarquee_Content_Additional_Options;
	use Testimonialmarquee_Style_Contents_Box;
	use Testimonialmarquee_Style_Contents;
	use Testimonialmarquee_Style_Image;
	use Testimonialmarquee_Style_Name_Title;
	use Testimonialmarquee_Style_Review;

    public function get_name() 
	{
        return 'deensimc-testimonial';
    }

    public function get_title() 
	{
        return esc_html__( 'Testimonial Marquee', 'marquee-addons-for-elementor' );
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
        return [ 'testimonail', 'slide', 'deen', 'slider' ];
    }

    protected function register_controls() 
	{

        $this->start_controls_section(
			'deensimc_content_section',
			[
				'label' => esc_html__( 'Contents', 'marquee-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->content_controls();

		$this->add_control(
			'deensimc_testimonial_reverse_section',
			[
				'label' => esc_html__( 'Show Reverse', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'marquee-addons-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'marquee-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'deensimc_testimonial_alignment',
			[
				'label' => esc_html__( 'Alignment', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'marquee-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .deensimc-tes .deensimc-tes-main blockquote' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .deensimc-tes .deensimc-tes-main .deensimc-tes-author' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'deensimc_testimonial_quote_left_icon',
			[
				'label' => esc_html__( 'Quote Left', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-left',
					'library' => 'fa-solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
			]
		);

		$this->add_control(
			'deensimc_testimonial_quote_right_icon',
			[
				'label' => esc_html__( 'Quote Right', 'marquee-addons-for-elementor' ),
				'type' =>  Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-right',
					'library' => 'fa-solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
			]
		);

        $this->end_controls_section();

		$this->content_additional_options();

		$this->style_contents_box();

		$this->style_contents();

		$this->style_image();

		$this->style_name_title();

		$this->style_review();
    }

	/**
	 * Renders the testimonial content block.
	 *
	 * This function outputs the main content of the testimonial, including the text and "Show More" button if available.
	 *
	 * @param array $testimonial The testimonial data, including the content field.
	 * @param array $settings The widget settings, including the "Show More" button text.
 	*/
	protected function render_testimonial_contents( $testimonial, $settings )
	{
	?>
		<blockquote class="deensimc-tes-text">
			<span>
				<?php echo esc_html( $testimonial['deensimc_testimonial_content'] ); ?>
			</span>
		</blockquote>
	<?php
	}

	/**
	 * Renders the author information.
	 *
	 * This function displays the author's name and title within the testimonial.
	 *
	 * @param array $testimonial The testimonial data, including the author name and title fields.
	*/
	protected function render_author_info( $testimonial )
	{
	?>
		<h5 class="deensimc-tes-heading">        
			<span class="deensimc-tes-name">
				<?php echo esc_html( $testimonial['deensimc_testimonial_name'] ); ?>
			</span>
			<span class="deensimc-tes-title">
				<?php echo esc_html( $testimonial['deensimc_testimonial_title'] ); ?>
			</span>
		</h5>
	<?php
	}

	/**
	 * Renders the author profile image.
	 *
	 * This function outputs the author's profile image if provided.
	 *
	 * @param array $testimonial The testimonial data, including the profile image URL.
 	*/
	protected function render_author_profile( $testimonial )
	{
	?>
		<img src="<?php echo esc_url( $testimonial['deensimc_testimonial_image']['url'] ); ?>" alt="<?php esc_attr_e( 'Author image', 'marquee-addons-for-elementor' ); ?>" />
	<?php
	}

	/**
	 * Renders the testimonial rating.
	 *
	 * This function outputs the rating stars, including full, half, and empty stars based on the rating value.
	 *
	 * @param array $testimonial The testimonial data, including the rating and rating counter.
 	*/
	protected function render_ratings( $testimonial )
	{
	?>
		<div class="deensimc-tes-ratings deensimc-testimonial-ratings">
			<div class="deensimc-tes-star-icon fs-6">
				<?php
				$deensimc_rating = $testimonial['deensimc_testimonial_rating_num'];
				$deensimc_full_stars = floor($deensimc_rating);
				$deensimc_half_star = $deensimc_rating - $deensimc_full_stars;

				// Render full stars
				for ( $k = 0; $k < $deensimc_full_stars; $k++ ) { ?>
					<span class="deensimc-tes-icons"><i class="fa fa-star"></i></span>
				<?php }

				// Render half star
				if ( $deensimc_half_star >= 0.5 ) { ?>
					<span class="deensimc-tes-icons-half"><i class="fa fa-star"></i></span>
				<?php }

				// Render remaining empty stars
				for ( $j = 0; $j < 5 - ceil( $testimonial['deensimc_testimonial_rating_num'] ); $j++ ) { ?>
					<span class="deensimc-tes-icons-none"><i class="fa fa-star"></i></span>
				<?php } ?>
				<?php
				if( '' !== $testimonial['deensimc_testimonial_rating_counter'] ) {
				?>
					<small class="deensimc-tes-review-text">
						<?php echo esc_html__( '(', 'marquee-addons-for-elementor' ) . esc_html( $testimonial['deensimc_testimonial_rating_counter'] ) . esc_html__(')', 'marquee-addons-for-elementor' ); ?>
					</small>
				<?php 
				}
				?>
			</div>
		</div>
	<?php
	}

	/**
	 * Renders testimonial marquee widget.
	 * @return void
 	*/
    protected function render() 
	{
        $settings = $this->get_settings_for_display();
		$show_shadow = $settings['deensimc_testimonial_show_edge_shadow_switch'] === 'yes' ? 'deensimc-shadow' : '';
		$show_reverse = $settings['deensimc_testimonial_reverse_section'] === 'yes' ? 'deensimc-marquee-reverse' : '';
    ?>
		<div class="deensimc-tes">
			<div class="deensimc-marquee  <?php echo esc_attr( $show_shadow ." ". $show_reverse ) ?> deensimc-tes-logo"  
				data-animation-status="<?php echo esc_attr( $settings['deensimc_show_animation'] ); ?>" 
				data-excerpt-length="<?php echo esc_attr( $settings['deensimc_tesimonial_excerpt_length'] ); ?>" 
				data-show-more="<?php echo esc_attr( $settings['deensimc_tesimonial_excerpt_title'] ); ?>" 
				data-show-less="<?php echo esc_attr( $settings['deensimc_tesimonial_excerpt_title_less'] ); ?>" 
				data-pause-on-hover="<?php echo esc_attr( $settings['deensimc_testimonial_pause_on_hover'] ); ?>" 
				data-animation-speed="<?php echo esc_attr( $settings['deensimc_testimonial_marquee_animation_speed'] ); ?>"
				data-quote-left="<?php echo esc_html( $settings['deensimc_testimonial_quote_left_icon']['value'] ); ?>"
				data-quote-right="<?php echo esc_html( $settings['deensimc_testimonial_quote_right_icon']['value'] ); ?>">
				<ul class="deensimc-marquee-group deensimc-tes-content">
					<?php 
					foreach( $settings['deensimc_repeater_testimonial_main'] as $testimonial ) { 
						$author_image_url = $testimonial['deensimc_testimonial_image']['url'] ? '' : 'no-image';
					?>
						<li class="deensimc-tes-item deensimc-tes-wrapper">
							<figure class="deensimc-tes-main">
								<?php
									// Render testimonial contents
									if( '' !== $testimonial['deensimc_testimonial_content'] ) { 
										$this->render_testimonial_contents( $testimonial, $settings );
									}
								?>
								<div class="deensimc-tes-author <?php echo esc_attr( $author_image_url ); ?>">
									<?php 
									// Render author image
									$has_author_image = !empty( $testimonial['deensimc_testimonial_image']['url'] );
									if ( $has_author_image ){
										$this->render_author_profile( $testimonial );
									}
									
									// Render author info and ratings
									if( '' !== $testimonial['deensimc_testimonial_name'] || '' !== $testimonial['deensimc_testimonial_title'] ) { 
										$this->render_author_info( $testimonial );

										if( 'yes' === $testimonial['deensimc_testimonial_show_rating'] && '' !== $testimonial['deensimc_testimonial_rating_num'] ) {
											$this->render_ratings( $testimonial );
										}
									}
									?>	
								</div>
							</figure>
						</li>
					<?php } ?>
				</ul>
				<ul aria-hidden="true" class="deensimc-marquee-group deensimc-tes-content">
					<?php 
					foreach( $settings['deensimc_repeater_testimonial_main'] as $testimonial ) { 
						$author_image_url = $testimonial['deensimc_testimonial_image']['url'] ? '' : 'no-image';
					?>
						<li class="deensimc-tes-item deensimc-tes-wrapper">
							<figure class="deensimc-tes-main">
								<?php
									// Render testimonial contents
									if( '' !== $testimonial['deensimc_testimonial_content'] ) { 
										$this->render_testimonial_contents( $testimonial, $settings );
									}
								?>
								<div class="deensimc-tes-author <?php echo esc_attr( $author_image_url ); ?>">
									<?php 
									// Render author image
									$has_author_image = !empty( $testimonial['deensimc_testimonial_image']['url'] );
									if ( $has_author_image ){
										$this->render_author_profile( $testimonial );
									}
									
									// Render author info and ratings
									if( '' !== $testimonial['deensimc_testimonial_name'] || '' !== $testimonial['deensimc_testimonial_title'] ) { 
										$this->render_author_info( $testimonial );

										if( 'yes' === $testimonial['deensimc_testimonial_show_rating'] && '' !== $testimonial['deensimc_testimonial_rating_num'] ) {
											$this->render_ratings( $testimonial );
										}
									}
									?>	
								</div>
							</figure>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
    <?php
    }

	/**
	 * Renders dynamic testimonial marquee contents in Elementor.
	 * @return void
 	*/
	protected function content_template() {
	?>
		<#
			let showShadow = settings.deensimc_testimonial_show_edge_shadow_switch === 'yes' ? 'deensimc-shadow' : '';
			let showReverse = settings.deensimc_testimonial_reverse_section === 'yes' ? 'deensimc-marquee-reverse' : '';
		#>
		<div class="deensimc-tes">
			<div class="deensimc-marquee {{ showShadow }} {{ showReverse }} deensimc-tes-logo"  data-animation-status="{{ settings.deensimc_show_animation }}" data-excerpt-length="{{ settings.deensimc_tesimonial_excerpt_length }}"  data-show-more="{{ settings.deensimc_tesimonial_excerpt_title }}"  data-show-less="{{ settings.deensimc_tesimonial_excerpt_title_less }}"  data-pause-on-hover="{{ settings.deensimc_testimonial_pause_on_hover }}" data-animation-speed="{{ settings.deensimc_testimonial_marquee_animation_speed }}" data-quote-left="{{ settings.deensimc_testimonial_quote_left_icon.value }}" data-quote-right="{{ settings.deensimc_testimonial_quote_right_icon.value }}">
				<ul class="deensimc-marquee-group deensimc-tes-content">
					<# 
					// Iterate through testimonials
					_.each( settings.deensimc_repeater_testimonial_main, function( testimonial ) {
						let has_author_image_url = testimonial.deensimc_testimonial_image.url ? '' : 'no-image';
					#>
						<li class="deensimc-tes-item deensimc-tes-wrapper">
							<figure class="deensimc-tes-main">
								<# if ( testimonial.deensimc_testimonial_content ) { #>
									<blockquote class="deensimc-tes-text">
										<span>{{{ testimonial.deensimc_testimonial_content }}}</span>
									</blockquote>
									<span class="deensimc-show-more">{{{ settings.deensimc_tesimonial_excerpt_title }}}</span>
								<# } #>
								
								<div class="deensimc-tes-author {{ has_author_image_url }}">
									<# // Render author image if exists #>
									<# if ( testimonial.deensimc_testimonial_image.url ) { #>
										<img src="{{ testimonial.deensimc_testimonial_image.url }}" alt="author image" />
									<# } #>

									<# // Render author name and title if they exist #>
									<# if ( testimonial.deensimc_testimonial_name || testimonial.deensimc_testimonial_title ) { #>
										<h5 class="deensimc-tes-heading">
											<span class="deensimc-tes-name">{{{ testimonial.deensimc_testimonial_name }}}</span>
											<span class="deensimc-tes-title">{{{ testimonial.deensimc_testimonial_title }}}</span>
										</h5>
									<# } #>

									<# // Render ratings if enabled #>
									<# if ( testimonial.deensimc_testimonial_show_rating === 'yes' && testimonial.deensimc_testimonial_rating_num ) { #>
										<div class="deensimc-tes-ratings deensimc-testimonial-ratings">
											<div class="deensimc-tes-star-icon fs-6">
												<# 
												let fullStars = Math.floor( testimonial.deensimc_testimonial_rating_num );
												let halfStar = testimonial.deensimc_testimonial_rating_num - fullStars;
												let emptyStars = 5 - Math.ceil( testimonial.deensimc_testimonial_rating_num );
												#>

												<# // Render full stars #>
												<# for ( let k = 0; k < fullStars; k++ ) { #>
													<span class="deensimc-tes-icons"><i class="fa fa-star"></i></span>
												<# } #>

												<# // Render half star #>
												<# if ( halfStar >= 0.5 ) { #>
													<span class="deensimc-tes-icons-half"><i class="fa fa-star"></i></span>
												<# } #>

												<# // Render empty stars #>
												<# for ( let j = 0; j < emptyStars; j++ ) { #>
													<span class="deensimc-tes-icons-none"><i class="fa fa-star"></i></span>
												<# } #>
												<# if('' !== testimonial.deensimc_testimonial_rating_counter ){ #>
												<small class="deensimc-tes-review-text">(
													{{{ testimonial.deensimc_testimonial_rating_counter }}}
												)</small>
												<# } #>
											</div>
										</div>
									<# } #>
								</div>
							</figure>
						</li>
					<# }); #>
				</ul>
				<ul aria-hidden="true" class="deensimc-marquee-group deensimc-tes-content">
					<# 
					// Iterate through testimonials
					_.each( settings.deensimc_repeater_testimonial_main, function( testimonial ) {
						let has_author_image_url = testimonial.deensimc_testimonial_image.url ? '' : 'no-image';
					#>
						<li class="deensimc-tes-item deensimc-tes-wrapper">
							<figure class="deensimc-tes-main">
								<# if ( testimonial.deensimc_testimonial_content ) { #>
									<blockquote class="deensimc-tes-text">
										<span>{{{ testimonial.deensimc_testimonial_content }}}</span>
									</blockquote>
									<span class="deensimc-show-more">{{{ settings.deensimc_tesimonial_excerpt_title }}}</span>
								<# } #>
								
								<div class="deensimc-tes-author {{ has_author_image_url }}">
									<# // Render author image if exists #>
									<# if ( testimonial.deensimc_testimonial_image.url ) { #>
										<img src="{{ testimonial.deensimc_testimonial_image.url }}" alt="author image" />
									<# } #>

									<# // Render author name and title if they exist #>
									<# if ( testimonial.deensimc_testimonial_name || testimonial.deensimc_testimonial_title ) { #>
										<h5 class="deensimc-tes-heading">
											<span class="deensimc-tes-name">{{{ testimonial.deensimc_testimonial_name }}}</span>
											<span class="deensimc-tes-title">{{{ testimonial.deensimc_testimonial_title }}}</span>
										</h5>
									<# } #>

									<# // Render ratings if enabled #>
									<# if ( testimonial.deensimc_testimonial_show_rating === 'yes' && testimonial.deensimc_testimonial_rating_num ) { #>
										<div class="deensimc-tes-ratings deensimc-testimonial-ratings">
											<div class="deensimc-tes-star-icon fs-6">
												<# 
												let fullStars = Math.floor( testimonial.deensimc_testimonial_rating_num );
												let halfStar = testimonial.deensimc_testimonial_rating_num - fullStars;
												let emptyStars = 5 - Math.ceil( testimonial.deensimc_testimonial_rating_num );
												#>

												<# // Render full stars #>
												<# for ( let k = 0; k < fullStars; k++ ) { #>
													<span class="deensimc-tes-icons"><i class="fa fa-star"></i></span>
												<# } #>

												<# // Render half star #>
												<# if ( halfStar >= 0.5 ) { #>
													<span class="deensimc-tes-icons-half"><i class="fa fa-star"></i></span>
												<# } #>

												<# // Render empty stars #>
												<# for ( let j = 0; j < emptyStars; j++ ) { #>
													<span class="deensimc-tes-icons-none"><i class="fa fa-star"></i></span>
												<# } #>
												<# if( '' !== testimonial.deensimc_testimonial_rating_counter ){ #>
												<small class="deensimc-tes-review-text">(
													{{{ testimonial.deensimc_testimonial_rating_counter }}}
												)</small>
												<# } #>
											</div>
										</div>
									<# } #>
								</div>
							</figure>
						</li>
					<# }); #>
				</ul>
			</div>
		</div>
	<?php
	}
}
?>
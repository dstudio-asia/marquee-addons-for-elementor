<?php
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Icons_Manager;

/**
 * Class Deensimc_Text_Marquee
 * Widget for displaying a text marquee
*/

class Deensimc_Text_Marquee extends Widget_Base {

	use Textmarquee_Content_Text_Repeater;
	use Textmarquee_Content_Additional_Options;
	use Textmarquee_Style_Text_Contents;

    public function get_name() 
	{
        return 'deensimc-smooth-text';
    }

    public function get_title() 
	{
        return esc_html__( 'Text Marquee', 'marquee-addons-for-elementor' );
    }

    public function get_icon() {
        return 'eicon-slider-push eicon-deensimc';
    }

    public function get_categories() {
        return ['deensimc_smooth_marquee'];
    }

    public function get_keywords() {
        return [ 'slider', 'marquee', 'slide', 'deen', 'smooth', 'vertical', 'horizontal', 'scroll' ];
    }

    protected function register_controls(): void {

        $this->content_text_repeater();

		$this->content_additional_options();

		$this->style_text_contents();
    }

	/**
	 * Renders each text item in the marquee, including an optional icon and text content.
	 *
	 * @param array $settings Widget settings containing the text and icon data.
 	*/
	protected function render_marquee_texts( $settings )
	{
		foreach ( $settings['deensimc_repeater_text_main'] as $text ) {
		?>
			<div class="deensimc-text-wrapper">
				<?php Icons_Manager::render_icon( $text['deensimc_repeater_text_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				<p class="deensimc-scroll-text">
					<?php
						echo esc_html( $text['deensimc_repeater_text'] );
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
    protected function render() {
        $settings = $this->get_settings_for_display();
		$marquee_orientation = $settings['deensimc_slide_position'] === 'yes' ? 'vertical' : 'horizontal';
		$slide_direction_class = $settings['deensimc_slide_direction'] === 'yes' ? ' deensimc-marquee-reverse' : '';
		$pause_on_hover = $settings['deensimc_pause_on_hover_switch'];
		$animation_speed = $settings['deensimc_animation_speeds'];
		$marquee_classes = $marquee_orientation." ".$slide_direction_class;
		$show_shadow = $settings['deensimc_show_shadow_switch'] === 'yes' ? 'deensimc-shadow' : 'deensimc-no-shadow';
    ?>
		<div class="deensimc-wrapper deensimc-wrapper-<?php echo esc_attr( $marquee_orientation ); ?> deensimc-text-marquee">
			<div class="deensimc-marquee <?php echo esc_attr( $show_shadow ); ?> deensimc-marquee-<?php echo esc_attr( $marquee_classes ); ?>" data-pause-on-hover="<?php echo esc_attr( $pause_on_hover ) ?>" data-animation-speed="<?php echo esc_attr( $animation_speed ) ?>" >
				<div class="deensimc-marquee-group">
					<?php $this->render_marquee_texts( $settings ) ?>
				</div>				
				<div aria-hidden="true" class="deensimc-marquee-group">
					<?php $this->render_marquee_texts( $settings ) ?>
				</div>
			</div>
		</div>
    <?php
    }

	/**
	 * Renders dynamic text marquee contents in Elementor.
	 * @return void
 	*/
	protected function content_template() {
	?>
		<# 
		let marquee_orientation = settings.deensimc_slide_position === 'yes' ? 'vertical' : 'horizontal';
		let slide_direction_class = settings.deensimc_slide_direction === 'yes' ? ' deensimc-marquee-reverse' : '';
		let pause_on_hover = settings.deensimc_pause_on_hover_switch;
		let animation_speed = settings.deensimc_animation_speed_switch;
		let marquee_classes = marquee_orientation + " " + slide_direction_class;
		let show_shadow = settings.deensimc_show_shadow_switch === 'yes' ? 'deensimc-shadow' : 'deensimc-no-shadow';
		#>
		<div class="deensimc-wrapper deensimc-wrapper-{{{ marquee_orientation }}} deensimc-text-marquee">
			<div class="deensimc-marquee {{{ show_shadow }}} deensimc-marquee-{{{ marquee_classes }}}" data-pause-on-hover="{{{ pause_on_hover }}}" data-animation-speed="{{{ animation_speed }}}">
				<div class="deensimc-marquee-group">
					<# _.each(settings.deensimc_repeater_text_main, function(text) { #>
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
					<# _.each(settings.deensimc_repeater_text_main, function(text) { #>
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
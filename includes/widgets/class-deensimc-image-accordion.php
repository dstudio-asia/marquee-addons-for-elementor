<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

// Elementor Classes
use \Elementor\Widget_Base;

/**
 * Class Deensimc_Image_Accordion
 * Widget for displaying an image accordion.
*/
class Deensimc_Image_Accordion extends Widget_Base {

    use ImageAccordion_Contents;
    use ImageAccordion_Styles;

    public function get_name() 
    {
        return 'deensimc-image-accordion';
    }

    public function get_title() 
    {
        return esc_html__( 'Image Accordion', 'marquee-addons-for-elementor' );
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
        return [ 'image' , 'image-accordion', 'accordion'];
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
		if ( isset( $settings['deensimc_images_title_rotating'] ) ) {
			$devices[] = esc_attr( $settings['deensimc_images_title_rotating'] );
		}
		if ( isset( $settings['deensimc_images_title_rotating_laptop'] ) ) {
			$devices[] = esc_attr( $settings['deensimc_images_title_rotating_laptop'] . '-laptop' );
		}
		if ( isset( $settings['deensimc_images_title_rotating_tablet'] ) ) {
			$devices[] = esc_attr( $settings['deensimc_images_title_rotating_tablet'] . '-tab' );
		}
		if ( isset( $settings['deensimc_images_title_rotating_mobile'] ) ) {
			$devices[] = esc_attr( $settings['deensimc_images_title_rotating_mobile'] . '-mobile' );
		}
		if ( isset( $settings['deensimc_images_title_rotating_mobile_extra'] ) ) {
			$devices[] = esc_attr( $settings['deensimc_images_title_rotating_mobile_extra'] . '-mobile-extra' );
		}
		
		$devices_class = implode( ' ', $devices );
    ?>
		<div class="deensimc-image-panel">
			<div class="deensimc-panels">
				<?php
				$deen_accordion_behaviour = $settings['deensimc_bg_image_active_behaviour'] === 'click' ? 'deensimc-click' : 'deensimc-hover';
				if ( $settings['deensimc_bg_image_repeater'] ) {
					foreach( $settings['deensimc_bg_image_repeater'] as $images ) {
				?>
					<div class="<?php echo esc_attr( $deen_accordion_behaviour ); ?> deensimc-panel deensimc-panel-main" style="background-image: url( <?php echo esc_url( $images['deensimc_bg_image']['url'] ) ?> )">
						<p class="<?php echo esc_attr( $devices_class ); ?>">
							<?php echo esc_html( $images['deensimc_bg_image_title'] ) ?>
						</p>
					</div>
				<?php
					}
				}
				?>
			</div>
		</div>
    <?php
	}

    /**
	 * Renders dynamic image accordion contents in Elementor.
	 * @return void
 	*/
	protected function content_template() 
	{
	?>
		<#
    	let devices = [
        settings.deensimc_images_title_rotating,
        settings.deensimc_images_title_rotating_laptop ? settings.deensimc_images_title_rotating_laptop + '-laptop' : '',
        settings.deensimc_images_title_rotating_tablet ? settings.deensimc_images_title_rotating_tablet + '-tab' : '',
        settings.deensimc_images_title_rotating_mobile ? settings.deensimc_images_title_rotating_mobile + '-mobile' : '',
        settings.deensimc_images_title_rotating_mobile_extra ? settings.deensimc_images_title_rotating_mobile_extra + '-mobile-extra' : ''
		].join(' ').trim();
		#>
		<div class="deensimc-image-panel">
			<div class="deensimc-panels">
				<# var deen_accordion_behaviour = settings.deensimc_bg_image_active_behaviour === 'click' ? 'deensimc-click' : 'deensimc-hover'; #>
				<# if ( settings.deensimc_bg_image_repeater ) { #>
					<# _.each( settings.deensimc_bg_image_repeater, function( images ) { #>
						<div class="{{ deen_accordion_behaviour }} deensimc-panel deensimc-panel-main" style="background-image: url( {{{ images.deensimc_bg_image.url }}} )">
							<p class="{{{ devices }}}">{{ images.deensimc_bg_image_title }}</p>
						</div>
					<# }); #>
				<# } #>
			</div>
		</div>
	<?php
	}
}
?>
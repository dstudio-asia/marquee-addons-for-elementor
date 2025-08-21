<?php

use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
  exit;
}

class Deensimc_Button_marquee extends Widget_Base
{
  use Button_Controls;
  use Button_Style_Controls;

  public function get_style_depends()
  {
    return [];
  }

  public function get_script_depends()
  {
    return [];
  }

  public function get_name()
  {
    return 'deensimc_button_marquee';
  }

  public function get_title()
  {
    return __('Button Marquee', 'marquee-addons-for-elementor');
  }

  public function get_icon()
  {
    return 'eicon-button eicon-deensimc';
  }

  public function get_categories()
  {
    return ['deensimc_smooth_marquee'];
  }

  public function get_keywords()
  {
    return ['button', 'animated', 'cta', 'marquee'];
  }

  protected function register_controls()
  {
    $this->register_button_section_controls();
    $this->register_button_style_section_controls();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    $text  = $settings['deensimc_button_text'] ?? __('Button Marquee', 'marquee-addons-for-elementor');
    $link_data  = $settings['deensimc_button_link'];
    $link = $link_data['url'] ?? "#";
    $target = !empty($link_data['is_external']) ? '_blank' : '_self';
    $nofollow = !empty($link_data['nofollow']) ? 'nofollow' : 'follow';
    $custom_attrs = !empty($link_data['custom_attributes']) ? ' ' : '';
    $button_id = $settings['deensimc_button_id'];

    // Icon rendering
    $icon_html = '';
    if (!empty($settings['deensimc_button_icon']['value'])) {
      ob_start();
      Icons_Manager::render_icon($settings['deensimc_button_icon'], ['aria-hidden' => 'true']);
      $icon_html = ob_get_clean();
    }

?>
    <div class="deensimc-button-marquee-container deensimc-button-marquee-on-hover">
      <a href="<?php echo esc_url($link); ?>" class="deensimc-button" id="<?= esc_attr($button_id) ?>" target="<?= esc_attr($target) ?>" rel="<?= esc_attr($nofollow) ?>" <?= esc_attr($custom_attrs) ?>>
        <span class="deensimc-button-marquee-icon"><?php echo  $icon_html; ?></span>
        <span><?php echo esc_html($text); ?></span>
      </a>
      <div class="deensimc-button-marquee-track-wrapper">
        <div class="deensimc-button-marquee-track">
          <?php for ($i = 0; $i < 8; $i++) : ?>
            <span class="deensimc-button-text">
              <span class="deensimc-button-marquee-icon"><?php echo  $icon_html; ?></span>
              <span><?php echo esc_html($text); ?></span>
            </span>
          <?php endfor; ?>
        </div>
        <div class="deensimc-button-marquee-track" aria-hidden="true">
          <?php for ($i = 0; $i < 8; $i++) : ?>
            <span class="deensimc-button-text">
              <span class="deensimc-button-marquee-icon"><?php echo  $icon_html; ?></span>
              <span><?php echo esc_html($text); ?></span>
            </span>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  <?php
  }


  protected function _content_template()
  {
  ?>
    <#
      var text=settings.deensimc_button_text || '<?php echo esc_js(__('Button Marquee', 'marquee-addons-for-elementor')); ?>' ;
      var link_data=settings.deensimc_button_link || {};
      var link=link_data.url ? link_data.url : '#' ;
      var target=link_data.is_external ? ' target="_blank"' : '' ;
      var nofollow=link_data.nofollow ? ' rel="nofollow"' : '' ;
      var customAttr=link_data.custom_attributes ? ' ' + link_data.custom_attributes : '' ;

      var button_id=settings.deensimc_button_id ? settings.deensimc_button_id.replace(/[^A-Za-z0-9_]/g, '' ) : '' ;

      // Icon handling
      var iconHtml='' ;
      if (settings.deensimc_button_icon && settings.deensimc_button_icon.value) {
      var iconElement=elementor.helpers.renderIcon(view, settings.deensimc_button_icon, { 'aria-hidden' : true }, 'i' , 'object' );
      if (iconElement) {
      iconHtml=iconElement.value;
      }
      }

      var attrs=target + nofollow + customAttr;
      #>

      <div class="deensimc-button-marquee-container deensimc-button-marquee-on-hover">
        <a href="{{ link }}" class="deensimc-button" id="{{ button_id }}" {{{ attrs }}}>
          <span class="deensimc-button-marquee-icon">{{{ iconHtml }}}</span>
          <span>{{ text }}</span>
        </a>
        <div class="deensimc-button-marquee-track-wrapper">
          <div class="deensimc-button-marquee-track">
            <# for (var i=0; i < 8; i++) { #>
              <span class="deensimc-button-text">
                <span class="deensimc-button-marquee-icon">{{{ iconHtml }}}</span>
                <span>{{ text }}</span>
              </span>
              <# } #>
          </div>
          <div class="deensimc-button-marquee-track" aria-hidden="true">
            <# for (var i=0; i < 8; i++) { #>
              <span class="deensimc-button-text">
                <span class="deensimc-button-marquee-icon">{{{ iconHtml }}}</span>
                <span>{{ text }}</span>
              </span>
              <# } #>
          </div>
        </div>
      </div>
  <?php
  }
}

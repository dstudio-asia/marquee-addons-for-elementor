<?php

use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
  exit;
}

class Deensimc_Button_marquee extends Widget_Base
{
  use Deensimc_Promotional_Banner;
  use Button_Controls;
  use Button_Style_Controls;
  use Button_Marquee_Controls;

  public function get_style_depends()
  {
    return ['deensimc-button-marquee-style'];
  }

  public function get_script_depends()
  {
    return ['deensimc-button-marquee-script'];
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
    $this->register_button_marquee_section_controls();
    $this->register_button_style_section_controls();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    $text  = $settings['deensimc_button_text'] ?? __('Button Marquee', 'marquee-addons-for-elementor');
    $button_id = $settings['deensimc_button_id'];

    $is_marquee_on      = $settings['deensimc_button_marquee_state'] === 'yes';
    $is_reverse         = $settings['deensimc_button_marquee_direction'] === 'yes';
    $is_marquee_on_hover = $settings['deensimc_button_marquee_on_hover'] === 'yes';
    $marquee_speed      = $settings['deensimc_button_marquee_speed'];

    $conditional_class = [];
    if ($is_reverse) {
      $conditional_class[] = 'deensimc-marquee-reverse';
    }
    if ($is_marquee_on_hover) {
      $conditional_class[] = 'deensimc-button-marquee-on-hover';
    } else {
      $conditional_class[] = 'deensimc-button-marquee-init';
    }

    $link_type = $settings['deensimc_button_link_type'];

    if ($link_type === 'custom') {
      $this->add_link_attributes('button', $settings['deensimc_button_link']);
    } else {
      $this->add_render_attribute('button', 'href', 'javascript:void(0)');

      $video_links = [
        'youtube' => $settings['deensimc_button_yt_video_link'] ?? '',
        'vimeo' => $settings['deensimc_button_vimeo_video_link'] ?? '',
        'hosted' => $settings['deensimc_button_hosted_video_link']['url'] ?? '',
      ];

      if (!empty($video_links[$link_type])) {
        $this->add_render_attribute('button', 'data-link', esc_url($video_links[$link_type]));
      }
    }

    $this->add_render_attribute('button', 'class', 'deensimc-button');
    $this->add_render_attribute('button', 'id', $button_id);
    $this->add_render_attribute('button', 'data-link-type', $link_type);

?>
    <div class="deensimc-marquee-main-container deensimc-button-marquee <?php echo esc_attr(implode(' ', $conditional_class)) ?>" data-is-marquee-on="<?php echo esc_attr($is_marquee_on) ?>" data-marquee-speed="<?php echo esc_attr($marquee_speed) ?>">
      <?php if ($link_type !== 'custom') { ?>
        <div class="deensimc-button-marquee-cl">
          <span class="deensimc-button-marquee-cl-close">×</span>
          <div class="deensimc-button-marquee-video-container"></div>
        </div>
      <?php } ?>
      <a <?php echo $this->get_render_attribute_string('button'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
          ?>>
        <?php if ($settings['deensimc_button_icon']['value']) { ?>
          <span class="deensimc-button-marquee-icon"><?php Icons_Manager::render_icon($settings['deensimc_button_icon'], ['aria-hidden' => 'true']); ?></span>
        <?php } ?>
        <span><?php echo esc_html($text); ?></span>
      </a>
      <?php if ($is_marquee_on) { ?>
        <div class="deensimc-marquee-track-wrapper" aria-hidden="true">
          <div class="deensimc-marquee-track">
            <?php for ($i = 0; $i < 8; $i++) : ?>
              <span class="deensimc-button-text">
                <?php if ($settings['deensimc_button_icon']) { ?>
                  <span class="deensimc-button-marquee-icon"><?php Icons_Manager::render_icon($settings['deensimc_button_icon'], ['aria-hidden' => 'true']); ?></span>
                <?php } ?>
                <span><?php echo esc_html($text); ?></span>
              </span>
            <?php endfor; ?>
          </div>
          <div class="deensimc-marquee-track">
            <?php for ($i = 0; $i < 8; $i++) : ?>
              <span class="deensimc-button-text">
                <?php if ($settings['deensimc_button_icon']) { ?>
                  <span class="deensimc-button-marquee-icon"><?php Icons_Manager::render_icon($settings['deensimc_button_icon'], ['aria-hidden' => 'true']); ?></span>
                <?php } ?>
                <span><?php echo esc_html($text); ?></span>
              </span>
            <?php endfor; ?>
          </div>
        </div>
      <?php } ?>
    </div>
<?php
  }
}

<?php

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
  exit;
}

class Deensimc_Animated_Heading_Widget extends Widget_Base
{
  use Deensimc_Utils;
  use Deensimc_Promotional_Banner;
  use Deensimc_Title_Controls;
  use Deensimc_Animation_Controls;
  use Deensimc_Text_Styles_Controls;
  use Deensimc_Animated_Text_Effect_Controls;

  public function get_style_depends()
  {
    return [
      'deensimc-animated-heading-style'
    ];
  }

  public function get_script_depends()
  {
    return [
      'deensimc-waveSwingTiltLeanAnimation',
      'deensimc-construct-word',
      'deensimc-typing-word',
      'deensimc-twisting-text',
      'deensimc-slide-word',
      'deensimc-lines-animation',
      'deensimc-rotation-3d',
      'deensimc-animated-heading'
    ];
  }

  public function get_name()
  {
    return 'deensimc_animated_heading';
  }

  public function get_title()
  {
    return __('Animated Heading', 'marquee-addons-for-elementor');
  }

  public function get_icon()
  {
    return 'eicon-animated-headline eicon-deensimc';
  }

  public function get_categories()
  {
    return ['deensimc_smooth_marquee'];
  }

  public function get_keywords()
  {
    return ['animation', 'animated', 'heading', 'head', 'header', 'marquee'];
  }

  protected function register_controls()
  {
    $this->register_title_section_controls();
    $this->register_animation_section_controls();
    $this->register_text_styles_section_controls();
    $this->register_animated_text_effect_section_controls();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $tag = self::validate_html_tag( $settings['deensimc_heading_tag'] );
    $before = $settings['deensimc_before_text'] ?? '';
    $after = $settings['deensimc_after_text'] ?? '';
    $texts = $settings['deensimc_animated_texts'] ?? [];
    $animation = $settings['deensimc_animation_type'] ?? '';
    $isAnimationOn = $settings['deensimc_is_animation_on'] ?? '';
    $animationSpeed = $settings['deensimc_animation_speed'] ?? '';
    $isPauseOnHover = $settings['deensimc_animation_pause_on_hover'] ?? '';
    $textEffectType = $settings['deensimc_animated_text_effect_type'] ?? '';
    $pauseBetweenWords = $settings['deensimc_pause_between_words'] ?? '';
    $pauseAfterTyped = $settings['deensimc_pause_after_typed'] ?? '';
    $delayPerWord = $settings['deensimc_delay_per_word'] ?? '';
    $lineType = $settings['deensimc_line_type'] ?? '';
    $delayBeforeErase = $settings['deensimc_delay_before_erase'] ?? '';

    $slideDirection = '';
    if ($animation === 'slide') {
      $slideDirection = $settings['deensimc_slide_vertical_direction'] ?? '';
    } elseif ($animation === 'slide-horizontal') {
      $slideDirection = $settings['deensimc_slide_horizontal_direction'] ?? '';
    }
?>
    <div class="deensimc-animated-heading <?php echo $isAnimationOn === 'yes' ? 'deensimc-animation-on' : 'deensimc-animation-off'; ?>">
      <<?php echo esc_html($tag); ?> class="deensimc-heading <?php echo esc_attr($animation); ?><?php echo ($animation === 'line') ? ' ' . esc_attr($lineType) : ''; ?>">
        <?php if ($before): ?>
          <span class="deensimc-before-text"><?php echo esc_html($before); ?></span>
        <?php endif; ?>

        <?php if (in_array($animation, ['slide', 'slide-horizontal', 'rotation-3d']) && $isAnimationOn === 'yes'): ?>
          <div class="deensimc-animated-text-container">
          <?php endif; ?>

          <?php if (!empty($texts)): ?>
            <span class="deensimc-texts-wrapper <?php echo esc_attr($textEffectType); ?>"
              data-animation="<?php echo esc_attr($animation); ?>"
              data-is-animation-on="<?php echo esc_attr($isAnimationOn); ?>"
              data-animation-speed="<?php echo esc_attr($animationSpeed); ?>"
              data-is-pause-on-hover="<?php echo esc_attr($isPauseOnHover); ?>"
              <?php if ($animation === 'construct'): ?>
              data-pause-between-words="<?php echo esc_attr($pauseBetweenWords); ?>"
              <?php endif; ?>
              <?php if ($animation === 'typing'): ?>
              data-pause-after-typed="<?php echo esc_attr($pauseAfterTyped); ?>"
              <?php endif; ?>
              <?php if (in_array($animation, ['slide', 'slide-horizontal'])): ?>
              data-delay-per-word="<?php echo esc_attr($delayPerWord); ?>"
              data-slide-direction="<?php echo esc_attr($slideDirection); ?>"
              <?php endif; ?>
              <?php if ($animation === 'line'): ?>
              data-line-type="<?php echo esc_attr($lineType); ?>"
              data-delay-before-erase="<?php echo esc_attr($delayBeforeErase); ?>"
              <?php endif; ?>>
              <?php foreach ($texts as $item): ?>
                <span class="deensimc-animated-text"><?php echo esc_html($item['deensimc_animated_text'] ?? ''); ?></span>
              <?php endforeach; ?>

              <?php if ($animation === 'line' && $isAnimationOn === "yes"): ?>
                <svg
                  height="100%"
                  width="100%"
                  class="deensimc-animated-lines"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 500 200"
                  preserveAspectRatio="none"></svg>
              <?php endif; ?>
            </span>
          <?php endif; ?>
          <?php if (in_array($animation, ['slide', 'slide-horizontal', 'rotation-3d']) && $isAnimationOn === 'yes'): ?>
          </div>
        <?php endif; ?>
        <?php if ($after): ?>
          <span class="deensimc-after-text"><?php echo esc_html($after); ?></span>
        <?php endif; ?>
      </<?php echo esc_html($tag); ?>>
    </div>
  <?php
  }

  protected function _content_template()
  {
  ?>
    <div class="deensimc-animated-heading 
      <# if (settings.deensimc_is_animation_on === 'yes') { #>
        deensimc-animation-on
      <# } else { #>
        deensimc-animation-off
      <# } #>">

      <{{{ settings.deensimc_heading_tag || 'h2' }}}
        class="deensimc-heading {{ settings.deensimc_animation_type }} {{ settings.deensimc_animation_type === 'line' ? settings.deensimc_line_type : '' }}">

        <# if (settings.deensimc_before_text) { #>
          <span class="deensimc-before-text">{{{ settings.deensimc_before_text }}}</span>
          <# } #>

            <# if (['slide', 'slide-horizontal' , 'rotation-3d' ].includes(settings.deensimc_animation_type)
              && settings.deensimc_is_animation_on==='yes' ) { #>
              <div class="deensimc-animated-text-container">
                <# } #>

                  <# if (settings.deensimc_animated_texts && settings.deensimc_animated_texts.length) { #>
                    <span
                      class="deensimc-texts-wrapper {{ settings.deensimc_animated_text_effect_type }}"
                      data-animation="{{ settings.deensimc_animation_type }}"
                      data-is-animation-on="{{ settings.deensimc_is_animation_on }}"
                      data-animation-speed="{{ settings.deensimc_animation_speed }}"
                      data-is-pause-on-hover="{{ settings.deensimc_animation_pause_on_hover }}"

                      <# if (settings.deensimc_animation_type==='construct' ) { #>
                      data-pause-between-words="{{ settings.deensimc_pause_between_words }}"
                      <# } #>

                        <# if (settings.deensimc_animation_type==='typing' ) { #>
                          data-pause-after-typed="{{ settings.deensimc_pause_after_typed }}"
                          <# } #>

                            <# if (['slide', 'slide-horizontal' ].includes(settings.deensimc_animation_type)) { #>
                              data-delay-per-word="{{ settings.deensimc_delay_per_word }}"
                              <# if (settings.deensimc_animation_type==='slide' ) { #>
                                data-slide-direction="{{ settings.deensimc_slide_vertical_direction }}"
                                <# } else if (settings.deensimc_animation_type==='slide-horizontal' ) { #>
                                  data-slide-direction="{{ settings.deensimc_slide_horizontal_direction }}"
                                  <# } #>
                                    <# } #>

                                      <# if (settings.deensimc_animation_type==='line' ) { #>
                                        data-line-type="{{ settings.deensimc_line_type }}"
                                        data-delay-before-erase="{{ settings.deensimc_delay_before_erase }}"
                                        <# } #>
                                          >
                                          <# _.each(settings.deensimc_animated_texts, function(item) { #>
                                            <span class="deensimc-animated-text">{{{ item.deensimc_animated_text }}}</span>
                                            <# }); #>

                                              <# if (settings.deensimc_animation_type==='line' && settings.deensimc_is_animation_on==='yes' ) { #>
                                                <svg
                                                  height="100%"
                                                  width="100%"
                                                  class="deensimc-animated-lines"
                                                  xmlns="http://www.w3.org/2000/svg"
                                                  viewBox="0 0 500 200"
                                                  preserveAspectRatio="none"></svg>
                                                <# } #>
                    </span>
                    <# } #>

                      <# if (['slide', 'slide-horizontal' , 'rotation-3d' ].includes(settings.deensimc_animation_type)
                        && settings.deensimc_is_animation_on==='yes' ) { #>
              </div>
              <# } #>

                <# if (settings.deensimc_after_text) { #>
                  <span class="deensimc-after-text">{{{ settings.deensimc_after_text }}}</span>
                  <# } #>

      </{{{ settings.deensimc_heading_tag || 'h2' }}}>
    </div>
<?php
  }
}

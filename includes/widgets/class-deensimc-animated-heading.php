<?php

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
  exit;
}

class Animated_Heading_Widget extends Widget_Base
{
  use Title_Controls, Animation_Controls, Text_Styles_Controls, Animated_Text_Effect_Controls;

  public function get_style_depends()
  {
    return [
      'deensimc-common-style',
      'deensimc-animations-style',
      'deensimc-animated-heading-style'
    ];
  }

  public function get_script_depends()
  {
    return [
      'deensimc-waveSwingTiltLeanAnimation',
      'deensimc-construct-word',
      'deensimc-typing-word',
      'deensimc-twisting-word',
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
    $tag = $settings['heading_tag'] ?? 'h2';
    $before = esc_html($settings['before_text']);
    $after = esc_html($settings['after_text']);
    $texts = $settings['animated_texts'];
    $animation = esc_attr($settings['deensimc_animation_type']);
    $isAnimationOn = esc_attr($settings['deensimc_is_animation_on']);
    $animationSpeed = esc_attr($settings['animation_speed']);
    $isPauseOnHover = esc_attr($settings['animation_pause_on_hover']);
    $textEffectType = esc_attr($settings['deensimc_animated_text_effect_type']);
    $pauseBetweenWords = esc_attr($settings['pause_between_words']);
    $pauseAfterTyped = esc_attr($settings['pause_after_typed']);
    $delayPerWord = esc_attr($settings['delay_per_word']);
    $lineType = esc_attr($settings['line_type']);
    $delayBeforeErase = esc_attr($settings['delay_before_erase']);
    $slideDirection = '';
    if ($animation === 'slide') {
      $slideDirection = esc_attr($settings['slide_vertical_direction']);
    } elseif ($animation === 'slide-horizontal') {
      $slideDirection = esc_attr($settings['slide_horizontal_direction']);
    }
?>
    <div class="deensimc-animated-heading <?php echo $isAnimationOn === 'yes' ? 'deensimc-animation-on' : 'deensimc-animation-off'; ?>">
      <<?php echo esc_attr($tag); ?> class="deensimc-heading <?php echo $animation; ?> <?php if ($animation === 'line') {
                                                                                          echo $lineType;
                                                                                        } ?>">
        <?php if ($before): ?>
          <span class="deensimc-before-text"><?php echo $before; ?></span>
        <?php endif; ?>

        <?php if (in_array($animation, ['slide', 'slide-horizontal', 'rotation-3d']) && $isAnimationOn === 'yes'): ?>
          <div class="deensimc-animated-text-container">
          <?php endif; ?>

          <?php if (!empty($texts)): ?>
            <span class="deensimc-texts-wrapper <?php echo $textEffectType; ?>"
              data-animation="<?php echo $animation; ?>"
              data-is-animation-on="<?php echo $isAnimationOn; ?>"
              data-animation-speed="<?php echo $animationSpeed; ?>"
              data-is-pause-on-hover="<?php echo $isPauseOnHover; ?>"
              <?php if ($animation === 'construct'): ?>
              data-pause-between-words="<?php echo $pauseBetweenWords; ?>"
              <?php endif; ?>
              <?php if ($animation === 'typing'): ?>
              data-pause-after-typed="<?php echo $pauseAfterTyped; ?>"
              <?php endif; ?>
              <?php if (in_array($animation, ['slide', 'slide-horizontal'])): ?>
              data-delay-per-word="<?php echo $delayPerWord; ?>"
              data-slide-direction="<?php echo $slideDirection; ?>"
              <?php endif; ?>
              <?php if ($animation === 'line'): ?>
              data-line-type="<?php echo $lineType; ?>"
              data-delay-before-erase="<?php echo $delayBeforeErase; ?>"
              <?php endif; ?>>
              <?php foreach ($texts as $item): ?>
                <span class="deensimc-animated-text"><?php echo esc_html($item['animated_text']); ?></span>
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
          <span class="deensimc-after-text"><?php echo $after; ?></span>
        <?php endif; ?>
      </<?php echo esc_attr($tag); ?>>
    </div>
  <?php
  }

  protected function _content_template()
  {
  ?>
    <div class="deensimc-animated-heading 
  <# if (settings.deensimc_is_animation_on === 'yes') { #>deensimc-animation-on<# } else { #>deensimc-animation-off<# } #>">

      <{{{ settings.heading_tag || 'h2' }}} class="deensimc-heading {{ settings.deensimc_animation_type }} {{ settings.deensimc_animation_type === 'line' ? settings.line_type : '' }}">
        <# if (settings.before_text) { #>
          <span class="deensimc-before-text">{{{ settings.before_text }}}</span>
          <# } #>

            <# if (['slide', 'slide-horizontal' , 'rotation-3d' ].includes(settings.deensimc_animation_type) && settings.deensimc_is_animation_on==='yes' ) { #>
              <div class="deensimc-animated-text-container">
                <# } #>

                  <# if (settings.animated_texts && settings.animated_texts.length) { #>
                    <span
                      class="deensimc-texts-wrapper {{ settings.deensimc_animated_text_effect_type }}"
                      data-animation="{{ settings.deensimc_animation_type }}"
                      data-is-animation-on="{{ settings.deensimc_is_animation_on }}"
                      data-animation-speed="{{ settings.animation_speed }}"
                      data-is-pause-on-hover="{{ settings.animation_pause_on_hover }}"

                      <# if (settings.deensimc_animation_type==='construct' ) { #>
                      data-pause-between-words="{{ settings.pause_between_words }}"
                      <# } #>

                        <# if (settings.deensimc_animation_type==='typing' ) { #>
                          data-pause-after-typed="{{ settings.pause_after_typed }}"
                          <# } #>

                            <# if (['slide', 'slide-horizontal' ].includes(settings.deensimc_animation_type)) { #>
                              data-delay-per-word="{{ settings.delay_per_word }}"
                              <# if (settings.deensimc_animation_type==='slide' ) { #>
                                data-slide-direction="{{ settings.slide_vertical_direction }}"
                                <# } else if (settings.deensimc_animation_type==='slide-horizontal' ) { #>
                                  data-slide-direction="{{ settings.slide_horizontal_direction }}"
                                  <# } #>
                                    <# } #>

                                      <# if (settings.deensimc_animation_type==='line' ) { #>
                                        data-line-type="{{ settings.line_type }}"
                                        data-delay-before-erase="{{ settings.delay_before_erase }}"
                                        <# } #>
                                          >
                                          <# _.each(settings.animated_texts, function(item) { #>
                                            <span class="deensimc-animated-text">{{{ item.animated_text }}}</span>
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

                      <# if (['slide', 'slide-horizontal' , 'rotation-3d' ].includes(settings.deensimc_animation_type) && settings.deensimc_is_animation_on==='yes' ) { #>
              </div>
              <# } #>

                <# if (settings.after_text) { #>
                  <span class="deensimc-after-text">{{{ settings.after_text }}}</span>
                  <# } #>

      </{{{ settings.heading_tag || 'h2' }}}>
    </div>
<?php
  }
}

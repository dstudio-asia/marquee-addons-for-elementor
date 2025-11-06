<?php

use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
  exit;
}

class Deensimc_Search_Widget extends Widget_Base
{
  use Deensimc_Search_Field_Content_Controls;
  use Deensimc_Search_Field_Query_Controls;
  public function get_style_depends()
  {
    return ['deensimc-search-style'];
  }

  public function get_script_depends()
  {
    return ['deensimc-search-script'];
  }

  public function get_name()
  {
    return 'deensimc_search';
  }

  public function get_title()
  {
    return __('Search', 'marquee-addons-for-elementor');
  }

  public function get_icon()
  {
    return 'eicon-search eicon-deensimc';
  }

  public function get_categories()
  {
    return ['deensimc_smooth_marquee'];
  }

  public function get_keywords()
  {
    return ['marquee', 'search', 'deen'];
  }

  protected function register_controls()
  {
    $this->register_content_control();
    $this->register_content_section_query();
  }

  protected function get_all_terms()
  {
    $all_terms = get_terms([
      'hide_empty' => false,
    ]);

    $options = [];
    if (!empty($all_terms) && !is_wp_error($all_terms)) {
      foreach ($all_terms as $term) {
        $options[$term->term_id] = $term->name;
      }
    }
    return $options;
  }

  protected function get_all_authors()
  {
    $all_authors = get_users();

    $options = [];
    if (!empty($all_authors) && !is_wp_error($all_authors)) {
      foreach ($all_authors as $author) {
        $options[$author->ID] = $author->display_name;
      }
    }
    return $options;
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $style = $settings['deensimc_search_style'];

?>
    <form action="" class="deensimc-search-form <?php echo esc_attr($style === 'expand' ? 'deensimc-left-input' : 'deensimc-popup-input') ?>">
      <div class="deensimc-input-container">
        <div class="deensimc-input-field-wrapper">
          <span class="deensimc-input-field-icon">
            <?php Icons_Manager::render_icon($settings['deensimc_search_icon'], ['aria-hidden' => 'true']); ?>
          </span>
          <input
            type="text"
            class="deensimc-input-field"
            placeholder="<?php echo esc_attr($settings['deensimc_search_placeholder_text']); ?>"
            <?php echo ($settings['deensimc_search_autocomplete'] === 'yes' ? 'autocomplete="on"' : 'autocomplete="off"'); ?> />
          <button
            type="button"
            class="deensimc-input-field-icon deensimc-input-field-clear-button">
            <?php Icons_Manager::render_icon($settings['deensimc_search_clear_button_icon'], ['aria-hidden' => 'true']); ?>
          </button>
        </div>
        <?php if ('popup' === $style) : ?>
          <button type="submit" class="deensimc-search-submit-button">
            <?php echo esc_html($settings['deensimc_search_submit_button_text']); ?>
            <?php Icons_Manager::render_icon($settings['deensimc_search_submit_button_icon'], ['aria-hidden' => 'true']); ?>
          </button>
        <?php endif; ?>
        <button type="button" class="deensimc-search-input-triggerer">
          <?php Icons_Manager::render_icon([
            'value' => 'fas fa-search',
            'library' => 'solid',
          ], ['aria-hidden' => 'true']); ?>
        </button>
      </div>
    </form>
<?php
  }
}

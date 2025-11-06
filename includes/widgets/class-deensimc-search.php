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

  protected function get_query_args()
  {
    $settings = $this->get_settings_for_display();
    $args = [];

    // Source
    $source = $settings['deensimc_search_source'];
    if ('all' !== $source) {
      $args['post_type'] = $source;
    }

    // Include By
    if (!empty($settings['deensimc_search_include_by'])) {
      foreach ($settings['deensimc_search_include_by'] as $include_type) {
        if ('term' === $include_type && !empty($settings['deensimc_include_terms'])) {
          $args['tax_query'][] = [
            'taxonomy' => 'category', // Assuming 'category' for terms, needs to be dynamic if multiple taxonomies are supported
            'field' => 'term_id',
            'terms' => $settings['deensimc_include_terms'],
          ];
        } elseif ('author' === $include_type && !empty($settings['deensimc_include_authors'])) {
          $args['author__in'] = $settings['deensimc_include_authors'];
        }
      }
    }

    // Exclude By
    if (!empty($settings['deensimc_search_exclude_by'])) {
      foreach ($settings['deensimc_search_exclude_by'] as $exclude_type) {
        if ('term' === $exclude_type && !empty($settings['deensimc_exclude_terms'])) {
          $args['tax_query'][] = [
            'taxonomy' => 'category', // Assuming 'category' for terms, needs to be dynamic if multiple taxonomies are supported
            'field' => 'term_id',
            'terms' => $settings['deensimc_exclude_terms'],
            'operator' => 'NOT IN',
          ];
        } elseif ('author' === $exclude_type && !empty($settings['deensimc_exclude_authors'])) {
          $args['author__not_in'] = $settings['deensimc_exclude_authors'];
        }
      }
    }

    // Date Query
    $date_query = $settings['deensimc_search_date_query'];
    if ('all' !== $date_query) {
      $date_args = [];
      switch ($date_query) {
        case 'past_day':
          $date_args = ['after' => '1 day ago'];
          break;
        case 'past_week':
          $date_args = ['after' => '1 week ago'];
          break;
        case 'past_month':
          $date_args = ['after' => '1 month ago'];
          break;
        case 'past_quarter':
          $date_args = ['after' => '3 months ago'];
          break;
        case 'past_year':
          $date_args = ['after' => '1 year ago'];
          break;
        case 'custom':
          // Custom date range logic would go here if implemented in controls
          break;
      }
      if (!empty($date_args)) {
        $args['date_query'][] = $date_args;
      }
    }

    // Order By
    $args['orderby'] = $settings['deensimc_search_orderby'];
    $args['order'] = $settings['deensimc_search_order'];

    return $args;
  }

  protected function render()
  {
    $settings      = $this->get_settings_for_display();
    $style         = $settings['deensimc_search_style'] ?? 'expand';
    $search_query  = get_search_query();
    $query_args    = $this->get_query_args();
    $query_args['s'] = $search_query;

    // Common values
    $placeholder   = $settings['deensimc_search_placeholder_text'] ?? esc_html__('Search...', 'textdomain');
    $autocomplete  = !empty($settings['deensimc_search_autocomplete']) && $settings['deensimc_search_autocomplete'] === 'yes' ? 'on' : 'off';

    // Button text/icon settings
    $submit_text   = $settings['deensimc_search_submit_button_text'] ?? '';
    $submit_icon   = $settings['deensimc_search_submit_button_icon'] ?? '';
    $has_submit_icon = !empty($submit_icon['value']);
    $has_submit_text = !empty($submit_text);

?>
    <form action="<?php echo esc_url(home_url('/')); ?>"
      class="deensimc-search-form <?php echo esc_attr($style === 'expand' ? 'deensimc-left-input' : 'deensimc-popup-input'); ?>">

      <div class="deensimc-input-container">
        <div class="deensimc-input-field-wrapper">

          <!-- Search Icon -->
          <span class="deensimc-input-field-icon">
            <?php
            if (!empty($settings['deensimc_search_icon']['value'])) {
              Icons_Manager::render_icon($settings['deensimc_search_icon'], ['aria-hidden' => 'true']);
            }
            ?>
          </span>

          <!-- Search Input -->
          <input
            type="text"
            class="deensimc-input-field"
            name="s"
            value="<?php echo esc_attr($search_query); ?>"
            placeholder="<?php echo esc_attr($placeholder); ?>"
            autocomplete="<?php echo esc_attr($autocomplete); ?>" />

          <!-- Clear Button -->
          <button type="button" class="deensimc-input-field-icon deensimc-input-field-clear-button">
            <?php
            if (!empty($settings['deensimc_search_clear_button_icon']['value'])) {
              Icons_Manager::render_icon($settings['deensimc_search_clear_button_icon'], ['aria-hidden' => 'true']);
            }
            ?>
          </button>

          <!-- Popup submit button (optional) -->
          <?php if ('popup' === $style && ($has_submit_icon || $has_submit_text)) : ?>
            <button type="submit" class="deensimc-search-submit-button">
              <?php
              if ($has_submit_icon) {
                Icons_Manager::render_icon($submit_icon, ['aria-hidden' => 'true']);
              }
              if ($has_submit_text) {
                echo esc_html($submit_text);
              }
              ?>
            </button>
          <?php endif; ?>
        </div>

        <!-- Trigger button (always shown) -->
        <button type="button" class="deensimc-search-input-triggerer">
          <?php
          Icons_Manager::render_icon(
            ['value' => 'fas fa-search', 'library' => 'solid'],
            ['aria-hidden' => 'true']
          );
          ?>
        </button>
      </div>
    </form>
<?php
  }
}

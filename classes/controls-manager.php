<?php

/**
 * Control Manager for Marquee Addons
 * 
 * This file handles the admin settings page for enabling/disabling widgets
 */

namespace Deensimc_Marquee;

if (!defined('ABSPATH')) exit;


class Control_Manager
{
    use Manifest_Loader;

    private static $_instance = null;
    private $is_pro_active = false;

    // Caching properties
    private $all_widgets = null;
    private $widget_settings = null;
    private $widget_statuses = [];

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->is_pro_active = $this->check_pro_version();

        // Load and cache data once
        $this->load_and_cache_data();

        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('admin_init', [$this, 'initialize_default_settings']);
        add_action('wp_ajax_deensimc_get_template_json', [$this, 'deensimc_ajax_get_template_json']);
    }

    /**
     * AJAX handler: return a single template's JSON from templates.json
     */
    public function deensimc_ajax_get_template_json()
    {
        check_ajax_referer('deensimc_nonce', 'nonce');

        $template_id = sanitize_text_field($_POST['template_id']);
        $file = DEENSIMC_PATH . 'templates.json';

        if (!file_exists($file)) {
            wp_send_json_error('Template file not found at: ' . $file);
        }

        $content = file_get_contents($file);
        $data = json_decode($content, true);

        if (!isset($data['templates'])) {
            wp_send_json_error('Invalid templates.json structure.');
        }

        foreach ($data['templates'] as $template) {
            if ($template['id'] === $template_id) {
                $json_string = json_encode($template['json'], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                wp_send_json_success($json_string);
            }
        }

        wp_send_json_error('Template not found.');
    }

    /**
     * Load manifest data and settings from DB, then compute widget statuses.
     */
    private function load_and_cache_data()
    {
        $this->all_widgets = $this->get_all_widgets();
        $this->widget_settings = get_option('marquee_addons_widgets', []);
        $this->prepare_widget_statuses();
    }

    /**
     * Pre-calculates and caches the enabled/disabled status of all widgets.
     */
    private function prepare_widget_statuses()
    {
        if (empty($this->all_widgets)) {
            return;
        }
        
        foreach ($this->all_widgets as $key => $widget) {
            $is_pro = !empty($widget['is_pro']);

            // Pro widgets that aren't active are always disabled
            if ($is_pro && !$this->is_pro_active) {
                $this->widget_statuses[$key] = false;
                continue;
            }

            // If a setting exists for the widget, use it
            if (isset($this->widget_settings[$key])) {
                $this->widget_statuses[$key] = ($this->widget_settings[$key] === 'on');
            } else {
                // Default behaviors for widgets without a saved setting
                if ($is_pro && $this->is_pro_active) {
                    // New PRO widgets are enabled by default when PRO is active
                    $this->widget_statuses[$key] = true;
                } elseif (!$is_pro) {
                    // Free widgets are enabled by default
                    $this->widget_statuses[$key] = true;
                } else {
                    $this->widget_statuses[$key] = false;
                }
            }
        }
    }


    /**
     * Check if PRO version is active
     */
    private function check_pro_version()
    {
        return class_exists('\Deensimcpro_Marquee\Marqueepro');
    }

    /**
     * Initialize default settings for all widgets
     */
    public function initialize_default_settings()
    {
        if (empty($this->widget_settings) && !empty($this->all_widgets)) {
            $default_settings = [];
            foreach ($this->all_widgets as $key => $widget) {
                $is_pro_locked = !empty($widget['is_pro']) && !$this->is_pro_active;
                if (!$is_pro_locked) {
                    $default_settings[$key] = 'on';
                }
            }
            update_option('marquee_addons_widgets', $default_settings);
            // Refresh cache after updating options
            $this->widget_settings = $default_settings;
            $this->prepare_widget_statuses();
        }
    }

    /**
     * Add settings page to WordPress admin menu
     */
    public function add_settings_page()
    {
        add_menu_page(
            __('Marquee Addons', 'marquee-addons-for-elementor'),
            __('Marquee Addons', 'marquee-addons-for-elementor'),
            'manage_options',
            'marquee-addons-settings',
            [$this, 'render_settings_page'],
            DEENSIMC_ASSETS_URL . 'images/logo.png',
            59
        );

        add_submenu_page(
            'marquee-addons-settings',
            __('Element Manger', 'marquee-addons-for-elementor'),
            __('Element Manager', 'marquee-addons-for-elementor'),
            'manage_options',
            'marquee-addons-settings',
            [$this, 'render_settings_page']
        );

        add_submenu_page(
            'marquee-addons-settings',
            __('Templates', 'marquee-addons-for-elementor'),
            __('Templates', 'marquee-addons-for-elementor'),
            'manage_options',
            'marquee-addons-templates',
            [$this, 'render_template_page']
        );
    }

    /**
     * Register plugin settings
     */
    public function register_settings()
    {
        register_setting(
            'marquee_addons_settings',
            'marquee_addons_widgets',
            [
                'sanitize_callback' => [$this, 'sanitize_widgets_settings']
            ]
        );
    }

    /**
     * Sanitize widgets settings before saving
     */
    public function sanitize_widgets_settings($input)
    {
        $sanitized = [];

        if (!isset($_POST['marquee_addons_widgets_submitted'])) {
            return $this->widget_settings;
        }
        
        $current_settings = $this->widget_settings;
        $all_widgets = $this->get_all_widgets();

        if(empty($all_widgets)) {
            return $sanitized;
        }

        foreach ($all_widgets as $key => $widget) {
            $is_pro_locked = !empty($widget['is_pro']) && !$this->is_pro_active;

            if ($is_pro_locked) {
                if (isset($current_settings[$key])) {
                    $sanitized[$key] = $current_settings[$key];
                }
            } else {
                $sanitized[$key] = (isset($input[$key]) && $input[$key] === 'on') ? 'on' : '';
            }
        }

        return $sanitized;
    }

    /**
     * Enqueue admin styles and scripts
     */
    public function enqueue_admin_scripts($hook)
    {
        if ('toplevel_page_marquee-addons-settings' !== $hook) {
            return;
        }

        wp_enqueue_style(
            'marquee-addons-admin',
            DEENSIMC_ASSETS_URL . 'css/admin/admin.css',
            [],
            DEENSIMC_VERSION
        );

        wp_enqueue_script(
            'marquee-addons-admin',
            DEENSIMC_ASSETS_URL . 'js/admin/admin.js',
            ['jquery'],
            DEENSIMC_VERSION,
            true
        );
    }

    /**
     * Get all widgets from the manifest file.
     */
    public function get_all_widgets()
    {
        if ($this->all_widgets === null) {
            $this->all_widgets = self::get_manifest();
        }

        return $this->all_widgets;
    }

    /**
     * Get widgets by category from the cached list.
     */
    public function get_widgets_by_category($category)
    {
        if (empty($this->all_widgets)) {
            return [];
        }
        return array_filter($this->all_widgets, function ($widget) use ($category) {
            return isset($widget['cat']) && $widget['cat'] === $category;
        });
    }

    /**
     * Check if a widget is enabled from the cached statuses.
     */
    public function is_widget_enabled($widget_key)
    {
        return isset($this->widget_statuses[$widget_key]) && $this->widget_statuses[$widget_key];
    }

    /**
     * Get list of disabled widgets from the cached statuses.
     */
    public function get_disabled_widgets()
    {
        return array_keys(array_filter($this->widget_statuses, function ($is_enabled) {
            return !$is_enabled;
        }));
    }

    /**
     * Render the settings page
     */
    public function render_settings_page()
    {
        $categories = [
            'general' => [
                'title' => __('General Widgets', 'marquee-addons-for-elementor'),
            ],
            'woocommerce' => [
                'title' => __('WooCommerce Widgets', 'marquee-addons-for-elementor'),
            ],
            'extensions' => [
                'title' => __('Features', 'marquee-addons-for-elementor'),
            ]
        ];

        require DEENSIMC__DIR__ . '/includes/admin/views/settings-page-view.php';
    }

    /**
     * Get template metadata from templates.json (only id, name, image_url, preview_url)
     */
    public function deensimc_get_templates_metadata()
    {
        $file = DEENSIMC_PATH . 'templates.json';
        if (!file_exists($file)) {
            return [];
        }

        $content = file_get_contents($file);
        $data = json_decode($content, true);

        if (!isset($data['templates'])) {
            return [];
        }

        $metadata = [];
        foreach ($data['templates'] as $template) {
            $metadata[] = [
                'id'          => $template['id'],
                'name'        => $template['name'],
                'image_url'   => $template['image_url'],
                'preview_url' => $template['preview_url'],
            ];
        }
        return $metadata;
    }

    /**
     * Render the template library page
     */
    public function render_template_page()
    {
        $templates = $this->deensimc_get_templates_metadata();
        $nonce     = wp_create_nonce( 'deensimc_nonce' );
        $is_pro    = $this->is_pro_active;
        ?>
        <div class="wrap deensimc-wrap">
            <h1><?php esc_html_e( 'Template Library', 'marquee-addons-for-elementor' ); ?></h1>
            <div class="deensimc-grid">
                <?php foreach ( $templates as $template ) : ?>
                    <div class="deensimc-card" data-template-id="<?php echo esc_attr( $template['id'] ); ?>">
                        <div class="deensimc-card-image">
                            <img src="<?php echo esc_url( $template['image_url'] ); ?>" 
                                alt="<?php echo esc_attr( $template['name'] ); ?>" loading="lazy">
                        </div>
                        <div class="deensimc-card-content">
                            <h3>
                                <?php echo esc_html( $template['name'] ); ?>
                                 <span class="deensimc-pro-template"><?php esc_html_e( 'Pro', 'marquee-addons-for-elementor' ); ?></span>
                            </h3>
                            <div class="deensimc-actions">
                                <a href="<?php echo esc_url( $template['preview_url'] ); ?>" 
                                class="deensimc-tem-btn deensimc-btn-preview" target="_blank">
                                    <?php esc_html_e( 'Preview', 'marquee-addons-for-elementor' ); ?>
                                </a>

                                <?php if ( $is_pro ) : ?>
                                    <!-- Pro user: functional copy button -->
                                    <button type="button" 
                                            class="deensimc-tem-btn deensimc-btn-copy" 
                                            data-nonce="<?php echo esc_attr( $nonce ); ?>">
                                        <?php esc_html_e( 'Copy', 'marquee-addons-for-elementor' ); ?>
                                    </button>
                                <?php else : ?>
                                    <!-- Free user: locked button with always‑visible lock + Pro badge -->
                                    <button type="button" 
                                            class="deensimc-tem-btn deensimc-btn-copy deensimc-btn-locked" 
                                            disabled 
                                            title="<?php esc_attr_e( 'Available in Pro version', 'marquee-addons-for-elementor' ); ?>">
                                        <span class="dashicons dashicons-lock"></span>
                                        <?php esc_html_e( 'Copy', 'marquee-addons-for-elementor' ); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

// Initialize the Control Manager
Control_Manager::instance();

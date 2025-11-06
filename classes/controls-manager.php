<?php
/**
 * Control Manager for Marquee Addons
 * 
 * This file handles the admin settings page for enabling/disabling widgets
 */

namespace MarqueeAddons;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Control_Manager {
    
    private static $_instance = null;
    
    private $is_pro_active = false;
    
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct() {
        // Check if PRO version is active
        $this->is_pro_active = $this->check_pro_version();
        
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
    }
    
    /**
     * Check if PRO version is active
     * Modify this method based on your PRO plugin structure
     */
    private function check_pro_version() {
        // Option 1: Check if PRO plugin file exists and is active
        if (defined('MARQUEE_ADDONS_PRO_VERSION')) {
            return true;
        }
        
        // Option 2: Check if PRO plugin is in active plugins list
        if (in_array('marquee-addons-pro/marquee-addons-pro.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            return true;
        }
        
        // Option 3: Check via function exists
        if (function_exists('marquee_addons_pro_init')) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Add settings page to WordPress admin menu
     */
    public function add_settings_page() {
        add_menu_page(
            __('Marquee Addons', 'marquee-addons'),
            __('Marquee Addons', 'marquee-addons'),
            'manage_options',
            'marquee-addons-settings',
            [$this, 'render_settings_page'],
            'dashicons-admin-generic',
            59
        );
    }
    
    /**
     * Register plugin settings
     */
    public function register_settings() {
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
    public function sanitize_widgets_settings($input) {
        $sanitized = [];
        
        // Check if form was actually submitted (vs just retrieving the option)
        if (!isset($_POST['marquee_addons_widgets_submitted'])) {
            // If not submitted, return input as-is (this is just a get operation)
            return $input;
        }
        
        // Process each widget
        foreach ($this->get_widgets_list() as $key => $widget) {
            // Check if the widget is PRO and PRO is not active
            $is_pro_locked = $widget['is_pro'] && !$this->is_pro_active;
            
            if ($is_pro_locked) {
                // Force PRO widgets to be disabled if PRO is not active
                $sanitized[$key] = '';
            } else {
                // For available widgets, save 'on' if checked, '' if not checked
                // Checkbox only appears in $_POST if it's checked
                $sanitized[$key] = (isset($input[$key]) && $input[$key] === 'on') ? 'on' : '';
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Enqueue admin styles and scripts
     */
    public function enqueue_admin_scripts($hook) {
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
     * Get default widget list
     * These keys must match the keys in Widgets_Manager
     */
    public function get_widgets_list() {
        return [
            'image-marquee' => [
                'title' => __('Image Marquee', 'marquee-addons'),
                'description' => __('Create stunning image marquee effects', 'marquee-addons'),
                'icon' => 'dashicons-images-alt2',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing' // Change this URL
            ],
            'media-marquee' => [
                'title' => __('Media Marquee', 'marquee-addons'),
                'description' => __('Create stunning image marquee effects', 'marquee-addons'),
                'icon' => 'dashicons-images-alt2',
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing' // Change this URL
            ],
            'stacked-slider' => [
                'title' => __('Stacked Slider', 'marquee-addons'),
                'description' => __('Modern stacked card slider with smooth transitions', 'marquee-addons'),
                'icon' => 'dashicons-slides',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'image-accordion' => [
                'title' => __('Image Accordion', 'marquee-addons'),
                'description' => __('Interactive accordion with beautiful images', 'marquee-addons'),
                'icon' => 'dashicons-list-view',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'text-marquee' => [
                'title' => __('Text Marquee', 'marquee-addons'),
                'description' => __('Scrolling text with customizable effects', 'marquee-addons'),
                'icon' => 'dashicons-text',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'testimonial-marquee' => [
                'title' => __('Testimonial Marquee', 'marquee-addons'),
                'description' => __('Display testimonials in marquee style', 'marquee-addons'),
                'icon' => 'dashicons-testimonial',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'video-marquee' => [
                'title' => __('Video Marquee', 'marquee-addons'),
                'description' => __('Video carousel with marquee effect', 'marquee-addons'),
                'icon' => 'dashicons-video-alt3',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'news-ticker' => [
                'title' => __('News Ticker', 'marquee-addons'),
                'description' => __('Dynamic news ticker with multiple layouts', 'marquee-addons'),
                'icon' => 'dashicons-megaphone',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'animated-word-roller' => [
                'title' => __('Animated Word Roller', 'marquee-addons'),
                'description' => __('Rolling text animation effects', 'marquee-addons'),
                'icon' => 'dashicons-update',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'animated-heading' => [
                'title' => __('Animated Heading', 'marquee-addons'),
                'description' => __('Eye-catching animated headings', 'marquee-addons'),
                'icon' => 'dashicons-editor-textcolor',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
            'button-marquee' => [
                'title' => __('Button Marquee', 'marquee-addons'),
                'description' => __('Scrolling buttons with marquee effect', 'marquee-addons'),
                'icon' => 'dashicons-button',
                'is_pro' => false,
                'pro_url' => 'https://marqueeaddons.com/pricing'
            ],
        ];
    }
    
    /**
     * Check if a widget is enabled
     */
    public function is_widget_enabled($widget_key) {
        $widgets_list = $this->get_widgets_list();
        
        // Check if widget is PRO and PRO version is not active
        if (isset($widgets_list[$widget_key]) && $widgets_list[$widget_key]['is_pro'] && !$this->is_pro_active) {
            return false;
        }
        
        $widgets = get_option('marquee_addons_widgets', []);
        
        // If option doesn't exist (first time), enable all non-PRO widgets by default
        if (empty($widgets)) {
            // For PRO widgets, return false if PRO not active
            if (isset($widgets_list[$widget_key]) && $widgets_list[$widget_key]['is_pro']) {
                return false;
            }
            return true;
        }
        
        // Check the saved value - must be exactly 'on' to be enabled
        return isset($widgets[$widget_key]) && $widgets[$widget_key] === 'on';
    }
    
    /**
     * Get list of disabled widgets
     * Use this in your main plugin file to prevent widget registration
     */
    public function get_disabled_widgets() {
        $disabled = [];
        $widgets = get_option('marquee_addons_widgets', []);
        
        foreach ($this->get_widgets_list() as $key => $widget) {
            if (!$this->is_widget_enabled($key)) {
                $disabled[] = $key;
            }
        }
        
        return $disabled;
    }
    
    /**
     * Render the settings page
     */
    public function render_settings_page() {
        $widgets = get_option('marquee_addons_widgets', []);
        $general = get_option('marquee_addons_general', []);
        ?>
        <div class="wrap marquee-addons-settings">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <div class="marquee-settings-container">
                <!-- Tabs Navigation -->
                <div class="marquee-tabs">
                    <button class="marquee-tab-btn active" data-tab="widgets">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <?php _e('Widgets', 'marquee-addons'); ?>
                    </button>
                </div>
                
                <form method="post" action="options.php">
                    <?php settings_fields('marquee_addons_settings'); ?>
                    
                    <!-- Hidden field to track that form was submitted -->
                    <input type="hidden" name="marquee_addons_widgets_submitted" value="1">
                    
                    <!-- Widgets Tab -->
                    <div class="marquee-tab-content active" id="tab-widgets">
                        <div class="marquee-section">
                            <div class="marquee-section-header">
                                <h2><?php _e('Enable/Disable Widgets', 'marquee-addons'); ?></h2>
                                <p class="description">
                                    <?php _e('Turn on/off widgets to optimize performance. Disabled widgets will not be loaded.', 'marquee-addons'); ?>
                                </p>
                                <div class="marquee-bulk-actions">
                                    <button type="button" class="button" id="enable-all">
                                        <?php _e('Enable All', 'marquee-addons'); ?>
                                    </button>
                                    <button type="button" class="button" id="disable-all">
                                        <?php _e('Disable All', 'marquee-addons'); ?>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="marquee-widgets-grid">
                                <?php foreach ($this->get_widgets_list() as $key => $widget) : 
                                    $is_pro_locked = $widget['is_pro'] && !$this->is_pro_active;
                                    $is_checked = isset($widgets[$key]) && $widgets[$key] === 'on';
                                    
                                    // If PRO is locked, force unchecked
                                    if ($is_pro_locked) {
                                        $is_checked = false;
                                    }
                                ?>
                                    <div class="marquee-widget-card <?php echo $is_pro_locked ? 'pro-locked' : ''; ?>" 
                                         <?php echo $is_pro_locked ? 'data-pro-url="' . esc_url($widget['pro_url']) . '"' : ''; ?>>
                                        <div class="widget-header">
                                            <span class="<?php echo esc_attr($widget['icon']); ?>"></span>
                                            <h3><?php echo esc_html($widget['title']); ?></h3>
                                            <?php if ($widget['is_pro']) : ?>
                                                <span class="pro-badge"><?php _e('PRO', 'marquee-addons'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="widget-description">
                                            <?php echo esc_html($widget['description']); ?>
                                        </p>
                                        
                                        <div class="widget-toggle">
                                            <label class="marquee-switch <?php echo $is_pro_locked ? 'disabled' : ''; ?>">
                                                <input 
                                                    type="checkbox" 
                                                    name="marquee_addons_widgets[<?php echo esc_attr($key); ?>]"
                                                    <?php checked($is_checked, true); ?>
                                                    <?php disabled($is_pro_locked); ?>
                                                    value="on"
                                                    data-is-pro="<?php echo $widget['is_pro'] ? '1' : '0'; ?>"
                                                >
                                                <span class="slider"></span>
                                            </label>
                                            <span class="toggle-label">
                                                <?php 
                                                if ($is_pro_locked) {
                                                    echo __('Locked', 'marquee-addons');
                                                } elseif ($is_checked) {
                                                    echo __('Enabled', 'marquee-addons');
                                                } else {
                                                    echo __('Disabled', 'marquee-addons');
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="marquee-settings-footer">
                        <?php submit_button(__('Save Changes', 'marquee-addons'), 'primary', 'submit', false); ?>
                        <button type="button" class="button button-secondary" id="reset-settings">
                            <?php _e('Reset to Defaults', 'marquee-addons'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}

// Initialize the Control Manager
Control_Manager::instance();
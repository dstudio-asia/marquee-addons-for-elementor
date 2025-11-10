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
            __('Marquee Addons', 'marquee-addons-for-elementor'),
            __('Marquee Addons', 'marquee-addons-for-elementor'),
            'manage_options',
            'marquee-addons-settings',
            [$this, 'render_settings_page'],
            DEENSIMC_ASSETS_URL . 'images/logo.png', 
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
            return $input;
        }
        
        // Process each widget
        foreach ( $this->get_widgets_list() as $key => $widget ) {
            $is_pro_locked = $widget['is_pro'] && !$this->is_pro_active;
            if ($is_pro_locked) {
                $sanitized[$key] = '';
            } else {
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
            'deensimc-image-marquee' => [
                'title' => __('Image Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-text-marquee' => [
                'title' => __('Text Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-testimonial-marquee' => [
                'title' => __('Testimonial Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-video-marquee' => [
                'title' => __('Video Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-stacked-slider' => [
                'title' => __('Stacked Slider', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-image-accordion' => [
                'title' => __('Image Accordion', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-news-ticker' => [
                'title' => __('News Ticker', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-animated-word-roller' => [
                'title' => __('Animated Word Roller', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-animated-heading' => [
                'title' => __('Animated Heading', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimc-button-marquee' => [
                'title' => __('Button Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => false,
            ],
            'deensimcpro-3d-grid-marquee' => [
                'title' => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-card-list' => [
                'title' => __('Card Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-circular-text-pro' => [
                'title' => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-image-accordion' => [
                'title' => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-media-marquee' => [
                'title' => __('Media Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-post-marquee' => [
                'title' => __('Post Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-product-category-marquee' => [
                'title' => __('Product Category Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-product-marquee' => [
                'title' => __('Product Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-sticky-cards' => [
                'title' => __('Sticky Cards', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimc-testimonial-pro' => [
                'title' => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimc-smooth-text-pro' => [
                'title' => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-animated-list' => [
                'title' => __('Animated List', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-smart-tabs' => [
                'title' => __('Smart Tabs', 'marquee-addons-for-elementor'),
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
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
            if (isset($widgets_list[$widget_key]) && !$widgets_list[$widget_key]['is_pro']) {
                return true;
            }
            return false;
        }
        return isset($widgets[$widget_key]) && $widgets[$widget_key] === 'on';
    }
    
    /**
     * Get list of disabled widgets
     * Use this in your main plugin file to prevent widget registration
     */
    public function get_disabled_widgets() {
        $disabled = [];
        
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
        ?>
        <div class="wrap deensimc-addons-settings">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <div class="deensimc-settings-container">
                <!-- Tabs Navigation -->
                <div class="deensimc-tabs">
                    <button class="deensimc-tab-btn active" data-tab="widgets">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <?php echo esc_html__('Widgets', 'marquee-addons-for-elementor'); ?>
                    </button>
                </div>
                
                <form method="post" action="options.php">
                    <?php settings_fields('marquee_addons_settings'); ?>
                    
                    <!-- Hidden field to track that form was submitted -->
                    <input type="hidden" name="marquee_addons_widgets_submitted" value="1">
                    
                    <!-- Widgets Tab -->
                    <div class="deensimc-tab-content active" id="tab-widgets">
                        <div class="deensimc-section">
                            <div class="deensimc-section-header">
                                <h2><?php echo esc_html__('Enable/Disable Widgets', 'marquee-addons-for-elementor'); ?></h2>
                                <p class="deensimc-description">
                                    <?php echo esc_html__('Turn on/off widgets to optimize performance. Disabled widgets will not be loaded.', 'marquee-addons-for-elementor'); ?>
                                </p>
                                <div class="deensimc-bulk-actions">
                                    <button type="button" class="button deensimc-enable-btn" id="enable-all">
                                        <?php echo esc_html__('Enable All', 'marquee-addons-for-elementor'); ?>
                                    </button>
                                    <button type="button" class="button deensimc-disable-btn" id="disable-all">
                                        <?php echo esc_html__('Disable All', 'marquee-addons-for-elementor'); ?>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="deensimc-widgets-grid">
                                <?php foreach ($this->get_widgets_list() as $key => $widget) : 
                                    $is_pro_locked = $widget['is_pro'] && !$this->is_pro_active;
                                    $is_checked = $this->is_widget_enabled($key);
                                    $pro_url = isset($widget['pro_url']) ? $widget['pro_url'] : '';
                                ?>
                                    <div class="deensimc-widget-card <?php echo esc_attr( $is_pro_locked )? 'deensimc-pro-locked' : ''; ?>" 
                                         data-pro-url="<?php echo esc_attr($pro_url); ?>"
                                         data-is-locked="<?php echo esc_attr( $is_pro_locked )  ? '1' : '0' ; ?>">
                                        <div class="deensimc-widget-header">
                                            <h3><?php echo esc_html($widget['title']); ?></h3>
                                            <?php if ($widget['is_pro']) : ?>
                                                <span class="deensimc-pro-badge"><?php echo esc_html__('PRO', 'marquee-addons-for-elementor'); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="deensimc-widget-toggle">
                                            <label class="deensimc-switch <?php echo esc_attr( $is_pro_locked ) ? 'disabled' : ''; ?>">
                                                <input 
                                                    type="checkbox" 
                                                    name="marquee_addons_widgets[<?php echo esc_attr($key); ?>]"
                                                    <?php checked($is_checked, true); ?>
                                                    <?php disabled($is_pro_locked); ?>
                                                    value="on"
                                                    data-is-pro="<?php echo esc_attr( $widget['is_pro'] ) ? '1' : '0'; ?>"
                                                >
                                                <span class="slider"></span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="deensimc-settings-footer">
                        <?php submit_button(__('Save Changes', 'marquee-addons-for-elementor'), 'primary', 'submit', false); ?>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}

// Initialize the Control Manager
Control_Manager::instance();
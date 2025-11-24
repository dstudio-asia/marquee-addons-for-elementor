<?php
/**
 * Widgets Manager for Marquee Addons
 * 
 * This file handles the registration of Elementor widgets based on Control Manager settings
 */

namespace Deensimc_Marquee;

if (!defined('ABSPATH')) exit;

class Widgets_Manager {
    
    private static $_instance = null;
    
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct() {
        // Register widgets on Elementor init
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }
    
    /**
     * Register widgets based on Control Manager settings
     */
    public function register_widgets($widgets_manager) {
        // Get Control Manager instance
        $control_manager = Control_Manager::instance();
        
        // Load common trait files (always needed)
        $this->load_common_traits();
        
        // Define widgets with their dependencies and class info
        $widgets_config = $this->get_widgets_config();
        
        // Register only enabled widgets
        foreach ($widgets_config as $key => $config) {
            
            if ($control_manager->is_widget_enabled($key)) {
                $this->register_single_widget($config, $widgets_manager);
            }
        }
    }
        /**
     * Load common trait files that are always needed
     */
    private function load_common_traits() {
        $common_traits = [
            '/includes/widgets/traits/common-controls/promotional-banner.php',
            '/includes/widgets/traits/common-controls/gap-control.php',
            '/includes/widgets/traits/common-controls/marquee-controls.php',
            '/includes/widgets/traits/common-controls/style-edge-shadow.php',
        ];
        
        foreach ($common_traits as $file) {
            $file_path = DEENSIMC__DIR__ . $file;
            if (file_exists($file_path)) {
                require_once($file_path);
            }
        }
    }
    
    /**
     * Get widgets configuration
     * Each widget has its traits, main file, and class name
     */
    private function get_widgets_config() {
        return [
            'deensimc-image-marquee' => [
                'traits' => [
                    '/includes/widgets/traits/image-marquee/content-image.php',
                    '/includes/widgets/traits/image-marquee/style-image-controls.php',
                    '/includes/widgets/traits/image-marquee/style-caption-controls.php',
                ],
                'file' => '/includes/widgets/class-deensimc-image-marquee.php',
                'class' => '\Deensimc_Image_Marquee',
            ],
            'deensimc-stacked-slider' => [
                'traits' => [
                    '/includes/widgets/traits/stacked-slider/content-advance.php',
                    '/includes/widgets/traits/stacked-slider/content-primary.php',
                    '/includes/widgets/traits/stacked-slider/style-box.php',
                    '/includes/widgets/traits/stacked-slider/content-parts/style-title-controls.php',
                    '/includes/widgets/traits/stacked-slider/content-parts/style-description-controls.php',
                    '/includes/widgets/traits/stacked-slider/content-parts/style-color-controls.php',
                    '/includes/widgets/traits/stacked-slider/content-parts/style-button-controls.php',
                    '/includes/widgets/traits/stacked-slider/style-contents.php',
                    '/includes/widgets/traits/stacked-slider/style-image.php',
                    '/includes/widgets/traits/stacked-slider/style-dots.php',
                ],
                'file' => '/includes/widgets/class-deensimc-stacked-slider.php',
                'class' => '\Deensimc_Stacked_Slider',
            ],
            'deensimc-image-accordion' => [
                'traits' => [
                    '/includes/widgets/traits/image-accordion/content.php',
                    '/includes/widgets/traits/image-accordion/style.php',
                ],
                'file' => '/includes/widgets/class-deensimc-image-accordion.php',
                'class' => '\Deensimc_Image_Accordion',
            ],
            'deensimc-text-marquee' => [
                'traits' => [
                    '/includes/widgets/traits/text-marquee/content-text-repeater.php',
                    '/includes/widgets/traits/text-marquee/style-text-contents.php',
                ],
                'file' => '/includes/widgets/class-deensimc-text-marquee.php',
                'class' => '\Deensimc_Text_Marquee',
            ],
            'deensimc-testimonial-marquee' => [
                'traits' => [
                    '/includes/widgets/traits/testimonial-marquee/helper-methods.php',
                    '/includes/widgets/traits/testimonial-marquee/content-repeater.php',
                    '/includes/widgets/traits/testimonial-marquee/content-text-unfold.php',
                    '/includes/widgets/traits/testimonial-marquee/style-contents-box.php',
                    '/includes/widgets/traits/testimonial-marquee/style-contents.php',
                    '/includes/widgets/traits/testimonial-marquee/style-image.php',
                    '/includes/widgets/traits/testimonial-marquee/style-name-title.php',
                    '/includes/widgets/traits/testimonial-marquee/style-review.php',
                ],
                'file' => '/includes/widgets/class-deensimc-testimonial-marquee.php',
                'class' => '\Deensimc_Testimonial_Marquee',
            ],
            'deensimc-video-marquee' => [
                'traits' => [
                    '/includes/widgets/traits/video-marquee/helper-methods.php',
                    '/includes/widgets/traits/video-marquee/content-url-fields.php',
                    '/includes/widgets/traits/video-marquee/content-video-options.php',
                    '/includes/widgets/traits/video-marquee/content-youtube-vimeo.php',
                    '/includes/widgets/traits/video-marquee/content-hosted.php',
                    '/includes/widgets/traits/video-marquee/content-image-overlay.php',
                    '/includes/widgets/traits/video-marquee/style-contents.php',
                    '/includes/widgets/traits/video-marquee/style-play-icon.php',
                ],
                'file' => '/includes/widgets/class-deensimc-video-marquee.php',
                'class' => '\Deensimc_Video_Marquee',
            ],
            'deensimc-news-ticker' => [
                'traits' => [
                    '/includes/widgets/traits/news-ticker/news-ticker-layout-control.php',
                    '/includes/widgets/traits/news-ticker/style-section-control.php',
                    '/includes/widgets/traits/news-ticker/news-ticker-query-control.php',
                ],
                'file' => '/includes/widgets/class-deensimc-news-ticker.php',
                'class' => '\Deensimc_News_Ticker',
            ],
            'deensimc-animated-word-roller' => [
                'traits' => [
                    '/includes/widgets/traits/animated-word-roller/content-additional-options.php',
                    '/includes/widgets/traits/animated-word-roller/content-text-repeater.php',
                    '/includes/widgets/traits/animated-word-roller/style-contents.php',
                ],
                'file' => '/includes/widgets/class-deensimc-animated-word-roller.php',
                'class' => '\Deensimc_Animated_Word_Roller',
            ],
            'deensimc-animated-heading' => [
                'traits' => [
                    '/includes/widgets/traits/animated-heading/trait-animated-text-effect-controls.php',
                    '/includes/widgets/traits/animated-heading/trait-animation-controls.php',
                    '/includes/widgets/traits/animated-heading/trait-text-styles-controls.php',
                    '/includes/widgets/traits/animated-heading/trait-title-controls.php',
                ],
                'file' => '/includes/widgets/class-deensimc-animated-heading.php',
                'class' => '\Deensimc_Animated_Heading_Widget',
            ],
            'deensimc-button-marquee' => [
                'traits' => [
                    '/includes/widgets/traits/button-marquee/trait-button-controls.php',
                    '/includes/widgets/traits/button-marquee/trait-button-style-controls.php',
                    '/includes/widgets/traits/button-marquee/trait-button-marquee-controls.php',
                    '/includes/widgets/traits/button-marquee/trait-button-helper-methods.php',
                ],
                'file' => '/includes/widgets/class-deensimc-button-marquee.php',
                'class' => '\Deensimc_Button_marquee',
            ],
        ];
    }
    
    /**
     * Register a single widget with its dependencies
     */
    private function register_single_widget($config, $widgets_manager) {
        // Use the plugin root directory constant
        $base_path = DEENSIMC__DIR__;
        
        // Load trait files first
        if (isset($config['traits']) && is_array($config['traits'])) {
            foreach ($config['traits'] as $trait) {
                $trait_path = $base_path . $trait;
                if (file_exists($trait_path)) {
                    require_once($trait_path);
                }
            }
        }
        
        // Load main widget file
        $widget_path = $base_path . $config['file'];
        if (!file_exists($widget_path)) {
            return;
        }
        
        require_once($widget_path);
        
        // Check if class exists and register
        if (class_exists($config['class'])) {
            $widgets_manager->register(new $config['class']());
        }
    }
    
    /**
     * Get list of active widgets (for debugging)
     */
    public function get_active_widgets() {
        $control_manager = Control_Manager::instance();
        $active = [];
        
        foreach ($control_manager->get_widgets_list() as $key => $widget) {
            if ($control_manager->is_widget_enabled($key)) {
                $active[] = $key;
            }
        }
        
        return $active;
    }
}

// Initialize Widgets Manager
Widgets_Manager::instance();
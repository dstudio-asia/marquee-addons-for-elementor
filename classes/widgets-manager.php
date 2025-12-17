<?php

/**
 * Widgets Manager for Marquee Addons
 * 
 * This file handles the registration of Elementor widgets based on Control Manager settings
 */

namespace Deensimc_Marquee;

if (!defined('ABSPATH')) exit;

class Widgets_Manager
{
    use Manifest_Loader;

    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        // Register widgets on Elementor init
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    /**
     * Register widgets based on Control Manager settings
     */
    public function register_widgets($widgets_manager)
    {
        $control_manager = Control_Manager::instance();
        $this->load_common_traits();
        $widgets_config = self::get_manifest();

        foreach ($widgets_config as $key => $config) {
            // A widget must have a class and file to be registered
            if (empty($config['class']) || empty($config['file'])) {
                continue;
            }

            if ($control_manager->is_widget_enabled($key)) {
                $this->register_single_widget($config, $widgets_manager);
            }
        }
    }

    /**
     * Load common trait files that are always needed
     */
    private function load_common_traits()
    {
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
     * Register a single widget with its dependencies
     */
    private function register_single_widget($config, $widgets_manager)
    {
        $base_path = DEENSIMC__DIR__;

        // Load traits from directories
        if (isset($config['trait_dirs']) && is_array($config['trait_dirs'])) {
            foreach ($config['trait_dirs'] as $trait_dir) {
                $full_dir_path = $base_path . $trait_dir;
                if (is_dir($full_dir_path)) {
                    // Get all PHP files in the directory
                    $trait_files = glob($full_dir_path . '*.php');
                    foreach ($trait_files as $trait_file) {
                        require_once $trait_file;
                    }
                }
            }
        }

        // Load main widget file
        $widget_path = $base_path . '/includes/widgets/' . $config['file'];
        if (!file_exists($widget_path)) {
            return;
        }

        require_once($widget_path);

        // Check if class exists and register
        if (class_exists($config['class'])) {
            $widgets_manager->register(new $config['class']());
        }
    }
}

// Initialize Widgets Manager
Widgets_Manager::instance();

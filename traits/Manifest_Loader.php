<?php
/**
 * Manifest Loader Trait
 *
 * This trait provides a centralized method for loading and caching the widget manifest file.
 */

namespace Deensimc_Marquee;

if (!defined('ABSPATH')) exit;

trait Manifest_Loader {

    private static $manifest_data = null;

    /**
     * Load and cache the widget manifest.
     *
     * @return array The widget manifest data.
     */

    protected static function get_manifest() {

        if (self::$manifest_data === null) {
            $manifest_path = DEENSIMC__DIR__ . '/widget-manifest.php';
            $free_manifest_data = [];
            
            if (file_exists($manifest_path)) {
                $free_manifest_data = require $manifest_path;
            }
            
            // Initialize arrays
            $free_widgets = isset($free_manifest_data['free']) ? $free_manifest_data['free'] : [];
            $pro_widgets = isset($free_manifest_data['pro']) ? $free_manifest_data['pro'] : [];
            $pro_active = class_exists('\Deensimcpro_Marquee\Marqueepro');
            $pro_manifest_loaded = false;
            
            if ($pro_active) {
                if (defined('DEENSIMCPRO__DIR__')) {
                    $pro_manifest_path = DEENSIMCPRO__DIR__ . '/deensimcpro-widget-manifest.php';
                    
                    if (file_exists($pro_manifest_path)) {
                        $pro_widgets_from_pro = require $pro_manifest_path;
                        if (is_array($pro_widgets_from_pro) && !empty($pro_widgets_from_pro)) {
                            $pro_widgets = $pro_widgets_from_pro;
                            $pro_manifest_loaded = true;
                        }
                    }
                }
            }
            
            self::$manifest_data = array_merge($free_widgets, $pro_widgets);
        }
        
        return self::$manifest_data;
    }
}

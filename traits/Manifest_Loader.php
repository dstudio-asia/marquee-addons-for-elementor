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
            clearstatcache(); // Ensure file status cache is not causing issues
            if (file_exists($manifest_path)) {
                self::$manifest_data = require $manifest_path;
            } else {
                self::$manifest_data = [];
            }
        }
        return self::$manifest_data;
    }
}

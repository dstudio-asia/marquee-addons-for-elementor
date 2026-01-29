<?php

namespace Deensimc_Marquee;

final class Base
{
    private static $_instance = null;
    const VERSION = '3.9.15';

    public function __construct()
    {
        add_action('elementor/init', [$this, 'load_dependencies']);
        add_filter('plugin_row_meta', [$this, 'deensimc_add_row_meta_links'], 10, 2);
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Get minified asset URL if exists, otherwise fallback to unminified
     * 
     * @param string $path Relative path to asset
     * @param string $type 'css' or 'js'
     * @return string Asset URL
     */
    private function get_asset_url($path, $type = 'css')
    {
        $min_path = str_replace(".$type", ".min.$type", $path);
        $base_path = DEENSIMC__DIR__ . '/assets/';
        $full_min_path = $base_path . $min_path;

        if (file_exists($full_min_path)) {
            return DEENSIMC_ASSETS_URL . $min_path;
        }

        return DEENSIMC_ASSETS_URL . $path;
    }

    public function load_dependencies()
    {
        // Loader 
        require_once(DEENSIMC__DIR__ . '/includes/loader.php');

        // Load Actions
        add_action('admin_enqueue_scripts', [$this, 'deensimc_admin_enqueue_scripts'], 10);
    }

    function deensimc_admin_enqueue_scripts()
    {
        $admin_styles = [
            'deensimc-admin-style' => 'css/admin/admin.css',
            'deensimc-deactivation-css' => 'css/admin/feedback.css',
        ];

        foreach ($admin_styles as $handle => $path) {
            wp_enqueue_style(
                $handle,
                $this->get_asset_url($path, 'css'),
                null,
                self::VERSION,
                false
            );
        }

        $admin_scripts = [
            'deensimc-admin-scripts' => 'js/admin/admin.js',
            'deensimc-deactivation-script' => 'js/admin/feedback.js'
        ];

        foreach ($admin_scripts as $handle => $path) {
            wp_enqueue_script(
                $handle,
                $this->get_asset_url($path, 'js'),
                ['jquery'],
                self::VERSION,
                true
            );
        }
    }

    public function deensimc_add_row_meta_links($links, $pluginFile)
    {
        if ($pluginFile !== 'marquee-addons-for-elementor/marquee-addons-for-elementor.php') {
            return $links;
        }

        $links[] = sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            esc_url('https://marqueeaddons.com/docs/'),
            esc_html__('Docs & FAQs', 'marquee-addons-for-elementor')
        );

        $links[] = sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
            esc_url('https://www.youtube.com/playlist?list=PLCLMAp2dSeYVmhmX5Wej3gOhneM5RkSpY'),
            esc_html__('Video Tutorials', 'marquee-addons-for-elementor')
        );

        return $links;
    }
}

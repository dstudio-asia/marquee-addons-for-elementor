<?php


namespace Deensimc_Marquee;

final class Base
{

	private static $_instance = null;
    const VERSION = '3.8.1';

    public function __construct()
	{
		add_action('elementor/init', [$this, 'load_dependencies']);
	}

    public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    public function load_dependencies()
    {
		// Loader 
		require_once( DEENSIMC__DIR__ . '/includes/loader.php' );
		
        // Load Actions
        add_action('admin_enqueue_scripts', [$this, 'deensimc_admin_enqueue_scripts'], 10);
    }

    function deensimc_admin_enqueue_scripts()
{
    // CSS
    $admin_css        = 'css/admin/admin.css';
    $admin_css_min    = 'css/admin/admin.min.css';

    $css_path         = DEENSIMC_ASSETS_URL . $admin_css_min;
    $css_url          = file_exists($css_path)
                        ? DEENSIMC_ASSETS_URL . $admin_css_min
                        : DEENSIMC_ASSETS_URL . $admin_css;

    wp_enqueue_style(
        'deensimc-admin-style',
        $css_url,
        null,
        self::VERSION,
        false
    );

    // JS
    $admin_js        = 'js/admin/admin.js';
    $admin_js_min    = 'js/admin/admin.min.js';

    $js_path         = DEENSIMC_ASSETS_URL . $admin_js_min;
    $js_url          = file_exists($js_path)
                        ? DEENSIMC_ASSETS_URL . $admin_js_min
                        : DEENSIMC_ASSETS_URL . $admin_js;

    wp_enqueue_script(
        'deensimc-admin-scripts',
        $js_url,
        ['jquery'],
        self::VERSION,
        true
    );
}


}
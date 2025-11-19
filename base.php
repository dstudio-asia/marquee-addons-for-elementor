<?php


namespace Deensimc_Marquee;

final class Base
{

	private static $_instance = null;
    const VERSION = '3.7.17';

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
		wp_enqueue_style( 'deensimc-admin-style', DEENSIMC_ASSETS_URL . 'css/admin/admin.css', null, self::VERSION, false );
		wp_enqueue_script( 'deensimc-admin-scripts', DEENSIMC_ASSETS_URL . 'js/admin/admin.js', ['jquery'], self::VERSION, true);
	}

}
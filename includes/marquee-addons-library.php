<?php

class Marquee_Addons_Library 
{
	const VERSION = DEENSIMC_VERSION;

	protected static $instance;

	/**
	 * Path to plugin folder, trailing slashed.
	 */
	public $path;
	public $path_url;

	/**
	 * Flag to indicat plugin successfuly ran init. This confirms no conflicts.
	 */
	public $did_init = false;

	/**
	 * Whether the correct accompanying theme exists or implementations are done.
	 *
	 * @var boolean
	 */
	public $theme_supports = [];

	public function __construct()
	{
		$this->path = DEENSIMC_PATH;
		$this->path_url = DEENSIMC_URL;

	}
	
	/**
	 * Setup to be hooked after setup theme.
	 */
	public function init()
	{

		include_once($this->path . 'lib/studio/module.php');

		/**
		 * Setup filters and data
		 */

		// Elementor specific
		if (class_exists('\Elementor\Plugin') || did_action('elementor/loaded')) {
			new Marquee_Addons\Library\Module;
		}

	}

	
	/**
	 * Singleton instance
	 * 
	 * @return Marquee_Addons_Library
	 */
	public static function instance() 
	{
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		
		return self::$instance;
	}
}

/**
 * Add notice and bail if there's an libompatible plugin active.
 * 
 * Note: Needed for outdated libs in ContentBerg Core. Not required for others, but 
 * good practice to keep them out for conflicting features.
 */
add_action('after_setup_theme', function() {

	/**
	 * Initialize the plugin at correct hook.
	 */
	$marquee_addons_library_instance = Marquee_Addons_Library::instance();
	add_action('after_setup_theme', [$marquee_addons_library_instance, 'init']);

}, 1);

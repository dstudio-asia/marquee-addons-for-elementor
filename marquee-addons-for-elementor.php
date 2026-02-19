<?php

/**
 * Plugin Name: Marquee Addons for Elementor - Essential Motion Widgets & Templates
 * Description: Marquee Addons an Elementor addon to create smooth, endless marquee carousels, showcases images, logos, or content with dynamic movement to engage visitors. It also allows you to create image accordions, stacked sliders, and text marquees.
 * Version: 3.9.25
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Elementor tested up to: 3.35.3
 * Author: Debuggers Studio
 * Author URI: https://debuggersstudio.com
 * Text Domain: marquee-addons-for-elementor
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (! defined('ABSPATH')) {
	exit;
}

define('DEENSIMC__FILE__', __FILE__);
define('DEENSIMC__DIR__', __DIR__);
define('DEENSIMC_URL', plugins_url('/', DEENSIMC__FILE__));
define('DEENSIMC_PATH', plugin_dir_path(__FILE__));
define('DEENSIMC_ASSETS_URL', DEENSIMC_URL . 'assets/');
define('DEENSIMC_VERSION', '3.9.25');

function deensimc_load_plugin_data(): void
{
	require_once(DEENSIMC__DIR__ . '/base.php');
	require_once(DEENSIMC__DIR__ . '/includes/misc/class-deensimcpro-promo.php');
	require_once(DEENSIMC__DIR__ . '/includes/widget.php');
	require_once(DEENSIMC__DIR__ . '/includes/feedback.php');
	\Deensimc_Marquee\Marquee::instance();
	\Deensimc_Marquee\Base::instance();
}

add_action('plugins_loaded', 'deensimc_load_plugin_data');

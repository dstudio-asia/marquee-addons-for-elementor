<?php

namespace Deensimc_Marquee;

use Deensimc_Marquee\Misc\Deensimcpro_Promo;

final class Marquee
{
	use Deensimcpro_Promo;
	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */

	const VERSION = '3.7.26';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */

	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Deensimc_Marquee\Marquee The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Deensimc_Marquee\Marquee  An instance of the class.
	 */

	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function __construct()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	public function deensimc_allowed_tags()
	{
		$allowed_tags = array(
			'strong' => array(),
		);
		return $allowed_tags;
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function is_compatible()
	{

		// Check if Elementor installed and activated

		if (! did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version

		if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version

		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_missing_main_plugin()
	{

		$message = sprintf(
			/* translators: %1$s is replaced with " Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets"  and %2$s is replaced with "Elementor"*/
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'marquee-addons-for-elementor'),
			'<strong>' . esc_html__(' Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets', 'marquee-addons-for-elementor') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'marquee-addons-for-elementor') . '</strong>'

		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses($message, $this->deensimc_allowed_tags()));
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_elementor_version()
	{

		$message = sprintf(
			/* translators: %1$s is replaced with " Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets", %2$s is replaced with "Elementor", %3$s is replaced with "3.8.0" */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'marquee-addons-for-elementor'),
			'<strong>' . esc_html__(' Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets', 'marquee-addons-for-elementor') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'marquee-addons-for-elementor') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION

		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses($message, $this->deensimc_allowed_tags()));
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_php_version()
	{

		$message = sprintf(
			/* translators: %1$s is replaced with " Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets", %2$s is replaced with "php", %3$s is replaced with "7.4" */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'marquee-addons-for-elementor'),
			'<strong>' . esc_html__(' Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets', 'marquee-addons-for-elementor') . '</strong>',
			'<strong>' . esc_html__('PHP', 'marquee-addons-for-elementor') . '</strong>',
			self::MINIMUM_PHP_VERSION

		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses($message, $this->deensimc_allowed_tags()));
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function init()
	{
		add_action('admin_enqueue_scripts', [$this, 'deensimc_notice_enqueue_scripts'], 10);
		if (!class_exists('\Deensimcpro_Marquee\Marqueepro')) {
			add_action('admin_notices', [$this, 'deensimc_rate_us'], 10);
			add_action('wp_ajax_deensimc_notice_dismiss', [$this, 'deensimc_notice_dismiss'], 10);
			add_action('wp_ajax_deensimc_never_show_notice', [$this, 'deensimc_never_show_notice']);
		}

		if (!class_exists('\Deensimcpro_Marquee\Marqueepro') || !apply_filters('marquee_addons_is_license_active', false)) {
			add_action('elementor/editor/before_enqueue_styles', [$this, 'deensimc_promotion_styles'], 10);
			add_filter('elementor/editor/localize_settings', [$this, 'promote_pro_elements']);
			add_action('elementor/editor/after_enqueue_scripts', [$this, 'deensimc_promotion_script'], 10);
		}
		add_action('elementor/frontend/after_enqueue_styles', [$this, 'deensimc_frontend_styles'], 20);
		add_action('elementor/frontend/after_register_scripts', [$this, 'deensimc_frontend_scripts'], 20);
		add_action('elementor/elements/categories_registered', [$this, 'deensimc_add_categories'], 10);
		add_action('elementor/editor/before_enqueue_styles', [$this, 'deensimc_editor_styles'], 10);
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'deensimc_editor_script'], 10);
		add_action('elementor/frontend/after_enqueue_scripts', [$this, 'deensimc_elementor_library'], 20);
		add_filter('plugin_action_links_marquee-addons-for-elementor/marquee-addons-for-elementor.php', [$this, 'deensimc_upgrade_link'], 10);
	}


	public function deensimc_notice_enqueue_scripts($hook)
	{
		if ($hook !== 'plugins.php') {
			return;
		}

		wp_enqueue_style(
			'deensimc-feedback-style',
			DEENSIMC_ASSETS_URL . 'css/admin/notice.css',
			null,
			self::VERSION,
			false
		);

		wp_enqueue_script(
			'deensimc-feedback-script',
			DEENSIMC_ASSETS_URL . 'js/admin/dismiss.js',
			['jquery'],
			self::VERSION,
			true
		);

		wp_localize_script(
			'deensimc-feedback-script',
			'DeensimcFB',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('deensimc_dismiss_nonce'),
				'days'     => 30,
			]
		);
	}


	public function deensimc_rate_us()
	{

		global $pagenow;

		if ($pagenow !== 'plugins.php') {
			return;
		}

		if (!current_user_can('manage_options')) {
			return;
		}

		if (get_transient('deensimc_rate_us_' . self::VERSION)) {
			return;
		}

		if (get_option('deensimc_never_show_notice')) {
			return;
		}


		echo '<div id="deensimc-feedback-notice" class="deensimc-notice-wrap notice is-dismissible">';
		echo '  <div class="deensimc-notice-icon">';
		echo '    <img src="' . esc_url(DEENSIMC_ASSETS_URL) . 'images/library-icon.png" alt="Notice Icon" />';
		echo '  </div>';
		echo '  <div class="deensimc-notice-content">';
		echo '    <h3>Upgrade to Marquee Addons Pro</h3>';
		echo '    <p>Unlock more advance widgets and make your Elementor website 10x better with Marquee Addons.</p>';
		echo '    <a href="https://marqueeaddons.com/pricing/" target="_blank" class="button button-primary">Upgrade to Pro</a>';
		echo '    <a href="https://wordpress.org/support/plugin/marquee-addons-for-elementor/reviews/#new-post" target="_blank" class="button button-primary">Rate Us</a>';;
		echo '    <button class="button deensimc-dismiss-btn">Remind me later</button>';
		echo '    <button class="button deensimc-never-show">Don\'t show me again</button>';
		echo '  </div>';
		echo '</div>';
	}

	public function deensimc_notice_dismiss()
	{
		check_ajax_referer('deensimc_dismiss_nonce', 'nonce');
		set_transient(
			'deensimc_rate_us_' . self::VERSION,
			true,
			30 * 86400
		);
		wp_send_json_success();
	}

	public function deensimc_never_show_notice()
	{
		check_ajax_referer('deensimc_dismiss_nonce', 'nonce');
		update_option('deensimc_never_show_notice', true);
		wp_send_json_success();
	}



	public function deensimc_frontend_styles()
	{
		// refactored code start
		wp_register_style('deensimc-marquee-common-styles', DEENSIMC_ASSETS_URL . 'css/common-styles.css', null, self::VERSION, false);
		wp_register_style('deensimc-button-marquee-style', DEENSIMC_ASSETS_URL . 'css/button-marquee.css', null, self::VERSION, false);
		wp_register_style('deensimc-image-marquee-style', DEENSIMC_ASSETS_URL . 'css/image-marquee.css', null, self::VERSION, false);
		wp_register_style('deensimc-news-ticker-style', DEENSIMC_ASSETS_URL . 'css/news-ticker.css', null, self::VERSION, false);
		wp_register_style('deensimc-text-marquee-style', DEENSIMC_ASSETS_URL . 'css/text-marquee.css', null, self::VERSION, false);
		wp_register_style('deensimc-video-marquee-style', DEENSIMC_ASSETS_URL . 'css/video-marquee.css', null, self::VERSION, false);
		wp_register_style('deensimc-testimonial-style', DEENSIMC_ASSETS_URL . 'css/testimonial.css', null, self::VERSION, false);
		wp_register_style('deensimc-animated-word-roller-style', DEENSIMC_ASSETS_URL . 'css/animated-word-roller.css', null, self::VERSION, false);
		wp_register_style('deensimc-animated-heading-style', DEENSIMC_ASSETS_URL . 'css/animated-heading.css', null, self::VERSION, false);
		wp_register_style('deensimc-swiper-bundle-min-style', DEENSIMC_ASSETS_URL . 'css/swiper-bundle.min.css', null, self::VERSION, false);
		wp_register_style('deensimc-swiper-style', DEENSIMC_ASSETS_URL . 'css/swiper.css', null, self::VERSION, false);
		wp_register_style('deensimc-accordion-style', DEENSIMC_ASSETS_URL . 'css/accordion.css', null, self::VERSION, false);
		wp_register_style('deensimc-search-style', DEENSIMC_ASSETS_URL . 'css/search.css', null, self::VERSION, false);

		wp_enqueue_style('deensimc-marquee-common-styles');
		// refactored code end



	}

	public function deensimc_elementor_library()
	{
		wp_enqueue_script('swiper');
	}

	public function deensimc_frontend_scripts()
	{
		// refactored code start
		wp_register_script('deensimc-handle-animation-duration', DEENSIMC_ASSETS_URL  . 'js/handle-animation-duration.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-init-text-length-toggle', DEENSIMC_ASSETS_URL  . 'js/initTextLengthToggle.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-button-marquee-script', DEENSIMC_ASSETS_URL  . 'js/button-marquee.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-image-marquee-script', DEENSIMC_ASSETS_URL  . 'js/image-marquee.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-news-ticker-marquee-script', DEENSIMC_ASSETS_URL  . 'js/news-ticker.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-text-marquee-script', DEENSIMC_ASSETS_URL  . 'js/text-marquee.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-video-marquee-script', DEENSIMC_ASSETS_URL  . 'js/video-marquee.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-testimonial-marquee-script', DEENSIMC_ASSETS_URL  . 'js/testimonial-marquee.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-waveSwingTiltLeanAnimation', DEENSIMC_ASSETS_URL  . 'js/animated-heading/waveSwingTiltLeanAnimation.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-typing-word', DEENSIMC_ASSETS_URL  . 'js/animated-heading/typing-word.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-twisting-text', DEENSIMC_ASSETS_URL  . 'js/animated-heading/twisting-text.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-slide-word', DEENSIMC_ASSETS_URL  . 'js/animated-heading/slide-word.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-rotation-3d', DEENSIMC_ASSETS_URL  . 'js/animated-heading/rotation-3d.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-lines-animation', DEENSIMC_ASSETS_URL  . 'js/animated-heading/lines-animation.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-construct-word', DEENSIMC_ASSETS_URL  . 'js/animated-heading/construct-word.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-animated-heading', DEENSIMC_ASSETS_URL  . 'js/animated-heading/animated-heading.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-animated-word-roller', DEENSIMC_ASSETS_URL  . 'js/animated-word-roller.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-image-accordion-script', DEENSIMC_ASSETS_URL  . 'js/image-accordion.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-stacked-slider-script', DEENSIMC_ASSETS_URL  . 'js/stacked-slider.js', ['jquery'], self::VERSION, false);
		wp_register_script('deensimc-search-script', DEENSIMC_ASSETS_URL  . 'js/search.js', ['jquery'], self::VERSION, false);


		wp_enqueue_script('deensimc-handle-animation-duration');
		wp_enqueue_script('deensimc-init-text-length-toggle');
	}

	public function deensimc_editor_styles()
	{
		wp_register_style('deensimc-editor-css', DEENSIMC_ASSETS_URL . 'css/editor.css', null, self::VERSION, false);
		wp_enqueue_style('deensimc-editor-css');
	}
	public function deensimc_promotion_styles()
	{
		wp_register_style('deensimc-promotion-css', DEENSIMC_ASSETS_URL . 'css/admin/promotion.css', null, self::VERSION, false);
		wp_enqueue_style('deensimc-promotion-css');
	}
	public function deensimc_editor_script()
	{
		wp_register_script('deensimc-editor-script', DEENSIMC_ASSETS_URL . 'js/admin/editor.js', ['jquery'], self::VERSION, true);
		wp_enqueue_script('deensimc-editor-script');
	}
	public function deensimc_promotion_script()
	{
		wp_register_script('deensimc-promotion-script', DEENSIMC_ASSETS_URL . 'js/admin/promotion.js', ['jquery'], self::VERSION, true);
		wp_enqueue_script('deensimc-promotion-script');
		$this->localize_promotion_script();
	}

	public function deensimc_upgrade_link($actions)
	{

		$actions['rate_us'] = sprintf(
			'<a href="https://wordpress.org/support/plugin/marquee-addons-for-elementor/reviews/#new-post" target="_blank">%1$s</a>',
			__('Rate Us', 'marquee-addons-for-elementor')
		);

		if (!class_exists('\Deensimcpro_Marquee\Marqueepro')) {
			$pro_url = 'https://marqueeaddons.com/pricing/';
			$actions['upgrade_to_pro'] = sprintf(
				'<a href="%1$s" target="_blank" style="color:#e2498a; font-weight: bold;">%2$s</a>',
				esc_url($pro_url),
				__('Get MarqueeAddons Pro', 'marquee-addons-for-elementor')
			);
		}

		return $actions;
	}

	function deensimc_add_categories($elements_manager)
	{

		$elements_manager->add_category(
			'deensimc_smooth_marquee',
			[
				'title' => esc_html__('Marquee Addons', 'marquee-addons-for-elementor'),
				'icon' => 'fa fa-plug',
			]
		);
		if (!class_exists('\Deensimcpro_Marquee\Marqueepro') || !apply_filters('marquee_addons_is_license_active', false)) {
			$elements_manager->add_category(
				'marquee_addons_pro_promo',
				[
					'title' => esc_html__('Marquee Addons Pro', 'marquee-addons-for-elementor'),
					'icon' => 'fa fa-plug',
				]
			);
		}
	}
}

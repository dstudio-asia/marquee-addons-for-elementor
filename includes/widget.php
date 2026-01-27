<?php

namespace Deensimc_Marquee;

use Deensimc_Marquee\Misc\Deensimcpro_Promo;

final class Marquee
{
	use Deensimcpro_Promo;

	const VERSION = '3.9.15';
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';
	const MINIMUM_PHP_VERSION = '7.4';

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
		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	public function deensimc_allowed_tags()
	{
		return ['strong' => []];
	}

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
	 * Get minified asset URL if exists, otherwise fallback to unminified
	 * 
	 * @param string $path Relative path to asset
	 * @param string $type 'css' or 'js'
	 * @return string Asset URL
	 */
	private function get_asset_url($path, $type = 'css')
	{
		// Check for minified version first
		$min_path = str_replace(".$type", ".min.$type", $path);

		// Build the full file path
		$base_path = plugin_dir_path(__FILE__) . '../assets/';
		$full_min_path = $base_path . $min_path;

		// If minified version exists, use it
		if (file_exists($full_min_path)) {
			return DEENSIMC_ASSETS_URL . $min_path;
		}

		// Fallback to unminified version
		return DEENSIMC_ASSETS_URL . $path;
	}

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

	public function init()
	{
		add_action('admin_enqueue_scripts', [$this, 'deensimc_notice_enqueue_scripts'], 10);

		if (!class_exists('\Deensimcpro_Marquee\Marqueepro')) {
			add_action('admin_notices', [$this, 'deensimc_rate_us'], 10);
			add_action('wp_ajax_deensimc_notice_dismiss', [$this, 'deensimc_notice_dismiss'], 10);
			add_action('wp_ajax_deensimc_never_show_notice', [$this, 'deensimc_never_show_notice']);
		}

		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
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

		$admin_styles = [
			'deensimc-feedback-style' => 'css/admin/notice.css',
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
			'deensimc-feedback-script' => 'js/admin/dismiss.js',
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
		echo '    <h3>Enjoying Marquee Addons?</h3>';
		echo '    <p>A quick rating helps other Elementor users discover Marquee Addons. You can also share feature ideas or suggestions to help us improve.</p>';
		echo '    <div class="deensimc-btns">';
		echo '      <div class="deensimc-action-btns">';
		echo '    <a href="https://wordpress.org/support/plugin/marquee-addons-for-elementor/reviews/#new-post" target="_blank" class="button button-primary">Rate Us</a>';
		echo '    <a href="https://wordpress.org/support/plugin/marquee-addons-for-elementor/" target="_blank" class="button"> Feature Request</a>';
		echo '    <a href="https://marqueeaddons.com/pricing/" target="_blank" class="button">Upgrade to Pro</a>';
		echo '      </div>';
		echo '      <div class="deensimc-dismiss-btns">';
		echo '    <button class="button deensimc-dismiss-btn button-tertiary">Remind me later</button>';
		echo '    <button class="button deensimc-never-show button-tertiary">Don\'t show me again</button>';
		echo '      </div>';
		echo '    </div>';
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
		// All frontend widget styles with minification support
		$styles = [
			'deensimc-marquee-common-styles' => 'css/plugins/common-styles.css',
			'deensimc-button-marquee-style' => 'css/widgets/button-marquee.css',
			'deensimc-image-marquee-style' => 'css/widgets/image-marquee.css',
			'deensimc-news-ticker-style' => 'css/widgets/news-ticker.css',
			'deensimc-text-marquee-style' => 'css/widgets/text-marquee.css',
			'deensimc-video-marquee-style' => 'css/widgets/video-marquee.css',
			'deensimc-testimonial-style' => 'css/widgets/testimonial.css',
			'deensimc-animated-word-roller-style' => 'css/widgets/animated-word-roller.css',
			'deensimc-animated-heading-style' => 'css/widgets/animated-heading.css',
			'deensimc-swiper-bundle-min-style' => 'css/plugins/swiper-bundle.min.css',
			'deensimc-swiper-style' => 'css/widgets/stacked.css',
			'deensimc-accordion-style' => 'css/widgets/accordion.css',
			'deensimc-search-style' => 'css/widgets/search.css',
			'deensimc-image-hotspot-style' => 'css/widgets/image-hotspot.css',
		];

		foreach ($styles as $handle => $path) {
			wp_register_style(
				$handle,
				$this->get_asset_url($path, 'css'),
				null,
				self::VERSION,
				false
			);
		}

		wp_enqueue_style('deensimc-marquee-common-styles');
	}

	public function deensimc_elementor_library()
	{
		wp_enqueue_script('swiper');
	}

	public function deensimc_frontend_scripts()
	{
		// All frontend widget scripts with minification support
		$scripts = [
			'deensimc-handle-animation-duration' => 'js/handle-animation-duration.js',
			'deensimc-init-text-length-toggle' => 'js/initTextLengthToggle.js',
			'deensimc-button-marquee-script' => 'js/button-marquee.js',
			'deensimc-image-marquee-script' => 'js/image-marquee.js',
			'deensimc-news-ticker-marquee-script' => 'js/news-ticker.js',
			'deensimc-text-marquee-script' => 'js/text-marquee.js',
			'deensimc-video-marquee-script' => 'js/video-marquee.js',
			'deensimc-testimonial-marquee-script' => 'js/testimonial-marquee.js',
			'deensimc-waveSwingTiltLeanAnimation' => 'js/animated-heading/waveSwingTiltLeanAnimation.js',
			'deensimc-typing-word' => 'js/animated-heading/typing-word.js',
			'deensimc-twisting-text' => 'js/animated-heading/twisting-text.js',
			'deensimc-slide-word' => 'js/animated-heading/slide-word.js',
			'deensimc-rotation-3d' => 'js/animated-heading/rotation-3d.js',
			'deensimc-lines-animation' => 'js/animated-heading/lines-animation.js',
			'deensimc-construct-word' => 'js/animated-heading/construct-word.js',
			'deensimc-animated-heading' => 'js/animated-heading/animated-heading.js',
			'deensimc-animated-word-roller' => 'js/animated-word-roller.js',
			'deensimc-image-accordion-script' => 'js/image-accordion.js',
			'deensimc-stacked-slider-script' => 'js/stacked-slider.js',
			'deensimc-search-script' => 'js/search.js',
			'deensimc-image-hotspot-script' => 'js/image-hotspot.js',
		];

		foreach ($scripts as $handle => $path) {
			wp_register_script(
				$handle,
				$this->get_asset_url($path, 'js'),
				['jquery'],
				self::VERSION,
				false
			);
		}

		wp_enqueue_script('deensimc-handle-animation-duration');
		wp_enqueue_script('deensimc-init-text-length-toggle');
	}

	public function deensimc_editor_styles()
	{
		$editor_styles = [
			'deensimc-editor-css' => 'css/admin/editor.css',
		];

		foreach ($editor_styles as $handle => $path) {
			wp_register_style(
				$handle,
				$this->get_asset_url($path, 'css'),
				null,
				self::VERSION,
				false
			);
		}

		wp_enqueue_style('deensimc-editor-css');
	}

	public function deensimc_promotion_styles()
	{
		$promotion_styles = [
			'deensimc-promotion-css' => 'css/admin/promotion.css',
		];

		foreach ($promotion_styles as $handle => $path) {
			wp_register_style(
				$handle,
				$this->get_asset_url($path, 'css'),
				null,
				self::VERSION,
				false
			);
		}

		wp_enqueue_style('deensimc-promotion-css');
	}

	public function deensimc_editor_script()
	{
		$editor_scripts = [
			'deensimc-editor-script' => 'js/admin/editor.js',
		];

		foreach ($editor_scripts as $handle => $path) {
			wp_register_script(
				$handle,
				$this->get_asset_url($path, 'js'),
				['jquery'],
				self::VERSION,
				true
			);
		}

		wp_enqueue_script('deensimc-editor-script');
	}

	public function deensimc_promotion_script()
	{
		$promotion_scripts = [
			'deensimc-promotion-script' => 'js/admin/promotion.js',
		];

		foreach ($promotion_scripts as $handle => $path) {
			wp_register_script(
				$handle,
				$this->get_asset_url($path, 'js'),
				['jquery'],
				self::VERSION,
				true
			);
		}

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
				__('Get Marquee Addons Pro', 'marquee-addons-for-elementor')
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

		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
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

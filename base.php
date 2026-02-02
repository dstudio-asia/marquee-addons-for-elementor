<?php

namespace Deensimc_Marquee;

final class Base
{
    private static $_instance = null;
    const VERSION = '3.9.18';

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
        add_action('admin_enqueue_scripts', [$this, 'deensimc_notice_enqueue_scripts'], 10);
		add_action('admin_notices', [$this, 'deensimc_rate_us'], 10);
		add_action('wp_ajax_deensimc_notice_dismiss', [$this, 'deensimc_notice_dismiss'], 10);
		add_action('wp_ajax_deensimc_never_show_notice', [$this, 'deensimc_never_show_notice']);
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

    private function is_pro_active() {
        return class_exists('\Deensimcpro_Marquee\Marqueepro');
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
		if ( !$this->is_pro_active() ) {
            echo '<a href="https://marqueeaddons.com/pricing/" target="_blank" class="button">Upgrade to Pro</a>';
        }
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
}

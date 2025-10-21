<?php
if (!defined('ABSPATH')) {
    exit;
}

class deensimc_feedback {
    private $plugin_version = DEENSIMC_VERSION;
    private $plugin_name    = 'Marquee Addons for Elementor – Advanced Elements & Modern Motion Widgets';
    private $plugin_slug    = 'marquee-addons-for-elementor';
    private $feedback_url   = 'https://crm.dstudio.asia/api/feedback';

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'deensimc_enqueue_feedback_scripts'));
        add_action('admin_head', array($this, 'deensimc_show_deactivate_feedback_popup'));
        add_action('wp_ajax_' . $this->plugin_slug . '_deensimc_submit_deactivation_response', array($this, 'deensimc_submit_deactivation_response'));
    }

    function deensimc_enqueue_feedback_scripts() {
        $screen = get_current_screen();
        if (isset($screen) && $screen->id == 'plugins') {
            $ajax_nonce = wp_create_nonce( 'deensimc_deactivate_plugin' );
            wp_enqueue_style('deensimc-deactivation-css', DEENSIMC_ASSETS_URL . 'css/admin/feedback.css', null, $this->plugin_version);
            wp_enqueue_script('deensimc-deactivation-script', DEENSIMC_ASSETS_URL . 'js/admin/feedback.js', array('jquery'), $this->plugin_version, true);
            wp_localize_script( 'deensimc-deactivation-script', 'deensimc_ajax', array( 'nonce' => $ajax_nonce ) );
        }
    }

    public function deensimc_show_deactivate_feedback_popup() {
        $screen = get_current_screen();
        if (!isset($screen) || $screen->id != 'plugins') {
            return;
        }
        ?>
        <div class="deensimc-deactivation-popup deensimc-hidden" data-type="wrapper" data-slug="<?php echo esc_attr($this->plugin_slug); ?>">
            <div class="deensimc-overlay">
                <div class="deensimc-close"><i class="dashicons dashicons-no"></i></div>
                <div class="deensimc-body">
                    <div class="deensimc-title-wrap">
                        <div class="deensimc-img-wrap">
                            <img src="<?php echo esc_url(DEENSIMC_URL . 'assets/images/library-icon.png'); ?>" alt="Marquee Addons">
                        </div>
                        <?php echo esc_html(__('Goodbyes are always hard', 'marquee-addons-for-elementor')); ?>
                    </div>
                    <div class="deensimc-messages-wrap">
                        <p><?php echo esc_html(__('Would you quickly give us your reason for doing so?', 'marquee-addons-for-elementor')); ?></p>
                    </div>
                    <div class="deensimc-options-wrap">
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="temp" class="deensimc-radio">
                            <?php echo esc_html(__('Temporary deactivation', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="setup" class="deensimc-radio">
                            <?php echo esc_html(__('Set up is too difficult', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="e-issues" class="deensimc-radio">
                            <?php echo esc_html(__('Causes issues with Elementor', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="documentation" class="deensimc-radio">
                            <?php echo esc_html(__('Lack of documentation', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="features" class="deensimc-radio">
                            <?php echo esc_html(__('Not the features I wanted', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="better-plugin" class="deensimc-radio">
                            <?php echo esc_html(__('Found a better plugin', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="incompatibility" class="deensimc-radio">
                            <?php echo esc_html(__('Incompatible with theme or plugin', 'marquee-addons-for-elementor')); ?>
                        </label>
                        <label class="deensimc-option-label">
                            <input type="radio" name="feedback" value="other" class="deensimc-radio">
                            <?php echo esc_html(__('Other', 'marquee-addons-for-elementor')); ?>
                        </label>
                    </div>
                    <div class="deensimc-messages-wrap deensimc-hidden" data-feedback>
                        <p class="deensimc-hidden" data-feedback="setup"><?php echo esc_html(__('What was the difficult part?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="e-issues"><?php echo esc_html(__('What was the issue?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="documentation"><?php echo esc_html(__('What can we describe more?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="features"><?php echo esc_html(__('How could we improve?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="better-plugin"><?php echo esc_html(__('Can you mention it?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="incompatibility"><?php echo esc_html(__('With what plugin or theme is incompatible?', 'marquee-addons-for-elementor')); ?></p>
                        <p class="deensimc-hidden" data-feedback="other"><?php echo esc_html(__('Please specify:', 'marquee-addons-for-elementor')); ?></p>
                    </div>
                    <div class="deensimc-options-wrap deensimc-hidden" data-feedback>
                        <label class="deensimc-textarea-label">
                            <textarea name="suggestions" rows="2" class="deensimc-textarea" placeholder="<?php echo esc_attr(__('Tell us more about your reason...', 'marquee-addons-for-elementor')); ?>"></textarea>
                        </label>
                    </div>
                    <div class="deensimc-messages-wrap deensimc-hidden" data-feedback>
                        <p><?php echo esc_html(__('Would you like to share your e-mail and elements usage with us so that we can write you back?', 'marquee-addons-for-elementor')); ?></p>
                    </div>
                    <div class="deensimc-options-wrap deensimc-hidden dennsimc-anonymous" data-feedback>
                        <label class="deensimc-checkbox-label">
                            <input type="checkbox" name="anonymous" value="1" class="deensimc-checkbox">
                            <?php echo esc_html(__('No, I\'d like to stay anonymous', 'marquee-addons-for-elementor')); ?>
                        </label>
                    </div>

                    <div class="deensimc-buttons-wrap">
                        <button class="deensimc-btn deensimc-skip-btn"><?php echo esc_html(__('Skip & Deactivate', 'marquee-addons-for-elementor')); ?></button>
                        <button class="deensimc-btn deensimc-submit-btn"><?php echo esc_html(__('Submit & Deactivate', 'marquee-addons-for-elementor')); ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Collect comprehensive feedback data
     */
    private function deensimc_collect_feedback_data($reason, $message, $anonymous = false) {
        global $wpdb;
        
        // Basic plugin and server info
        $plugin_data = array(
            'deactivated_plugin' => array(
                'version' => $this->plugin_version,
                'memory'  => 'Memory: ' . size_format(wp_convert_hr_to_bytes(ini_get('memory_limit'))),
                'time'    => 'Time: ' . ini_get('max_execution_time'),
                'deactivate' => 'Deactivation: ' . gmdate('j F, Y', time()),
                'uninstall_reason' => $reason,
                'uninstall_details' => $message
            ),
        );

        // Add domain info only if not anonymous
        if (!$anonymous) {
            $plugin_data['deactivated_plugin']['domain'] = $this->deensimc_get_site_domain();
        }

        // WordPress environment data
        $wordpress_data = array(
            'wp_version' => get_bloginfo('version'),
            'wp_locale' => get_locale(),
            'wp_debug' => defined('WP_DEBUG') && WP_DEBUG ? 'Enabled' : 'Disabled',
            'wp_memory_limit' => ini_get('memory_limit'),
            'php_version' => phpversion(),
            'mysql_version' => $wpdb->db_version(),
            'server_software' => isset($_SERVER['SERVER_SOFTWARE']) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : 'N/A'
        );

        // Theme and plugins data
        $environment_data = array(
            'active_theme' => $this->deensimc_get_active_theme(),
            'active_plugins' => $this->deensimc_get_active_plugins(),
            'wp_multisite' => is_multisite() ? 'Yes' : 'No'
        );

        // User data (only if not anonymous)
        $user_data = array();
        if (!$anonymous) {
            $current_user = wp_get_current_user();
            $user_data = array(
                'email' => $current_user->user_email,
                'first_name' => $current_user->first_name,
                'last_name' => $current_user->last_name,
                'domain' => $this->deensimc_get_site_domain()
            );
        }

        return array(
            'plugin_data' => $plugin_data,
            'wordpress_data' => $wordpress_data,
            'environment_data' => $environment_data,
            'user_data' => $user_data,
            'anonymous' => $anonymous
        );
    }

    /**
     * Get active theme information
     */
    private function deensimc_get_active_theme() {
        $theme = wp_get_theme();
        return array(
            'name' => $theme->get('Name'),
            'version' => $theme->get('Version'),
            'author' => $theme->get('Author')
        );
    }

    /**
     * Get active plugins list
     */
    private function deensimc_get_active_plugins() {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $active_plugins = get_option('active_plugins', array());
        $plugins_list = array();

        foreach ($active_plugins as $plugin_path) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_path);
            $plugins_list[] = array(
                'name' => $plugin_data['Name'],
                'version' => $plugin_data['Version']
            );
        }

        return $plugins_list;
    }

    /**
     * Get site domain
     */
    private function deensimc_get_site_domain() {
        return wp_parse_url(get_site_url(), PHP_URL_HOST);
    }

    function deensimc_submit_deactivation_response() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( 'Insufficient permissions' );
        }

        if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['_wpnonce'] ) ) , 'deensimc_deactivate_plugin' ) ) {
            wp_send_json_error( 'Security check failed' );
        }

        // Get the submitted data from JavaScript
        $reason = isset( $_POST['reason'] ) ? sanitize_text_field( wp_unslash( $_POST['reason'] ) ) : 'other';
        $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : 'N/A';
        $anonymous = isset($_POST['anonymous']) && $_POST['anonymous'] === '1';

        // Map reasons to expected API values
        $reason_map = array(
            'temp' => 'temporary_deactivation',
            'setup' => 'setup_difficult', 
            'e-issues' => 'elementor_issues',
            'documentation' => 'lack_documentation',
            'features' => 'missing_features',
            'better-plugin' => 'better_plugin',
            'incompatibility' => 'incompatible',
            'other' => 'other'
        );

        $final_reason = isset($reason_map[$reason]) ? $reason_map[$reason] : 'other';

        // Feedback data
        $feedback_data = $this->deensimc_collect_feedback_data($final_reason, $message, $anonymous);

        $api_data = array(
            'server_info' => $feedback_data['wordpress_data'],
            'extra_details' => array(
                'wp_theme'       => $feedback_data['environment_data']['active_theme'],
                'active_plugins' => $feedback_data['environment_data']['active_plugins'],
            ),
            'plugin_version' => $this->plugin_version,
            'plugin_name'    => $this->plugin_name,
            'reason'         => $final_reason,
            'review'         => $message,
            'email'          => $anonymous ? null : $feedback_data['user_data']['email'],
            'domain'         => $anonymous ? null : $feedback_data['user_data']['domain'],
            'site_id'        => $anonymous ? 'anonymous_' . wp_generate_password(12, false) : md5(get_site_url() . '-13'),
            'product_uuid' => '1761028074-8691d3e4ae764e91aa611f6bacc4ba73',
            'anonymous'      => $anonymous,
            'comprehensive_data' => $feedback_data,
        );

        $args = array(
            'timeout' => 30,
            'headers' => array(
                'Content-Type' => 'application/json; charset=utf-8',
                'Accept'       => 'application/json',
            ),
            'body'    => wp_json_encode( $api_data ),
        );         

        $response = wp_remote_post( $this->feedback_url, $args );

        wp_send_json_success( 'Feedback submitted successfully' );

    }
}

new deensimc_feedback();
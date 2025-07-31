<?php

class Your_Pro_Widget extends \Elementor\Widget_Base {
    
    public function get_name() {
        return 'your-pro-widget';
    }

    public function get_title() 
	{
		return esc_html__( 'Your pro', 'marquee-addons-for-elementor' );
	}

    public function get_promotion_config() {
        return [
            'is_pro' => true,
            'promotion' => [
                'title' => __('Pro Widget', 'marquee-addons-for-elementor'),
                'content' => __('This is a premium feature. Upgrade to unlock!', 'marquee-addons-for-elementor'),
                'upgrade_url' => 'https://your-site.com/upgrade',
                'upgrade_text' => __('Upgrade Now', 'marquee-addons-for-elementor'),
            ]
        ];
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        
        // Only load in editor
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $this->enqueue_promotion_scripts();
        }
    }

    private function enqueue_promotion_scripts() {
        wp_enqueue_script('deensimc_pro_js');
        
        wp_localize_script('deensimc_pro_js', 'deensimcProData_' . $this->get_name(), [
            'isProActive' => defined('DEENSIMC_PRO_VERSION'),
            'promotion' => $this->get_promotion_config()['promotion']
        ]);
    }

    // Add this method to completely disable the widget in free version
    public function is_editable() {
        return defined('DEENSIMC_PRO_VERSION');
    }
}
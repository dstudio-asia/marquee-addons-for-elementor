<?php
class Dynamic_Pro_Widget extends \Elementor\Widget_Base {

    public $widget_name;
    public $widget_title;
    public $promotion_url;
    
    public function __construct($data = [], $args = null) {
        $this->widget_name = $data['name'];
        $this->widget_title = $data['title'];
        $this->promotion_url = $data['promotion_url'];
        parent::__construct($data, $args);

        // Enqueue promotion scripts
        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $this->enqueue_promotion_scripts();
        }
    }

    public function get_name() {
        return $this->widget_name;
    }

    public function get_title() {
        return esc_html__($this->widget_title, 'marquee-addons-for-elementor');
    }

    public function get_promotion_config() {
        return [
            'is_pro' => true,
            'promotion' => [
                'title' => __('Pro Widget', 'marquee-addons-for-elementor'),
                'content' => __('This is a premium feature. Upgrade to unlock!', 'marquee-addons-for-elementor'),
                'upgrade_url' => $this->promotion_url,
                'upgrade_text' => __('Upgrade Now', 'marquee-addons-for-elementor'),
            ]
        ];
    }

    private function enqueue_promotion_scripts() {
        wp_enqueue_script('deensimc_pro_js');
        wp_localize_script('deensimc_pro_js', 'deensimcProData_' . $this->get_name(), [
            'isProActive' => defined('DEENSIMC_PRO_VERSION'),
            'promotion' => $this->get_promotion_config()['promotion']
        ]);
    }

    public function is_editable() {
        return defined('DEENSIMC_PRO_VERSION');
    }

    // Add the widget's content rendering method (can be customized)
    public function render() {
        echo '<div class="pro-widget-content">';
        echo '<p>' . esc_html__('This is a pro widget.', 'marquee-addons-for-elementor') . '</p>';
        echo '</div>';
    }
}

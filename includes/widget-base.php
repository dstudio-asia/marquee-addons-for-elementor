<?php
class Dynamic_Pro_Widget extends \Elementor\Widget_Base {

    protected $widget_name;
    protected $widget_title;
    protected $promotion_url;

    public function __construct( $data = [], $args = [] ) {
        parent::__construct($data, $args);

        $this->widget_name = $args['id'] ?? 'dynamic-pro-widget';
        $this->widget_title = $args['title'] ?? 'Pro Widget';
        $this->promotion_url = $args['promotion_url'] ?? '#';

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
                'title' =>  $this->widget_title,
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

     public function get_categories() {
        return ['deensimc_smooth_marquee_pro'];
    }

    public function is_editable() {
        return defined('DEENSIMC_PRO_VERSION');
    }

}

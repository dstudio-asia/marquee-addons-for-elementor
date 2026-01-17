<?php

if (! defined('ABSPATH')) {
    exit;
}

trait Deensimc_Promotional_Banner
{    protected function get_upsale_data(): array
    {
        return [
            'condition'   => !class_exists('\Deensimcpro_Marquee\Marqueepro'),
            'image'       => esc_url(ELEMENTOR_ASSETS_URL . 'images/go-pro.svg'),
            'image_alt'   => esc_attr__('Upgrade', 'marquee-addons-for-elementor'),
            'title'       => esc_html__('Get Marquee Addons Pro', 'marquee-addons-for-elementor'),
            'description' => esc_html__('Get the premium version of the Marquee Addons and grow your website capabilities.', 'marquee-addons-for-elementor'),
            'upgrade_url' => esc_url('https://marqueeaddons.com/#pricing-section'),
            'upgrade_text' => esc_html__('Upgrade Now', 'marquee-addons-for-elementor'),
        ];
    }
}

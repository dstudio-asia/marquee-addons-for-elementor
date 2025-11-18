<?php

trait Deensimcpro_Promo
{
    /**
     * Single source of truth for PRO widgets data
     */
    private static function get_pro_widgets_data() {
        return [
            'deensimcpro-3d-grid-marquee' => [
                'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro-card-list' => [
                'title'  => __('Card Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro-circular-text-pro' => [
                'title'  => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
            ],
            'deensimcpro-image-accordion' => [
                'title'  => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
            ],
            'deensimcpro-media-marquee' => [
                'title'  => __('Media Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-media-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro-post-marquee' => [
                'title'  => __('Post Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-post-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro_product_category_marquee' => [
                'title'  => __('Product Category Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro_product_marquee' => [
                'title'  => __('Product Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro-sticky-cards' => [
                'title'  => __('Sticky Cards', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
            ],
            'deensimc-testimonial-pro' => [
                'title'  => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
            ],
            'deensimc-smooth-text-pro' => [
                'title'  => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
            ],
            'deensimcpro-smart-tabs' => [
                'title'  => __('Smart Tabs', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-tabs eicon-deensimc-pro',
            ],
            'deensimcpro-animated-list' => [
                'title'  => __('Animated List', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-post-list eicon-deensimc-pro',
            ],
        ];
    }

    /**
     * Get raw widgets list (for Control Manager) - Same as old WidgetsList trait
     */
    public static function get_widgets_list() {
        $widgets_data = self::get_pro_widgets_data();
        $formatted_widgets = [];
        
        foreach ($widgets_data as $key => $widget) {
            $formatted_widgets[$key] = [
                'cat'    => 'general',
                'title'  => $widget['title'],
                'icon'   => $widget['icon'],
                'is_pro' => true,
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ];
        }
        
        return $formatted_widgets;
    }

    /**
     * Promote pro elements for Elementor
     */
    public function promote_pro_elements($config) {
        $promotion_widgets = [];

        if (isset($config['promotionWidgets'])) {
            $promotion_widgets = $config['promotionWidgets'];
        }

        $widgets_data = self::get_pro_widgets_data();
        $pro_widgets_formatted = [];
        
        foreach ($widgets_data as $key => $widget) {
            $pro_widgets_formatted[] = [
                'name'       => $key,
                'title'      => $widget['title'],
                'icon'       => $widget['icon'],
                'categories' => '["marquee_addons_pro_promo"]',
            ];
        }

        $config['promotionWidgets'] = array_merge($promotion_widgets, $pro_widgets_formatted);

        return $config;
    }
}
<?php

namespace Deensimc_Marquee\Misc;


trait Deensimcpro_Promo
{

    public function localize_promotion_script()
    {
        wp_localize_script(
            'deensimc-promotion-script',
            'DeensimcPromo',
            [
                'is_pro_active' =>  class_exists('\Deensimcpro_Marquee\Marqueepro'),
                // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
                'is_license_active' =>  apply_filters('marquee_addons_is_license_active', false),
                'license_page' => home_url() . '/wp-admin/admin.php?page=marquee-addons-license'
            ]
        );
    }

    public function promote_pro_elements($config)
    {
        $promotion_widgets = [];

        if (isset($config['promotionWidgets'])) {
            $promotion_widgets = $config['promotionWidgets'];
        }

        $combine_array = array_merge(
            $promotion_widgets,
            [
                [
                    'name'       => 'deensimcpro-3d-grid-marquee',
                    'title'      => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-card-list',
                    'title'      => __('Card Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-circular-text-pro',
                    'title'      => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-image-accordion',
                    'title'      => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-media-marquee',
                    'title'      => __('Media Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-media-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-post-marquee',
                    'title'      => __('Post Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-post-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro_product_category_marquee',
                    'title'      => __('Product Category Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro_product_marquee',
                    'title'      => __('Product Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-sticky-cards',
                    'title'      => __('Sticky Cards', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimc-testimonial-pro',
                    'title'      => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimc-smooth-text-pro',
                    'title'      => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
                    'icon'       => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-smart-tabs',
                    'title'      => __('Smart Tabs', 'marquee-addons-for-elementor'),
                    'icon'       => 'eicon-tabs eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-animated-list',
                    'title'      => __('Animated List', 'marquee-addons-for-elementor'),
                    'icon'       => 'eicon-post-list eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-bento-grid',
                    'title'      => __('Bento Grid', 'marquee-addons-for-elementor'),
                    'icon'       => 'eicon-gallery-grid eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
                [
                    'name'       => 'deensimcpro-text-reveal',
                    'title'      => __('Text Reveal', 'marquee-addons-for-elementor'),
                    'icon'       => 'eicon-animation-text eicon-deensimc-pro',
                    'categories' => '["marquee_addons_pro_promo"]',
                ],
            ]
        );

        $config['promotionWidgets'] = $combine_array;

        return $config;
    }
}

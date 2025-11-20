<?php

namespace Deensimc_Marquee;

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

trait WidgetsList {
    public static function get_widgets_list() {
        return [
            'deensimcpro-3d-grid-marquee' => [
                'cat'    => 'general',
                'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-card-list' => [
                'cat'    => 'general',
                'title'  => __('Card Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-circular-text-pro' => [
                'cat'    => 'general',
                'title'  => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-image-accordion' => [
                'cat'    => 'general',
                'title'  => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-media-marquee' => [
                'cat'    => 'general',
                'title'  => __('Media Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-media-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-post-marquee' => [
                'cat'    => 'general',
                'title'  => __('Post Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-post-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-product-category-marquee' => [
                'cat'    => 'general',
                'title'  => __('Product Category Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-product-marquee' => [
                'cat'    => 'general',
                'title'  => __('Product Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-sticky-cards' => [
                'cat'    => 'general',
                'title'  => __('Sticky Cards', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimc-testimonial-pro' => [
                'cat'    => 'general',
                'title'  => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimc-smooth-text-pro' => [
                'cat'    => 'general',
                'title'  => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-smart-tabs' => [
                'cat'    => 'general',
                'title'  => __('Smart Tabs', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-tabs eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-animated-list' => [
                'cat'    => 'general',
                'title'  => __('Animated List', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-post-list eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ],
            'deensimcpro-bento-grid' => [
                'cat'    => 'general',
                'title'  => __('Bento Grid', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-gallery-grid eicon-deensimc-pro',
                'is_pro' => true,
                'demo'   => 'https://marqueeaddons.com/pricing',
                'pro_url' => 'https://marqueeaddons.com/pricing/'
            ]
        ];
    }
}
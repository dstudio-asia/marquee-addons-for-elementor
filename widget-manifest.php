<?php
/**
 * Widget Manifest for Marquee Addons
 *
 * This file acts as a single source of truth for all widget configurations,
 * containing both display-related information and technical registration details.
 */

if (!defined('ABSPATH')) exit;

return [
    // Free Widgets
    'deensimc-image-marquee' => [
        'title'  => __('Image Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-image-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/image-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/image-marquee/',
        ],
        'file' => 'class-deensimc-image-marquee.php',
        'class' => '\Deensimc_Image_Marquee',
    ],
    'deensimc-text-marquee' => [
        'title'  => __('Text Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-text-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/text-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/text-marquee/',
        ],
        'file' => 'class-deensimc-text-marquee.php',
        'class' => '\Deensimc_Text_Marquee',
    ],
    'deensimc-testimonial-marquee' => [
        'title'  => __('Testimonial Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-testimonial-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/testimonial-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/testimonial-marquee/',
        ],
        'file' => 'class-deensimc-testimonial-marquee.php',
        'class' => '\Deensimc_Testimonial_Marquee',
    ],
    'deensimc-video-marquee' => [
        'title'  => __('Video Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-video-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/video-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/video-marquee/',
        ],
        'file' => 'class-deensimc-video-marquee.php',
        'class' => '\Deensimc_Video_Marquee',
    ],
    'deensimc-stacked-slider' => [
        'title'  => __('Stacked Slider', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-stacked-slider-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/stacked-slider/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/stacked-slider/',
            '/includes/widgets/traits/stacked-slider/content-parts/',
        ],
        'file' => 'class-deensimc-stacked-slider.php',
        'class' => '\Deensimc_Stacked_Slider',
    ],
    'deensimc-image-accordion' => [
        'title'  => __('Image Accordion', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-image-accordion-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/marquee-demos/image-accordion/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/image-accordion/',
        ],
        'file' => 'class-deensimc-image-accordion.php',
        'class' => '\Deensimc_Image_Accordion',
    ],
    'deensimc-news-ticker' => [
        'title'  => __('News Ticker', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-news-ticker-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/news-ticker/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/news-ticker/',
        ],
        'file' => 'class-deensimc-news-ticker.php',
        'class' => '\Deensimc_News_Ticker',
    ],
    'deensimc-animated-word-roller' => [
        'title'  => __('Animated Word Roller', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-animated-word-roller-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/marquee-demos/animated-word-roller/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/animated-word-roller/',
        ],
        'file' => 'class-deensimc-animated-word-roller.php',
        'class' => '\Deensimc_Animated_Word_Roller',
    ],
    'deensimc-animated-heading' => [
        'title'  => __('Animated Heading', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-animated-heading-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/animated-heading/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/animated-heading/',
        ],
        'file' => 'class-deensimc-animated-heading.php',
        'class' => '\Deensimc_Animated_Heading_Widget',
    ],
    'deensimc-button-marquee' => [
        'title'  => __('Button Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-button-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/button-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/button-marquee/',
        ],
        'file' => 'class-deensimc-button-marquee.php',
        'class' => '\Deensimc_Button_marquee',
    ],
    'deensimc-search-box' => [
        'title'  => __('Search Box', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-search-icon',
        'is_pro' => false,
        'demo'   => '#',
        'cat'    => 'general',
        'pro_url' => '',
        'trait_dirs' => [
            '/includes/widgets/traits/search/',
        ],
        'file' => 'class-deensimc-search.php',
        'class' => '\Deensimc_Search_Widget',
    ],

    // PRO Widgets & Extensions
    'deensimcpro-3d-grid-marquee' => [
        'cat'    => 'general',
        'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/3d-grid-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-card-list' => [
        'cat'    => 'general',
        'title'  => __('Card Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/card-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-circular-text-pro' => [
        'cat'    => 'general',
        'title'  => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/circular-text-rotation/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-image-accordion' => [
        'cat'    => 'general',
        'title'  => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/image-accordion-pro/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-media-marquee' => [
        'cat'    => 'general',
        'title'  => __('Media Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-media-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/pricing',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-post-marquee' => [
        'cat'    => 'general',
        'title'  => __('Post Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-post-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/post-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-product-category-marquee' => [
        'cat'    => 'woocommerce',
        'title'  => __('Product Category Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/product-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-product-marquee' => [
        'cat'    => 'woocommerce',
        'title'  => __('Product Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/product-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-sticky-cards' => [
        'cat'    => 'general',
        'title'  => __('Sticky Cards', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/sticky-cards/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimc-testimonial-pro' => [
        'cat'    => 'general',
        'title'  => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/testimonial-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimc-smooth-text-pro' => [
        'cat'    => 'general',
        'title'  => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/text-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-smart-tabs' => [
        'cat'    => 'general',
        'title'  => __('Smart Tabs', 'marquee-addons-for-elementor'),
        'icon'   => 'eicon-tabs eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/smart-tabs/',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-animated-list' => [
        'cat'    => 'general',
        'title'  => __('Animated List', 'marquee-addons-for-elementor'),
        'icon'   => 'eicon-post-list eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/pricing',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-bento-grid' => [
        'cat'    => 'general',
        'title'  => __('Bento Grid', 'marquee-addons-for-elementor'),
        'icon'   => 'eicon-gallery-grid eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/pricing',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add PRO trait directories
        // 'file' => '',   // TODO: Add PRO file
        // 'class' => '',  // TODO: Add PRO class
    ],
    'deensimcpro-container-background' => [
        'title'  => __('Container Background', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-admin-appearance',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add trait directories
        // 'file' => '',   // TODO: Add file
        // 'class' => '',  // TODO: Add class
    ],
    'deensimcpro-heading-effect' => [
        'title'  => __('Heading Effect', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-editor-textcolor',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add trait directories
        // 'file' => '',   // TODO: Add file
        // 'class' => '',  // TODO: Add class
    ],
    'deensimcpro-image-rotation' => [
        'title'  => __('Image Rotation', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-format-image',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
        // 'trait_dirs' => [], // TODO: Add trait directories
        // 'file' => '',   // TODO: Add file
        // 'class' => '',  // TODO: Add class
    ],
];

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
        'traits' => [
            '/includes/widgets/traits/image-marquee/content-image.php',
            '/includes/widgets/traits/image-marquee/style-image-controls.php',
            '/includes/widgets/traits/image-marquee/style-caption-controls.php',
        ],
        'file' => '/includes/widgets/class-deensimc-image-marquee.php',
        'class' => '\Deensimc_Image_Marquee',
    ],
    'deensimc-text-marquee' => [
        'title'  => __('Text Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-text-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/text-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/text-marquee/content-text-repeater.php',
            '/includes/widgets/traits/text-marquee/style-text-contents.php',
        ],
        'file' => '/includes/widgets/class-deensimc-text-marquee.php',
        'class' => '\Deensimc_Text_Marquee',
    ],
    'deensimc-testimonial-marquee' => [
        'title'  => __('Testimonial Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-testimonial-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/testimonial-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/testimonial-marquee/helper-methods.php',
            '/includes/widgets/traits/testimonial-marquee/content-repeater.php',
            '/includes/widgets/traits/testimonial-marquee/content-text-unfold.php',
            '/includes/widgets/traits/testimonial-marquee/style-contents-box.php',
            '/includes/widgets/traits/testimonial-marquee/style-contents.php',
            '/includes/widgets/traits/testimonial-marquee/style-image.php',
            '/includes/widgets/traits/testimonial-marquee/style-name-title.php',
            '/includes/widgets/traits/testimonial-marquee/style-review.php',
        ],
        'file' => '/includes/widgets/class-deensimc-testimonial-marquee.php',
        'class' => '\Deensimc_Testimonial_Marquee',
    ],
    'deensimc-video-marquee' => [
        'title'  => __('Video Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-video-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/video-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/video-marquee/helper-methods.php',
            '/includes/widgets/traits/video-marquee/content-url-fields.php',
            '/includes/widgets/traits/video-marquee/content-video-options.php',
            '/includes/widgets/traits/video-marquee/content-youtube-vimeo.php',
            '/includes/widgets/traits/video-marquee/content-hosted.php',
            '/includes/widgets/traits/video-marquee/content-image-overlay.php',
            '/includes/widgets/traits/video-marquee/style-contents.php',
            '/includes/widgets/traits/video-marquee/style-play-icon.php',
        ],
        'file' => '/includes/widgets/class-deensimc-video-marquee.php',
        'class' => '\Deensimc_Video_Marquee',
    ],
    'deensimc-stacked-slider' => [
        'title'  => __('Stacked Slider', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-stacked-slider-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/stacked-slider/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/stacked-slider/content-advance.php',
            '/includes/widgets/traits/stacked-slider/content-primary.php',
            '/includes/widgets/traits/stacked-slider/style-box.php',
            '/includes/widgets/traits/stacked-slider/content-parts/style-title-controls.php',
            '/includes/widgets/traits/stacked-slider/content-parts/style-description-controls.php',
            '/includes/widgets/traits/stacked-slider/content-parts/style-color-controls.php',
            '/includes/widgets/traits/stacked-slider/content-parts/style-button-controls.php',
            '/includes/widgets/traits/stacked-slider/style-contents.php',
            '/includes/widgets/traits/stacked-slider/style-image.php',
            '/includes/widgets/traits/stacked-slider/style-dots.php',
        ],
        'file' => '/includes/widgets/class-deensimc-stacked-slider.php',
        'class' => '\Deensimc_Stacked_Slider',
    ],
    'deensimc-image-accordion' => [
        'title'  => __('Image Accordion', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-image-accordion-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/marquee-demos/image-accordion/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/image-accordion/content.php',
            '/includes/widgets/traits/image-accordion/style.php',
        ],
        'file' => '/includes/widgets/class-deensimc-image-accordion.php',
        'class' => '\Deensimc_Image_Accordion',
    ],
    'deensimc-news-ticker' => [
        'title'  => __('News Ticker', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-news-ticker-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/news-ticker/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/news-ticker/news-ticker-layout-control.php',
            '/includes/widgets/traits/news-ticker/style-section-control.php',
            '/includes/widgets/traits/news-ticker/news-ticker-query-control.php',
        ],
        'file' => '/includes/widgets/class-deensimc-news-ticker.php',
        'class' => '\Deensimc_News_Ticker',
    ],
    'deensimc-animated-word-roller' => [
        'title'  => __('Animated Word Roller', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-animated-word-roller-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/marquee-demos/animated-word-roller/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/animated-word-roller/content-additional-options.php',
            '/includes/widgets/traits/animated-word-roller/content-text-repeater.php',
            '/includes/widgets/traits/animated-word-roller/style-contents.php',
        ],
        'file' => '/includes/widgets/class-deensimc-animated-word-roller.php',
        'class' => '\Deensimc_Animated_Word_Roller',
    ],
    'deensimc-animated-heading' => [
        'title'  => __('Animated Heading', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-animated-heading-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/animated-heading/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/animated-heading/trait-animated-text-effect-controls.php',
            '/includes/widgets/traits/animated-heading/trait-animation-controls.php',
            '/includes/widgets/traits/animated-heading/trait-text-styles-controls.php',
            '/includes/widgets/traits/animated-heading/trait-title-controls.php',
        ],
        'file' => '/includes/widgets/class-deensimc-animated-heading.php',
        'class' => '\Deensimc_Animated_Heading_Widget',
    ],
    'deensimc-button-marquee' => [
        'title'  => __('Button Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-button-marquee-icon',
        'is_pro' => false,
        'demo'   => 'https://marqueeaddons.com/button-marquee/',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/button-marquee/trait-button-controls.php',
            '/includes/widgets/traits/button-marquee/trait-button-style-controls.php',
            '/includes/widgets/traits/button-marquee/trait-button-marquee-controls.php',
            '/includes/widgets/traits/button-marquee/trait-button-helper-methods.php',
        ],
        'file' => '/includes/widgets/class-deensimc-button-marquee.php',
        'class' => '\Deensimc_Button_marquee',
    ],
    'deensimc-search-box' => [
        'title'  => __('Search Box', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimc-search-icon',
        'is_pro' => false,
        'demo'   => '#',
        'cat'    => 'general',
        'pro_url' => '',
        'traits' => [
            '/includes/widgets/traits/search/clear-styles-controls.php',
            '/includes/widgets/traits/search/query-content-controls.php',
            '/includes/widgets/traits/search/search-content-controls.php',
            '/includes/widgets/traits/search/search-field-styles.php',
            '/includes/widgets/traits/search/style-triggerer-controls.php',
            '/includes/widgets/traits/search/submit-styles-controls.php',
        ],
        'file' => '/includes/widgets/class-deensimc-search.php',
        'class' => '\Deensimc_Search_Widget',
    ],

    // PRO Widgets
    'deensimcpro-3d-grid-marquee' => [
        'cat'    => 'general',
        'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/3d-grid-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-card-list' => [
        'cat'    => 'general',
        'title'  => __('Card Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/card-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-circular-text-pro' => [
        'cat'    => 'general',
        'title'  => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/circular-text-rotation/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-image-accordion' => [
        'cat'    => 'general',
        'title'  => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/image-accordion-pro/',
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
        'demo'   => 'https://marqueeaddons.com/post-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-product-category-marquee' => [
        'cat'    => 'general',
        'title'  => __('Product Category Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/product-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-product-marquee' => [
        'cat'    => 'general',
        'title'  => __('Product Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/product-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-sticky-cards' => [
        'cat'    => 'general',
        'title'  => __('Sticky Cards', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/sticky-cards/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimc-testimonial-pro' => [
        'cat'    => 'general',
        'title'  => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/testimonial-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimc-smooth-text-pro' => [
        'cat'    => 'general',
        'title'  => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
        'icon'   => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/text-marquee/',
        'pro_url' => 'https://marqueeaddons.com/pricing/'
    ],
    'deensimcpro-smart-tabs' => [
        'cat'    => 'general',
        'title'  => __('Smart Tabs', 'marquee-addons-for-elementor'),
        'icon'   => 'eicon-tabs eicon-deensimc-pro',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/smart-tabs/',
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
    ],

    // Extensions (PRO Features)
    'deensimcpro-container-background' => [
        'title'  => __('Container Background', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-admin-appearance',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
    ],
    'deensimcpro-heading-effect' => [
        'title'  => __('Heading Effect', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-editor-textcolor',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
    ],
    'deensimcpro-image-rotation' => [
        'title'  => __('Image Rotation', 'marquee-addons-for-elementor'),
        'icon'   => 'dashicons dashicons-format-image',
        'is_pro' => true,
        'demo'   => 'https://marqueeaddons.com/',
        'cat'    => 'extensions',
        'pro_url' => 'https://marqueeaddons.com/pricing/',
    ],
];

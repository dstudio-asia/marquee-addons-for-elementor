<?php

namespace Deensimc_Marquee\Misc;


class Marquee_Addons_Pro_Widgets_Placeholder
{

    public function __construct()
    {
        add_action('elementor/editor/after_enqueue_scripts', [Marquee_Addons_Pro_Widgets_Placeholder::class, 'editor_enqueue'], 20);
    }

    public static function get_pro_widget_map()
    {
        return [
            'deensimcpro-3d-grid-marquee'          => [
                'cat'    => 'general',
                'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-card-list'          => [
                'cat'    => 'general',
                'title'  => __('Card Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-card-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-circular-text-pro'          => [
                'cat'    => 'general',
                'title'  => __('Circular Text Rotation', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-circular-text-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-image-accordion'          => [
                'cat'    => 'general',
                'title'  => __('Image Accordion Pro', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-image-accordion-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-media-marquee'          => [
                'cat'    => 'general',
                'title'  => __('Media Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-media-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-post-marquee'          => [
                'cat'    => 'general',
                'title'  => __('Post Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-post-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro_product_category_marquee'          => [
                'cat'    => 'general',
                'title'  => __('Product Category Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-cat-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro_product_marquee'          => [
                'cat'    => 'general',
                'title'  => __('Product Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-product-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-sticky-cards'          => [
                'cat'    => 'general',
                'title'  => __('Sticky Cards', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-sticky-cards-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimc-testimonial-pro'          => [
                'cat'    => 'general',
                'title'  => __('Advanced Testimonial Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-testimonial-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimc-smooth-text-pro'          => [
                'cat'    => 'general',
                'title'  => __('Advanced Text Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-text-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-smart-tabs'          => [
                'cat'    => 'general',
                'title'  => __('Smart Tabs', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-tabs eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
            'deensimcpro-animated-list'          => [
                'cat'    => 'general',
                'title'  => __('Animated List', 'marquee-addons-for-elementor'),
                'icon'   => 'eicon-post-list eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
        ];
    }

    public static function editor_enqueue()
    {
        // Base localization data passed to JS
        $localize_data = [
            'placeholder_widgets' => self::get_pro_widget_map(),
            'hasPro'              => class_exists('\Deensimcpro_Marquee\Marqueepro'),
            'i18n' => [
                /* translators: %s: Widget name */
                'promotionDialogHeader'     => esc_html__('%s Widget', 'marquee-addons-for-elementor'),
                /* translators: %s: Widget name (used in promotional message) */
                'promotionDialogMessage'    => esc_html__(
                    'Use %s widget with other exclusive Pro widgets and 100% unique features to extend your toolbox and build sites faster and better.',
                    'marquee-addons-for-elementor'
                ),
                'promotionDialogBtnTxt'     => esc_html__('Upgrade Now', 'marquee-addons-for-elementor'),

                // Optional: template localization strings (used in panel UI)
                'templatesEmptyTitle'       => esc_html__('No Templates Found', 'marquee-addons-for-elementor'),
                'templatesEmptyMessage'     => esc_html__('Try a different category or sync for new templates.', 'marquee-addons-for-elementor'),
                'templatesNoResultsTitle'   => esc_html__('No Results Found', 'marquee-addons-for-elementor'),
                'templatesNoResultsMessage' => esc_html__('Please make sure your search is spelled correctly or try a different keyword.', 'marquee-addons-for-elementor'),
            ],
        ];

        // Localize the script properly
        wp_localize_script(
            'deensimc-editor-script',
            'MarqueeAddonsEditor',
            $localize_data
        );
    }
}

new Marquee_Addons_Pro_Widgets_Placeholder();

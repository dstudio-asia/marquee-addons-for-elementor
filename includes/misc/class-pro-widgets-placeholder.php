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
            '3d-grid-marquee'          => [
                'cat'    => 'general',
                'title'  => __('3D Grid Marquee', 'marquee-addons-for-elementor'),
                'icon'   => 'deensimcpro-3d-grid-marquee-icon eicon-deensimc-pro',
                'is_pro' => true,
                'demo'      => 'https://marqueeaddons.com/pricing',
            ],
        ];
    }

    public static function editor_enqueue()
    {
        $localize_data = [
            'placeholder_widgets' => [],
            'hasPro'                  => false,
            'i18n' => [
                'promotionDialogHeader'     => esc_html__('%s Widget', 'marquee-addons-for-elementor'),
                'promotionDialogMessage'    => esc_html__('Use %s widget with other exclusive pro widgets and 100% unique features to extend your toolbox and build sites faster and better.', 'marquee-addons-for-elementor'),
                'promotionDialogBtnTxt'    => esc_html__('Upgrade Now', 'marquee-addons-for-elementor'),
                'templatesEmptyTitle'       => esc_html__('No Templates Found', 'marquee-addons-for-elementor'),
                'templatesEmptyMessage'     => esc_html__('Try different category or sync for new templates.', 'marquee-addons-for-elementor'),
                'templatesNoResultsTitle'   => esc_html__('No Results Found', 'marquee-addons-for-elementor'),
                'templatesNoResultsMessage' => esc_html__('Please make sure your search is spelled correctly or try a different words.', 'marquee-addons-for-elementor'),
            ],
        ];

        $localize_data['placeholder_widgets'] = self::get_pro_widget_map();

        wp_localize_script(
            'deensimc-editor-script',
            'MarqueeAddonsEditor',
            $localize_data
        );
    }
}

new Marquee_Addons_Pro_Widgets_Placeholder();

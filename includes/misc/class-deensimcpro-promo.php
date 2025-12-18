<?php

namespace Deensimc_Marquee\Misc;

require_once DEENSIMC__DIR__ . '/traits/Manifest_Loader.php';

use Deensimc_Marquee\Manifest_Loader;


trait Deensimcpro_Promo
{
    use Manifest_Loader;

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
        $existing_promotion_widgets = isset($config['promotionWidgets']) ? $config['promotionWidgets'] : [];

        $all_widgets = self::get_manifest();

        $promotion_widgets = [];

        foreach ($all_widgets as $name => $widget) {
            if (!empty($widget['is_pro']) && $widget['cat'] !== 'extensions') {
                $promotion_widgets[] = [
                    'name'       => $name,
                    'title'      => $widget['title'],
                    'icon'       => $widget['icon'],
                    'categories' => '["marquee_addons_pro_promo"]',
                ];
            }
        }

        $config['promotionWidgets'] = array_merge($existing_promotion_widgets, $promotion_widgets);

        return $config;
    }
}

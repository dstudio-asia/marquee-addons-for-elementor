<?php
if (!defined('ABSPATH')) {
    exit;
}

trait Deensimc_Allowed_Tags
{
    protected function get_allowed_icon_tags()
    {
        return [
            'i' => [
                'class'       => [],
                'aria-hidden' => [],
            ],
            'svg' => [
                'class'   => [],
                'width'   => [],
                'height'  => [],
                'viewBox' => [],
                'fill'    => [],
                'xmlns'   => [],
            ],
            'path' => [
                'd'    => [],
                'fill' => [],
            ],
        ];
    }
}

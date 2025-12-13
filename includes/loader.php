<?php
class Deensimc_Loader {

    public static function init() {
        self::load_files();
    }

    protected static function load_files() {
        require_once DEENSIMC__DIR__ . '/traits/Utils.php';
        require_once DEENSIMC__DIR__ . '/traits/WidgetsList.php';
        require_once DEENSIMC__DIR__ . '/classes/widgets-manager.php';
        require_once DEENSIMC__DIR__ . '/classes/controls-manager.php';
    }
}

Deensimc_Loader::init();

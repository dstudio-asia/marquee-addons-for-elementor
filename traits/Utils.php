<?php 

if (! defined('ABSPATH')) {
    exit;
}

trait Deensimc_Utils {
    
    /**
     * Allowed HTML tags
     *
     * @var array
     */
    private static $allowed_tags = [
        'a',
        'article',
        'aside',
        'button',
        'div',
        'footer',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'header',
        'main',
        'nav',
        'p',
        'section',
        'span',
    ];

    /**
     * Validate HTML tag
     *
     * @param string $tag Tag to validate
     * @return string Validated tag or 'div' as default
     */
    public static function validate_html_tag( $tag ) {
        return $tag && in_array( strtolower( $tag ), self::$allowed_tags, true ) ? strtolower( $tag ) : 'div';
    }
}
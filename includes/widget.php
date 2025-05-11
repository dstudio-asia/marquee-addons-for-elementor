<?php
namespace Deensimc_Marquee;

final class Marquee {
	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */

	const VERSION = '1.2.6';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */

	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Deensimc_Marquee\Marquee The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Deensimc_Marquee\Marquee  An instance of the class.
	 */

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	public function deensimc_allowed_tags()
    {
        $allowed_tags = array(
            'strong' => array(),
        );
        return $allowed_tags;
    }

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	 
	public function is_compatible() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_missing_main_plugin() {

		$message = sprintf(
			/* translators: %1$s is replaced with "MarqueeAddons - Smooth Infinite marquee carousel loop for elementor"  and %2$s is replaced with "Elementor"*/
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'marquee-addons-for-elementor' ),
			'<strong>' . esc_html__( 'MarqueeAddons - Smooth Infinite marquee carousel loop for elementor', 'marquee-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'marquee-addons-for-elementor' ) . '</strong>'

		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, $this->deensimc_allowed_tags() ) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_elementor_version() {

		$message = sprintf(
			/* translators: %1$s is replaced with "MarqueeAddons - Smooth Infinite marquee carousel loop for elementor", %2$s is replaced with "Elementor", %3$s is replaced with "3.8.0" */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'marquee-addons-for-elementor' ),
			'<strong>' . esc_html__( 'MarqueeAddons - Smooth Infinite marquee carousel loop for elementor', 'marquee-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'marquee-addons-for-elementor' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION

		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, $this->deensimc_allowed_tags() ) );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_php_version() {

		$message = sprintf(
			/* translators: %1$s is replaced with "MarqueeAddons - Smooth Infinite marquee carousel loop for elementor", %2$s is replaced with "php", %3$s is replaced with "7.4" */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'marquee-addons-for-elementor' ),
			'<strong>' . esc_html__( 'MarqueeAddons - Smooth Infinite marquee carousel loop for elementor', 'marquee-addons-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'marquee-addons-for-elementor' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
			 
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses( $message, $this->deensimc_allowed_tags() ) );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	
	public function init() {

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'deensimc_frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'deensimc_frontend_scripts' ] );
		add_action( 'elementor/widgets/register', [ $this, 'deensimc_register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'deensimc_add_categories' ] );
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'deensimc_editor_styles' ] );

	}

	public function deensimc_frontend_styles() {

		wp_register_style( 'deensimc-swiper-style', DEENSIMC_ASSETS_URL . 'css/swiper.css', null, self::VERSION, false );
		wp_register_style( 'deensimc-accordion-style', DEENSIMC_ASSETS_URL . 'css/accordion.css', null, self::VERSION, false );
		wp_register_style( 'deensimc-swiper-bundle-min-style', DEENSIMC_ASSETS_URL . 'css/swiper-bundle.min.css', null, self::VERSION, false );
		wp_register_style( 'deensimc-marquee-style', DEENSIMC_ASSETS_URL . 'css/marquee.css', null, self::VERSION, false );
		wp_register_style( 'deensimc-testimonial-style', DEENSIMC_ASSETS_URL . 'css/testimonial.css', null, self::VERSION, false );
		wp_register_style( 'deensimc-video-style', DEENSIMC_ASSETS_URL . 'css/video.css', null, self::VERSION, false );
		
		wp_enqueue_style( 'deensimc-swiper-style' );
		wp_enqueue_style( 'deensimc-accordion-style' );
		wp_enqueue_style( 'deensimc-swiper-bundle-min-style' );
		wp_enqueue_style( 'deensimc-marquee-style' );
		wp_enqueue_style( 'deensimc-testimonial-style' );
		wp_enqueue_style( 'deensimc-video-style' );

	}

	public function deensimc_frontend_scripts() {

		wp_register_script( 'deensimc-swiper-bundle', DEENSIMC_ASSETS_URL  . 'js/swiper-bundle.min.js' , [ 'jquery' ] , self::VERSION, false );
		wp_register_script( 'deensimc-main', DEENSIMC_ASSETS_URL  . 'js/main.js' , [ 'jquery' ] , self::VERSION, false );

		wp_enqueue_script( 'deensimc-swiper-bundle' );
		wp_enqueue_script( 'deensimc-main' );

	}

	public function deensimc_editor_styles() {

		wp_register_style( 'deensimc-editor-css', DEENSIMC_ASSETS_URL . 'css/editor.css', null, self::VERSION, false );
		wp_enqueue_style( 'deensimc-editor-css' );

	}

	
	function deensimc_register_widgets( $widgets_manager ) {

		require_once(  __DIR__ . '/widgets/traits/image-accordion/content.php' );
		require_once(  __DIR__ . '/widgets/traits/image-accordion/style.php' );

		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-advance.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-primary.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/style-box.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-parts/style-title-controls.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-parts/style-description-controls.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-parts/style-color-controls.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/content-parts/style-button-controls.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/style-contents.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/style-image.php' );
		require_once(  __DIR__ . '/widgets/traits/stacked-slider/style-dots.php' );

		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-url-fields.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-video-options.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-youtube-vimeo.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-hosted.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-image-overlay.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/content-additional-options.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/style-contents.php' );
		require_once(  __DIR__ . '/widgets/traits/video-marquee/style-play-icon.php' );

		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/content-repeater.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/content-additional-options.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/style-contents-box.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/style-contents.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/style-image.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/style-name-title.php' );
		require_once(  __DIR__ . '/widgets/traits/testimonial-marquee/style-review.php' );

		require_once(  __DIR__ . '/widgets/traits/image-marquee/content-image.php' );
		require_once(  __DIR__ . '/widgets/traits/image-marquee/content-additional-options.php' );
		require_once(  __DIR__ . '/widgets/traits/image-marquee/style-alignment-spacing.php' );
		require_once(  __DIR__ . '/widgets/traits/image-marquee/style-height-width.php' );
		require_once(  __DIR__ . '/widgets/traits/image-marquee/style-border-options.php' );

		require_once(  __DIR__ . '/widgets/traits/text-marquee/content-text-repeater.php' );
		require_once(  __DIR__ . '/widgets/traits/text-marquee/content-additional-options.php' );
		require_once(  __DIR__ . '/widgets/traits/text-marquee/style-text-contents.php' );

		require_once(  __DIR__ . '/widgets/class-deensimc-image-marquee.php' );
		require_once(  __DIR__ . '/widgets/class-deensimc-stacked-slider.php' );
		require_once(  __DIR__ . '/widgets/class-deensimc-image-accordion.php' );
		require_once(  __DIR__ . '/widgets/class-deensimc-text-marquee.php' );
		require_once(  __DIR__ . '/widgets/class-deensimc-testimonial-marquee.php' );
		require_once(  __DIR__ . '/widgets/class-deensimc-video-marquee.php' );
		
		$widgets_manager->register( new \Deensimc_Image_Marquee() );
		$widgets_manager->register( new \Deensimc_Stacked_Slider() );
		$widgets_manager->register( new \Deensimc_Image_Accordion() );
		$widgets_manager->register( new \Deensimc_Text_Marquee() );
		$widgets_manager->register( new \Deensimc_Testimonial_Marquee() );
		$widgets_manager->register( new \Deensimc_Video_Marquee() );

	}

	function deensimc_add_categories( $elements_manager ) {

		$elements_manager->add_category(
			'deensimc_smooth_marquee',
			[
				'title' => esc_html__( 'Marquee Addons', 'marquee-addons-for-elementor' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}

}
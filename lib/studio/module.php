<?php

namespace Marquee_Addons\Library;

use \Marquee_Addons_Library;

/**
 * Marquee Addons Cloud Library.
 */
class Module
{
	public function __construct()
	{
		add_action( 'elementor/editor/footer', [ $this, 'elementor_views' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elementor_scripts' ] );
		add_action( 'elementor/preview/enqueue_scripts', [ $this, 'elementor_styles' ]) ;
		add_action( 'wp_ajax_ma-el-studio-template', [ $this, 'get_template' ] );
	}


	function get_templetes_json_data( $file_name ) {
		
		$response = wp_remote_get( plugin_dir_url( __FILE__ ) . $file_name );

		if ( is_wp_error( $response ) ) {
			return; 
		}

		$body = wp_remote_retrieve_body( $response );

		$data = json_decode( $body, associative: true );

		return $data;
	}

	public function elementor_scripts()
	{
		wp_enqueue_script(
			'marquee-addons-el-studio-js',
			Marquee_Addons_Library::instance()->path_url . 'lib/studio/js/elementor.js',
			['jquery', 'wp-util', 'masonry', 'imagesloaded'],
			Marquee_Addons_Library::VERSION,
			false
		);

		$data = $this->get_templetes_json_data( 'data.json' );

		$library_icon = DEENSIMC_ASSETS_URL . 'images/library-icon.png';

		wp_localize_script( 'marquee-addons-el-studio-js', 'marqueeStudioData', [
			'elTemplates' => $data,
			'libraryIcon' => $library_icon,
		] );

		$this->elementor_styles();
	}

	public function elementor_styles() 
	{
		wp_enqueue_style( 
		'marquee-addons-el-studio-style', 
		Marquee_Addons_Library::instance()->path_url . 'lib/studio/css/elementor.css', 
		[], 
		Marquee_Addons_Library::VERSION 
		);
	}

	/**
	 * Add the modal view templates.
	 */
	public function elementor_views()
	{
		$views = [
			'header',
			'blocks',
			'pages',
			'items',
			'header-preview',
			'preview'
		];

		foreach ( $views as $view ) {
			include_once Marquee_Addons_Library::instance()->path . 'lib/studio/views/el-' . $view . '.php';
		}
	}

	/**
	 * AJAX request to get a block/template.
	 */
	public function get_template()
	{
		if ( !current_user_can( 'edit_posts' ) || !isset( $_GET['id'] ) ) {
			return wp_send_json_error();
		}
		
		$data = $this->get_templetes_json_data( 'templates.json' );

		if ( !isset( $data[$_GET['id']] ) ) {
			return wp_send_json_error( 'Block not found' );
		}

		// Process content.
		$content = $data[sanitize_text_field( wp_unslash( $_GET['id'] ) )];
		$content = $this->elementor_replace_ids( $content );

		wp_send_json_success( [
			'content' => $content
		] );
	}

	/**
	 * Required to have unique ids for multi-imports.
	 */
	public function elementor_replace_ids( $content )
	{
		return \ELementor\Plugin::$instance->db->iterate_data( $content, function( $element ) {
			$element['id'] = dechex( wp_rand() );
			return $element;
		} );
	}
}
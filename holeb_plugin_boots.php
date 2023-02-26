<?php
namespace HOLEBreadcrumB;

use HOLEBreadcrumB\PageSettings\Page_Settings;
define( "HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "HOLEB_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );

class ClassHOLEBreadcrumBBoots {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function holeb_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'holeb_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function holeb_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'holeb_the_breadcrumb_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}
		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/hole-breadcrumb-widget.php' );
	}

	public function holeb_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		// From PowerPack
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\HOLEBreadcrumBWidget() );
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/holeb-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function holeb_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'bwdthebest_general_category',
			[
				'title' => esc_html__( 'BWD General Group', 'hole-breadcrumb' ),
				'icon' => 'eicon-person',
			]
		);
	}

	public function holeb_all_assets_for_the_public(){
		$all_css_js_file = array(
			// 'holeb-breadcrumb-style-from-elements-kit' => array('holeb_path_define'=>HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/style.css'),
			'holeb-breadcrumb-style-from-elements-222' => array('holeb_path_define'=>HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/pp_css/1rtlstyle.css'),
			'holeb-breadcrumb-style-from-elements-111' => array('holeb_path_define'=>HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/pp_css/1style.css'),
			'holeb-breadcrumb-style-from-elements-aa' => array('holeb_path_define'=>HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/pp_css/aa.css'),
			'holeb-breadcrumb-style-from-elements-ee' => array('holeb_path_define'=>HOLEB_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/pp_css/ee.css'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['holeb_path_define'], null, '1.0', 'all');
		}
	}

	public function holeb_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
			'holeb_breadcrumb_admin_icon_css' => array('holeb_path_admin_define'=>HOLEB_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
		);

		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['holeb_path_admin_define'], null, '1.0', 'all');
		}
	}

	public function __construct() {
		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'holeb_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'holeb_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'holeb_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'holeb_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'holeb_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
ClassHOLEBreadcrumBBoots::instance();
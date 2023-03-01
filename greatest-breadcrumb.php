<?php
/**
 * Plugin Name: Greatest Breadcrumb
 * Description: Greatest Breadcrumb plugin with 23+ types of  Breadcrumb Effects for Elementor.
 * Plugin URI:  https://bwdplugins.com/plugins/greatest-breadcrumb
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: greatest-breadcrumb
 * Elementor tested up to: 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/requires-check.php';

final class Final_HOLEB_Breadcrumb{ 

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'holeb_init', array( $this, 'holeb_loaded_textdomain' ) );

		// holeb_init Plugin
		add_action( 'plugins_loaded', array( $this, 'holeb_init' ) );
	}


	public function holeb_loaded_textdomain() {
		load_plugin_textdomain( 'greatest-breadcrumb' );
	}

	public function holeb_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			// elementor activation check
			add_action( 'admin_notices','holeb_breadcrumb_register_required_plugins');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'holeb_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'holeb_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'holeb_plugin_boots.php' );
	}

	public function holeb_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'greatest-breadcrumb' ),
			'<strong>' . esc_html__( 'Greatest Breadcrumb', 'greatest-breadcrumb' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'greatest-breadcrumb' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'greatest-breadcrumb') . '</p></div>', $message );
	}

	public function holeb_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'greatest-breadcrumb' ),
			'<strong>' . esc_html__( 'Greatest Breadcrumb', 'greatest-breadcrumb' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'greatest-breadcrumb' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'greatest-breadcrumb') . '</p></div>', $message );
	}
}

// Instantiate greatest-breadcrumb.
new Final_HOLEB_Breadcrumb();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
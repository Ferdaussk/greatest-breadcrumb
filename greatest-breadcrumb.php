<?php
/**
 * Plugin Name: Greatest Breadcrumb
 * Description: Greatest Breadcrumb plugin with 9+ types of  Breadcrumb Effects for Elementor.
 * Plugin URI:  https://bestwpdeveloper.com/breadcrumb
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: greatest-breadcrumb
 *Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.7.3
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/requires-check.php';

final class Final_GRSTBCMB_Breadcrumb{ 

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'grstbcmb_init', array( $this, 'grstbcmb_loaded_textdomain' ) );

		// grstbcmb_init Plugin
		add_action( 'plugins_loaded', array( $this, 'grstbcmb_init' ) );
	}


	public function grstbcmb_loaded_textdomain() {
		load_plugin_textdomain( 'greatest-breadcrumb' );
	}

	public function grstbcmb_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			// elementor activation check
			add_action( 'admin_notices','grstbcmb_breadcrumb_register_required_plugins');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'grstbcmb_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'grstbcmb_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'grstbcmb_plugin_boots.php' );
	}

	public function grstbcmb_admin_notice_minimum_elementor_version() {
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

	public function grstbcmb_admin_notice_minimum_php_version() {
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
new Final_GRSTBCMB_Breadcrumb();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
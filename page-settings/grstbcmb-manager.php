<?php
namespace HOLEBreadcrumB\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'grstbcmb_breadcrumb_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'grstbcmb_breadcrumb_register_document_controls' ] );
	}

	public function grstbcmb_breadcrumb_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Greatest Breadcrumb', 'greatest-breadcrumb' ) );
	}

	public function grstbcmb_breadcrumb_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'grstbcmb_breadcrumb_new_section',
			[
				'label' => esc_html__( 'Settings', 'greatest-breadcrumb' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'grstbcmb_breadcrumb_text',
			[
				'label' => esc_html__( 'Title', 'greatest-breadcrumb' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'greatest-breadcrumb' ),
			]
		);

		$document->end_controls_section();
	}
}

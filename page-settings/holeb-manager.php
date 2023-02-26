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
		add_action( 'elementor/init', [ $this, 'holeb_breadcrumb_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'holeb_breadcrumb_register_document_controls' ] );
	}

	public function holeb_breadcrumb_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Hole Breadcrumb', 'hole-breadcrumb' ) );
	}

	public function holeb_breadcrumb_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'holeb_breadcrumb_new_section',
			[
				'label' => esc_html__( 'Settings', 'hole-breadcrumb' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'holeb_breadcrumb_text',
			[
				'label' => esc_html__( 'Title', 'hole-breadcrumb' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'hole-breadcrumb' ),
			]
		);

		$document->end_controls_section();
	}
}

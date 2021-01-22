<?php
/**
 * Extend hotspots widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Hotspots extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * The plugin to which the widget belongs
	 *
	 * @return string
	 */
	public function get_plugin() {
		return 'jet-tricks';
	}

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-hotspots';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_hotspots';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'hotspot_text',
				'label' => esc_html__( 'Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'hotspot_description',
				'label' => esc_html__( 'Description', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'hotspot_url',
				'label'    => esc_html__( 'Link', 'jet-elements-dynamic-data' ),
				'property' => 'url',
			),
			array(
				'name'  => 'vertical_position',
				'label' => esc_html__( 'Vertical Position(%)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'horizontal_position',
				'label' => esc_html__( 'Horizontal Position(%)', 'jet-elements-dynamic-data' ),
			),
		);
	}
}

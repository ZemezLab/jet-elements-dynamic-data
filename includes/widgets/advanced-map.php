<?php
/**
 * Extend Advanced Map widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Advanced_Map extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-map';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_map_pins';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'pin_address_type',
				'label' => __( 'Pin Address Type', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'pin_address_lat_lng',
				'label' => __( 'Pin Address Coordinates', 'jet-elements' ),
			),
			array(
				'name'  => 'dms_pin_address_lat_lng',
				'label' => __( 'Pin Address Coordinates', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_address',
				'label' => __( 'Pin Address', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_desc',
				'label' => __( 'Pin Description', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_link_title',
				'label' => __( 'Link Text', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_link',
				'label' => __( 'Link', 'jet-elements' ),
			),
			array(
				'name'     => 'pin_image',
				'label'    => __( 'Pin Icon', 'jet-elements' ),
				'is_image' => true,
			),
			array(
				'name'  => 'pin_custom_size',
				'label' => __( 'Pin Icon Custom Size', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_icon_width',
				'label' => __( 'Width', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_icon_height',
				'label' => __( 'Height', 'jet-elements' ),
			),
			array(
				'name'  => 'pin_state',
				'label' => __( 'Initial State', 'jet-elements' ),
			),
		);
	}

}

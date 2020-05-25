<?php
/**
 * Extend tabs widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Image_Accordion extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * The plugin to which the widget belongs
	 *
	 * @return string
	 */
	public function get_plugin() {
		return 'jet-tabs';
	}

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-image-accordion';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_items_data';
	}

	/**
	 * Fields map
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'item_active',
				'label' => __( 'Active (yes or empty string)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'item_image',
				'label'    => __( 'Image', 'jet-elements-dynamic-data' ),
				'is_image' => true,
			),
			array(
				'name'  => 'item_title',
				'label' => __( 'Title', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_desc',
				'label' => __( 'Description', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_link_text',
				'label' => __( 'Button text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'item_link',
				'label'    => __( 'Link', 'jet-elements-dynamic-data' ),
				'property' => 'url',
			),
		);
	}

}

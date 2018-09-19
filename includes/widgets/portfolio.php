<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Portfolio extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-portfolio';
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
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'item_category',
				'label' => __( 'Category', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_image',
				'label' => __( 'Image', 'jet-elements-dynamic-data' ),
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
				'name'  => 'item_button_text',
				'label' => __( 'Link Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_url',
				'label' => __( 'Link Url', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

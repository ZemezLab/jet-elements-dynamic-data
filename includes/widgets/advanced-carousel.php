<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Advanced_Carousel extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-carousel';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_slides';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'     => 'item_image',
				'label'    => __( 'Image', 'jet-elements-dynamic-data' ),
				'is_image' => true,
			),
			array(
				'name'  => 'item_title',
				'label' => __( 'Item Title', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_text',
				'label' => __( 'Item Description', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_link',
				'label' => __( 'Item Link', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_link_target',
				'label' => __( 'Open link in new window', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_text',
				'label' => __( 'Item Button Text', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

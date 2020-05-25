<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Images_Layout extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-images-layout';
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
				'name'  => 'item_icon',
				'label' => __( 'Icon', 'jet-elements-dynamic-data' ),
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
				'name'  => 'item_link_type',
				'label' => __( 'Link type', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_url',
				'label' => __( 'External Link', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_target',
				'label' => __( 'Open external link in new window', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

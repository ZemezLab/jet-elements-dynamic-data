<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Slider extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-slider';
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
				'name'  => 'item_subtitle',
				'label' => __( 'Subtitle', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_desc',
				'label' => __( 'Description', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_primary_url',
				'label' => __( 'Primary Button URL', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_primary_text',
				'label' => __( 'Primary Button Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_secondary_url',
				'label' => __( 'Secondary Button URL', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_button_secondary_text',
				'label' => __( 'Secondary Button Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_link_url',
				'label' => __( 'Link on whole slide', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

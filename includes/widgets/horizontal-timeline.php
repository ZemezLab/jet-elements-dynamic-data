<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Horizontal_Timeline extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-horizontal-timeline';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_items';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'is_item_active',
				'label' => __( 'Is Item Active (yes or empty string)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'show_item_image',
				'label' => __( 'Show Image (yes or empty string)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'item_image',
				'label'    => __( 'Image', 'jet-elements-dynamic-data' ),
				'is_image' => true,
			),
			array(
				'name'  => 'item_image_size',
				'label' => __( 'Image Size', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_title',
				'label' => __( 'Title', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_meta',
				'label' => __( 'Meta', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_desc',
				'label' => __( 'Description', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_point_type',
				'label' => __( 'Point Content Type (icon or text)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_point_icon',
				'label' => __( 'Point Icon', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_point_text',
				'label' => __( 'Point Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_btn_text',
				'label' => __( 'Button Text', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'item_btn_url',
				'label'    => __( 'Button URL', 'jet-elements-dynamic-data' ),
				'property' => 'url',
			),
		);
	}

}

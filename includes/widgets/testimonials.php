<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Testimonials extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-testimonials';
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
				'name'  => 'item_image',
				'label' => __( 'Image', 'jet-elements-dynamic-data' ),
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
				'name'  => 'item_comment',
				'label' => __( 'Comment', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_name',
				'label' => __( 'Name', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_position',
				'label' => __( 'Position', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_date',
				'label' => __( 'Date', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

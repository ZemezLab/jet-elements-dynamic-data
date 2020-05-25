<?php
/**
 * Extend tabs widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Tabs extends Jet_Elements_Dynamic_Data_Base {

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
		return 'jet-tabs';
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
				'name'  => 'item_use_image',
				'label' => __( 'Use Image? (yes or empty string)', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_icon',
				'label' => __( 'Icon', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'     => 'item_image',
				'label'    => __( 'Image', 'jet-elements-dynamic-data' ),
				'is_image' => true,
			),
			array(
				'name'  => 'item_label',
				'label' => __( 'Label', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'        => 'content_type',
				'label'       => __( 'Content Type (template or editor)', 'jet-elements-dynamic-data' ),
				'label_block' => true,
			),
			array(
				'name'  => 'item_template_id',
				'label' => __( 'Template ID', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'item_editor_content',
				'label' => __( 'Editor Content', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'control_id',
				'label' => __( 'Control CSS ID', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

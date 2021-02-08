<?php
/**
 * Extend testimonial widget
 */

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Elements_Dynamic_Data_Bar_Chart extends Jet_Elements_Dynamic_Data_Base {

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	public function widget_id() {
		return 'jet-bar-chart';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	public function insert_after() {
		return 'section_chart_data';
	}

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return array
	 */
	public function fields_map() {
		return array(
			array(
				'name'  => 'label',
				'label' => __( 'Label', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'data',
				'label' => __( 'Data', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'bg_color',
				'label' => __( 'Background Color', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'bg_hover_color',
				'label' => __( 'Background Hover Color', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'border_color',
				'label' => __( 'Border Color', 'jet-elements-dynamic-data' ),
			),
			array(
				'name'  => 'border_hover_color',
				'label' => __( 'Border Hover Color', 'jet-elements-dynamic-data' ),
			),
		);
	}

}

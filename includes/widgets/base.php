<?php
/**
 * Base class to extend widgets
 */
abstract class Jet_Elements_Dynamic_Data_Base {

	public function __construct() {

		$widget_id  = $this->widget_id();
		$section_id = $this->insert_after();

		add_action(
			"elementor/element/{$widget_id}/{$section_id}/after_section_end",
			array( $this, 'register_controls' )
		);

		add_action( 'jet-elements/widget/loop-items', array( $this, 'get_meta_loop' ), 10, 3 );

	}

	/**
	 * Processed widget ID
	 *
	 * @return string
	 */
	abstract public function widget_id();

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	abstract public function insert_after();

	/**
	 * Section ID to insert dynamic section after
	 *
	 * @return string
	 */
	abstract public function fields_map();

	/**
	 * Try to get new loop from meta data
	 *
	 * @param  array  $loop     [description]
	 * @param  array  $loop_setting [description]
	 * @param  object $widget   [description]
	 * @return array
	 */
	public function get_meta_loop( $loop, $loop_setting, $widget ) {

		$settings = $widget->get_settings();
		$enabled  = isset( $settings[ $this->enabled_key() ] ) ? $settings[ $this->enabled_key() ] : false;
		$meta_key = isset( $settings['repeater_meta_key'] ) ? $settings['repeater_meta_key'] : false;

		if ( ! $enabled || ! $meta_key ) {
			return $loop;
		}

		$new_loop = get_post_meta( get_the_ID(), $meta_key, true );
		$loop     = array();
		$map      = array();

		foreach ( $this->fields_map() as $field ) {

			$key_option      = 'map_' . $field['name'];
			$is_image_option = 'map_' . $field['name'] . '_is_image';

			$map[ $field['name'] ] = array(
				'key'      => isset( $settings[ $key_option ] ) ? $settings[ $key_option ] : '',
				'is_image' => isset( $settings[ $is_image_option ] ) ? $settings[ $is_image_option ] : '',
			);
		}

		foreach ( $new_loop as $loop_item ) {

			$new_item = array(
				'_id' => $widget->get_id(),
			);

			foreach ( $map as $result_key => $data ) {

				if ( ! $data['key'] || ! isset( $loop_item[ $data['key'] ] ) ) {
					if ( $data['key'] ) {
						$new_item[ $result_key ] = $data['key'];
					} else {
						$new_item[ $result_key ] = false;
					}
				} else {
					if ( ! $data['is_image'] ) {
						$new_item[ $result_key ] = $loop_item[ $data['key'] ];
					} else {
						$new_item[ $result_key ] = array(
							'id'  => $loop_item[ $data['key'] ],
							'url' => wp_get_attachment_url( $loop_item[ $data['key'] ] ),
						);
					}
				}

			}

			$loop[] = $new_item;

		}

		return $loop;

	}

	/**
	 * Return enabled key name
	 *
	 * @return [type] [description]
	 */
	public function enabled_key() {
		$widget_id = str_replace( '-', '_', $this->widget_id() );
		return $widget_id . '_enable_dynamic';
	}

	/**
	 * Register widget controls
	 *
	 * @param  [type] $widget [description]
	 * @return [type]         [description]
	 */
	public function register_controls( $widget ) {

		$widget->start_controls_section(
			'jet_dynamic_settings',
			array(
				'label' => esc_html__( 'Dynamic Settings', 'jet-elements-dynamic-data' ),
			)
		);

		$enabled_key = $this->enabled_key();

		$widget->add_control(
			$enabled_key,
			array(
				'label'        => __( 'Enable dynamic data', 'jet-elements-dynamic-data' ),
				'type'         => Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'jet-elements-dynamic-data' ),
				'label_off'    => __( 'No', 'jet-elements-dynamic-data' ),
				'return_value' => 'true',
				'default'      => '',
			)
		);

		$widget->add_control(
			'repeater_meta_key',
			array(
				'label'     => __( 'Repeater field name', 'jet-elements-dynamic-data' ),
				'type'      => Elementor\Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array(
						$enabled_key => 'true',
					),
			)
		);

		$widget->add_control(
			'set_dynamic_map',
			array(
				'type' => Elementor\Controls_Manager::RAW_HTML,
				'raw' => __( 'Set apropriate repeater field names for widget fields', 'jet-elements-dynamic-data' ),
				'condition' => array(
					$enabled_key => 'true',
				),
			)
		);

		foreach ( $this->fields_map() as $field ) {

			$widget->add_control(
				'map_' . $field['name'],
				array(
					'label'     => $field['label'],
					'type'      => Elementor\Controls_Manager::TEXT,
					'default'   => '',
					'separator' => 'before',
					'condition'    => array(
						$enabled_key => 'true',
					),
				)
			);

			$widget->add_control(
				'map_' . $field['name'] . '_is_image',
				array(
					'label'        => __( 'Is image control', 'jet-elements-dynamic-data' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'jet-elements-dynamic-data' ),
					'label_off'    => __( 'No', 'jet-elements-dynamic-data' ),
					'return_value' => 'true',
					'default'      => '',
					'condition'    => array(
						$enabled_key => 'true',
					),
				)
			);

		}

		$widget->end_controls_section();

	}

}

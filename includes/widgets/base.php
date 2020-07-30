<?php
/**
 * Base class to extend widgets
 */
abstract class Jet_Elements_Dynamic_Data_Base {

	public function __construct() {

		$widget_id  = $this->widget_id();
		$section_id = $this->insert_after();
		$plugin     = method_exists( $this, 'get_plugin' ) ? $this->get_plugin() : 'jet-elements';

		add_action(
			"elementor/element/{$widget_id}/{$section_id}/after_section_end",
			array( $this, 'register_controls' )
		);

		add_filter( "{$plugin}/widget/loop-items", array( $this, 'get_meta_loop' ), 10, 3 );

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
	 * @return array
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
		$source   = isset( $settings['repeater_source'] ) ? $settings['repeater_source'] : 'post_meta';
		$meta_key = isset( $settings['repeater_meta_key'] ) ? $settings['repeater_meta_key'] : false;

		if ( ! $enabled || ! $meta_key ) {
			return $loop;
		}

		switch ( $source ) {
			case 'post_meta':
				$new_loop = $this->get_meta_value( $meta_key );
				break;

			case 'option':
				$option_name = isset( $settings['repeater_option_name'] ) ? $settings['repeater_option_name'] : false;
				$new_loop    = $this->get_option_value( $option_name, $meta_key );
				break;

			default:
				$new_loop = array();
		}

		if ( empty( $new_loop ) ) {
			return $loop;
		}

		$loop     = array();
		$map      = array();

		foreach ( $this->fields_map() as $field ) {

			$key_option      = 'map_' . $field['name'];
			$is_image_option = 'map_' . $field['name'] . '_is_image';

			$key    = '';
			$filter = false;

			if ( ! empty( $settings[ $key_option ] ) ) {
				preg_match( '/([a-zA-Z0-9\s_-]+)(\|([a-zA-Z0-9\(\)\,\:\/\s_-]+))*/', $settings[ $key_option ], $key_data );

				$key    = ! empty( $key_data[1] ) ? $key_data[1] : '';
				$filter = ! empty( $key_data[3] ) ? $key_data[3] : false;
			}

			$map[ $field['name'] ] = array(
				'key'      => $key,
				'is_image' => ! empty( $settings[ $is_image_option ] ) ? $settings[ $is_image_option ] : '',
				'property' => ! empty( $field['property'] ) ? $field['property'] : null,
				'filter'   => $filter,
			);
		}

		foreach ( $new_loop as $inx => $loop_item ) {

			$new_item = array(
				'_id' => $widget->get_id() . '_' . $inx,
			);

			foreach ( $map as $result_key => $data ) {

				$return_property = $data['property'];
				$filter          = $data['filter'];

				if ( ! $data['key'] ) {
					$new_item[ $result_key ] = false;
				} elseif ( ! isset( $loop_item[ $data['key'] ] ) ) {
					$new_item[ $result_key ] = $return_property ? array( $return_property => $data['key'] ) : $data['key'];
				} else {
					if ( ! $data['is_image'] ) {

						$value = $loop_item[ $data['key'] ];

						if ( $filter ) {
							$value = jet_elements_dynamic_data()->filters->apply_filters( $value, $filter );
						}

						$new_item[ $result_key ] = $return_property ? array( $return_property => $value ) : $value;

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
	 * Get JetEngine or ACF meta value
	 *
	 * @param  string $meta_key
	 * @return array
	 */
	public function get_meta_value( $meta_key = null ) {

		$value = get_post_meta( get_the_ID(), $meta_key, true );

		if ( ! $value ) {
			return array();
		}

		if ( is_array( $value ) ) {
			return $value;
		}

		if ( 0 >= absint( $value ) || ! function_exists( 'acf_get_field' ) ) {
			return array();
		}

		$field      = acf_get_field( $meta_key );
		$sub_fields = isset( $field['sub_fields'] ) ? $field['sub_fields'] : false;
		$result     = array();

		for ( $i = 0; $i < absint( $value ); $i++ ) {

			$item = array();

			foreach ( $sub_fields as $sub_field ) {
				$sub_key                    = $meta_key . '_' . $i . '_' . $sub_field['name'];
				$item[ $sub_field['name'] ] = get_post_meta( get_the_ID(), $sub_key, true );
			}

			$result[] = $item;

		}

		return $result;

	}

	/**
	 * Get JetEngine or ACF option value
	 *
	 * @param  string $option_name
	 * @param  string $repeater_key
	 * @return array
	 */
	public function get_option_value( $option_name = null, $repeater_key = null ) {

		if ( empty( $option_name ) ) {

			if ( ! function_exists( 'acf' ) ) {
				return array();
			}

			$repeater_values = get_field( $repeater_key, 'options' );

			if ( ! empty( $repeater_values ) && is_array( $repeater_values ) ) {
				return $repeater_values;
			}

			return array();
		}

		$option_value = get_option( $option_name );

		if ( ! $option_value ) {
			return array();
		}

		if ( ! isset( $option_value[ $repeater_key ] ) ) {
			return array();
		}

		if ( is_array( $option_value[ $repeater_key ] ) ) {
			return $option_value[ $repeater_key ];
		}

		return array();
	}

	/**
	 * Return enabled key name
	 *
	 * @return string
	 */
	public function enabled_key() {
		$widget_id = str_replace( '-', '_', $this->widget_id() );
		return $widget_id . '_enable_dynamic';
	}

	/**
	 * Register widget controls
	 *
	 * @param  object $widget
	 * @return void
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
			'repeater_source',
			array(
				'label'     => __( 'Source', 'jet-elements-dynamic-data' ),
				'type'      => Elementor\Controls_Manager::SELECT,
				'default'   => 'post_meta',
				'options'   => array(
					'post_meta' => __( 'Post Meta', 'jet-elements-dynamic-data' ),
					'option'    => __( 'Option', 'jet-elements-dynamic-data' ),
				),
				'condition' => array(
					$enabled_key => 'true',
				),
			)
		);

		$widget->add_control(
			'repeater_option_name',
			array(
				'label'       => __( 'Option name', 'jet-elements-dynamic-data' ),
				'type'        => Elementor\Controls_Manager::TEXT,
				'description' => __( 'Leave empty for retrieve repeater values from the ACF options page.', 'jet-elements-dynamic-data' ),
				'default'     => '',
				'condition'   => array(
					$enabled_key      => 'true',
					'repeater_source' => 'option',
				),
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
				'raw' => '<i>' . __( 'Set appropriate repeater field names for widget fields', 'jet-elements-dynamic-data' ) . '</i>',
				'condition' => array(
					$enabled_key => 'true',
				),
			)
		);

		foreach ( $this->fields_map() as $field ) {

			$widget->add_control(
				'map_' . $field['name'],
				array(
					'label'       => $field['label'],
					'label_block' => isset( $field['label_block'] ) ? $field['label_block'] : false,
					'description' => isset( $field['description'] ) ? $field['description'] : false,
					'type'        => Elementor\Controls_Manager::TEXT,
					'default'     => '',
					'separator'   => 'before',
					'condition'   => array(
						$enabled_key => 'true',
					),
				)
			);

			if ( isset( $field['is_image'] ) && $field['is_image'] ) {
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

		}

		$widget->end_controls_section();

	}

}

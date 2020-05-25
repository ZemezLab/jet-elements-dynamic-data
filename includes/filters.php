<?php
/**
 * Filters class
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Elements_Dynamic_Data_Filters' ) ) {

	/**
	 * Define Jet_Elements_Dynamic_Data_Filters class
	 */
	class Jet_Elements_Dynamic_Data_Filters {

		/**
		 * Return available macros list
		 *
		 * @return array
		 */
		public function get_all() {
			return apply_filters( 'jet-elements-dynamic-data/filters-list', array(
				'img_url_by_id'  => array(
					'cb'   => array( $this, 'get_img_url' ),
					'args' => 'full',
				),
				'file_url_by_id'  => array(
					'cb'   => array( $this, 'get_file_url' ),
					'args' => false,
				),
				'post_url_by_id' => array(
					'cb'   => array( $this, 'get_post_url' ),
					'args' => false,
				),
				'post_title_by_id' => array(
					'cb'   => array( $this, 'get_post_title' ),
					'args' => false,
				),
				'post_link_by_id' => array(
					'cb'   => array( $this, 'get_post_link' ),
					'args' => false,
				),
				'render_fa_icon' => array(
					'cb'   => array( $this, 'get_fa_icon_html' ),
					'args' => false,
				),
			) );
		}

		/**
		 * Find filters in string and run appropriate function
		 *
		 * @param  [type] $value
		 * @param  [type] $filter
		 * @return string
		 */
		public function apply_filters( $value = null, $filter = null ) {

			if ( ! $value ) {
				return null;
			}

			$filters = $this->get_all();

			if ( ! $filter ) {
				return $value;
			}

			preg_match( '/([a-zA-Z0-9_-]+)(\([a-zA-Z0-9\,\:\/\s_-]+\))?/', $filter, $filter_data );

			if ( empty( $filter_data ) ) {
				return $value;
			}

			$filter_name = isset( $filter_data[1] ) ? $filter_data[1] : false;
			$filter_arg  = isset( $filter_data[2] ) ? trim( $filter_data[2], '()' ) : false;

			if ( ! isset( $filters[ $filter_name ] ) ) {
				return $value;
			}

			$_filter = $filters[ $filter_name ];

			if ( ! $filter_arg ) {
				$filter_arg = $_filter['args'];
			}

			return call_user_func_array( $_filter['cb'], array_filter( array( $value, $filter_arg ) ) );

		}

		/**
		 * Returns image url by ID
		 *
		 * @param  int    $img_id
		 * @param  string $size
		 * @return string
		 */
		public function get_img_url( $img_id, $size ) {
			return wp_get_attachment_image_url( $img_id, $size );
		}

		/**
		 * Returns attachment file URL by attachment ID
		 * @param  int $attachment_id
		 * @return string
		 */
		public function get_file_url( $attachment_id ) {
			return wp_get_attachment_url( $attachment_id );
		}

		/**
		 * Returns Post URL by ID
		 *
		 * @param  int $post_id
		 * @return string
		 */
		public function get_post_url( $post_id ) {
			return get_permalink( $post_id );
		}

		/**
		 * Returns Post URL by ID
		 *
		 * @param  int $post_id
		 * @return string
		 */
		public function get_post_title( $post_id ) {
			return get_the_title( $post_id );
		}

		/**
		 * Returns Post URL by ID
		 *
		 * @param  int $post_id
		 * @return string
		 */
		public function get_post_link( $post_id ) {
			return sprintf(
				'<a href="%1$s">%2$s</a>',
				$this->get_post_url( $post_id ),
				$this->get_post_title( $post_id )
			);
		}

		/**
		 * Returns FA Icon html
		 *
		 * @param  string $icon
		 * @return string
		 */
		public function get_fa_icon_html( $icon ) {

			$icon = 'fa ' . $icon;

			if ( class_exists( 'Elementor\Icons_Manager' ) ) {
				$icon = Elementor\Icons_Manager::fa4_to_fa5_value_migration( $icon )['value'];
			}

			return $icon;
		}

	}

}

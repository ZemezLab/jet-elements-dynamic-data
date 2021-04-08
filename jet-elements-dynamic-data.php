<?php
/**
 * Plugin Name: JetPlugins Dynamic Data Addon
 * Plugin URI:  https://crocoblock.com/
 * Description: Allows to use dynamic data in JetPlugins widgets.
 * Version:     1.3.3
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-elements-dynamic-data
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

// If class `Jet_Elements_Dynamic_Data` doesn't exists yet.
if ( ! class_exists( 'Jet_Elements_Dynamic_Data' ) ) {

	/**
	 * Sets up and initializes the plugin.
	 */
	class Jet_Elements_Dynamic_Data {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Jet_Elements_Dynamic_Data
		 */
		private static $instance = null;

		/**
		 * Plugin version
		 *
		 * @var string
		 */
		private $version = '1.3.3';

		/**
		 * Holder for base plugin URL
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_url = null;

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Filters manager instance
		 *
		 * @var Jet_Elements_Dynamic_Data_Filters
		 */
		public $filters = null;

		/**
		 * Sets up needed actions/filters for the plugin to initialize.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'init' ) );
		}

		/**
		 * Initialize widgets
		 *
		 * @return void
		 */
		public function init() {

			require $this->plugin_path( 'includes/filters.php' );
			$this->filters   = new Jet_Elements_Dynamic_Data_Filters();

			$path = $this->plugin_path( 'includes/widgets/' );

			$widgets = array(
				'Jet_Elements_Dynamic_Data_Testimonials'        => $path . 'testimonials.php',
				'Jet_Elements_Dynamic_Data_Advanced_Carousel'   => $path . 'advanced-carousel.php',
				'Jet_Elements_Dynamic_Data_Images_Layout'       => $path . 'images-layout.php',
				'Jet_Elements_Dynamic_Data_Portfolio'           => $path . 'portfolio.php',
				'Jet_Elements_Dynamic_Data_Slider'              => $path . 'slider.php',
				'Jet_Elements_Dynamic_Data_Timeline'            => $path . 'timeline.php',
				'Jet_Elements_Dynamic_Data_Price_List'          => $path . 'price-list.php',
				'Jet_Elements_Dynamic_Data_Horizontal_Timeline' => $path . 'horizontal-timeline.php',
				'Jet_Elements_Dynamic_Data_Tabs'                => $path . 'tabs.php',
				'Jet_Elements_Dynamic_Data_Accordion'           => $path . 'accordion.php',
				'Jet_Elements_Dynamic_Data_Image_Accordion'     => $path . 'image-accordion.php',
				'Jet_Elements_Dynamic_Data_Hotspots'            => $path . 'hotspots.php',
				'Jet_Elements_Dynamic_Data_Line_Chart'            => $path . 'line-chart.php',
				'Jet_Elements_Dynamic_Data_Bar_Chart'            => $path . 'bar-chart.php',
			);

			require_once $path . 'base.php';

			foreach ( $widgets as $class => $file ) {
				require_once $file;
				new $class();
			}

		}

		/**
		 * Returns plugin version
		 *
		 * @return string
		 */
		public function get_version() {
			return $this->version;
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}
		/**
		 * Returns url to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Loads the translation files.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function lang() {
			load_plugin_textdomain(
				'jet-elements-dynamic-data',
				false,
				dirname( plugin_basename( __FILE__ ) ) . '/languages'
			);
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Jet_Elements_Dynamic_Data
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'jet_elements_dynamic_data' ) ) {

	/**
	 * Returns instance of the plugin class.
	 *
	 * @since  1.0.0
	 * @return Jet_Elements_Dynamic_Data
	 */
	function jet_elements_dynamic_data() {
		return Jet_Elements_Dynamic_Data::get_instance();
	}
}

jet_elements_dynamic_data();

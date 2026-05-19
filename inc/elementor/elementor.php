<?php

namespace Egns_Core;

/**
 * All Elementor widget init
 * 
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit();  // exit if access directly
}

if (!class_exists('Egns_Elementor')) {

	class Egns_Elementor
	{
		/*
		* $instance
		* @since 1.0.0
		* */
		private static ?self $instance = null;


		/*
		* construct()
		* @since 1.0.0
		* */
		public function __construct()
		{
			//elementor widget category registered
			add_action('elementor/elements/categories_registered', array($this, '_widget_categories'));

			//elementor widget registered
			add_action('elementor/widgets/register', array($this, '_widget_registered'));

			// Enqueue stylesheets in editor page and frontend
			add_action('elementor/editor/before_enqueue_styles', array($this, 'adking_enqueue_style'));
			add_action('elementor/frontend/before_enqueue_styles', array($this, 'adking_enqueue_style'));

			//add custom icons to elementor new controls
			add_filter('elementor/icons_manager/additional_tabs', array($this, 'add_custom_icon_to_elementor_icons'));
		}

		/*
	   * getInstance()
	   * @since 1.0.0
	   * */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		// Custom widgets css 
		public function adking_enqueue_style()
		{
			wp_enqueue_style('wp-blocks-library', includes_url('css/dist/block-library/style.min.css'));
			wp_enqueue_style('adking-widgets', EGNS_CORE_THEME_CSS . '/el-widgets.css', null, filemtime(get_template_directory() . '/assets/css/el-widgets.css'));
		}


		/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */
		public function _widget_categories($elements_manager)
		{
			$elements_manager->add_category(
				'adking_widgets',
				[
					'title' => esc_html__('Adking Widgets', 'adking-core'),
					'icon'  => 'fa fa-plug',
				]
			);
		}


		/**
		 * _widget_registered()
		 * @since 1.0.0
		 * */
		public function _widget_registered()
		{

			if (!class_exists('Elementor\Widget_Base')) {
				return;
			}

			$elementor_widgets = array(
				//Elementor Widgets
				'heading',
				'button',
				'footer',
				'testimonial',
				'blog',
				'product',
				'product-tab',
				'product-slider',
				'ads-service',
				'banner',
				'contact',
				'feature-banner',
				'gallery',
			);

			$elementor_widgets = apply_filters('adking_widgets', $elementor_widgets);

			if (is_array($elementor_widgets) && !empty($elementor_widgets)) {

				foreach ($elementor_widgets as $widget) {

					if (file_exists(EGNS_CORE_INC . '/elementor/widgets/class-' . $widget . '-elementor-widget.php')) {
						require_once EGNS_CORE_INC . '/elementor/widgets/class-' . $widget . '-elementor-widget.php';
					}
				}
			}
		} // End _widget_registered


		/**
		 * elementor custom icons library
		 * @since 1.0.0
		 * */
		public function add_custom_icon_to_elementor_icons($icons)
		{

			$icons['bootstrap'] = [
				'name'          => 'bootstrap',
				'label'         => esc_html__('Bootstrap Icons', 'adking-core'),
				'url'           => EGNS_CORE_INC_ASSETS . '/css/bootstrap-icons.css',
				'enqueue'       => [EGNS_CORE_INC_ASSETS . '/css/bootstrap-icons.css'],
				'prefix'        => 'bi-',
				'displayPrefix' => 'bi',
				'labelIcon'     => 'bi bi-bootstrap-fill',
				'ver'           => '1.11.3',
				'fetchJson'     => EGNS_CORE_INC_ASSETS . '/js/bootstrap-icons.json',
				'native'        => true,
			];

			$icons['boxicons-regular'] = [
				'name'          => 'boxicons-regular',
				'label'         => esc_html__('Boxicons-Regular', 'adking-core'),
				'url'           => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
				'enqueue'       => [EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css'],
				'prefix'        => 'bx-',
				'displayPrefix' => 'bx',
				'labelIcon'     => 'bi bi-box-seam-fill',
				'ver'           => '2.1.4',
				'fetchJson'     => EGNS_CORE_INC_ASSETS . '/js/boxicons.json',
				'native'        => true,
			];
			$icons['boxicons-solid'] = [
				'name'          => 'boxicons-solid',
				'label'         => esc_html__('Boxicons-Solid', 'adking-core'),
				'url'           => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
				'enqueue'       => [EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css'],
				'prefix'        => 'bxs-',
				'displayPrefix' => 'bx',
				'labelIcon'     => 'bi bi-box-seam-fill',
				'ver'           => '2.1.4',
				'fetchJson'     => EGNS_CORE_INC_ASSETS . '/js/boxicons-bxs.json',
				'native'        => true,
			];
			$icons['boxicons-logos'] = [
				'name'          => 'boxicons-logos',
				'label'         => esc_html__('Boxicons-Logos', 'adking-core'),
				'url'           => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
				'enqueue'       => [EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css'],
				'prefix'        => 'bxl-',
				'displayPrefix' => 'bx',
				'labelIcon'     => 'bi bi-box-seam-fill',
				'ver'           => '2.1.4',
				'fetchJson'     => EGNS_CORE_INC_ASSETS . '/js/boxicons-bxl.json',
				'native'        => true,
			];

			return $icons;
		}
		// end custom icons 



	}
	if (class_exists('Egns_Elementor')) {
		Egns_Elementor::getInstance();
	}
} //end if

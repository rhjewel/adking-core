<?php

/**
 * Custom Post Type
 * Author EgensLab
 * @since 1.0.0
 * */

if (!defined('ABSPATH')) {
	exit();  //exit if access directly
}
if (!class_exists('Adking_Custom_Post_Type')) {
	class Adking_Custom_Post_Type
	{

		//$instance variable
		private static $instance;

		public function __construct()
		{
			//register post type
			add_action('init', array($this, 'register_custom_post_type'));
		}

		/**
		 * get Instance
		 * @since  2.0.0
		 * */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Register Custom Post Type
		 * @since  2.0.0
		 * */
		public function register_custom_post_type()
		{
			$all_post_type = array(

				// Custom Post Type: Careers
				// [
				// 	'post_type' => 'career',
				// 	'args'      => [
				// 		'label'       => esc_html__('Careers', 'adking-core'),
				// 		'description' => esc_html__('Manage career and job postings', 'adking-core'),
				// 		'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		'menu_position' => 37,

				// 		'labels' => [
				// 			'name'               => esc_html_x('Careers', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('Career', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Careers', 'adking-core'),
				// 			'all_items'          => esc_html__('All Careers', 'adking-core'),
				// 			'view_item'          => esc_html__('View Career', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add New Career', 'adking-core'),
				// 			'add_new'            => esc_html__('Add New', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit Career', 'adking-core'),
				// 			'update_item'        => esc_html__('Update Career', 'adking-core'),
				// 			'search_items'       => esc_html__('Search Careers', 'adking-core'),
				// 			'not_found'          => esc_html__('No careers found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('No careers found in Trash', 'adking-core'),
				// 		],

				// 		'supports'            => ['title', 'editor', 'excerpt', 'thumbnail'],
				// 		'hierarchical'        => false,
				// 		'public'              => true,
				// 		'has_archive'         => true,
				// 		'publicly_queryable'  => true,
				// 		'show_ui'             => true,
				// 		'show_in_rest'        => true,
				// 		'exclude_from_search' => false,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,

				// 		'rewrite' => [
				// 			'slug'       => 'career',
				// 			'with_front' => true,
				// 		],
				// 	],
				// ],


				// Custom Post Type: Case Study
				[
					'post_type' => 'case-study',
					'args'      => [
						'label'       => esc_html__('Case Studies', 'adking-core'),
						'description' => esc_html__('Case Studies', 'adking-core'),
						'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
						'labels'      => [
							'name'               => esc_html_x('Case Studies', 'Post Type General Name', 'adking-core'),
							'singular_name'      => esc_html_x('Case Study', 'Post Type Singular Name', 'adking-core'),
							'menu_name'          => esc_html__('Case Studies', 'adking-core'),
							'all_items'          => esc_html__('All Case Studies', 'adking-core'),
							'view_item'          => esc_html__('View Case Study', 'adking-core'),
							'add_new_item'       => esc_html__('Add New Case Study', 'adking-core'),
							'add_new'            => esc_html__('Add New', 'adking-core'),
							'edit_item'          => esc_html__('Edit Case Study', 'adking-core'),
							'update_item'        => esc_html__('Update Case Study', 'adking-core'),
							'search_items'       => esc_html__('Search Case Studies', 'adking-core'),
							'not_found'          => esc_html__('No case studies found', 'adking-core'),
							'not_found_in_trash' => esc_html__('No case studies found in Trash', 'adking-core'),
						],
						'supports'            => ['title', 'editor', 'excerpt', 'thumbnail'],
						'hierarchical'        => false,
						'public'              => true,
						'has_archive'         => true,
						'publicly_queryable'  => true,
						'show_ui'             => true,
						'show_in_rest'        => true,
						'exclude_from_search' => false,
						'can_export'          => true,
						'capability_type'     => 'post',
						'query_var'           => true,
						'menu_position'       => 37,
						'rewrite'             => [
							'slug'       => 'case-study',
							'with_front' => true,
						],
					],
				],

				// Custom Post Type: Mega Menu
				[
					'post_type' => 'mega-menu',
					'args'      => [
						'label'       => esc_html__('Mega Menus', 'adking-core'),
						'description' => esc_html__('Mega Menu Items', 'adking-core'),
						'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
						'labels'      => [
							'name'               => esc_html_x('Mega Menus', 'Post Type General Name', 'adking-core'),
							'singular_name'      => esc_html_x('Mega Menu', 'Post Type Singular Name', 'adking-core'),
							'menu_name'          => esc_html__('Mega Menus', 'adking-core'),
							'all_items'          => esc_html__('All Mega Menus', 'adking-core'),
							'view_item'          => esc_html__('View Mega Menu', 'adking-core'),
							'add_new_item'       => esc_html__('Add New Mega Menu', 'adking-core'),
							'add_new'            => esc_html__('Add New', 'adking-core'),
							'edit_item'          => esc_html__('Edit Mega Menu', 'adking-core'),
							'update_item'        => esc_html__('Update Mega Menu', 'adking-core'),
							'search_items'       => esc_html__('Search Mega Menus', 'adking-core'),
							'not_found'          => esc_html__('No mega menus found', 'adking-core'),
							'not_found_in_trash' => esc_html__('No mega menus found in Trash', 'adking-core'),
						],
						'supports'            => ['title', 'editor'],
						'hierarchical'        => true,
						'public'              => true,
						'has_archive'         => false,
						'publicly_queryable'  => true,
						'show_ui'             => true,
						'show_in_rest'        => false,
						'exclude_from_search' => true,
						'can_export'          => true,
						'capability_type'     => 'post',
						'query_var'           => true,
						'menu_position'       => 37,
						'rewrite'             => [
							'slug'       => 'mega-menu',
							'with_front' => true,
						],
					],
				],

				// Custom Post Type: Header Templates
				// [
				// 	'post_type' => 'header-blocks',
				// 	'args'      => [
				// 		'label'       => esc_html__('Header Templates', 'adking-core'),
				// 		'description' => esc_html__('Manage header templates for the theme', 'adking-core'),
				// 		'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		'menu_position' => 38,

				// 		'labels' => [
				// 			'name'               => esc_html_x('Header Templates', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('Header Template', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Header Templates', 'adking-core'),
				// 			'all_items'          => esc_html__('All Header Templates', 'adking-core'),
				// 			'view_item'          => esc_html__('View Header Template', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add New Header Template', 'adking-core'),
				// 			'add_new'            => esc_html__('Add New', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit Header Template', 'adking-core'),
				// 			'update_item'        => esc_html__('Update Header Template', 'adking-core'),
				// 			'search_items'       => esc_html__('Search Header Templates', 'adking-core'),
				// 			'not_found'          => esc_html__('No header templates found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('No header templates found in Trash', 'adking-core'),
				// 		],

				// 		'supports'            => ['title', 'editor'],
				// 		'hierarchical'        => true,
				// 		'public'              => true,
				// 		'has_archive'         => false,
				// 		'publicly_queryable'  => true,
				// 		'show_ui'             => true,
				// 		'show_in_rest'        => true,
				// 		'exclude_from_search' => true,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,

				// 		'rewrite' => [
				// 			'slug'       => 'header-blocks',
				// 			'with_front' => true,
				// 		],
				// 	],
				// ],

				// Custom Post Type: Footer Templates
				[
					'post_type' => 'footer-blocks',
					'args'      => [
						'label'         => esc_html__('Footer Templates', 'adking-core'),
						'description'   => esc_html__('Manage footer templates for the theme', 'adking-core'),
						'menu_icon'     => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
						'menu_position' => 39,
						'labels'        => [
							'name'               => esc_html_x('Footer Templates', 'Post Type General Name', 'adking-core'),
							'singular_name'      => esc_html_x('Footer Template', 'Post Type Singular Name', 'adking-core'),
							'menu_name'          => esc_html__('Footer Templates', 'adking-core'),
							'all_items'          => esc_html__('All Footer Templates', 'adking-core'),
							'view_item'          => esc_html__('View Footer Template', 'adking-core'),
							'add_new_item'       => esc_html__('Add New Footer Template', 'adking-core'),
							'add_new'            => esc_html__('Add New', 'adking-core'),
							'edit_item'          => esc_html__('Edit Footer Template', 'adking-core'),
							'update_item'        => esc_html__('Update Footer Template', 'adking-core'),
							'search_items'       => esc_html__('Search Footer Templates', 'adking-core'),
							'not_found'          => esc_html__('No footer templates found', 'adking-core'),
							'not_found_in_trash' => esc_html__('No footer templates found in Trash', 'adking-core'),
						],
						'supports'            => ['title', 'editor'],
						'hierarchical'        => true,
						'public'              => true,
						'has_archive'         => false,
						'publicly_queryable'  => true,
						'show_ui'             => true,
						'show_in_rest'        => true,
						'exclude_from_search' => true,
						'can_export'          => true,
						'capability_type'     => 'post',
						'query_var'           => true,
						'rewrite'             => [
							'slug'       => 'footer-blocks',
							'with_front' => true,
						],
					],
				],


			);

			if (!empty($all_post_type) && is_array($all_post_type)) {
				foreach ($all_post_type as $post_type) {
					call_user_func_array('register_post_type', $post_type);
				}
			}

			/**
			 * Custom Taxonomy Register
			 */
			$all_custom_taxonmy = array(


				// Taxonomy: Career Categories
				// [
				// 	'taxonomy'    => 'career-category',
				// 	'object_type' => 'career',
				// 	'args'        => [
				// 		'labels' => [
				// 			'name'              => esc_html__('Categories', 'adking-core'),
				// 			'singular_name'     => esc_html__('Category', 'adking-core'),
				// 			'menu_name'         => esc_html__('Categories', 'adking-core'),
				// 			'all_items'         => esc_html__('All Career Categories', 'adking-core'),
				// 			'add_new_item'      => esc_html__('Add New Category', 'adking-core'),
				// 			'edit_item'         => esc_html__('Edit Category', 'adking-core'),
				// 			'update_item'       => esc_html__('Update Category', 'adking-core'),
				// 			'search_items'      => esc_html__('Search Categories', 'adking-core'),
				// 			'not_found'         => esc_html__('No categories found', 'adking-core'),
				// 		],

				// 		'public'             => true,
				// 		'hierarchical'       => true,
				// 		'show_ui'            => true,
				// 		'show_in_menu'       => true,
				// 		'show_in_nav_menus'  => true,
				// 		'show_admin_column'  => true,
				// 		'show_in_rest'       => true,
				// 		'show_in_quick_edit' => true,
				// 		'query_var'          => true,

				// 		'rewrite' => [
				// 			'slug'       => 'career-category',
				// 			'with_front' => true,
				// 		],
				// 	],
				// ],

				// Taxonomy: Career Tags
				// [
				// 	'taxonomy'    => 'career-tag',
				// 	'object_type' => 'career',
				// 	'args'        => [
				// 		'labels' => [
				// 			'name'              => esc_html__('Tags', 'adking-core'),
				// 			'singular_name'     => esc_html__('Tag', 'adking-core'),
				// 			'menu_name'         => esc_html__('Tags', 'adking-core'),
				// 			'all_items'         => esc_html__('All Tags', 'adking-core'),
				// 			'add_new_item'      => esc_html__('Add New Tag', 'adking-core'),
				// 			'edit_item'         => esc_html__('Edit Tag', 'adking-core'),
				// 			'update_item'       => esc_html__('Update Tag', 'adking-core'),
				// 			'search_items'      => esc_html__('Search Tags', 'adking-core'),
				// 			'not_found'         => esc_html__('No tags found', 'adking-core'),
				// 		],

				// 		'public'             => true,
				// 		'hierarchical'       => false,
				// 		'show_ui'            => true,
				// 		'show_in_menu'       => true,
				// 		'show_in_nav_menus'  => true,
				// 		'show_admin_column'  => true,
				// 		'show_in_rest'       => true,
				// 		'show_in_quick_edit' => true,
				// 		'query_var'          => true,
				// 		'meta_box_cb'        => 'post_tags_meta_box',

				// 		'rewrite' => [
				// 			'slug'       => 'career-tag',
				// 			'with_front' => true,
				// 		],
				// 	],
				// ],


				// Taxonomy: Case Study Categories
				[
					'taxonomy'    => 'case-study-category',
					'object_type' => 'case-study',
					'args'        => [
						'labels' => [
							'name'          => esc_html__('Categories', 'adking-core'),
							'singular_name' => esc_html__('Category', 'adking-core'),
							'menu_name'     => esc_html__('Categories', 'adking-core'),
							'all_items'     => esc_html__('All Categories', 'adking-core'),
							'add_new_item'  => esc_html__('Add New Category', 'adking-core'),
							'edit_item'     => esc_html__('Edit Category', 'adking-core'),
							'update_item'   => esc_html__('Update Category', 'adking-core'),
							'search_items'  => esc_html__('Search Categories', 'adking-core'),
							'not_found'     => esc_html__('No categories found', 'adking-core'),
						],
						'public'             => true,
						'hierarchical'       => true,
						'show_ui'            => true,
						'show_in_menu'       => true,
						'show_in_nav_menus'  => true,
						'show_admin_column'  => true,
						'show_in_rest'       => true,
						'show_in_quick_edit' => true,
						'query_var'          => true,
						'rewrite'            => [
							'slug'       => 'case-study-category',
							'with_front' => true,
						],
					],
				],

				// Taxonomy: Case Study Tags
				[
					'taxonomy'    => 'case-study-tag',
					'object_type' => 'case-study',
					'args'        => [
						'labels' => [
							'name'          => esc_html__('Tags', 'adking-core'),
							'singular_name' => esc_html__('Tag', 'adking-core'),
							'menu_name'     => esc_html__('Tags', 'adking-core'),
							'all_items'     => esc_html__('All Tags', 'adking-core'),
							'add_new_item'  => esc_html__('Add New Tag', 'adking-core'),
							'edit_item'     => esc_html__('Edit Tag', 'adking-core'),
							'update_item'   => esc_html__('Update Tag', 'adking-core'),
							'search_items'  => esc_html__('Search Tags', 'adking-core'),
							'not_found'     => esc_html__('No tags found', 'adking-core'),
						],
						'public'             => true,
						'hierarchical'       => false,
						'show_ui'            => true,
						'show_in_menu'       => true,
						'show_in_nav_menus'  => true,
						'show_admin_column'  => true,
						'show_in_rest'       => true,
						'show_in_quick_edit' => true,
						'query_var'          => true,
						'meta_box_cb'        => 'post_tags_meta_box',
						'rewrite'            => [
							'slug'       => 'case-study-tag',
							'with_front' => true,
						],
					],
				],


			);

			if (is_array($all_custom_taxonmy) && !empty($all_custom_taxonmy)) {
				foreach ($all_custom_taxonmy as $taxonomy) {
					call_user_func_array('register_taxonomy', $taxonomy);
				}
			}

			flush_rewrite_rules();
		}
	} //end class

	if (class_exists('Adking_Custom_Post_Type')) {
		Adking_Custom_Post_Type::getInstance();
	}
}

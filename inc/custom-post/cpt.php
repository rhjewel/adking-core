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

				// Custom Post Career
				// [
				// 	'post_type' => 'career',
				// 	'args'      => array(
				// 		'label'       => esc_html__('Careers', 'adking-core'),
				// 		'description' => esc_html__('Careers', 'adking-core'),
				// 		'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		'labels'      => array(
				// 			'name'               => esc_html_x('Careers', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('Career', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Careers', 'adking-core'),
				// 			'all_items'          => esc_html__('All Careers', 'adking-core'),
				// 			'view_item'          => esc_html__('View Career', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add Career', 'adking-core'),
				// 			'add_new'            => esc_html__('Add Career', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit Career', 'adking-core'),
				// 			'update_item'        => esc_html__('Update Career', 'adking-core'),
				// 			'search_items'       => esc_html__('Search Career', 'adking-core'),
				// 			'not_found'          => esc_html__('Not Found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
				// 		),
				// 		'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
				// 		'hierarchical'        => true,
				// 		'public'              => true,
				// 		'has_archive'         => true,
				// 		"publicly_queryable"  => true,
				// 		'show_ui'             => true,
				// 		"rewrite"             => array('slug' => 'career', 'with_front' => true),
				// 		'exclude_from_search' => false,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,
				// 		"show_in_rest"        => true,
				// 		'menu_position'       => 37,
				// 	)
				// ],

				// Custom Post People
				// [
				// 	'post_type' => 'people',
				// 	'args'      => array(
				// 		'label'       => esc_html__('Peoples', 'adking-core'),
				// 		'description' => esc_html__('Peoples', 'adking-core'),
				// 		'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		'labels'      => array(
				// 			'name'               => esc_html_x('Peoples', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('People', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Peoples', 'adking-core'),
				// 			'all_items'          => esc_html__('All Peoples', 'adking-core'),
				// 			'view_item'          => esc_html__('View People', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add People', 'adking-core'),
				// 			'add_new'            => esc_html__('Add People', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit People', 'adking-core'),
				// 			'update_item'        => esc_html__('Update People', 'adking-core'),
				// 			'search_items'       => esc_html__('Search People', 'adking-core'),
				// 			'not_found'          => esc_html__('Not Found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
				// 		),
				// 		'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
				// 		'hierarchical'        => true,
				// 		'public'              => true,
				// 		'has_archive'         => true,
				// 		"publicly_queryable"  => true,
				// 		'show_ui'             => true,
				// 		"rewrite"             => array('slug' => 'people', 'with_front' => true),
				// 		'exclude_from_search' => false,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,
				// 		"show_in_rest"        => true,
				// 		'menu_position'       => 37,
				// 	)
				// ],

				// Custom Post Case Study
				// [
				// 	'post_type' => 'case-study',
				// 	'args'      => array(
				// 		'label'       => esc_html__('Case Studies', 'adking-core'),
				// 		'description' => esc_html__('Case Studies', 'adking-core'),
				// 		'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		'labels'      => array(
				// 			'name'               => esc_html_x('Case Studies', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('Case Study', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Case Studies', 'adking-core'),
				// 			'all_items'          => esc_html__('All Case Studys', 'adking-core'),
				// 			'view_item'          => esc_html__('View Case Study', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add Case Study', 'adking-core'),
				// 			'add_new'            => esc_html__('Add Case Study', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit Case Study', 'adking-core'),
				// 			'update_item'        => esc_html__('Update Case Study', 'adking-core'),
				// 			'search_items'       => esc_html__('Search Case Study', 'adking-core'),
				// 			'not_found'          => esc_html__('Not Found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
				// 		),
				// 		'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
				// 		'hierarchical'        => true,
				// 		'public'              => true,
				// 		'has_archive'         => true,
				// 		"publicly_queryable"  => true,
				// 		'show_ui'             => true,
				// 		"rewrite"             => array('slug' => 'case-study', 'with_front' => true),
				// 		'exclude_from_search' => false,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,
				// 		"show_in_rest"        => true,
				// 		'menu_position'       => 37,
				// 	)
				// ],

				// Custom post Mega Menu
				[
					'post_type' => 'mega-menu',
					'args'      => array(
						'label'       => esc_html__('Mega Menu', 'adking-core'),
						'description' => esc_html__('Mega Menu', 'adking-core'),
						'menu_icon'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
						'labels'      => array(
							'name'               => esc_html_x('Mega Menus', 'Post Type General Name', 'adking-core'),
							'singular_name'      => esc_html_x('Mega Menu', 'Post Type Singular Name', 'adking-core'),
							'menu_name'          => esc_html__('Mega Menu', 'adking-core'),
							'all_items'          => esc_html__('All Mega Menu', 'adking-core'),
							'view_item'          => esc_html__('View', 'adking-core'),
							'add_new_item'       => esc_html__('Add New', 'adking-core'),
							'add_new'            => esc_html__('Add New', 'adking-core'),
							'edit_item'          => esc_html__('Edit', 'adking-core'),
							'update_item'        => esc_html__('Update', 'adking-core'),
							'search_items'       => esc_html__('Search', 'adking-core'),
							'not_found'          => esc_html__('Not Found', 'adking-core'),
							'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
						),
						'supports'            => array('title', 'editor'),
						'hierarchical'        => true,
						'public'              => true,
						'has_archive'         => false,
						"publicly_queryable"  => true,
						'show_ui'             => true,
						"rewrite"             => array('slug' => 'mega-menu', 'with_front' => true),
						'exclude_from_search' => true,
						'can_export'          => true,
						'capability_type'     => 'post',
						'query_var'           => true,
						"show_in_rest"        => false,
						'menu_position'       => 37,
					)
				],

				// Custom Header Block
				// [
				// 	'post_type' => 'header-blocks',
				// 	'args'      => array(
				// 		'label'         => esc_html__('Header Templates', 'adking-core'),
				// 		'description'   => esc_html__('Add adking header block here', 'adking-core'),
				// 		'menu_icon'     => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
				// 		"menu_position" => 60,
				// 		'labels'        => array(
				// 			'name'               => esc_html_x('Header Templates', 'Post Type General Name', 'adking-core'),
				// 			'singular_name'      => esc_html_x('Header Template', 'Post Type Singular Name', 'adking-core'),
				// 			'menu_name'          => esc_html__('Header Template', 'adking-core'),
				// 			'all_items'          => esc_html__('All Header Templates', 'adking-core'),
				// 			'view_item'          => esc_html__('View', 'adking-core'),
				// 			'add_new_item'       => esc_html__('Add New', 'adking-core'),
				// 			'add_new'            => esc_html__('Add New', 'adking-core'),
				// 			'edit_item'          => esc_html__('Edit', 'adking-core'),
				// 			'update_item'        => esc_html__('Update', 'adking-core'),
				// 			'search_items'       => esc_html__('Search', 'adking-core'),
				// 			'not_found'          => esc_html__('Not Found', 'adking-core'),
				// 			'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
				// 		),
				// 		'supports'            => array('title', 'editor'),
				// 		'hierarchical'        => true,
				// 		'public'              => true,
				// 		'has_archive'         => false,
				// 		"publicly_queryable"  => true,
				// 		'show_ui'             => true,
				// 		"rewrite"             => array('slug' => 'header-blocks', 'with_front' => true),
				// 		'exclude_from_search' => true,
				// 		'can_export'          => true,
				// 		'capability_type'     => 'post',
				// 		'query_var'           => true,
				// 		"show_in_rest"        => true,
				// 		'menu_position'       => 38,
				// 	)
				// ],

				// Custom Footer Block
				[
					'post_type' => 'footer-blocks',
					'args'      => array(
						'label'         => esc_html__('Footer Templates', 'adking-core'),
						'description'   => esc_html__('Add adking footer block here', 'adking-core'),
						'menu_icon'     => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/small-icon.svg'),
						"menu_position" => 60,
						'labels'        => array(
							'name'               => esc_html_x('Footer Templates', 'Post Type General Name', 'adking-core'),
							'singular_name'      => esc_html_x('Footer Template', 'Post Type Singular Name', 'adking-core'),
							'menu_name'          => esc_html__('Footer Template', 'adking-core'),
							'all_items'          => esc_html__('All Footer Templates', 'adking-core'),
							'view_item'          => esc_html__('View', 'adking-core'),
							'add_new_item'       => esc_html__('Add New', 'adking-core'),
							'add_new'            => esc_html__('Add New', 'adking-core'),
							'edit_item'          => esc_html__('Edit', 'adking-core'),
							'update_item'        => esc_html__('Update', 'adking-core'),
							'search_items'       => esc_html__('Search', 'adking-core'),
							'not_found'          => esc_html__('Not Found', 'adking-core'),
							'not_found_in_trash' => esc_html__('Not found in Trash', 'adking-core'),
						),
						'supports'            => array('title', 'editor'),
						'hierarchical'        => true,
						'public'              => true,
						'has_archive'         => false,
						"publicly_queryable"  => true,
						'show_ui'             => true,
						"rewrite"             => array('slug' => 'footer-blocks', 'with_front' => true),
						'exclude_from_search' => true,
						'can_export'          => true,
						'capability_type'     => 'post',
						'query_var'           => true,
						"show_in_rest"        => true,
						'menu_position'       => 39,
					)
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


				// career category
				// array(
				// 	'taxonomy'    => 'career-category',
				// 	'object_type' => 'career',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Categories", 'adking-core'),
				// 			"singular_name" => esc_html__("Categories", 'adking-core'),
				// 			"menu_name"     => esc_html__("Categories", 'adking-core'),
				// 			"all_items"     => esc_html__("All Career Categories", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Category", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => true,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'career-category', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 	)
				// ),

				// Tag for career post
				// array(
				// 	'taxonomy'    => 'career-tag',
				// 	'object_type' => 'career',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Tags", 'adking-core'),
				// 			"singular_name" => esc_html__("Tags", 'adking-core'),
				// 			"menu_name"     => esc_html__("Tags", 'adking-core'),
				// 			"all_items"     => esc_html__("All Tags", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Tags", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => false,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'career-tag', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 		'meta_box_cb'        => 'post_tags_meta_box',
				// 	)
				// ),


				//people category
				// array(
				// 	'taxonomy'    => 'people-category',
				// 	'object_type' => 'people',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Categories", 'adking-core'),
				// 			"singular_name" => esc_html__("Categories", 'adking-core'),
				// 			"menu_name"     => esc_html__("Categories", 'adking-core'),
				// 			"all_items"     => esc_html__("All Career Categories", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Category", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => true,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'people-category', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 	)
				// ),

				// Tag for people post
				// array(
				// 	'taxonomy'    => 'people-tag',
				// 	'object_type' => 'people',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Tags", 'adking-core'),
				// 			"singular_name" => esc_html__("Tags", 'adking-core'),
				// 			"menu_name"     => esc_html__("Tags", 'adking-core'),
				// 			"all_items"     => esc_html__("All Tags", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Tags", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => false,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'people-tag', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 		'meta_box_cb'        => 'post_tags_meta_box',
				// 	)
				// ),


				//case study category
				// array(
				// 	'taxonomy'    => 'case-study-category',
				// 	'object_type' => 'case-study',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Categories", 'adking-core'),
				// 			"singular_name" => esc_html__("Categories", 'adking-core'),
				// 			"menu_name"     => esc_html__("Categories", 'adking-core'),
				// 			"all_items"     => esc_html__("All Career Categories", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Category", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => true,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'case-study-category', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 	)
				// ),

				// Tag for case study post
				// array(
				// 	'taxonomy'    => 'case-study-tag',
				// 	'object_type' => 'case-study',
				// 	'args'        => array(
				// 		"labels"  => array(
				// 			"name"          => esc_html__("Tags", 'adking-core'),
				// 			"singular_name" => esc_html__("Tags", 'adking-core'),
				// 			"menu_name"     => esc_html__("Tags", 'adking-core'),
				// 			"all_items"     => esc_html__("All Tags", 'adking-core'),
				// 			"add_new_item"  => esc_html__("Add New Tags", 'adking-core')
				// 		),
				// 		"public"             => true,
				// 		"hierarchical"       => false,
				// 		'has_archive'        => true,
				// 		"show_ui"            => true,
				// 		"show_in_menu"       => true,
				// 		"show_in_nav_menus"  => true,
				// 		"rewrite"            => array('slug' => 'case-study-tag', 'with_front' => true),
				// 		"query_var"          => true,
				// 		"show_admin_column"  => true,
				// 		"show_in_rest"       => true,
				// 		"show_in_quick_edit" => true,
				// 		'meta_box_cb'        => 'post_tags_meta_box',
				// 	)
				// ),


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

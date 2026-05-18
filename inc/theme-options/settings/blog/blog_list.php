<?php
/*-------------------------------------------------------
		  ** Blog Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'parent' => 'blog_settings',
	'id'     => 'blog_post_options',
	'title'  => esc_html__('Blog Post', 'adking-core'),
	'icon'   => 'fa fa-list-ul',
	'fields' => array(
		array(
			'id'      => 'blog_layout_options',
			'title'   => esc_html__('Blog Layout', 'adking-core'),
			'type'    => 'image_select',
			'options' => array(
				'grid'     => EGNS_CORE_THEME_OPTIONS_IMAGES . '/blog/grid.png',
				'standard' => EGNS_CORE_THEME_OPTIONS_IMAGES . '/blog/standard.png',
			),
			'default' => 'standard',
			'desc'    => wp_kses(__('You can set <mark>blog layout</mark> for blog archive page', 'adking-core'), wp_kses_allowed_html('post')),
		),
	),

));

<?php
/*-----------------------------------
    PAGE BARNER SECTION
------------------------------------*/

CSF::createSection(
	$prefix,
	array(
		'title'  => esc_html__('Breadcrumb', 'adking-core'),
		'parent' => 'page_meta_option',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Breadcrumb Options', 'adking-core'),
			),
			array(
				'id'      => 'breadcrumb_enable_page',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Breadcrumb', 'adking-core'),
				'desc'    => esc_html__('If you want to show or hide page banner you can toggle ( ON / OFF ).', 'adking-core'),
				'default' => true,
			),
			array(
				'id'         => 'breadcrumb_page_heading',
				'type'       => 'text',
				'title'      => esc_html__('Heading', 'adking-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
			array(
				'id'         => 'breadcrumb_page_bg_color',
				'type'       => 'color',
				'title'      => esc_html__('Background Color', 'adking-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
			array(
				'id'         => 'breadcrumb_page_bg_image',
				'type'       => 'media',
				'title'      => esc_html__('Breadcrumb Background Image', 'adking-core'),
				'desc'       => esc_html__('Set the banner background image', 'adking-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
		)
	)
);

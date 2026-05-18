<?php
/*-------------------------------------------------------
		   ** 404 page options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'id'     => '404_page',
	'title'  => esc_html__('404 Page', 'adking-core'),
	'icon'   => 'fa fa-exclamation-triangle',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => '<h3>' . esc_html__('404 Page Options', 'adking-core') . '</h3>',
		),
		array(
			'id'      => '404_title',
			'title'   => esc_html__('Title', 'adking-core'),
			'type'    => 'text',
			'default' => wp_kses_post('Something Went Missing'),
		),
		array(
			'id'      => '404_button_text',
			'title'   => esc_html__('Button label', 'adking-core'),
			'type'    => 'text',
			'info'    => wp_kses_post('you can change <mark>button text</mark> of 404 page'),
			'default' => esc_html__('Go to homepage', 'adking-core')
		),
		array(
			'id'      => '404_bg_video',
			'type'    => 'text',
			'title'   => esc_html__('BG Video link', 'adking-core'),
			'desc'    => esc_html__('Provide video link only.', 'adking-core'),
			'default' => 'example.com/video/error.mp4'
		),
		array(
			'id'      => '404_image',
			'type'    => 'media',
			'title'   => esc_html__('Error Image', 'adking-core'),
			'library' => 'image',
			'default' => array(
				'url'       => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/error/error.png'),
				'id'        => '404_image',
				'thumbnail' => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/error/error.png'),
				'alt'       => esc_attr('404 image'),
				'title'     => esc_html('404 image'),
			),
		),
		array(
			'id'      => '404_content',
			'title'   => esc_html__('Short Description', 'adking-core'),
			'type'    => 'textarea',
			'default' => esc_html__("Oops! The page you’re trying to reach can’t be found or may have been moved. Don’t worry — you can continue exploring.", 'adking-core')
		),

	)
));

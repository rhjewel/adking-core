<?php

/*-------------------------------------------------------
	   ** Footer  Options
--------------------------------------------------------*/

CSF::createSection(
	$prefix,
	array(
		'parent' => 'footer_options',
		'id'     => 'footer_content_options',
		'title'  => esc_html__('Footer Template', 'adking-core'),
		'icon'   => 'fa fa-copyright',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => '<h3>' . esc_html__('Footer Template', 'adking-core') . '</h3>'
			),
			//------------------------- Footer Template Text --------------------------//
			array(
				'id'          => 'footer_one_template',
				'type'        => 'select',
				'title'       => esc_html__('Footer One', 'adking-core'),
				'chosen'      => true,
				'placeholder' => esc_html__('Select a footer', 'adking-core'),
				'options'     => \Egns_Core\Egns_Helper::get_custom_template_list(),
				'default'     => 'footer-one'
			),
			array(
				'id'          => 'footer_two_template',
				'type'        => 'select',
				'title'       => esc_html__('Footer Two', 'adking-core'),
				'chosen'      => true,
				'placeholder' => esc_html__('Select a footer', 'adking-core'),
				'options'     => \Egns_Core\Egns_Helper::get_custom_template_list(),
				'default'     => 'footer-two'
			),
			array(
				'id'          => 'footer_three_template',
				'type'        => 'select',
				'title'       => esc_html__('Footer Three', 'adking-core'),
				'chosen'      => true,
				'placeholder' => esc_html__('Select a footer', 'adking-core'),
				'options'     => \Egns_Core\Egns_Helper::get_custom_template_list(),
				'default'     => 'footer-three'
			),
		),
	)
);

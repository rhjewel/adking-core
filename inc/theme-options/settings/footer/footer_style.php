<?php
/*-----------------------------------
		Footer Style  
------------------------------------*/

CSF::createSection($prefix, array(
    'parent' => 'footer_options',
    'title'  => esc_html__('Footer Style', 'adking-core'),
    'id'     => 'theme_footer_style_options',
    'icon'   => 'fab fa-algolia',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Select Footer Global Layout', 'adking-core') . '</h3>'
        ),
        array(
            'id'      => 'footer_layout_style',
            'type'    => 'image_select',
            'class'   => 'egns_header_select',
            'options' => array(
                'footer_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-one.png'),
            ),
            'desc'    => wp_kses(__('You can select <mark>Footer Style </mark> for global footer', 'adking-core'), wp_kses_allowed_html('adking-core')),
            'default' => 'footer_one',
        ),
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

    ),

));
